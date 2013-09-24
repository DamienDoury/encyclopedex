<?php
include_once "functions.php";

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

include_once "langs/trad_" . $lang . ".php";







if(isset($_GET["n"]) && $_GET["n"] != "")
{
	$pkmn = get_pokemon($_GET["n"]);
}
else
{
	header("Location: http://" . $_SERVER["DOMAIN_NAME"] . "/pokedex/");
	return;
}

$id = $pkmn["id_pokemon"];
?><!DOCTYPE HTML>
<html lang="<?php echo $lang; ?>">
	<head>
		<title><?php echo $pkmn["nom_" . $lang]; ?> - Encyclopedex</title>
		<link rel="icon" type="image/png" href="/images/pkmn/mini/<?php echo $pkmn['id_pokemon']; ?>.png" />
		<meta name="viewport" content="width=480, user-scalable=yes">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" type="text/css" href="http://encyclopedex.com/pokedex.css" />
		<style>
			html, body, center
			{
				margin: 0;
				padding: 0;
				left: 0;
				top: 0;
				right: 0;
				bottom: 0;
			}

			#portrait img
			{
				position: absolute;
				top: 0;
				left: 0;
				height: 192px;
				width: auto;

				/* June 2013 */
				image-rendering: optimizeQuality;           /* Legal fallback                 */
				image-rendering: -moz-crisp-edges;          /* Firefox                        */
				image-rendering: -o-crisp-edges;            /* Opera                          */
				image-rendering: -webkit-optimize-contrast; /* Chrome (and eventually Safari) */
				image-rendering: optimize-contrast;         /* CSS3 Proposed                  */
				-ms-interpolation-mode: nearest-neighbor;   /* IE8+                           */
			}

			#f
			{
				animation: fade_f 1.5s infinite alternate;
				animation-timing-function: linear;

				-webkit-animation: fade_f 1.5s infinite alternate;
				-webkit-animation-timing-function: linear;
			}

			#m
			{
				animation: fade_m 1.5s infinite alternate;
				animation-timing-function: linear;

				-webkit-animation: fade_m 1.5s infinite alternate;
				-webkit-animation-timing-function: linear;
			}

			iframe
			{
				margin: auto;
				display: inline-block;
				border: none;
				width: 100%;
				height: 100%;
			}

			@keyframes fade_f
			{
				0%   {opacity: 0;}
				40%  {opacity: 0;}
				50%  {opacity: 1;}
				100% {opacity: 1;}
			}

			@-webkit-keyframes fade_f /* Safari and Chrome */
			{
				0%   {opacity: 0;}
				40%  {opacity: 0;}
				50%  {opacity: 1;}
				100% {opacity: 1;}
			}

			@keyframes fade_m
			{
				0%   {opacity: 1;}
				50%  {opacity: 1;}
				60%  {opacity: 0;}
				100% {opacity: 0;}
			}

			@-webkit-keyframes fade_m /* Safari and Chrome */
			{
				0%   {opacity: 1;}
				50%  {opacity: 1;}
				60%  {opacity: 0;}
				100% {opacity: 0;}
			}

			#content
			{
				position: relative;
				margin-top: 84px;
			}

			#espace_recherche
			{
				color: yellow;
			}

			@media (max-device-width: 900px), (max-width: 900px)
			{
				#content
				{
					margin-top: 0;
				}
			}
		</style>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="/libs/jquery.cookie.js"></script>
		<script>
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
			}
		);
		</script>
	</head>

	<body>
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
				<?php echo IN_CONSTRUCTION ?>
			</div>
		</div>





		<center id="content">
			<div id="portrait">
				<img id="f" src="http://www.pokebip.com/pokemon/pokedex/images/bw_front_f/<?php echo $id; ?>.png" />
				<img id="m" src="http://www.pokebip.com/pokemon/pokedex/images/bw_front_m/<?php echo $id; ?>.png" />
			</div>

			<?php
			if($lang == "en")
				echo '<iframe src="http://bulbapedia.bulbagarden.net/wiki/' . $pkmn["nom_en"] . '"></iframe>';
			else if($lang == "fr")
				echo '<iframe src="http://pokedex.p-pokemon.com/' . $pkmn["nom_fr"] . '-pokemon-' . $pkmn["id_pokemon"] . '.html"></iframe>';
			?>
		</center>
	</body>
</html>