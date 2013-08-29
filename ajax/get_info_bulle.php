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

$pokemon = $liste_pokemon->fetch();

$nom = htmlentities($pokemon["nom"]);

if(preg_match("#Nidoran\?#", $nom)) // Cas particulier pour ce CONNARD de Nidoran.
	$nom = preg_replace("#\?#", ($_GET["id"] == 29 ? "&#9792;" : "&#9794;"), $nom);

	
echo '<p id="info_bulle_survol_txt" style="padding-bottom: 3px; margin: 0px;">' . $nom . '</p>
<img id="info_bulle_survol_img1" src="http://www.pokebip.com/pokemon/pokedex/images/gen5_types/' . $pokemon["type1"] . '.png" />
<img id="info_bulle_survol_img2" src="http://www.pokebip.com/pokemon/pokedex/images/gen5_types/' . $pokemon["type2"] . '.png" />';
					
$liste_pokemon->closeCursor();
?>