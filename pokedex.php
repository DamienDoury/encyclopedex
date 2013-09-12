<?php
include "ressources/code_alphabet.php";

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
<<<<<<< HEAD
}

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

// SAVED
$lang = "";
if(isset($_COOKIE["lang"]))
{
	$lang = $_COOKIE["lang"];
	//!preg_match("#^(en|fr)$#i", $lang)
	if($lang != "fr" && $lang != "en" && $lang != "FR" && $lang != "EN") // If the user modified his cookie with a not managed language, then we cancel it.
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
	if($requested_lang != "fr" && $requested_lang != "en" && $requested_lang != "FR" && $requested_lang != "EN") // If the user modified the URL with a not managed language, we cancel it.
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

setcookie("deja_visite", true, time() + 3600 * 24 * 365 * 2, "/", ".encyclopedex.com"); // On se souvient de la derniere visite pendant 2 ans.

include_once $_SERVER['DOCUMENT_ROOT'] . "/langs/" . $lang . ".php";
?>
=======
	
	// Creation de la liste des valeurs.
	/*$r_values = "";
	$list = array();
	
	for($i = 1; $i < strlen($r); $i += 3)
	{
		$list[] = strpos($alphabet, $r[$i]) * Math.pow(strlen($alphabet), 2) + strpos($alphabet, $r[$i + 1]) * strlen($alphabet) + strpos($alphabet, $r[$i + 2]);
	}
	
	$r_values = implode(",", $list);*/
}

$welcome = false;
if(!isset($_COOKIE["deja_visite"]))
{
	$welcome = true;
}

