<?php
define("NUMERO_VERSION", 13);

include "../ressources/code_alphabet.php";

$liste_index = explode(",", $_POST["toconvert"]);

$taille_code = 3;

foreach($liste_index as $val)
{
	if($val == "")
		continue;
	
	if($val >= pow(strlen($alphabet), $taille_code)) // Si le chiffre est trop grand, on previent de l'erreur.
	{
		echo "#Erreur : la valeur '" . $val . "' est trop grande. Impossible de partager cette recherche.";
		return;
	}
	else
	{
		for($i = $taille_code - 1; $i >= 0; $i--)
			$code .= $alphabet[floor($val / pow(strlen($alphabet), $i)) % strlen($alphabet)]; // Chaque valeur sera codee sur 2 caracteres, donc on simplifie la formule.
	}
}

if($code != "")
	echo $alphabet[NUMERO_VERSION] . $code;
?>