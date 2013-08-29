<?php
session_start();

//Connexion avec la bdd.
try
{
	$bdd = new PDO('mysql:host=mysql.1freehosting.com;dbname=u381118947_pokedex', 'u381118947_root', 'mdpmdp');
}
catch (Exception $e)
{
	die("Voici l'erreur : " . $e->getMessage());
}
//Fin connexion avec la bdd.


$liste_pokemon = $bdd->query("
SELECT *
FROM u381118947_pokedex.pokemon
");

$numero_depart = 0;
$numero_actuel = 0;

while($pokemon = $liste_pokemon->fetch()) // On parcourt la liste des Pokemon.
{
	$numero_depart = $_GET["id"];
	$numero_actuel++;
	
	if($numero_actuel < $numero_depart)
		continue;
	
	if($numero_actuel > $numero_depart)
	{
		$numero_actuel--;
		break;
	}
		
	$page = file_get_contents($pokemon["pokebip"]); // On recupere la page Pokebip de ce Pokemon.

	if($page)
	{
		$page = preg_replace("#.*Cliquez sur les localisations#s", "", $page);
		preg_match_all("#>([^>]+)<!-- \w+ -->([^<]+)<#", $page, $listeTemp); // On recupere la liste de ses attaques.
		
		for($i=0; $i<sizeof($listeTemp[0]); $i++) // On enregistre chaque attaque dans la base.
		{
			$attaque = $listeTemp[1][$i] . $listeTemp[2][$i];
			$id_attaque = $bdd->query("
			SELECT id_attaque, nom
			FROM u381118947_pokedex.attaque
			WHERE nom LIKE '" . addslashes($attaque) . "'
			");
			$id_attaque_real = $id_attaque->fetch();
			$id_attaque_real = $id_attaque_real["id_attaque"];
			$id_attaque->closeCursor();
			
			$bdd->exec("
			INSERT INTO u381118947_pokedex.attaque_pokemon
			SET 
			id_pokemon='" . addslashes($pokemon["id_pokemon"]) . "', 
			id_attaque='" . addslashes($id_attaque_real) . "'
			");
		}
	}
	else
	{
		echo "Erreur : URL $url introuvable <br />";
	}
}

$liste_pokemon->closeCursor();
echo "End from $numero_depart to $numero_actuel.";
?>