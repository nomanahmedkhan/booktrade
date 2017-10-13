<?php /*
$_SESSION['cartPriceCount'];
$cartCount = 0;
$_SESSION['oldCartTemp'];
//$_SESSION['cartArray'][] = array_push(array(array('cartBookName' => NULL, 'cartBookPrice' => NULL )));

if(isset($_POST['buyBook'])){
  if($_SESSION['oldCartTemp'] !== $_POST['buyBook']){
    $_SESSION['oldCartTemp'] = $_POST['buyBook'];
    $cartTemp = $_POST['buyBook'];
    $_SESSION['cartPriceCount'] = $_SESSION['cartPriceCount'] + $library[$cartTemp][2];

    echo $keys = array_keys($_SESSION['cartArray']);
    echo $lastKey = $keys[count($keys)-1];
    if($_SESSION['cartArray'][$lastKey]['cartBookName'] === NULL OR $_SESSION['cartArray'][$lastKey]['cartBookPrice'] === NULL ){
      unset($_SESSION['cartArray'][array_count($_SESSION['cartArray'])-1]);
    }

    $_SESSION['cartArray'][] = array('cartBookName'=>$library[$cartTemp][1], 'cartBookPrice'=> $library[$cartTemp][2]);

    $_SESSION['oldCartTemp'] = $_POST['buyBook'];
    $isBookAlreadyInCart = FALSE;
    //header('Location: #shoppingCart');
  }else{
    $isBookAlreadyInCart = TRUE;
  }
}

if(isset($_POST['resetCart'])){
  $cartTemp = 0;
  $_SESSION['oldCartTemp'] = 0;
  $_SESSION['cartPriceCount'] = 0;
  unset($_SESSION['cartArray']);
}

if(isset($_POST['removeCartBook'])){
  $_POST['removeCartBook'];
  unset($_SESSION['cartArray'][$_POST['removeCartBook']]);
  $_SESSION['cartPriceCount'] = $_SESSION['cartPriceCount'] - $_SESSION['cartArray'][$_POST['removeCartBook']]['cartBookPrice'];

}
*/
?>
