<?php
SESSION_START();

if(isset($_POST['newBookName'])
  and isset($_POST['newBookPrice'])){

  $bookName = $_POST['newBookName'];
  $bookPrice = $_POST['newBookPrice'];
  $tradeCondition = $_POST['bookTradeCondition'];
  $userName = $_SESSION["username"];

  connectToDatabase();
  try{
    $addBookQuery = "INSERT INTO bookList (userName, bookName, bookPrice, tradeCondition) VALUES ('$userName','$bookName','$bookPrice','$tradeCondition')";
    $connectionToDatabase->exec($addBookQuery);
    abortDatabaseConnection();
    header('Location: #bookList');
  }catch(PDOException $e){
    echo "something wrong";

  }
}

 ?>
