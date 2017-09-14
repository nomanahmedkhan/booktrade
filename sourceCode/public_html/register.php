<?php
if( isset($_POST['register'])) {

  if(!empty($_POST['usernamesignup'])
  and !empty($_POST['passwordsignup'])
  and !empty($_POST['passwordsignup_confirm'])
  and !empty($_POST['emailsignup'])){

    $usernamesignup = stripslashes($_POST['usernamesignup']);
    $emailsignup = stripslashes($_POST['emailsignup']);
    $passwordsignup = stripslashes($_POST['passwordsignup']);
    $passwordsignup_confirm = stripslashes($_POST['passwordsignup_confirm']);


    $userNameExists = doesUserNameExists($usernamesignup);
    $emailExists = doesEmailExists($emailsignup);
    $passwordMatched = doesPasswordMatch($passwordsignup, $passwordsignup_confirm);
    $userNameLengthValid =  isUserNameLengthValid($usernamesignup);
    $userFirstCharValid = isUserNameFirstCharacterValid($usernamesignup);
    $passwordValid = isPasswordValid($passwordsignup);
    $passwordLengthValid = isPAsswordLengthValid($passwordsignup);

    if($userNameExists === FALSE
    and $emailExists === FALSE
    and $passwordMatched === TRUE
    and $userNameLengthValid === TRUE
    and $userFirstCharValid === TRUE
    and $passwordValid === TRUE
    and $passwordLengthValid === TRUE){

        $isMailDone = sendEmailTo($emailsignup);

        if($isMailDone === TRUE){
          addUserIntoDatabase($usernamesignup, $passwordsignup, $emailsignup);
        }
    }
  }else{
    $emptyRegisterFields = TRUE;
  }
}
?>
