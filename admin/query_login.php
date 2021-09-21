<?php
  session_start();
  include("./connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['login'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $results = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username = '$username' AND userpass = '$password' LIMIT 1");
      $data = mysqli_fetch_assoc($results);
      if (mysqli_num_rows($results) == 1) {
          $_SESSION['user_id'] = $data['user_id'];
          $_SESSION['name'] = $data['name'];
          echo 'succes';
      } else {
          echo 'failed';
      }

  }
  if (isset($_GET['logout'])) {
      session_destroy();
      header("Location:./index.php");
  }

  mysqli_close($conn);
 ?>