setcookie("deja_visite", true, time() + 3600 * 24 * 365 * 2); // On se souvient de la derniere visite pendant 2 ans.
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Pok&eacute;dex - Encyclopedex</title>
		<link rel="icon" type="image/png" href="/images/icones/loupe 32x32.png" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="L'Encyclopedex est le meilleur Pokédex stratégique pour Pokémon Noir 2/Blanc 2 grâce à son moteur de recherche simple, intuitif et performant !" />
		<meta name="keywords" content="pokedex, encyclopedex, Pokédex, encyclopédie, encyclopedia, Pokémon, pokemon, meilleur, moteur de recherche, noir, blanc, xy, base de donnees, database" />
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script type="text/javascript" src="/libs/bPopup.js"></script>
		<style type="text/css">
			body
			{
				/*background-image: url('images/backgrounds/bg_stripe.png'), url("images/backgrounds/bg_degrade.png");
				background-position: left top, left top;
				background-repeat: repeat, repeat-x;
				background-attachment: fixed;
				background-color: #D7D7B1;*/
				
				
				
				/*background-image: linear-gradient(to top, #4C2121, #D7D7B1);
				background-image: url('images/backgrounds/bg_stripe.png'), -o-linear-gradient(to bottom, #4C2121, #D7D7B1);
				background-image: -moz-linear-gradient(to top, #4C2121, #D7D7B1);
				background-image: -webkit-linear-gradient(to bottom, #4C2121, #D7D7B1);
				background-image: -ms-linear-gradient(to bottom, #4C2121, #D7D7B1);
				background-image: -webkit-gradient(
					linear,
					left bottom,
					left top,
					color-stop(0.00, #4C2121),
					color-stop(1.00, #D7D7B1)
				);
				background-color: #4C2121;
				background-size: 1px 1000px;
				background-repeat: repeat-x;
				background-attachment: fixed;
				background-position: left top;*/
				
				font-family: 'Tahoma', sans-serif;
				font-variant: small-caps;
				color: #792400;
			}
			
			#fond
			{
				background-image: url("/images/backgrounds/fond_body.png");
				background-repeat: repeat-x;
				background-attachment: fixed;
				background-color: #4C2121;
				
				position: fixed;
				top: 0px;
				right: 0px;
				bottom: 0px;
				left: 0px;
				z-index: -1;
			}
			
			img
			{
				border: none;
			}
			
			.equipe
			{
				text-align: center;
			}
			
			.popup
			{
				display: none;
				padding: 1em;
				
				font-family: Verdana;
				color: white;
				size: 4em;
				text-align: center;
				
				background-color: #888888;
				
				border: 4px outset #999999;
				border-radius: 20px;
				
				box-shadow: 0 0 35px 5px #999999;
			}
			
			.popup div p
			{
				text-align: left;
			}
			
			.popup div div
			{
				margin: auto;
				max-width: 12em;
			}
			
			.popup input:first-of-type
			{
				margin-top: 1.5em;
			}
			
			#pop > input
			{
				min-width: 25em;
				text-align: center;
				
				border-radius: 5px;
				box-shadow: 0px 0px 15px 5px #FFDE8D;
			}
			
			#tuto > div
			{
				display: none;
				position: relative;
				top: 0;
				left: 0;
			}
			
			#social
			{
				position: absolute;
				left: auto;
				right: 0;
			}
			
			#social div
			{
				color: #ECEEF5;
			}
			
			#social div a
			{
				color: #CCCCCC;
			}
			
			#logo
			{
				position: absolute;
				left: 0;
				right: auto;
			}
			
			#logo img
			{
				margin-left: 0.5em;
				width: 320px;
			}
			
			.social_button
			{
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
				margin-left: 0px;
				padding-top: 0px;
				padding-right: 0px;
				padding-bottom: 0px;
				padding-left: 0px;
				vertical-align: baseline;
				display: inline-block;
				width: 90px;
				height: 20px;
			}
			
			#info_bulle_survol
			{
				display: none;
				position: fixed;
				z-index: 4;
				
				width: 90px;
				margin: 0px;
				padding: 3px;
				
				background-color: #FFEAA4;
				text-align: center;
				border-width: 1px;
				border-style: outset;
				border-color: black;
				font-size: 14px;
			}
			
			#header
			{
				position: fixed;
				z-index: 1;
				width: 100%;
				height: 74px;
				top: 0;
				left: 0;
				padding-top: 10px;
				text-align: center;
				
				background-image: url("/images/backgrounds/fond_header.png");
				background-repeat: repeat-x;
				box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.5);
				border-bottom: 1px solid rgba(34, 34, 34, 0.8);
			}
			
			#filtre
			{
				position: relative;
				z-index: 2;
			}
			
			#filtre > *
			{
				vertical-align: bottom;
			}
			
			#filtre > *:hover
			{
				cursor: pointer;
			}

			#filtre > div
			{
				display: inline;
				
				border: 1px solid green;
				box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
				
				margin-left: -1px;
			}
			
			#filtre > img
			{
				margin: 0 1em;
			}
			
			#saisie
			{
				position: relative;
				z-index: 2;
				outline-style: none;
				
				width: 240px;
				height: 24px;
				margin: 0; 
				padding: 0;
				
				text-align: center;
				font-size: 16px;
				font-variant: small-caps;
				color: #792400;
				
				border-style: dotted;
				border-width: 1px;
				border-color: black;
				border-radius: 10px;
				//box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
				
				background-color: #F6E652;
				//background-color: #8FD0D0;
				//background-color: transparent;
				background-image: url("/images/backgrounds/fond_critere.png"), url("/images/icones/loupe 16x16.png");
				background-repeat: repeat-x, no-repeat;
				background-position: bottom, 2% center;
			}

			#saisie::-webkit-input-placeholder { text-align: center; font-size: 0.8em; color: gray; }
			#saisie::-moz-placeholder { text-align: center; font-size: 0.8em; color: gray; } /* firefox 19+ */
			#saisie:-ms-input-placeholder { text-align: center; font-size: 0.8em; color: gray; } /* ie */
			#saisie:-moz-placeholder { text-align: center; font-size: 0.8em; color: gray; }

			#menu
			{
				position: absolute;
				z-index: 3;
				
				box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
								
				margin: 0;
				padding: 0;
				width: 15em;
				text-align: center;
			}
			
			#menu > *
			{
				text-align: center;
				width: 240px;
				height: 32px;
				position: relative;
				
				margin-top: -1px;
				
				border: 1px solid brown;

				/* Firefox */
				display: -moz-box;
				-moz-box-pack: center;
				-moz-box-align: center;

				/* Safari, Opera, and Chrome */
				display: -webkit-box;
				-webkit-box-pack: center;
				-webkit-box-align: center;

				/* W3C */
				display: box;
				box-pack: center;
				box-align: center;
			}
			
			#menu > div:hover
			{
				cursor: pointer;
			}
			
			#menu > div > *
			{
				vertical-align: middle;
			}
			
			@media (max-device-width: 900px)
			{
				#fond
				{
					background-image: linear-gradient(to top, #4C2121, #D7D7B1);
					background-image: -o-linear-gradient(to bottom, #4C2121, #D7D7B1);
					background-image: -moz-linear-gradient(to top, #4C2121, #D7D7B1);
					background-image: -webkit-linear-gradient(to bottom, #4C2121, #D7D7B1);
					background-image: -ms-linear-gradient(to bottom, #4C2121, #D7D7B1);
					background-image: -webkit-gradient(
						linear,
						left bottom,
						left top,
						color-stop(0.00, #4C2121),
						color-stop(1.00, #D7D7B1)
					);
					background-color: #4C2121;
					background-size: 1px 1000px;
					background-repeat: repeat-x;
					background-attachment: fixed;
					background-position: left top;
				}
			}
			
			@media (max-device-width: 900px), (max-width: 900px)
			{
				#header
				{
					height: auto;
					
					background-color: #550000;
					background-image: url("/images/backgrounds/fond_header.png");
					background-repeat: repeat-x;
					background-position: bottom;
				}
				
				#logo
				{
					position: relative;
					left: auto;
					right: auto;
				}
				
				#social
				{
					position: relative;
					left: auto;
					right: auto;
				}
				
				#espace_recherche
				{
					position: relative;
					left: auto;
					right: auto;
				}
				
				#total
				{
					padding-top: 150px;
				}
			}
			
			.pokemon
			{
				background-color: #FFDE8D; 
				background-image: url("/images/backgrounds/fond_critere.png");
				background-repeat: repeat-x;
				background-position: bottom;
				
				border: 1px solid brown;
			}
			
			.numero
			{
				background-color: #BEBEBE; 
				background-image: url("/images/backgrounds/fond_critere.png");
				background-repeat: repeat-x;
				background-position: bottom;
				
				border: 1px solid brown;
			}
			
			.capspe
			{
				background-color: #FEA99A; 
				background-image: url("/images/backgrounds/fond_critere.png");
				background-repeat: repeat-x;
				background-position: bottom;
				
				border: 1px solid brown;
			}
			
			.type
			{
				background-color: #3AFC9B; 
				background-image: url("/images/backgrounds/fond_critere.png");
				background-repeat: repeat-x;
				background-position: bottom;
				
				border: 1px solid brown;
			}
			
			.attaque
			{
				background-color: #FF9966; 
				background-image: url("/images/backgrounds/fond_critere.png");
				background-repeat: repeat-x;
				background-position: bottom;
				
				border: 1px solid brown;
			}
			
			.stat
			{
				background-color: #5050FF; 
				background-image: url("/images/backgrounds/fond_critere.png");
				background-repeat: repeat-x;
				background-position: bottom;
				
				border: 1px solid brown;
			}
			
			.carac_attaque
			{
				background-color: #FFFFFF; 
				background-image: url("/images/backgrounds/fond_critere.png");
				background-repeat: repeat-x;
				background-position: bottom;
				
				border: 1px solid brown;
			}
			
			.resultat
			{
				display: inline-block;
				float: left; 
				min-width: 96px;
				min-height: 96px;
			}
			
			.resultat:hover
			{
				cursor: pointer;
				background-image: url("/images/icones/select 96x96.png");
				background-repeat: no-repeat;
			}
			
			/*.resultat img:hover
			{
				image-rendering: pixelated;
				position: absolute;
				margin-top: -48px;
				margin-left: -48px;
				height: 192px;
				width: 192px;
			}*/
			
			.resultat > div
			{
				float: right;
				text-align: right;
				
				color: white;
				font-family: Courier New, monospace;
				font-size: 13px; 
			}
			
			.resultat > div a
			{
				display: block;
				margin-left: -96px;
				position: relative;
			}
			
			.resultat > div > a:nth-child(even)
			{
				text-shadow: -1px 0px 2px red, 0px 1px 2px red, 1px 0px 2px red, 0px -1px 2px red;					
			}
			
			.resultat > div > a:nth-child(odd)
			{
				text-shadow: -1px 0px 2px blue, 0px 1px 2px blue, 1px 0px 2px blue, 0px -1px 2px blue;
			}

			@-moz-document url-prefix() /* We activate this feature only under Firefox because it's the only one to implement the crisp edges. */
			{			
				.resultat img 
				{
					image-rendering: -moz-crisp-edges;
					image-rendering: -o-crisp-edges;
					image-rendering: optimize-contrast;
					image-rendering: -webkit-optimize-contrast;
					-ms-interpolation-mode: nearest-neighbor;

					transition: all 0.35s;
					-webkit-transition: all 0.35s;
				}

				.resultat img:hover
				{
					transform: scale(2);
					-ms-transform: scale(2);
					-webkit-transform: scale(2);

					z-index: 5;
				}

				.resultat:hover
				{
					background: none;
				}
			}

			#footer
			{
				display: none;
				position: fixed;
				z-index: 1;
				width: 100%;
				height: 106px;
				text-align: center;
				top: 100%;
				margin-top: -106px;
				padding: 5px;
				left: 0;
				
				background-image: url("/images/backgrounds/fond_footer.png");
				background-repeat: repeat-x;
				box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
				border-top: 1px solid rgba(34, 34, 34, 0.8);
			}
			
			#footer > div
			{
				display: inline-block;
				height: 100%;
				vertical-align: middle;
			}

			#footer input
			{
				width: 100px;

				border: 1px solid black;
				border-radius: 5px;
				background-color: green;
			}
			
			#equipe
			{
				margin: auto;
				clear: both;
				max-width: 600px;
			}

			.loading
			{
				animation: Rotate 1s infinite;
				-webkit-animation: Rotate 1s infinite;
			}

			@keyframes Rotate
			{
				0%   {transform: rotate(0deg);}
				0%   {-webkit-transform: rotate(0deg);}
				100% {transform: rotate(360deg);}
				100% {-webkit-transform: rotate(360deg);}
			}
			
			@-webkit-keyframes Rotate /* Safari and Chrome */
			{
				0%   {transform: rotate(0deg);}
				0%   {-webkit-transform: rotate(0deg);}
				100% {transform: rotate(360deg);}
				100% {-webkit-transform: rotate(360deg);}
			}

			@keyframes Glowing
			{
				0%   {box-shadow: 0px 0px 10px 4px yellow;}
				100% {box-shadow: 0px 0px 30px 12px white;}
			}
			
			@-webkit-keyframes Glowing /* Safari and Chrome */
			{
				0%   {box-shadow: 0px 0px 10px 4px yellow;}
				100% {box-shadow: 0px 0px 30px 12px white;}
			}
		</style>
		<script type="text/javascript">
		
		critere_et = true;
		selection_auto = true;
		mode_recherche = true;
	
		nombre_selections = 0;
		numero_completion = -1;
		
		saisie_precedente = "";
		focus_saisie = false;
		
		nombre_requetes = 0;
		
		var bdd = []; // L'avantage avec ce systeme, c'est qu'on peut partager les requetes. Un parametre en GET peut pre-selectionner la liste de mots cles.
		bdd.push(["1","numero","1"]);
		bdd.push(["2","numero","2"]);
		bdd.push(["3","numero","3"]);
		bdd.push(["4","numero","4"]);
		bdd.push(["5","numero","5"]);
		bdd.push(["6","numero","6"]);
		bdd.push(["7","numero","7"]);
		bdd.push(["8","numero","8"]);
		bdd.push(["9","numero","9"]);
		bdd.push(["10","numero","10"]);
		bdd.push(["11","numero","11"]);
		bdd.push(["12","numero","12"]);
		bdd.push(["13","numero","13"]);
		bdd.push(["14","numero","14"]);
		bdd.push(["15","numero","15"]);
		bdd.push(["16","numero","16"]);
		bdd.push(["17","numero","17"]);
		bdd.push(["18","numero","18"]);
		bdd.push(["19","numero","19"]);
		bdd.push(["20","numero","20"]);
		bdd.push(["21","numero","21"]);
		bdd.push(["22","numero","22"]);
		bdd.push(["23","numero","23"]);
		bdd.push(["24","numero","24"]);
		bdd.push(["25","numero","25"]);
		bdd.push(["26","numero","26"]);
		bdd.push(["27","numero","27"]);
		bdd.push(["28","numero","28"]);
		bdd.push(["29","numero","29"]);
		bdd.push(["30","numero","30"]);
		bdd.push(["31","numero","31"]);
		bdd.push(["32","numero","32"]);
		bdd.push(["33","numero","33"]);
		bdd.push(["34","numero","34"]);
		bdd.push(["35","numero","35"]);
		bdd.push(["36","numero","36"]);
		bdd.push(["37","numero","37"]);
		bdd.push(["38","numero","38"]);
		bdd.push(["39","numero","39"]);
		bdd.push(["40","numero","40"]);
		bdd.push(["41","numero","41"]);
		bdd.push(["42","numero","42"]);
		bdd.push(["43","numero","43"]);
		bdd.push(["44","numero","44"]);
		bdd.push(["45","numero","45"]);
		bdd.push(["46","numero","46"]);
		bdd.push(["47","numero","47"]);
		bdd.push(["48","numero","48"]);
		bdd.push(["49","numero","49"]);
		bdd.push(["50","numero","50"]);
		bdd.push(["51","numero","51"]);
		bdd.push(["52","numero","52"]);
		bdd.push(["53","numero","53"]);
		bdd.push(["54","numero","54"]);
		bdd.push(["55","numero","55"]);
		bdd.push(["56","numero","56"]);
		bdd.push(["57","numero","57"]);
		bdd.push(["58","numero","58"]);
		bdd.push(["59","numero","59"]);
		bdd.push(["60","numero","60"]);
		bdd.push(["61","numero","61"]);
		bdd.push(["62","numero","62"]);
		bdd.push(["63","numero","63"]);
		bdd.push(["64","numero","64"]);
		bdd.push(["65","numero","65"]);
		bdd.push(["66","numero","66"]);
		bdd.push(["67","numero","67"]);
		bdd.push(["68","numero","68"]);
		bdd.push(["69","numero","69"]);
		bdd.push(["70","numero","70"]);
		bdd.push(["71","numero","71"]);
		bdd.push(["72","numero","72"]);
		bdd.push(["73","numero","73"]);
		bdd.push(["74","numero","74"]);
		bdd.push(["75","numero","75"]);
		bdd.push(["76","numero","76"]);
		bdd.push(["77","numero","77"]);
		bdd.push(["78","numero","78"]);
		bdd.push(["79","numero","79"]);
		bdd.push(["80","numero","80"]);
		bdd.push(["81","numero","81"]);
		bdd.push(["82","numero","82"]);
		bdd.push(["83","numero","83"]);
		bdd.push(["84","numero","84"]);
		bdd.push(["85","numero","85"]);
		bdd.push(["86","numero","86"]);
		bdd.push(["87","numero","87"]);
		bdd.push(["88","numero","88"]);
		bdd.push(["89","numero","89"]);
		bdd.push(["90","numero","90"]);
		bdd.push(["91","numero","91"]);
		bdd.push(["92","numero","92"]);
		bdd.push(["93","numero","93"]);
		bdd.push(["94","numero","94"]);
		bdd.push(["95","numero","95"]);
		bdd.push(["96","numero","96"]);
		bdd.push(["97","numero","97"]);
		bdd.push(["98","numero","98"]);
		bdd.push(["99","numero","99"]);
		bdd.push(["100","numero","100"]);
		bdd.push(["101","numero","101"]);
		bdd.push(["102","numero","102"]);
		bdd.push(["103","numero","103"]);
		bdd.push(["104","numero","104"]);
		bdd.push(["105","numero","105"]);
		bdd.push(["106","numero","106"]);
		bdd.push(["107","numero","107"]);
		bdd.push(["108","numero","108"]);
		bdd.push(["109","numero","109"]);
		bdd.push(["110","numero","110"]);
		bdd.push(["111","numero","111"]);
		bdd.push(["112","numero","112"]);
		bdd.push(["113","numero","113"]);
		bdd.push(["114","numero","114"]);
		bdd.push(["115","numero","115"]);
		bdd.push(["116","numero","116"]);
		bdd.push(["117","numero","117"]);
		bdd.push(["118","numero","118"]);
		bdd.push(["119","numero","119"]);
		bdd.push(["120","numero","120"]);
		bdd.push(["121","numero","121"]);
		bdd.push(["122","numero","122"]);
		bdd.push(["123","numero","123"]);
		bdd.push(["124","numero","124"]);
		bdd.push(["125","numero","125"]);
		bdd.push(["126","numero","126"]);
		bdd.push(["127","numero","127"]);
		bdd.push(["128","numero","128"]);
		bdd.push(["129","numero","129"]);
		bdd.push(["130","numero","130"]);
		bdd.push(["131","numero","131"]);
		bdd.push(["132","numero","132"]);
		bdd.push(["133","numero","133"]);
		bdd.push(["134","numero","134"]);
		bdd.push(["135","numero","135"]);
		bdd.push(["136","numero","136"]);
		bdd.push(["137","numero","137"]);
		bdd.push(["138","numero","138"]);
		bdd.push(["139","numero","139"]);
		bdd.push(["140","numero","140"]);
		bdd.push(["141","numero","141"]);
		bdd.push(["142","numero","142"]);
		bdd.push(["143","numero","143"]);
		bdd.push(["144","numero","144"]);
		bdd.push(["145","numero","145"]);
		bdd.push(["146","numero","146"]);
		bdd.push(["147","numero","147"]);
		bdd.push(["148","numero","148"]);
		bdd.push(["149","numero","149"]);
		bdd.push(["150","numero","150"]);
		bdd.push(["151","numero","151"]);
		bdd.push(["152","numero","152"]);
		bdd.push(["153","numero","153"]);
		bdd.push(["154","numero","154"]);
		bdd.push(["155","numero","155"]);
		bdd.push(["156","numero","156"]);
		bdd.push(["157","numero","157"]);
		bdd.push(["158","numero","158"]);
		bdd.push(["159","numero","159"]);
		bdd.push(["160","numero","160"]);
		bdd.push(["161","numero","161"]);
		bdd.push(["162","numero","162"]);
		bdd.push(["163","numero","163"]);
		bdd.push(["164","numero","164"]);
		bdd.push(["165","numero","165"]);
		bdd.push(["166","numero","166"]);
		bdd.push(["167","numero","167"]);
		bdd.push(["168","numero","168"]);
		bdd.push(["169","numero","169"]);
		bdd.push(["170","numero","170"]);
		bdd.push(["171","numero","171"]);
		bdd.push(["172","numero","172"]);
		bdd.push(["173","numero","173"]);
		bdd.push(["174","numero","174"]);
		bdd.push(["175","numero","175"]);
		bdd.push(["176","numero","176"]);
		bdd.push(["177","numero","177"]);
		bdd.push(["178","numero","178"]);
		bdd.push(["179","numero","179"]);
		bdd.push(["180","numero","180"]);
		bdd.push(["181","numero","181"]);
		bdd.push(["182","numero","182"]);
		bdd.push(["183","numero","183"]);
		bdd.push(["184","numero","184"]);
		bdd.push(["185","numero","185"]);
		bdd.push(["186","numero","186"]);
		bdd.push(["187","numero","187"]);
		bdd.push(["188","numero","188"]);
		bdd.push(["189","numero","189"]);
		bdd.push(["190","numero","190"]);
		bdd.push(["191","numero","191"]);
		bdd.push(["192","numero","192"]);
		bdd.push(["193","numero","193"]);
		bdd.push(["194","numero","194"]);
		bdd.push(["195","numero","195"]);
		bdd.push(["196","numero","196"]);
		bdd.push(["197","numero","197"]);
		bdd.push(["198","numero","198"]);
		bdd.push(["199","numero","199"]);
		bdd.push(["200","numero","200"]);
		bdd.push(["201","numero","201"]);
		bdd.push(["202","numero","202"]);
		bdd.push(["203","numero","203"]);
		bdd.push(["204","numero","204"]);
		bdd.push(["205","numero","205"]);
		bdd.push(["206","numero","206"]);
		bdd.push(["207","numero","207"]);
		bdd.push(["208","numero","208"]);
		bdd.push(["209","numero","209"]);
		bdd.push(["210","numero","210"]);
		bdd.push(["211","numero","211"]);
		bdd.push(["212","numero","212"]);
		bdd.push(["213","numero","213"]);
		bdd.push(["214","numero","214"]);
		bdd.push(["215","numero","215"]);
		bdd.push(["216","numero","216"]);
		bdd.push(["217","numero","217"]);
		bdd.push(["218","numero","218"]);
		bdd.push(["219","numero","219"]);
		bdd.push(["220","numero","220"]);
		bdd.push(["221","numero","221"]);
		bdd.push(["222","numero","222"]);
		bdd.push(["223","numero","223"]);
		bdd.push(["224","numero","224"]);
		bdd.push(["225","numero","225"]);
		bdd.push(["226","numero","226"]);
		bdd.push(["227","numero","227"]);
		bdd.push(["228","numero","228"]);
		bdd.push(["229","numero","229"]);
		bdd.push(["230","numero","230"]);
		bdd.push(["231","numero","231"]);
		bdd.push(["232","numero","232"]);
		bdd.push(["233","numero","233"]);
		bdd.push(["234","numero","234"]);
		bdd.push(["235","numero","235"]);
		bdd.push(["236","numero","236"]);
		bdd.push(["237","numero","237"]);
		bdd.push(["238","numero","238"]);
		bdd.push(["239","numero","239"]);
		bdd.push(["240","numero","240"]);
		bdd.push(["241","numero","241"]);
		bdd.push(["242","numero","242"]);
		bdd.push(["243","numero","243"]);
		bdd.push(["244","numero","244"]);
		bdd.push(["245","numero","245"]);
		bdd.push(["246","numero","246"]);
		bdd.push(["247","numero","247"]);
		bdd.push(["248","numero","248"]);
		bdd.push(["249","numero","249"]);
		bdd.push(["250","numero","250"]);
		bdd.push(["251","numero","251"]);
		bdd.push(["252","numero","252"]);
		bdd.push(["253","numero","253"]);
		bdd.push(["254","numero","254"]);
		bdd.push(["255","numero","255"]);
		bdd.push(["256","numero","256"]);
		bdd.push(["257","numero","257"]);
		bdd.push(["258","numero","258"]);
		bdd.push(["259","numero","259"]);
		bdd.push(["260","numero","260"]);
		bdd.push(["261","numero","261"]);
		bdd.push(["262","numero","262"]);
		bdd.push(["263","numero","263"]);
		bdd.push(["264","numero","264"]);
		bdd.push(["265","numero","265"]);
		bdd.push(["266","numero","266"]);
		bdd.push(["267","numero","267"]);
		bdd.push(["268","numero","268"]);
		bdd.push(["269","numero","269"]);
		bdd.push(["270","numero","270"]);
		bdd.push(["271","numero","271"]);
		bdd.push(["272","numero","272"]);
		bdd.push(["273","numero","273"]);
		bdd.push(["274","numero","274"]);
		bdd.push(["275","numero","275"]);
		bdd.push(["276","numero","276"]);
		bdd.push(["277","numero","277"]);
		bdd.push(["278","numero","278"]);
		bdd.push(["279","numero","279"]);
		bdd.push(["280","numero","280"]);
		bdd.push(["281","numero","281"]);
		bdd.push(["282","numero","282"]);
		bdd.push(["283","numero","283"]);
		bdd.push(["284","numero","284"]);
		bdd.push(["285","numero","285"]);
		bdd.push(["286","numero","286"]);
		bdd.push(["287","numero","287"]);
		bdd.push(["288","numero","288"]);
		bdd.push(["289","numero","289"]);
		bdd.push(["290","numero","290"]);
		bdd.push(["291","numero","291"]);
		bdd.push(["292","numero","292"]);
		bdd.push(["293","numero","293"]);
		bdd.push(["294","numero","294"]);
		bdd.push(["295","numero","295"]);
		bdd.push(["296","numero","296"]);
		bdd.push(["297","numero","297"]);
		bdd.push(["298","numero","298"]);
		bdd.push(["299","numero","299"]);
		bdd.push(["300","numero","300"]);
		bdd.push(["301","numero","301"]);
		bdd.push(["302","numero","302"]);
		bdd.push(["303","numero","303"]);
		bdd.push(["304","numero","304"]);
		bdd.push(["305","numero","305"]);
		bdd.push(["306","numero","306"]);
		bdd.push(["307","numero","307"]);
		bdd.push(["308","numero","308"]);
		bdd.push(["309","numero","309"]);
		bdd.push(["310","numero","310"]);
		bdd.push(["311","numero","311"]);
		bdd.push(["312","numero","312"]);
		bdd.push(["313","numero","313"]);
		bdd.push(["314","numero","314"]);
		bdd.push(["315","numero","315"]);
		bdd.push(["316","numero","316"]);
		bdd.push(["317","numero","317"]);
		bdd.push(["318","numero","318"]);
		bdd.push(["319","numero","319"]);
		bdd.push(["320","numero","320"]);
		bdd.push(["321","numero","321"]);
		bdd.push(["322","numero","322"]);
		bdd.push(["323","numero","323"]);
		bdd.push(["324","numero","324"]);
		bdd.push(["325","numero","325"]);
		bdd.push(["326","numero","326"]);
		bdd.push(["327","numero","327"]);
		bdd.push(["328","numero","328"]);
		bdd.push(["329","numero","329"]);
		bdd.push(["330","numero","330"]);
		bdd.push(["331","numero","331"]);
		bdd.push(["332","numero","332"]);
		bdd.push(["333","numero","333"]);
		bdd.push(["334","numero","334"]);
		bdd.push(["335","numero","335"]);
		bdd.push(["336","numero","336"]);
		bdd.push(["337","numero","337"]);
		bdd.push(["338","numero","338"]);
		bdd.push(["339","numero","339"]);
		bdd.push(["340","numero","340"]);
		bdd.push(["341","numero","341"]);
		bdd.push(["342","numero","342"]);
		bdd.push(["343","numero","343"]);
		bdd.push(["344","numero","344"]);
		bdd.push(["345","numero","345"]);
		bdd.push(["346","numero","346"]);
		bdd.push(["347","numero","347"]);
		bdd.push(["348","numero","348"]);
		bdd.push(["349","numero","349"]);
		bdd.push(["350","numero","350"]);
		bdd.push(["351","numero","351"]);
		bdd.push(["352","numero","352"]);
		bdd.push(["353","numero","353"]);
		bdd.push(["354","numero","354"]);
		bdd.push(["355","numero","355"]);
		bdd.push(["356","numero","356"]);
		bdd.push(["357","numero","357"]);
		bdd.push(["358","numero","358"]);
		bdd.push(["359","numero","359"]);
		bdd.push(["360","numero","360"]);
		bdd.push(["361","numero","361"]);
		bdd.push(["362","numero","362"]);
		bdd.push(["363","numero","363"]);
		bdd.push(["364","numero","364"]);
		bdd.push(["365","numero","365"]);
		bdd.push(["366","numero","366"]);
		bdd.push(["367","numero","367"]);
		bdd.push(["368","numero","368"]);
		bdd.push(["369","numero","369"]);
		bdd.push(["370","numero","370"]);
		bdd.push(["371","numero","371"]);
		bdd.push(["372","numero","372"]);
		bdd.push(["373","numero","373"]);
		bdd.push(["374","numero","374"]);
		bdd.push(["375","numero","375"]);
		bdd.push(["376","numero","376"]);
		bdd.push(["377","numero","377"]);
		bdd.push(["378","numero","378"]);
		bdd.push(["379","numero","379"]);
		bdd.push(["380","numero","380"]);
		bdd.push(["381","numero","381"]);
		bdd.push(["382","numero","382"]);
		bdd.push(["383","numero","383"]);
		bdd.push(["384","numero","384"]);
		bdd.push(["385","numero","385"]);
		bdd.push(["386","numero","386"]);
		bdd.push(["387","numero","387"]);
		bdd.push(["388","numero","388"]);
		bdd.push(["389","numero","389"]);
		bdd.push(["390","numero","390"]);
		bdd.push(["391","numero","391"]);
		bdd.push(["392","numero","392"]);
		bdd.push(["393","numero","393"]);
		bdd.push(["394","numero","394"]);
		bdd.push(["395","numero","395"]);
		bdd.push(["396","numero","396"]);
		bdd.push(["397","numero","397"]);
		bdd.push(["398","numero","398"]);
		bdd.push(["399","numero","399"]);
		bdd.push(["400","numero","400"]);
		bdd.push(["401","numero","401"]);
		bdd.push(["402","numero","402"]);
		bdd.push(["403","numero","403"]);
		bdd.push(["404","numero","404"]);
		bdd.push(["405","numero","405"]);
		bdd.push(["406","numero","406"]);
		bdd.push(["407","numero","407"]);
		bdd.push(["408","numero","408"]);
		bdd.push(["409","numero","409"]);
		bdd.push(["410","numero","410"]);
		bdd.push(["411","numero","411"]);
		bdd.push(["412","numero","412"]);
		bdd.push(["413","numero","413"]);
		bdd.push(["414","numero","414"]);
		bdd.push(["415","numero","415"]);
		bdd.push(["416","numero","416"]);
		bdd.push(["417","numero","417"]);
		bdd.push(["418","numero","418"]);
		bdd.push(["419","numero","419"]);
		bdd.push(["420","numero","420"]);
		bdd.push(["421","numero","421"]);
		bdd.push(["422","numero","422"]);
		bdd.push(["423","numero","423"]);
		bdd.push(["424","numero","424"]);
		bdd.push(["425","numero","425"]);
		bdd.push(["426","numero","426"]);
		bdd.push(["427","numero","427"]);
		bdd.push(["428","numero","428"]);
		bdd.push(["429","numero","429"]);
		bdd.push(["430","numero","430"]);
		bdd.push(["431","numero","431"]);
		bdd.push(["432","numero","432"]);
		bdd.push(["433","numero","433"]);
		bdd.push(["434","numero","434"]);
		bdd.push(["435","numero","435"]);
		bdd.push(["436","numero","436"]);
		bdd.push(["437","numero","437"]);
		bdd.push(["438","numero","438"]);
		bdd.push(["439","numero","439"]);
		bdd.push(["440","numero","440"]);
		bdd.push(["441","numero","441"]);
		bdd.push(["442","numero","442"]);
		bdd.push(["443","numero","443"]);
		bdd.push(["444","numero","444"]);
		bdd.push(["445","numero","445"]);
		bdd.push(["446","numero","446"]);
		bdd.push(["447","numero","447"]);
		bdd.push(["448","numero","448"]);
		bdd.push(["449","numero","449"]);
		bdd.push(["450","numero","450"]);
		bdd.push(["451","numero","451"]);
		bdd.push(["452","numero","452"]);
		bdd.push(["453","numero","453"]);
		bdd.push(["454","numero","454"]);
		bdd.push(["455","numero","455"]);
		bdd.push(["456","numero","456"]);
		bdd.push(["457","numero","457"]);
		bdd.push(["458","numero","458"]);
		bdd.push(["459","numero","459"]);
		bdd.push(["460","numero","460"]);
		bdd.push(["461","numero","461"]);
		bdd.push(["462","numero","462"]);
		bdd.push(["463","numero","463"]);
		bdd.push(["464","numero","464"]);
		bdd.push(["465","numero","465"]);
		bdd.push(["466","numero","466"]);
		bdd.push(["467","numero","467"]);
		bdd.push(["468","numero","468"]);
		bdd.push(["469","numero","469"]);
		bdd.push(["470","numero","470"]);
		bdd.push(["471","numero","471"]);
		bdd.push(["472","numero","472"]);
		bdd.push(["473","numero","473"]);
		bdd.push(["474","numero","474"]);
		bdd.push(["475","numero","475"]);
		bdd.push(["476","numero","476"]);
		bdd.push(["477","numero","477"]);
		bdd.push(["478","numero","478"]);
		bdd.push(["479","numero","479"]);
		bdd.push(["480","numero","480"]);
		bdd.push(["481","numero","481"]);
		bdd.push(["482","numero","482"]);
		bdd.push(["483","numero","483"]);
		bdd.push(["484","numero","484"]);
		bdd.push(["485","numero","485"]);
		bdd.push(["486","numero","486"]);
		bdd.push(["487","numero","487"]);
		bdd.push(["488","numero","488"]);
		bdd.push(["489","numero","489"]);
		bdd.push(["490","numero","490"]);
		bdd.push(["491","numero","491"]);
		bdd.push(["492","numero","492"]);
		bdd.push(["493","numero","493"]);
		bdd.push(["494","numero","494"]);
		bdd.push(["495","numero","495"]);
		bdd.push(["496","numero","496"]);
		bdd.push(["497","numero","497"]);
		bdd.push(["498","numero","498"]);
		bdd.push(["499","numero","499"]);
		bdd.push(["500","numero","500"]);
		bdd.push(["501","numero","501"]);
		bdd.push(["502","numero","502"]);
		bdd.push(["503","numero","503"]);
		bdd.push(["504","numero","504"]);
		bdd.push(["505","numero","505"]);
		bdd.push(["506","numero","506"]);
		bdd.push(["507","numero","507"]);
		bdd.push(["508","numero","508"]);
		bdd.push(["509","numero","509"]);
		bdd.push(["510","numero","510"]);
		bdd.push(["511","numero","511"]);
		bdd.push(["512","numero","512"]);
		bdd.push(["513","numero","513"]);
		bdd.push(["514","numero","514"]);
		bdd.push(["515","numero","515"]);
		bdd.push(["516","numero","516"]);
		bdd.push(["517","numero","517"]);
		bdd.push(["518","numero","518"]);
		bdd.push(["519","numero","519"]);
		bdd.push(["520","numero","520"]);
		bdd.push(["521","numero","521"]);
		bdd.push(["522","numero","522"]);
		bdd.push(["523","numero","523"]);
		bdd.push(["524","numero","524"]);
		bdd.push(["525","numero","525"]);
		bdd.push(["526","numero","526"]);
		bdd.push(["527","numero","527"]);
		bdd.push(["528","numero","528"]);
		bdd.push(["529","numero","529"]);
		bdd.push(["530","numero","530"]);
		bdd.push(["531","numero","531"]);
		bdd.push(["532","numero","532"]);
		bdd.push(["533","numero","533"]);
		bdd.push(["534","numero","534"]);
		bdd.push(["535","numero","535"]);
		bdd.push(["536","numero","536"]);
		bdd.push(["537","numero","537"]);
		bdd.push(["538","numero","538"]);
		bdd.push(["539","numero","539"]);
		bdd.push(["540","numero","540"]);
		bdd.push(["541","numero","541"]);
		bdd.push(["542","numero","542"]);
		bdd.push(["543","numero","543"]);
		bdd.push(["544","numero","544"]);
		bdd.push(["545","numero","545"]);
		bdd.push(["546","numero","546"]);
		bdd.push(["547","numero","547"]);
		bdd.push(["548","numero","548"]);
		bdd.push(["549","numero","549"]);
		bdd.push(["550","numero","550"]);
		bdd.push(["551","numero","551"]);
		bdd.push(["552","numero","552"]);
		bdd.push(["553","numero","553"]);
		bdd.push(["554","numero","554"]);
		bdd.push(["555","numero","555"]);
		bdd.push(["556","numero","556"]);
		bdd.push(["557","numero","557"]);
		bdd.push(["558","numero","558"]);
		bdd.push(["559","numero","559"]);
		bdd.push(["560","numero","560"]);
		bdd.push(["561","numero","561"]);
		bdd.push(["562","numero","562"]);
		bdd.push(["563","numero","563"]);
		bdd.push(["564","numero","564"]);
		bdd.push(["565","numero","565"]);
		bdd.push(["566","numero","566"]);
		bdd.push(["567","numero","567"]);
		bdd.push(["568","numero","568"]);
		bdd.push(["569","numero","569"]);
		bdd.push(["570","numero","570"]);
		bdd.push(["571","numero","571"]);
		bdd.push(["572","numero","572"]);
		bdd.push(["573","numero","573"]);
		bdd.push(["574","numero","574"]);
		bdd.push(["575","numero","575"]);
		bdd.push(["576","numero","576"]);
		bdd.push(["577","numero","577"]);
		bdd.push(["578","numero","578"]);
		bdd.push(["579","numero","579"]);
		bdd.push(["580","numero","580"]);
		bdd.push(["581","numero","581"]);
		bdd.push(["582","numero","582"]);
		bdd.push(["583","numero","583"]);
		bdd.push(["584","numero","584"]);
		bdd.push(["585","numero","585"]);
		bdd.push(["586","numero","586"]);
		bdd.push(["587","numero","587"]);
		bdd.push(["588","numero","588"]);
		bdd.push(["589","numero","589"]);
		bdd.push(["590","numero","590"]);
		bdd.push(["591","numero","591"]);
		bdd.push(["592","numero","592"]);
		bdd.push(["593","numero","593"]);
		bdd.push(["594","numero","594"]);
		bdd.push(["595","numero","595"]);
		bdd.push(["596","numero","596"]);
		bdd.push(["597","numero","597"]);
		bdd.push(["598","numero","598"]);
		bdd.push(["599","numero","599"]);
		bdd.push(["600","numero","600"]);
		bdd.push(["601","numero","601"]);
		bdd.push(["602","numero","602"]);
		bdd.push(["603","numero","603"]);
		bdd.push(["604","numero","604"]);
		bdd.push(["605","numero","605"]);
		bdd.push(["606","numero","606"]);
		bdd.push(["607","numero","607"]);
		bdd.push(["608","numero","608"]);
		bdd.push(["609","numero","609"]);
		bdd.push(["610","numero","610"]);
		bdd.push(["611","numero","611"]);
		bdd.push(["612","numero","612"]);
		bdd.push(["613","numero","613"]);
		bdd.push(["614","numero","614"]);
		bdd.push(["615","numero","615"]);
		bdd.push(["616","numero","616"]);
		bdd.push(["617","numero","617"]);
		bdd.push(["618","numero","618"]);
		bdd.push(["619","numero","619"]);
		bdd.push(["620","numero","620"]);
		bdd.push(["621","numero","621"]);
		bdd.push(["622","numero","622"]);
		bdd.push(["623","numero","623"]);
		bdd.push(["624","numero","624"]);
		bdd.push(["625","numero","625"]);
		bdd.push(["626","numero","626"]);
		bdd.push(["627","numero","627"]);
		bdd.push(["628","numero","628"]);
		bdd.push(["629","numero","629"]);
		bdd.push(["630","numero","630"]);
		bdd.push(["631","numero","631"]);
		bdd.push(["632","numero","632"]);
		bdd.push(["633","numero","633"]);
		bdd.push(["634","numero","634"]);
		bdd.push(["635","numero","635"]);
		bdd.push(["636","numero","636"]);
		bdd.push(["637","numero","637"]);
		bdd.push(["638","numero","638"]);
		bdd.push(["639","numero","639"]);
		bdd.push(["640","numero","640"]);
		bdd.push(["641","numero","641"]);
		bdd.push(["642","numero","642"]);
		bdd.push(["643","numero","643"]);
		bdd.push(["644","numero","644"]);
		bdd.push(["645","numero","645"]);
		bdd.push(["646","numero","646"]);
		bdd.push(["647","numero","647"]);
		bdd.push(["648","numero","648"]);
		bdd.push(["649","numero","649"]);
		bdd.push(["Bulbizarre","pokemon","1"]);
		bdd.push(["Herbizarre","pokemon","2"]);
		bdd.push(["Florizarre","pokemon","3"]);
		bdd.push(["Salamèche","pokemon","4"]);
		bdd.push(["Reptincel","pokemon","5"]);
		bdd.push(["Dracaufeu","pokemon","6"]);
		bdd.push(["Carapuce","pokemon","7"]);
		bdd.push(["Carabaffe","pokemon","8"]);
		bdd.push(["Tortank","pokemon","9"]);
		bdd.push(["Chenipan","pokemon","10"]);
		bdd.push(["Chrysacier","pokemon","11"]);
		bdd.push(["Papilusion","pokemon","12"]);
		bdd.push(["Aspicot","pokemon","13"]);
		bdd.push(["Coconfort","pokemon","14"]);
		bdd.push(["Dardargnan","pokemon","15"]);
		bdd.push(["Roucool","pokemon","16"]);
		bdd.push(["Roucoups","pokemon","17"]);
		bdd.push(["Roucarnage","pokemon","18"]);
		bdd.push(["Rattata","pokemon","19"]);
		bdd.push(["Rattatac","pokemon","20"]);
		bdd.push(["Piafabec","pokemon","21"]);
		bdd.push(["Rapasdepic","pokemon","22"]);
		bdd.push(["Abo","pokemon","23"]);
		bdd.push(["Arbok","pokemon","24"]);
		bdd.push(["Pikachu","pokemon","25"]);
		bdd.push(["Raichu","pokemon","26"]);
		bdd.push(["Sabelette","pokemon","27"]);
		bdd.push(["Sablaireau","pokemon","28"]);
		bdd.push(["Nidoran♀","pokemon","29"]);
		bdd.push(["Nidorina","pokemon","30"]);
		bdd.push(["Nidoqueen","pokemon","31"]);
		bdd.push(["Nidoran♂","pokemon","32"]);
		bdd.push(["Nidorino","pokemon","33"]);
		bdd.push(["Nidoking","pokemon","34"]);
		bdd.push(["Mélofée","pokemon","35"]);
		bdd.push(["Mélodelfe","pokemon","36"]);
		bdd.push(["Goupix","pokemon","37"]);
		bdd.push(["Feunard","pokemon","38"]);
		bdd.push(["Rondoudou","pokemon","39"]);
		bdd.push(["Grodoudou","pokemon","40"]);
		bdd.push(["Nosferapti","pokemon","41"]);
		bdd.push(["Nosferalto","pokemon","42"]);
		bdd.push(["Mystherbe","pokemon","43"]);
		bdd.push(["Ortide","pokemon","44"]);
		bdd.push(["Rafflesia","pokemon","45"]);
		bdd.push(["Paras","pokemon","46"]);
		bdd.push(["Parasect","pokemon","47"]);
		bdd.push(["Mimitoss","pokemon","48"]);
		bdd.push(["Aéromite","pokemon","49"]);
		bdd.push(["Taupiqueur","pokemon","50"]);
		bdd.push(["Triopikeur","pokemon","51"]);
		bdd.push(["Miaouss","pokemon","52"]);
		bdd.push(["Persian","pokemon","53"]);
		bdd.push(["Psykokwak","pokemon","54"]);
		bdd.push(["Akwakwak","pokemon","55"]);
		bdd.push(["Férosinge","pokemon","56"]);
		bdd.push(["Colossinge","pokemon","57"]);
		bdd.push(["Caninos","pokemon","58"]);
		bdd.push(["Arcanin","pokemon","59"]);
		bdd.push(["Ptitard","pokemon","60"]);
		bdd.push(["Tétarte","pokemon","61"]);
		bdd.push(["Tartard","pokemon","62"]);
		bdd.push(["Abra","pokemon","63"]);
		bdd.push(["Kadabra","pokemon","64"]);
		bdd.push(["Alakazam","pokemon","65"]);
		bdd.push(["Machoc","pokemon","66"]);
		bdd.push(["Machopeur","pokemon","67"]);
		bdd.push(["Mackogneur","pokemon","68"]);
		bdd.push(["Chétiflor","pokemon","69"]);
		bdd.push(["Boustiflor","pokemon","70"]);
		bdd.push(["Empiflor","pokemon","71"]);
		bdd.push(["Tentacool","pokemon","72"]);
		bdd.push(["Tentacruel","pokemon","73"]);
		bdd.push(["Racaillou","pokemon","74"]);
		bdd.push(["Gravalanch","pokemon","75"]);
		bdd.push(["Grolem","pokemon","76"]);
		bdd.push(["Ponyta","pokemon","77"]);
		bdd.push(["Galopa","pokemon","78"]);
		bdd.push(["Ramoloss","pokemon","79"]);
		bdd.push(["Flagadoss","pokemon","80"]);
		bdd.push(["Magneti","pokemon","81"]);
		bdd.push(["Magneton","pokemon","82"]);
		bdd.push(["Canarticho","pokemon","83"]);
		bdd.push(["Doduo","pokemon","84"]);
		bdd.push(["Dodrio","pokemon","85"]);
		bdd.push(["Otaria","pokemon","86"]);
		bdd.push(["Lamantine","pokemon","87"]);
		bdd.push(["Tadmorv","pokemon","88"]);
		bdd.push(["Grotadmorv","pokemon","89"]);
		bdd.push(["Kokiyas","pokemon","90"]);
		bdd.push(["Crustabri","pokemon","91"]);
		bdd.push(["Fantominus","pokemon","92"]);
		bdd.push(["Spectrum","pokemon","93"]);
		bdd.push(["Ectoplasma","pokemon","94"]);
		bdd.push(["Onix","pokemon","95"]);
		bdd.push(["Soporifik","pokemon","96"]);
		bdd.push(["Hypnomade","pokemon","97"]);
		bdd.push(["Krabby","pokemon","98"]);
		bdd.push(["Krabboss","pokemon","99"]);
		bdd.push(["Voltorbe","pokemon","100"]);
		bdd.push(["Electrode","pokemon","101"]);
		bdd.push(["Noeunoeuf","pokemon","102"]);
		bdd.push(["Noadkoko","pokemon","103"]);
		bdd.push(["Osselait","pokemon","104"]);
		bdd.push(["Ossatueur","pokemon","105"]);
		bdd.push(["Kicklee","pokemon","106"]);
		bdd.push(["Tygnon","pokemon","107"]);
		bdd.push(["Excelangue","pokemon","108"]);
		bdd.push(["Smogo","pokemon","109"]);
		bdd.push(["Smogogo","pokemon","110"]);
		bdd.push(["Rhinocorne","pokemon","111"]);
		bdd.push(["Rhinoféros","pokemon","112"]);
		bdd.push(["Leveinard","pokemon","113"]);
		bdd.push(["Saquedeneu","pokemon","114"]);
		bdd.push(["Kangourex","pokemon","115"]);
		bdd.push(["Hypotrempe","pokemon","116"]);
		bdd.push(["Hypocéan","pokemon","117"]);
		bdd.push(["Poissirène","pokemon","118"]);
		bdd.push(["Poissoroy","pokemon","119"]);
		bdd.push(["Stari","pokemon","120"]);
		bdd.push(["Staross","pokemon","121"]);
		bdd.push(["M. Mime","pokemon","122"]);
		bdd.push(["Insécateur","pokemon","123"]);
		bdd.push(["Lippoutou","pokemon","124"]);
		bdd.push(["Elektek","pokemon","125"]);
		bdd.push(["Magmar","pokemon","126"]);
		bdd.push(["Scarabrute","pokemon","127"]);
		bdd.push(["Tauros","pokemon","128"]);
		bdd.push(["Magicarpe","pokemon","129"]);
		bdd.push(["Léviator","pokemon","130"]);
		bdd.push(["Lokhlass","pokemon","131"]);
		bdd.push(["Métamorph","pokemon","132"]);
		bdd.push(["Evoli","pokemon","133"]);
		bdd.push(["Aquali","pokemon","134"]);
		bdd.push(["Voltali","pokemon","135"]);
		bdd.push(["Pyroli","pokemon","136"]);
		bdd.push(["Porygon","pokemon","137"]);
		bdd.push(["Amonita","pokemon","138"]);
		bdd.push(["Amonistar","pokemon","139"]);
		bdd.push(["Kabuto","pokemon","140"]);
		bdd.push(["Kabutops","pokemon","141"]);
		bdd.push(["Ptéra","pokemon","142"]);
		bdd.push(["Ronflex","pokemon","143"]);
		bdd.push(["Artikodin","pokemon","144"]);
		bdd.push(["Electhor","pokemon","145"]);
		bdd.push(["Sulfura","pokemon","146"]);
		bdd.push(["Minidraco","pokemon","147"]);
		bdd.push(["Draco","pokemon","148"]);
		bdd.push(["Dracolosse","pokemon","149"]);
		bdd.push(["Mewtwo","pokemon","150"]);
		bdd.push(["Mew","pokemon","151"]);
		bdd.push(["Germignon","pokemon","152"]);
		bdd.push(["Macronium","pokemon","153"]);
		bdd.push(["Méganium","pokemon","154"]);
		bdd.push(["Héricendre","pokemon","155"]);
		bdd.push(["Feurisson","pokemon","156"]);
		bdd.push(["Typhlosion","pokemon","157"]);
		bdd.push(["Kaïminus","pokemon","158"]);
		bdd.push(["Crocrodil","pokemon","159"]);
		bdd.push(["Aligatueur","pokemon","160"]);
		bdd.push(["Fouinette","pokemon","161"]);
		bdd.push(["Fouinar","pokemon","162"]);
		bdd.push(["Hoot-hoot","pokemon","163"]);
		bdd.push(["Noarfang","pokemon","164"]);
		bdd.push(["Coxy","pokemon","165"]);
		bdd.push(["Coxyclaque","pokemon","166"]);
		bdd.push(["Mimigal","pokemon","167"]);
		bdd.push(["Migalos","pokemon","168"]);
		bdd.push(["Nostenfer","pokemon","169"]);
		bdd.push(["Loupio","pokemon","170"]);
		bdd.push(["Lanturn","pokemon","171"]);
		bdd.push(["Pichu","pokemon","172"]);
		bdd.push(["Mélo","pokemon","173"]);
		bdd.push(["Toudoudou","pokemon","174"]);
		bdd.push(["Togépi","pokemon","175"]);
		bdd.push(["Togétic","pokemon","176"]);
		bdd.push(["Natu","pokemon","177"]);
		bdd.push(["Xatu","pokemon","178"]);
		bdd.push(["Wattouat","pokemon","179"]);
		bdd.push(["Lainergie","pokemon","180"]);
		bdd.push(["Pharamp","pokemon","181"]);
		bdd.push(["Joliflor","pokemon","182"]);
		bdd.push(["Marill","pokemon","183"]);
		bdd.push(["Azumarill","pokemon","184"]);
		bdd.push(["Simularbre","pokemon","185"]);
		bdd.push(["Tarpaud","pokemon","186"]);
		bdd.push(["Granivol","pokemon","187"]);
		bdd.push(["Floravol","pokemon","188"]);
		bdd.push(["Cotovol","pokemon","189"]);
		bdd.push(["Capumain","pokemon","190"]);
		bdd.push(["Tournegrin","pokemon","191"]);
		bdd.push(["Héliatronc","pokemon","192"]);
		bdd.push(["Yanma","pokemon","193"]);
		bdd.push(["Axoloto","pokemon","194"]);
		bdd.push(["Maraiste","pokemon","195"]);
		bdd.push(["Mentali","pokemon","196"]);
		bdd.push(["Noctali","pokemon","197"]);
		bdd.push(["Cornebre","pokemon","198"]);
		bdd.push(["Roigada","pokemon","199"]);
		bdd.push(["Feuforêve","pokemon","200"]);
		bdd.push(["Zarbi","pokemon","201"]);
		bdd.push(["Qulbutoke","pokemon","202"]);
		bdd.push(["Girafarig","pokemon","203"]);
		bdd.push(["Pomdepik","pokemon","204"]);
		bdd.push(["Foretress","pokemon","205"]);
		bdd.push(["Insolourdo","pokemon","206"]);
		bdd.push(["Scorplane","pokemon","207"]);
		bdd.push(["Steelix","pokemon","208"]);
		bdd.push(["Snubull","pokemon","209"]);
		bdd.push(["Granbull","pokemon","210"]);
		bdd.push(["Qwilfish","pokemon","211"]);
		bdd.push(["Cizayox","pokemon","212"]);
		bdd.push(["Caratroc","pokemon","213"]);
		bdd.push(["Scarhino","pokemon","214"]);
		bdd.push(["Farfuret","pokemon","215"]);
		bdd.push(["Teddiursa","pokemon","216"]);
		bdd.push(["Ursaring","pokemon","217"]);
		bdd.push(["Limagma","pokemon","218"]);
		bdd.push(["Volcaropod","pokemon","219"]);
		bdd.push(["Marcacrain","pokemon","220"]);
		bdd.push(["Cochignon","pokemon","221"]);
		bdd.push(["Corayon","pokemon","222"]);
		bdd.push(["Remoraid","pokemon","223"]);
		bdd.push(["Octillery","pokemon","224"]);
		bdd.push(["Cadoizo","pokemon","225"]);
		bdd.push(["Demanta","pokemon","226"]);
		bdd.push(["Airmure","pokemon","227"]);
		bdd.push(["Malosse","pokemon","228"]);
		bdd.push(["Démolosse","pokemon","229"]);
		bdd.push(["Hyporoi","pokemon","230"]);
		bdd.push(["Phanpy","pokemon","231"]);
		bdd.push(["Donphan","pokemon","232"]);
		bdd.push(["Porygon2","pokemon","233"]);
		bdd.push(["Cerfrousse","pokemon","234"]);
		bdd.push(["Queulorior","pokemon","235"]);
		bdd.push(["Débugant","pokemon","236"]);
		bdd.push(["Kapoera","pokemon","237"]);
		bdd.push(["Lippouti","pokemon","238"]);
		bdd.push(["Elekid","pokemon","239"]);
		bdd.push(["Magby","pokemon","240"]);
		bdd.push(["Ecremeuh","pokemon","241"]);
		bdd.push(["Leuphorie","pokemon","242"]);
		bdd.push(["Raïkou","pokemon","243"]);
		bdd.push(["Enteï","pokemon","244"]);
		bdd.push(["Suicune","pokemon","245"]);
		bdd.push(["Embrylex","pokemon","246"]);
		bdd.push(["Ymphect","pokemon","247"]);
		bdd.push(["Tyranocif","pokemon","248"]);
		bdd.push(["Lugia","pokemon","249"]);
		bdd.push(["Ho-oh","pokemon","250"]);
		bdd.push(["Célébi","pokemon","251"]);
		bdd.push(["Arcko","pokemon","252"]);
		bdd.push(["Massko","pokemon","253"]);
		bdd.push(["Jungko","pokemon","254"]);
		bdd.push(["Poussifeu","pokemon","255"]);
		bdd.push(["Galifeu","pokemon","256"]);
		bdd.push(["Brasegali","pokemon","257"]);
		bdd.push(["Gobou","pokemon","258"]);
		bdd.push(["Flobio","pokemon","259"]);
		bdd.push(["Laggron","pokemon","260"]);
		bdd.push(["Medhyena","pokemon","261"]);
		bdd.push(["Grahyena","pokemon","262"]);
		bdd.push(["Zigzaton","pokemon","263"]);
		bdd.push(["Lineon","pokemon","264"]);
		bdd.push(["Chenipotte","pokemon","265"]);
		bdd.push(["Armulys","pokemon","266"]);
		bdd.push(["Charmillon","pokemon","267"]);
		bdd.push(["Blindalys","pokemon","268"]);
		bdd.push(["Papinox","pokemon","269"]);
		bdd.push(["Nenupiot","pokemon","270"]);
		bdd.push(["Lombre","pokemon","271"]);
		bdd.push(["Ludicolo","pokemon","272"]);
		bdd.push(["Grainipiot","pokemon","273"]);
		bdd.push(["Pifeuil","pokemon","274"]);
		bdd.push(["Tengalice","pokemon","275"]);
		bdd.push(["Nirondelle","pokemon","276"]);
		bdd.push(["Heledelle","pokemon","277"]);
		bdd.push(["Goelise","pokemon","278"]);
		bdd.push(["Bekipan","pokemon","279"]);
		bdd.push(["Tarsal","pokemon","280"]);
		bdd.push(["Kirlia","pokemon","281"]);
		bdd.push(["Gardevoir","pokemon","282"]);
		bdd.push(["Arakdo","pokemon","283"]);
		bdd.push(["Maskadra","pokemon","284"]);
		bdd.push(["Balignon","pokemon","285"]);
		bdd.push(["Chapignon","pokemon","286"]);
		bdd.push(["Parecool","pokemon","287"]);
		bdd.push(["Vigoroth","pokemon","288"]);
		bdd.push(["Monaflemit","pokemon","289"]);
		bdd.push(["Ningale","pokemon","290"]);
		bdd.push(["Ninjask","pokemon","291"]);
		bdd.push(["Munja","pokemon","292"]);
		bdd.push(["Chuchmur","pokemon","293"]);
		bdd.push(["Ramboum","pokemon","294"]);
		bdd.push(["Brouhabam","pokemon","295"]);
		bdd.push(["Makuhita","pokemon","296"]);
		bdd.push(["Hariyama","pokemon","297"]);
		bdd.push(["Azurill","pokemon","298"]);
		bdd.push(["Tarinor","pokemon","299"]);
		bdd.push(["Skitty","pokemon","300"]);
		bdd.push(["Delcatty","pokemon","301"]);
		bdd.push(["Tenefix","pokemon","302"]);
		bdd.push(["Mysdibule","pokemon","303"]);
		bdd.push(["Galekid","pokemon","304"]);
		bdd.push(["Galegon","pokemon","305"]);
		bdd.push(["Galeking","pokemon","306"]);
		bdd.push(["Meditikka","pokemon","307"]);
		bdd.push(["Charmina","pokemon","308"]);
		bdd.push(["Dynavolt","pokemon","309"]);
		bdd.push(["Elecsprint","pokemon","310"]);
		bdd.push(["Posipi","pokemon","311"]);
		bdd.push(["Negapi","pokemon","312"]);
		bdd.push(["Muciole","pokemon","313"]);
		bdd.push(["Lumivole","pokemon","314"]);
		bdd.push(["Roselia","pokemon","315"]);
		bdd.push(["Gloupti","pokemon","316"]);
		bdd.push(["Avaltout","pokemon","317"]);
		bdd.push(["Carvanha","pokemon","318"]);
		bdd.push(["Sharpedo","pokemon","319"]);
		bdd.push(["Wailmer","pokemon","320"]);
		bdd.push(["Wailord","pokemon","321"]);
		bdd.push(["Chamallot","pokemon","322"]);
		bdd.push(["Camerupt","pokemon","323"]);
		bdd.push(["Chartor","pokemon","324"]);
		bdd.push(["Spoink","pokemon","325"]);
		bdd.push(["Groret","pokemon","326"]);
		bdd.push(["Spinda","pokemon","327"]);
		bdd.push(["Kraknoix","pokemon","328"]);
		bdd.push(["Vibrannif","pokemon","329"]);
		bdd.push(["Libegon","pokemon","330"]);
		bdd.push(["Cacnea","pokemon","331"]);
		bdd.push(["Cacturne","pokemon","332"]);
		bdd.push(["Tylton","pokemon","333"]);
		bdd.push(["Altaria","pokemon","334"]);
		bdd.push(["Mangriff","pokemon","335"]);
		bdd.push(["Seviper","pokemon","336"]);
		bdd.push(["Seleroc","pokemon","337"]);
		bdd.push(["Solaroc","pokemon","338"]);
		bdd.push(["Barloche","pokemon","339"]);
		bdd.push(["Barbicha","pokemon","340"]);
		bdd.push(["Ecrapince","pokemon","341"]);
		bdd.push(["Colhomar","pokemon","342"]);
		bdd.push(["Balbuto","pokemon","343"]);
		bdd.push(["Kaorine","pokemon","344"]);
		bdd.push(["Lilia","pokemon","345"]);
		bdd.push(["Vacilys","pokemon","346"]);
		bdd.push(["Anorith","pokemon","347"]);
		bdd.push(["Armaldo","pokemon","348"]);
		bdd.push(["Barpau","pokemon","349"]);
		bdd.push(["Milobellus","pokemon","350"]);
		bdd.push(["Morpheo","pokemon","351"]);
		bdd.push(["Kecleon","pokemon","352"]);
		bdd.push(["Polichombr","pokemon","353"]);
		bdd.push(["Branette","pokemon","354"]);
		bdd.push(["Skelenox","pokemon","355"]);
		bdd.push(["Teraclope","pokemon","356"]);
		bdd.push(["Tropius","pokemon","357"]);
		bdd.push(["Eoko","pokemon","358"]);
		bdd.push(["Absol","pokemon","359"]);
		bdd.push(["Okéoké","pokemon","360"]);
		bdd.push(["Stalgamin","pokemon","361"]);
		bdd.push(["Oniglali","pokemon","362"]);
		bdd.push(["Obalie","pokemon","363"]);
		bdd.push(["Phogleur","pokemon","364"]);
		bdd.push(["Kaimorse","pokemon","365"]);
		bdd.push(["Coquiperl","pokemon","366"]);
		bdd.push(["Serpang","pokemon","367"]);
		bdd.push(["Rosabyss","pokemon","368"]);
		bdd.push(["Relicanth","pokemon","369"]);
		bdd.push(["Lovdisc","pokemon","370"]);
		bdd.push(["Draby","pokemon","371"]);
		bdd.push(["Drakhaus","pokemon","372"]);
		bdd.push(["Drattak","pokemon","373"]);
		bdd.push(["Terhal","pokemon","374"]);
		bdd.push(["Metang","pokemon","375"]);
		bdd.push(["Metalosse","pokemon","376"]);
		bdd.push(["Regirock","pokemon","377"]);
		bdd.push(["Regice","pokemon","378"]);
		bdd.push(["Registeel","pokemon","379"]);
		bdd.push(["Latias","pokemon","380"]);
		bdd.push(["Latios","pokemon","381"]);
		bdd.push(["Kyogre","pokemon","382"]);
		bdd.push(["Groudon","pokemon","383"]);
		bdd.push(["Rayquaza","pokemon","384"]);
		bdd.push(["Jirachi","pokemon","385"]);
		bdd.push(["Deoxys","pokemon","386"]);
		bdd.push(["Tortipouss","pokemon","387"]);
		bdd.push(["Boskara","pokemon","388"]);
		bdd.push(["Torterra","pokemon","389"]);
		bdd.push(["Ouisticram","pokemon","390"]);
		bdd.push(["Chimpenfeu","pokemon","391"]);
		bdd.push(["Simiabraz","pokemon","392"]);
		bdd.push(["Tiplouf","pokemon","393"]);
		bdd.push(["Prinplouf","pokemon","394"]);
		bdd.push(["Pingoleon","pokemon","395"]);
		bdd.push(["É?tourmi","pokemon","396"]);
		bdd.push(["É?tourvol","pokemon","397"]);
		bdd.push(["É?touraptor","pokemon","398"]);
		bdd.push(["Keunotor","pokemon","399"]);
		bdd.push(["Castorno","pokemon","400"]);
		bdd.push(["Crikzik","pokemon","401"]);
		bdd.push(["Melocrik","pokemon","402"]);
		bdd.push(["Lixy","pokemon","403"]);
		bdd.push(["Luxio","pokemon","404"]);
		bdd.push(["Luxray","pokemon","405"]);
		bdd.push(["Rozbouton","pokemon","406"]);
		bdd.push(["Roserade","pokemon","407"]);
		bdd.push(["Kranidos","pokemon","408"]);
		bdd.push(["Charkos","pokemon","409"]);
		bdd.push(["Dinoclier","pokemon","410"]);
		bdd.push(["Bastiodon","pokemon","411"]);
		bdd.push(["Cheniti","pokemon","412"]);
		bdd.push(["Cheniselle","pokemon","413"]);
		bdd.push(["Papilord","pokemon","414"]);
		bdd.push(["Apitrini","pokemon","415"]);
		bdd.push(["Apireine","pokemon","416"]);
		bdd.push(["Pachirisu","pokemon","417"]);
		bdd.push(["Mustebouée","pokemon","418"]);
		bdd.push(["Musteflott","pokemon","419"]);
		bdd.push(["Ceribou","pokemon","420"]);
		bdd.push(["Ceriflor","pokemon","421"]);
		bdd.push(["Sancoki","pokemon","422"]);
		bdd.push(["Tritosor","pokemon","423"]);
		bdd.push(["Capidextre","pokemon","424"]);
		bdd.push(["Baudrive","pokemon","425"]);
		bdd.push(["Grodrive","pokemon","426"]);
		bdd.push(["Laporeille","pokemon","427"]);
		bdd.push(["Lockpin","pokemon","428"]);
		bdd.push(["Magirêve","pokemon","429"]);
		bdd.push(["Corboss","pokemon","430"]);
		bdd.push(["Chaglam","pokemon","431"]);
		bdd.push(["Chaffreux","pokemon","432"]);
		bdd.push(["Korillon","pokemon","433"]);
		bdd.push(["Moufouette","pokemon","434"]);
		bdd.push(["Moufflair","pokemon","435"]);
		bdd.push(["Archeomire","pokemon","436"]);
		bdd.push(["Archeodong","pokemon","437"]);
		bdd.push(["Manzaï","pokemon","438"]);
		bdd.push(["Mime Jr.","pokemon","439"]);
		bdd.push(["Ptiravi","pokemon","440"]);
		bdd.push(["Pijako","pokemon","441"]);
		bdd.push(["Spiritomb","pokemon","442"]);
		bdd.push(["Griknot","pokemon","443"]);
		bdd.push(["Carmache","pokemon","444"]);
		bdd.push(["Carchacrok","pokemon","445"]);
		bdd.push(["Goinfrex","pokemon","446"]);
		bdd.push(["Riolu","pokemon","447"]);
		bdd.push(["Lucario","pokemon","448"]);
		bdd.push(["Hippopotas","pokemon","449"]);
		bdd.push(["Hippodocus","pokemon","450"]);
		bdd.push(["Rapion","pokemon","451"]);
		bdd.push(["Drascore","pokemon","452"]);
		bdd.push(["Cradopaud","pokemon","453"]);
		bdd.push(["Coatox","pokemon","454"]);
		bdd.push(["Vortente","pokemon","455"]);
		bdd.push(["Ecayon","pokemon","456"]);
		bdd.push(["Lumineon","pokemon","457"]);
		bdd.push(["Babimanta","pokemon","458"]);
		bdd.push(["Blizzi","pokemon","459"]);
		bdd.push(["Blizzaroi","pokemon","460"]);
		bdd.push(["Dimoret","pokemon","461"]);
		bdd.push(["Magnezone","pokemon","462"]);
		bdd.push(["Coudlangue","pokemon","463"]);
		bdd.push(["Rhinastoc","pokemon","464"]);
		bdd.push(["Bouldeneu","pokemon","465"]);
		bdd.push(["Elekable","pokemon","466"]);
		bdd.push(["Maganon","pokemon","467"]);
		bdd.push(["Togekiss","pokemon","468"]);
		bdd.push(["Yanmega","pokemon","469"]);
		bdd.push(["Phyllali","pokemon","470"]);
		bdd.push(["Givrali","pokemon","471"]);
		bdd.push(["Scorvol","pokemon","472"]);
		bdd.push(["Mammochon","pokemon","473"]);
		bdd.push(["Porygon-Z","pokemon","474"]);
		bdd.push(["Gallame","pokemon","475"]);
		bdd.push(["Tarinorme","pokemon","476"]);
		bdd.push(["Noctunoir","pokemon","477"]);
		bdd.push(["Momartik","pokemon","478"]);
		bdd.push(["Motisma","pokemon","479"]);
		bdd.push(["Crehelf","pokemon","480"]);
		bdd.push(["Crefollet","pokemon","481"]);
		bdd.push(["Crefadet","pokemon","482"]);
		bdd.push(["Dialga","pokemon","483"]);
		bdd.push(["Palkia","pokemon","484"]);
		bdd.push(["Heatran","pokemon","485"]);
		bdd.push(["Regigigas","pokemon","486"]);
		bdd.push(["Giratina","pokemon","487"]);
		bdd.push(["Cresselia","pokemon","488"]);
		bdd.push(["Phione","pokemon","489"]);
		bdd.push(["Manaphy","pokemon","490"]);
		bdd.push(["Darkrai","pokemon","491"]);
		bdd.push(["Shaymin","pokemon","492"]);
		bdd.push(["Arceus","pokemon","493"]);
		bdd.push(["Victini","pokemon","494"]);
		bdd.push(["Vipélierre","pokemon","495"]);
		bdd.push(["Lianaja","pokemon","496"]);
		bdd.push(["Majaspic","pokemon","497"]);
		bdd.push(["Gruikui","pokemon","498"]);
		bdd.push(["Grotichon","pokemon","499"]);
		bdd.push(["Roitiflam","pokemon","500"]);
		bdd.push(["Moustillon","pokemon","501"]);
		bdd.push(["Mateloutre","pokemon","502"]);
		bdd.push(["Clamiral","pokemon","503"]);
		bdd.push(["Ratentif","pokemon","504"]);
		bdd.push(["Miradar","pokemon","505"]);
		bdd.push(["Ponchiot","pokemon","506"]);
		bdd.push(["Ponchien","pokemon","507"]);
		bdd.push(["Mastouffe","pokemon","508"]);
		bdd.push(["Chacripan","pokemon","509"]);
		bdd.push(["Léopardus","pokemon","510"]);
		bdd.push(["Feuillajou","pokemon","511"]);
		bdd.push(["Feuiloutan","pokemon","512"]);
		bdd.push(["Flamajou","pokemon","513"]);
		bdd.push(["Flamoutan","pokemon","514"]);
		bdd.push(["Flotajou","pokemon","515"]);
		bdd.push(["Flotoutan","pokemon","516"]);
		bdd.push(["Munna","pokemon","517"]);
		bdd.push(["Mushana","pokemon","518"]);
		bdd.push(["Poichigeon","pokemon","519"]);
		bdd.push(["Colombeau","pokemon","520"]);
		bdd.push(["Déflaisan","pokemon","521"]);
		bdd.push(["Zébibron","pokemon","522"]);
		bdd.push(["Zéblitz","pokemon","523"]);
		bdd.push(["Nodulithe","pokemon","524"]);
		bdd.push(["Géolithe","pokemon","525"]);
		bdd.push(["Gigalith","pokemon","526"]);
		bdd.push(["Chovsourir","pokemon","527"]);
		bdd.push(["Rhinolove","pokemon","528"]);
		bdd.push(["Rototaupe","pokemon","529"]);
		bdd.push(["Minotaupe","pokemon","530"]);
		bdd.push(["Nanméouïe","pokemon","531"]);
		bdd.push(["Charpenti","pokemon","532"]);
		bdd.push(["Ouvrifier","pokemon","533"]);
		bdd.push(["Bétochef","pokemon","534"]);
		bdd.push(["Tritonde","pokemon","535"]);
		bdd.push(["Batracné","pokemon","536"]);
		bdd.push(["Crapustule","pokemon","537"]);
		bdd.push(["Judokrak","pokemon","538"]);
		bdd.push(["Karaclée","pokemon","539"]);
		bdd.push(["Larveyette","pokemon","540"]);
		bdd.push(["Couverdure","pokemon","541"]);
		bdd.push(["Manternel","pokemon","542"]);
		bdd.push(["Venipatte","pokemon","543"]);
		bdd.push(["Scobolide","pokemon","544"]);
		bdd.push(["Brutapode","pokemon","545"]);
		bdd.push(["Doudouvet","pokemon","546"]);
		bdd.push(["Farfaduvet","pokemon","547"]);
		bdd.push(["Chlorobule","pokemon","548"]);
		bdd.push(["Fragilady","pokemon","549"]);
		bdd.push(["Bargantua","pokemon","550"]);
		bdd.push(["Mascaïman","pokemon","551"]);
		bdd.push(["Escroco","pokemon","552"]);
		bdd.push(["Crocorible","pokemon","553"]);
		bdd.push(["Darumarond","pokemon","554"]);
		bdd.push(["Darumacho","pokemon","555"]);
		bdd.push(["Maracachi","pokemon","556"]);
		bdd.push(["Crabicoque","pokemon","557"]);
		bdd.push(["Crabaraque","pokemon","558"]);
		bdd.push(["Baggiguane","pokemon","559"]);
		bdd.push(["Baggaïd","pokemon","560"]);
		bdd.push(["Cryptéro","pokemon","561"]);
		bdd.push(["Tutafeh","pokemon","562"]);
		bdd.push(["Tutankafer","pokemon","563"]);
		bdd.push(["Carapagos","pokemon","564"]);
		bdd.push(["Mégapagos","pokemon","565"]);
		bdd.push(["Arkéapti","pokemon","566"]);
		bdd.push(["Aéroptéryx","pokemon","567"]);
		bdd.push(["Miamiasme","pokemon","568"]);
		bdd.push(["Miasmax","pokemon","569"]);
		bdd.push(["Zorua","pokemon","570"]);
		bdd.push(["Zoroark","pokemon","571"]);
		bdd.push(["Chinchidou","pokemon","572"]);
		bdd.push(["Pashmilla","pokemon","573"]);
		bdd.push(["Scrutella","pokemon","574"]);
		bdd.push(["Mesmérella","pokemon","575"]);
		bdd.push(["Sidérella","pokemon","576"]);
		bdd.push(["Nucléos","pokemon","577"]);
		bdd.push(["Méios","pokemon","578"]);
		bdd.push(["Symbios","pokemon","579"]);
		bdd.push(["Couaneton","pokemon","580"]);
		bdd.push(["Lakmécygne","pokemon","581"]);
		bdd.push(["Sorbébé","pokemon","582"]);
		bdd.push(["Sorboul","pokemon","583"]);
		bdd.push(["Sorbouboul","pokemon","584"]);
		bdd.push(["Vivaldaim","pokemon","585"]);
		bdd.push(["Haydaim","pokemon","586"]);
		bdd.push(["Emolga","pokemon","587"]);
		bdd.push(["Carabing","pokemon","588"]);
		bdd.push(["Lançargot","pokemon","589"]);
		bdd.push(["Trompignon","pokemon","590"]);
		bdd.push(["Gaulet","pokemon","591"]);
		bdd.push(["Viskuse","pokemon","592"]);
		bdd.push(["Moyade","pokemon","593"]);
		bdd.push(["Mamanbo","pokemon","594"]);
		bdd.push(["Statitik","pokemon","595"]);
		bdd.push(["Mygavolt","pokemon","596"]);
		bdd.push(["Grindur","pokemon","597"]);
		bdd.push(["Noacier","pokemon","598"]);
		bdd.push(["Tic","pokemon","599"]);
		bdd.push(["Clic","pokemon","600"]);
		bdd.push(["Cliticlic","pokemon","601"]);
		bdd.push(["Anchwatt","pokemon","602"]);
		bdd.push(["Lampéroie","pokemon","603"]);
		bdd.push(["Ohmassacre","pokemon","604"]);
		bdd.push(["Lewsor","pokemon","605"]);
		bdd.push(["Neitram","pokemon","606"]);
		bdd.push(["Funécire","pokemon","607"]);
		bdd.push(["Mélancolux","pokemon","608"]);
		bdd.push(["Lugulabre","pokemon","609"]);
		bdd.push(["Coupenotte","pokemon","610"]);
		bdd.push(["Incisache","pokemon","611"]);
		bdd.push(["Tranchodon","pokemon","612"]);
		bdd.push(["Polarhume","pokemon","613"]);
		bdd.push(["Polagriffe","pokemon","614"]);
		bdd.push(["Hexagel","pokemon","615"]);
		bdd.push(["Escargaume","pokemon","616"]);
		bdd.push(["Limaspeed","pokemon","617"]);
		bdd.push(["Limonde","pokemon","618"]);
		bdd.push(["Kungfouine","pokemon","619"]);
		bdd.push(["Shaofouine","pokemon","620"]);
		bdd.push(["Drakkarmin","pokemon","621"]);
		bdd.push(["Gringolem","pokemon","622"]);
		bdd.push(["Golemastoc","pokemon","623"]);
		bdd.push(["Scalpion","pokemon","624"]);
		bdd.push(["Scalproie","pokemon","625"]);
		bdd.push(["Frison","pokemon","626"]);
		bdd.push(["Furaiglon","pokemon","627"]);
		bdd.push(["Gueriaigle","pokemon","628"]);
		bdd.push(["Vostourno","pokemon","629"]);
		bdd.push(["Vaututrice","pokemon","630"]);
		bdd.push(["Aflamanoir","pokemon","631"]);
		bdd.push(["Fermite","pokemon","632"]);
		bdd.push(["Solochi","pokemon","633"]);
		bdd.push(["Diamat","pokemon","634"]);
		bdd.push(["Trioxhydre","pokemon","635"]);
		bdd.push(["Pyronille","pokemon","636"]);
		bdd.push(["Pyrax","pokemon","637"]);
		bdd.push(["Cobaltium","pokemon","638"]);
		bdd.push(["Terrakium","pokemon","639"]);
		bdd.push(["Viridium","pokemon","640"]);
		bdd.push(["Boréas","pokemon","641"]);
		bdd.push(["Fulguris","pokemon","642"]);
		bdd.push(["Reshiram","pokemon","643"]);
		bdd.push(["Zekrom","pokemon","644"]);
		bdd.push(["Démétéros","pokemon","645"]);
		bdd.push(["Kyurem","pokemon","646"]);
		bdd.push(["Keldeo","pokemon","647"]);
		bdd.push(["Meloetta","pokemon","648"]);
		bdd.push(["Genesect","pokemon","649"]);
		bdd.push(["A la Queue","attaque","1","3"]);
		bdd.push(["Abime","attaque","2","1"]);
		bdd.push(["Aboiement","attaque","3","2"]);
		bdd.push(["Abri","attaque","4","3"]);
		bdd.push(["Acidarmure","attaque","5","3"]);
		bdd.push(["Acide","attaque","6","2"]);
		bdd.push(["Acrobatie","attaque","7","1"]);
		bdd.push(["Acupression","attaque","8","3"]);
		bdd.push(["Adaptation","attaque","9","3"]);
		bdd.push(["Aeroblast","attaque","10","2"]);
		bdd.push(["Aeropique","attaque","11","1"]);
		bdd.push(["Affutage","attaque","12","3"]);
		bdd.push(["Aiguisage","attaque","13","3"]);
		bdd.push(["Aile D'Acier","attaque","14","1"]);
		bdd.push(["Air Veinard","attaque","15","3"]);
		bdd.push(["Aire d'Eau","attaque","16","2"]);
		bdd.push(["Aire d'Herbe","attaque","17","2"]);
		bdd.push(["Aire de Feu","attaque","18","2"]);
		bdd.push(["Allegement","attaque","19","3"]);
		bdd.push(["Amnesie","attaque","20","3"]);
		bdd.push(["Ampleur","attaque","21","1"]);
		bdd.push(["Anneau Hydro","attaque","22","3"]);
		bdd.push(["Anti-Air","attaque","23","1"]);
		bdd.push(["Anti-Brume","attaque","24","3"]);
		bdd.push(["Anti-Soin","attaque","25","3"]);
		bdd.push(["Appel Attak","attaque","26","1"]);
		bdd.push(["Appel Defens","attaque","27","3"]);
		bdd.push(["Appel Soins","attaque","28","3"]);
		bdd.push(["Apres Vous","attaque","29","3"]);
		bdd.push(["Aqua-Jet","attaque","30","1"]);
		bdd.push(["Armure","attaque","31","3"]);
		bdd.push(["Aromatherapi","attaque","32","3"]);
		bdd.push(["Assistance","attaque","33","3"]);
		bdd.push(["Assurance","attaque","34","1"]);
		bdd.push(["Astuce Force","attaque","35","3"]);
		bdd.push(["Atout","attaque","36","2"]);
		bdd.push(["Atterrissage","attaque","37","3"]);
		bdd.push(["Attraction","attaque","38","3"]);
		bdd.push(["Attrition","attaque","39","1"]);
		bdd.push(["Aurasphere","attaque","40","2"]);
		bdd.push(["Aurore","attaque","41","3"]);
		bdd.push(["Avalanche","attaque","42","1"]);
		bdd.push(["Avale","attaque","43","3"]);
		bdd.push(["Babil","attaque","44","2"]);
		bdd.push(["Baillement","attaque","45","3"]);
		bdd.push(["Bain de Smog","attaque","46","2"]);
		bdd.push(["Balance","attaque","47","3"]);
		bdd.push(["Balayage","attaque","48","1"]);
		bdd.push(["Balayette","attaque","49","1"]);
		bdd.push(["Ball'Brume","attaque","50","2"]);
		bdd.push(["Ball'Glace","attaque","51","1"]);
		bdd.push(["Ball'Meteo","attaque","52","2"]);
		bdd.push(["Ball'Ombre","attaque","53","2"]);
		bdd.push(["Balle Graine","attaque","54","1"]);
		bdd.push(["Barrage","attaque","55","3"]);
		bdd.push(["Baston","attaque","56","1"]);
		bdd.push(["Bec Vrille","attaque","57","1"]);
		bdd.push(["Belier","attaque","58","1"]);
		bdd.push(["Berceuse","attaque","59","3"]);
		bdd.push(["Blabla Dodo","attaque","60","3"]);
		bdd.push(["Blizzard","attaque","61","2"]);
		bdd.push(["Bluff","attaque","62","1"]);
		bdd.push(["Bomb'Oeuf","attaque","63","1"]);
		bdd.push(["Bomb-Beurk","attaque","64","2"]);
		bdd.push(["Bombaimant","attaque","65","1"]);
		bdd.push(["Bombe Acide","attaque","66","2"]);
		bdd.push(["Boost","attaque","67","3"]);
		bdd.push(["Bouclier","attaque","68","3"]);
		bdd.push(["Boue-Bombe","attaque","69","2"]);
		bdd.push(["Boul'Armure","attaque","70","3"]);
		bdd.push(["Boule Elek","attaque","71","2"]);
		bdd.push(["Boule Roc","attaque","72","1"]);
		bdd.push(["Bourdon","attaque","73","2"]);
		bdd.push(["Boutefeu","attaque","74","1"]);
		bdd.push(["Brouhaha","attaque","75","2"]);
		bdd.push(["Brouillard","attaque","76","3"]);
		bdd.push(["Brume","attaque","77","3"]);
		bdd.push(["Buee Noire","attaque","78","3"]);
		bdd.push(["Bulldoboule","attaque","79","1"]);
		bdd.push(["Bulles D'O","attaque","80","2"]);
		bdd.push(["Cadeau","attaque","81","1"]);
		bdd.push(["Cage-Eclair","attaque","82","3"]);
		bdd.push(["Calcination","attaque","83","2"]);
		bdd.push(["Camouflage","attaque","84","3"]);
		bdd.push(["Canicule","attaque","85","2"]);
		bdd.push(["Canon Graine","attaque","86","1"]);
		bdd.push(["Carnareket","attaque","87","2"]);
		bdd.push(["Cascade","attaque","88","1"]);
		bdd.push(["Casse-Brique","attaque","89","1"]);
		bdd.push(["Cauchemar","attaque","90","3"]);
		bdd.push(["ChangeEclair","attaque","91","2"]);
		bdd.push(["Chant Canon","attaque","92","2"]);
		bdd.push(["ChantAntique","attaque","93","2"]);
		bdd.push(["Charge","attaque","94","1"]);
		bdd.push(["Charge-Os","attaque","95","1"]);
		bdd.push(["ChargeFoudre","attaque","96","1"]);
		bdd.push(["Chargeur","attaque","97","3"]);
		bdd.push(["Charme","attaque","98","3"]);
		bdd.push(["Chatiment","attaque","99","2"]);
		bdd.push(["Chatouille","attaque","100","3"]);
		bdd.push(["Chgt Vitesse","attaque","101","3"]);
		bdd.push(["Choc Mental","attaque","102","2"]);
		bdd.push(["Choc Psy","attaque","103","2"]);
		bdd.push(["Choc Venin","attaque","104","2"]);
		bdd.push(["Chute Glace","attaque","105","1"]);
		bdd.push(["Chute Libre","attaque","106","1"]);
		bdd.push(["Clairvoyance","attaque","107","3"]);
		bdd.push(["Claquoir","attaque","108","1"]);
		bdd.push(["Clonage","attaque","109","3"]);
		bdd.push(["Close Combat","attaque","110","1"]);
		bdd.push(["Cogne","attaque","111","1"]);
		bdd.push(["Cognobidon","attaque","112","3"]);
		bdd.push(["Colere","attaque","113","1"]);
		bdd.push(["Combo-Griffe","attaque","114","1"]);
		bdd.push(["Constriction","attaque","115","1"]);
		bdd.push(["Contre","attaque","116","1"]);
		bdd.push(["Conversion 2","attaque","117","3"]);
		bdd.push(["Copie","attaque","118","3"]);
		bdd.push(["Copie Type","attaque","119","3"]);
		bdd.push(["Coquilame","attaque","120","1"]);
		bdd.push(["Corps Perdu","attaque","121","1"]);
		bdd.push(["Cotogarde","attaque","122","3"]);
		bdd.push(["Coud'Boue","attaque","123","2"]);
		bdd.push(["Coud'Krane","attaque","124","1"]);
		bdd.push(["Coup Bas","attaque","125","1"]);
		bdd.push(["Coup D'Boule","attaque","126","1"]);
		bdd.push(["Coup d'jus","attaque","127","2"]);
		bdd.push(["Coup D'Main","attaque","128","3"]);
		bdd.push(["Coup Double","attaque","129","1"]);
		bdd.push(["Coup-Croix","attaque","130","1"]);
		bdd.push(["Coupe","attaque","131","1"]);
		bdd.push(["Coupe Psycho","attaque","132","1"]);
		bdd.push(["Coupe-Vent","attaque","133","2"]);
		bdd.push(["CoupVictoire","attaque","134","1"]);
		bdd.push(["Cradovague","attaque","135","2"]);
		bdd.push(["Crevecoeur","attaque","136","1"]);
		bdd.push(["Croc De Mort","attaque","137","1"]);
		bdd.push(["Croc Fatal","attaque","138","1"]);
		bdd.push(["Crochetvenin","attaque","139","1"]);
		bdd.push(["Croco Larme","attaque","140","3"]);
		bdd.push(["Crocs Eclair","attaque","141","1"]);
		bdd.push(["Crocs Feu","attaque","142","1"]);
		bdd.push(["Crocs Givre","attaque","143","1"]);
		bdd.push(["Croissance","attaque","144","3"]);
		bdd.push(["Cru-Aile","attaque","145","1"]);
		bdd.push(["Cyclone","attaque","146","3"]);
		bdd.push(["Damocles","attaque","147","1"]);
		bdd.push(["Danse Draco","attaque","148","3"]);
		bdd.push(["Danse du Feu","attaque","149","2"]);
		bdd.push(["Danse Pluie","attaque","150","3"]);
		bdd.push(["Danse-Fleur","attaque","151","2"]);
		bdd.push(["Danse-Folle","attaque","152","3"]);
		bdd.push(["Danse-Lames","attaque","153","3"]);
		bdd.push(["Danse-Lune","attaque","154","3"]);
		bdd.push(["Danse-Plume","attaque","155","3"]);
		bdd.push(["Danseflamme","attaque","156","2"]);
		bdd.push(["Dard-Nuee","attaque","157","1"]);
		bdd.push(["Dard-Venin","attaque","158","1"]);
		bdd.push(["Deflagration","attaque","159","2"]);
		bdd.push(["Degommage","attaque","160","1"]);
		bdd.push(["Demi-Tour","attaque","161","1"]);
		bdd.push(["Depit","attaque","162","3"]);
		bdd.push(["Dernierecour","attaque","163","1"]);
		bdd.push(["Destruction","attaque","164","1"]);
		bdd.push(["Detection","attaque","165","3"]);
		bdd.push(["Detrempage","attaque","166","3"]);
		bdd.push(["Detricanon","attaque","167","1"]);
		bdd.push(["Detritus","attaque","168","2"]);
		bdd.push(["Devoreve","attaque","169","2"]);
		bdd.push(["Direct Toxik","attaque","170","1"]);
		bdd.push(["Distorsion","attaque","171","3"]);
		bdd.push(["Don naturel","attaque","172","1"]);
		bdd.push(["Double Baffe","attaque","173","1"]);
		bdd.push(["Double Pied","attaque","174","1"]);
		bdd.push(["Double-Dard","attaque","175","1"]);
		bdd.push(["Doux Baiser","attaque","176","3"]);
		bdd.push(["Doux Parfum","attaque","177","3"]);
		bdd.push(["Draco Meteor","attaque","178","2"]);
		bdd.push(["Draco-Queue","attaque","179","1"]);
		bdd.push(["Draco-Rage","attaque","180","2"]);
		bdd.push(["Dracocharge","attaque","181","1"]);
		bdd.push(["Dracochoc","attaque","182","2"]);
		bdd.push(["Dracogriffe","attaque","183","1"]);
		bdd.push(["Dracosouffle","attaque","184","2"]);
		bdd.push(["Dynamopoing","attaque","185","1"]);
		bdd.push(["E-Coque","attaque","186","3"]);
		bdd.push(["Eboulement","attaque","187","1"]);
		bdd.push(["Ebullilave","attaque","188","2"]);
		bdd.push(["Ebullition","attaque","189","2"]);
		bdd.push(["Echange","attaque","190","3"]);
		bdd.push(["Echange Psy","attaque","191","3"]);
		bdd.push(["Echo","attaque","192","2"]);
		bdd.push(["Eclair","attaque","193","2"]);
		bdd.push(["Eclair Croix","attaque","194","1"]);
		bdd.push(["Eclair Fou","attaque","195","1"]);
		bdd.push(["Eclair Gele","attaque","196","2"]);
		bdd.push(["Eclate-Roc","attaque","197","1"]);
		bdd.push(["Eclategriffe","attaque","198","1"]);
		bdd.push(["Eclats Glace","attaque","199","1"]);
		bdd.push(["Eco-Sphere","attaque","200","2"]);
		bdd.push(["Ecras'Face","attaque","201","1"]);
		bdd.push(["Ecrasement","attaque","202","1"]);
		bdd.push(["Ecume","attaque","203","2"]);
		bdd.push(["Effort","attaque","204","1"]);
		bdd.push(["Elecanon","attaque","205","2"]);
		bdd.push(["Electacle","attaque","206","1"]);
		bdd.push(["Embargo","attaque","207","3"]);
		bdd.push(["Empal'Korne","attaque","208","1"]);
		bdd.push(["Encore","attaque","209","3"]);
		bdd.push(["Encornebois","attaque","210","1"]);
		bdd.push(["Enroulement","attaque","211","3"]);
		bdd.push(["Entrave","attaque","212","3"]);
		bdd.push(["EreGlaciaire","attaque","213","2"]);
		bdd.push(["Eruption","attaque","214","2"]);
		bdd.push(["Escalade","attaque","215","1"]);
		bdd.push(["Essorage","attaque","216","2"]);
		bdd.push(["Etincelle","attaque","217","1"]);
		bdd.push(["Etonnement","attaque","218","1"]);
		bdd.push(["Etreinte","attaque","219","1"]);
		bdd.push(["Exploforce","attaque","220","2"]);
		bdd.push(["Explonuit","attaque","221","2"]);
		bdd.push(["Explosion","attaque","222","1"]);
		bdd.push(["Extrasenseur","attaque","223","2"]);
		bdd.push(["Exuviation","attaque","224","3"]);
		bdd.push(["Facade","attaque","225","1"]);
		bdd.push(["Fatal-Foudre","attaque","226","2"]);
		bdd.push(["Faux-Chage","attaque","227","1"]);
		bdd.push(["Feinte","attaque","228","1"]);
		bdd.push(["Feu d'Enfer","attaque","229","2"]);
		bdd.push(["Feu Follet","attaque","230","3"]);
		bdd.push(["Feu Glacé","attaque","231","1"]);
		bdd.push(["Feu Sacré","attaque","232","1"]);
		bdd.push(["Feuillemagik","attaque","233","2"]);
		bdd.push(["Flair","attaque","234","3"]);
		bdd.push(["Flamme Bleue","attaque","235","2"]);
		bdd.push(["Flamme Croix","attaque","236","2"]);
		bdd.push(["Flammeche","attaque","237","2"]);
		bdd.push(["Flash","attaque","238","3"]);
		bdd.push(["Flatterie","attaque","239","3"]);
		bdd.push(["Fléau","attaque","240","1"]);
		bdd.push(["Force","attaque","241","1"]);
		bdd.push(["Force Cachee","attaque","242","1"]);
		bdd.push(["Force Cosmik","attaque","243","3"]);
		bdd.push(["Force Poigne","attaque","244","1"]);
		bdd.push(["Force-Nature","attaque","245","3"]);
		bdd.push(["ForceAjoutée","attaque","246","2"]);
		bdd.push(["Forte-Paume","attaque","247","1"]);
		bdd.push(["Fouet Lianes","attaque","248","1"]);
		bdd.push(["Fracass'Tete","attaque","249","1"]);
		bdd.push(["Frappe Atlas","attaque","250","1"]);
		bdd.push(["Frappe Psy","attaque","251","2"]);
		bdd.push(["Frenesie","attaque","252","1"]);
		bdd.push(["Frustration","attaque","253","1"]);
		bdd.push(["Fulmifer","attaque","254","1"]);
		bdd.push(["Fulmigraine","attaque","255","2"]);
		bdd.push(["Furie","attaque","256","1"]);
		bdd.push(["Garde Large","attaque","257","3"]);
		bdd.push(["Gaz Toxik","attaque","258","3"]);
		bdd.push(["Gicledo","attaque","259","2"]);
		bdd.push(["Giga Impact","attaque","260","1"]);
		bdd.push(["Giga-Sangsue","attaque","261","2"]);
		bdd.push(["Glaciation","attaque","262","2"]);
		bdd.push(["Glas De Soin","attaque","263","3"]);
		bdd.push(["Gonflette","attaque","264","3"]);
		bdd.push(["Gravite","attaque","265","3"]);
		bdd.push(["Grele","attaque","266","3"]);
		bdd.push(["Gribouille","attaque","267","3"]);
		bdd.push(["Griffe","attaque","268","1"]);
		bdd.push(["Griffe Acier","attaque","269","1"]);
		bdd.push(["Griffe Ombre","attaque","270","1"]);
		bdd.push(["Grimace","attaque","271","3"]);
		bdd.push(["Grincement","attaque","272","3"]);
		bdd.push(["Grobisou","attaque","273","3"]);
		bdd.push(["Grondement","attaque","274","3"]);
		bdd.push(["Groz'Yeux","attaque","275","3"]);
		bdd.push(["Guillotine","attaque","276","1"]);
		bdd.push(["Gyroballe","attaque","277","1"]);
		bdd.push(["Hâte","attaque","278","3"]);
		bdd.push(["Hurle-Temps","attaque","279","2"]);
		bdd.push(["Hurlement","attaque","280","3"]);
		bdd.push(["Hydroblast","attaque","281","2"]);
		bdd.push(["Hydrocanon","attaque","282","2"]);
		bdd.push(["Hydroqueue","attaque","283","1"]);
		bdd.push(["Hypnose","attaque","284","3"]);
		bdd.push(["Imitation","attaque","285","3"]);
		bdd.push(["Implore","attaque","286","1"]);
		bdd.push(["Incendie","attaque","287","2"]);
		bdd.push(["Interversion","attaque","288","3"]);
		bdd.push(["Intimidation","attaque","289","3"]);
		bdd.push(["Jackpot","attaque","290","1"]);
		bdd.push(["Jet De Sable","attaque","291","3"]);
		bdd.push(["Jet-Pierres","attaque","292","1"]);
		bdd.push(["Jugement","attaque","293","2"]);
		bdd.push(["Koud'Korne","attaque","294","1"]);
		bdd.push(["Lait A Boire","attaque","295","3"]);
		bdd.push(["Lame d'Air","attaque","296","2"]);
		bdd.push(["Lame de Roc","attaque","297","1"]);
		bdd.push(["Lame Ointe","attaque","298","2"]);
		bdd.push(["Lame Sainte","attaque","299","1"]);
		bdd.push(["Lame-Feuille","attaque","300","1"]);
		bdd.push(["Lance-Boue","attaque","301","3"]);
		bdd.push(["Lance-Flamme","attaque","302","2"]);
		bdd.push(["Lance-Soleil","attaque","303","2"]);
		bdd.push(["Lancecrou","attaque","304","1"]);
		bdd.push(["Larcin","attaque","305","1"]);
		bdd.push(["Laser Glace","attaque","306","2"]);
		bdd.push(["Lechouille","attaque","307","1"]);
		bdd.push(["Levikinésie","attaque","308","3"]);
		bdd.push(["Ligotage","attaque","309","1"]);
		bdd.push(["Lilliput","attaque","310","3"]);
		bdd.push(["Lire-Esprit","attaque","311","3"]);
		bdd.push(["Lumi-Eclat","attaque","312","2"]);
		bdd.push(["Luminocanon","attaque","313","2"]);
		bdd.push(["Lumiqueue","attaque","314","3"]);
		bdd.push(["Lutte","attaque","315","1"]);
		bdd.push(["Mach Punch","attaque","316","1"]);
		bdd.push(["Machination","attaque","317","3"]);
		bdd.push(["Machouille","attaque","318","1"]);
		bdd.push(["Malediction","attaque","319","3"]);
		bdd.push(["Mania","attaque","320","1"]);
		bdd.push(["Marto-Poing","attaque","321","1"]);
		bdd.push(["Martobois","attaque","322","1"]);
		bdd.push(["Massd'Os","attaque","323","1"]);
		bdd.push(["Mawashi Geri","attaque","324","1"]);
		bdd.push(["Mega-Sangsue","attaque","325","2"]);
		bdd.push(["Megacorne","attaque","326","1"]);
		bdd.push(["Megafouet","attaque","327","1"]);
		bdd.push(["Megaphone","attaque","328","2"]);
		bdd.push(["Meteores","attaque","329","2"]);
		bdd.push(["Metronome","attaque","330","3"]);
		bdd.push(["Mimi-Queue","attaque","331","3"]);
		bdd.push(["Mimique","attaque","332","3"]);
		bdd.push(["Miroi-Tir","attaque","333","2"]);
		bdd.push(["Mitra-Poing","attaque","334","1"]);
		bdd.push(["Moi d'abord","attaque","335","3"]);
		bdd.push(["Morphing","attaque","336","3"]);
		bdd.push(["Morsure","attaque","337","1"]);
		bdd.push(["Mur De Fer","attaque","338","3"]);
		bdd.push(["Mur Lumiere","attaque","339","3"]);
		bdd.push(["Nitrocharge","attaque","340","1"]);
		bdd.push(["Noeud'Herbe","attaque","341","2"]);
		bdd.push(["Ocroupi","attaque","342","2"]);
		bdd.push(["Octazooka","attaque","343","2"]);
		bdd.push(["Oeil Miracle","attaque","344","3"]);
		bdd.push(["Ombre Portee","attaque","345","1"]);
		bdd.push(["Onde Boreale","attaque","346","2"]);
		bdd.push(["Onde De Choc","attaque","347","2"]);
		bdd.push(["Onde Folie","attaque","348","3"]);
		bdd.push(["Onde Vide","attaque","349","2"]);
		bdd.push(["Osmerang","attaque","350","1"]);
		bdd.push(["Ouragan","attaque","351","2"]);
		bdd.push(["Papillodanse","attaque","352","3"]);
		bdd.push(["Par Ici","attaque","353","3"]);
		bdd.push(["Para-Spore","attaque","354","3"]);
		bdd.push(["Paresse","attaque","355","3"]);
		bdd.push(["PartageForce","attaque","356","3"]);
		bdd.push(["PartageGarde","attaque","357","3"]);
		bdd.push(["Passe-Cadeau","attaque","358","3"]);
		bdd.push(["Passe-Passe","attaque","359","3"]);
		bdd.push(["Patience","attaque","360","1"]);
		bdd.push(["Peignee","attaque","361","1"]);
		bdd.push(["Permucoeur","attaque","362","3"]);
		bdd.push(["Permuforce","attaque","363","3"]);
		bdd.push(["Permugarde","attaque","364","3"]);
		bdd.push(["Photocopie","attaque","365","3"]);
		bdd.push(["Phytomixeur","attaque","366","2"]);
		bdd.push(["Picanon","attaque","367","1"]);
		bdd.push(["Picore","attaque","368","1"]);
		bdd.push(["Picots","attaque","369","3"]);
		bdd.push(["Picpic","attaque","370","1"]);
		bdd.push(["Pics Toxik","attaque","371","3"]);
		bdd.push(["Pied Bruleur","attaque","372","1"]);
		bdd.push(["Pied Saute","attaque","373","1"]);
		bdd.push(["Pied Voltige","attaque","374","1"]);
		bdd.push(["Piege de Roc","attaque","375","3"]);
		bdd.push(["Piétisol","attaque","376","1"]);
		bdd.push(["Pilonnage","attaque","377","1"]);
		bdd.push(["Pince-Masse","attaque","378","1"]);
		bdd.push(["Pique","attaque","379","1"]);
		bdd.push(["Piqure","attaque","380","1"]);
		bdd.push(["Pisto-Poing","attaque","381","1"]);
		bdd.push(["Pistolet A O","attaque","382","2"]);
		bdd.push(["Plaie-Croix","attaque","383","1"]);
		bdd.push(["Plaquage","attaque","384","1"]);
		bdd.push(["Plénitude","attaque","385","3"]);
		bdd.push(["Plongee","attaque","386","1"]);
		bdd.push(["Plumo-Queue","attaque","387","1"]);
		bdd.push(["Poing Comete","attaque","388","1"]);
		bdd.push(["Poing Dard","attaque","389","1"]);
		bdd.push(["Poing De Feu","attaque","390","1"]);
		bdd.push(["Poing Meteor","attaque","391","1"]);
		bdd.push(["Poing Ombre","attaque","392","1"]);
		bdd.push(["Poing-Eclair","attaque","393","1"]);
		bdd.push(["Poing-Karaté","attaque","394","1"]);
		bdd.push(["Poinglace","attaque","395","1"]);
		bdd.push(["Poison-Croix","attaque","396","1"]);
		bdd.push(["Poliroche","attaque","397","3"]);
		bdd.push(["Possessif","attaque","398","3"]);
		bdd.push(["Poudre Dodo","attaque","399","3"]);
		bdd.push(["Poudre Toxik","attaque","400","3"]);
		bdd.push(["PoudreFureur","attaque","401","3"]);
		bdd.push(["Poudreuse","attaque","402","2"]);
		bdd.push(["Poursuite","attaque","403","1"]);
		bdd.push(["Pouv.Antique","attaque","404","2"]);
		bdd.push(["Prescience","attaque","405","2"]);
		bdd.push(["Presse","attaque","406","1"]);
		bdd.push(["Prevention","attaque","407","3"]);
		bdd.push(["Prlvt Destin","attaque","408","3"]);
		bdd.push(["Projection","attaque","409","1"]);
		bdd.push(["Protection","attaque","410","3"]);
		bdd.push(["Provoc","attaque","411","3"]);
		bdd.push(["Psycho Boost","attaque","412","2"]);
		bdd.push(["Psyko","attaque","413","2"]);
		bdd.push(["Psykoud'Boul","attaque","414","1"]);
		bdd.push(["Puis. Cachée","attaque","415","2"]);
		bdd.push(["Puissance","attaque","416","3"]);
		bdd.push(["Punition","attaque","417","1"]);
		bdd.push(["Puredpois","attaque","418","2"]);
		bdd.push(["Queue De Fer","attaque","419","1"]);
		bdd.push(["Queue-Poison","attaque","420","1"]);
		bdd.push(["Racines","attaque","421","3"]);
		bdd.push(["Rafale Feu","attaque","422","2"]);
		bdd.push(["Rafale Psy","attaque","423","2"]);
		bdd.push(["Rancune","attaque","424","3"]);
		bdd.push(["Rapace","attaque","425","1"]);
		bdd.push(["Rayon Charge","attaque","426","2"]);
		bdd.push(["Rayon Gemme","attaque","427","2"]);
		bdd.push(["Rayon Lune","attaque","428","3"]);
		bdd.push(["Rayon Signal","attaque","429","2"]);
		bdd.push(["Rayon Simple","attaque","430","3"]);
		bdd.push(["Rebond","attaque","431","1"]);
		bdd.push(["Rebondifeu","attaque","432","2"]);
		bdd.push(["Recyclage","attaque","433","3"]);
		bdd.push(["Reflet","attaque","434","3"]);
		bdd.push(["Reflet Magik","attaque","435","3"]);
		bdd.push(["Regard Noir","attaque","436","3"]);
		bdd.push(["Regeneration","attaque","437","3"]);
		bdd.push(["Relache","attaque","438","2"]);
		bdd.push(["Relais","attaque","439","3"]);
		bdd.push(["Rengorgement","attaque","440","3"]);
		bdd.push(["Repli","attaque","441","3"]);
		bdd.push(["Repos","attaque","442","3"]);
		bdd.push(["Represailles","attaque","443","1"]);
		bdd.push(["Requiem","attaque","444","3"]);
		bdd.push(["Retour","attaque","445","1"]);
		bdd.push(["Reveil Force","attaque","446","1"]);
		bdd.push(["Revenant","attaque","447","1"]);
		bdd.push(["Riposte","attaque","448","1"]);
		bdd.push(["Roc-Boulet","attaque","449","1"]);
		bdd.push(["Ronflement","attaque","450","2"]);
		bdd.push(["Roue De Feu","attaque","451","1"]);
		bdd.push(["Roulade","attaque","452","1"]);
		bdd.push(["Rugissement","attaque","453","3"]);
		bdd.push(["Rune Protect","attaque","454","3"]);
		bdd.push(["Ruse","attaque","455","1"]);
		bdd.push(["Sabotage","attaque","456","1"]);
		bdd.push(["Sacrifice","attaque","457","1"]);
		bdd.push(["Saisie","attaque","458","3"]);
		bdd.push(["Saumure","attaque","459","2"]);
		bdd.push(["Secretion","attaque","460","3"]);
		bdd.push(["Seduction","attaque","461","3"]);
		bdd.push(["Seisme","attaque","462","1"]);
		bdd.push(["Siffl'Herbe","attaque","463","3"]);
		bdd.push(["Siphon","attaque","464","2"]);
		bdd.push(["Soin","attaque","465","3"]);
		bdd.push(["Sonicboom","attaque","466","2"]);
		bdd.push(["Soucigraine","attaque","467","3"]);
		bdd.push(["SouffleGlace","attaque","468","2"]);
		bdd.push(["Souplesse","attaque","469","1"]);
		bdd.push(["Souvenir","attaque","470","3"]);
		bdd.push(["Spatio-Rift","attaque","471","2"]);
		bdd.push(["Spore","attaque","472","3"]);
		bdd.push(["Spore Coton","attaque","473","3"]);
		bdd.push(["Stalagtite","attaque","474","1"]);
		bdd.push(["Stimulant","attaque","475","1"]);
		bdd.push(["Stockage","attaque","476","3"]);
		bdd.push(["Stratopercut","attaque","477","1"]);
		bdd.push(["Strido-Son","attaque","478","3"]);
		bdd.push(["Suc Digestif","attaque","479","3"]);
		bdd.push(["Surchauffe","attaque","480","2"]);
		bdd.push(["Surf","attaque","481","2"]);
		bdd.push(["Surpuissance","attaque","482","1"]);
		bdd.push(["Survinsecte","attaque","483","2"]);
		bdd.push(["Synchropeine","attaque","484","2"]);
		bdd.push(["Synthese","attaque","485","3"]);
		bdd.push(["Tacle Feu","attaque","486","1"]);
		bdd.push(["Tacle lourd","attaque","487","1"]);
		bdd.push(["Taillade","attaque","488","1"]);
		bdd.push(["TechnoBuster","attaque","489","2"]);
		bdd.push(["Telekinesie","attaque","490","3"]);
		bdd.push(["Teleport","attaque","491","3"]);
		bdd.push(["Telluriforce","attaque","492","2"]);
		bdd.push(["Tempetesable","attaque","493","3"]);
		bdd.push(["Tempeteverte","attaque","494","2"]);
		bdd.push(["Ten-danse","attaque","495","3"]);
		bdd.push(["Tenacite","attaque","496","3"]);
		bdd.push(["Tenebres","attaque","497","2"]);
		bdd.push(["Tete de Fer","attaque","498","1"]);
		bdd.push(["Tir De Boue","attaque","499","2"]);
		bdd.push(["Toile","attaque","500","3"]);
		bdd.push(["Toile Elek","attaque","501","2"]);
		bdd.push(["Tomberoche","attaque","502","1"]);
		bdd.push(["Tonnerre","attaque","503","2"]);
		bdd.push(["Torgnoles","attaque","504","1"]);
		bdd.push(["Tornade","attaque","505","2"]);
		bdd.push(["Tour Rapide","attaque","506","1"]);
		bdd.push(["Tourbi-Sable","attaque","507","1"]);
		bdd.push(["Tourmagik","attaque","508","3"]);
		bdd.push(["Tourmente","attaque","509","3"]);
		bdd.push(["Tourniquet","attaque","510","3"]);
		bdd.push(["Tout ou Rien","attaque","511","2"]);
		bdd.push(["Toxik","attaque","512","3"]);
		bdd.push(["Tranch'Air","attaque","513","2"]);
		bdd.push(["Tranch'Herbe","attaque","514","1"]);
		bdd.push(["Tranche","attaque","515","1"]);
		bdd.push(["Tranche-Nuit","attaque","516","1"]);
		bdd.push(["Trempette","attaque","517","3"]);
		bdd.push(["Tricherie","attaque","518","1"]);
		bdd.push(["Triplattaque","attaque","519","2"]);
		bdd.push(["Triple Pied","attaque","520","1"]);
		bdd.push(["Trou Noir","attaque","521","3"]);
		bdd.push(["Tunnel","attaque","522","1"]);
		bdd.push(["Tunnelier","attaque","523","1"]);
		bdd.push(["Ultimapoing","attaque","524","1"]);
		bdd.push(["Ultimawashi","attaque","525","1"]);
		bdd.push(["Ultralaser","attaque","526","2"]);
		bdd.push(["Ultrason","attaque","527","3"]);
		bdd.push(["Uppercut","attaque","528","1"]);
		bdd.push(["Vague Psy","attaque","529","2"]);
		bdd.push(["Vampigraine","attaque","530","3"]);
		bdd.push(["Vampipoing","attaque","531","1"]);
		bdd.push(["Vampirisme","attaque","532","1"]);
		bdd.push(["Vantardise","attaque","533","3"]);
		bdd.push(["Vege-Attak","attaque","534","2"]);
		bdd.push(["Vendetta","attaque","535","1"]);
		bdd.push(["Vengeance","attaque","536","1"]);
		bdd.push(["Vent Argente","attaque","537","2"]);
		bdd.push(["Vent Arriere","attaque","538","3"]);
		bdd.push(["Vent Glace","attaque","539","2"]);
		bdd.push(["Vent Mauvais","attaque","540","2"]);
		bdd.push(["Vent Violent","attaque","541","2"]);
		bdd.push(["Verrouillage","attaque","542","3"]);
		bdd.push(["Vibra Soin","attaque","543","3"]);
		bdd.push(["Vibraqua","attaque","544","2"]);
		bdd.push(["Vibrobscur","attaque","545","2"]);
		bdd.push(["Vit.Extreme","attaque","546","1"]);
		bdd.push(["Vive-Attaque","attaque","547","1"]);
		bdd.push(["Voeu","attaque","548","3"]);
		bdd.push(["Voeu Soin","attaque","549","3"]);
		bdd.push(["Voile Miroir","attaque","550","2"]);
		bdd.push(["Vol","attaque","551","1"]);
		bdd.push(["Vol Magnetik","attaque","552","3"]);
		bdd.push(["Vol-Vie","attaque","553","2"]);
		bdd.push(["Vortex Magma","attaque","554","2"]);
		bdd.push(["Yama Arashi","attaque","555","1"]);
		bdd.push(["Yoga","attaque","556","3"]);
		bdd.push(["Zenith","attaque","557","3"]);
		bdd.push(["Zone Etrange","attaque","558","3"]);
		bdd.push(["Zone Magique","attaque","559","3"]);
		bdd.push(["Absentéisme","capspe","1"]);
		bdd.push(["Absorb Eau","capspe","2"]);
		bdd.push(["Absorb Volt","capspe","3"]);
		bdd.push(["Acharné","capspe","4"]);
		bdd.push(["Adaptabilité","capspe","5"]);
		bdd.push(["Agitation","capspe","6"]);
		bdd.push(["Air Lock","capspe","7"]);
		bdd.push(["Alerte Neige","capspe","8"]);
		bdd.push(["Analyste","capspe","9"]);
		bdd.push(["Annule Garde","capspe","10"]);
		bdd.push(["Anti-Bruit","capspe","11"]);
		bdd.push(["Anticipation","capspe","12"]);
		bdd.push(["Armumagma","capspe","13"]);
		bdd.push(["Armurbaston","capspe","14"]);
		bdd.push(["Armurouillée","capspe","15"]);
		bdd.push(["Attention","capspe","16"]);
		bdd.push(["Baigne Sable","capspe","17"]);
		bdd.push(["Benêt","capspe","18"]);
		bdd.push(["Boom Final","capspe","19"]);
		bdd.push(["Brasier","capspe","20"]);
		bdd.push(["Brise Moule","capspe","21"]);
		bdd.push(["Calque","capspe","22"]);
		bdd.push(["Chaceux","capspe","23"]);
		bdd.push(["Cherche Miel","capspe","24"]);
		bdd.push(["Chlorophyle","capspe","25"]);
		bdd.push(["Ciel Gris","capspe","26"]);
		bdd.push(["Cour de Coq","capspe","27"]);
		bdd.push(["Cour Noble","capspe","28"]);
		bdd.push(["Cour Soin","capspe","29"]);
		bdd.push(["Colérique","capspe","30"]);
		bdd.push(["Coloforce","capspe","31"]);
		bdd.push(["Contestation","capspe","32"]);
		bdd.push(["Coque Armure","capspe","33"]);
		bdd.push(["Corps Ardent","capspe","34"]);
		bdd.push(["Corps Gel","capspe","35"]);
		bdd.push(["Corps Maudit","capspe","36"]);
		bdd.push(["Corps Sain","capspe","37"]);
		bdd.push(["Crachin","capspe","38"]);
		bdd.push(["Cran","capspe","39"]);
		bdd.push(["Cuvette","capspe","40"]);
		bdd.push(["Début Calme","capspe","41"]);
		bdd.push(["Défaitiste","capspe","42"]);
		bdd.push(["Déguisement","capspe","43"]);
		bdd.push(["Délestage","capspe","44"]);
		bdd.push(["Don Floral","capspe","45"]);
		bdd.push(["Écaille Spé.","capspe","46"]);
		bdd.push(["Échauffement","capspe","47"]);
		bdd.push(["Écran Fumée","capspe","48"]);
		bdd.push(["Écran Poudre","capspe","49"]);
		bdd.push(["Engrais","capspe","50"]);
		bdd.push(["Envelocape","capspe","51"]);
		bdd.push(["Épine de Fer","capspe","52"]);
		bdd.push(["Esprit Vital","capspe","53"]);
		bdd.push(["Essaim","capspe","54"]);
		bdd.push(["Farceur","capspe","55"]);
		bdd.push(["Fermeté","capspe","56"]);
		bdd.push(["Feuil. Garde","capspe","57"]);
		bdd.push(["Filtre","capspe","58"]);
		bdd.push(["Force Pure","capspe","59"]);
		bdd.push(["Force Sable","capspe","60"]);
		bdd.push(["Force Soleil","capspe","61"]);
		bdd.push(["Fouille","capspe","62"]);
		bdd.push(["Frein","capspe","63"]);
		bdd.push(["Fuite","capspe","64"]);
		bdd.push(["Garde Amie","capspe","65"]);
		bdd.push(["Garde Magik","capspe","66"]);
		bdd.push(["Garde Mystik","capspe","67"]);
		bdd.push(["Glissade","capspe","68"]);
		bdd.push(["Gloutonnerie","capspe","69"]);
		bdd.push(["Glue","capspe","70"]);
		bdd.push(["Heavy Metal","capspe","71"]);
		bdd.push(["Herbivore","capspe","72"]);
		bdd.push(["Hydratation","capspe","73"]);
		bdd.push(["Hyper Cutter","capspe","74"]);
		bdd.push(["Ignifu-Voile","capspe","75"]);
		bdd.push(["Ignifuge","capspe","76"]);
		bdd.push(["Illusion","capspe","77"]);
		bdd.push(["Impassible","capspe","78"]);
		bdd.push(["Imposteur","capspe","79"]);
		bdd.push(["Impudence","capspe","80"]);
		bdd.push(["Inconscient","capspe","81"]);
		bdd.push(["Infiltration","capspe","82"]);
		bdd.push(["Insomnia","capspe","83"]);
		bdd.push(["Intimidation","capspe","84"]);
		bdd.push(["Isograisse","capspe","85"]);
		bdd.push(["Joli Sourire","capspe","86"]);
		bdd.push(["Lavabo","capspe","87"]);
		bdd.push(["Lentiteintée","capspe","88"]);
		bdd.push(["Lévitation","capspe","89"]);
		bdd.push(["Light Metal","capspe","90"]);
		bdd.push(["Lumiattirance","capspe","91"]);
		bdd.push(["Lunatique","capspe","92"]);
		bdd.push(["Magnépiège","capspe","93"]);
		bdd.push(["Maladresse","capspe","94"]);
		bdd.push(["Marque Ombre","capspe","95"]);
		bdd.push(["Matinal","capspe","96"]);
		bdd.push(["Mauvais Rêve","capspe","97"]);
		bdd.push(["Médic Nature","capspe","98"]);
		bdd.push(["Météo","capspe","99"]);
		bdd.push(["Minus","capspe","100"]);
		bdd.push(["Miroir Magik","capspe","101"]);
		bdd.push(["Mode Transe","capspe","102"]);
		bdd.push(["Moiteur","capspe","103"]);
		bdd.push(["Momie","capspe","104"]);
		bdd.push(["Motorisé","capspe","105"]);
		bdd.push(["Mue","capspe","106"]);
		bdd.push(["Multi-Coups","capspe","107"]);
		bdd.push(["Multi-Type","capspe","108"]);
		bdd.push(["Multiécaille","capspe","109"]);
		bdd.push(["Normalise","capspe","110"]);
		bdd.push(["Oil Composé","capspe","111"]);
		bdd.push(["Paratonnerre","capspe","112"]);
		bdd.push(["Peau Dure","capspe","113"]);
		bdd.push(["Peau Miracle","capspe","114"]);
		bdd.push(["Peau Sèche","capspe","115"]);
		bdd.push(["Phobique","capspe","116"]);
		bdd.push(["Pickpocket","capspe","117"]);
		bdd.push(["Pied Confus","capspe","118"]);
		bdd.push(["Pied Véloce","capspe","119"]);
		bdd.push(["Piège","capspe","120"]);
		bdd.push(["Plus","capspe","121"]);
		bdd.push(["Poing de Fer","capspe","122"]);
		bdd.push(["Point Poison","capspe","123"]);
		bdd.push(["Pose Spore","capspe","124"]);
		bdd.push(["Prédiction","capspe","125"]);
		bdd.push(["Pression","capspe","126"]);
		bdd.push(["Puanteur","capspe","127"]);
		bdd.push(["Querelleur","capspe","128"]);
		bdd.push(["Rage Brûlure","capspe","129"]);
		bdd.push(["Rage Poison","capspe","130"]);
		bdd.push(["Ramassage","capspe","131"]);
		bdd.push(["Récolte","capspe","132"]);
		bdd.push(["Regard Vif","capspe","133"]);
		bdd.push(["Régé-Force","capspe","134"]);
		bdd.push(["Rideau Neige","capspe","135"]);
		bdd.push(["Rivalité","capspe","136"]);
		bdd.push(["Sable Volant","capspe","137"]);
		bdd.push(["Sans Limite","capspe","138"]);
		bdd.push(["Sécheresse","capspe","139"]);
		bdd.push(["Sérénité","capspe","140"]);
		bdd.push(["Simple","capspe","141"]);
		bdd.push(["Sniper","capspe","142"]);
		bdd.push(["Soin Poison","capspe","143"]);
		bdd.push(["Solide Roc","capspe","144"]);
		bdd.push(["Statik","capspe","145"]);
		bdd.push(["Suintement","capspe","146"]);
		bdd.push(["Synchro","capspe","147"]);
		bdd.push(["Technicien","capspe","148"]);
		bdd.push(["Téléchargement","capspe","149"]);
		bdd.push(["Télépathe","capspe","150"]);
		bdd.push(["Téméraire","capspe","151"]);
		bdd.push(["Tempo Perso","capspe","152"]);
		bdd.push(["Tension","capspe","153"]);
		bdd.push(["Téra-Voltage","capspe","154"]);
		bdd.push(["Tête de Roc","capspe","155"]);
		bdd.push(["Torche","capspe","156"]);
		bdd.push(["Torrent","capspe","157"]);
		bdd.push(["Toxitouche","capspe","158"]);
		bdd.push(["Turbo","capspe","159"]);
		bdd.push(["TurboBrasier","capspe","160"]);
		bdd.push(["Vaccin","capspe","161"]);
		bdd.push(["Ventouse","capspe","162"]);
		bdd.push(["Victorieux","capspe","163"]);
		bdd.push(["Voile Sable","capspe","164"]);
		bdd.push(["Aucun","type","-1"]);
		bdd.push(["Acier","type","1"]);
		bdd.push(["Combat","type","2"]);
		bdd.push(["Dragon","type","3"]);
		bdd.push(["Eau","type","4"]);
		bdd.push(["Electr","type","5"]);
		bdd.push(["Feu","type","6"]);
		bdd.push(["Glace","type","7"]);
		bdd.push(["Insect","type","8"]);
		bdd.push(["Normal","type","9"]);
		bdd.push(["Plante","type","10"]);
		bdd.push(["Poison","type","11"]);
		bdd.push(["Psy","type","12"]);
		bdd.push(["Roche","type","13"]);
		bdd.push(["Sol","type","14"]);
		bdd.push(["Spectr","type","15"]);
		bdd.push(["Tenebr","type","16"]);
		bdd.push(["Vol","type","17"]);
		bdd.push(["PV","stat","0"]);
		bdd.push(["PV >= XXX","stat","0"]);
		bdd.push(["PV <= XXX","stat","0"]);
		bdd.push(["PV = XXX","stat","0"]);
		bdd.push(["PV > Att","stat","PV > Att"]);
		bdd.push(["PV > AttSpe","stat","PV > AttSpe"]);
		bdd.push(["PV > Def","stat","PV > Def"]);
		bdd.push(["PV > DefSpe","stat","PV > Defspe"]);
		bdd.push(["PV > Vit","stat","PV > Vit"]);
		bdd.push(["PV = Att","stat","PV = Att"]);
		bdd.push(["PV = AttSpe","stat","PV = AttSpe"]);
		bdd.push(["PV = Def","stat","PV = Def"]);
		bdd.push(["PV = DefSpe","stat","PV = Defspe"]);
		bdd.push(["PV = Vit","stat","PV = Vit"]);
		bdd.push(["Att","stat","0"]);
		bdd.push(["Att >= XXX","stat","0"]);
		bdd.push(["Att <= XXX","stat","0"]);
		bdd.push(["Att = XXX","stat","0"]);
		bdd.push(["Att > PV","stat","Att > PV"]);
		bdd.push(["Att > AttSpe","stat","Att > AttSpe"]);
		bdd.push(["Att > Def","stat","Att > Def"]);
		bdd.push(["Att > DefSpe","stat","Att > Defspe"]);
		bdd.push(["Att > Vit","stat","Att > Vit"]);
		bdd.push(["Att = PV","stat","Att = PV"]);
		bdd.push(["Att = AttSpe","stat","Att = AttSpe"]);
		bdd.push(["Att = Def","stat","Att = Def"]);
		bdd.push(["Att = DefSpe","stat","Att = Defspe"]);
		bdd.push(["Att = Vit","stat","Att = Vit"]);
		bdd.push(["AttSpe","stat","0"]);
		bdd.push(["AttSpe >= XXX","stat","0"]);
		bdd.push(["AttSpe <= XXX","stat","0"]);
		bdd.push(["AttSpe = XXX","stat","0"]);
		bdd.push(["AttSpe > PV","stat","AttSpe > PV"]);
		bdd.push(["AttSpe > Att","stat","AttSpe > Att"]);
		bdd.push(["AttSpe > Def","stat","AttSpe > Def"]);
		bdd.push(["AttSpe > DefSpe","stat","AttSpe > DefSpe"]);
		bdd.push(["AttSpe > Vit","stat","AttSpe > Vit"]);
		bdd.push(["AttSpe = PV","stat","AttSpe = PV"]);
		bdd.push(["AttSpe = Att","stat","AttSpe = Att"]);
		bdd.push(["AttSpe = Def","stat","AttSpe = Def"]);
		bdd.push(["AttSpe = DefSpe","stat","AttSpe = DefSpe"]);
		bdd.push(["AttSpe = Vit","stat","AttSpe = Vit"]);
		bdd.push(["Def","stat","0"]);
		bdd.push(["Def >= XXX","stat","0"]);
		bdd.push(["Def <= XXX","stat","0"]);
		bdd.push(["Def = XXX","stat","0"]);
		bdd.push(["Def > PV","stat","Def > PV"]);
		bdd.push(["Def > Att","stat","Def > Att"]);
		bdd.push(["Def > AttSpe","stat","Def > AttSpe"]);
		bdd.push(["Def > DefSpe","stat","Def > DefSpe"]);
		bdd.push(["Def > Vit","stat","Def > Vit"]);
		bdd.push(["Def = PV","stat","Def = PV"]);
		bdd.push(["Def = Att","stat","Def = Att"]);
		bdd.push(["Def = AttSpe","stat","Def = AttSpe"]);
		bdd.push(["Def = DefSpe","stat","Def = DefSpe"]);
		bdd.push(["Def = Vit","stat","Def = Vit"]);
		bdd.push(["DefSpe","stat","0"]);
		bdd.push(["DefSpe >= XXX","stat","0"]);
		bdd.push(["DefSpe <= XXX","stat","0"]);
		bdd.push(["DefSpe = XXX","stat","0"]);
		bdd.push(["DefSpe > PV","stat","DefSpe > PV"]);
		bdd.push(["DefSpe > Att","stat","DefSpe > Att"]);
		bdd.push(["DefSpe > AttSpe","stat","DefSpe > AttSpe"]);
		bdd.push(["DefSpe > Def","stat","DefSpe > Def"]);
		bdd.push(["DefSpe > Vit","stat","DefSpe > Vit"]);
		bdd.push(["DefSpe = PV","stat","DefSpe = PV"]);
		bdd.push(["DefSpe = Att","stat","DefSpe = Att"]);
		bdd.push(["DefSpe = AttSpe","stat","DefSpe = AttSpe"]);
		bdd.push(["DefSpe = Def","stat","DefSpe = Def"]);
		bdd.push(["DefSpe = Vit","stat","DefSpe = Vit"]);
		bdd.push(["Vit","stat","0"]);
		bdd.push(["Vit >= XXX","stat","0"]);
		bdd.push(["Vit <= XXX","stat","0"]);
		bdd.push(["Vit = XXX","stat","0"]);
		bdd.push(["Vit > PV","stat","Vit > PV"]);
		bdd.push(["Vit > Att","stat","Vit > Att"]);
		bdd.push(["Vit > AttSpe","stat","Vit > AttSpe"]);
		bdd.push(["Vit > Def","stat","Vit > Def"]);
		bdd.push(["Vit > DefSpe","stat","Vit > DefSpe"]);
		bdd.push(["Vit = PV","stat","Vit = PV"]);
		bdd.push(["Vit = Att","stat","Vit = Att"]);
		bdd.push(["Vit = AttSpe","stat","Vit = AttSpe"]);
		bdd.push(["Vit = Def","stat","Vit = Def"]);
		bdd.push(["Vit = DefSpe","stat","Vit = DefSpe"]);
		bdd.push(["Total","stat","0"]);
		bdd.push(["Total >= XXX","stat","0"]);
		bdd.push(["Total <= XXX","stat","0"]);
		bdd.push(["Total = XXX","stat","0"]);
		bdd.push(["PV+Att","stat","0"]);
		bdd.push(["PV+Att >= XXX","stat","0"]);
		bdd.push(["PV+Att <= XXX","stat","0"]);
		bdd.push(["PV+Att = XXX","stat","0"]);
		bdd.push(["Att+PV","stat","0"]);
		bdd.push(["Att+PV >= XXX","stat","0"]);
		bdd.push(["Att+PV <= XXX","stat","0"]);
		bdd.push(["Att+PV = XXX","stat","0"]);
		bdd.push(["PV+AttSpe","stat","0"]);
		bdd.push(["PV+AttSpe >= XXX","stat","0"]);
		bdd.push(["PV+AttSpe <= XXX","stat","0"]);
		bdd.push(["PV+AttSpe = XXX","stat","0"]);
		bdd.push(["AttSpe+PV","stat","0"]);
		bdd.push(["AttSpe+PV >= XXX","stat","0"]);
		bdd.push(["AttSpe+PV <= XXX","stat","0"]);
		bdd.push(["AttSpe+PV = XXX","stat","0"]);
		bdd.push(["PV+Def","stat","0"]);
		bdd.push(["PV+Def >= XXX","stat","0"]);
		bdd.push(["PV+Def <= XXX","stat","0"]);
		bdd.push(["PV+Def = XXX","stat","0"]);
		bdd.push(["Def+PV","stat","0"]);
		bdd.push(["Def+PV >= XXX","stat","0"]);
		bdd.push(["Def+PV <= XXX","stat","0"]);
		bdd.push(["Def+PV = XXX","stat","0"]);
		bdd.push(["PV+DefSpe","stat","0"]);
		bdd.push(["PV+DefSpe >= XXX","stat","0"]);
		bdd.push(["PV+DefSpe <= XXX","stat","0"]);
		bdd.push(["PV+DefSpe = XXX","stat","0"]);
		bdd.push(["DefSpe+PV","stat","0"]);
		bdd.push(["DefSpe+PV >= XXX","stat","0"]);
		bdd.push(["DefSpe+PV <= XXX","stat","0"]);
		bdd.push(["DefSpe+PV = XXX","stat","0"]);
		bdd.push(["PV+Vit","stat","0"]);
		bdd.push(["PV+Vit >= XXX","stat","0"]);
		bdd.push(["PV+Vit <= XXX","stat","0"]);
		bdd.push(["PV+Vit = XXX","stat","0"]);
		bdd.push(["Vit+PV","stat","0"]);
		bdd.push(["Vit+PV >= XXX","stat","0"]);
		bdd.push(["Vit+PV <= XXX","stat","0"]);
		bdd.push(["Vit+PV = XXX","stat","0"]);
		bdd.push(["Att+AttSpe","stat","0"]);
		bdd.push(["Att+AttSpe >= XXX","stat","0"]);
		bdd.push(["Att+AttSpe <= XXX","stat","0"]);
		bdd.push(["Att+AttSpe = XXX","stat","0"]);
		bdd.push(["AttSpe+Att","stat","0"]);
		bdd.push(["AttSpe+Att >= XXX","stat","0"]);
		bdd.push(["AttSpe+Att <= XXX","stat","0"]);
		bdd.push(["AttSpe+Att = XXX","stat","0"]);
		bdd.push(["Att+Def","stat","0"]);
		bdd.push(["Att+Def >= XXX","stat","0"]);
		bdd.push(["Att+Def <= XXX","stat","0"]);
		bdd.push(["Att+Def = XXX","stat","0"]);
		bdd.push(["Def+Att","stat","0"]);
		bdd.push(["Def+Att >= XXX","stat","0"]);
		bdd.push(["Def+Att <= XXX","stat","0"]);
		bdd.push(["Def+Att = XXX","stat","0"]);
		bdd.push(["Att+DefSpe","stat","0"]);
		bdd.push(["Att+DefSpe >= XXX","stat","0"]);
		bdd.push(["Att+DefSpe <= XXX","stat","0"]);
		bdd.push(["Att+DefSpe = XXX","stat","0"]);
		bdd.push(["DefSpe+Att","stat","0"]);
		bdd.push(["DefSpe+Att >= XXX","stat","0"]);
		bdd.push(["DefSpe+Att <= XXX","stat","0"]);
		bdd.push(["DefSpe+Att = XXX","stat","0"]);
		bdd.push(["Att+Vit","stat","0"]);
		bdd.push(["Att+Vit >= XXX","stat","0"]);
		bdd.push(["Att+Vit <= XXX","stat","0"]);
		bdd.push(["Att+Vit = XXX","stat","0"]);
		bdd.push(["Vit+Att","stat","0"]);
		bdd.push(["Vit+Att >= XXX","stat","0"]);
		bdd.push(["Vit+Att <= XXX","stat","0"]);
		bdd.push(["Vit+Att = XXX","stat","0"]);
		bdd.push(["Def+DefSpe","stat","0"]);
		bdd.push(["Def+DefSpe >= XXX","stat","0"]);
		bdd.push(["Def+DefSpe <= XXX","stat","0"]);
		bdd.push(["Def+DefSpe = XXX","stat","0"]);
		bdd.push(["DefSpe+Def","stat","0"]);
		bdd.push(["DefSpe+Def >= XXX","stat","0"]);
		bdd.push(["DefSpe+Def <= XXX","stat","0"]);
		bdd.push(["DefSpe+Def = XXX","stat","0"]);
		bdd.push(["Def+Vit","stat","0"]);
		bdd.push(["Def+Vit >= XXX","stat","0"]);
		bdd.push(["Def+Vit <= XXX","stat","0"]);
		bdd.push(["Def+Vit = XXX","stat","0"]);
		bdd.push(["Vit+Def","stat","0"]);
		bdd.push(["Vit+Def >= XXX","stat","0"]);
		bdd.push(["Vit+Def <= XXX","stat","0"]);
		bdd.push(["Vit+Def = XXX","stat","0"]);
		bdd.push(["DefSpe+Vit","stat","0"]);
		bdd.push(["DefSpe+Vit >= XXX","stat","0"]);
		bdd.push(["DefSpe+Vit <= XXX","stat","0"]);
		bdd.push(["DefSpe+Vit = XXX","stat","0"]);
		bdd.push(["Vit+DefSpe","stat","0"]);
		bdd.push(["Vit+DefSpe >= XXX","stat","0"]);
		bdd.push(["Vit+DefSpe <= XXX","stat","0"]);
		bdd.push(["Vit+DefSpe = XXX","stat","0"]);
		bdd.push(["Att+AttSpe+Vit","stat","0"]);
		bdd.push(["Att+AttSpe+Vit >= XXX","stat","0"]);
		bdd.push(["Att+AttSpe+Vit <= XXX","stat","0"]);
		bdd.push(["Att+AttSpe+Vit = XXX","stat","0"]);
		bdd.push(["Def+DefSpe+Vit","stat","0"]);
		bdd.push(["Def+DefSpe+Vit >= XXX","stat","0"]);
		bdd.push(["Def+DefSpe+Vit <= XXX","stat","0"]);
		bdd.push(["Def+DefSpe+Vit = XXX","stat","0"]);
		bdd.push(["PV+Att+AttSpe","stat","0"]);
		bdd.push(["PV+Att+AttSpe >= XXX","stat","0"]);
		bdd.push(["PV+Att+AttSpe <= XXX","stat","0"]);
		bdd.push(["PV+Att+AttSpe = XXX","stat","0"]);
		bdd.push(["PV+Def+DefSpe","stat","0"]);
		bdd.push(["PV+Def+DefSpe >= XXX","stat","0"]);
		bdd.push(["PV+Def+DefSpe <= XXX","stat","0"]);
		bdd.push(["PV+Def+DefSpe = XXX","stat","0"]);
		bdd.push(["PV*Def","stat","0"]);
		bdd.push(["PV*Def >= XXX","stat","0"]);
		bdd.push(["PV*Def <= XXX","stat","0"]);
		bdd.push(["PV*Def = XXX","stat","0"]);
		bdd.push(["Def*PV","stat","0"]);
		bdd.push(["Def*PV >= XXX","stat","0"]);
		bdd.push(["Def*PV <= XXX","stat","0"]);
		bdd.push(["Def*PV = XXX","stat","0"]);
		bdd.push(["PV*DefSpe","stat","0"]);
		bdd.push(["PV*DefSpe >= XXX","stat","0"]);
		bdd.push(["PV*DefSpe <= XXX","stat","0"]);
		bdd.push(["PV*DefSpe = XXX","stat","0"]);
		bdd.push(["DefSpe*PV","stat","0"]);
		bdd.push(["DefSpe*PV >= XXX","stat","0"]);
		bdd.push(["DefSpe*PV <= XXX","stat","0"]);
		bdd.push(["DefSpe*PV = XXX","stat","0"]);
		bdd.push(["Puissance >= XXX","carac_attaque","0"])
		bdd.push(["Puissance <= XXX","carac_attaque","0"]);
		bdd.push(["Puissance = XXX","carac_attaque","0"]);
		bdd.push(["Probabilite >= XXX","carac_attaque","0"])
		bdd.push(["Probabilite <= XXX","carac_attaque","0"]);
		bdd.push(["Probabilite = XXX","carac_attaque","0"]);
		bdd.push(["PP >= XXX","carac_attaque","0"])
		bdd.push(["PP <= XXX","carac_attaque","0"]);
		bdd.push(["PP = XXX","carac_attaque","0"]);
		bdd.push(["Priorite >= XXX","carac_attaque","0"])
		bdd.push(["Priorite <= XXX","carac_attaque","0"]);
		bdd.push(["Priorite = XXX","carac_attaque","0"]);
				
		$(document).ready(
			function()
			{
				$("#filtre").on("mouseover", "div",
					function() 
					{
						$(this).children("a").css("text-decoration", "line-through");
					}
				);
				
				$("#filtre").on("mouseout", "div",
					function() 
					{
						$(this).children("a").css("text-decoration", "none");
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
						id = $(this).attr("data-id");
						zeros = "";
						if(id < 10)
							zeros = "00";
						else if(id < 100)
							zeros = "0";
						
						window.open("http://www.pokebip.com/pokemon/pokedex/index.php?phppage=recherche&req=%23" + zeros + id + "&submit=Go+%21");	
					}
				);
				
				$("#pokedex").on("contextmenu", ".resultat",
					function() 
					{
						elem = "<div id='equipe_" + $("#equipe > .resultat").length + "' class='resultat'><img src='" + $(this).find("img").attr("src") + "' style='display: none;' /></div>";
						position_top = 0;
						
						if($("#equipe > .resultat").length == 0)
						{
							$("#equipe").append(elem);
							$("#footer").slideDown(400);

							position_top -= 106;
						}
						else
						{
							$("#equipe > .resultat").last().after(elem);
						}
						
						img = $(this).find("img").clone();
						
						img.css("z-index", "10");
						img.css("position", "absolute");
						img.css("top", $(this).offset().top);
						img.css("left", $(this).offset().left);
						
						$("body").append(img);
						
						position_top += $("#equipe > .resultat").last().offset().top;
						img.animate({top: position_top, left: $("#equipe > .resultat").last().offset().left}, 400);
						img.promise().done(
							function(obj)
							{
								$("#equipe_" + ($("#equipe > .resultat").length - 1)).find("img").show(); // Probleme : ne doit que focus qu'une seule div a la fois.
								$(this).remove();
							}
						);
						
						return false;
					}
				);
				
				$("#equipe").on("click", ".resultat",
					function() 
					{
						img = $(this).find("img").clone();
						
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
						alert("Coming soon...");
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
						$("#info_bulle_survol").css("display", "block");
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
						
						liste_index = get_filtre_index();
												
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
				if($welcome)
				{
				?>
					etape_tuto = 0;
					$("#tuto_0").show();
					
					$("#tuto").bPopup(
						{
							speed: 300,
							transition: "slideIn",
							follow: [false, false],
							scrollBar: false,
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
					
					$(".avancer_tuto").on("click",
						function() 
						{
							if($("#tuto > div").length - 2 >= etape_tuto) // On passe a l'etape suivante. Si on est arrive au bout, on ferme le tuto.
								etape_tuto++;
							else
							{
								reinitilialiser_filtre();
								return $(".close_popup").trigger("click");
							}
							
							$("#tuto > div").hide("fast");

							if(etape_tuto == 1)
							{
								reinitilialiser_filtre();
								introduce_obj($("#saisie"));
								$("#tuto").animate({top: $("#saisie").offset().top + $("#saisie").height() + 25, left: $(window).width() / 2 - 280}, 750, function(){$("#tuto_" + etape_tuto).show("fast");});
							}
							else if(etape_tuto == 3)
							{
								$("#saisie").val("p");
								auto_completer();
								introduce_obj($("#espace_recherche > div[id!=filtre] > div"));
								$("#tuto").animate({left: $("#saisie").offset().left + $("#saisie").width() + 15}, 750, function(){$("#tuto_" + etape_tuto).show("fast");});
							}
							else if(etape_tuto == 4)
							{
								selectionner_completion_fleches(1);
								introduce_obj($("#completion_1"));								
							}
							else if(etape_tuto == 5)
							{
								valider_completion(0);
								introduce_obj($("#filtre div").first());
								$("#tuto").animate({top: $("#filtre div").first().offset().top + $("#filtre div").first().height() + 25, left: $(window).width() / 2 - 380}, 750, function(){$("#tuto_" + etape_tuto).show("fast");});
							}
							else if(etape_tuto == 6)
							{
								introduce_obj($("#pokedex > .resultat"));
								$("#tuto").animate({top: 0, left: 0}, 750);
							}
							else if(etape_tuto == 7)
							{
								introduce_obj($("#social"));
								$("#tuto").animate({top: $("#social").height() + $("#social").offset().top + 25, left: $(window).width() - $("#tuto").width()}, 750);
							}
							
							$("#tuto_" + etape_tuto).show("fast");
							$(".b-modal").css("opacity", "0"); // Durant le tutoriel, on ne veut pas que le site soit cache.
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
					offset = 0;

					if(r_values[r_index] >= bdd.length)
						reinitilialiser_filtre("Erreur : code " + r_values[r_index] + " trop grand.");

					critere = bdd[r_values[r_index]][0];
					if(critere.match(/XXX/i)) // Gestion d'un cas particulier s'il s'agit d'un critere de statistique avec valeur.
					{
						if(++r_index >= r_values.length)
							reinitilialiser_filtre("Erreur : code erron\351.");

						critere = critere.replace(/XXX/i, r_values[r_index]);
						offset = -1;
					}

					$("#saisie").val(critere);
					auto_completer();

					select = 0;
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
			liste_index = new Array();
						
			$.each($("#filtre > div"),
				function()
				{
					for(var index in bdd)
					{
						if(bdd[index][1] == $(this).attr("class"))
						{
							if(bdd[index][0].match(/XXX/))
							{
								if(bdd[index][0].replace(/XXX/, "") == $(this).attr("data-val").replace(/[+-]?[0-9]+/, ""))
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
			var r=str.toLowerCase();
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
					.replace(/'/, "&#039;")
					.replace(/ /, "&nbsp;");
		}
   
		function recherche(e)
		{
			key = 0;
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
					$("#saisie").val($("#completion_" + numero_completion).attr("data-val").replace(/XXX/, ""));
					$("#saisie").focus();
					return;
				}
				
				contenu = $("#completion_" + numero_completion).clone().removeAttr("id");
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
						scroll: false,
						helper: 'clone',
						revert: true,
						cursor: 'move',
						delay: 150,
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
						
			liste_cat = new Array;
			liste_val = new Array;
			$("#filtre > div").each(
				function()
				{
					liste_cat.push(encodeURIComponent($(this).attr("class")));
					liste_val.push(encodeURIComponent($(this).attr("data-val")));
				}
			);
						
			numero_requete = ++nombre_requetes; // Ce chiffre permet de connaitre la requete en cours pour n'afficher que les resultats de cette derniere.
			
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
								var img = "/images/pkmn/fixe/" + pkmn.id + (pkmn.form ? "-" + pkmn.form : "") + ".png";
								
								var regexp = new RegExp("id='" + pkmn.id + "'", "g");
								temp += "<div data-id='" + pkmn.id + "' class='resultat'" + (pkmn.form ? " data-forme='" + pkmn.form + "'" : "") + "><img src='" + img + "' alt='#" + pkmn.id + "' />";
								
								if(pkmn.stats) // Si le l'objet pokemon contient des informations autres que l'id et la forme, on les affiche.
								{
									temp += "<div><a>&nbsp;</a>";
									
									for(var i = 0; i < pkmn.stats.length; i++)
									{
										var stat = pkmn.stats[i];
										temp += "<a>" + stat.name + "&nbsp;" + stat.val + "</a>";
									}

									temp += "</div>";
								}
								
								temp += "</div>";
								$("#pokedex").append(temp);
							}

							afficher_nombre_resultats();

							$("#pokedex > .resultat div").css("marginTop", ($("#pokedex > .resultat:first").height() - $("#pokedex > .resultat:first div > a").length * $("#pokedex > .resultat:first div > a:first").height()) + "px"); // Colle le texte au bas de l'image.
							
							$("#pokedex > .resultat").draggable(
								{
									cursor: 'move',
									stack: "#pokedex > .resultat",
									delay: 150

								}
							);
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
			texte = resultat[1];
			len = $.trim(saisie).length;
			pos = resultat[0];
			
			if(pos < 0)
				pos = 0;
			
			substr1 = (pos == 0 ? "" : texte.substr(0, pos));
			substr2 = texte.substr(pos, len);
			substr3 = (pos + len >= texte.length ? "" : texte.substr(pos + len));
			
			return htmlSpecialChars(substr1) + "<b>" + htmlSpecialChars(substr2) + "</b>" + htmlSpecialChars(substr3);
		}

		function auto_completer()
		{
			// Initialisation et securites.
			numero_completion = -1;
			$("#menu").html("");

			saisie = effacer_accents($("#saisie").val().toLowerCase());
			
			if($.trim(saisie) == "")
				return;
			
			focus_saisie = true;
			$("#menu").show();
			
			tab = [];
			
			// Recherche.
			for(var index in bdd)
			{
				mot = bdd[index][0];
				
				if(val = saisie.match(/[+-]?[0-9]+$/)) // L'autocompletion s'adapte aux stats.
				{
					mot = mot.replace(/XXX$/, val);
				}
				
				pos = effacer_accents(mot.toLowerCase()).indexOf(saisie);
				
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
						tab.push([pos, mot, bdd[index][1], bdd[index][2], bdd[index][3]]);
					else if(bdd[index][1] == "stat" || mot.match(/[<>=]/))
						tab.push([pos, mot, bdd[index][1], mot]);
					else
						tab.push([pos, mot, bdd[index][1], bdd[index][2]]);
				}
			}
			
			// Auto-selection automatique si espace a la fin du mot.
			if(tab.length <= 0 && saisie.match(/[^ ] $/))
			{
				saisie_bis = saisie.slice(0, -1);
				for(var index in bdd)
				{
					pos = effacer_accents(bdd[index][0].toLowerCase()).indexOf(saisie_bis);
					
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
				affichage = "<a>" + surligner_correspondance(tab[i], saisie) + "</a>";
				
				if(tab[i][2] == "type")
				{
					affichage = "<img src='/images/pkmn/type/" + tab[i][3] + ".png' alt='#" + tab[i][1] + "' />&nbsp;" + affichage;
				}
				else if(tab[i][2] == "pokemon" || tab[i][2] == "numero")
				{
					affichage = "<img src='/images/pkmn/mini/" + tab[i][3] + ".png' alt='#" + tab[i][3] + "' />&nbsp;" + affichage;
				}
				else if(tab[i][2] == "attaque")
				{
					if(tab[i][4] == 1)
						cat = "Physique";
					else if(tab[i][4] == 2)
						cat = "Spéciale";
					else
						cat = "Statut"; // Status actually...
					
					affichage = "<img src='/images/pkmn/cat/" + tab[i][4] + ".png' alt='" + cat + "' />&nbsp;" + affichage;
				}

				$("#menu").html($("#menu").html() + "<div id='completion_" + i + "' class='" + tab[i][2] + "' data-val='" + tab[i][3] + "'>&nbsp;" + affichage + "&nbsp;</div>");
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
		
		function auto_completer_ajax()
		{
			numero_completion = -1;
			
			saisie = $("#saisie").val();
			
			if(saisie == "")
			{
				$("#menu").html("");
				return;
			}
			
			$.get("/ajax/autocompleter.php", { cle: saisie }, 
				function(data)
				{
					$("#menu").html("").html(data);
					
					if($("#menu > *").length == 1)
					{
						selectionner_completion_fleches(0);
					}
					else if($("#menu > *").length > 1)
					{
						if($.trim(effacer_accents($("#completion_0").text().toLowerCase().replace(/&nbsp;/, " "))) == effacer_accents(saisie.toLowerCase()))
						{
							selectionner_completion_fleches(0);
						}
					}
				}
			);
		}
		
		function afficher_nombre_resultats_bon()
		{
			var liste = $("#pokedex > .resultat").attr("data_id");
			var nombre_affiches = liste.length;
			var nombre_pokemons = $.unique(liste).length;
			var nombre_formes_supplementaires = nombre_affiches - nombre_pokemons;
			
			
			// On adapte l'affichage des resultats.
			if($("#pokedex").css("width").replace(/px/, "") > nombre_affiches * 96)
				$("#pokedex > .resultat").css("float", "none");
			else
				$("#pokedex > .resultat").css("float", "left");
			
			// Affichage du nombre de resultats.
			if($("#pokedex > img").length > 0) // Si on charge les resultats.
			{
				$("#nombre_resultats_recherche").html("<i>Recherche en cours ...</i>");
			}
			else
			{
				var texte = "";
				if(nombre_affiches == 0)
				{
					texte = "Aucun r&eacute;sultat";
				}
				else if(nombre_affiches == 1)
				{
					texte = "1 seul r&eacute;sultat";
				}
				else
				{
					texte = nombre_affiches + " r&eacute;sultats";
					
					if(nombre_formes_supplementaires > 0)
					{
						if(nombre_pokemons == 1)
							texte += " (1 Pok&eacute;mon";
						else
							texte += " (" + nombre_pokemons + " Pok&eacute;mon(s)";
						
						if(nombre_formes_supplementaires == 1)
							texte += " + 1 forme d&eacute;riv&eacute;e)";
						else
							texte += " + " + nombre_formes_supplementaires + " formes d&eacute;riv&eacute;es)";
					}
				}
				
				$("#nombre_resultats_recherche").html(texte);
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
			
			liste_cat = new Array;
			liste_val = new Array;
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
				$("#nombre_resultats_recherche").html("<i>Recherche en cours ...</i>");
			}
			else
			{
				texte = "";
				if(nombre_affiches == 0)
				{
					texte = "Aucun r&eacute;sultat";
				}
				else if(nombre_affiches == 1)
				{
					texte = "1 seul r&eacute;sultat";
				}
				else
				{
					texte = nombre_affiches + " r&eacute;sultats";
					
					if(nombre_formes_supplementaires > 0)
					{
						if(nombre_pokemons == 1)
							texte += " (1 Pok&eacute;mon";
						else
							texte += " (" + nombre_pokemons + " Pok&eacute;mon(s)";
						
						if(nombre_formes_supplementaires == 1)
							texte += " + 1 forme d&eacute;riv&eacute;e)";
						else
							texte += " + " + nombre_formes_supplementaires + " formes d&eacute;riv&eacute;es)";
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
			if(navigator.appName.match(/Microsoft/))
			{
				cursor = getCursor(event);
				$("#info_bulle_survol").css("margin-left", (cursor.x + 15) + "px");
				$("#info_bulle_survol").css("margin-top", (cursor.y + document.body.scrollTop + 15) + "px");
				$("#info_bulle_survol").css("display", "block");	
			}
			else
			{
				cursor = getCursor(event);
				$("#info_bulle_survol").css("margin-left", (cursor.x + 15) + "px");
				$("#info_bulle_survol").css("margin-top", (cursor.y + 15) + "px");
				$("#info_bulle_survol").css("display", "block");	
			}
		}
		
		function remplir_info_bulle(id, forme)
		{
			$.get("/ajax/get_info_bulle.php", { id: id, forme: forme }, 
				function(data) 
				{
					$("#info_bulle_survol").html("").html(data);
				}
			);
		}
		
		function cacher_infos_survol(event)
		{
			//$("#info_bulle_survol").style.display = "none";
			$("#info_bulle_survol_img1").src = "http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png";
			$("#info_bulle_survol_img2").src = "http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png";
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
			<div>Enregistrez votre recherche ou partagez-la avec vos amis avec l'URL suivante :</div>
			<input type="text" id="url_share" />
		</div>
		
		<div id="tuto" class="popup">
			<div id="tuto_0">
				Bienvenue sur Encyclopedex !<br />
				Voulez-vous apprendre à vous servir du Pokédex ?<br />
				<input class="avancer_tuto" type="button" value="Oui bonne idée !" /><br />
				<input class="close_popup" type="button" value="Non merci, pas besoin." />
			</div>
			
			<div id="tuto_1">
				En haut au centre se trouve la barre de recherche.<br />
				C'est avec celle-ci que l'on sélectionne les critères de recherche.<br />
				<input class="avancer_tuto" type="button" value="Continuer" />
			</div>
			
			<div id="tuto_2">
				Vous pouvez utiliser différents critères parmi les catégories suivantes :<br />
				<br />
				<div class="pokemon">Pokémon</div>
				<div class="numero">Numéro national</div>
				<div class="type">Type</div>
				<div class="capspe">Capacité spéciale</div>
				<div class="attaque">Attaque</div>
				<div class="stat">Statistiques de base</div>
				<br />
				... et d'autres à venir !<br />
				<input class="avancer_tuto" type="button" value="Continuer" />
			</div>
			
			<div id="tuto_3">
				Démonstration :<br />
				Tapons la lettre "P" dans le champ de recherche.<br />
				Un menu déroulant apparait pour proposer les résultats les plus pertinents.<br />
				On remarque les différentes catégories à leur couleur.<br />
				<input class="avancer_tuto" type="button" value="Continuer" />
			</div>
			
			<div id="tuto_4">
				Quand un critère du menu est sélectionné, il apparait en bleu.<br />
				Il existe plusieurs moyen pour les sélectionner :<br />
				
				<p>
					1) En cliquant dessus.<br />
					2) En utilisant les fleches Haut et Bas du clavier, puis la touche Entrée.<br />
					3) Lorsqu'il n'y a qu'un seul résultat dans le menu, la touche Espace le sélectionnera.<br />
					4) Utiliser la touche Entrée sélectionne le premier résultat du menu.
				</p>
				
				Note : vous pouvez combiner les critères.<br />
				<input class="avancer_tuto" type="button" value="Continuer" />
			</div>
			
			<div id="tuto_5">
				Une fois que le critère est validé, il apparait au-dessus le champ de recherche.<br />
				Cette zone constitue le filtre de votre recherche.<br />
				Il existe 3 moyens de supprimer un critère du filtre :<br />
				
				<p>
					1) En cliquant dessus.<br />
					2) En utilisant la touche Retour arrière quand le champ de recherche est vide.<br />
					3) Cliquer sur la croix rouge efface tous les critères.
				</p>
				
				Astuce : la touche de partage à gauche permet d'enregistrer ou partager votre recherche.<br />
				<input class="avancer_tuto" type="button" value="Continuer" />
			</div>
			
			<div id="tuto_6">
				La liste des Pokémon se met à jour automatiquement.<br />
				Voici la liste des Pokémon Psy !<br />
				Passer le curseur au dessus d'un Pokémon permet obtenir plus d'informations.<br />
				Cliquer dessus permet d'accéder à sa fiche technique.<br />
				<br />
				Astuce : appuyez sur la touche Entrée quand le champ de recherche est vide,<br />
				vous accédez à la fiche du premier Pokémon de la liste.<br />
				<input class="avancer_tuto" type="button" value="Continuer" />
			</div>
			
			<div id="tuto_7">
				Le tutoriel se termine ici.<br />
				Si vous aimez le concept de ce Pokédex, faites-le connaitre !<br />
				En cas de besoin n'hésitez pas à me contacter.<br />
				<br />
				Enjoy :)<br />
				<input class="avancer_tuto" type="button" value="Fermer le tutoriel" />
			</div>
		</div>
		
		
				
		<div id="info_bulle_survol">
			<p id="info_bulle_survol_txt" style="padding-bottom: 3px; margin: 0px;"></p>
			<img id="info_bulle_survol_img1" src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png' />
			<img id="info_bulle_survol_img2" src='http://www.pokebip.com/pokemon/pokedex/images/gen4_types/18.png' />
		</div>
		
		<div id="header">
			<div id="logo">
				<a href="http://encyclopedex.com"><img src="/images/logos/encyclopedex_logo7.png" alt="Encyclopedex" /></a>
			</div>
			
			<div id="social">
				<!-- Debut medias sociaux -->
				<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.encyclopedex.com%2F&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=183420345139463" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe>
				
				<div class="social_button">
					<a href="https://twitter.com/share" class="twitter-share-button" data-lang="fr">Tweeter</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
				
				<!-- Place this tag where you want the +1 button to render. -->
				<div class="g-plusone" class="social_button" data-size="medium"></div>

				<!-- Place this tag after the last +1 button tag. -->
				<script type="text/javascript">
				  window.___gcfg = {lang: 'fr'};

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
			</div>
			
			
			<div id="espace_recherche">
				<div id="filtre">
				</div>
						
				<div style="margin: 0.5em auto; width: 15em;">
						<div>
							<input id="saisie" type="text" onkeyup="recherche(event);" placeholder="Search by type, attack, stat..." autocomplete="off" autofocus />
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
				<input type='button' value='Comparer' /><br />
				<input type='button' value='Combattre' /><br />
				<input type='button' value='Analyser' />
			</div>
		</div>
	</body>
	
</html>
>>>>>>> fce4d4bc4373bcf878d3da1f2601c5920026a5a9
