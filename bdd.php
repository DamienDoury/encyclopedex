<?php
session_start();

//Connexion avec la bdd.
try
{
	$bdd = new PDO('mysql:host=encyclopedex.db.11155814.hostedresource.com;dbname=encyclopedex', 'encyclopedex', 'Encycl0pede%');
}
catch (Exception $e)
{
	die("Voici l'erreur : " . $e->getMessage());
}
//Fin connexion avec la bdd.
?>