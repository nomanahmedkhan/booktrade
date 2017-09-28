<?php

$connectionToDatabase = NULL;
$emptyRegisterFields = NULL;



//Login Variables
$loginFailed = False;

//Register Error Variables
$userNameExists = NULL;
$emailExists = NULL;
$passwordMatched = NULL;
$userNameLengthValid = NULL;
$userFirstCharValid = NULL;
$registrationSuccessful = NULL;
$passwordValid = NULL;
$passwordLengthValid = NULL;
$isMailSent = NULL;
$isMailDone = NULL;
$userNameInvalid = NULL;

//library Variables
$bothBookType;
$userMustLogIn = NULL;

//Edit userPage variables
$oldBookName = array();
$oldBookPrice = array();
$oldBookTradeCondition = array();


//cart
$isBookAlreadyInCart = FALSE;

//lastAddedBooks
$lastAddedBookCount = 0;
$recommendedBookCount = 0;
$lastAddedBookCount2 = 0;
 ?>
