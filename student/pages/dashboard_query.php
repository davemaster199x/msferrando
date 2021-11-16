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
    $tdc_id = $_POST['tdc_id'];

    $query = mysqli_query($conn, "SELECT * FROM tbl_tdc WHERE tdc_id = '$tdc_id'");
    $data = mysqli_fetch_assoc($query);
    if ($data['tdc_first_day'] == '0000-00-00') {
        $first_day = '';
    } else {
    $first_day = date('M d, Y', strtotime($data['tdc_first_day']));
    }
    
    if ($data['tdc_first_time'] == '-Sele') {
    $first_time = '';
    } else {
    $first_time = ($data['tdc_first_time'] == 'am') ? '7am-12pm' : '1pm-6pm';
    }
    
    if ($data['tdc_second_day'] == '0000-00-00') {
    $second_day = '';
    } else {
    $second_day = date('M d, Y', strtotime($data['tdc_second_day']));
    }

    if ($data['tdc_second_time'] == '-Sele') {
    $second_time = '';
    } else {
    $second_time = ($data['tdc_second_time'] == 'am') ? '7am-12pm' : '1pm-6pm';
    }
    
    if ($data['tdc_third_day'] == '0000-00-00') {
    $third_day = '';
    } else {
    $third_day = date('M d, Y', strtotime($data['tdc_third_day']));
    }

    if ($data['tdc_third_time'] == '-Sele') {
    $third_time = '';
    } else {
    $third_time = ($data['tdc_third_time'] == 'am') ? '7am-12pm' : '1pm-6pm';
    }
    echo '
        <input type="hidden" id="tdc_id_update" value="'.$tdc_id.'">
        <div class="col-sm-12">
            <center>
                <label>You can select any schedule but please follow the DAY SIMULTANEOUSLY!! </label>
            </center>
            <div class="row">
                <div class="col-md-4">
                    <label>First Day</label>
                    <ul style="margin-top: 0px;">
                        <li>Monday</li>
                        <li>Thursday</li>
                    </ul>  
                </div>
                <div class="col-md-4">
                    <label>Second Day</label>
                    <ul style="margin-top: 0px;">
                        <li>Tuesday</li>
                        <li>Friday</li>
                    </ul> 
                </div>
                <div class="col-md-4">
                    <label>Third Day</label>
                    <ul style="margin-top: 0px;">
                        <li>Wednesday</li>
                        <li>Saturday</li>
                    </ul> 
                </div>
            </div>
            <center>
                <strong>No Schedule on SUNDAY!</strong>
            </center><br>
            <label>
                <strong>Your Schedule:</strong><br>
                First Day: '.$first_day.' | Time: '.$first_time.'<br>
                Second Day: '.$second_day.' | Time: '.$second_time.'<br>
                Third Day: '.$third_day.' | Time: '.$third_time.'
            </label>
            <hr>
            <form >
                <strong>Update Schedule here!</strong>
                <div class="form-group">
                    <label for="exampleInputEmail1">First Day:</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" class="form-control" id="tdc_first_day_hidden" value="'.$data['tdc_first_day'].'">
                            <input type="date" class="form-control" id="tdc_first_day_update" onchange="first_day_update()" value="">
                        </div>
                        <div class="col-md-6">
                            <select id="tdc_first_time_update" class="form-control"  onchange="first_time_update()">
                                <option  selected>-Select Time-</option>
                                <option value="am">7am-12pm</option>
                                <option value="pm">1pm-6pm</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Second Day:</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="date" class="form-control" id="tdc_second_day_update"  onchange="second_day_update()" value="">
                        </div>
                        <div class="col-md-6">
                            <select id="tdc_second_time_update" class="form-control"  onchange="second_time_update()">
                                <option  selected>-Select Time-</option>
                                <option value="am">7am-12pm</option>
                                <option value="pm">1pm-6pm</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Third Day:</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="date" class="form-control" id="tdc_third_day_update"  onchange="third_day_update()" value="">
                        </div>
                        <div class="col-md-6">
                            <select id="tdc_third_time_update" class="form-control"  onchange="third_time_update()">
                                <option  selected>-Select Time-</option>
                                <option value="am">7am-12pm</option>
                                <option value="pm">1pm-6pm</option>
                            </select>
                        </div>
                    </div>
                </div>
                <label id="reminder_update" style="display: none;">Please take a screenshot or picture for the following 3 days Schedule for you Reference!! Thank you.</label>
                <input type="button" class="btn btn-danger float-left" value="Reset Schedule" onclick="reset_tdc_schedule_update()">
                <input type="button" class="btn btn-success float-right" value="Update Schedule"  onclick="save_application_update()" id="show_application_update">
            </form>
        </div>
        <script>
    $(function(){
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = "0" + month.toString();
        if(day < 10)
            day = "0" + day.toString();
        
        var minDate= year + "-" + month + "-" + day;
        
        $("#tdc_first_day_update").attr("min", minDate);
    });
    </script>
    ';
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
