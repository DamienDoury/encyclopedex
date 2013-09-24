<?php
include_once "ressources/code_alphabet.php";

/*
~ LANGUAGES CHART ~
requested:	none	fr/en	other	none	fr/en	other	none	fr/en	other
saved:		none	none	none	fr/en	fr/en	fr/en	other	other	other

[after computing]
requested:	none	fr/en	none	none	fr/en	none	none	fr/en	none
saved:		none	none	none	fr/en	fr/en	fr/en	none	none	none
result:		native	fr/en	native	fr/en	saved	fr/en	native	fr/en	native


Note: 
By "requested" we mean the language provided in the subdomain in the URL.
If the user modify the language in the URL on purpose, it will redirect the page to the previous language.
To modify the language, the user has to click on a flag.

The saved language is the language stored in the cookie.
The native language is the language provided by the browser in the http header.
*/
/*
// NATIVE
$native_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

if($native_lang != "en" && $native_lang != "fr") // If the native language of the user is not managed, we force English.
	$native_lang = "";

// REQUESTED
$requested_lang = preg_replace("#\..*$#", "", $_SERVER["DOMAIN_NAME"]);
if(strlen($requested_lang) != 2)
{
	$requested_lang = "";
}
else
{
	if($requested_lang != "en" && $requested_lang != "fr") // If the user modified the URL with a not managed language, we cancel it.
		$requested_lang = "";
}

// SAVED
$saved_lang = "";
if(isset($_COOKIE["lang"]))
{
	$saved_lang = $_COOKIE["lang"];
	if($saved_lang != "en" && $saved_lang != "fr") // If the user modified his cookie with a not managed language, then we cancel it.
		$saved_lang = "";
}

// RESULT
$lang = "";
$native_language_used = false;

if($saved_lang)
	$lang = $saved_lang;
else if($requested_lang)
	$lang = $requested_lang;
else if($native_lang)
{
	$lang = $native_lang;
	$native_language_used = true;
}
else
	$lang = "en";

if($native_language_used)
	setcookie("lang", $lang);
else
	setcookie("lang", $lang, time() + 3600 * 24 * 365 * 2);
*/

$managed_languages = array("en", "fr");

// SAVED
$lang = "";
if(isset($_COOKIE["lang"]))
{
	$lang = $_COOKIE["lang"];
	if(!preg_match("#^(" . implode("|", $managed_languages) . ")$#i", $lang)) // If the user modified his cookie with a not managed language, then we cancel it.
		$lang = "";
}

if($lang == "") // If there is no cookie or a corrupted cookie.
{
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

	if($lang != "fr" && $lang != "en") // If the user speaks none of the managed languages, we force English.
		$lang = "en";
}

$requested_lang = preg_replace("#\..*$#", "", $_SERVER["DOMAIN_NAME"]);
if(strlen($requested_lang) != 2)
{
	$requested_lang = "";
}
else
{
	if(!preg_match("#^(" . implode("|", $managed_languages) . ")$#i", $lang)) // If the user modified the URL with a not managed language, we cancel it.
		$requested_lang = "";
}

$lang = strtolower($lang);
$requested_lang = strtolower($requested_lang);

if($requested_lang == "" || $lang != $requested_lang)
{
	header("Location: http://" . $lang . ".encyclopedex.com" . $_SERVER["REQUEST_URI"]);
	die();
}

setcookie("lang", $lang, time() + 3600 * 24 * 365 * 2, "/", ".encyclopedex.com");

$welcome = false;
if(!isset($_COOKIE["deja_visite"]))
{
	$welcome = true;
}




if($_GET["r"] != "")
{
	$r = $_GET["r"];

	// Securites.
	for($i = 0; $i < strlen($r); $i++)
	{
		if(strpos($alphabet, $r[$i]) < 0)
		{
			echo "Erreur : caractere dans la requete invalide : " . strpos($alphabet, $r[$i]);
			return;
		}
	}
	//Fin securites.
}



setcookie("deja_visite", true, time() + 3600 * 24 * 365 * 2, "/", ".encyclopedex.com"); // On se souvient de la derniere visite pendant 2 ans.

