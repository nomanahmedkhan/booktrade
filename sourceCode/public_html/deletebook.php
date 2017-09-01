<?php
SESSION_START();
if(isset($_POST['delete'])){

$temp1 = $_POST['delete'];
$userName = $_SESSION["username"];
$bookName = $bookList[$temp1][1];
$bookPrice = $bookList[$temp1][2];
$tradeCondition = $bookList[$temp1][3];

connectToDatabase();

$deleteQuery = "DELETE FROM bookList WHERE userName = '$userName' and bookName = '$bookName' and bookPrice='$bookPrice' and tradeCondition='$tradeCondition'";
$connectionToDatabase -> exec($deleteQuery);
abortDatabaseConnection();
header("Location: #userBooks");
}

 ?>
