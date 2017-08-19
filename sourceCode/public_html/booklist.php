<?php
SESSION_START();
$count = 0;

connectToDatabase();

try{
  $temp = $_SESSION["username"];
  $bookListQuery = $connectionToDatabase->prepare ("SELECT bookName, bookPrice, tradeCondition FROM bookList WHERE userName= '$temp' ");
  $bookListQuery->execute();
  $bookList = $bookListQuery->fetchall();
  abortDatabaseConnection();
}catch (PDOException $e) {
  echo "HAHAHAHAHA";
}


?>
