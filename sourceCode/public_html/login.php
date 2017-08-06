<?php
if( isset($_POST['username'])
and isset($_POST['password'])
and !is_null($_POST['username'])
and !is_null($_POST['password'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  connectToDatabase();

  $loginQuery = $connectionToDatabase->query("SELECT * FROM `user` WHERE userName = '$username' and userPassword = '$password'");
  $rowCount = $loginQuery -> rowCount();

  if($rowCount === 1){
    SESSION_START();
    $_SESSION["username"] = $username;
    abortDatabaseConnection();
    goToHomePage();
  }else{
    $loginFailed = TRUE;
  }

}
?>
