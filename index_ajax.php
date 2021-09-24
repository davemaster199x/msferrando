<?php
    include("./admin/connection.php");
    date_default_timezone_set('Asia/Manila');

    if (isset($_POST['select_course'])) {
        $course = $_POST['course'];
    
        $query = mysqli_query($conn, "SELECT * FROM tbl_schedule WHERE sched_course = '$course' AND sched_status_website = 1 ORDER BY sched_id DESC");
        $rows = mysqli_num_rows($query);
        echo '
            <div class="u-form-group u-form-select u-form-group-6">
                <label for="select-2419" class="u-label">Select Available Schedule:</label>
                <div class="u-form-select-wrapper">
                <select id="sched_id" name="select" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white">';
                while($data = mysqli_fetch_array($query)) {
                    $sched_id = $data['sched_id'];
                    $count_student = mysqli_query($conn, "SELECT * FROM tbl_student WHERE sched_id = $sched_id");
                    $total_students = mysqli_num_rows($count_student);
                    if ($total_students === 10) {
                        $disabled = 'disabled';
                    } else {
                        $disabled = '';
                    }
                    echo '<option '.$disabled.' value="'.$data['sched_id'].'">'.$data['sched_description'].' (₱'.$data['sched_price'].') ('.$total_students.' Students Enrolled)</option>';
                }
                    if ($rows == 0) {
                        echo '
                        <option value="" disabled selected>No Schedule Available!!</option
                        ';
                    }
                echo '
                </select>
                </div>
            </div>
        ';
        
      }

    if (isset($_POST['submit_info'])) {
        $sched_id = $_POST['sched_id'];
        $stud_name = $_POST['stud_name'];
        $stud_email_address = $_POST['stud_email_address'];
        $stud_contact = $_POST['stud_contact'];
        $stud_birthdate = $_POST['stud_birthdate'];
        $stud_address = $_POST['stud_address'];

        $count_student = mysqli_query($conn, "SELECT * FROM tbl_student WHERE sched_id = $sched_id");
        $total_students = mysqli_num_rows($count_student);
        if ($total_students === 10) {
            echo 'sobranasa10';
        } else {
            $result = mysqli_query($conn, "INSERT INTO tbl_student (sched_id, stud_date_created, stud_name, stud_email_address, stud_contact, stud_address, stud_birthdate) VALUES ('$sched_id', NOW(), '$stud_name', '$stud_email_address', '$stud_contact', '$stud_address', '$stud_birthdate')");
            if ($result) {
                echo 'success';
            }
        }
    }

    if (isset($_POST['show_tdc'])) {
        $stud_name = $_POST['stud_name'];
        $stud_email_address = $_POST['stud_email_address'];
        $stud_contact = $_POST['stud_contact'];
        $stud_birthdate = $_POST['stud_birthdate'];
        $stud_address = $_POST['stud_address'];

        echo '
        <h4 align="center">15 Theoretical Driving Course (TDC)</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="card-box">
                    <h4 class="header-title mb-3">Student Information</h4>
                    <label>Student Name: '.$stud_name.'</label><br>
                    <label>Email Address: '.$stud_email_address.'</label><br>
                    <label>Contact Number: '.$stud_contact.'</label><br>
                    <label>Birthdate: '.$stud_birthdate.'</label><br>
                    <label>Address: '.$stud_address.'</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-box">
                    <h4 class="header-title mb-3">Select Schedule</h4>
                    <label>Reminder: You can select any schedule but please follow the day!! <br> First Day (Tuesday,Thursday,Saturday) <br> Second Day (Wednesday,Friday,Sunday) <br> No operation on MONDAY..</label>
                    <form >
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Day:</label>
                            <input type="date" class="form-control" id="tdc_first_day" onchange="myFunction()">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Second Day:</label>
                            <input type="date" disabled class="form-control" id="tdc_second_day" onchange="myFunctions()">
                        </div>
                        <input type="button" class="btn btn-success float-right" value="Submit Application" onclick="save_application()">
                    </form>
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
            $("#tdc_second_day  ").attr("min", minDate);
        });
        </script>
        ';
    }
    
    if (isset($_POST['day1'])) {
        $tdc_first_day = $_POST['tdc_first_day'];

        $result_max = mysqli_query($conn, "SELECT max_tdc_stud FROM tbl_maxstud");
        $data = mysqli_fetch_assoc($result_max);
        $max_tdc_stud = $data['max_tdc_stud'];

        $count_day1 = mysqli_query($conn, "SELECT tdc_id FROM tbl_tdc WHERE tdc_first_day = '$tdc_first_day'");
        $total_day1 = mysqli_num_rows($count_day1);
        if ($total_day1 == $max_tdc_stud) {
            echo 'sobra';
        }
    }

    if (isset($_POST['day2'])) {
        $tdc_second_day = $_POST['tdc_second_day'];

        $result_max = mysqli_query($conn, "SELECT max_tdc_stud FROM tbl_maxstud");
        $data = mysqli_fetch_assoc($result_max);
        $max_tdc_stud = $data['max_tdc_stud'];

        $count_day2 = mysqli_query($conn, "SELECT tdc_id FROM tbl_tdc WHERE tdc_second_day = '$tdc_second_day'");
        $total_day2 = mysqli_num_rows($count_day2);
        if ($total_day2 == $max_tdc_stud) {
            echo 'sobra';
        }
    }

    if (isset($_POST['save_application'])) {
        $stud_name = $_POST['stud_name'];
        $stud_email_address = $_POST['stud_email_address'];
        $stud_contact = $_POST['stud_contact'];
        $stud_birthdate = $_POST['stud_birthdate'];
        $stud_address = $_POST['stud_address'];
        $tdc_first_day = $_POST['tdc_first_day'];
        $tdc_second_day = $_POST['tdc_second_day'];

        $result = mysqli_query($conn, "INSERT INTO tbl_student (stud_date_created,stud_name,stud_email_address,stud_password,stud_contact_number,stud_address,stud_birthdate) VALUES (NOW(),'$stud_name','$stud_email_address','0','$stud_contact','$stud_address','$stud_birthdate')");
        $stud_id = $conn->insert_id;
        if ($result) {
            $insert_schedule = mysqli_query($conn, "INSERT INTO tbl_tdc (stud_id, tdc_first_day, tdc_second_day) VALUES ('$stud_id', '$tdc_first_day', '$tdc_second_day')");
            if ($insert_schedule) {
                echo 'success';
            }
        }
    }

    mysqli_close($conn);
?>