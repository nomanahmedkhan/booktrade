<?php
SESSION_START();
if(isset($_POST['updateBook'])){
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
