<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['day1'])) {
    $tdc_first_day = $_POST['tdc_first_day'];
    $tdc_first_time = $_POST['tdc_first_time'];

    $result_max = mysqli_query($conn, "SELECT max_tdc_stud FROM tbl_maxstud");
    $data = mysqli_fetch_assoc($result_max);
    $max_tdc_stud = $data['max_tdc_stud'];

    $count_day1 = mysqli_query($conn, "SELECT tdc_id FROM tbl_tdc WHERE tdc_first_day = '$tdc_first_day' AND tdc_first_time = '$tdc_first_time'");
    $total_day1 = mysqli_num_rows($count_day1);
    if ($total_day1 == $max_tdc_stud) {
        echo 'sobra';
    }
  }

  if (isset($_POST['day2'])) {
      $tdc_second_day = $_POST['tdc_second_day'];
      $tdc_second_time = $_POST['tdc_second_time'];

      $result_max = mysqli_query($conn, "SELECT max_tdc_stud FROM tbl_maxstud");
      $data = mysqli_fetch_assoc($result_max);
      $max_tdc_stud = $data['max_tdc_stud'];

      $count_day2 = mysqli_query($conn, "SELECT tdc_id FROM tbl_tdc WHERE tdc_second_day = '$tdc_second_day' AND tdc_second_time = '$tdc_second_time'");
      $total_day2 = mysqli_num_rows($count_day2);
      if ($total_day2 == $max_tdc_stud) {
          echo 'sobra';
      }
  }

  if (isset($_POST['day3'])) {
      $tdc_third_day = $_POST['tdc_third_day'];
      $tdc_third_time = $_POST['tdc_third_time'];

      $result_max = mysqli_query($conn, "SELECT max_tdc_stud FROM tbl_maxstud");
      $data = mysqli_fetch_assoc($result_max);
      $max_tdc_stud = $data['max_tdc_stud'];

      $count_day3 = mysqli_query($conn, "SELECT tdc_id FROM tbl_tdc WHERE tdc_third_day = '$tdc_third_day' AND tdc_third_time = '$tdc_third_time'");
      $total_day3 = mysqli_num_rows($count_day3);
      if ($total_day3 == $max_tdc_stud) {
          echo 'sobra';
      }
  }

  if (isset($_POST['save_application'])) {
      $stud_id = $_SESSION['stud_id'];

      $tdc_first_day = $_POST['tdc_first_day'];
      $tdc_first_time = $_POST['tdc_first_time'];

      $tdc_second_day = $_POST['tdc_second_day'];
      $tdc_second_time = $_POST['tdc_second_time'];

      $tdc_third_day = $_POST['tdc_third_day'];
      $tdc_third_time = $_POST['tdc_third_time'];

      $result_max = mysqli_query($conn, "SELECT max_tdc_stud FROM tbl_maxstud");
      $data = mysqli_fetch_assoc($result_max);
      $max_tdc_stud = $data['max_tdc_stud'];

      $day1 = '';
      $count_day1 = mysqli_query($conn, "SELECT tdc_id FROM tbl_tdc WHERE tdc_first_day = '$tdc_first_day' AND tdc_first_time = '$tdc_first_time'");
      $total_day1 = mysqli_num_rows($count_day1);
      if ($total_day1 == $max_tdc_stud) {
          $day1 = 1;
      }

      $day2 = '';
      $count_day2 = mysqli_query($conn, "SELECT tdc_id FROM tbl_tdc WHERE tdc_second_day = '$tdc_second_day' AND tdc_second_time = '$tdc_second_time'");
      $total_day2 = mysqli_num_rows($count_day2);
      if ($total_day2 == $max_tdc_stud) {
          $day2 = 2;
      }

      $day3 = '';
      $count_day3 = mysqli_query($conn, "SELECT tdc_id FROM tbl_tdc WHERE tdc_third_day = '$tdc_third_day' AND tdc_third_time = '$tdc_third_time'");
      $total_day3 = mysqli_num_rows($count_day3);
      if ($total_day3 == $max_tdc_stud) {
          $day3 = 3;
      }

      $result_tdc_price = mysqli_query($conn, "SELECT * FROM tbl_tdc_price");
      $data = mysqli_fetch_assoc($result_tdc_price);
      $tdc_price = $data['tdc_price'];

      if ($day1 == '' && $day2 == '' && $day3 == '') {
            $insert_schedule = mysqli_query($conn, "INSERT INTO tbl_tdc (stud_id, tdc_first_day, tdc_first_time, tdc_second_day, tdc_second_time, tdc_third_day, tdc_third_time, tdc_created, tdc_price) VALUES ('$stud_id', '$tdc_first_day', '$tdc_first_time', '$tdc_second_day', '$tdc_second_time', '$tdc_third_day', '$tdc_third_time', NOW(), '$tdc_price')");
            if ($insert_schedule) {
                echo 'success';
            }
      } else{
          echo $day1.''.$day2.''.$day3;
      }
  }
  
  if (isset($_POST['cancel_booking'])) {
    $tdc_id = $_POST['tdc_id'];

    $query = mysqli_query($conn, "DELETE FROM tbl_tdc WHERE tdc_id = '$tdc_id'");
    if ($query) {
        echo 'success';
    }
}
  
  mysqli_close($conn);
 ?>
