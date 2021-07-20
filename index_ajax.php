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

?>