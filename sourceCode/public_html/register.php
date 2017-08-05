<?php
if( isset($_POST['usernamesignup'])
and isset($_POST['passwordsignup'])
and isset($_POAT['emailsignup'])
and !is_null($_POST['usernamesignup'])
and !is_null($_POST['passwordsignup'])
and !is_null($_POST['emailsignup'])) {

  $usernamesignup = $_POST['usernamesignup'];
  $passwordsignup = $_POST['passwordsignup'];
  $emailsignup = $_POST['emailsignup'];

  connectToDatabase();

  $registerQuery = $connectionToDatabase->query("SELECT * FROM `user` WHERE userName = '$usernamesignup'");
  $rowCount1 = $registerQuery -> rowCount();
  if($rowCount1 === 1){
    echo "Username already exists.";
  }

  $registerQuery = $connectionToDatabase->query("SELECT * FROM `user` WHERE userEmail = '$emailsignup'");
  $rowCount2 = $registerQuery -> rowCount();
  if($rowCount2 === 1){
    echo "Email already exists.";
  }
}
?>