include_once "langs/trad_" . $lang . ".php";
?><!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
    <head>
        <title>Pok&eacute;dex - Encyclopedex</title>
		<link rel="icon" type="image/png" href="/images/icones/loupe 32x32.png" />
		<meta name="viewport" content="width=480, user-scalable=yes">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="<?php echo META_DESCRIPTION ?>" />
		<meta name="keywords" content="<?php echo META_KEYWORDS ?>" />

		<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="http://encyclopedex.com/pokedex.css" />

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script src="/libs/jquery.cookie.js"></script>
		<script src="/libs/bPopup.js"></script>
		<script type="text/javascript">
		
		var numero_completion = -1;
		
		var saisie_precedente = "";
		var focus_saisie = false;
		
		var nombre_requetes = 0;
		
		var bdd = []; // L'avantage avec ce systeme, c'est qu'on peut partager les requetes. Un parametre en GET peut pre-selectionner la liste de mots cles.
		<?php echo DB_JS ?>
				
		$(document).ready(
			function()
			{
				$("#langs").on("click", "img",
					function() 
					{
						$.cookie("lang", $(this).attr("alt").toLowerCase(), { expires : 365, path: "/", domain: ".encyclopedex.com" });
						document.location.reload(true);
					}
				);
				
				$("#filtre").on("click", "div",
					function() 
					{
						effacer_critere($(this));
					}
				);
				
				$("#saisie").focus(
					function()
					{
						auto_completer();
					}
				);
				
				$("#saisie").blur(
					function()
					{
						focus_saisie = false; 
						setTimeout(
							function()
							{
								if(!focus_saisie)
								{
									$('#menu').slideUp('fast', 
										function()
										{
											$("#saisie").css("border-bottom-left-radius", "10px");
											$("#saisie").css("border-bottom-right-radius", "10px");			
										}
									);						
								}
							}, 
							100
						);
					}
				);
				
				$("#menu").on("mouseover", "div",
					function() 
					{
						$(this).css("color", "blue");
						$(this).css("z-index", "3");
						$(this).css("font-weight", "bold");
						$(this).css("border", "1px solid blue");
						$(this).css("box-shadow", "1px 1px 5px black");
					}
				);
				
				$("#menu").on("mouseout", "div",
					function() 
					{
						$(this).css("color", "#792400");
						$(this).css("z-index", "1");
						$(this).css("font-weight", "normal");
						$(this).css("border", "1px solid brown");
						$(this).css("box-shadow", "none");
					}
				);
				
				$("#menu").on("click", "div",
					function() 
					{
						click_completion($(this).attr("id").replace(/completion_/, ""));
					}
				);
				
				var debut_clic = -1;
				
				$("#pokedex").on("click", ".resultat",
					function() 
					{
						var id = $(this).attr("data-id");
						var zeros = "";
						if(id < 10)
							zeros = "00";
						else if(id < 100)
							zeros = "0";
						
						//window.open("http://www.pokebip.com/pokemon/pokedex/index.php?phppage=recherche&req=%23" + zeros + id + "&submit=Go+%21");	
						window.open("/pokemon/" + id);
					}
				);
				
				$("#pokedex").on("contextmenu", ".resultat",
					function() 
					{
						if($("#equipe > .resultat").length >= 6)
						{
							return false;
						}

						var elem = '<div class="resultat" data-id="' + $(this).attr("data-id") + '"' + ($(this).attr("data-forme") ? ' data-forme="' + $(this).attr("data-forme") + '"': "") + '><div style="background: ' + $(this).find(" > div").css("background") + '";" /></div></div>';
						var position_top = 0;
						
						if($("#equipe > .resultat").length == 0)
						{
							$("#footer").slideDown(400);
							position_top -= 106;
						}

						/*$(elem).css("z-index", "10");
						$(elem).css("position", "absolute");
						$(elem).css("top", $(this).offset().top);
						$(elem).css("left", $(this).offset().left);*/
						$("#equipe").append(elem);
						/*var new_elem = $("#equipe div:last");
						new_elem.css("position", "fixed");
						alert("top:" + $(this).offset().top + "  left:" + $(this).offset().left);
						new_elem.css("top", $(this).offset().top);
						new_elem.css("left", $(this).offset().left);*/
						
						/*var flottant = elem.clone();
						
						flottant.css("z-index", "10");
						flottant.css("position", "absolute");
						flottant.css("top", $(this).offset().top);
						flottant.css("left", $(this).offset().left);
						
						$("body").append(flottant);
						
						position_top += $("#equipe > .resultat").last().offset().top;
						flottant.animate({top: position_top, left: $("#equipe > .resultat").last().offset().left}, 400);
						flottant.promise().done(
							function(obj)
							{
								$("#equipe_" + ($("#equipe > .resultat:last"))).show(); // Probleme : ne doit que focus qu'une seule div a la fois.
								$(this).remove();
							}
						);*/
						
						return false;
					}
				);
				
				$("#equipe").on("click", ".resultat",
					function() 
					{
						var img = $(this).find("img").clone();
						
						img.css("z-index", "10");
						img.css("position", "absolute");
						img.css("top", $(this).offset().top);
						img.css("left", $(this).offset().left);
						
						$("body").append(img);						

						img.animate({opacity: 0, top: $(this).offset().top - 100}, 400, 
							function()
							{
								$(this).remove();
							}
						);
						
						$(this).remove();
												
						if($("#equipe > .resultat").length == 0)
						{
							$("#footer").slideUp(400);
						}
					}
				);

				$("#footer").on("click", "input",
					function()
					{
						alert("<?php echo COMING_SOON ?>");
						return false;
					}
				);
				
				$("#pokedex").on("mousemove", ".resultat",
					function(event) 
					{
						afficher_infos_survol($(this).attr("data-id"), event);
					}
				);
				
				$("#pokedex").on("mouseover", ".resultat",
					function() 
					{
						remplir_info_bulle($(this).attr("data-id"), $(this).attr("data-forme"));
						
						////////////////////////////////////////////
						/*id = $(this).attr("id");
						zeros = "";
						if(id < 10)
							zeros = "00";
						else if(id < 100)
							zeros = "0";
		
						$(this).find("img").attr("src", "http://www.pokebip.com/pokemon/pokedex/images/bw_animes/" + zeros + id + ".gif");
						
						//$(this).find("img").css("position", "absolute");
						$(this).find("img").css("margin-top", ((96 - $(this).css("height")) / 2) + "px");
						$(this).find("img").css("margin-left", ((96 - $(this).css("width")) / 2) + "px");*/
					}
				);
				
				$("#pokedex").on("mouseout", ".resultat",
					function() 
					{
						$("#info_bulle_survol").css("display", "none");
						
						////////////////////////////////////////////
						/*id = $(this).attr("id");
						$(this).find("img").attr("src", "http://www.pokebip.com/pokemon/pokedex/images/bw_front_m/" + id + ".png");
						$(this).find("img").css("margin-top", "0");
						$(this).find("img").css("margin-left", "0");*/
					}
				);
				
				$("#filtre").on("click", "#effacer_recherche",
					function() 
					{
						reinitilialiser_filtre();
					}
				);
				
				$("#filtre").on("click", "#partager_recherche", 
					function() 
					{
						$("html").scrollTop(0);
						
						$('#pop').bPopup(
							{
								speed: 300,
								transition: 'slideIn'
							}
						);
						
						var liste_index = get_filtre_index();
												
						$.ajax({
							type: "POST",
							url: "/ajax/share_url.php",
							data: "toconvert=" + liste_index.join(","),
							success: function(data)
							{
								if(data != "" && !data.match(/#Erreur/))
								{
									$("#url_share").val("http://encyclopedex.com/pokedex/" + data);
									$("#url_share").select();
								}
								else
								{
									$("#url_share").val(data);
								}
							}
						});
			
						
					}
				);

				/*$(window).scroll(
					function()
					{
						if($(window).scrollTop() == 0)
							$("#header").css("position", "absolute");
						else
							$("#header").css("position", "fixed");
					}
				);*/
				
				<?php
				global $welcome;
				if($welcome)
				{
				?>
					$("#tuto > div:first").show();
					
					$("#tuto").bPopup(
						{
							speed: 300,
							transition: "slideIn",
							follow: [false, false],
							modalClose: false,
							closeClass: "close_popup"
						}
					);
				
					$(".close_popup").on("click",
						function() 
						{
							introduce_obj();
						}
					);
					
					var etape_tuto = 0;
					var url_arrivee = location.href;
					$(".avancer_tuto").on("click",
						function() 
						{
							if($("#tuto > div").length - 2 >= etape_tuto) // On passe a l'etape suivante. Si on est arrive au bout, on ferme le tuto.
								etape_tuto++;
							else
							{
								$(".close_popup").trigger("click");
								return location.href = url_arrivee;
							}
							
							$("#tuto > div:visible").hide("fast");
							$("#tuto > div:eq(" + etape_tuto + ")").show("fast", function()
								{
									<?php echo TUTO_JS ?>
									
									$(".b-modal").css("opacity", "0"); // Durant le tutoriel, on ne veut pas que le site soit cache.
								}
							);
						}
					);
				<?php
				}
				?>
				
				$("#url_share").on("click",
					function() 
					{
						if(!$("#pop input").val().match(/#Erreur/)) // On ne selectionne pas le texte s'il est survenu une erreur.
							$(this).select();
					}
				);
				
				var r_values = [];
				
				<?php
				$r = $_GET["r"];
				
				for($i = 1; $i < strlen($r); $i += 3) // Recuperation de la liste des criteres pre-renseignes par get.
				{
					echo "r_values.push(" . (strpos($alphabet, $r[$i]) * pow(strlen($alphabet), 2) + strpos($alphabet, $r[$i + 1]) * strlen($alphabet) + strpos($alphabet, $r[$i + 2])) . ");";
				}
				?>

				r_index = 0;
				for(r_index = 0; r_index < r_values.length; r_index++)
				{
					var offset = 0;

					if(r_values[r_index] >= bdd.length)
						reinitilialiser_filtre("Erreur : code " + r_values[r_index] + " trop grand.");

					var critere = bdd[r_values[r_index]][0];
					if(critere.match(/XXX/i)) // Gestion d'un cas particulier s'il s'agit d'un critere de statistique avec valeur.
					{
						if(++r_index >= r_values.length)
							reinitilialiser_filtre("Erreur : code erron\351.");

						critere = critere.replace(/XXX/i, r_values[r_index]);
						offset = -1;
					}

					$("#saisie").val(critere);
					auto_completer();

					var select = 0;
					while($("#completion_" + select).attr("class") != bdd[r_values[r_index + offset]][1])
						select++;

					numero_completion = select; // Ici, a cause de l'attaque/type Vol, il faut chercher l'index du premier data-val.
					valider_completion(0);
				}
				
				actualiser_pokedex();
				
				modifier_bordure_saisie();
			}
		);
		
		function get_filtre_index()
		{			
			var liste_index = new Array();
						
			$.each($("#filtre > div"),
				function()
				{
					for(var index in bdd)
					{
						if(bdd[index][1] == $(this).attr("class"))
						{
							if(bdd[index][2].match(/XXX/))
							{
								if(bdd[index][2].replace(/XXX/, "") == $(this).attr("data-val").replace(/[+-]?[0-9]+/, ""))
								{
									liste_index.push(index);
									
									if($(this).attr("data-val").match(/[0-9]/)) // S'il s'agit d'une stat personnalisable, on enregistre aussi la valeur entree par l'utilisateur.
										liste_index.push($(this).attr("data-val").match(/[+-]?[0-9]+/)); 
								}
							}

							if(bdd[index][2] == $(this).attr("data-val"))
							{
								liste_index.push(index);
							}
						}
					}
				}
			);
			
			return liste_index;
		}
		
		function reinitilialiser_filtre(txt)
		{
			$("#filtre").html("");
			$("#saisie").focus();
			$("#saisie").css("border-bottom-left-radius", "10px");
			$("#saisie").css("border-bottom-right-radius", "10px");	
			actualiser_pokedex();
			
			if(txt != "" && txt != undefined)
			{
				$("#saisie").val("");
				alert(txt);
				exit(0);
			}
		}
		
		function effacer_critere(obj)
		{
			$(obj).remove();
					
			if($("#filtre > div").length == 0)
				reinitilialiser_filtre();
			
			actualiser_pokedex();
		}

		function effacer_accents(str)
		{
			var r = str.toLowerCase();
            r = r.replace(new RegExp(/[àáâÉäå]/g),"a");
            r = r.replace(new RegExp(/æ/g),"ae");
            r = r.replace(new RegExp(/ç/g),"c");
            r = r.replace(new RegExp(/[èéêë]/g),"e");
            r = r.replace(new RegExp(/[ìíîï]/g),"i");
            r = r.replace(new RegExp(/ñ/g),"n");                
            r = r.replace(new RegExp(/[òóôõö]/g),"o");
            r = r.replace(new RegExp(/o/g),"oe");
            r = r.replace(new RegExp(/[ùúûü]/g),"u");
            r = r.replace(new RegExp(/[ýÿ]/g),"y");
            return r;
		}
		
		function htmlSpecialChars(str)
		{
			return str
					.replace(/&/, "&amp;")
					.replace(/</, "&lt;")
					.replace(/>/, "&gt;")
					.replace(/"/, "&quot;")
					.replace(/'/, "&#039;");
					//.replace(/ /, "&nbsp;");
		}
   
		function recherche(e)
		{
			var key = 0;
			if(e.keyCode)
				key = e.keyCode;
			else
				key = e.which;

			if(key == 8) // || key == 46) // KEY_BACK_TAB ou KEY_DEL
			{
				if($("#saisie").val() == "" && saisie_precedente == "")
				{
					effacer_critere($("#filtre div").last());
				}
			}
			
			if(key == 40) // KEY_DOWN
			{
				selectionner_completion_fleches(numero_completion + 1);
			}
			else if(key == 38) // KEY_UP
			{
				selectionner_completion_fleches(numero_completion - 1);
			}
			else if(key == 32 && numero_completion == -1)
			{
				auto_completer();
			}
			else if(key == 13 || key == 32) // KEY_ENTER ou KEY_SPACE
			{
				// 1) Si completion selectionnee, on la choisi.
				// 2) Sinon, si on a plusieurs resultats, on regarde s'il y en a un qui match a 100%.
				// 3) Si oui, on la choisi. Sinon on ne choisi rien.
				
				if(numero_completion > -1)
				{
					valider_completion(key);
				}
				else if(key == 13 && $("#menu > *").length > 0)
				{
					numero_completion = 0;
					valider_completion(0);
				}
				else if(key == 13 && $("#saisie").val() == "" && $("#pokedex > .resultat").length > 0) // Si le menu d'aide a la selection est vide quand on appuie sur Entree, alors on ouvre la page du premier resultat.
				{
					$("#pokedex > .resultat:first").trigger("click");
				}
			}
			else
			{
				auto_completer();
			}
			
			modifier_bordure_saisie();
			
			saisie_precedente = $("#saisie").val();
		}
		
		function selectionner_completion_fleches(number)
		{
			$("#completion_" + numero_completion).trigger("mouseout");
			
			numero_completion = number;
			
			if(numero_completion > $("#menu > *").length - 1)
				numero_completion = 0;
			
			if(numero_completion < 0)
				numero_completion = $("#menu > *").length - 1;
			
			$("#completion_" + numero_completion).trigger("mouseover");
		}
		
		function valider_completion(key)
		{
			if(numero_completion > -1)
			{				
				if($("#completion_" + numero_completion).text().match(/XXX/) == "XXX") // On interdit la validation d'une stat incomplete.
				{
					$("#saisie").val($("#completion_" + numero_completion).text().trim().replace(/XXX/, ""));
					$("#saisie").focus();
					return;
				}
				
				var contenu = $("#completion_" + numero_completion).clone().removeAttr("id");
				contenu.html(contenu.html().replace(/<b>/, "").replace(/<\/b>/, ""));
				contenu.css("color", "#792400");
				contenu.css("font-weight", "normal");
				contenu.css("border", "1px solid brown");
				
				if($("#filtre > div").length == 0)
				{
					$("#filtre").append('<img id="partager_recherche" src="/images/icones/share 24x24.png" alt="Partager" />');
					$("#filtre").append(contenu);
					$("#filtre").append('<img id="effacer_recherche" src="/images/icones/cancel 24x24.png" alt="Tout effacer" />');
				}
				else
				{
					$("#filtre div").last().after(contenu);
				}

				$("#filtre").sortable(
					{
						appendTo: 'body',
						containment: "window",
						helper: 'clone',
						items: "div",
						revert: true,
						cursor: 'move',
						distance: 15,
						tolerance: "pointer",
						start: function()
						{
							//$(".filtre_placeholder").width("120");
						},
						stop: function()
						{
							actualiser_pokedex();
						}	
					}
				);
				
				$("#saisie").val("");
				$("#saisie").focus();
				
				if(!r_index)
					actualiser_pokedex();
			}
		}
		
		var xhr = "";
		
		function actualiser_pokedex()
		{
			r_index = ""; // Fin de l'auto_selection.
			
			$("#pokedex").html("<img class='loading' src='/images/icones/pokeball.png' alt='Attente' />");
			afficher_nombre_resultats();
			
			// On actualise l'URL pour qu'elle corresponde a la recherche.
			$.ajax({ 
				type: "POST",
				url: "/ajax/share_url.php",
				data: "toconvert=" + get_filtre_index().join(","),
				success: function(data)
				{
					if(data != "" && !data.match(/#Erreur/))
						window.history.replaceState("", "Pokédex - Encyclopedex", "/pokedex/" + data);
					else
						window.history.replaceState("", "Pokédex - Encyclopedex", "/pokedex/");
				}
			});
						
			var liste_cat = new Array;
			var liste_val = new Array;
			$("#filtre > div").each(
				function()
				{
					liste_cat.push(encodeURIComponent($(this).attr("class")));
					liste_val.push(encodeURIComponent($(this).attr("data-val")));
				}
			);
						
			var numero_requete = ++nombre_requetes; // Ce chiffre permet de connaitre la requete en cours pour n'afficher que les resultats de cette derniere.
			
			if(xhr != "")
				xhr.abort();
			else
			{
				xhr = $.ajax({
					type: "POST",
					url: "/ajax/filtrer_json.php",
					data: "cat=" + liste_cat.join(",") + "&val=" + liste_val.join(","),
					success: function(data)
					{
						if(numero_requete == nombre_requetes)
						{
							var j = JSON && JSON.parse(data) || $.parseJSON(data);

							$("#pokedex").html("");
							for(var pkmn_nb = 0; pkmn_nb < j.length; pkmn_nb++) // On parcourt la liste des Pokemon.
							{
								var temp = "";
								var pkmn = j[pkmn_nb];								
								
								var regexp = new RegExp("id='" + pkmn.id + "'", "g");
								if(pkmn.form)
								{
									temp += "<div data-id='" + pkmn.id + "' class='resultat' data-forme='" + pkmn.form + "'><div style='background: url(\"/images/pkmn/fixe/" + pkmn.id + "-" + pkmn.form + ".png\") no-repeat;'></div>";
								}
								else
								{
									var img_pos = "-" + (96 * Math.floor((pkmn.id - 1) % 10)) + "px -" + (99 * Math.floor((pkmn.id - 1) / 10)) + "px";
									temp += "<div data-id='" + pkmn.id + "' class='resultat'" + (pkmn.form ? " data-forme='" + pkmn.form + "'" : "") + " style=''><div style='background: url(\"/images/pkmn/fixe/pokemon_spritesheet.png\") no-repeat " + img_pos + ";'></div>";
								}
								
								if(pkmn.s) // Si le l'objet pokemon contient des informations autres que l'id et la forme, on les affiche.
								{
									temp += "<div class='stats'>";
									
									for(var i = 0; i < pkmn.s.length; i++)
									{
										var stat_val = pkmn.s[i];
										var stat_name = $("#filtre .stat:eq(" + i + ")").text().trim().match("^[^ ]+");
										temp += "<a>" + stat_name + "&nbsp;" + stat_val + "</a>";
									}

									temp += "</div>";
								}
								
								temp += "</div>";
								$("#pokedex").append(temp);
							}

							afficher_nombre_resultats();

							$("#pokedex > .resultat .stats").css("marginTop", ($("#pokedex > .resultat:first").height() - $("#pokedex > .resultat:first div > a").length * $("#pokedex > .resultat:first div > a:first").height()) + "px"); // Colle le texte au bas de l'image.
							
							/*$("#pokedex > .resultat").draggable(
								{
									cursor: 'move',
									stack: "#pokedex > .resultat",
									delay: 150

								}
							);*/
						}
					}
				});
				
				xhr = "";
			}

			/*$.post("ajax/filtrer.php", { cat: liste_cat.join(","), val: liste_val.join(",") }, 
				function(data)
				{
					$("#pokedex").html("").html(data);
					$(".resultat div").css("marginTop", ($(".resultat:first").height() - $(".resultat:first div > a").length * $(".resultat:first div > a:first").height()) + "px"); // Colle le texte au bas de l'image.
					afficher_nombre_resultats();
				}
			);*/
			
			$("#saisie").val("");
			saisie_precedente = "";
			auto_completer();
		}
		
		function surligner_correspondance(resultat, saisie)
		{
			var texte = resultat[1];
			var len = $.trim(saisie).length;
			var pos = resultat[0];
			
			if(pos < 0)
				pos = 0;
			
			var substr1 = (pos == 0 ? "" : texte.substr(0, pos));
			var substr2 = texte.substr(pos, len);
			var substr3 = (pos + len >= texte.length ? "" : texte.substr(pos + len));
			
			return htmlSpecialChars(substr1) + "<b>" + htmlSpecialChars(substr2) + "</b>" + htmlSpecialChars(substr3);
		}

		function auto_completer()
		{
			// Initialisation et securites.
			numero_completion = -1;
			$("#menu").html("");

			var saisie = effacer_accents($("#saisie").val().toLowerCase());
			
			if($.trim(saisie) == "")
				return;
			
			var focus_saisie = true;
			$("#menu").show();
			
			var tab = [];
			
			// Recherche.
			for(var index in bdd)
			{
				var mot  = bdd[index][0];
				var stat = bdd[index][2];
				
				if(val = saisie.match(/[+-]?[0-9]+$/)) // L'autocompletion s'adapte aux stats.
				{
					mot = mot.replace(/XXX$/, val);
					stat = stat.replace(/XXX$/, val);
				}
				
				var pos = effacer_accents(mot.toLowerCase()).indexOf(saisie);
				
				if(pos !== -1)
				{
					if(effacer_accents(mot.toLowerCase()) == saisie)
					{
						pos = -2;
					}
					else if(effacer_accents(mot.toLowerCase()).indexOf(saisie + " ") === 0)
					{
						pos = -1;
					}
					
					if(bdd[index][1] == "attaque")
						tab.push([pos, mot, bdd[index][1], bdd[index][2], bdd[index][3]]); // index 3 sert a afficher si l'attaque est physique, speciale ou autre.
					else if(bdd[index][1] == "stat" || mot.match(/[<>=]/))
						tab.push([pos, mot, bdd[index][1], stat]);
					else
						tab.push([pos, mot, bdd[index][1], bdd[index][2]]);
				}
			}
			
			// Auto-selection automatique si espace a la fin du mot.
			if(tab.length <= 0 && saisie.match(/[^ ] $/))
			{
				var saisie_bis = saisie.slice(0, -1);
				for(var index in bdd)
				{
					var pos = effacer_accents(bdd[index][0].toLowerCase()).indexOf(saisie_bis);
					
					if(pos !== -1)
					{						
						if(bdd[index][1] == "attaque")
							tab.push([pos, bdd[index][0], bdd[index][1], bdd[index][2], bdd[index][3]]);
						else
							tab.push([pos, bdd[index][0], bdd[index][1], bdd[index][2]]);
					}
				}
			}
			
			// Tri des resultats.
			tab.sort(
				function(a, b)
				{
					if(a[0] < b[0])
						return -1;	
					
					if(a[0] == b[0])
						if(a[1].length < b[1].length)
							return -1;
					
					return 1;
				}
			);
			
			// Affichage des resultats.
			for(i = 0; i < tab.length && i < 15; i++)
			{
				var affichage = "<a>" + surligner_correspondance(tab[i], saisie) + "</a>";
				
				if(tab[i][2] == "type")
				{
					var img_pos = "0px -" + (14 * Math.floor(Math.max(tab[i][3], 0))) + "px";
					affichage = "<a class='thumbnail' style='width: 32px; height: 14px; background: url(\"/images/pkmn/type/<?php echo $lang; ?>/type_spritesheet.png\") no-repeat " + img_pos + ";' />&nbsp;</a>" + affichage;
				}
				else if(tab[i][2] == "pokemon" || tab[i][2] == "numero")
				{
					var img_pos = "-" + (32 * Math.floor((tab[i][3] - 1) % 25)) + "px -" + (24 * Math.floor((tab[i][3] - 1) / 25)) + "px";
					affichage = "<a class='thumbnail' style='width: 32px; height: 24px; background: url(\"/images/pkmn/mini/thumbnail_spritesheet.png\") no-repeat " + img_pos + ";' />&nbsp;</a>" + affichage;
				}
				else if(tab[i][2] == "attaque")
				{					
					var img_pos = "0px -" + (14 * Math.floor(tab[i][4] - 1)) + "px";
					affichage = "<a class='thumbnail' style='width: 32px; height: 14px; background: url(\"/images/pkmn/type/category_spritesheet.png\") no-repeat " + img_pos + ";' />&nbsp;</a>" + affichage;
				}

				$("#menu").html($("#menu").html() + "<div id='completion_" + i + "' class='" + tab[i][2] + "' data-val='" + tab[i][3] + "'>" + affichage + "</div>");
			}
			
			// Auto-selection si resultat pertinent.
			if(tab.length == 1)
			{
				selectionner_completion_fleches(0);
				
				if(saisie.match(/[^ ] $/)) // Permet de valider le mot avec un espace pour les gens qui tapent trop vite ou sur smartphone.
				{
					if(!saisie.match(/[<>=]/)) // Permet d'eviter les boucles infinies (la validation d'une stat change la saisie avec un espace a la fin, ce qui entraine l'auto_completion qui entraine la validation ...).
						valider_completion(0);
				}
			}
			else if(tab.length > 1)
			{
				if($.trim(effacer_accents(tab[0][1].toLowerCase().replace(/&nbsp;/, " "))) == saisie)
				{
					if(tab[1][0] >= 0)
					{
						selectionner_completion_fleches(0);
					}
				}
			}
			
			modifier_bordure_saisie();
		}
		
		function modifier_bordure_saisie()
		{
			if($("#menu div").length > 0)
			{
				$("#saisie").css("border-bottom-left-radius", "0px");
				$("#saisie").css("border-bottom-right-radius", "0px");
			}
			else
			{
				$("#saisie").css("border-bottom-left-radius", "10px");
				$("#saisie").css("border-bottom-right-radius", "10px");
			}
		}

		function afficher_nombre_resultats()
		{
			var nombre_affiches = 0;
			var nombre_pokemons = 0;
			var liste = [];

			$("#pokedex > .resultat").each(
				function() 
				{
					var id = $(this).attr("data-id");
					
					if(liste.indexOf(id) == -1)
					{
						nombre_pokemons++;
						liste.push(id);
					}

					nombre_affiches++;
				}
			);

			var nombre_formes_supplementaires = nombre_affiches - nombre_pokemons;
			
			var liste_cat = new Array;
			var liste_val = new Array;
			$("#filtre > div").each(
				function()
				{
					liste_cat.push(encodeURIComponent($(this).attr("class")));
					liste_val.push(encodeURIComponent($(this).attr("data-val")));
				}
			);




			//////////////////////////////////////////////////////////////
			if($.inArray("attaque", liste_cat) != -1)
			{
				if($.inArray("attaque", liste_cat, $.inArray("attaque", liste_cat) + 1) != -1) // S'il y a plusieurs elements de cette categorie.
				{
					//alert("competence");
				}
			}
			//////////////////////////////////////////////////////////////




			// On adapte l'affichage des resultats.
			if($("#pokedex").css("width").replace(/px/, "") > nombre_affiches * 96)
				$("#pokedex > .resultat").css("float", "none");
			else
				$("#pokedex > .resultat").css("float", "left");
			
			// Affichage du nombre de resultats.
			if($("#pokedex > img").length > 0) // Si on charge les resultats.
			{
				$("#nombre_resultats_recherche").html("<i><?php echo SEARCH_IN_PROGRESS ?></i>");
			}
			else
			{
				var texte = "";
				if(nombre_affiches == 0)
				{
					texte = "<?php echo NONE . ' ' . RESULT_SINGULAR; ?>";
				}
				else if(nombre_affiches == 1)
				{
					texte = "1 <?php echo SINGLE . ' ' . RESULT_SINGULAR; ?>";
				}
				else
				{
					texte = nombre_affiches + " <?php echo RESULT_PLURAL ?>";
					
					if(nombre_formes_supplementaires > 0)
					{
						if(nombre_pokemons == 1)
							texte += " (1 Pok&eacute;mon";
						else
							texte += " (" + nombre_pokemons + " Pok&eacute;mon(s)";
						
						if(nombre_formes_supplementaires == 1)
							texte += " + 1 <?php echo FORM_SINGULAR ?>)";
						else
							texte += " + " + nombre_formes_supplementaires + " <?php echo FORM_PLURAL ?>)";
					}
					/*else if(nombre_formes > 0) // A ce point, on a trouve que des "first".
					{
						if(nombre_formes == 1)
							texte += " (Dont 1 forme particuli&egrave;re)";
						else
							texte += " (Dont " + nombre_formes + " formes particuli&egrave;res)";
					}*/
				}
				
				$("#nombre_resultats_recherche").html(texte);
			}
		}
		
		function afficher_infos_survol(id, event)
		{
			var cursor = getCursor(event);

			if(navigator.appName.match(/Microsoft/))
			{
				$("#info_bulle_survol").css("margin-left", (cursor.x + 15) + "px");
				$("#info_bulle_survol").css("margin-top", (cursor.y + document.body.scrollTop + 15) + "px");
			}
			else
			{
				$("#info_bulle_survol").css("margin-left", (cursor.x + 15) + "px");
				$("#info_bulle_survol").css("margin-top", (cursor.y + 15) + "px");
			}
		}
		
		function remplir_info_bulle(id, forme)
		{
			$.get("/ajax/get_info_bulle.php", { id: id, forme: forme }, 
				function(data) 
				{
					$("#info_bulle_survol").html("").html(data);
					$("#info_bulle_survol").css("display", "block");
				}
			);
		}

		function getCursor(e) //Cette fonction n'est pas de moi.
		{
			e = e || window.event;
			return {'x': e.clientX, 'y': e.clientY};
		}
		
		function click_completion(id)
		{
			numero_completion = id;
			valider_completion(0);
		}
		
		function introduce_obj(obj)
		{
			// Gestion de la transparence des elements.
			$("body *").css("opacity", "1");
			
			// Gestion de l'animation de halo lumineux.
			$("body *").css("animation", "");
			$("body *").css("-webkit-animation", "");

			if(obj != undefined && obj != null)
			{
				// Gestion de la transparence des elements.
				$("body *").css("opacity", "0.5");
				$("#tuto").css("opacity", "1");
				$("#tuto *").css("opacity", "1");
				
				obj.css("opacity", "1");
				obj.find("*").css("opacity", "1");
				obj.parents().css("opacity", "1");
			
				// Gestion de l'animation de halo lumineux.
				obj.css("animation", "Glowing .6s infinite alternate");
				obj.css("-webkit-animation", "Glowing .6s infinite alternate");
			}
		}
		</script>
    </head>
	
    <body>			
		<div id="fond"></div>
		<!-- Debut Google Analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-39929226-1', 'encyclopedex.com');
			ga('send', 'pageview');
		</script>
		<!-- Fin Google Analytics -->
		
		<!-- Debut SDK JS Facebook -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=183420345139463";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
		<!-- Fin SDK JS Facebook -->
		
		<div id="pop" class="popup">
			<div><?php echo SHARE_URL_POPUP ?></div>
			<input type="text" id="url_share" />
		</div>
		
		<div id="tuto" class="popup">
			<div>
				<?php echo TUTO_PANEL_0 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_YES_YES ?>" /><br />
				<input class="close_popup" type="button" value="<?php echo TUTO_NO_NO ?>" />
			</div>
			
			<div>
				<?php echo TUTO_PANEL_1 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_BUTTON_NEXT ?>" />
			</div>
			
			<div>
				<?php echo TUTO_PANEL_2 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_BUTTON_NEXT ?>" />
			</div>
			
			<div>
				<?php echo TUTO_PANEL_3 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_BUTTON_NEXT ?>" />
			</div>
			
			<div>
				<?php echo TUTO_PANEL_4 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_BUTTON_NEXT ?>" />
			</div>
			
			<div>
				<?php echo TUTO_PANEL_5 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_BUTTON_NEXT ?>" />
			</div>
			
			<div>
				<?php echo TUTO_PANEL_6 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_BUTTON_NEXT ?>" />
			</div>

			<div>
				<?php echo TUTO_PANEL_7 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_BUTTON_NEXT ?>" />
			</div>

			<div>
				<?php echo TUTO_PANEL_8 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_BUTTON_NEXT ?>" />
			</div>

			<div>
				<?php echo TUTO_PANEL_9 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_BUTTON_NEXT ?>" />
			</div>

			<div>
				<?php echo TUTO_PANEL_10 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_BUTTON_NEXT ?>" />
			</div>
			
			<div>
				<?php echo TUTO_PANEL_11 ?>
				<input class="avancer_tuto" type="button" value="<?php echo TUTO_BUTTON_FINISH ?>" />
			</div>
		</div>
		
		
				
		<div id="info_bulle_survol">
		</div>
		
		<div id="header">
			<div id="logo">
				<a href="http://encyclopedex.com"><img src="/images/logos/encyclopedex_logo7.png" alt="Encyclopedex" /></a>
			</div>
			
			<div id="social">
				<!-- Debut medias sociaux -->
				<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.encyclopedex.com%2F&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=183420345139463" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe>
				
				<div class="social_button">
					<a href="https://twitter.com/share" class="twitter-share-button" data-lang="<?php echo $lang; ?>">Tweeter</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
				
				<!-- Place this tag where you want the +1 button to render. -->
				<div class="g-plusone" class="social_button" data-size="medium"></div>

				<!-- Place this tag after the last +1 button tag. -->
				<script type="text/javascript">
				  window.___gcfg = {lang: '<?php echo $lang; ?>'};

				  (function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/plusone.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
				<!-- Fin medias sociaux -->
				
				<br />
				
				<div>
					Contact : <a href="mailto:contact@encyclopedex.com">contact@encyclopedex.com</a>
				</div>

				<div id="langs">
					<img src="/images/flags/flag_en.png" title="Let's speak English" alt="en" />
					<img src="/images/flags/flag_fr.png" title="Parlons Fran&ccedil;ais" alt="fr" />
				</div>
			</div>
			
			
			<div id="espace_recherche">
				<div id="filtre">
				</div>
						
				<div style="margin: 0.5em auto; width: 15em;">
						<div>
							<input id="saisie" type="text" onkeyup="recherche(event);" placeholder="<?php echo SEARCH_PLACEHOLDER ?>" autocomplete="off" autofocus />
						</div>

						<div id="menu">
						</div>
				</div>
				
				<script type="text/javascript">
					$("#saisie").val("");
					$("#saisie").focus();
				</script>
			</div>
		</div>
		
		<div id="total" style="margin: auto; text-align: center;">
			<div id="nombre_resultats_recherche" style="padding-top: 100px; "></div>
			
			<div id="pokedex" style="max-width: 960px; margin: auto;"></div>
		</div>
		
		<div id="footer">
			<div id="equipe">
			</div>
			
			<div>
				<input type='button' value='<?php echo COMPARE ?>' /><br />
				<input type='button' value='<?php echo BATTLE ?>' /><br />
				<input type='button' value='<?php echo ANALYZE ?>' />
			</div>
		</div>
	</body>
	
</html>