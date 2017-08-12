<?php
  function connectToDatabase(){
    try {
      global $connectionToDatabase;
      $connectionToDatabase = new PDO('mysql: host=localhost; dbname=booktrade', 'root', 'root');
      $connectionToDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $connectionToDatabase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    catch (PDOException $e) {
      echo "Could not connect to database";
    }
  }

  function abortDatabaseConnection (){
    global $connectionToDatabase;
    $connectionToDatabase = NULL;
  }

  function goToHomePage(){
    header('Location: #home');
  }

  function setUserLogin($bool){
    global $userLoggedin;
    $userLoggedin = TRUE;
  }
  /*
  function userNameExistance($temp){
    global $rowCount1;
    connectToDatabase();
    $registerQuery1 = $connectionToDatabase->query("SELECT * FROM `user` WHERE userName = '$temp'");
    $rowCount1 = $registerQuery1 -> rowCount();

  }

  function emailExistance($temp){
    global $rowCount2;
    connectToDatabase();
    $registerQuery2 = $connectionToDatabase->query("SELECT * FROM `user` WHERE userEmail = '$temp'");
    $rowCount2 = $registerQuery2 -> rowCount();
  }*/
 ?>
