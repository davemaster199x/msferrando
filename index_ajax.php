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
            <img src="https://msferrandodriving.com/images/banner.jpg" style="width: 100%;">
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
                            <input type="button" class="form-control btn btn-success" id="student_save" disabled value="Save Application" onclick="save_application()">
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
        $stud_password = mysqli_real_escape_string($conn, $_POST['stud_password']);

        $result_dup = mysqli_query($conn, "SELECT * FROM tbl_student WHERE stud_email_address = '$stud_email_address' AND stud_name = '$stud_name' LIMIT 1");
        $count = mysqli_num_rows($result_dup);
        if ($count == 1) {
            echo 'duplicate';
        } else {
            $result = mysqli_query($conn, "INSERT INTO tbl_student (stud_date_created,stud_name,stud_email_address,stud_password,stud_contact_number,stud_address,stud_birthdate) VALUES (NOW(),'$stud_name','$stud_email_address','$stud_password','$stud_contact','$stud_address','$stud_birthdate')");
            if ($result) {
                echo 'success';
            }
        }
    }
    mysqli_close($conn);
?>