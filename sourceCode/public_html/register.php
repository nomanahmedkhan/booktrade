<?php
if( isset($_POST['usernamesignup'])
and isset($_POST['passwordsignup'])
and isset($_POST['passwordsignup_confirm'])
and isset($_POST['emailsignup'])
and !is_null($_POST['usernamesignup'])
and !is_null($_POST['passwordsignup'])
and !is_null($_POST['passwordsignup_confirm'])
and !is_null($_POST['emailsignup'])) {

  $usernamesignup = $_POST['usernamesignup'];
  $emailsignup = $_POST['emailsignup'];
  $passwordsignup = $_POST['passwordsignup'];
  $passwordsignup_confirm = $_POST['passwordsignup_confirm'];

  connectToDatabase();

  $registerQuery1 = $connectionToDatabase->query("SELECT * FROM `user` WHERE userName = '$usernamesignup'");
  $rowCount1 = $registerQuery1 -> rowCount();
  if ($rowCount1 === 1){
    $userNameExists = TRUE;
  }else{
    $userNameExists = FALSE;
  }

  $registerQuery2 = $connectionToDatabase->query("SELECT * FROM `user` WHERE userEmail = '$emailsignup'");
  $rowCount2 = $registerQuery2 -> rowCount();
  if ($rowCount2 === 1){
    $emailExists = TRUE;
  }else{
    $emailExists = FALSE;
  }

  if(strcmp($passwordsignup, $passwordsignup_confirm) === 0){
    $passwordMatched = TRUE;
  }else{
    $passwordMatched = FALSE;
  }

  if($userNameExists === FALSE and $emailExists === FALSE and $passwordMatched === TRUE){
  $registrationSuccessful = TRUE;
  }

  try{
    $addUserQuery = "INSERT INTO user (userName, userPassword, userEmail) VALUES ('$usernamesignup','$passwordsignup','$emailsignup')";
    $connectionToDatabase->exec($addUserQuery);
    abortDatabaseConnection();
    header('Location: #loginContent');
  }catch(PDOException $e){
    echo "something wrong";

  }

}else{
  $emptyRegisterFields = TRUE;
}
?>
