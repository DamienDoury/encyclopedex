<?php
/*
		~~~ CHARTE ~~~
#Liste de criteres de recherches :
- Depuis une base :
	+ Nom pokemon \ renvoi direct sur la fiche
	+ ID pokemon  /
	+ Nom type      \
	+ Nom cap. spe.  > Il faut combiner ces parametres avec des ET, OU et priorites (parentheses). De base c'est un ET entre les attaques, un OU entre les cap. spe. et un ET avec les types.
	+ Nom attaque   /
- Mot cle :
	- Categorie attaque (Physique, Special ou Statut)
	- Type attaque (Feu, Sol, etc.)
	- Puissance attaque
	- Priorite attaque
	
	- Precision attaque ?
	- PP attaque ?
	- Effet attaque ? <= ce serait bien.
	- Probabilite effet attaque ?
	
#Liste des criteres de tri (sur fond bleu ou bordure differente):
- Depuis une base :
	+ Base values
	+ Alphabetique
	+ Numerique
	=> L'ordre d'entree des parametres determine la priorite de classement. De base, le classement est numerique.

Sinon, en SQL ca donne grosierrement ca :
SELECT CONCAT (id_pokemon, ".", id_forme)
FROM capspe_pokemon
WHERE (id_capspe_1 =89
OR id_capspe_2 =89
OR id_capspe_3 =89)
AND  
(
    SELECT GROUP_CONCAT(CONCAT (id_pokemon, ".", id_forme))
    FROM type_pokemon
    WHERE type1 =6
    OR type2 =6
) LIKE CONCAT("%", IF(id_forme = 0, id_pokemon, CONCAT (id_pokemon, ".", id_forme)), "%")
*/

include "../bdd.php";

function intersection_formes(&$a, &$b)
{
	// Ca ne marche pas dans ce sens.
	foreach($a AS $elem)
	{
		if($elem[1] != 0) // Si on a affaire a une forme particuliere.
		{
			if(in_array(array($elem[0], 0), $b)) // Et si l'autre tableau contient la forme de base.
			{
				$b[] = $elem; // Alors on ajoute la forme particuliere dans l'autre tableau.
			}
		}
	}
	
	foreach($b AS $elem)
	{
		if($elem[1] != 0) // Si on a affaire a une forme particuliere.
		{
			if(in_array(array($elem[0], 0), $a)) // Et si l'autre tableau contient la forme de base.
			{
				$a[] = $elem; // Alors on ajoute la forme particuliere dans l'autre tableau.
			}
		}
	}
}

