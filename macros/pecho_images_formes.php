<?php
include "../bdd.php";

set_time_limit(0);

$liste_formes = $bdd->query("
SELECT DISTINCT(id_forme) AS 'id_forme', id_pokemon, lien_image
FROM forme NATURAL JOIN stats_pokemon
");

while($pokemon = $liste_formes->fetch())
{
	$url = $pokemon["lien_image"];
	$img = "../images/pkmn/fixe/" . $pokemon["id_pokemon"] . "-" . $pokemon["id_forme"] . ".png";
	file_put_contents($img, file_get_contents($url));
}
?>

