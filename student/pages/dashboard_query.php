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

  if (isset($_POST['show_schedule'])) {
    $book_id = $_POST['book_id'];

    $query = mysqli_query($conn, "SELECT * FROM tbl_book LEFT JOIN tbl_tdc ON tbl_book.book_id = tbl_tdc.book_id WHERE tbl_book.book_id = $book_id");
    $data = mysqli_fetch_assoc($query);
    $book_tdc = $data['book_tdc'];
    $book_tdc_sched = $data['book_tdc_sched'];
    $book_pdc = $data['book_pdc'];
    $book_pdc_car = $data['book_pdc_car'];
    $book_pdc_motor = $data['book_pdc_motor'];
    $book_pdc_hours = $data['book_pdc_hours'];

    echo '
    <div class="row">
        <div class="col-md-6">';
            if ($book_tdc == 1) {
            echo '
            <div class="card-box">
                <h4 class="header-title">PDC Schedule</h4>
                <center>
                    <label>Please your schedule!</label>
                </center>
                <form >
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                            <label for="exampleInputEmail1">First Day:</label>
                                <input type="hidden" class="form-control" id="book_id" value="'.$data['book_id'].'">
                                <input type="date" class="form-control" id="tdc_first_day" value="'.$data['tdc_first_day'].'">
                            </div>
                            <div class="col-md-6">
                            <label for="exampleInputEmail1">Second Day</label>
                            <input type="date" class="form-control" id="tdc_second_day" value="'.$data['tdc_second_day'].'">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                <input type="button" class="btn btn-success float-right" value="Update TDC"  onclick="save_tdc()">
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
            ';
            }
            echo '
        </div>
        <div class="col-md-6">';
            if ($book_pdc == 1) {
            echo '
            <div class="card-box">
                <h4 class="header-title">PDC Schedule</h4>
            </div>
            ';
            }
            echo '
        </div>
    </div>
    
    
    ';
    
  }

  if (isset($_POST['save_tdc'])) {
    $book_id = $_POST['book_id'];
    $tdc_first_day = $_POST['tdc_first_day'];
    $tdc_second_day = $_POST['tdc_second_day'];

    $result_max = mysqli_query($conn, "SELECT max_tdc_stud FROM tbl_maxstud");
    $data = mysqli_fetch_assoc($result_max);
    $max_tdc_stud = $data['max_tdc_stud'];

    $query_book_id = mysqli_query($conn, "SELECT book_id FROM tbl_tdc WHERE book_id = '$book_id'");
    if (mysqli_num_rows($query_book_id) == 1) {
        $day1 = '';
        $query1 = mysqli_query($conn, "SELECT book_id FROM tbl_tdc WHERE tdc_first_day = '$tdc_first_day'");
        if (mysqli_num_rows($query1) == $max_tdc_stud) {
            $day1 = 1;
        }
        $day2 = '';
        $query2 = mysqli_query($conn, "SELECT book_id FROM tbl_tdc WHERE tdc_second_day = '$tdc_second_day'");
        if (mysqli_num_rows($query2) == $max_tdc_stud) {
            $day2 = 2;
        }

        if ($day1 == '' && $day2 == '') {
            $result = mysqli_query($conn, "UPDATE tbl_tdc SET tdc_first_day = '$tdc_first_day', tdc_second_day = '$tdc_second_day'");
            if ($result) {
                echo 'success';
            }
        } else{
            echo $day1.''.$day2;
        }
        
    } else {
        $day1 = '';
        $query1 = mysqli_query($conn, "SELECT book_id FROM tbl_tdc WHERE tdc_first_day = '$tdc_first_day'");
        if (mysqli_num_rows($query1) == $max_tdc_stud) {
            $day1 = 1;
        }
        $day2 = '';
        $query2 = mysqli_query($conn, "SELECT book_id FROM tbl_tdc WHERE tdc_second_day = '$tdc_second_day'");
        if (mysqli_num_rows($query2) == $max_tdc_stud) {
            $day2 = 2;
        }

        if ($day1 == '' && $day2 == '') {
            $result = mysqli_query($conn, "INSERT INTO tbl_tdc (book_id, tdc_first_day, tdc_second_day) VALUES ($book_id, '$tdc_first_day', '$tdc_second_day')");
            if ($result) {
                echo 'success';
            }
        } else{
            echo $day1.''.$day2;
        }
    }
  }














  if (isset($_POST['save_application_update'])) {
    $tdc_id = $_POST['tdc_id'];

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
          $insert_schedule = mysqli_query($conn, "UPDATE tbl_tdc SET tdc_first_day = '$tdc_first_day', tdc_first_time = '$tdc_first_time', tdc_second_day = '$tdc_second_day', tdc_second_time = '$tdc_second_time', tdc_third_day = '$tdc_third_day', tdc_third_time = '$tdc_third_time' WHERE tdc_id = '$tdc_id'");
          if ($insert_schedule) {
              echo 'success';
          }
    } else{
        echo $day1.''.$day2.''.$day3;
    }
}
  
  mysqli_close($conn);
?>
