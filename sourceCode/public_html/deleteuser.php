<?php

if(isset($_POST['deleteUser'])){

  $temp1 = $_POST['deleteUser'];
  $username = $users[$temp1][0];

  connectToDatabase();

  $deleteUserQuery = "DELETE FROM bookList WHERE userName = '$username'";
  $connectionToDatabase -> exec($deleteUserQuery);

  $deleteUserQuery2 = "DELETE FROM user WHERE userName = '$username'";
  $connectionToDatabase -> exec($deleteUserQuery2);

  abortDatabaseConnection();
  header("Location: #adminPage");
}

 ?>
