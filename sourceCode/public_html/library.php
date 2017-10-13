<?php
SESSION_START();
$count1 = 0;
$count3 = 0;
$filterPosted;

try{
  if($_SESSION['filterPosted'] !== TRUE){
  $library = showLibrary();
}else{
  $library = $_SESSION['library'];
}

if(isset($_POST['searchTitle'])){
  connectToDatabase();
  $bookTitle = stripslashes($_POST['bookTitle']);
  $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, tradeCondition, bookISBN, bookAuthor, bookImageID, dateTimeAdded, bookDescription, bookImageID FROM bookList WHERE bookName = :bookTitle  ");
  $libraryQuery->bindParam(':bookTitle', $bookTitle);

  $libraryQuery->execute();
  $library = $libraryQuery->fetchall();
  $_SESSION['library'][] = array();
  $_SESSION['library'] = $library;
  abortDatabaseConnection();
  $_SESSION['filterPosted'] = TRUE;
}

//using username for now instead of Author to test
if(isset($_POST['searchAuthor'])){
  $bookAuthor = $_POST['bookAuthor'];
  connectToDatabase();
  $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, tradeCondition, bookISBN, bookAuthor, bookImageID, dateTimeAdded, bookDescription, bookImageID FROM bookList WHERE bookAuthor = '$bookAuthor'  ");
  $libraryQuery->execute();
  $library = $libraryQuery->fetchall();
  $_SESSION['library'][] = array();
  $_SESSION['library'] = $library;
  abortDatabaseConnection();
  $_SESSION['filterPosted'] = TRUE;
}


if(isset($_POST['searchISBN'])){
  $bookISBN = $_POST['bookISBN'];
  connectToDatabase();
  $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, tradeCondition, bookISBN, bookAuthor, bookImageID, dateTimeAdded, bookDescription, bookImageID FROM bookList WHERE bookISBN = '$bookISBN'  ");
  $libraryQuery->execute();
  $library = $libraryQuery->fetchall();
  $_SESSION['library'][] = array();
  $_SESSION['library'] = $library;
  abortDatabaseConnection();
  $_SESSION['filterPosted'] = TRUE;
}

}catch (PDOException $e) {
  echo "HAHAHAHAHA";
}

?>
