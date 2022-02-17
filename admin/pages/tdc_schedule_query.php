<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');
  use PHPMailer\PHPMailer\PHPMailer;
    require_once '../../phpmailer/Exception.php';
    require_once '../../phpmailer/PHPMailer.php';
    require_once '../../phpmailer/SMTP.php';
    $mail = new PHPMailer(true);

  if (isset($_POST['show_schedule'])) {
    $tdc_id = $_POST['tdc_id'];

    $query = mysqli_query($conn, "SELECT * FROM tbl_tdc WHERE tdc_id = '$tdc_id'");
    $data = mysqli_fetch_assoc($query);
    $tdc_stud_status = $data['tdc_stud_status'];
    $tdc_stud_payment_status = $data['tdc_stud_payment_status'];
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
                <label>Please Select the days following the order of the schedule.</label>
            </center>
            <div class="row">
                <div class="col-md-4">
                    <label>First Day</label>
                    <ul style="margin-top: 0px;">
                        <li>Tuesday</li>
                        <li>Friday</li>
                    </ul>  
                </div>
                <div class="col-md-4">
                    <label>Second Day</label>
                    <ul style="margin-top: 0px;">
                        <li>Wednesday</li>
                        <li>Saturday</li>
                    </ul> 
                </div>
                <div class="col-md-4">
                    <label>Third Day</label>
                    <ul style="margin-top: 0px;">
                        <li>Thursday</li>
                        <li>Sunday</li>
                    </ul> 
                </div>
            </div>
            <center>
                <strong>No Schedule on MONDAY!</strong>
            </center><br>
            <label>
                <strong>Your Schedule:</strong><br>
                First Day: '.$first_day.' | Time: '.$first_time.'<br>
                Second Day: '.$second_day.' | Time: '.$second_time.'<br>
                Third Day: '.$third_day.' | Time: '.$third_time.'
            </label>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-4 col-form-label">Student Status:</label>
                        <input type="hidden" id="tdc_id" value="'.$tdc_id.'">
                        <div class="col-7">
                            <select class="form-control" id="tdc_stud_status">
                                <option '; if($tdc_stud_status == 0) { echo 'selected'; } echo ' value="0">Invalid</option>
                                <option '; if($tdc_stud_status == 1) { echo 'selected'; } echo ' value="1">Validate</option>
                                <option '; if($tdc_stud_status == 2) { echo 'selected'; } echo ' value="2">Done</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-4 col-form-label">Payment Status:</label>
                        <div class="col-7">
                            <select class="form-control" id="tdc_stud_payment_status">
                                <option '; if($tdc_stud_payment_status == 0) { echo 'selected'; } echo ' value="0">Unpaid</option>
                                <option '; if($tdc_stud_payment_status == 1) { echo 'selected'; } echo ' value="1">Partially Paid</option>
                                <option '; if($tdc_stud_payment_status == 2) { echo 'selected'; } echo ' value="2">Fully Paid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-4 col-form-label">Student Notes:</label>
                        <div class="col-7">
                            <textarea class="form-control" id="tdc_notes" cols="20" rows="5">'.$data['tdc_notes'].'</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-4 col-form-label"></label>
                        <div class="col-7">
                            <input type="button" class="btn btn-primary" value="Update Status" onclick="update_stud_status()">
                        </div>
                    </div>
                </div>
            </div>
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

    if (isset($_POST['update_stud_status'])) {
        $tdc_id = $_POST['tdc_id'];
        $tdc_stud_status = $_POST['tdc_stud_status'];
        $tdc_stud_payment_status = $_POST['tdc_stud_payment_status'];
        $tdc_notes = $_POST['tdc_notes'];

        if ($tdc_stud_status == 1) {
            if ($tdc_stud_payment_status == 1) {
                $paystatus = "Partially Paid";
            } elseif ($tdc_stud_payment_status == 2) {
                $paystatus = "Fully Paid";
            } else {
                $paystatus = 'Unpaid';
            }
            $query = mysqli_query($conn, "SELECT
                                            tbl_student.stud_name,tbl_student.stud_email_address
                                        FROM
                                            tbl_tdc
                                            INNER JOIN
                                            tbl_student
                                            ON 
                                                tbl_tdc.stud_id = tbl_student.stud_id WHERE tdc_id = '$tdc_id'");
            $data = mysqli_fetch_assoc($query);
            $stud_name = $data['stud_name'];
            $stud_email_address = $data['stud_email_address'];
            $message = '
            <div style="padding: 20px 0px 0px 0px; background-color: #0E3741;" class="shadow">
                <img src="https://msferrandodriving.com/images/banner.jpg" style="width: 100%;">
                <table width="100%" border="0" cellspacing="0" cellpadding="20" style="background-color: #47bcde; color: #5a5f61; font-family:verdana;">
                    <tr>
                        <td style="background-color: #fff; border-top: 10px solid #0E3741; border-bottom: 10px solid #0E3741;">
                            <p style="margin-top: -5px;">Hi '.$stud_name.',</p>
                            <label>Your TDC Schedule has been approved. Please attend to your schedule at exact day and time. Thank you.</label><br>
                            <label>Payment Status: '.$paystatus.'</label><br><br>
                            <label>Regards,</label><br>
                            <label>Ms Ferrando Driving School Institute</label>
                        </td>
                    </tr>
                </table>
                <div style="text-align: center; padding: 20px 0px; color: #fff; background-color: #0E3741;">
                    Vinzon Street<br>
                    Barangay. 15-B, Corner Rustico Cabaguio Street,<br>
                    Poblacion District, Davao City, Philippines 8000<br><br>
                    <a href="https:/msferrandodriving.com/" style="color: white;">https://msferrandodriving.com/</a>
                </div>
            </div>
            ';
            try{
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = "marvinf@msfdi.com";
                $mail->Password = "jlmnqtuwdrszfamz";
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = '587';

                $mail->setFrom("marvinf@msfdi.com");
                $mail->addAddress("$stud_email_address");

                $mail->isHTML(true);
                $mail->Subject = "MS Ferrando Driving School Institute | TDC Schedule";
                $mail->Body = "$message";

                $mail->send();
                // echo "success";
            } catch (Exception $e){
                // echo "failed";
            }
        }

        $result = mysqli_query($conn, "UPDATE tbl_tdc SET tdc_stud_status = '$tdc_stud_status', tdc_stud_payment_status = '$tdc_stud_payment_status', tdc_notes = '$tdc_notes' WHERE tdc_id = '$tdc_id'");
        if ($result) {
            echo 'success';
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
