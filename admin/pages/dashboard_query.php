<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['save_schedule'])) {
    $sched_description = $_POST['sched_description'];
    $sched_course = $_POST['sched_course'];
    $sched_price = $_POST['sched_price'];

    $result = mysqli_query($conn, "INSERT INTO tbl_schedule (sched_description, sched_price, sched_date_created, sched_course) VALUES ('$sched_description', '$sched_price', NOW(), '$sched_course')");
    if ($result) {
        echo 'success';
    }
  }

  if (isset($_POST['delete_schedule'])) {
    $sched_id = $_POST['sched_id'];

    $result = mysqli_query($conn, "DELETE FROM tbl_schedule WHERE sched_id = $sched_id");
    if ($result) {
        echo 'success';
    }
  }
  
  if (isset($_POST['show_update_schedule'])) {
    $sched_id = $_POST['sched_id'];

    $query = mysqli_query($conn, "SELECT * FROM tbl_schedule WHERE sched_id = $sched_id");
    $data = mysqli_fetch_assoc($query);
    $sched_description = $data['sched_description'];
    $sched_course = $data['sched_course'];
    $sched_price = $data['sched_price'];
    echo '
      <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-1" class="control-label">Schedule Description:</label>
                <input type="hidden" id="sched_id_update" value="'.$sched_id.'"></input>
                <textarea class="form-control" id="sched_description_update" cols="30" rows="3">'.$sched_description.'</textarea>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="field-1" class="control-label">Schedule Price:</label>
                <input type="number" class="form-control" id="sched_price_update" value="'.$sched_price.'"></input>
            </div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                  <label for="field-1" class="control-label">Select Course:</label>
                  <select id="sched_course_update" class="form-control"> 
                      <option value="TDC"'; if($sched_course === 'TDC') { echo 'selected'; } echo'>TDC</option>
                      <option value="PDC"'; if($sched_course === 'PDC') { echo 'selected'; } echo' >PDC</option>
                      <option value="Additional Driving"'; if($sched_course === 'Additional Driving') { echo 'selected'; } echo'>Additional Driving</option>
                  </select>
              </div>
          </div>
      </div>
    ';
  }

  if (isset($_POST['update_schedule'])) {
    $sched_id = $_POST['sched_id'];
    $sched_description = $_POST['sched_description'];
    $sched_course = $_POST['sched_course'];
    $sched_price = $_POST['sched_price'];

    $result = mysqli_query($conn, "UPDATE tbl_schedule SET sched_description = '$sched_description', sched_course = '$sched_course', sched_price = '$sched_price' WHERE sched_id = $sched_id");
    if ($result) {
        echo 'success';
    }
  }

  if (isset($_POST['update_status'])) {
    $sched_id = $_POST['sched_id'];
    $sched_status = $_POST['sched_status'];
    if ($sched_status == 0) {
      $status = 1;
    } else {
      $status = 0;
    }

    $results = mysqli_query($conn, "UPDATE tbl_schedule SET sched_status = $status WHERE sched_id = $sched_id");
    if ($results) {
        echo 'success';
    }
  }

  if (isset($_POST['update_status_website'])) {
    $sched_id = $_POST['sched_id'];
    $sched_status_website = $_POST['sched_status_website'];
    if ($sched_status_website == 0) {
      $status = 1;
    } else {
      $status = 0;
    }

    $results = mysqli_query($conn, "UPDATE tbl_schedule SET sched_status_website = $status WHERE sched_id = $sched_id");
    if ($results) {
        echo 'success';
    }
  }

  if (isset($_POST['show_schedule_students'])) {
    $sched_id = $_POST['sched_id'];

    $query1 = mysqli_query($conn, "SELECT * FROM tbl_schedule WHERE sched_id = $sched_id");
    $data = mysqli_fetch_assoc($query1);
    $sched_description = $data['sched_description'];
    $sched_price = $data['sched_price'];
    $sched_course = $data['sched_course'];

    $query = mysqli_query($conn, "SELECT * FROM tbl_student WHERE sched_id = $sched_id ORDER BY stud_name");
    echo '
    <h3 align="center">'.$sched_description.'</h3>
    <h4 align="center">'.$sched_course.' | ₱ '.number_format($sched_price).'</h4>
    <table class="table table-bordered dt-responsive nowrap table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
      <thead>
      <tr>
          <th>No.</th>
          <th>Name</th>
          <th class="text-center">Status</th>
          <th class="text-center">Payment</th>
          <th class="text-center">Action</th>
      </tr>
      </thead>
      <tbody>
    ';
    $count = 1;
    while($data = mysqli_fetch_array($query)) {
      echo '
        <tr>
          <td>'.$count++.'</td>
          <td>'.$data['stud_name'].'</td>
          <td>
            <select id="stud_schedule_status" class="form-control">
                <option value="1"'; if($data['stud_status'] == 1) { echo 'selected'; } echo '>Done</option>
                <option value="0"'; if($data['stud_status'] == 0) { echo 'selected'; } echo '>In Progress</option>
            </select>
          </td>
          <td>
            <select id="stud_schedule_payment" class="form-control">
                <option value="0"'; if($data['stud_payment'] == 0) { echo 'selected'; } echo '>Receivable</option>
                <option value="1"'; if($data['stud_payment'] == 1) { echo 'selected'; } echo '>Partially Paid</option>
                <option value="2"'; if($data['stud_payment'] == 2) { echo 'selected'; } echo '>Fully Paid</option>
            </select>
          </td>
          <td class="text-center">
            <button type="button" class="btn btn-icon waves-effect waves-light btn-primary" id="'.$data['stud_id'].'" onclick="update_stud_schedule(this.id)"> <i class="fas fa-save"></i> </button>
          </td>
        </tr>
      ';
    }
    echo '
      </tbody>
    </table>
    ';
  }

  if (isset($_POST['update_stud_schedule'])) {
    $stud_id = $_POST['stud_id'];
    $stud_status = $_POST['stud_status'];
    $stud_payment = $_POST['stud_payment'];

    $result = mysqli_query($conn, "UPDATE tbl_student SET stud_payment = '$stud_payment', stud_status = '$stud_status' WHERE stud_id = $stud_id");
    if ($result) {
        echo 'success';
    }
  }
  
  mysqli_close($conn);
 ?>
