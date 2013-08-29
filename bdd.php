<?php
session_start();

//Connexion avec la bdd.
try
{
	$bdd = ""; // [CONNECTION STRING] //
}
catch (Exception $e)
{
	die("Voici l'erreur : " . $e->getMessage());
}
//Fin connexion avec la bdd.
?>