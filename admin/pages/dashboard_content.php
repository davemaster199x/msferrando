
        <?php
        $total_student = '';
        $total_done = '';
        $total_in_progress = '';
  
        $results_total = mysqli_query($conn, "SELECT Count(tbl_student.stud_id) AS total_student FROM tbl_student");
        $data_total = mysqli_fetch_assoc($results_total);
        $total_student = $data_total['total_student'];
  
        $results_done = mysqli_query($conn, "SELECT Count(tbl_student.stud_id) AS total_done FROM tbl_student INNER JOIN tbl_tdc ON tbl_student.stud_id = tbl_tdc.stud_id WHERE tdc_stud_status = 2");
        $data_done = mysqli_fetch_assoc($results_done);
        $total_done = $data_done['total_done'];
  
        $results_pending = mysqli_query($conn, "SELECT Count(tbl_student.stud_id) AS total_in_progress FROM tbl_student INNER JOIN tbl_tdc ON tbl_student.stud_id = tbl_tdc.stud_id WHERE tdc_stud_status = 1");
        $data_pending = mysqli_fetch_assoc($results_pending);
        $total_in_progress = $data_pending['total_in_progress'];
        
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
            
          </div>
        </div>
        <!--End This part for the list of all patients -->
        <!-- end row -->
      <!-- For the modal -->
      <?php include './dashboard_modal.php'; ?>
      <!--End For the modal -->

  <script src="../assets/jquery.min.js"></script>
  <script type="text/javascript">
    
          
  </script>
