<?php

SESSION_START();
$_SESSION['cartPriceCount'];
$cartCount = 0;

if(isset($_POST['buyBook'])){
  $cartTemp = $_POST['buyBook'];
  $_SESSION['cartPriceCount'] = $_SESSION['cartPriceCount'] + $library[$cartTemp][2];
  $_SESSION['cartArray'][] = array('cartBookName'=>$library[$cartTemp][1], 'cartBookPrice'=> $library[$cartTemp][2]);

}elseif(isset($_POST['resetCart'])){
  $_SESSION['cartPriceCount'] = 0;
  $_SESSION['cartArray'] = NULL;
}elseif(isset($_POST['removeCartBook'])){

}

?>
