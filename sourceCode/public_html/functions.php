<?php
  function connectToDatabase(){
    try {
      global $connectionToDatabase;
      $connectionToDatabase = new PDO('mysql: host=localhost; dbname=booktrade; charset=utf8', 'root', 'root');
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

  function doesUserNameExists($userName){
    connectToDatabase();
    global $connectionToDatabase;

    $registerQuery = $connectionToDatabase->query("SELECT * FROM `user` WHERE userName = '$userName'");
    $rowCount = $registerQuery -> rowCount();

    abortDatabaseConnection();
    if($rowCount === 1){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  function isUserNameLengthValid($userName){
    $length = strlen($userName);
    if ($length > 3 && $length < 13){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  function isUserNameFirstCharacterValid($userName){
    $firstChar = substr($userName, 0, 1);

    if ($firstChar === " " || ctype_digit($firstChar) === TRUE){
        return FALSE;
      }else{
        return TRUE;
      }
  }

  function doesEmailExists($email){
    connectToDatabase();
    global $connectionToDatabase;

    $registerQuery = $connectionToDatabase->query("SELECT * FROM `user` WHERE userEmail = '$email'");
    $rowCount = $registerQuery -> rowCount();

    abortDatabaseConnection();
    if ($rowCount === 1){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  function doesPasswordMatch($password, $password_confirm){
    if(strcmp($password, $password_confirm) === 0){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  function isPasswordValid($password){
    $smallCheck = preg_match('/[a-z]/', $password);
    $numCheck = preg_match('/[0-9]/', $password);
    $bigCheck = preg_match('/[A-Z]/', $password);
    $sybmbolCheck = preg_match('/[^a-zA-Z\d]/', $password);


    if($numCheck === 1 && $smallCheck === 1 && $bigCheck === 1 && $sybmbolCheck === 1){
     return TRUE;
    }else{
     return FALSE;
    }
  }

  function isPAsswordLengthValid($password){
    $length = strlen($password);
    if($length > 5 && $length < 13){
      return TRUE;
    }else{
      return FALSE;
    }
  }

  function addUserIntoDatabase($userName, $password, $email){
    connectToDatabase();
    global $connectionToDatabase;

    try{
      $addUserQuery = $connectionToDatabase->prepare("INSERT INTO user (userName, userPassword, userEmail) VALUES (:userName,:userPassword,:userEmail)");
      $addUserQuery->bindParam(':userName', $userName);
      $addUserQuery->bindParam(':userPassword', $password);
      $addUserQuery->bindParam(':userEmail', $email);
      $addUserQuery->execute();
      abortDatabaseConnection();
    }catch(PDOException $e){
      echo $e;
      }
  }

  function showLibrary(){
    connectToDatabase();
    try{
      global $connectionToDatabase;
      $libraryQuery = $connectionToDatabase->prepare ("SELECT userName, bookName, bookPrice, tradeCondition, dateTimeAdded FROM bookList");
      $libraryQuery->execute();
      return $library = $libraryQuery->fetchall();
      array_push($library['userName'], NULL, $library['bookName'], NULL, $library['bookPrice'], NULL, $library['tradeCondition'], NULL, $library['dateTimeAdded'], NULL);
      abortDatabaseConnection();
    }catch (PDOException $e) {
      echo "HAHAHAHAHA";
    }
  }

  function sendEmailTo($email){
    $msg = "Welcome to Book.Trade!\n\n Please verify your account by clicking the link below \n http://booktrade.duckdns.org";
    $sendMail = mail($email, "Booktrade Verification", $msg, "From: booktradedotcom@gmail.com");
    return $sendMail;

  }
 ?>
