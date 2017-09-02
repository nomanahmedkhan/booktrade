<?php
$_SESSION['cartPriceCount'];
$cartCount = 0;
$oldCartTemp;

if(isset($_POST['buyBook'])){
  $cartTemp = $_POST['buyBook'];
  $_SESSION['cartPriceCount'] = $_SESSION['cartPriceCount'] + $library[$cartTemp][2];

  if($_SESSION['cartArray'][count($_SESSION['cartArray'])-1]['cartBookPrice'] === "none"
  OR $_SESSION['cartArray'][count($_SESSION['cartArray'])-1]['cartBookName'] === "none"){
    unset($_SESSION['cartArray'][count($_SESSION['cartArray'])-1]);

  }
  if($_SESSION['cartArray'][count($_SESSION['cartArray'])]['cartBookPrice'] === "none"
  OR $_SESSION['cartArray'][count($_SESSION['cartArray'])]['cartBookName'] === "none"){
    unset($_SESSION['cartArray'][count($_SESSION['cartArray'])-1]);
  }
      $_SESSION['cartArray'][] = array('cartBookName'=>$library[$cartTemp][1], 'cartBookPrice'=> $library[$cartTemp][2]);
      $_SESSION['cartArray'][] = array('cartBookName'=> "none", 'cartBookPrice'=> "none");

      $count = count($_SESSION['cartArray'])-1;
  echo $count;
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
