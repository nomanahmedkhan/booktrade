<?php
include_once 'globalVars.php';
include_once 'functions.php';
include_once 'login.php';
include_once 'register.php';
include_once 'logout.php';
include_once 'booklist.php';
include_once 'addbooks.php';
include_once 'deletebook.php';
include_once 'library.php';
include_once 'adminusers.php';
include_once 'deleteuser.php';
include_once 'deletelibrary.php';
include_once 'sendproposal.php';
include_once 'retrieveproposal.php';
include_once 'deleteMessage.php';
include_once 'nomanIndex.php';
include_once 'updateCurrentBook.php';
include_once 'home.php';
include 'bookPage.php';

/*Out of Scope - To be Added in future IF, THERE IS A BIG BIG BIG IF the website is succefull*/
/* include_once 'shoppingCart.php'; */

SESSION_START();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name = "viewport" content = "user-scalable = yes, width = device-width, maximum-scale = 2" />
  <meta name = "apple-mobile-web-app-capable" content = "yes" />
  <meta name = "description" content = "Book trading platform for students, book-lovers and bookworms. Trading books are in physical form, not an E-Book.">
  <meta name = "keywords" content = "Book, trade, book trade, Physical Books, Buy Books, Sell Books, Trade Books">
  <link rel="stylesheet" media="screen and (min-width: 700px)" href="data/css/style.css" />
  <link rel="stylesheet" media="screen and (max-width: 700px)" href="data/css/style1.css" />
  <title>Book.trade</title>
</head>

