<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['cancel_booking'])) {
    $book_id = $_POST['book_id'];

    $result = mysqli_query($conn, "DELETE FROM tbl_book WHERE book_id = $book_id");
    if ($result) {
        echo 'success';
    }
  }
  
  mysqli_close($conn);
 ?>
