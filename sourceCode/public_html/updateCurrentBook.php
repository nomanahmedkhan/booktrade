<?php
SESSION_START();
if(isset($_POST['updateBook'])){
  echo "yes!";
  $temp2 = $_POST['updateBook'];
  $userNameUpdate = $bookList[$temp2][0];
  $bookNameUpdate = $bookList[$temp2][1];
  $bookPriceUpdate = $bookList[$temp2][2];
  $tradeConditionUpdate = $bookList[$temp2][3];
  $newBookName = $_POST['editedBookName'];
  $newBookPrice = $_POST['editedBookPrice'];
  $newBookTradeCondition = $_POST['editedBookTradeCondition'];

  try{
    if($newBookName !== NULL and $newBookPrice !== NULL and $newBookTradeCondition !== NULL){
      connectToDatabase();

      $updateBookQuery =
      "UPDATE `booktrade`.`bookList`
      SET `bookName`='$newBookName', `bookPrice`='$newBookPrice', `tradeCondition`='$newBookTradeCondition'
      WHERE `userName`='$userNameUpdate'
      AND `bookName`='$bookNameUpdate'
      AND `bookPrice`='$bookPriceUpdate'
      AND `tradeCondition`='$tradeConditionUpdate'";

      $connectionToDatabase -> exec($updateBookQuery);
      abortDatabaseConnection();
    }

    }catch (PDOException $e) {
      echo "HAHAHAHAHA";
    }
    header("Location: #userBooks");
  }
  ?>
