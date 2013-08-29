<?php
set_time_limit(0);

for($i = 550; $i <= 649; $i++)
{
	$url = "http://www.pokebip.com/pokemon/pokedex/images/gen5_miniatures/" . $i . ".png";
	$img = "../images/pkmn/mini/" . $i . ".png";
	file_put_contents($img, file_get_contents($url));
}
?>

