
        <?php
        $where = '';
        if (isset($_REQUEST['myInput']) && $_REQUEST['myInput'] != '') {
          $where = "WHERE firstname LIKE '%".$_REQUEST['myInput']."%'";
        }
        $tableid = 'userid';
        $table = 'user';
        include('include/pagination.php');

        // $total_student = '';
        // $total_done = '';
        // $total_in_progress = '';
  
        // $results_total = mysqli_query($conn, "SELECT Count(tbl_student.stud_id) AS total_student FROM tbl_student");
        // $data_total = mysqli_fetch_assoc($results_total);
        // $total_student = $data_total['total_student'];
  
        // $results_done = mysqli_query($conn, "SELECT Count(tbl_student.stud_id) AS total_done FROM tbl_student WHERE stud_status = 1");
        // $data_done = mysqli_fetch_assoc($results_done);
        // $total_done = $data_done['total_done'];
  
        // $results_pending = mysqli_query($conn, "SELECT Count(tbl_student.stud_id) AS total_in_progress FROM tbl_student WHERE stud_status = 0");
        // $data_pending = mysqli_fetch_assoc($results_pending);
        // $total_in_progress = $data_pending['total_in_progress'];
        
        ?>
        <!-- This part for the total patients -->
        <div class="row">
          <div class="col-xl-4 col-sm-4">
            <div class="card-box widget-box-two widget-two-custom">
                <div class="media">
                    <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                        <i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
                    </div>

                    <div class="wigdet-two-content media-body">
                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total Students</p>
                        <h3 class="font-weight-medium my-2"><span data-plugin="counterup"><?=number_format($total_student)?></span></h3>
                    </div>
                </div>
            </div>
        </div>

          <div class="col-xl-4 col-sm-4">
            <div class="card-box widget-box-two widget-two-custom ">
                <div class="media">
                    <div class="avatar-lg rounded-circle bg-info widget-two-icon align-self-center">
                      <i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
                    </div>

                    <div class="wigdet-two-content media-body">
                      <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total Students Done</p>
                      <h3 class="font-weight-medium my-2"> <span data-plugin="counterup"><?=number_format($total_done)?></span></h3>
                    </div>
                  </div>
                </div>
              </div>

            <div class="col-xl-4 col-sm-4">
              <div class="card-box widget-box-two widget-two-custom ">
                <div class="media">
                  <div class="avatar-lg rounded-circle bg-warning widget-two-icon align-self-center">
                    <i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
                  </div>

                  <div class="wigdet-two-content media-body">
                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total Students In Progress</p>
                    <h3 class="font-weight-medium my-2"><span data-plugin="counterup"><?=number_format($total_in_progress)?></span></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--End  This part for the total patients -->

        <!-- This part for the list of all patients -->
        <div class="row">
          <div class="col-12">
            <div class="card-box table-responsive">
                <h4 class="header-title">List of All Enrolled Students
                  <div class="float-right">
                    <button  type="button" class="btn btn-icon waves-effect waves-light btn-success" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-plus"></i> Add Schedule</button>
                  </div>
                </h4>

                <br>
                <label style="margin-top: 13px;">Total: <label id="total_search">20</label> / <?=number_format($rows);?></label>
                <div id="search_loading" style="display: none;" class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <input style="width: 200px; float: right; margin-bottom: 5px;" id="myInput" name="myInput" type="text" class="form-control" placeholder="Search.." value="<?php echo (isset($_POST['myInput']) && $_POST['myInput'] != '' ? $_POST['myInput'] : '');?>">
                <table class="table table-bordered table-hover">
                  <thead>
                    <th width="5%">User ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Username</th>
                  </thead>
                  <tbody id="myTable">
                  <?php
                    while($crow = mysqli_fetch_array($nquery)){
                    ?>
                      <tr>
                        <td><?php echo $crow['userid']; ?></td>
                        <td><?php echo $crow['firstname']; ?></td>
                        <td><?php echo $crow['lastname']; ?></td>
                        <td><?php echo $crow['username']; ?></td>
                      </tr>
                    <?php
                    }		
                  ?>
                  </tbody>
                </table>
                <div id="pagination_controls" style="float: right;"><?php echo $paginationCtrls; ?></div>
            </div>
          </div>
        </div>
        <!--End This part for the list of all patients -->
        <!-- end row -->
      <!-- For the modal -->
      <?php include './dashboard_modal.php'; ?>
      <!--End For the modal -->

      <script src="../assets/jquery.min.js"></script>
      <script type="text/javascript">
          $(document).ready(function(){
            $("#myInput").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              $("#myTable tr").filter(function() {
                var rowCount = $("#myTable tr:visible").length;
                document.getElementById("total_search").innerHTML = rowCount;
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
            });
          });

          document.getElementById("myInput").onkeypress = function(event){
            if (event.keyCode == 13 || event.which == 13){
              // document.getElementById("myInput").submit();
            }
          };
          
      </script>
