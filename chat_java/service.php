<?php
include "../bdd.php";

if(isset($_POST["id_user"]) && $_POST["id_user"] != ""
	&& isset($_POST["message"]) && $_POST["message"] != "")
{
	$bdd->exec("
		INSERT INTO chat_java_message (id_chat_java_user, message)
		VALUES ('" . $_POST["id_user"] . "', '" . $_POST["message"] . "')
		");
}

$message_list = $bdd->query("
		SELECT pseudo, subscription_date, message
		FROM chat_java_message NATURAL JOIN chat_java_user
		ORDER BY creation_date DESC
		LIMIT 0, 30
		");

if($message_list)
{
	while($message = $message_list->fetch())
	{
		echo $message["pseudo"] . " [" . $message["subscription_date"] . "]: \n";
		echo $message["message"] . "\n\n";
	}
}
?>