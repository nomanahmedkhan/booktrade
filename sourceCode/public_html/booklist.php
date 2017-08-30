<?php
SESSION_START();
$count = 0;

connectToDatabase();

try{
  $temp = $_SESSION["username"];
  $bookListQuery = $connectionToDatabase->prepare ("SELECT bookName, bookPrice, tradeCondition FROM bookList WHERE userName= '$temp' ");
  $bookListQuery->execute();
  $bookList = $bookListQuery->fetchall();
  array_push($bookList['bookName'], NULL, $bookList['bookPrice'], NULL, $bookList['bookTradeCondition'], NULL);
  abortDatabaseConnection();
}catch (PDOException $e) {
  echo "HAHAHAHAHA";
}


?>
