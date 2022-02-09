
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
          <div class="col-md-12">
              <div class="card-box">
                  <h4 class="header-title mb-3">TDC Settings</h4>
                  
                  <form class="form-horizontal" >
                      <div class="form-group row">
                          <label for="inputEmail3" class="col-3 col-form-label">TDC Description:</label>
                          <?php 
                            $query_price = mysqli_query($conn, "SELECT * FROM tbl_tdc_price");
                            $data = mysqli_fetch_assoc($query_price);
                            $tdc_price = $data['tdc_price'];
                            $tdc_desc = $data['tdc_desc'];
                          ?>
                          <div class="col-9">
                              <textarea name="" id="tdc_pricing" cols="30" rows="10"><?=$tdc_desc;?></textarea>
                          </div>
                      </div>
                  </form>
                  <form class="form-horizontal" >
                      <div class="form-group row">
                          <label for="inputEmail3" class="col-3 col-form-label">Max Student:</label>
                          <?php 
                            $query_max = mysqli_query($conn, "SELECT * FROM tbl_maxstud");
                            $data = mysqli_fetch_assoc($query_max);
                            $max_tdc_stud = $data['max_tdc_stud'];
                          ?>
                          <div class="col-4">
                              <input type="number" class="form-control" id="max_tdc_stud" placeholder="Max Student" value="<?=$max_tdc_stud;?>">
                          </div>
                      </div>
                  </form>
                  <div class="form-group mb-0 row">
                      <div class="offset-3 col-9">
                          <button type="submit" class="btn btn-success waves-effect waves-light" onclick="update_tdc_settings()">Update Changes</button>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <!--End This part for the list of all patients -->
        <!-- end row -->
      <!-- For the modal -->
      <?php include './dashboard_modal.php'; ?>
      <!--End For the modal -->

  <script src="../assets/jquery.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'tdc_pricing', {
        customConfig: '/ckeditor/config.js'
    } );
	// note = CKEDITOR.instances.note.getData(); // get the note
	</script>
  <script type="text/javascript">
    function update_tdc_settings() {
      // tdc_price = document.getElementById("tdc_price").value;
      tdc_pricing = CKEDITOR.instances.tdc_pricing.getData();
      max_tdc_stud = document.getElementById("max_tdc_stud").value;

      // alert(tdc_pricing);
      if (confirm('Are you sure?')) {
        $.ajax({
          url: 'dashboard_query.php',
          type: 'POST',
          async: false,
          data:{
            tdc_pricing:tdc_pricing,
            max_tdc_stud:max_tdc_stud,
            update_tdc_settings: 1,
          },
              success: function(response){
                if (response == 'success') {
                  alert('Settings Successfully Update!!');
                  location.reload();
                }
              }
          });
      }
    }
          
  </script>
