<!--
Voici le projet dans un premier temps :
- le dresseur peut renseigner jusqu'à 6 Pokémons
- après validation, on recharge la page et on donne la liste de leurs faiblesses (au niveau des types)
- éventuellement, on fait une liste des Pokémons les plus dangereux face à cette équipe

Par la suite, on pourra renseigner la liste des attaques dans le but de donner une liste d'adversaires qui résisteront bien aux attaques.
On pourra renforcer cette analyse en renseignant la capacité spéciale ainsi que l'objet porté (voire les EV et les IV).
Le programme sera alors complet lorsqu'il sera capable d'analyser tous ces paramètres et de dresser une liste de points forts et de points faibles.
-->

<!--
Idées d'amélioration du moteur de recherche :
- Pouvoir régler les options comme la sélection instantanée
- Recherche par types (on éclate le filtre au niveau des espaces)
- Recherche par capacité spéciale, attaques, ...
- Afficher le nom, les types et les capacités spéciales d'un Pokémon au passage de la souris sur son image
- Pouvoir accéder à la fiche Pokébip par clic droit
- Optimiser la vitesse d'affichage des résultats instantannés (fluide sous Opera mais lent sous les autres navigateurs)
-->

<?php
//Récupération de la liste des Pokémons.
$temp_pokedex = file("dossier/bdd.csv");

