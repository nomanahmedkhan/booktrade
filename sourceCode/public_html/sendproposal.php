<?php
SESSION_START();

if(isset($_POST["proposalButton"])){
   echo "hi";
  $temp = $_POST['proposalButton'];
  $toUsername = $library[$temp][0];
  $fromUsername = $_SESSION['username'];
  $message = $_POST["proposalBox"];
  echo $_POST["proposalBox"];

  connectToDatabase();
  try{
    $addMessageQuery =
    "INSERT INTO messages (toUsername, fromUsername, message)
    VALUES ('$toUsername','$fromUsername','$message')";
    $connectionToDatabase->exec($addMessageQuery);
    abortDatabaseConnection();
    header('Location: #libraryContent');
  }catch(PDOException $e){
    echo "something wrong";

  }
}

 ?>
