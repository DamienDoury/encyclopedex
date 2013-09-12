<?php
include "../bdd.php";

set_time_limit(0);

$liste_pokemon = $bdd->query("
SELECT nom_anglais, id_pokemon
FROM pokemon
");

while($pokemon = $liste_pokemon->fetch())
{
	$url = "http://bulbapedia.bulbagarden.net/wiki/" . preg_replace("# #", "%20", $pokemon["nom_anglais"]);
	$page = file_get_contents($url); // On recupere la page Bulbapedia (En) de ce Pokemon.

	if($page)
	{
		$liste_methodes[0] = array("By_leveling_up", "l");
		$liste_methodes[1] = array("By_TM.2FHM", "c");
		$liste_methodes[2] = array("By_breeding", "b");
		$liste_methodes[3] = array("By_tutoring", "m");
		$liste_methodes[4] = array("By_a_prior_evolution", "p");
		$liste_methodes[5] = array("By_events", "e");
		$liste_methodes[5] = array("Dream_World_moves", "d");
		
		foreach($liste_methodes AS $methode)
		{
			if(preg_match("#id=\"" . $methode[0] . "\".+</h4>(.+)class=\"roundybottom#Us", $page, $texte_matched))
			{
				$page_methode = $texte_matched[1];
				preg_match_all("|\(move\)\"><span style=\"color:#000;\">(.+)</span>|Us", $page_methode, $listeTemp); // On recupere la liste de ses attaques.
				
				foreach($listeTemp[1] AS $attaque)
				{
					$param = "";
					
					if($methode[1] == "l") // On recupere le niveau d'apprentissage de l'attaque.
					{
						if(preg_match("#>\s*([0-9]{1,2}|Start)\s*<\/td>.{50,150}" . $attaque . " \(#Umsi", $page_methode, $resultat))
						{
							if($resultat[1] == "Start")
								$param = 1;
							else
								$param = $resultat[1];
						}
					}
					
					if($methode[1] == "c") // On recupere le numero de la CT/CS.
					{
						if(preg_match("#>([a-z]{2}[0-9]{2})</span>.{50,150}" . $attaque . " \(#Umsi", $page_methode, $resultat))
							$param = $resultat[1];
					}
				
					$bdd->exec("
					INSERT INTO attaque_pokemon(id_pokemon, id_attaque, methode, methode_param)
					VALUES('" . addslashes($pokemon["id_pokemon"]) . "', 
					(
						SELECT id_attaque
						FROM attaque
						WHERE nom_anglais LIKE '" . $attaque . "'
					),
					'" . addslashes($methode[1]) . "',
					'" . addslashes($param) . "')
					");
				}
			}
		}
	}
	else
	{
		echo "Erreur : URL " . $url . " introuvable <br />";
	}
}

$liste_pokemon->closeCursor();

echo "end";
?>