<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['update_tdc_settings'])) {
    $car_manual = $_POST['car_manual'];
    $car_automatic = $_POST['car_automatic'];
    $motor_manual = $_POST['motor_manual'];
    $motor_automatic = $_POST['motor_automatic'];
    // $tdc_price = $_POST['tdc_price'];
    $max_tdc_stud = $_POST['max_tdc_stud'];

    $result = mysqli_query($conn, "UPDATE tbl_equipment SET car_manual = '$car_manual', car_automatic = '$car_automatic', motor_manual = '$motor_manual', motor_automatic = '$motor_automatic'");
    if ($result) {
        $results = mysqli_query($conn, "UPDATE tbl_maxstud SET max_tdc_stud = '$max_tdc_stud'");
        if ($results) {
          echo 'success';
        }
    }
  }
  
  mysqli_close($conn);
 ?>
