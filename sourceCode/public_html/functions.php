<?php

function connectToDatabase(){
  try {
    global $connectionToDatabase;
    $connectionToDatabase = new PDO('mysql: host=localhost; dbname=booktrade', 'root', 'Godonly1');
    $connectionToDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connectionToDatabase->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }
  catch (PDOException $e) {
    echo "Could not connect to database";
  }
}

 ?>
