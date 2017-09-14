<?php
SESSION_START();
if(isset($_POST['delete'])){

$delBookTemp = $_POST['delete'];
$userName = $bookList[$delBookTemp][0];
$bookName = $bookList[$delBookTemp][1];
$bookPrice = $bookList[$delBookTemp][2];
$tradeCondition = $bookList[$delBookTemp][3];

connectToDatabase();

$deleteQuery = "DELETE FROM bookList WHERE userName = '$userName' and bookName = '$bookName' and bookPrice='$bookPrice' and tradeCondition='$tradeCondition'";
$connectionToDatabase -> exec($deleteQuery);
abortDatabaseConnection();
header("Location: #userBooks");
}

 ?>
