<?php
include "../bdd.php";

if(isset($_POST["email"]) && $_POST["email"] != ""
	&& isset($_POST["password"]) && $_POST["password"] != ""
	&& isset($_POST["pseudo"]) && $_POST["pseudo"] != ""
	&& isset($_POST["firstname"]) && $_POST["firstname"] != ""
	&& isset($_POST["lastname"]) && $_POST["lastname"] != "")
{
	$result = $bdd->query("
		SELECT *
		FROM chat_java_user
		WHERE email LIKE BINARY '" . $_POST["email"] . "'
		OR pseudo LIKE BINARY '" . $_POST["pseudo"] . "'
		");

	if($result)
	{
		if($result->rowCount() > 0)
		{
			echo "-2";
			return;
		}
	}

	$bdd->exec("
		INSERT INTO chat_java_user (email, password, pseudo, prenom, nom)
		VALUES 
		(
			'" . $_POST["email"] . "', 
			'" . $_POST["password"] . "', 
			'" . $_POST["pseudo"] . "', 
			'" . $_POST["firstname"] . "', 
			'" . $_POST["lastname"] . "'
		)
		");

	$id = $bdd->lastInsertId();

	if($id)
	{
		echo $id;
		return;
	}
}
else
{
	echo -1;
}
?>