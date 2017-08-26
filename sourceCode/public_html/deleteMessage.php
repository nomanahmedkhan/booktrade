<?php
SESSION_START();
if(isset($_POST['deleteMessage'])){

$temp1 = $_POST['deleteMessage'];
$toUsername = $_SESSION["username"];
$fromUsername = $messages[$temp1][0];
$message = $messages[$temp1][1];


connectToDatabase();

$deleteMessageQuery = "DELETE FROM messages WHERE toUsername = '$toUsername' and fromUsername = '$fromUsername' and message='$message'";
$connectionToDatabase -> exec($deleteMessageQuery);
abortDatabaseConnection();
header("Refresh:0; url=index.php#profile");
}

 ?>
