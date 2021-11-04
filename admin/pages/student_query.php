<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['save_student'])) {
    $stud_name = mysqli_real_escape_string($conn, $_POST['stud_name']);
    $stud_email_address = mysqli_real_escape_string($conn, $_POST['stud_email_address']);
    $stud_password = mysqli_real_escape_string($conn, $_POST['stud_password']);
    $stud_contact = mysqli_real_escape_string($conn, $_POST['stud_contact']);
    $stud_birthdate = $_POST['stud_birthdate'];
    $stud_address = mysqli_real_escape_string($conn, $_POST['stud_address']);

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
    $stud_name = $data['stud_name'];
    $stud_email_address = $data['stud_email_address'];
    $stud_password = $data['stud_password'];
    $stud_contact_number = $data['stud_contact_number'];
    $stud_birthdate = $data['stud_birthdate'];
    $stud_address = $data['stud_address'];
    echo '
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="field-1" class="control-label">Student Name:</label>
                <input type="hidden" class="form-control" id="stud_id_update" value="'.$stud_id.'">
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
                <label for="field-1" class="control-label">Student Password:</label>
                <input type="password" class="form-control" id="stud_password_update" value="'.$stud_password.'">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="field-1" class="control-label">Show Password</label><br>
                <input type="checkbox" onclick="myFunctions()" > 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="field-1" class="control-label">Student Contact:</label>
                <input type="number" class="form-control" id="stud_contact_number_update" value="'.$stud_contact_number.'">
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
    ';
    }

    if (isset($_POST['update_student'])) {
        $stud_id = $_POST['stud_id'];
        $stud_name = mysqli_real_escape_string($conn, $_POST['stud_name']);
        $stud_email_address = mysqli_real_escape_string($conn, $_POST['stud_email_address']);
        $stud_password = mysqli_real_escape_string($conn, $_POST['stud_password']);
        $stud_contact_number = mysqli_real_escape_string($conn, $_POST['stud_contact_number']);
        $stud_birthdate = $_POST['stud_birthdate'];
        $stud_address = mysqli_real_escape_string($conn, $_POST['stud_address']);
    
        $result = mysqli_query($conn, "UPDATE tbl_student SET stud_name = '$stud_name', stud_email_address = '$stud_email_address', stud_password = '$stud_password', stud_contact_number = '$stud_contact_number', stud_birthdate = '$stud_birthdate', stud_address = '$stud_address' WHERE stud_id = '$stud_id'");
        if ($result) {
            echo 'success';
        }
      }
  
  mysqli_close($conn);
 ?>
