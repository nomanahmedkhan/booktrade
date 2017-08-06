<?php
SESSION_START();
if(isset($_POST['delete'])){

$temp1 = $_POST['delete'];
$userName = $_SESSION["username"];
$bookName = $bookList[$temp1][0];
$bookPrice = $bookList[$temp1][1];
$tradeCondition = $bookList[$temp1][2];

connectToDatabase();

$deleteQuery = "DELETE FROM bookList WHERE userName = '$userName' and bookName = '$bookName' and bookPrice='$bookPrice' and tradeCondition='$tradeCondition'";
$connectionToDatabase -> exec($deleteQuery);
abortDatabaseConnection();
header("Refresh:0; url=index.php#bookList");
}

 ?>
