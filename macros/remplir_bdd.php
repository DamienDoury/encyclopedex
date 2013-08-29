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
FROM pokemon
");

while($pokemon = $liste_pokemon->fetch()) // On parcourt la liste des Pokemon.
{
	if($pokemon["type1"] != 0 && $pokemon["type2"] != 0)
		continue;
		
	$page = file_get_contents($pokemon["pokebip"]); // On recupere la page Pokebip de ce Pokemon.

	if($page)
	{
		$page = preg_replace("#Descriptions du pok.+#s", "", $page);
		preg_match_all("#<img src=\"images/gen5_types/([0-9-]+).png\" alt=\"([0-9-]+)\"#", $page, $listeTemp); // On recupere la liste de ses types.
		
		$bdd->exec("
		UPDATE u381118947_pokedex.pokemon
		SET 
		type1 = '" . addslashes($listeTemp[1][0]) . "', 
		type2 = '" . addslashes($listeTemp[1][1]) . "'
		WHERE id_pokemon = '" . $pokemon["id_pokemon"] . "'
		");
	}
	else
	{
		echo "Erreur : URL $url introuvable <br />";
	}
}

$liste_pokemon->closeCursor();
echo "end";
?>