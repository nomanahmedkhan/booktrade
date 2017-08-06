<?php

if(isset($_POST['logoutYes'])){
  SESSION_START();
  SESSION_UNSET();
  SESSION_DESTROY();
  goToHomePage();
}elseif(isset($_POST['logoutNo'])){
  goToHomePage();
}

 ?>
