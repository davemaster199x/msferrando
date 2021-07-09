<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['save_test'])) {
      $accutest_name = $_POST['accutest_name'];
      $accutest_price = $_POST['accutest_price'];
      $accutest_category = $_POST['accutest_category'];
      $user_id = $_SESSION['user_id'];

      $results = mysqli_query($conn, "INSERT INTO tbl_accutest (accutest_name, accutest_price, accutest_category, accutest_date_created, user_id) VALUES ('$accutest_name', '$accutest_price', '$accutest_category', NOW(), $user_id)");
      if ($results) {
          echo 'success';
      }
  }

  if (isset($_POST['accutest'])) {

      echo '
      <script>
      $(function () {
        $("#datatable").DataTable()
      })
      </script>
      <div class="col-12">
          <div class="card-box table-responsive">
              <h4 class="header-title">List of all Test
                <div class="float-right">
                  <button  type="button" class="btn btn-icon waves-effect waves-light btn-success" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-plus"></i> Add Test</button>
                </div>
              </h4>

              <br>
              <table id="datatable" class="table table-bordered  dt-responsive nowrap table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                  <thead>
                  <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th class="text-center">Price</th>
                      <th class="text-center">Category</th>
                      <th class="text-center">Date Created</th>
                      <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>';
                  $count = 1;
                  $query = mysqli_query($conn, "SELECT * FROM tbl_accutest ORDER BY accutest_category ASC");
                  while($data = mysqli_fetch_array($query)) {
                    echo '
                    <tr>
                        <td>'.$count++.'</td>
                        <td>'.$data['accutest_name'].'</td>
                        <td class="text-center">₱ '.number_format($data['accutest_price']).'</td>
                        <td class="text-center">'.$data['accutest_category'].'</td>
                        <td class="text-center">'.$data['accutest_date_created'].'</td>
                        <td class="text-center">
                        <button type="button" class="btn btn-icon waves-effect waves-light btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm-update" id="'.$data['accutest_id'].'" onclick="show_update_test(this.id)"> <i class="far fa-edit"></i> </button>
                        <button type="button" class="btn btn-icon waves-effect waves-light btn-danger" id="'.$data['accutest_id'].'" onclick="delete_test(this.id)"> <i class="fas fa-times"></i> </button>
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

  if (isset($_POST['delete_test'])) {
      $accutest_id = $_POST['accutest_id'];

      $results = mysqli_query($conn, "DELETE FROM tbl_accutest WHERE accutest_id = $accutest_id");
      if ($results) {
          echo 'success';
      }
  }

  if (isset($_POST['show_update_test'])) {
      $accutest_id = $_POST['accutest_id'];

      $query = mysqli_query($conn, "SELECT * FROM tbl_accutest WHERE accutest_id = $accutest_id");
      while($data = mysqli_fetch_array($query)) {
        $accutest_category = $data['accutest_category'];
        echo '
        <div class="row">
          <div class="col-12">
            <label>Test Name:</label>
            <input type="text" class="form-control" value="'.$data['accutest_name'].'" id="accutest_name_update">
          </div>
          <div class="col-12">
            <label>Test Price:</label>
            <input type="number" class="form-control" value="'.$data['accutest_price'].'" id="accutest_price_update">
          </div>
          <div class="col-12">
            <label>Category:</label>
            <select class="form-control" id="accutest_category_update">
              <option disabled selected value=""></option>
              <option value="Hematology" '; if($accutest_category == 'Hematology') { echo 'selected'; } echo '>Hematology</option>
              <option value="Immunology-Serology"'; if($accutest_category == 'Immunology-Serology') { echo 'selected'; } echo ' >Immunology-Serology</option>
              <option value="Clinical Microscopy"'; if($accutest_category == 'Clinical Microscopy') { echo 'selected'; } echo ' >Clinical Microscopy</option>
              <option value="Clinical Chemistry"'; if($accutest_category == 'Clinical Chemistry') { echo 'selected'; } echo ' >Clinical Chemistry</option>
            </select>
          </div>
        </div><br>
          <div class="float-right">
            <button type="button" class="btn btn-success" id="'.$data['accutest_id'].'" onclick="update_test(this.id)">Update</button>
          </div>
        ';
      }
  }

  if (isset($_POST['update_test'])) {
      $accutest_id = $_POST['accutest_id'];
      $accutest_name = $_POST['accutest_name'];
      $accutest_price = $_POST['accutest_price'];
      $accutest_category = $_POST['accutest_category'];

      $results = mysqli_query($conn, "UPDATE tbl_accutest SET accutest_name = '$accutest_name', accutest_price = '$accutest_price', accutest_category = '$accutest_category' WHERE accutest_id = $accutest_id");
      if ($results) {
          echo 'success';
      }
  }
  mysqli_close($conn);
 ?>