function user_custom_sort($liste_pokemon, &$liste_ordres, $bdd)
{				
	if(empty($liste_ordres))
	{
		array_multisort($liste_pokemon, SORT_ASC); // Tri par ID.
		return $liste_pokemon;
	}
	
	$liste_identites = array();
	foreach($liste_pokemon AS $pokemon)
	{
		$liste_identites[] = $pokemon[0] . "." . $pokemon[1];
	}
	
	$liste_stats = array();
	
	for($i = 0; $i < sizeof($liste_ordres); $i++)
	{
		$liste_stats[] = preg_replace("#( ASC| DESC)#", "", $liste_ordres[$i]);
	}
	
	$liste_stats = array_unique($liste_stats);
	
	$liste_triee_sql = $bdd->query("
	SELECT DISTINCT(id_pokemon), id_forme, " . implode(",", $liste_stats) . "
	FROM stats_pokemon
	WHERE CONCAT(id_pokemon, '.', id_forme) IN (" . implode(",", $liste_identites) . ")
	ORDER BY " . implode(",", $liste_ordres) . "
	");
	
	$liste_ordres = $liste_stats; // On a plus besoin de la liste ordre alors on l'ecrase (ca permet de renvoyer un deuxieme parametre).

	return $liste_triee_sql->fetchAll(PDO::FETCH_NUM);
}

$liste_categories = (trim($_POST["cat"]) == "" ? array() : explode(",", addslashes($_POST["cat"])));
$liste_valeurs = (trim($_POST["val"]) == "" ? array() : explode(",", addslashes($_POST["val"])));

//Ici il faudrait fusionner les tableaux cat et val et le trier.
if(empty($liste_categories))
{
	$liste_pokemon_sql = $bdd->query("
	SELECT DISTINCT(id_pokemon), '0' AS 'id_forme'
	FROM pokemon
	ORDER BY id_pokemon
	");
	
	$liste_pokemon = $liste_pokemon_sql->fetchAll(PDO::FETCH_NUM);
}
else
{
	foreach($liste_categories AS $cat)
	{
		if($cat == "numero" || $cat == "pokemon")
			$liste_priorites[] = 1;
		else if($cat == "capspe")
			$liste_priorites[] = 2;
		else if($cat == "carac_attaque")
			$liste_priorites[] = 3;
		else if($cat == "stat")
			$liste_priorites[] = 5;
		else
			$liste_priorites[] = 4;
	}

	$liste_ordres = array();
	for($i = 0; $i < sizeof($liste_valeurs); $i++)
	{
		if($liste_categories[$i] == "stat")
		{
			preg_match("#^[a-z+*]+#i", $liste_valeurs[$i], $matches);
			$liste_ordres[] = strtolower($matches[0]) . " " . (preg_match("#<#", $liste_valeurs[$i]) ? "ASC" : "DESC");
		}
	}
	
	array_multisort($liste_priorites, SORT_ASC, $liste_categories, $liste_valeurs);

	// Mise en forme de "carac_attaque".
	$premiere_caracteristique = -1;
	for($i = 0; $i < sizeof($liste_priorites); $i++)
	{
		if($liste_priorites[$i] == 3)
		{
			if($premiere_caracteristique == -1)
			{
				$premiere_caracteristique = $i;
			}
			else
			{
				$liste_valeurs[$premiere_caracteristique] .= " AND " . $liste_valeurs[$i];
				unset($liste_priorites[$i]);
				unset($liste_categories[$i]);
				unset($liste_valeurs[$i]);
				$i--;
			}
		}
	}
	
	$liste_pokemon = array();
	$liste_pokemon_temp = array();

	$changement_priorite = true;
	$premier_critere = true;

	$i = 0;
	foreach($liste_categories AS $cat)
	{
		$id = $liste_valeurs[$i];

		if($cat == "numero")
		{
			$cat = "pokemon";
		}
		
		if($cat == "type")
		{
			$liste_resultats = $bdd->query("
			SELECT DISTINCT(id_pokemon) AS 'id', id_forme
			FROM type_pokemon
			WHERE type1 = '" . $id . "'
			OR type2 = '" . $id . "'
			");
		}
		else if($cat == "capspe")
		{
			$liste_resultats = $bdd->query("
			SELECT DISTINCT(id_pokemon) AS 'id', id_forme
			FROM capspe_pokemon
			WHERE id_capspe_1 = '" . $id . "'
			OR id_capspe_2 = '" . $id . "'
			OR id_capspe_3 = '" . $id . "'
			");
		}
		else if($cat == "pokemon")
		{
			$liste_resultats = $bdd->query("
			SELECT DISTINCT(id_pokemon) AS 'id', '0' AS 'id_forme'
			FROM pokemon
			WHERE id_pokemon = '" . $id . "'
			");
		}
		else if($cat == "stat")
		{
			$liste_resultats = $bdd->query("
			SELECT DISTINCT(id_pokemon) AS 'id', id_forme
			FROM stats_pokemon
			WHERE " . (preg_match("#[+<>=]#", $id) ? $id : '1') . "
			");
		}
		else if($cat == "carac_attaque")
		{
			$liste_resultats = $bdd->query("
			SELECT DISTINCT(id_pokemon) AS 'id', id_forme
			FROM attaque_pokemon NATURAL JOIN attaque
			WHERE " . $id . "
			");
		}
		else
		{
			$liste_resultats = $bdd->query("
			SELECT DISTINCT(id_pokemon) AS 'id', id_forme
			FROM " . $cat . "_pokemon
			WHERE id_" . $cat . " = '" . $id . "'
			");
		}

		$temp = $liste_resultats->fetchAll(PDO::FETCH_NUM);
		
		if($changement_priorite)
		{
			$liste_pokemon_temp = $temp;
			$changement_priorite = false;
		}
		else
		{
			/*
			NOTE :
			On serialize le tableau car array_unique ne fonctionne pas avec les tableaux multidimensionnels.
			De meme pour la fonction array_intersect.
			*/
			
			// Gestion a l'interieur d'un niveau de priorite.
			if($cat == "attaque" || $cat == "type" || $cat == "stat" || $cat == "carac_attaque")
			{
				intersection_formes($liste_pokemon_temp, $temp);
				$liste_pokemon_temp = array_map("unserialize", array_intersect(array_map("serialize", $liste_pokemon_temp), array_map("serialize", $temp))); // Condition ET.
			}
			else if($cat == "pokemon" || $cat == "capspe")
			{
				$liste_pokemon_temp = array_map("unserialize", array_unique(array_map("serialize", array_merge($liste_pokemon_temp, $temp)))); // Condition OU.
			}
			else
			{
				echo "WTF??";
			}
		}

		// Gestion entre les priorites.
		if(($i + 1 < sizeof($liste_priorites) && $liste_priorites[$i] != $liste_priorites[$i + 1]) || $i == sizeof($liste_priorites) - 1)
		{
			if($premier_critere) // Si c'est la premiere priorite, on la recupere sans condition.
			{
				$liste_pokemon = $liste_pokemon_temp;
				$premier_critere = false;
			}
			else
			{
				intersection_formes($liste_pokemon, $liste_pokemon_temp);
				$liste_pokemon = array_map("unserialize", array_intersect(array_map("serialize", $liste_pokemon), array_map("serialize", $liste_pokemon_temp))); // Condition ET.
			}

			unset($liste_pokemon_temp);
			$liste_pokemon_temp = array();

			$changement_priorite = true;
		}
		
		$i++;
	}
				
	if(!empty($liste_pokemon))
		$liste_pokemon = user_custom_sort($liste_pokemon, $liste_ordres, $bdd);
}

$sortie = "";

foreach($liste_pokemon AS $pokemon) // On parcourt la liste des Pokemon.
{
	$forme = $pokemon[1];
	$id = $pokemon[0];
	
	$img = "/images/pkmn/fixe/" . $id . ($forme == 0 ? "" : "-" . $forme) . ".png";
	
	if(sizeof($liste_ordres) > 0 || !preg_match("#id='" . $id . "'#", $sortie)) // Permet de n'afficher qu'un seul pokemon par forme sauf lors d'un tri special.
	{
		$sortie .= "<div id='" . $id . "' class='resultat'" . ($forme != 0 ? " data-forme='" . $forme . "' data-iteration='" . (!preg_match("#id='" . $id . "'#", $sortie) ? "first" : "") . "'" : "") . ">
			<img src='" . $img . "' alt='#" . $id . "' />";
		
		if(sizeof($pokemon) > 2) // Si le l'objet pokemon contient des informations autres que l'id et la forme, on les affiche.
		{
			$sortie .= "<div><a>&nbsp;</a>";
			
			for($i = 2; $i < sizeof($pokemon); $i++)
				$sortie .= "<a>" . $liste_ordres[$i - 2] . "&nbsp;" . $pokemon[$i] . "</a>";
			
			$sortie .= "</div>";
		}
		
		$sortie .= "</div>";
	}
}

echo $sortie;
?>