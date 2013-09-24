<?php
include "../bdd.php";

if($_GET["forme"] != "")
{
	$liste_pokemon = $bdd->query("
	SELECT *
	FROM pokemon NATURAL JOIN type_pokemon
	WHERE id_pokemon = '" . $_GET["id"] . "'
	AND (id_forme = '" . $_GET["forme"] . "'
	OR id_forme = '0')
	");
}
else
{
	$liste_pokemon = $bdd->query("
	SELECT *
	FROM pokemon NATURAL JOIN type_pokemon
	WHERE id_pokemon = '" . $_GET["id"] . "'
	");
}

$lang = $_COOKIE["lang"];
$pokemon = $liste_pokemon->fetch();
$nom = htmlentities($pokemon["nom_" . $lang]);

if(preg_match("#Nidoran\?#", $nom)) // Cas particulier pour ce CONNARD de Nidoran.
	$nom = preg_replace("#\?#", ($_GET["id"] == 29 ? "&#9792;" : "&#9794;"), $nom);

echo '<p>' . $nom . '</p>
<a style="background: url(\'/images/pkmn/type/' . $lang . '/type_spritesheet.png\') no-repeat 0px -' . (14 * floor(max($pokemon["type1"], 0))) . 'px;" />&nbsp;</a>';

if($pokemon["type2"] != "-1")
	echo '<a style="background: url(\'/images/pkmn/type/' . $lang . '/type_spritesheet.png\') no-repeat 0px -' . (14 * floor(max($pokemon["type2"], 0))) . 'px;" />&nbsp;</a>';
					
$liste_pokemon->closeCursor();
?>