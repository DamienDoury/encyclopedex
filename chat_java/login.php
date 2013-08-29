<?php
include "../bdd.php";

if(isset($_POST["email"]) && $_POST["email"] != ""
	&& isset($_POST["password"]) && $_POST["password"] != "")
{
	$result = $bdd->query("
		SELECT id_chat_java_user
		FROM chat_java_user
		WHERE email LIKE BINARY '" . $_POST["email"] . "'
		AND password LIKE BINARY '" . $_POST["password"] . "'
		LIMIT 0, 1
		");

	if($result)
	{
		$id = $result->fetchAll();

		if($id)
		{
			echo $id[0]["id_chat_java_user"];
			return;
		}
	}
}

echo -1;
return;
?>