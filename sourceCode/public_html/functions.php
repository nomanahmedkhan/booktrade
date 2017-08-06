<?php

function connectToDatabase(){
  try {
    global $connectionToDatabase;
    $connectionToDatabase = new PDO('mysql: host=acp@booktrade.duckdns.org:32; dbname=booktrade', 'root', 'Godonly1');
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

 ?>
