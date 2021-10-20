<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['save_password'])) {
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
    $old_pass = mysqli_real_escape_string($conn, $_POST['old_pass']);
    $stud_id = $_SESSION['stud_id'];

    $count_result = mysqli_query($conn, "SELECT * FROM tbl_student WHERE stud_id = $stud_id AND stud_password = '$old_pass'");
    $total_result = mysqli_num_rows($count_result);
    if ($total_result === 1) {
        $result = mysqli_query($conn, "UPDATE tbl_student SET stud_password = '$new_pass' WHERE stud_id = $stud_id");
        if ($result) {
            echo 'success';
        }
    } else {
        echo 'failed';
    }  
  }

  
  mysqli_close($conn);
 ?>
