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
  $bookTitle = $_POST['bookTitle'];
  connectToDatabase();
  $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition, dateTimeAdded FROM bookList WHERE bookName = '$bookTitle'  ");
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
  $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition, dateTimeAdded FROM bookList WHERE userName = '$bookAuthor'  ");
  $libraryQuery->execute();
  $library = $libraryQuery->fetchall();
  $_SESSION['library'][] = array();
  $_SESSION['library'] = $library;
  abortDatabaseConnection();
  $_SESSION['filterPosted'] = TRUE;
}

//This can be commented out once the iSBN is implemented in database 
/*
if(isset($_POST['searchISBN'])){
  $bookISBN = $_POST['bookISBN'];
  connectToDatabase();
  $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition, dateTimeAdded FROM bookList WHERE bookISBN = '$bookISBN'  ");
  $libraryQuery->execute();
  $library = $libraryQuery->fetchall();
  $_SESSION['library'][] = array();
  $_SESSION['library'] = $library;
  abortDatabaseConnection();
  $_SESSION['filterPosted'] = TRUE;
}
*/
  if(isset($_POST['filterLibraryBuy'])){
    connectToDatabase();
    $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition, dateTimeAdded FROM bookList WHERE bookPrice > 0 ");
    $libraryQuery->execute();
    $library = $libraryQuery->fetchall();
    $_SESSION['library'][] = array();
    $_SESSION['library'] = $library;
    abortDatabaseConnection();
    $_SESSION['filterPosted'] = TRUE;
  }

  if(isset($_POST['filterLibraryTrade'])){
    connectToDatabase();
    $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition, dateTimeAdded FROM bookList WHERE tradeCondition != 'none' ");
    $libraryQuery->execute();
    $library = $libraryQuery->fetchall();
    $_SESSION['library'][] = array();
    $_SESSION['library'] = $library;
    abortDatabaseConnection();
    $_SESSION['filterPosted'] = TRUE;
  }



  if(isset($_POST['filterLibraryAll'])){
    $library = showLibrary();
    $_SESSION['library'][] = array();
    $_SESSION['library'] = $library;
    $_SESSION['filterPosted'] = TRUE;
  }

}catch (PDOException $e) {
  echo "HAHAHAHAHA";
}

?>
