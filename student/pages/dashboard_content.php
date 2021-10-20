
        <!-- This part for the list of all patients -->
        <div class="row">
          <div class="col-12">
            <div class="card-box table-responsive">
                <h4 class="header-title">Theoretical  Driving Schedule
                  <div class="float-right">
                    <button  type="button" class="btn btn-icon waves-effect waves-light btn-success" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-plus"></i> Add TDC Schedule</button>
                  </div>
                </h4>

                <br>
                <table id="datatable" class="table table-bordered dt-responsive nowrap table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Student Name</th>
                        <th class="text-center">Student Status</th>
                        <th class="text-center">Payment Status</th>
                        <th class="text-center">Schedule Created</th>
                        <th class="text-center">TDC Price</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $count = 1;
                        $stud_id = $_SESSION['stud_id'];
                        $query_tdc = mysqli_query($conn, "SELECT
                                                        tbl_student.stud_name, 
                                                        tbl_tdc.tdc_stud_status, 
                                                        tbl_tdc.tdc_stud_payment_status, 
                                                        tbl_tdc.tdc_created, 
                                                        tbl_tdc.tdc_price
                                                      FROM
                                                        tbl_student
                                                        INNER JOIN
                                                        tbl_tdc
                                                        ON 
                                                          tbl_student.stud_id = tbl_tdc.stud_id WHERE tbl_student.stud_id = $stud_id ");
                        while($data = mysqli_fetch_array($query_tdc)) {
                      ?>
                      <tr style="cursor: pointer;">
                          <td><?=$count++?></td>
                          <td><?=$data['sched_course']?></td>
                          <td class="text-center"><?=$data['sched_description']?></td>
                          <td class="text-center">₱ <?=number_format($data['sched_price'])?></td>
                          <td class="text-center" data-toggle="modal" data-target=".bs-example-modal-lg" id="<?=$data['sched_id']?>" onclick="show_schedule_students(this.id)">
                          <?php
                          $sched_id = $data['sched_id'];
                          $count_student = mysqli_query($conn, "SELECT * FROM tbl_student WHERE sched_id = $sched_id");
                          $total_students = mysqli_num_rows($count_student);
                          echo $total_students;
                          ?>
                          </td>
                          <td class="text-center"><?=date("F d, Y",strtotime($data['sched_date_created']))?></td>
                          <td class="text-center" id="<?=$data['sched_id']?>,<?=$data['sched_status']?>" onclick="update_status(this.id)">
                            <?php 
                            $status = $data['sched_status'];
                            if ($status == 0) {
                              echo '<span class="badge label-table badge-success">Done</span>';
                            } else {
                              echo '<span class="badge label-table badge-info">Active</span>';
                            }
                            ?>
                          </td>
                          <td class="text-center" id="<?=$data['sched_id']?>,<?=$data['sched_status_website']?>" onclick="update_status_website(this.id)">
                            <?php 
                            $status_website = $data['sched_status_website'];
                            if ($status_website == 0) {
                              echo '<span class="badge label-table badge-warning">Hide</span>';
                            } else {
                              echo '<span class="badge label-table badge-success">Show</span>';
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

          <div class="col-12">
            <div class="card-box table-responsive">
                <h4 class="header-title">Practical Driving Schedule
                  <div class="float-right">
                    <button  type="button" class="btn btn-icon waves-effect waves-light btn-success" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-plus"></i> Add TDC Schedule</button>
                  </div>
                </h4>

                <br>
                <table id="datatable1" class="table table-bordered dt-responsive nowrap table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Student Name</th>
                        <th class="text-center">Student Status</th>
                        <th class="text-center">Payment Status</th>
                        <th class="text-center">Schedule Created</th>
                        <th class="text-center">PDC Price</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $count = 1;
                        $query_pdc = mysqli_query($conn, "SELECT
                                                        tbl_student.stud_name, 
                                                        tbl_pdc.instruc_id, 
                                                        tbl_pdc.pdc_stud_status, 
                                                        tbl_pdc.pdc_stud_payment_status, 
                                                        tbl_pdc.pdc_created, 
                                                        tbl_pdc.pdc_package_price
                                                      FROM
                                                        tbl_student
                                                        INNER JOIN
                                                        tbl_pdc
                                                        ON 
                                                          tbl_student.stud_id = tbl_pdc.stud_id WHERE tbl_student.stud_id = $stud_id");
                        while($data = mysqli_fetch_array($query_pdc)) {
                      ?>
                      <tr style="cursor: pointer;">
                          <td><?=$count++?></td>
                          <td><?=$data['sched_course']?></td>
                          <td class="text-center"><?=$data['sched_description']?></td>
                          <td class="text-center">₱ <?=number_format($data['sched_price'])?></td>
                          <td class="text-center" data-toggle="modal" data-target=".bs-example-modal-lg" id="<?=$data['sched_id']?>" onclick="show_schedule_students(this.id)">
                          <?php
                          $sched_id = $data['sched_id'];
                          $count_student = mysqli_query($conn, "SELECT * FROM tbl_student WHERE sched_id = $sched_id");
                          $total_students = mysqli_num_rows($count_student);
                          echo $total_students;
                          ?>
                          </td>
                          <td class="text-center"><?=date("F d, Y",strtotime($data['sched_date_created']))?></td>
                          <td class="text-center" id="<?=$data['sched_id']?>,<?=$data['sched_status']?>" onclick="update_status(this.id)">
                            <?php 
                            $status = $data['sched_status'];
                            if ($status == 0) {
                              echo '<span class="badge label-table badge-success">Done</span>';
                            } else {
                              echo '<span class="badge label-table badge-info">Active</span>';
                            }
                            ?>
                          </td>
                          <td class="text-center" id="<?=$data['sched_id']?>,<?=$data['sched_status_website']?>" onclick="update_status_website(this.id)">
                            <?php 
                            $status_website = $data['sched_status_website'];
                            if ($status_website == 0) {
                              echo '<span class="badge label-table badge-warning">Hide</span>';
                            } else {
                              echo '<span class="badge label-table badge-success">Show</span>';
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

          function update_status_website(id) {
            array = id.split(",")
            sched_id = array[0];
            sched_status_website = array[1];
            if (confirm('Are you sure?')) {
              $.ajax({
                  url: 'dashboard_query.php',
                  type: 'POST',
                  async: false,
                  data:{
                      sched_id:sched_id,
                      sched_status_website:sched_status_website,
                      update_status_website: 1,
                  },
                      success: function(response){
                        if (response == 'success') {
                          alert('Hide/Show Status Successfully Updated!!');
                          location.reload();
                        }
                      }
                  });
            }
          }

          function show_schedule_students(id) {
            $.ajax({
                url: 'dashboard_query.php',
                type: 'POST',
                async: false,
                data:{
                    sched_id:id,
                    show_schedule_students: 1,
                },
                    success: function(response){
                        $('#show_schedule_students').html(response);
                    }
                });
          }

          function update_stud_schedule(id) {
            if (confirm('Are you sure?')) {
              stud_schedule_status = document.getElementById("stud_schedule_status").value;
              stud_schedule_payment = document.getElementById("stud_schedule_payment").value;
              $.ajax({
                url: 'dashboard_query.php',
                type: 'POST',
                async: false,
                data:{
                    stud_id:id,
                    stud_status:stud_schedule_status,
                    stud_payment:stud_schedule_payment,
                    update_stud_schedule: 1,
                },
                    success: function(response){
                        if (response == 'success') {
                          alert('Successfully Updated!!');
                        }
                    }
                });
            }
          }
          
      </script>
