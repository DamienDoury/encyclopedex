<?php
include "../bdd.php";

function effacer_accents($texte)
{
	return preg_replace("#&([a-z])[a-z]+;#i", "$1", htmlentities($texte, ENT_NOQUOTES));
}

function surligner($texte, $pos, $len)
{
	$substr1 = ($pos == 0 ? "" : substr($texte, 0, $pos));
	$substr2 = substr($texte, $pos, $len);
	$substr3 = ($pos + $len >= strlen($texte) ? "" :  substr($texte, $pos + $len));
	
	return $substr1 . "<b>" . $substr2 . "</b>" . $substr3;
}

//Securites.

$bases[] = "pokemon";
$bases[] = "numero";
$bases[] = "capspe";
$bases[] = "type";
$bases[] = "attaque";

$cle = addslashes($_GET["cle"]);
$liste_pos = array();
$liste_len = array();
$liste_finale = array();

foreach($bases AS $base)
{
	if($base == "numero")
	{
		$liste_resultats = $bdd->query("
		SELECT id_pokemon AS 'nom', id_pokemon AS 'id'
		FROM pokemon
		WHERE id_pokemon LIKE '" . $cle . "'
		");
	}
	else if($base == "attaque")
	{
		$liste_resultats = $bdd->query("
		SELECT nom, id_attaque AS 'id', categorie
		FROM attaque
		WHERE nom LIKE '%" . $cle . "%'
		");
	}
	else
	{
		$liste_resultats = $bdd->query("
		SELECT nom, id_" . $base . " AS 'id'
		FROM " . $base . "
		WHERE nom LIKE '%" . $cle . "%'
		");
	}

	while($resultat_sql = $liste_resultats->fetch())
	{
		$cle = stripslashes($cle);
		$resultat = $resultat_sql["nom"];
		$liste_pos[] = stripos(effacer_accents($resultat), effacer_accents($cle));
		$liste_len[] = (preg_match("#^" . effacer_accents($resultat) . "$#i", effacer_accents($cle)) ? 100 : strlen($resultat)); // Si le terme trouve est exactement celui tape, alors on le place en premier.
		
		$resultat = preg_replace("# #", "&nbsp;", surligner($resultat, end($liste_pos), strlen($cle)));
		
		if($base == "type")
		{
			$resultat = "<img src='http://www.pokebip.com/pokemon/pokedex/images/gen5_types/" . $resultat_sql["id"] . ".png' alt='" . $resultat_sql["nom"] . "' />&nbsp;" . $resultat;
		}
		else if($base == "pokemon" || $base == "numero")
		{
			$resultat = "<img src='http://www.pokebip.com/pokemon/pokedex/images/gen5_miniatures/" . $resultat_sql["id"] . ".png' alt='" . $resultat_sql["id"] . "' />&nbsp;" . $resultat;
		}
		else if($base == "attaque")
		{
			if($resultat_sql["categorie"] == 1)
				$cat = "physical";
			else if($resultat_sql["categorie"] == 2)
				$cat = "special";
			else
				$cat = "none"; // Status actually...
			
			$resultat = "<img src='http://pokemon-index.com/webimages/" . $cat . ".png' />&nbsp;" . $resultat;
		}
		
		$liste_finale[] = "<div class='" . $base . "' data-val='" . $resultat_sql["id"] . "'>&nbsp;" . $resultat . "&nbsp;</div>";
	}

	$liste_resultats->closeCursor();
}

array_multisort($liste_pos, SORT_ASC, $liste_len, SORT_DESC, $liste_finale);
				
for($i = 0; $i < sizeof($liste_finale) && $i < 15; $i++)
	echo htmlspecialchars_decode(htmlentities(preg_replace("#<div#", "<div id='completion_" . $i . "' onclick='click_completion(\"" . $i . "\");'", $liste_finale[$i])));
?>