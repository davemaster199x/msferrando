<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['book_now'])) {
    $package_id = $_POST['package_id'];
    $stud_id = $_SESSION['stud_id'];
    $date = date('Y-m-d');

    $count_result = mysqli_query($conn, "SELECT * FROM tbl_book WHERE stud_id = $stud_id AND book_status = 0 OR book_status = 1 AND book_payment = 0 OR book_payment = 1");
    $total_result = mysqli_num_rows($count_result);
    // echo $total_result;
    if ($total_result == 0) {
        $result = mysqli_query($conn, "INSERT INTO tbl_book(package_id, stud_id, book_created) VALUES('$package_id', '$stud_id', '$date')");
        if ($result) {
            echo 'success';
        }
    } else {
        echo 'failed';
    }  
  }

  
  mysqli_close($conn);
 ?>
