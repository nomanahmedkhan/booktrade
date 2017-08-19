<?php

if(isset($_POST['deleteUser'])){

  $temp1 = $_POST['deleteUser'];
  $username = $users[$temp1][0];

  connectToDatabase();

  $deleteUserQuery = "DELETE FROM user WHERE userName = '$username'";
  $connectionToDatabase -> exec($deleteUserQuery);
  abortDatabaseConnection();
  header("Refresh:0; url=index.php#UsersAdmin");
}

 ?>
