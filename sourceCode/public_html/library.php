<?php
SESSION_START();
$count1 = 0;
$count3 = 0;
$filterPosted;
try{
  if($_SESSION['filterPosted'] !== TRUE){
  $library = showLibrary();
  array_push($library['userName'], NULL, $library['bookName'], NULL, $library['bookPrice'], NULL, $library['tradeCondition'], NULL, $library['dateTimeAdded'], NULL);
}else{
  $library = $_SESSION['library'];
}

  if(isset($_POST['filterLibraryBuy'])){
    connectToDatabase();
    $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition, dateTimeAdded FROM bookList WHERE bookPrice > 0 ");
    $libraryQuery->execute();
    $library = $libraryQuery->fetchall();
    array_push($library['userName'], NULL, $library['bookName'], NULL, $library['bookPrice'], NULL, $library['tradeCondition'], NULL, $library['dateTimeAdded'], NULL);
    abortDatabaseConnection();
    $_SESSION['library'][][] = array();
    $_SESSION['library'] = $library;
    $_SESSION['filterPosted'] = TRUE;
  }

  if(isset($_POST['filterLibraryTrade'])){
    connectToDatabase();
    $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition, dateTimeAdded FROM bookList WHERE tradeCondition != 'none' ");
    $libraryQuery->execute();
    $library = $libraryQuery->fetchall();
    array_push($library['userName'], NULL, $library['bookName'], NULL, $library['bookPrice'], NULL, $library['tradeCondition'], NULL, $library['dateTimeAdded'], NULL);
    abortDatabaseConnection();
    $_SESSION['library'][][] = array();
    $_SESSION['library'] = $library;
    $_SESSION['filterPosted'] = TRUE;
  }

  if(isset($_POST['filterLibraryAll'])){
    $library = showLibrary();
    array_push($library['userName'], NULL, $library['bookName'], NULL, $library['bookPrice'], NULL, $library['tradeCondition'], NULL, $library['dateTimeAdded'], NULL);
    $_SESSION['library'][][] = array();
    $_SESSION['library'] = $library;
    $_SESSION['filterPosted'] = TRUE;
  }

}catch (PDOException $e) {
  echo "HAHAHAHAHA";
}

?>
