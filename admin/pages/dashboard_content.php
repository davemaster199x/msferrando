
        <?php
        $total_student = '';
        $total_done = '';
        $total_in_progress = '';
  
        $results_total = mysqli_query($conn, "SELECT Count(tbl_student.stud_id) AS total_student FROM tbl_student");
        $data_total = mysqli_fetch_assoc($results_total);
        $total_student = $data_total['total_student'];
  
        $results_done = mysqli_query($conn, "SELECT Count(tbl_student.stud_id) AS total_done FROM tbl_student WHERE stud_status = 1");
        $data_done = mysqli_fetch_assoc($results_done);
        $total_done = $data_done['total_done'];
  
        $results_pending = mysqli_query($conn, "SELECT Count(tbl_student.stud_id) AS total_in_progress FROM tbl_student WHERE stud_status = 0");
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
            <div class="card-box table-responsive">
                <h4 class="header-title">List of All Schedule
                  <div class="float-right">
                    <button  type="button" class="btn btn-icon waves-effect waves-light btn-success" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-plus"></i> Add Schedule</button>
                  </div>
                </h4>

                <br>
                <table id="datatable" class="table table-bordered dt-responsive nowrap table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Course</th>
                        <th class="text-center">Schedule Description</th>
                        <th class="text-center">Schedule Price</th>
                        <th class="text-center"># of Students</th>
                        <th class="text-center">Date Created</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $count = 1;
                        $query = mysqli_query($conn, "SELECT * FROM tbl_schedule ORDER BY sched_id DESC");
                        while($data = mysqli_fetch_array($query)) {
                      ?>
                      <tr style="cursor: pointer;">
                          <td><?=$count++?></td>
                          <td><?=$data['sched_course']?></td>
                          <td class="text-center"><?=$data['sched_description']?></td>
                          <td class="text-center">₱ <?=number_format($data['sched_price'])?></td>
                          <td class="text-center">1</td>
                          <td class="text-center"><?=date("F d, Y",strtotime($data['sched_date_created']))?></td>
                          <td class="text-center" id="<?=$data['sched_id']?>,<?=$data['sched_status']?>" onclick="update_status(this.id)">
                            <?php 
                            $status = $data['sched_status'];
                            if ($status == 0) {
                              echo '<span class="badge label-table badge-warning">Inactive</span>';
                            } else {
                              echo '<span class="badge label-table badge-success">Active</span>';
                            }
                            ?>
                          </td>
                          <td class="text-center">
                          <button type="button" class="btn btn-icon waves-effect waves-light btn-primary" data-toggle="modal" data-target="#update-schedule-modal" id="<?=$data['sched_id']?>" onclick="show_update_schedule(this.id)"> <i class="far fa-edit"></i> </button>
                          <button type="button" class="btn btn-icon waves-effect waves-light btn-danger" id="<?=$data['sched_id']?>" onclick="delete_schedule(this.id)"> <i class="fas fa-times"></i> </button>
                          </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                </table>
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
          function save_schedule() {
            sched_description = document.getElementById("sched_description").value;
            sched_course = document.getElementById("sched_course").value;
            sched_price = document.getElementById("sched_price").value;

            if (sched_description == '' || sched_course == '' || sched_price == '') {
              alert('Please fill up all Schedule Information!!');
            } else {
              $.ajax({
                  url: 'dashboard_query.php',
                  type: 'POST',
                  async: false,
                  data:{
                      sched_description:sched_description,
                      sched_course:sched_course,
                      sched_price:sched_price,
                      save_schedule: 1,
                  },
                      success: function(response){
                        if (response == 'success') {
                          alert('Schedule Successfully Added!!');
                          location.reload();
                        }
                      }
                });
            }
          }

          function delete_schedule(id) {
            if (confirm('Are you sure?')) {
              $.ajax({
                  url: 'dashboard_query.php',
                  type: 'POST',
                  async: false,
                  data:{
                    sched_id:id,
                    delete_schedule: 1,
                  },
                      success: function(response){
                        if (response == 'success') {
                          alert('Schedule Successfully Deleted!!');
                          location.reload();
                        }
                      }
                  });
            }
          }

          function show_update_schedule(id) {
            $.ajax({
                url: 'dashboard_query.php',
                type: 'POST',
                async: false,
                data:{
                    sched_id:id,
                    show_update_schedule: 1,
                },
                    success: function(response){
                        $('#show_update_schedule').html(response);
                    }
                });
          }


          function update_schedule() {
            sched_id = document.getElementById("sched_id_update").value;
            sched_description = document.getElementById("sched_description_update").value;
            sched_course = document.getElementById("sched_course_update").value;
            sched_price = document.getElementById("sched_price_update").value;

            if (confirm('Are you sure?')) {
                  $.ajax({
                    url: 'dashboard_query.php',
                    type: 'POST',
                    async: false,
                    data:{
                        sched_id:sched_id,
                        sched_description:sched_description,
                        sched_course:sched_course,
                        sched_price:sched_price,
                        update_schedule: 1,
                    },
                        success: function(response){
                          if (response == 'success') {
                            alert('Schedule Successfully Updated!!');
                            location.reload();
                          }
                        }
                    });
            }
          }

          function update_status(id) {
            array = id.split(",")
            sched_id = array[0];
            sched_status = array[1];
            if (confirm('Are you sure?')) {
              $.ajax({
                  url: 'dashboard_query.php',
                  type: 'POST',
                  async: false,
                  data:{
                      sched_id:sched_id,
                      sched_status:sched_status,
                      update_status: 1,
                  },
                      success: function(response){
                        if (response == 'success') {
                          alert('Schedule Status Successfully Updated!!');
                          location.reload();
                        }
                      }
                  });
            }
          }
          
      </script>
