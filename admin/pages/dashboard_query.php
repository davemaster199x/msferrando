<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['update_tdc_settings'])) {
    $tdc_pricing = $_POST['tdc_pricing'];
    // $tdc_price = $_POST['tdc_price'];
    $max_tdc_stud = $_POST['max_tdc_stud'];

    $result = mysqli_query($conn, "UPDATE tbl_tdc_price SET tdc_desc = '$tdc_pricing'");
    if ($result) {
        $results = mysqli_query($conn, "UPDATE tbl_maxstud SET max_tdc_stud = '$max_tdc_stud'");
        if ($results) {
          echo 'success';
        }
    }
  }
  
  mysqli_close($conn);
 ?>
