<?php
if(isset($_POST['goToBookButton'])){

  $_SESSION['clickedBook'] = $_POST['goToBookButton'];
  goToBookPage();
}
?>
