<?php

$count1 = 0;
$count3 = 0;

if(isset($_POST['filterLibrary'])){

  if($_POST['filterLibrary'] === 'buy'){
    connectToDatabase();
    try{
      $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition FROM bookList WHERE bookPrice > 0 ");
      $libraryQuery->execute();
      $library = $libraryQuery->fetchall();
      abortDatabaseConnection();
    }catch (PDOException $e) {
      echo "HAHAHAHAHA";
    }

  }elseif($_POST['filterLibrary'] === 'trade'){
    connectToDatabase();
    try{
      $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition FROM bookList WHERE tradeCondition != 'none' ");
      $libraryQuery->execute();
      $library = $libraryQuery->fetchall();
      abortDatabaseConnection();
    }catch (PDOException $e) {
      echo "HAHAHAHAHA";
    }
  }elseif($_POST['filterLibrary'] === 'all'){
    $library = showLibrary();
  }
}else{
  $library = showLibrary();
}




 ?>
