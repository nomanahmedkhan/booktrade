<?php
SESSION_START();
$count = 0;

connectToDatabase();

try{
  $temp = $_SESSION["username"];

  if($_SESSION['username'] === "noman"){
    $bookListQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition, bookISBN, bookAuthor FROM bookList");
    $bookListQuery->execute();
    $bookList = $bookListQuery->fetchall();
  }
  else{
    $bookListQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition, bookISBN, bookAuthor FROM bookList WHERE userName= '$temp' ");
    $bookListQuery->execute();
    $bookList = $bookListQuery->fetchall();
  }

  array_push($bookList['userName'], NULL, $bookList['bookName'], NULL, $bookList['bookPrice'], NULL, $bookList['tradeCondition'], NULL, $bookList['bookISBN'], NULL, $bookList['bookAuthor'], NULL);
  abortDatabaseConnection();

  }catch (PDOException $e) {
    echo "HAHAHAHAHA";
  }


  ?>
