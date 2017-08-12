<?php
if( isset($_POST['usernamesignup'])
and isset($_POST['passwordsignup'])
and isset($_POST['passwordsignup_confirm'])
and isset($_POST['emailsignup'])) {

  if(!empty($_POST['usernamesignup'])
  and !empty($_POST['passwordsignup'])
  and !empty($_POST['passwordsignup_confirm'])
  and !empty($_POST['emailsignup'])){

    $usernamesignup = $_POST['usernamesignup'];
    $emailsignup = $_POST['emailsignup'];
    $passwordsignup = $_POST['passwordsignup'];
    $passwordsignup_confirm = $_POST['passwordsignup_confirm'];


    $userNameExists = doesUserNameExists($usernamesignup);
    $emailExists = doesEmailExists($emailsignup);
    $passwordMatched = doesPasswordMatch($passwordsignup, $passwordsignup_confirm);
    $userNameLengthValid =  isUserNameLengthValid($usernamesignup);
    $userFirstCharValid = isUserNameFirstCharacterValid($usernamesignup);
    $passwordValid = isPasswordValid($passwordsignup);
    if($userNameExists === FALSE
    and $emailExists === FALSE
    and $passwordMatched === TRUE
    and $userNameLengthValid === TRUE
    and $userFirstCharValid === TRUE
    and $passwordValid === TRUE){

      //addUserIntoDatabase($usernamesignup, $passwordsignup, $emailsignup);

    }
  }else{
    $emptyRegisterFields = TRUE;
  }
}
?>
