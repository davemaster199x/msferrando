<?php
    include("./admin/connection.php");
    date_default_timezone_set('Asia/Manila');

    if (isset($_POST['select_course'])) {
        $course = $_POST['course'];
    
        $query = mysqli_query($conn, "SELECT * FROM tbl_schedule WHERE sched_course = '$course' AND sched_status = 1");
        echo '
            <div class="u-form-group u-form-select u-form-group-6">
                <label for="select-2419" class="u-label">Select Available Schedule:</label>
                <div class="u-form-select-wrapper">
                <select id="sched_id" name="select" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-radius-18 u-white">';
                while($data = mysqli_fetch_array($query)) {
                    echo '<option value="'.$data['sched_id'].'">'.$data['sched_description'].'</option>';
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

        $result = mysqli_query($conn, "INSERT INTO tbl_student (sched_id, stud_date_created, stud_name, stud_email_address, stud_contact, stud_address, stud_birthdate) VALUES ('$sched_id', NOW(), '$stud_name', '$stud_email_address', '$stud_contact', '$stud_address', '$stud_birthdate')");
        if ($result) {
            echo 'success';
        }
    }

?>