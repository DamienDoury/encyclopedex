<!--
Idées d'amélioration du moteur de recherche :
- Section d'aide proche du champ de recherche.
- (Recherche par capacité spéciale, attaques, ...)
- Optimiser la vitesse d'affichage des résultats instantannés (fluide sous Opera mais lent sous les autres navigateurs).
  Par exemple, avant d'afficher une image, on pourra aller voir son état stocké dans une variable plutot que de le lire dans la page.
- Enregistrer les préférences dans des cookies.
- Pouvoir régler les options comme la sélection instantanée :
	- au moins un mot (condition OU entre les termes de la recherche)
	OU 
	- tous les mots (condition ET entre les termes de la recherche)
	+ <br />
	- sélection automatique ON/OFF : active le choix des 2 options suivantes
	+ <br />
	- mode recherche : quand il ne reste qu'un seul résultat, sa fiche Pokébip est automatiquement ouverte dans un autre onglet.
	OU
	- mode sélection (recrutement) : quand il ne reste qu'un seul résultat, le Pokémon est automatiquement ajouté à l'équipe. Quand l'équipe est constituée de 6 Pokémon, la page d'analyse est automatiquement lancée dans la page courante.
	
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
        <title>Recherche</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript">
		
		critere_et = true;
		selection_auto = true;
		mode_recherche = true;
		
		<?php
		echo "pokedex_nom = new Array; pokedex_type1 = new Array; pokedex_type2 = new Array;";
		for($x = 1; $x <= 493; $x++)
		{
			echo "pokedex_nom[" . $x . "] = '" . $pokedex[$x-1][0] . "';
			";
			echo "pokedex_type1[" . $x . "] = '" . $pokedex[$x-1][1] . "';
			";
			echo "pokedex_type2[" . $x . "] = '" . $pokedex[$x-1][2] . "';
			";
		}
		?>
		
		id_types = new Array;
		id_types["Acier"]  = 1;
		id_types["Combat"] = 2;
		id_types["Dragon"] = 3;
		id_types["Eau"]    = 4;
		id_types["Electr"] = 5;
		id_types["Feu"]    = 6;
		id_types["Glace"]  = 7;
		id_types["Insect"] = 8;
		id_types["Normal"] = 9;
		id_types["Plante"] = 10;
		id_types["Poison"] = 11;
		id_types["Psy"]    = 12;
		id_types["Roche"]  = 13;
		id_types["Sol"]    = 14;
		id_types["Spectr"] = 15;
		id_types["Tenebr"] = 16;
		id_types["Vol"]    = 17;
		id_types[""]       = 18;
			
		nombre_selections = 0;

		function recherche(e)
		{
			touche = window.event ? e.keyCode : e.which;
			if(touche == 13 || touche == 10) analyser_equipe();
			
			id_retourne = filtrer();
			if(id_retourne > 0 && selection_auto && !mode_recherche)
			{
				document.getElementById("filtre").value = "";
				switch_selection(id_retourne);
			}
			
			if(id_retourne > 0 && selection_auto && mode_recherche)
			{
				if(id_retourne < 10) zeros = "00";
				else if(id_retourne < 100) zeros = "0";
				else zeros = "";
						
				window.open("http://www.pokebip.com/pokemon/pokedex/index.php?phppage=recherche&req=%23" + zeros + id_retourne + "&submit=Go+%21");
				document.getElementById("filtre").value = "";
				filtrer();
			}
		}
		
		function filtrer()
		{
			resultat = 0;
			
			filtre = document.getElementById("filtre").value;
			filtre_explose = filtre.split(/[,\/_;&+ ]+/);
			
			liste_filtres = new Array;
			for(i = 0; i < filtre_explose.length; i++)
			{
				if(i > 0 && filtre_explose[i] == "") break; //Pour éviter d'afficher tous les résultats quand la requete se termine par un espace et la condition OU. 
				
				liste_filtres[i] = new RegExp(/ /);
				if(filtre_explose[i].match(/[A-Z]/))
					liste_filtres[i].compile(filtre_explose[i]);
				else
					liste_filtres[i].compile(filtre_explose[i], "i");
			}
			
			if(critere_et) nombre_caches = 0;
			else nombre_caches = 0;
			
			for(i = 1; i <= 493; i++)
			{
				if(i < 10) texte = "00";
				else if(i < 100) texte = "0";
				else texte = "";
				
				//for(rang = 0; rang < 3; rang++) //on parcourt les 3 dimensions du pokédex OU ON LES CONCATENE DANS 'TEXTE'.
				texte = texte + i + " " + pokedex_nom[i] + " " + pokedex_type1[i] + " " + pokedex_type2[i];
				
				for(mot = 0; mot < liste_filtres.length; mot++)
				{
					if(liste_filtres[mot].test(texte) || document.getElementById('selection_' + i).style.backgroundImage != "") //changer le document... par stockage dans une variable.
					{
						//if(pas déjà affiché) //pour optimisation(stockage dans une variable).
						document.getElementById('selection_' + i).style.display = "block";
						
						if(document.getElementById('selection_' + i).style.backgroundImage == "")
						{
							if(mot == liste_filtres.length - 1) resultat = i; //On enregistre le résultat que si on est dans la dernière expression et que l'image va etre affichée.
						}
						
						if(!critere_et)
						{
							//nombre_caches++;
							break //On met un break ici pour une condition OU.
						}
					}
					else
					{
						//if(pas déjà caché) //pour optimisation (stockage dans une variable).
						document.getElementById('selection_' + i).style.display = "none";
						
						if(critere_et)
						{
							nombre_caches++;
							break //On met un break ici pour une condition ET.
						}
						else
						{
							if(mot == liste_filtres.length - 1) nombre_caches++;
						}
					}
				}
			}
			
			if(critere_et) afficher_nombre_resultats(493 - nombre_caches);
			else afficher_nombre_resultats(493 - nombre_caches);
			
			if(nombre_caches == 492 - nombre_selections) return resultat;
			else return -1;
		}
		
		function afficher_nombre_resultats(nombre)
		{
			var texte = "";
			if(nombre == 0) texte += "Aucun r&eacute;sultat ";
			else if(nombre == 1) texte += "1 seul r&eacute;sultat ";
			else texte +=  (493 - nombre_caches) + " r&eacute;sultats ";
			
			if(nombre_selections == 1) texte += "(dont 1 s&eacute;lectionn&eacute;)";
			else if(nombre_selections > 1) texte += "(dont " + nombre_selections + " s&eacute;lectionn&eacute;s)";
			
			document.getElementById("nombre_resultats_recherche").innerHTML = texte;
		}
		
		function touche_entree(event) //Cette fonction n'est pas de moi, mais elle ne ressemble en rien à la fonction de base. http://www.developpez.net/forums/d363556/webmasters-developpement-web/javascript/desactiver-touche-entree-formulaire/
		{
			// Compatibilité IE / Firefox
			if(!event && window.event)
			{
				event = window.event;
			}
			// IE
			if(event.keyCode == 13)
			{
				event.returnValue = false;
				event.cancelBubble = true;
			}
			// DOM
			if(event.which == 13)
			{
				event.preventDefault();
				event.stopPropagation();
			}
		}
		
		function analyser_equipe()
		{
			if(nombre_selections > 0)
			{
				document.getElementById("filtre").value = "";
				filtrer();
				document.getElementById("equipe").submit();
			}
			else
			{
				alert("Veuillez s\351lectionner au moins 1 Pok\351mon avant d'acc\351der \340 la page d'analyse.");
			}
		}
		
		function switch_selection(id)
		{
			if(document.getElementById('selection_' + id).style.backgroundImage != "")
			{
				if(del_selection(id))
					switch_background(id);
			}
			else
			{
				if(add_selection(id))
					switch_background(id);
			}
			
			filtrer();
		}
		
		function switch_background(id)
		{
			if(document.getElementById('selection_' + id).style.backgroundImage == "")
				document.getElementById('selection_' + id).style.backgroundImage = "url(\"images/icones/select3.png\")";
			else
				document.getElementById('selection_' + id).style.backgroundImage = "";
		}
		
		function add_selection(id)
		{
			if(nombre_selections >= 6)
			{
				alert("Votre \351quipe ne peut d\351passer 6 Pok\351mon.\nVeuillez en retirer avant d'en ajouter d'autres.");
				return false;
			}
			nombre_selections++;
			document.getElementById("select" + nombre_selections).name = "pokemon" + nombre_selections + "_select";
			document.getElementById("select" + nombre_selections).value = id;
			if(nombre_selections >= 6 && selection_auto && !mode_recherche) document.getElementById("equipe").submit();
			return true;
		}
		
		function del_selection(id)
		{
			if(nombre_selections <= 0)
			{
				alert("Erreur, nombre n\351gatif.");
				return false;
			}
			
			for(i = 1; i <= 6; i++)
			{
				if(document.getElementById("select" + i).value == id)
				{
					for(j = i; j < nombre_selections; j++)
						document.getElementById("select" + j).value = document.getElementById("select" + (j+1)).value;
					
					for(k = nombre_selections; k <= 6; k++)
					{
						document.getElementById("select" + k).value = "";
						document.getElementById("select" + nombre_selections).name = "";
					}
					
					break;
				}
			}
			
			nombre_selections--;
			return true;
		}
		
		function gerer_reglages()
		{
			while(true)
			{
				if(document.getElementById("option_1").checked)
				{
					critere_et = true;
					document.getElementById('liste_reglages_2').style.display = 'block';
				}
				else
				{
					critere_et = false;
					document.getElementById('liste_reglages_3').style.display = 'none';
					document.getElementById('liste_reglages_2').style.display = 'none';
					break;
				}
				
				if(document.getElementById("option_3").checked)
				{
					selection_auto = true;
					document.getElementById('liste_reglages_3').style.display = 'block';
				}
				else
				{
					selection_auto = false;
					document.getElementById('liste_reglages_3').style.display = 'none';
					break;
				}
				
				if(document.getElementById("option_4").checked) mode_recherche = true;
				else mode_recherche = false;

				break;
			}
			
			recherche(event);
		}
		
		function afficher_infos_survol(id, event)
		{
			if(navigator.appName.match(/Microsoft/))
			{
				//alert("Ce site n'est pas concu pour Internet Explorer !");
				cursor = getCursor(event);
				document.getElementById("info_bulle_survol").style.position = "absolute";
				document.getElementById("info_bulle_survol").style.marginLeft = (cursor.x + 15) + "px";
				document.getElementById("info_bulle_survol").style.marginTop = (cursor.y + document.body.scrollTop + 15) + "px";
				document.getElementById("info_bulle_survol_txt").innerHTML = pokedex_nom[id];
				document.getElementById("info_bulle_survol").style.display = "block";
			}
			else
			{
				cursor = getCursor(event);
				document.getElementById("info_bulle_survol").style.left = (cursor.x + 15) + "px";
				document.getElementById("info_bulle_survol").style.top = (cursor.y + 15) + "px";
				document.getElementById("info_bulle_survol_txt").innerHTML = pokedex_nom[id];
				document.getElementById("info_bulle_survol").style.display = "block";
			}
		}
		
		function selectionner_type(id)
		{
			document.getElementById("info_bulle_survol_img1").src = "http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" + id_types[pokedex_type1[id]] + ".png";
			document.getElementById("info_bulle_survol_img2").src = "http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" + id_types[pokedex_type2[id]] + ".png";
		}
		
		function cacher_infos_survol(event)
		{
			document.getElementById("info_bulle_survol").style.display = "none";
			document.getElementById("info_bulle_survol_img1").src = "http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png";
			document.getElementById("info_bulle_survol_img2").src = "http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png";
		}
		
		function getCursor(e) //Cette fonction n'est pas de moi.
		{
			e = e || window.event;
			return {'x': e.clientX, 'y': e.clientY};
		}
		
		function derouler_affichage(id)
		{
			$("#" + id).slideToggle();
		}
		</script>
    </head>
	
    <body style="background-color: #8FD0D0; font-family: 'Tahoma', sans-serif; font-variant: small-caps; color: #792400;">
		<div id="info_bulle_survol" style="background-color: #FFEAA4; width: 90px; text-align: center; border-width: 1px; border-style: outset; border-color: black; margin: 0px; padding: 3px; font-size: 14px; position: fixed; display: none;" onclick="afficher_position_souris(event);">
					<p id="info_bulle_survol_txt" style="padding-bottom: 3px; margin: 0px;"></p>
					<img id="info_bulle_survol_img1" src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png' />
					<img id="info_bulle_survol_img2" src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png' />
				</div>
				<div id="total" style="margin: auto; text-align: center;">
			<center>
			
				<div style="display: none;">
				<?php
				for($i = 1; $i <= 18; $i++) echo "<img src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/" . $i . ".png' />";
				?>
				</div>
				
				<div style="margin: 0.5em;">
					<form id="equipe" method="get" action="analyse.php" target="_blank">
						<table oncontextmenu="derouler_affichage('reglages'); return false;">
							<tr>
								<td>
									<img src='images/icones/aide 32x32.png' onclick="derouler_affichage('aide');" />
								</td>
								
								<td>
									<input id="filtre" type="text" value="" onkeypress="touche_entree(event);" onkeyup="recherche(event);" style="width: 15em; text-align: center; background-color: transparent; border-style: dotted; border-width: 1px; border-color: black; font-size: 1em; font-variant: small-caps;"/>
								</td>
							
								<td>
									<img src='images/icones/valider 32x32.png' onclick="analyser_equipe();" />
								</td>
							</tr>
						</table>
						
						<input id="select1" type="hidden" name="" value="" />
						<input id="select2" type="hidden" name="" value="" />
						<input id="select3" type="hidden" name="" value="" />
						<input id="select4" type="hidden" name="" value="" />
						<input id="select5" type="hidden" name="" value="" />
						<input id="select6" type="hidden" name="" value="" />
						
					</form>
				</div>
				
				<script type="text/javascript">
					document.getElementById("filtre").value = "";
					document.getElementById("filtre").focus();
				</script>
				
				<div id="reglages" style="font-family: 'Arial', sans-serif; font-variant: normal; color: black; font-size: 14px; margin: 0.5em; display: none;">
					<fieldset style="display: inline;">
						<legend align="left" style="color: black;">R&eacute;glages</legend>
						<p id="liste_reglages_1">
							<label><input id="option_1" type="radio" name="liaison_termes" onclick="gerer_reglages();" checked="checked" />Tous les mots</label>&nbsp;
							<label><input id="option_2" type="radio" name="liaison_termes" onclick="gerer_reglages();" />Au moins un mot</label>&nbsp;
						</p>
						<p id="liste_reglages_2">
							<label><input id="option_3" type="checkbox" name="selection_auto" onclick="gerer_reglages();" checked="checked" />S&eacute;lection automatique</label>&nbsp;
						</p>
						<p id="liste_reglages_3">
							<label><input id="option_4" type="radio" name="mode_recherche" onclick="gerer_reglages();" checked="checked" />Mode recherche</label>&nbsp;
							<label><input id="option_5" type="radio" name="mode_recherche" onclick="gerer_reglages();" />Mode s&eacute;lection</label>&nbsp;
						</p>
					</fieldset>
				</div>

				<div id="aide" style="width: 800px; margin: 0.5em; text-align: left; font-family: 'Tahoma', sans-serif; font-variant: normal; font-size: 14px; color: black; display: none;">
					<b onclick="derouler_affichage('aide0');">0. Introduction.</b><br />
					<div id="aide0" style="display: block; margin-left: 3em; padding: 4px;">
						Cette section d'aide est pr&eacute;sente pour 2 raisons : <br />
						&nbsp;- vous faire comprendre toutes les fonctionnalit&eacute;s de ce moteur de recherche en temps r&eacute;el,<br />
						&nbsp;- vous permettre de vous en servir au mieux et le plus vite possible.<br />
						<br />
						Le Pok&eacute;dex (ce moteur de recherche) poss&egrave;de 2 fonctions principales :<br />
						&nbsp;- la recherche de Pok&eacute;mon avec acc&egrave;s &agrave; leurs informations,<br />
						&nbsp;- la constitution d'une &eacute;quipe pour l'analyser.<br />
						<br />
						Cliquez sur un titre pour d&eacute;rouler son contenu.<br />
					</div>
					
					<b onclick="derouler_affichage('aide1');">1. Vue g&eacute;n&eacute;rale de l'interface.</b><br />
					<div id="aide1" style="display: none; margin-left: 3em; padding: 4px;">
						L'interface est &eacute;pur&eacute;e et ne contient que le strict n&eacute;cessaire.<br />
						<br />
						Tout en haut vous trouverez le cadre de recherche dans lequel vous pouvez taper votre requ&ecirc;te.<br />
						<br />
						En dessous vous trouverez le r&eacute;sultat de votre recherche, c'est &agrave; dire le nombre de r&eacute;sultats (et le nombre de Pok&eacute;mon s&eacute;lectionn&eacute;s) ainsi que la liste des Pok&eacute;mon correspondants &agrave; votre recherche.<br />
					</div>
					
					<b onclick="derouler_affichage('aide2');">2. Le cadre de recherche.</b><br />
					<div id="aide2" style="display: none; margin-left: 3em; padding: 4px;">
					
						<b onclick="derouler_affichage('aide21');">2.1. Recherche multi-crit&egrave;res !</b><br />
						<div id="aide21" style="display: none; margin-left: 3em; padding: 4px;">
							Vous pouvez taper l'int&eacute;gralit&eacute; ou une partie d'un nom de Pok&eacute;mon ou d'un type.<br />
							Par exemple, en tapant "fo", vous trouverez la liste des Pok&eacute;mon poss&eacute;dant cette expression dans leur nom comme Coconfort ou Fouinette.<br />
							<br />
							Mais vous pouvez aussi bien taper un nom de type !<br />
							C'est tout simple, tapez "electr" et la liste des Pok&eacute;mon &eacute;lectriques apparaitra !<br />
							<br />
							Attention toutefois, si un Pok&eacute;mon poss&egrave;de un nom de type dans son nom, il pourra apparaitre dans des moments innatendus.<br />
							Par exemple, Feuforeve poss&egrave;de le mot "feu" (qui est aussi un type) dans son nom, il apparaitra donc dans les r&eacute;sultats, meme s'il ne poss&egrave;de pas le type feu.<br />
							<br />
							D&egrave;s le lancement de la page, la zone de recherche est s&eacute;lectionn&eacute;e : vous pouvez taper votre recherche sans cliquer dans la zone pour gagner du temps.<br />
						</div>
						
						<b onclick="derouler_affichage('aide22');">2.2. Indiquez plusieurs termes pour une recherche plus pr&eacute;cise !</b><br />
						<div id="aide22" style="display: none; margin-left: 3em; padding: 4px;">
							Vous pouvez rentrer plusieurs termes de recherche en les s&eacute;parant d'un espace.<br />
							Par exemple, en tapant "pa insect" vous trouverez la liste des Pok&eacute;mon de type Insecte avec "pa" dans leur nom comme Chenipan ou Parasect.<br />
							<br />
							Ceci est pratique pour chercher un double type (comme Feu/Sol).<br />
						</div>
						
						<b onclick="derouler_affichage('aide23');">2.3. Apprenez &agrave; vous servir des majuscules !</b><br />
						<div id="aide23" style="display: none; margin-left: 3em; padding: 4px;">
							Le fait d'utiliser des majuscules affecte les r&eacute;sultats de recherche.<br />
							De base, si vous ne mettez pas de majuscule, la recherche sera insensible &agrave; la casse.<br />
							Par exemple, si vous tapez "tor" (tout en minuscule), vous obtiendrez comme r&eacute;sultat Tortank ou Tortipouss tout comme Voltorbe ou L&eacute;viator.<br />
							<br />
							Par contre, les termes comportant des majuscules seront sensibles &agrave; la casse.<br />
							Ainsi, en tapant "Tor", vous trouverez Tortank ou Torterra mais pas de Chartor ou de Keunotor.<br />
							Une majuscule n'est prise en compte que dans le mot o&ugrave; elle se trouve, chaque mot de la recherche est interpr&eacute;t&eacute; s&eacute;paremment.<br />
							En effet, en tapant "eau Lo", vous trouverez tous les Pok&eacute;mon dont le nom (ou le type) commence par "Lo" et poss&eacute;dant le type eau.<br />
							La liste des r&eacute;sultats contiendra notamment Lokhlass, Loupio ou Lombre mais pas Flobio, Ludicolo ou Musteflott.<br />
						</div>
						
						<b onclick="derouler_affichage('aide24');">2.4. Les r&eacute;sultats s'affichent en temps r&eacute;el !</b><br />
						<div id="aide24" style="display: none; margin-left: 3em; padding: 4px;">
							A chaque caract&egrave;re entr&eacute;, la liste des r&eacute;sultats se met &agrave; jour (peut prendre plus ou moins de temps).<br />
							La mise &agrave; jour peut prendre plus ou moins de temps en fonction du navigateur.<br />
							<br />
							Je vous recommande vivement de ne pas vous servir d'Internet Explorer, mais plutot un navigateur moderne comme Opera ou Google Chrome.<br />
							Les meilleures performances sont obtenues avec Chrome 9, Opera 12 et Internet Explorer 8 (&agrave; &eacute;viter) pour la vitesse d'affichage des r&eacute;sultats instantann&eacute;s.<br />
							La vitesse d'affichage la plus mauvaise est obtenue avec Firefox 3.6.<br />
						</div>
						
						<b onclick="derouler_affichage('aide25');">2.5. Analyser votre &eacute;quipe de Pok&eacute;mon !</b><br />
						<div id="aide25" style="display: none; margin-left: 3em; padding: 4px;">
							Apr&egrave;s avoir s&eacute;lectionn&eacute; un ou plusieurs Pok&eacute;mon, appuyez sur la touche "Entr&eacute;e" dans le cadre de recherche pour acc&eacute;der &agrave; une analyse de votre &eacute;quipe.<br />
							Au lieu d'appuyer sur la touche Entr&eacute;e, vous pouvez cliquer sur le bouton de validation juste &agrave; droite.<br />
						</div>
					</div>
					
					<b onclick="derouler_affichage('aide3');">3. La liste des r&eacute;sultats.</b><br />
					<div id="aide3" style="display: none; margin-left: 3em; padding: 4px;">
						<b onclick="derouler_affichage('aide31');">3.1. Survol du curseur.</b><br />
						<div id="aide31" style="display: none; margin-left: 3em; padding: 4px;">
							Une liste d'images s'affiche au milieu de l'&eacute;cran.<br />
							En passant votre souris sur une image, un cadre s'affiche.<br />
							Il contient le nom et le type du Pok&eacute;mon point&eacute; par votre curseur.<br />
						</div>
						
						<b onclick="derouler_affichage('aide32');">3.2. Clic gauche.</b><br />
						<div id="aide32" style="display: none; margin-left: 3em; padding: 4px;">
							En effectuant un clic gauche sur une image, vous acc&eacute;dez &agrave; la fiche Pok&eacute;bip de ce Pok&eacute;mon.<br />
							Les fiches de ce site sont claires et compl&egrave;tes. Toutes les images en rapport avec Pok&eacute;mon proviennent de ce site.<br />
						</div>
						
						<b onclick="derouler_affichage('aide33');">3.3. Clic droit.</b><br />
						<div id="aide33" style="display: none; margin-left: 3em; padding: 4px;">
							Avec un clic droit, vous pouvez s&eacute;lectionner un Pok&eacute;mon.<br />
							Un cadre rouge s'affiche alors derri&egrave;re lui pour vous le rappelez.<br />
							Vous pouvez le d&eacute;s&eacute;lectionner de la m&ecirc;me mani&egrave;re.<br />
							Vous pouvez s&eacute;lectionner jusqu'&agrave; 6 Pok&eacute;mon, soit le nombre maximum de Pok&eacute;mon constituant une &eacute;quipe.<br />
							<br />
							Notez que les Pok&eacute;mon que vous avez s&eacute;lectionn&eacute;s restent affich&eacute;s tout le temps, pour vous permettre de les d&eacute;s&eacute;lectionner &agrave; tout moment sans avoir &agrave; les chercher &agrave; nouveau.<br />
							Cela vous permet aussi de les voir tous ensemble en tapant une recherche qui ne retourne aucun r&eacute;sultat comme "ffff".<br />
						</div>
					</div>
					
					<b onclick="derouler_affichage('aide4');">4. Les r&eacute;glages.</b><br />
					<div id="aide4" style="display: none; margin-left: 3em; padding: 4px;">
						<b onclick="derouler_affichage('aide41');">4.1. Param&egrave;tre de recherche.</b><br />
						<div id="aide41" style="display: none; margin-left: 3em; padding: 4px;">
							
							<b onclick="derouler_affichage('aide411');">4.1.1. Tous les mots (ET).</b><br />
							<div id="aide411" style="display: none; margin-left: 3em; padding: 4px;">
								Vous pouvez modifier les param&egrave;tres de recherche en faisant un clic droit sur le cadre de recherche.<br />
								Ce param&egrave;tre indique que les r&eacute;sultats de la recherche devront comporter tous les mots que vous avez tap&eacute;.<br />
								Autrement dit, une condition ET est appliqu&eacute;e entre les termes de recherche.<br />
								<br />
								Choisir ce param&egrave;tre permet d'activer la s&eacute;lection automatique.<br />
							</div>
							
							<b onclick="derouler_affichage('aide412');">4.1.2. Au moins un mot (OU).</b><br />
							<div id="aide412" style="display: none; margin-left: 3em; padding: 4px;">
								Ce param&egrave;tre indique que les r&eacute;sultats de la recherche devront comporter au moins un des mots que vous avez tap&eacute;.<br />
								Autrement dit, une condition OU est appliqu&eacute;e entre les termes de recherche.<br />
							</div>
						</div>
						
						<b onclick="derouler_affichage('aide42');">4.2. Option de s&eacute;lection automatique.</b><br />
						<div id="aide42" style="display: none; margin-left: 3em; padding: 4px;">
							42 ! La s&eacute;lection automatique d&eacute;clenche une action lorsqu'un seul r&eacute;sultat est retourn&eacute; par la recherche ou lorsque 6 Pok&eacute;mon sont s&eacute;lectionn&eacute;s.<br />
							L'action d&eacute;clench&eacute;e est d&eacute;termin&eacute;e par le mode du Pok&eacute;dex que vous avez s&eacute;lectionn&eacute;.<br />
						</div>
						
						<b onclick="derouler_affichage('aide43');">4.3. Mode du Pok&eacute;dex.</b><br />
						<div id="aide43" style="display: none; margin-left: 3em; padding: 4px;">
						
							<b onclick="derouler_affichage('aide431');">4.3.1. Mode recherche.</b><br />
							<div id="aide431" style="display: none; margin-left: 3em; padding: 4px;">
								Lorsque la recherche ne retourne qu'un seul Pok&eacute;mon, sa fiche est automatiquement ouverte dans un nouvel onglet (ou une nouvelle page).<br />
								Par exemple, en tapant "Typ", vous acc&eacute;derez &agrave; la fiche de Typhlosion.<br />
							</div>
							
							<b onclick="derouler_affichage('aide432');">4.3.2. Mode s&eacute;lection.</b><br />
							<div id="aide432" style="display: none; margin-left: 3em; padding: 4px;">
								Lorsque la recherche ne retourne qu'un seul Pok&eacute;mon, il sera automatiquement ajout&eacute; &agrave; votre &eacute;quipe (&agrave; votre s&eacute;lection).<br />
								En m&ecirc;me temps, le texte du cadre de recherche sera effac&eacute; pour vous permettre d'effectuer une nouvelle recherche tout de suite.<br />
								<br />
								D'autre part, d&egrave;s que 6 Pok&eacute;mon seront s&eacute;lectionn&eacute;s (que votre &eacute;quipe sera compl&egrave;te), la page de l'analyse de votre &eacute;quipe s'ouvrira dans un nouvel onglet (ou une nouvelle page).<br />
							</div>
						</div>
					</div>
					
					<b onclick="derouler_affichage('aide5');">5. R&eacute;sum&eacute; / Aide-m&eacute;moire.</b><br />
					<div id="aide5" style="display: none; margin-left: 3em; padding: 4px;">
						Dans le cadre de recherche :<br />
						&nbsp;- bien se servir des <b><i>majuscules</i></b><br />
						&nbsp;- touche Entr&eacute;e pour voir la <b><i>page d'analyse</i></b><br />
						&nbsp;- clic droit dans le cadre pour modifier les <b><i>r&eacute;glages</i></b><br />
						&nbsp;- <b><i>mode recherche</i></b> pour acc&eacute;der plus vite aux fiches<br />
						&nbsp;- <b><i>mode s&eacute;lection</i></b> pour constituer une &eacute;quipe plus vite<br />
						<br />
						Sur les images des Pok&eacute;mon :<br />
						&nbsp;- souris au dessus pour <b><i>afficher les infos</i></b><br />
						&nbsp;- clic gauche pour acc&eacute;der &agrave; la <b><i>fiche Pok&eacute;bip</i></b><br />
						&nbsp;- clic droit pour <b><i>s&eacute;lectionner</i></b><br />
						<br />
						Exploitation du navigateur :<br />
						&nbsp;- tout s'ouvre dans un <b><i>nouvel onglet</i></b><br />
						&nbsp;- fonctionne au mieux sous <b><i>Google Chrome</i></b><br />
					</div>
						
				</div>	
				
				
				
				
				
				<div id="nombre_resultats_recherche" style="margin: 0.5em;">
					493 r&eacute;sultats
				</div>
				
				<div style="width: 800px; margin: 0.5em;">
				<?php
				for($x = 1; $x <= 493; $x++)
				{
					$zeros = "";
					if($x < 10)
						$zeros = "00";
					elseif($x < 100)
						$zeros = "0";
						
					echo "<div id='selection_" . $x . "' style='float: left; height: 80px; width: 80px;' oncontextmenu='switch_selection(" . $x . "); return false;' onmousemove='afficher_infos_survol(" . $x . ", event);' onmouseover='selectionner_type(" . $x . ")' onmouseout='document.getElementById(\"info_bulle_survol\").style.display = \"none\";'>
					<img src='http://www.pokebip.com/pokemon/images/pokemon/" . $zeros . $x . ".gif' alt='" . $pokedex[$x - 1][0] . "' style='border: none;' onclick=\"window.open('http://www.pokebip.com/pokemon/pokedex/index.php?phppage=recherche&req=%23" . $zeros . $x . "&submit=Go+%21')\"/>
					</div>
					";
				}
				?>
				</div>
			</center>
		</div>
    </body>
	
</html>