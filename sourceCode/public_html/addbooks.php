<?php
SESSION_START();

if(isset($_POST['addBook'])){

  $addBookTime = date(dmYhms);

  connectToDatabase();
  if($_POST['newBookName'] === ''){
    $addBookName = "none";
  }else{
    $addBookName = stripslashes($_POST['newBookName']);
  }

  if($_POST['bookDescription'] === ''){
    $addBookName = "none";
  }else{
    $bookDescription = stripslashes($_POST['bookDescription']);
  }

  /*
  if($_POST['newBookPrice'] === ''){
    $addBookPrice = 0;
  }else{
    $addBookPrice = $_POST['newBookPrice'];
    }
    */

  if($_POST['bookTradeCondition'] === ''){
    $addBookTradeCondition = "none";
  }else{
    $addBookTradeCondition = $_POST['bookTradeCondition'];
  }
  if($_POST['bookISBN'] === ''){
    $addBookAuthor = "none";
  }else{
    $addBookISBN = $_POST['bookISBN'];
  }
  if($_POST['bookAuthor'] === ''){
    $addBookAuthor = "none";
  }else{
    $addBookAuthor = $_POST['bookAuthor'];
  }
  $addBookUserName = $_SESSION["username"];

    $errors = array();
    $file_name = $_FILES['newBookImage']['name'];
    $file_size =$_FILES['newBookImage']['size'];
    $file_tmp =$_FILES['newBookImage']['tmp_name'];
    $file_type=$_FILES['newBookImage']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['newBookImage']['name'])));

    $expensions= array("jpeg","jpg","png", "JPEG", "JPG", "PNG");

    if(in_array($file_ext,$expensions)=== false){
      $uploadErrors[]="filetype";
    }

    if($file_size > 2097152){
      $errors[]='filesize';
    }

    while(file_exists("book_images/".$file_name)){
      $file_name = rand(1,100).$file_name;
    }



  try{
    connectToDatabase();
    $addBookQuery = $connectionToDatabase->prepare("INSERT INTO bookList (userName, bookName, tradeCondition, bookISBN, bookAuthor, bookImageID, bookDescription, bookCondition) VALUES (:userName, :bookName, :tradeCondition, :bookISBN, :bookAuthor, :bookImageID, :bookDescription, :bookCondition)");
    $addBookQuery->bindParam(':userName', $addBookUserName);
    $addBookQuery->bindParam(':bookName', $addBookName);
    $addBookQuery->bindParam(':tradeCondition', $addBookTradeCondition);
    $addBookQuery->bindParam(':bookISBN', $addBookISBN);
    $addBookQuery->bindParam(':bookAuthor', $addBookAuthor);
    $addBookQuery->bindParam(':bookImageID', $file_name);
    $addBookQuery->bindParam(':bookDescription', $bookDescription);
    $addBookQuery->bindParam(':bookCondition', $_POST['bookCondition']);
    $addBookQuery->execute();
    abortDatabaseConnection();

    if(empty($errors) === TRUE){
      move_uploaded_file($file_tmp,"book_images/".$file_name);
      $newBookImageUploaded=TRUE;
    }else{
      $newBookImageUploaded=FALSE;
      print_r($errors);
    }
    
    connectToDatabase();
    $addBookTimeQuery = "UPDATE `booktrade`.`bookList`  SET `dateTimeAdded`=?  WHERE `userName`=? AND `bookName` =?";
    $stmt = $connectionToDatabase->prepare($addBookTimeQuery);
    $stmt->bindParam(1, $addBookTime);
    $stmt->bindParam(2, $addBookUserName);
    $stmt->bindParam(3, $addBookName);
    $stmt->execute();
    abortDatabaseConnection();

    header('Location: #userBooks');
  }catch(PDOException $e){
    echo $e;
  }

}
?>