<body <?php if($visited === FALSE):?> onload=' location.href="#home" '<?php endif; ?>>
  <?php $_SESSION['visited'] = TRUE; ?>
  <!--Fixed Top Bar-->
  <div id="topBarTitle" class="topBarTitle">
    <a id="title" active="active" href="test.php">Book.trade</a>
  </div>

  <div id="topBarMenu" class="topBarMenu">
    <ul>
      <li><p><a href="#home">HOME</a></p></li>
      <li><p><a href="#libraryContent" >LIBRARY</a></p></li>
      <?php if(isset($_SESSION["userLoggedin"])):?>


        <li><p><a>BOOKS</a></p>

          <ul>
            <li><p><a href="#userBooks">BOOK LIST</a></p></li>
            <li><p><a href="#newBooks">NEW BOOKS</a></p></li>
          </ul>

        </li>
        <li><p><a>USER</a></p>

          <ul>
            <li><p><a href="#logoutContent">LOG OUT</a></p></li>
            <?php if(isset($_SESSION["username"])):?>
              <?php if($_SESSION["username"] === "noman"):?>
                <li><p><a href ="#adminPage">ADMIN TOOL</a></p></li>
              <?php endif; ?>
            <?php endif; ?>
          </ul>

        </li>
        <li><p><a href="#inbox">INBOX</a></p></li>
        <!-- <li><p><a href="#shoppingCart">CART</a></p></li> -->
      <?php else:?>
        <li><p><a>ACCOUNT</a></p>

          <ul>
            <li><p><a href="#registerContent">REGISTER</a></p></li>
            <li><p><a href="#loginContent">LOGIN</a></p></li>
          </ul>

        </li>
        <!-- <li><p><a href="#shoppingCart">CART</a></p></li> -->
      <?php endif;?>
    </ul>
  </div>

  <!--Scrollable Page-->
  <div id="content" class="content">


    <!--Admin's control page-->
    <div id="adminPage" class="adminPage">
      <form method = "post" >
        <table>
          <thead>
          </thead>
          <tbody>
            <?php if(isset($_SESSION['username'])):?>
              <?php if($_SESSION['username'] === "noman"):?>
                <?php foreach ($users as $user){ ?>
                  <tr>
                    <td ><?php echo $user['userName'];?></td>
                    <td ><button type="submit" name="deleteUser" id="deleteUser" value='<?php echo htmlspecialchars($count2)?>'>Delete!</button></td>
                  </tr>
                  <?php $count2 = $count2 + 1; }?>
                <?php endif;?>
              <?php endif;?>
            </tbody>
          </table>
        </form>
      </div>




      <!--Library Content-->
      <div id="libraryContent" class="libraryContent">
        <!--SideBar-->
        <div id="sideBar" class="sideBar">

          <!--Library filter-->
          <div id="sidebarWrapper" class="sideBarWrapper">
            <!-- Search Library -->
            <form id="search" method = "post">
              <table>

                <tr>
                  <td>Search By Title: </td>
                  <td align="left"><input id="bookTitle"type="text" name="bookTitle" /></td>
                  <td><button type="submit" name="searchTitle" > Search</button></td>
                  <td>Search By Author: </td>
                  <td align="left"><input id="bookAuthor"type="text" name="bookAuthor" /></td>
                  <td><button type="submit" name="searchAuthor" > Search</button></td>
                  <td> Search By ISBN: </td>
                  <td align="left"><input id="bookISBN"type="text" name="bookISBN" /></td>
                  <td><button type="submit" name="searchISBN" > Search</button></td>
                </tr>

                <p id="sidebarHandle">Books Filter</p>
                <p>
                  <form id="filter" method = "post">
                    <table>
                      <!--Sort Library-->
                      <tr>
                        <td>Sort Books By:</td>
                        <td><button type="submit" name="filterLibraryAll"  >Name</button></td>
                        <td><button type="submit" name="filterLibraryTrade" >Price</button></td>
                        <td><button type="submit" name="filterLibraryBuy" >Votes</button></td>
                      </tr>
                    </table>
                  </form>
                </p>
              </div>
            </div>

            <div id="libraryTableWrapper">
              <div id="libraryTable">

                <?php if($isBookAlreadyInCart === TRUE):?>
                  <p class = "warning">Item Already In Cart</p>
                <?php endif;?>
                <?php if($userMustLogIn === TRUE):?>
                  <p class = "warning">You need to Log In in order to trade</p>
                <?php endif;?>
                <table>
                  <thead>
                  </thead>

                  <tbody>
                    <form method="post">
                      <?php usort($library, 'librarySort');?>
                      <?php foreach ($library as $library1){ ?>
                        <tr>
                          <td>
                            <img src="<?php echo "book_images/".$library1['bookImageID']?>" alt"<?php echo $library1['bookName'];?>" style="width:80px;height:100px;">
                          </td>
                          <td>
                              <p id="libraryBookName"><?php echo $library1['bookName'];?></p>
                              <p id="libraryBookAuthor">Author: <?php echo $library1['bookAuthor'];?></p>
                              <p id="libraryBookISBN">ISBN: <?php echo $library1['bookISBN'];?></p>
                              <p id="libraryBookUser">added by <?php echo $library1['userName'];?></p>
                              <p><?php echo htmlspecialchars($count3); ?></p>

                          </td>
                          <td ><p id="libraryBookTradeCondition">Description:</br><?php echo $library1['tradeCondition'];?></p></td>
                          <td>
                            <button type = "submit" class="goToBookButton" id="goToBookButton" name ="goToBookButton" value= '<?php echo $count3;?>'>More Info</button>
                          </td>
                        </tr>
                        <?php $count3 += 1;}?>
                      </form>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Retrieve Proposal -->
            <div id="inbox" class="inbox">
              <p class="titleLine">Inbox</p>
              <table>

                <form method="post">
                  <tbody>
                    <?php foreach ($messages as $msg) {?>
                      <tr>
                        <?php if(isset($_POST['reply'])):?>
                          <?php if($_POST['reply']+1  === $count5 || $_POST['reply']  === $count5):?>
                            <td><input type="text" name="replyToUsername" id="replyToUsername"  value='<?php echo $replyToUsername[$oldCount1] ?>'/></td>
                            <td><input type="text" name="replyMessage" id="replyMessage"/></td>
                            <td ><button type="submit" name="sendReply" id="sendReply" value='<?php echo htmlspecialchars($count5)?>'>Send</button></td>
                          <?php endif;?>

                        <?php elseif(isset($_POST['sendReply']) and $msg['fromUsername'] !== NULL and $msg['message'] !== NULL):?>
                          <td ><?php echo $msg['fromUsername'];?></td>
                          <td ><?php echo $msg['message'];?></td>
                          <td ><button type="submit" name="reply" id="reply" value='<?php echo htmlspecialchars($count5)?>'>Reply</button></td>
                          <td ><button type="submit" name="deleteMessage" id="deleteMessage" value='<?php echo htmlspecialchars($count5)?>'>Delete!</button></td>

                        <?php elseif( $msg['fromUsername'] !== NULL and $msg['message'] !== NULL):?>
                          <td >From: <?php echo $msg['fromUsername'];?></td>
                          <td >Message: <?php echo $msg['message'];?></td>
                          <td ><button type="submit" name="reply" id="reply" value='<?php echo htmlspecialchars($count5)?>'>Reply</button></td>
                          <td ><button type="submit" name="deleteMessage" id="deleteMessage" value='<?php echo htmlspecialchars($count5)?>'>Delete!</button></td>
                        <?php endif;?>
                      </tr>
                      <?php $replyToUsername[$count5] = $msg['fromUsername'] ?>
                      <?php $oldCount1 = $count5; $count5=$count5+1;}?>
                    </tbody>
                  </form>
                </table>
              </div>



              <!--Adding New Books-->
              <div id="newBooks" class="newBooks">
                <form  method="post" enctype="multipart/form-data">
                  <table>
                    <p class="titleLine">Add New Books</p>
                    <tbody>
                      <tr>
                        <td align="right">Book Name:</td>
                        <td align="left"><input id="newBookName"type="text" name="newBookName" /></td>
                      </tr>

                      <tr>
                        <td align="right">Book Trade Condition:</td>
                        <td align="left"><input id="bookTradeCondition" type="text"  name="bookTradeCondition" /></td>
                      </tr>

                      <tr>
                        <td align="right">Book Condition:</td>
                        <td align="left">
                          <a>Used</a><input id="bookCondition" type="radio"  name="bookCondition" value="0"/>
                          <a>New</a><input id="bookCondition" type="radio"  name="bookCondition" value="1"/>
                        </td>
                      </tr>

                      <tr>
                        <td align="right">Book Description:</td>
                        <td align="left"><input id="bookDescription" type="text"  name="bookDescription" /></td>
                      </tr>

                      <tr>
                        <td align="right">Book Author:</td>
                        <td align="left"><input id="bookAuthor" type="text"  name="bookAuthor" /></td>
                      </tr>

                      <tr>
                        <td align="right">Book ISBN:</td>
                        <td align="left"><input id="bookISBN" type="text"  name="bookISBN" /></td>
                      </tr>

                      <tr>
                        <td align="right">Upload Book Image:</td>
                        <td align="left">
                          <input type="file" class="inputFile" name="newBookImage"/>
                        </td>
                      </tr>

                      <tr>
                        <td align="right"></td>
                        <td align="left"><button id="addBook" type="submit" name="addBook" />Add Book</button></td>
                      </tr>
                    </tbody>
                  </table>

                </form>
              </div>


              <!--Login-->
              <div id="loginContent" class="loginContent">
                <form method="post">
                  <p id="titleLine" class="titleLine">Login</p>
                  <?php if($loginFailed===true):?><p class = "warning">Invalid credentials!</p><?php endif;?>
                  <table>
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td align="right">Username:</td>
                        <td align="left"><input id="username"type="text" name="username" /></td>
                      </tr>

                      <tr>
                        <td align="right">Password:</td>
                        <td align="left"><input id="password" type="password" name="password" /></td>
                      </tr>

                      <tr>
                        <td align="right"></td>
                        <td align="left"><button type="submit" name="submit" value="Submit" >Submit</button></td>
                      </tr>
                    </tbody>
                  </table>

                </form>
              </div>

              <!--Shopping Cart
              <div id="shoppingCart" class="shoppingCart">
              <form method="post">
              <p id="titleLine" class="titleLine">Cart</p>
              <table>
              <?php if(isset($_SESSION['cartArray']) and isset($_SESSION['cartPriceCount'])): ?>
              <thead>
              <th >Book </th>
              <th >Price</th>
            </thead>
            <tbody>
            <?php foreach($_SESSION['cartArray'] as $cartContent){?>
            <?php if(!empty($cartContent['cartBookName']) AND !empty($cartContent['cartBookPrice'])): ?>
            <tr>
            <td ><?php echo $cartContent['cartBookName']; ?></td>
            <td ><?php echo $cartContent['cartBookPrice']; ?></td>
            <td ><button type="submit" name="removeCartBook" id="removeCartBook" value='<?php echo $cartCount;?>'>Remove</button>
          </tr>
        <?php endif; ?>
        <?php $cartCount = $cartCount + 1;}?>
        <tr>
        <td style="color:red;font-weight:bold"> Total amount:</td>
        <td style="color:red;font-weight:bold"><?php echo $_SESSION['cartPriceCount']; ?></td>
      </tr>
      <tr>
      <td align="right"><button type="submit" name="resetCart" id="resetCart" >Reset</button></td>
      <td align="left"><button type="submit" name="payForCartItems" id="payForCartItems"> Pay </button></td>
    <?php endif;?>
  </tr>
