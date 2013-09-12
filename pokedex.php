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