<?php

if( isset($_POST['username'])
and isset($_POST['password'])
and !is_null($_POST['username'])
and !is_null($_POST['password'])) {

  try {
    $connectionToDatabase = new PDO('mysql: host=localhost; dbname=booktrade',
    'root',
    'Godonly1',
    array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) );
  }
  catch (PDOException $e) {
    echo 'Could not connect to database';
  }

}

?>
