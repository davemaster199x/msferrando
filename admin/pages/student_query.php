<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['save_student'])) {
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

  if (isset($_POST['delete_student'])) {
    $stud_id = $_POST['stud_id'];

    $result = mysqli_query($conn, "DELETE FROM tbl_student WHERE stud_id = $stud_id");
    if ($result) {
        echo 'success';
    }
  }

  if (isset($_POST['show_update_student'])) {
    $stud_id = $_POST['stud_id'];

    $query = mysqli_query($conn, "SELECT * FROM tbl_student WHERE stud_id = $stud_id");
    $data = mysqli_fetch_assoc($query);
    $sched_id = $data['sched_id'];
    $stud_name = $data['stud_name'];
    $stud_email_address = $data['stud_email_address'];
    $stud_contact = $data['stud_contact'];
    $stud_birthdate = $data['stud_birthdate'];
    $stud_address = $data['stud_address'];
    $stud_status = $data['stud_status'];
    $stud_payment = $data['stud_payment'];
    $stud_notes = $data['stud_notes'];
    echo '
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-1" class="control-label">Select Schedule:</label>
                <input type="hidden" class="form-control" id="stud_id_update" value="'.$stud_id.'">
                <input type="hidden" class="form-control" id="sched_id_temp" value="'.$sched_id.'">
                <select id="sched_id_update" class="form-control">';
                    echo '<option></option>';
                $query_schedule = mysqli_query($conn, "SELECT * FROM tbl_schedule WHERE sched_status = 1 ORDER BY sched_id DESC");
                while($data_schedule = mysqli_fetch_array($query_schedule)) {
                    echo '<option value="'.$data_schedule['sched_id'].'" '; if($data_schedule['sched_id'] === $sched_id) { echo 'selected'; } echo'>'.$data_schedule['sched_description'].' (₱'.$data_schedule['sched_price'].')</option>';
                }
                echo '
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="field-1" class="control-label">Student Status:</label>
                <select id="stud_status_update" class="form-control">
                    <option value="1"'; if($stud_status == 1) { echo 'selected'; } echo '>Done</option>
                    <option value="0"'; if($stud_status == 0) { echo 'selected'; } echo '>In Progress</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="field-1" class="control-label">Student Payment:</label>
                <select id="stud_payment_update" class="form-control">
                    <option value="0"'; if($stud_payment == 0) { echo 'selected'; } echo '>Receivable</option>
                    <option value="1"'; if($stud_payment == 1) { echo 'selected'; } echo '>Partially Paid</option>
                    <option value="2"'; if($stud_payment == 2) { echo 'selected'; } echo '>Fully Paid</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="field-1" class="control-label">Student Name:</label>
                <input type="text" class="form-control" id="stud_name_update" value="'.$stud_name.'">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="field-1" class="control-label">Student Email:</label>
                <input type="text" class="form-control" id="stud_email_address_update" value="'.$stud_email_address.'">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="field-1" class="control-label">Student Contact:</label>
                <input type="text" class="form-control" id="stud_contact_update" value="'.$stud_contact.'">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="field-1" class="control-label">Student Birthdate:</label>
                <input type="date" class="form-control" id="stud_birthdate_update" value="'.$stud_birthdate.'">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-1" class="control-label">Student Address:</label>
                <textarea id="stud_address_update" class="form-control" cols="30" rows="4">'.$stud_address.'</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-1" class="control-label">Notes:</label>
                <textarea id="stud_notes_update" class="form-control" cols="30" rows="6">'.$stud_notes.'</textarea>
            </div>
        </div>
    </div>
    ';
    }

    if (isset($_POST['update_student'])) {
        $stud_id = $_POST['stud_id'];
        $sched_id = $_POST['sched_id'];
        $stud_status = $_POST['stud_status'];
        $stud_payment = $_POST['stud_payment'];
        $stud_name = $_POST['stud_name'];
        $stud_email_address = $_POST['stud_email_address'];
        $stud_contact = $_POST['stud_contact'];
        $stud_birthdate = $_POST['stud_birthdate'];
        $stud_address = $_POST['stud_address'];
        $stud_notes = $_POST['stud_notes'];
    
        $result = mysqli_query($conn, "UPDATE tbl_student SET sched_id = '$sched_id', stud_status = '$stud_status', stud_payment = '$stud_payment', stud_name = '$stud_name', stud_email_address = '$stud_email_address', stud_contact = '$stud_contact', stud_birthdate = '$stud_birthdate', stud_address = '$stud_address', stud_notes = '$stud_notes' WHERE stud_id = '$stud_id'");
        if ($result) {
            echo 'success';
        }
      }
  
  mysqli_close($conn);
 ?>
