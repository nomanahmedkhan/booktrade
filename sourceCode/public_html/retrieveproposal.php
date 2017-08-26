<?php
SESSION_START();
$count5 = 0;

connectToDatabase();

try{
  $temp = $_SESSION["username"];
  $inboxQuery = $connectionToDatabase->prepare ("SELECT fromUsername, message FROM messages WHERE toUsername= '$temp' ");
  $inboxQuery->execute();
  $messages = $inboxQuery->fetchall();
  abortDatabaseConnection();
}catch (PDOException $e) {
  echo "HAHAHAHAHA";
}


?>
