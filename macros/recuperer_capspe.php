<?php
include "../bdd.php";

set_time_limit(0);

$i = 0;

while(++$i <= 649)
{
	$url = "http://pokemondb.net/pokedex/" . $i;
	$page = file_get_contents($url); // On recupere la page de ce Pokemon.

	if($page)
	{
		preg_match_all("#<th>Abilities<\/th>\s*<td>(.+)<\/td>#Usmi", $page, $liste_forms);
		
		foreach($liste_forms[1] AS $form)
		{
			preg_match_all("#>([^<>]+)<#Usmi", $form, $liste_capspe);
			
			$liste_finale[0] = $liste_capspe[1][0];
			$liste_finale[1] = "";
			$liste_finale[2] = "";
			
			if(sizeof($liste_capspe[1]) == 4)
			{
				$liste_finale[1] = $liste_capspe[1][1];
				$liste_finale[2] = $liste_capspe[1][2];
			}
			else if(sizeof($liste_capspe[1]) == 3)
			{
				if(preg_match("#[\(\)]#", end($liste_capspe[1]))) // Si le Pokemon possede une capacite dream world.
				{
					$liste_finale[2] = $liste_capspe[1][1];
				}
				else
				{
					$liste_finale[1] = $liste_capspe[1][1];
				}
			}
			
			for($x = 0; $x < 3; $x++)
			{
				if($liste_finale[$x] == "")
				{
					$liste_finale[$x] = "'0'";
				}
				else
				{
					$liste_finale[$x] = "
					(
						SELECT id_capspe
						FROM capspe
						WHERE nom_anglais LIKE '" . addslashes($liste_finale[$x]) . "'
					)";
				}
			}
			
			$bdd->exec("
			INSERT INTO capspe_pokemon(id_pokemon, id_capspe_1, id_capspe_2, id_capspe_3)
			VALUES 
			('" . $i . "', 
				" . $liste_finale[0] . "
				,
				" . $liste_finale[1] . "
				,
				" . $liste_finale[2] . "
			)");
		}
	}
	else
	{
		echo "Erreur : URL " . $url . " introuvable <br />";
	}
}

echo "end";
?>