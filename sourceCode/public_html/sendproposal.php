<?php
SESSION_START();

if(isset($_POST["proposalButton"])){
  $temp = $_POST['proposalButton'];
  $toUsername = $library[$temp][0];
  $fromUsername = $_SESSION['username'];
  $message = $_POST["proposalMessage"];


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

}elseif(isset($_POST["sendReply"])){
  $temp = $_POST['sendReply'];
  $toUsername = $_POST['replyToUsername'];
  $fromUsername = $_SESSION['username'];
  $message = $_POST['replyMessage'];


    connectToDatabase();
    try{
      $addMessageQuery =
      "INSERT INTO messages (toUsername, fromUsername, message)
      VALUES ('$toUsername','$fromUsername','$message')";
      $connectionToDatabase->exec($addMessageQuery);

      abortDatabaseConnection();
      header('Location: #inbox');

    }catch(PDOException $e){
      echo "something wrong";

    }

}

 ?>
