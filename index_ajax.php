<?php
    include("./admin/connection.php");
    date_default_timezone_set('Asia/Manila');

    if (isset($_POST['show_tdc'])) {
        $stud_name = $_POST['stud_name'];
        $stud_email_address = $_POST['stud_email_address'];
        $stud_contact = $_POST['stud_contact'];
        $stud_birthdate = $_POST['stud_birthdate'];
        $stud_address = $_POST['stud_address'];

        $result_tdc_price = mysqli_query($conn, "SELECT * FROM tbl_tdc_price");
        $data = mysqli_fetch_assoc($result_tdc_price);
        $tdc_price = $data['tdc_price'];
        $tdc = number_format($tdc_price);
        echo '
        <h4 align="center">15 Theoretical Driving Course (TDC) @<label style="color: red;">'.$tdc.'</label></h4>
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
                    <label>You can select any schedule but please follow the DAY SIMULTANEOUSLY!! <br> First Day (Monday,Thursday) <br> Second Day (Tuesday,Friday) <br> Third Day (Wednesday,Saturday) <br> No OPERATION on SUNDAY..</label>
                    <form >
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Day:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="tdc_first_day" onchange="first_day()">
                                </div>
                                <div class="col-md-6">
                                    <select id="tdc_first_time" class="form-control" disabled onchange="first_time()">
                                        <option disabled selected>-Select Time-</option>
                                        <option value="am">AM</option>
                                        <option value="pm">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Second Day:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="tdc_second_day" disabled onchange="second_day()">
                                </div>
                                <div class="col-md-6">
                                    <select id="tdc_second_time" class="form-control" disabled onchange="second_time()">
                                        <option disabled selected>-Select Time-</option>
                                        <option value="am">AM</option>
                                        <option value="pm">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Third Day:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="tdc_third_day" disabled onchange="third_day()">
                                </div>
                                <div class="col-md-6">
                                    <select id="tdc_third_time" class="form-control" disabled onchange="third_time()">
                                        <option disabled selected>-Select Time-</option>
                                        <option value="am">AM</option>
                                        <option value="pm">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <label id="reminder" style="display: none;">Please take a screenshot or picture for the following 3 days Schedule for you Reference!! Thank you.</label>
                        <input type="button" class="btn btn-danger float-left" value="Reset Schedule" onclick="reset_schedule()">
                        <input type="button" class="btn btn-success float-right" value="Submit Application" onclick="save_application()" disabled id="show_application">
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

    if (isset($_POST['save_application'])) {
        $stud_name = $_POST['stud_name'];
        $stud_email_address = $_POST['stud_email_address'];
        $stud_contact = $_POST['stud_contact'];
        $stud_birthdate = $_POST['stud_birthdate'];
        $stud_address = $_POST['stud_address'];

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

        if ($day1 == '' && $day2 == '' && $day3 == '') {
            $result = mysqli_query($conn, "INSERT INTO tbl_student (stud_date_created,stud_name,stud_email_address,stud_password,stud_contact_number,stud_address,stud_birthdate) VALUES (NOW(),'$stud_name','$stud_email_address','0','$stud_contact','$stud_address','$stud_birthdate')");
            $stud_id = $conn->insert_id;
            if ($result) {
                $insert_schedule = mysqli_query($conn, "INSERT INTO tbl_tdc (stud_id, tdc_first_day, tdc_first_time, tdc_second_day, tdc_second_time, tdc_third_day, tdc_third_time, tdc_created) VALUES ('$stud_id', '$tdc_first_day', '$tdc_first_time', '$tdc_second_day', '$tdc_second_time', '$tdc_third_day', '$tdc_third_time', NOW())");
                if ($insert_schedule) {
                    echo 'success';
                }
            }
        } else{
            echo $day1.''.$day2.''.$day3;
        }
    }

    mysqli_close($conn);
?>