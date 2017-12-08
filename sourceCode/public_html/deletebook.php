<?php
SESSION_START();

if(isset($_POST['deleteBook'])){
  $delBookId = $_POST['deleteBook'];
  $delBook[] = array();
  $delBook = getBook($delBookId);
  foreach($delBook as $book){
    $path = "book_images/".$book['bookImageID'];
    if(file_exists($path)){
      unlink($path);
    }
  }

  connectToDatabase();
  $deleteQuery = $connectionToDatabase->prepare("DELETE FROM bookList WHERE bookId = :bookID");
  $deleteQuery->bindParam(':bookID', $delBookId);
  $deleteQuery->execute();
  abortDatabaseConnection();
  goToUserBooks();

}

?>
