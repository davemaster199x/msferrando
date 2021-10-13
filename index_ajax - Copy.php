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
                    <h4 class="header-title mb-3"align="center">Select Schedule</h4>
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
                    </center>
                    <hr>
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

    mysqli_close($conn);
?>