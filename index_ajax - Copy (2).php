<?php
    include("./admin/connection.php");
    date_default_timezone_set('Asia/Manila');
    use PHPMailer\PHPMailer\PHPMailer;
    require_once 'phpmailer/Exception.php';
    require_once 'phpmailer/PHPMailer.php';
    require_once 'phpmailer/SMTP.php';
    $mail = new PHPMailer(true);

    if (isset($_POST['driving_schedule'])) {
        $stud_name = $_POST['stud_name'];
        $stud_email_address = $_POST['stud_email_address'];
        $stud_contact = $_POST['stud_contact'];
        $stud_birthdate = $_POST['stud_birthdate'];
        $stud_address = $_POST['stud_address'];

        $code = rand(4,1000000);

        $message = '
        <div style="padding: 20px 0px 0px 0px; background-color: #0E3741;" class="shadow">
            <img src="https://msferrando.mikaelarealty.com/images/banner.png" style="width: 100%;">
            <table width="100%" border="0" cellspacing="0" cellpadding="20" style="background-color: #47bcde; color: #5a5f61; font-family:verdana;">
                <tr>
                    <td style="background-color: #fff; border-top: 10px solid #0E3741; border-bottom: 10px solid #0E3741;">
                        <p style="margin-top: -5px;">Hi Student,</p>
                        <label>Here is you code: '.$code.'</label><br>
                        <label>Note* You can use this code once.</label><br>
                    </td>
                </tr>
            </table>
            <div style="text-align: center; padding: 20px 0px; color: #fff; background-color: #0E3741;">
                Vinzon Street<br>
                Barangay. 15-B, Corner Rustico Cabaguio Street,<br>
                Poblacion District, Davao City, Philippines 8000<br><br>
                <a href="https://msferrando.com/" style="color: white;">https://msferrando.com/</a>
            </div>
        </div>
        ';
        
        try{
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = "malhindavid@gmail.com";
                $mail->Password = "pgjpvspfpauidugk";
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = '587';

                $mail->setFrom("malhindavid@gmail.com");
                $mail->addAddress("$stud_email_address");

                $mail->isHTML(true);
                $mail->Subject = "MS Ferrando Driving School Institute | Verification Code";
                $mail->Body = "$message";

                $mail->send();
                // echo "success";
            } catch (Exception $e){
                // echo "failed";
            }
        
        echo '
        <div class="col-md-12">
            <div class="card-box">
                <h4 class="header-title mb-3">Student Information</h4>
                <label>Student Name: '.$stud_name.'</label><br>
                <label>Email Address: '.$stud_email_address.'</label><br>
                <label>Contact Number: '.$stud_contact.'</label><br>
                <label>Birthdate: '.$stud_birthdate.'</label><br>
                <label>Address: '.$stud_address.'</label>
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <div class="card-box">
                <label>Please check your email for the verification!</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="veri_code" placeholder="Enter Code" value="'.$code.'">
                            <input type="number" class="form-control" id="input_code" placeholder="Enter Code">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="button" class="form-control btn btn-primary" id="confirm_button" value="Confirm" onclick="verify_code()">
                        </div>
                    </div>
                </div><br>
                <div class="row" id="show_stud_password">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="password" class="form-control" id="stud_password" disabled placeholder="Enter Password">
                            <input type="checkbox" onclick="myFunction()"> Show Password
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="button" class="form-control btn btn-success" id="student_save" onclick="save_application()" disabled value="Save Application">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    }

    if (isset($_POST['save_application'])) {
        $stud_name = mysqli_real_escape_string($conn, $_POST['stud_name']);
        $stud_email_address = mysqli_real_escape_string($conn, $_POST['stud_email_address']);
        $stud_contact = mysqli_real_escape_string($conn, $_POST['stud_contact']);
        $stud_birthdate = mysqli_real_escape_string($conn, $_POST['stud_birthdate']);
        $stud_address = mysqli_real_escape_string($conn, $_POST['stud_address']);

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
            $result = mysqli_query($conn, "INSERT INTO tbl_student (stud_date_created,stud_name,stud_email_address,stud_password,stud_contact_number,stud_address,stud_birthdate) VALUES (NOW(),'$stud_name','$stud_email_address','0','$stud_contact','$stud_address','$stud_birthdate')");
            $stud_id = $conn->insert_id;
            if ($result) {
                $insert_schedule = mysqli_query($conn, "INSERT INTO tbl_tdc (stud_id, tdc_first_day, tdc_first_time, tdc_second_day, tdc_second_time, tdc_third_day, tdc_third_time, tdc_created, tdc_price) VALUES ('$stud_id', '$tdc_first_day', '$tdc_first_time', '$tdc_second_day', '$tdc_second_time', '$tdc_third_day', '$tdc_third_time', NOW(), '$tdc_price')");
                if ($insert_schedule) {
                    echo 'success';
                }
            }
        } else{
            echo $day1.''.$day2.''.$day3;
        }
    }






    if (isset($_POST['show_pdc'])) {
        $stud_name = $_POST['stud_name'];
        $stud_email_address = $_POST['stud_email_address'];
        $stud_contact = $_POST['stud_contact'];
        $stud_birthdate = $_POST['stud_birthdate'];
        $stud_address = $_POST['stud_address'];

        echo '
        <h4 align="center">Practical Driving Course (PDC)</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="card-box">
                    <h4 class="header-title mb-3">Student Information</h4>
                    <label>Student Name: '.$stud_name.'</label><br>
                    <label>Email Address: '.$stud_email_address.'</label><br>
                    <label>Contact Number: '.$stud_contact.'</label><br>
                    <label>Birthdate: '.$stud_birthdate.'</label><br>
                    <label>Address: '.$stud_address.'</label>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-box">
                    <h4 class="header-title mb-3" align="center">Select Schedule</h4>
                    <div id="demo" class="carousel slide" data-ride="carousel" style="height: 500px;">
                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                    </ul>
                    
                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./images/intructor/1.png" style="max-width:100%; height:auto;">
                            <div class="carousel-caption">
                                <h3>Los Angeles</h3>
                                <p>LA is always so much fun!</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                        <img src="./images/intructor/1.png" style="max-width:100%; height:auto;">
                        </div>
                        <div class="carousel-item">
                        <img src="./images/intructor/1.png" style="max-width:100%; height:auto;">
                        </div>
                    </div>
                    
                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                    </div>
                </div>
            </div>
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
            
            $("#tdc_first_day").attr("min", minDate);
        });
        </script>
        ';
    }
    
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

    mysqli_close($conn);
?>