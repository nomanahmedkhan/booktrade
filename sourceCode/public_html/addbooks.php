<?php
SESSION_START();

if(isset($_POST['newBookName'])
  and isset($_POST['newBookPrice'])){

  $bookName = $_POST['newBookName'];

  if($_POST['newBookPrice'] === ''){
    $bookPrice = 0;
  }else{
    $bookPrice = $_POST['newBookPrice'];
  }

  if($_POST['bookTradeCondition'] === ''){
    $tradeCondition = "none";
  }else{
    $tradeCondition = $_POST['bookTradeCondition'];
  }
  $userName = $_SESSION["username"];

  connectToDatabase();
  try{
    $addBookQuery = "INSERT INTO bookList (userName, bookName, bookPrice, tradeCondition) VALUES ('$userName','$bookName','$bookPrice','$tradeCondition')";
    $connectionToDatabase->exec($addBookQuery);
    abortDatabaseConnection();
    header('Location: #userBooks');
  }catch(PDOException $e){
    echo "something wrong";

  }
}

 ?>
