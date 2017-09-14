<?php
SESSION_START();

if(isset($_POST['addBook'])){

  $addBookTime = date(dmYhms);

  connectToDatabase();
  if($_POST['newBookName'] === ''){
    $addBookName = "none";
  }else{
    $addBookName = stripslashes($_POST['newBookName']);
  }

  if($_POST['newBookPrice'] === ''){
    $addBookPrice = 0;
  }else{
    $addBookPrice = $_POST['newBookPrice'];
    }

  if($_POST['bookTradeCondition'] === ''){
    $addBookTradeCondition = "none";
  }else{
    $addBookTradeCondition = $_POST['bookTradeCondition'];
  }

  $addBookUserName = $_SESSION["username"];

  try{
    $addBookQuery = $connectionToDatabase->prepare("INSERT INTO bookList (userName, bookName, bookPrice, tradeCondition) VALUES (:userName, :bookName, :bookPrice, :tradeCondition)");
    $addBookQuery->bindParam(':userName', $addBookUserName);
    $addBookQuery->bindParam(':bookName', $addBookName);
    $addBookQuery->bindParam(':bookPrice', $addBookPrice);
    $addBookQuery->bindParam(':tradeCondition', $addBookTradeCondition);
    $addBookQuery->execute();
    abortDatabaseConnection();

    connectToDatabase();
    $addBookTimeQuery = "UPDATE `booktrade`.`bookList`  SET `dateTimeAdded`=?  WHERE `userName`=? AND `bookName` =?";
    $stmt = $connectionToDatabase->prepare($addBookTimeQuery);
    $stmt->bindParam(1, $addBookTime);
    $stmt->bindParam(2, $addBookUserName);
    $stmt->bindParam(3, $addBookName);
    $stmt->execute();
    abortDatabaseConnection();

    header('Location: #userBooks');
  }catch(PDOException $e){
    echo $e;
  }
}
?>
