<?php
$_SESSION['cartPriceCount'];
$cartCount = 0;
$_SESSION['oldCartTemp'];

if(isset($_POST['buyBook'])){
  if($_SESSION['oldCartTemp'] !== $_POST['buyBook']){
    $cartTemp = $_POST['buyBook'];
    $_SESSION['cartPriceCount'] = $_SESSION['cartPriceCount'] + $library[$cartTemp][2];

    unset($_SESSION['cartArray'][count($_SESSION['cartArray'])-1]);
    $_SESSION['cartArray'][] = array('cartBookName'=>$library[$cartTemp][1], 'cartBookPrice'=> $library[$cartTemp][2]);
    $_SESSION['cartArray'][] = array('cartBookName'=> NULL, 'cartBookPrice'=> NULL);

    $_SESSION['oldCartTemp'] = $_POST['buyBook'];
    $isBookAlreadyInCart = FALSE;
    header('Location: #shoppingCart');
  }else{
    $isBookAlreadyInCart = TRUE;
  }
}

if(isset($_POST['resetCart'])){
  $_SESSION['cartPriceCount'] = 0;
  $_SESSION['cartArray'] = NULL;
}

if(isset($_POST['removeCartBook'])){
  $cartTemp = $_POST['removeCartBook'];
  $_SESSION['cartPriceCount'] = $_SESSION['cartPriceCount'] - $_SESSION['cartArray'][$cartTemp]['cartBookPrice'];
  unset($_SESSION['cartArray'][$cartTemp]);


}

?>