</tbody>
</table>


</form>
</div>
Cart Finished -->




<!--register content-->
<div id="registerContent" class="registerContent" >
  <form method="post">
    <p class="titleLine">Register</p>

    <?php if($emptyRegisterFields === TRUE):?>
      <p class = "warning">All fields are required</p>
    <?php endif;?>

    <?php if($userNameLengthValid === FALSE):?>
      <p class = "warning">Username must be between 4 to 12 characters<br></p>
    <?php endif;?>

    <?php if($userFirstCharValid === FALSE):?>
      <p class = "warning">Username should not start with a number nor with a space</p>
    <?php endif;?>

    <?php if($passwordMatched === FALSE):?>
      <p class = "warning">Password did not match</p>
    <?php endif;?>

    <?php if($passwordValid === FALSE):?>
      <p class = "warning">
        Password must be alphanumeric containing at least one symbol<br>
      </p><?php endif;?>

      <?php if($passwordLengthValid === FALSE):?>
        <p class = "warning">Password must be between 6 to 12 characters</p>
      <?php endif;?>

      <?php if($userNameExists === TRUE):?>
        <p class = "warning">Username already exists<br></p>
      <?php endif;?>

      <?php if($userNameInvalid === TRUE):?>
        <p class = "warning">Invalid Username: Spcial characters not allowed<br></p>
      <?php endif;?>

      <?php if($emailExists === TRUE):?>
        <p class = "warning">Email already exists<br></p>
      <?php endif;?>

      <?php if($registrationSuccessful === TRUE):?>
        <p style="color:darkgreen;">Regisrtation successful!<br></p>
      <?php endif;?>

      <?php if($isMailDone === TRUE):?>
        <p style="color:lightgreen;text-align:center;">An email is sent to your account please check to verify your registration.<br></p>
      <?php elseif($isMailDone === FALSE):?>
        <p class = "warning">Email not valid!<br></p>
      <?php endif;?>

      <table>
        <thead></thead>
        <tbody>
          <tr>
            <td align="right">Username:</td>
            <td align="left"><input id="usernamesignup"type="text" name="usernamesignup" /></td>
          </tr>

          <tr>
            <td align="right">Email:</td>
            <td align="left"> <input id="emailsignup"type="text" name="emailsignup" /></td>
          </tr>

          <tr>
            <td align="right">Password:</td>
            <td align="left"><input id="passwordsignup" type="password" name="passwordsignup" /></td>
          </tr>

          <tr>
            <td align="right">Confirm Password:</td>
            <td align="left"><input id="passwordsignup_confirm" type="password" name="passwordsignup_confirm" /></td>
          </tr>

          <tr>
            <td align="right"></td>
            <td align="left"><button type="submit" name="register" id="register"/>Register</button></td>
          </tr>
        </tbody>
      </table>

    </form>
  </div>



  <!--Logout-->
  <div id="logoutContent" class="logoutContent">

    <form method="post">
      <p class="titleLine">Log Out</p>
      <table>
        <thead>
        </thead>
        <tbody>
          <tr><td><button type="submit" id="logoutYes" name="logoutYes" >Yes!</button>
            <button type="submit" id="logoutNo" name="logoutNo" >No!</button></td></tr>
          </form>
        </tbody>
      </table>

    </div>

    <!--Current Books-->
    <div id="userBooks" class="userBooks">
      <table>
        <form method="post">
          <tbody>
            <?php foreach ($bookList as $book) {?>
              <tr>
                <?php if(isset($_POST['edit'])):?>
                  <?php if($_POST['edit']+1  === $count || $_POST['edit']  === $count):?>
                    <td><input type="text" name="editedBookName" id="editedBookName" value='<?php echo $oldBookName[$oldCount] ?>' /></td>
                    <td><input type="text" name="editedBookPrice" id="editedBookPrice" value='<?php echo $oldBookPrice[$oldCount] ?>' /></td>
                    <td><input type="text" name="editedBookTradeCondition" id="editedBookTradeCondition" value='<?php echo $oldBookTradeCondition[$oldCount] ?>' /></td>
                    <td ><button type="submit" name="updateBook" id="updateBook" value='<?php echo htmlspecialchars($oldCount)?>'>Update</button></td>
                  <?php endif;?>

                <?php elseif(isset($_POST['updateBook']) and strcmp($book['bookName'],"") !== 0 and strcmp($book['bookPrice'],"") !== 0 and strcmp($book['tradeCondition'],"") !== 0 ):?>

                  <td>
                    <img src="<?php echo "book_images/".$book['bookImageID']?>" alt"<?php echo $library1['bookName'];?>" style="width:80px;height:100px;">
                  </td>
                  <td >
                    <p id="libraryBookName"><?php echo $book['bookName'];?></p>
                    <p id="libraryBookPrice">$<?php echo $book['bookPrice'];?></p>
                  </td>
                  <td ><p id="libraryBookTradeCondition">Description:</br><?php echo $book['tradeCondition'];?></p></td>

                  <td ><button type="submit" name="delete" id="delete" value='<?php echo htmlspecialchars($count)?>'>Delete</button></td>
                  <td ><button type="submit" name="edit" id="edit" value='<?php echo htmlspecialchars($count)?>'>Edit</button></td>

                <?php elseif(strcmp($book['bookName'],"") !== 0 and strcmp($book['bookPrice'],"") !== 0 and strcmp($book['tradeCondition'],"") !== 0):?>

                  <td><img src="<?php echo "book_images/".$book['bookImageID']?>" alt"<?php echo $library1['bookName'];?>" style="width:80px;height:100px;"></td>
                  <td>
                    <p id="libraryBookName"><?php echo $book['bookName'];?></p>
                    <p id="libraryBookPrice"><?php echo $book['bookPrice'];?>$</p>
                  </td>
                  <td ><p id="libraryBookTradeCondition">Description:</br><?php echo $book['tradeCondition'];?></p></td>

                  <td ><button type="submit" name="delete" id="delete" value='<?php echo htmlspecialchars($count)?>'>Delete</button></td>
                  <td ><button type="submit" name="edit" id="edit" value='<?php echo htmlspecialchars($count)?>'>Edit</button></td>
                <?php endif;?>

              </tr>
              <?php $oldBookName[$count] = $book['bookName']; $oldBookPrice[$count] = $book['bookPrice']; $oldBookTradeCondition[$count] = $book['tradeCondition']; ?>
              <?php $oldCount=$count; $count=$count+1;}?>
            </tbody>
          </form>
        </table>
      </div>


      <!-- bookPage -->
      <div id="bookPage">
        <div id="bookPageWrapper">


          <table>
            <tbody>
              <tr>
                <td rowspan="6"><img src="data/images/dummybook.png" alt="Book Image"><td>
                <td> Book Name: </td>
              </tr>

              <tr>
                <td> Author: </td>
                <td><?php echo $library[$_SESSION['clickedBook']]['bookName'];?></td>
              </tr>

              <tr>
                <td> BookISBN: </td>
              </tr>
              <tr>
                <td> Book Description: </td>
              </tr>
              <tr>
                <td> Uploaded by: </td>
              </tr>
              <tr>
                <td> Trade Condition:</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!--Welcome Page-->
      <div id="home" class="home">
        <p id="welcomeLine">Welcome <?php if(isset($_SESSION["username"])){echo $_SESSION["username"];}?></p><br>

        <p>Welcome to Booktrade, a platform that allows book lovers around Australia
          to share their experiences with other readers through trading and sharing books. Booktrade
          is an online community that brings people together to share what they love. We offer a wide range of books
          to select from. Whether you are looking for science fiction, drama, satire, classics, romance,
          mystery, horror or more, you've come to the right place! You can find the top rated books for free. </P>


          <?php usort($library, 'lastAddedBookSort'); ?>
          <p style="color:#666;text-align:center;">New and Hot!</p>
          <div id="lastAddedBookSlideshow">
            <div class="slide-wrapper" >
              <?php foreach($library as $lastAddedBook){
                if($lastAddedBookCount < 11 ){ ?>
                  <div class="slide">
                    <a href="<?php echo "#lastAddedBook".$lastAddedBookCount; ?>" >
                      <p class="slide-content">
                        <?php echo $lastAddedBook['bookName']."</br>"."Uploaded by: ".$lastAddedBook['userName'];
                        $lastAddedBookCount = $lastAddedBookCount + 1;?>
                      </p>
                    </a>
                  </div>


                  <?php }} ?>
                </div>
              </div>

            </div>





          </div>
        </body>
        </html>
