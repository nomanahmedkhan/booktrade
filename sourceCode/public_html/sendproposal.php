<?php
SESSION_START();

if(isset($_POST["proposalButton"])){
  $temp = $_POST['proposalButton'];
  $toUsername = $library[$temp][0];
  $fromUsername = $_SESSION['username'];
  $tempString = "proposalBox"+$temp;
  $message = $_POST["$tempString"];


  connectToDatabase();
  try{
    $addMessageQuery =
    "INSERT INTO messages (toUsername, fromUsername, message)
    VALUES ('$toUsername','$fromUsername','$message')";
    $connectionToDatabase->exec($addMessageQuery);
    abortDatabaseConnection();
    header("Refresh:0; url=index.php#libraryContent");

  }catch(PDOException $e){
    echo "something wrong";

  }
}

 ?>
