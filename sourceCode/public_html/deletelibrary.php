<?php

if(isset($_POST['adminDeleteBook'])){

  echo $temp1 = $_POST['adminDeleteBook'];
echo $username = $library[$temp1][0];
echo $bookname = $library[$temp1][1];

  connectToDatabase();

  $deleteLibraryQuery = "DELETE FROM bookList WHERE userName = '$username' and bookName = '$bookname' ";
  $connectionToDatabase -> exec($deleteLibraryQuery);



  abortDatabaseConnection();
  header("Refresh:0; url=index.php#libraryContent");
}

 ?>
