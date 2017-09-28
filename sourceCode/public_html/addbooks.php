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

  if($_POST['newBookPrice'] === ''){
    $addBookPrice = 0;
  }else{
    $addBookPrice = $_POST['newBookPrice'];
    }

  if($_POST['bookTradeCondition'] === ''){
    $addBookTradeCondition = "none";
  }else{
    $addBookTradeCondition = $_POST['bookTradeCondition'];
  }

  $addBookUserName = $_SESSION["username"];

  if(isset($_POST['uploadNewBookImage'])){
    $uploadErrors = array();
    $file_name = $_FILES['newBookImage']['name'];
    $file_size =$_FILES['newBookImage']['size'];
    $file_tmp =$_FILES['newBookImage']['tmp_name'];
    $file_type=$_FILES['newBookImage']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

    $expensions= array("jpeg","jpg","png");

    if(in_array($file_ext,$expensions)=== false){
      $uploadErrors[]="File not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152){
      $errors[]='File size limit is 2 MB';
    }

    if(empty($errors) === TRUE AND !file_exists("book_images/".$file_name)){
      move_uploaded_file($file_tmp,"book_images/".$file_name);
      $newBookImageUploaded=TRUE;
    }else{
      $newBookImageUploaded=FALSE;
      print_r($errors);
    }
  }

  if($newBookImageUploaded === TRUE){
  try{
    $addBookQuery = $connectionToDatabase->prepare("INSERT INTO bookList (userName, bookName, bookPrice, tradeCondition) VALUES (:userName, :bookName, :bookPrice, :tradeCondition)");
    $addBookQuery->bindParam(':userName', $addBookUserName);
    $addBookQuery->bindParam(':bookName', $addBookName);
    $addBookQuery->bindParam(':bookPrice', $addBookPrice);
    $addBookQuery->bindParam(':tradeCondition', $addBookTradeCondition);
    $addBookQuery->execute();
    abortDatabaseConnection();

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
}
?>
