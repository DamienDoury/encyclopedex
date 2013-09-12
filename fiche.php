<?php
$numero = (isset($_GET["n"]) ? $_GET["n"] : "25");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
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

			img
			{
				position: absolute;
				top: 0;
				left: 0;
				height: 192px;
				width: auto;

				/* June 2013 */
				image-rendering: optimizeQuality;             /* Legal fallback                 */
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
		</style>

		<script>
		
		</script>
	</head>

	<body>
		<center>
			<div>
				<img id="f" src="http://www.pokebip.com/pokemon/pokedex/images/bw_front_f/<?php echo $numero; ?>.png" />
				<img id="m" src="http://www.pokebip.com/pokemon/pokedex/images/bw_front_m/<?php echo $numero; ?>.png" />
			</div>

			<iframe src="http://bulbapedia.bulbagarden.net/wiki/Heracross"></iframe>
			<iframe src="http://pokedex.p-pokemon.com/scarhino-pokemon-214.html"></iframe>
		</center>
	</body>
</html>