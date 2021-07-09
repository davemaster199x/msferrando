<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['save_technologist'])) {
      $technologist_name = $_POST['technologist_name'];
      $technologist_lic_no = $_POST['technologist_lic_no'];
      $technologist_category = $_POST['technologist_category'];

      $results = mysqli_query($conn, "INSERT INTO tbl_technologist (technologist_name, technologist_category, technologist_lic_no, technologist_date_created) VALUES ('$technologist_name', '$technologist_category', '$technologist_lic_no', NOW())");
      if ($results) {
          echo 'success';
      }
  }

  if (isset($_POST['technologist'])) {

      echo '
      <script>
      $(function () {
        $("#datatable").DataTable()
      })
      </script>
      <div class="col-12">
          <div class="card-box table-responsive">
              <h4 class="header-title">List of all Technologist
                <div class="float-right">
                  <button  type="button" class="btn btn-icon waves-effect waves-light btn-success" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-plus"></i> Add Technologist</button>
                </div>
              </h4>

              <br>
              <table id="datatable" class="table table-bordered  dt-responsive nowrap table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                  <thead>
                  <tr>
                      <th>No.</th>
                      <th>Technologist Name</th>
                      <th class="text-center">Technologist Lic No.</th>
                      <th class="text-center">Technologist Category</th>
                      <th class="text-center">Actions</th>
                  </tr>
                  </thead>
                  <tbody>';
                  $count = 1;
                  $query = mysqli_query($conn, "SELECT * FROM tbl_technologist ORDER BY technologist_category");
                  while($data = mysqli_fetch_array($query)) {
                    echo '
                    <tr>
                        <td>'.$count++.'</td>
                        <td>'.$data['technologist_name'].'</td>
                        <td class="text-center">'.$data['technologist_lic_no'].'</td>
                        <td class="text-center">'.$data['technologist_category'].'</td>
                        <td class="text-center">
                        <button type="button" class="btn btn-icon waves-effect waves-light btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm-update" id="'.$data['technologist_id'].'" onclick="show_update_technologist(this.id)"> <i class="far fa-edit"></i> </button>
                        <button type="button" class="btn btn-icon waves-effect waves-light btn-danger" id="'.$data['technologist_id'].'" onclick="delete_techonologist(this.id)"> <i class="fas fa-times"></i> </button>
                        </td>
                    </tr>
                    ';
                  }
                  echo '
                  </tbody>
              </table>
          </div>
      </div>
    </div>
      ';
  }

  if (isset($_POST['delete_techonologist'])) {
      $technologist_id = $_POST['technologist_id'];

      $results = mysqli_query($conn, "DELETE FROM tbl_technologist WHERE technologist_id = $technologist_id");
      if ($results) {
          echo 'success';
      }
  }

  if (isset($_POST['show_update_technologist'])) {
      $technologist_id = $_POST['technologist_id'];

      $query = mysqli_query($conn, "SELECT * FROM tbl_technologist WHERE technologist_id = $technologist_id");
      while($data = mysqli_fetch_array($query)) {
        $technologist_category = $data['technologist_category'];
        echo '
        <div class="row">
          <div class="col-12">
            <label>Technologist Name:</label>
            <input type="text" class="form-control" value="'.$data['technologist_name'].'" id="technologist_name_update">
          </div>
          <div class="col-12">
            <label>Technologist Lic No:</label>
            <input type="text" class="form-control" value="'.$data['technologist_lic_no'].'" id="technologist_lic_no_update">
          </div>
          <div class="col-12">
            <label>Technologist Category:</label>
            <select class="form-control" id="technologist_category_update">
              <option disabled selected value=""></option>
              <option value="Chief Medical Technologist" '; if($technologist_category == 'Chief Medical Technologist') { echo 'selected'; } echo '>Chief Medical Technologist</option>
              <option value="Medical Technologist" '; if($technologist_category == 'Medical Technologist') { echo 'selected'; } echo '>Medical Technologist</option>
            </select>
          </div>
        </div><br>
          <div class="float-right">
            <button type="button" class="btn btn-success" id="'.$data['technologist_id'].'" onclick="update_technologist(this.id)">Update</button>
          </div>
        ';
      }
  }

  if (isset($_POST['update_technologist'])) {
      $technologist_id = $_POST['technologist_id'];
      $technologist_name = $_POST['technologist_name'];
      $technologist_lic_no = $_POST['technologist_lic_no'];
      $technologist_category = $_POST['technologist_category'];

      $results = mysqli_query($conn, "UPDATE tbl_technologist SET technologist_name = '$technologist_name', technologist_lic_no = '$technologist_lic_no', technologist_category = '$technologist_category' WHERE technologist_id = $technologist_id");
      if ($results) {
          echo 'success';
      }
  }
  mysqli_close($conn);
 ?>
