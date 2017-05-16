<?php

if(isset($_POST['logoutYes'])){
  session_unset();
  session_destroy();
  header('location: index.php');

}
elseif(isset($_POST['logoutNo'])){
  header('location:index.php#home');
}

 ?>