$i = 0;
foreach($temp_pokedex as $line)
{
	$pokedex[$i] = preg_split("#;#", $line);
	$i++;
}
//Fin récupération de la liste des Pokémons.
?>
			




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

    <head>
        <title>Analyse</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript">		
		function modif_image(place_pokemon)
		{
			//On met l'image à jour.
			if(document.getElementById(place_pokemon).value == "") 
			{
				document.getElementById(place_pokemon.substr(0,8)+"_image").src = "http://domergo.kegtux.org/images/icones/vide.png";
			}
			else 
			{
				document.getElementById(place_pokemon.substr(0,8)+"_image").src = "http://www.pokebip.com/pokemon/pokedex/images/gen4_general/"+document.getElementById(place_pokemon).selectedIndex+".png";
			}
			
			place = parseInt(place_pokemon.substr(7,1));
			
			//On affiche un nouvel emplacement de sélection.
			if(place < 6 && document.getElementById(place_pokemon).value != "")
			{
				document.getElementById(place_pokemon.substr(0,7)+(place+1)).style.display = "block";
			}
			else if(document.getElementById(place_pokemon).value == "")
			{
				//Si un "vide" est créé au milieu de la liste, on décale la sélection et les images.
				for(i = parseInt(place); i < 6; i++)
				{
					document.getElementById(place_pokemon.substr(0,7)+parseInt(i)+"_select").selectedIndex = document.getElementById(place_pokemon.substr(0,7)+parseInt(i+1)+"_select").selectedIndex;
					
					document.getElementById(place_pokemon.substr(0,7)+parseInt(i)+"_image").src = document.getElementById(place_pokemon.substr(0,7)+parseInt(i+1)+"_image").src;
				}

				//On supprime le dernier cadre.
				document.getElementById(place_pokemon.substr(0,7)+6+"_select").selectedIndex = 0;
				document.getElementById(place_pokemon.substr(0,7)+6+"_image").src = "http://domergo.kegtux.org/images/icones/vide.png";

				i = 6;
				while(i > 0 && document.getElementById(place_pokemon.substr(0,7)+i+"_select").selectedIndex == 0) i--;
				
				i++;
				document.getElementById(place_pokemon.substr(0,7)+i+"_select").selectedIndex = 0;
				document.getElementById(place_pokemon.substr(0,7)+i+"_image").src = "http://domergo.kegtux.org/images/icones/vide.png";
				
				i++;
				document.getElementById(place_pokemon.substr(0,7)+i+"_select").selectedIndex = 0;
				document.getElementById(place_pokemon.substr(0,7)+i+"_image").src = "http://domergo.kegtux.org/images/icones/vide.png";
				document.getElementById(place_pokemon.substr(0,7)+i).style.display = "none";
			}
			
			//On cache le bouton de validation si rien n'est sélectionné.
			if(document.getElementById(place_pokemon.substr(0,7)+1+"_select").selectedIndex == 0) document.getElementById("bouton_validation").style.display = "none";
			else document.getElementById("bouton_validation").style.display = "block";
		}
		
		function afficher_cadre_infos(place_pokemon)
		{
			//document.getElementById(place_pokemon).style.display = "block";
			$("#" + place_pokemon).slideToggle();
		}
		
		function cacher_cadre_infos(place_pokemon)
		{
			//document.getElementById(place_pokemon).style.display = "none";
			$("#" + place_pokemon).slideToggle();
		}
		</script>
    </head>
	
    <body style="background-color: #8FD0D0;"> <!--onload="window.setTimeout ('history.go (0)',5000)"   pour recharger toutes les 5 secondes !   -->
		<div id="total" style="margin: auto; text-align: center;">
			<center>

				<?php
				if(isset($_GET['pokemon1_select']) && $_GET['pokemon1_select'] != "" && $_GET['pokemon1_select'] > 0)
				{
					$id_types["Acier"]  = 0;
					$id_types["Combat"] = 1;
					$id_types["Dragon"] = 2;
					$id_types["Eau"]    = 3;
					$id_types["Electr"] = 4;
					$id_types["Feu"]    = 5;
					$id_types["Glace"]  = 6;
					$id_types["Insect"] = 7;
					$id_types["Normal"] = 8;
					$id_types["Plante"] = 9;
					$id_types["Poison"] = 10;
					$id_types["Psy"]    = 11;
					$id_types["Roche"]  = 12;
					$id_types["Sol"]    = 13;
					$id_types["Spectr"] = 14;
					$id_types["Tenebr"] = 15;
					$id_types["Vol"]    = 16;
					$id_types[""]    	= 17;

					//Génération du Pokédex
					$temp_pokedex = file("dossier/bdd.csv");
								
					$i = 0;
					foreach($temp_pokedex as $line)
					{
						$pokedex[$i] = preg_split("#;#", $line); //Nom; Type1; Type2; Vide (saut de ligne).
						$i++;
					}
					//Fin génération du pokédex
					
					//Génération de la table des types
					$temp_tab = file("dossier/types.csv");

					$i = 0;
					foreach($temp_tab as $line)
					{
						$table_types[$i] = preg_split("#[\t;]#", $line);
						$i++;
					}
					
					for($i = 0; $i <= 16; $i++) $table_types[17][$i] = 1;
					//Fin génération de la table des types
					
					 //Récupération et mise en forme des données de l'équipe sélectionnée précédemment.
					$equipe = array();
					for($i = 1; $i <= 6; $i++)
					{
						if(isset($_GET["pokemon" . $i . "_select"]) && $_GET["pokemon" . $i . "_select"] != "" && $_GET["pokemon" . $i . "_select"] > 0)
						{
							$equipe[$i]["nom"] = $pokedex[$_GET["pokemon" . $i . "_select"] - 1][0];
							$equipe[$i]["numero"] = $_GET["pokemon" . $i . "_select"];
							$equipe[$i]["type1"] = $pokedex[$_GET["pokemon" . $i . "_select"] - 1][1];
							$equipe[$i]["type2"] = $pokedex[$_GET["pokemon" . $i . "_select"] - 1][2];
							$equipe[$i]["nombre_immunites"] = 0;
							$equipe[$i]["nombre_grandes_resistances"] = 0;
							$equipe[$i]["nombre_resistances"] = 0;
							$equipe[$i]["nombre_faiblesses"] = 0;
							$equipe[$i]["nombre_grandes_faiblesses"] = 0;
							
							$type1 = $id_types[$equipe[$i]["type1"]];
							$type2 = $id_types[$equipe[$i]["type2"]];
							
							for($numero_type = 0; $numero_type <= 16; $numero_type++)
							{
								$equipe[$i]["sensibilites"][$numero_type] = $table_types[$type1][$numero_type] * $table_types[$type2][$numero_type];
								
								if($equipe[$i]["sensibilites"][$numero_type] == 0)
									$equipe[$i]["nombre_immunites"]++;
								elseif($equipe[$i]["sensibilites"][$numero_type] == 0.25)
									$equipe[$i]["nombre_grandes_resistances"]++;
								elseif($equipe[$i]["sensibilites"][$numero_type] == 0.5)
									$equipe[$i]["nombre_resistances"]++;
								elseif($equipe[$i]["sensibilites"][$numero_type] == 2)
									$equipe[$i]["nombre_faiblesses"]++;
								elseif($equipe[$i]["sensibilites"][$numero_type] == 4)
									$equipe[$i]["nombre_grandes_faiblesses"]++;
							}
						}
					}
					//Fin récupération et mise en forme des données de l'équipe sélectionnée précédemment.
					
					//Insertion des images.
					echo "<div align='left' style='background-color: #FFD6AE; width: 330px; height: 140px; padding: 10px; margin: 10px; border-style: outset; border-width: 1px;'>
					";

					for($i = 6; $i >= 1; $i--)
					{
						if(!isset($equipe[$i]["numero"])) continue;
						
						$zeros = "";
						if($equipe[$i]["numero"] < 10)
							$zeros = "00";
						elseif($equipe[$i]["numero"] < 100)
							$zeros = "0";
									
						echo "<div style='position: absolute; ";
						
						if($i == 6) echo "margin-left: 250px; margin-top: 0px;";
						elseif($i == 5) echo "margin-left: 0px; margin-top: 20px;";
						elseif($i == 4) echo "margin-left: 200px; margin-top: 20px";
						elseif($i == 3) echo "margin-left: 50px; margin-top: 40px;";
						elseif($i == 2) echo "margin-left: 150px; margin-top: 40px;";
						elseif($i == 1) echo "margin-left: 100px; margin-top: 60px;";
						
						echo "' onmouseover='afficher_cadre_infos(\"equipe" . $i . "\")' onmouseout='cacher_cadre_infos(\"equipe" . $i . "\")' onclick=\"document.location.href = 'http://www.pokebip.com/pokemon/pokedex/index.php?phppage=recherche&req=%23" . $zeros . $equipe[$i]["numero"] . "&submit=Go+%21'\">
						<img src='http://www.pokebip.com/pokemon/pokedex/images/gen4_general/" . $equipe[$i]["numero"] . ".png' alt='" . $i . "' style='position: absolute;' />
						</div>
						";				
					}
					echo "</div>";
					//Fin insertion des images.
					
					//Insertion des données individuelles sur la page.
					$i = 1;
					foreach($equipe as $pokemon)
					{
						echo "<div id='equipe" . $i . "' style='background-color: #FFEAA4; display: none; padding: 10px; margin: 10px; width: 330px; border-style: outset; border-width: 1px;'>
							<p> 
								" . $pokemon["nom"] . "
							</p>
							
							<p>
								Type : 
								<img src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" . ($id_types[$pokemon["type1"]] + 1) . ".png' />
								<img src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" . ($id_types[$pokemon["type2"]] + 1) . ".png' />
							</p>";
							
							if($pokemon["nombre_immunites"] > 0)
							{
								echo "<p>";
								if($pokemon["nombre_immunites"] > 1) echo "Immunit&eacute;s : "; else echo "Immunit&eacute; : ";
								for($type = 0; $type <= 16; $type++) if($pokemon["sensibilites"][$type] == 0) echo "<img src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" . ($type + 1) . ".png' /> ";
								echo "</p>";
							}
							
							if($pokemon["nombre_grandes_resistances"] > 0)
							{
								echo "<p>";
								if($pokemon["nombre_grandes_resistances"] > 1) echo "Grandes r&eacute;sistances : "; else echo "Grande r&eacute;sistance : ";
								for($type = 0; $type <= 16; $type++) if($pokemon["sensibilites"][$type] == 0.25) echo "<img src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" . ($type + 1) . ".png' /> ";
								echo "</p>";
							}
							
							if($pokemon["nombre_resistances"] > 0)
							{
								echo "<p>";
								if($pokemon["nombre_resistances"] > 1) echo "R&eacute;sistances : "; else echo "R&eacute;sistance : ";
								for($type = 0; $type <= 16; $type++) if($pokemon["sensibilites"][$type] == 0.5) echo "<img src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" . ($type + 1) . ".png' /> ";
								echo "</p>";
							}
							
							if($pokemon["nombre_faiblesses"] > 0)
							{
								echo "<p>";
								if($pokemon["nombre_faiblesses"] > 1) echo "Faiblesses : "; else echo "Faiblesse : ";
								for($type = 0; $type <= 16; $type++) if($pokemon["sensibilites"][$type] == 2) echo "<img src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" . ($type + 1) . ".png' /> ";
								echo "</p>";
							}
							
							if($pokemon["nombre_grandes_faiblesses"] > 0)
							{
								echo "<p>";
								if($pokemon["nombre_grandes_faiblesses"] > 1) echo "Grandes faiblesses : "; else echo "Grande faiblesse : ";
								for($type = 0; $type <= 16; $type++) if($pokemon["sensibilites"][$type] == 4) echo "<img src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" . ($type + 1) . ".png' /> ";
								echo "</p>";
							}
							
						echo "</div>";
						
						$i++;
					}
					//Fin insertion des données individuelles sur la page.
					
					//Insertion des données équipe sur la page.
					echo "<div id='equipe' style='background-color: #D3E895; display: block; padding: 10px; margin: 10px; width: 330px; border-style: outset; border-width: 1px;'>
						<p> 
							&Eacute;quipe : 
						</p>";

						//Recherche de type sans résistance dans l'équipe.
					$premiere_fois = true;
					for($type = 0; $type <= 16; $type++)
					{
						$resistance = false;
						foreach($equipe as $pokemon)
						{
							if($pokemon["sensibilites"][$type] < 1)
							{
								$resistance = true;
								break;
							}
						}
						
						if($resistance == false)
						{
							if($premiere_fois == true)
							{
								$premiere_fois = false;
								echo "<p>Aucune r&eacute;sistance : ";
							}
							
							echo "<img src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" . ($type + 1) . ".png' /> ";
						}
					}
					
					if($premiere_fois == false) echo "</p>";
					
						//Recherche de type auquel toute l'équipe est faible.
					$premiere_insertion = true;
					for($type = 0; $type <= 16; $type++)
					{
						$faiblesse_equipe = true;
						foreach($equipe as $pokemon)
						{
							if($pokemon["sensibilites"][$type] < 2)
							{
								$faiblesse_equipe = false;
								break;
							}
						}
						
						if($faiblesse_equipe == true)
						{
							if($premiere_insertion == true)
							{
								$premiere_insertion = false;
								echo "<p>Faiblesse &eacute;quipe : ";
							}
							
							echo "<img src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" . ($type + 1) . ".png' /> ";
						}
					}
					
					if($premiere_fois && $premiere_fois) echo "<p>Aucun point faible.";
					if($premiere_fois == false) echo "</p>";
					
					echo "</div>";
					//Fin insertion des données équipe sur la page.
				}
				?>

				
				
				<!-- //Décoration inutile mais jolie :
				<div style='width: 330px; height: 140px; padding: 10px; margin: 10px;'>		
				<img src="http://www.pokebip.com/pokemon/pokedex/images/gen4_general/6.png"   style="position: absolute; margin-left: 250px; margin-top: 0px;"  alt="6"/>
				<img src="http://www.pokebip.com/pokemon/pokedex/images/gen4_general/149.png" style="position: absolute; margin-left: 0px; margin-top: 20px;" alt="5" />
				<img src="http://www.pokebip.com/pokemon/pokedex/images/gen4_general/306.png" style="position: absolute; margin-left: 200px; margin-top: 20px;" alt="4" />
				<img src="http://www.pokebip.com/pokemon/pokedex/images/gen4_general/348.png" style="position: absolute; margin-left: 50px; margin-top: 40px;" alt="3" />
				<img src="http://www.pokebip.com/pokemon/pokedex/images/gen4_general/59.png"  style="position: absolute; margin-left: 150px; margin-top: 40px;" alt="2" />
				<img src="http://www.pokebip.com/pokemon/pokedex/images/gen4_general/34.png"  style="position: absolute; margin-left: 100px; margin-top: 60px;" alt="1" />
				</div>
				-->
			
				<?php
				/*echo "<pre>";
				echo "<h1>_GET :</h1><br/>";
				print_r($_GET);
				echo "<h1>_POST :</h1><br/>";
				print_r($_POST);
				echo "<h1>_SERVER :</h1><br/>";
				print_r($_SERVER);
				echo "<h1>_SESSION :</h1><br/>";
				print_r($_SESSION);
				echo "<h1>_COOKIE :</h1><br/>";
				print_r($_COOKIE);
				echo "</pre>";*/
				?>
			</center>
		</div>
    </body>
	
</html>