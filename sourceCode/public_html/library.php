<?php
$count1 = 0;
connectToDatabase();

try{
  $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition FROM bookList");
  $libraryQuery->execute();
  $library = $libraryQuery->fetchAll();
  abortDatabaseConnection();
}catch (PDOException $e) {
  echo "HAHAHAHAHA";
}

 ?>
