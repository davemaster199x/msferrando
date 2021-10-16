<?php
  session_start();
  include("./connection.php");
  date_default_timezone_set('Asia/Manila');
  use PHPMailer\PHPMailer\PHPMailer;
    require_once 'phpmailer/Exception.php';
    require_once 'phpmailer/PHPMailer.php';
    require_once 'phpmailer/SMTP.php';
    $mail = new PHPMailer(true);

  if (isset($_POST['login'])) {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      $results = mysqli_query($conn, "SELECT * FROM tbl_student WHERE stud_email_address = '$email' AND stud_password = '$password' LIMIT 1");
      $data = mysqli_fetch_assoc($results);
      if (mysqli_num_rows($results) == 1) {
          $_SESSION['stud_id'] = $data['stud_id'];
          $_SESSION['name'] = $data['stud_name'];
          echo 'success';
      } else {
          echo 'failed';
      }

  }

  if (isset($_GET['logout'])) {
      session_destroy();
      header("Location:./index.php");
  }

  if (isset($_POST['forgot_password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $code = rand(4,1000000);
    $temp_pass = 'ms'.$code;

    $result_dup = mysqli_query($conn, "SELECT * FROM tbl_student WHERE stud_email_address = '$email' LIMIT 1");
    $count = mysqli_num_rows($result_dup);
    if ($count == 1) {
        $message = '
        <div style="padding: 20px 0px 0px 0px; background-color: #0E3741;" class="shadow">
            <img src="https://msferrando.mikaelarealty.com/images/banner.png" style="width: 100%;">
            <table width="100%" border="0" cellspacing="0" cellpadding="20" style="background-color: #47bcde; color: #5a5f61; font-family:verdana;">
                <tr>
                    <td style="background-color: #fff; border-top: 10px solid #0E3741; border-bottom: 10px solid #0E3741;">
                        <p style="margin-top: -5px;">Hi Student,</p>
                        <label>Here is you password: '.$temp_pass.'</label><br>
                        <label>Note* You can change this password once you can login to you dashboard.</label><br>
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
            $mail->addAddress("$email");

            $mail->isHTML(true);
            $mail->Subject = "MS Ferrando Driving School Institute | Forgot Password";
            $mail->Body = "$message";

            $mail->send();
            mysqli_query($conn, "UPDATE tbl_student SET stud_password = '$temp_pass' WHERE stud_email_address = '$email'");
            echo "success";
        } catch (Exception $e){
            echo "failed";
        }
    } else {
        echo 'failed';
    }
  }

  mysqli_close($conn);
 ?>