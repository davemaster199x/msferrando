        <!-- This part for the list of all students -->
        <div class="row">
          <div class="col-12">
            <div class="card-box table-responsive">
                <h4 class="header-title">List of All Students
                  <div class="float-right">
                    <button  type="button" class="btn btn-icon waves-effect waves-light btn-success" data-toggle="modal" data-target="#con-close-modal"><i class="fa fa-plus"></i> Add Student</button>
                  </div>
                </h4>

                <br>
                <table id="datatable" class="table table-bordered dt-responsive nowrap table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Student Name</th>
                        <th class="text-center">Schedule</th>
                        <th class="text-center">Email Address</th>
                        <th class="text-center">Contact #</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Payment</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $count = 1;
                        $query = mysqli_query($conn, "SELECT * FROM tbl_student INNER JOIN tbl_schedule ON tbl_student.sched_id = tbl_schedule.sched_id ORDER BY stud_id DESC");
                        while($data = mysqli_fetch_array($query)) {
                      ?>
                      <tr style="cursor: pointer;">
                          <td><?=$count++?></td>
                          <td><?=$data['stud_name']?></td>
                          <td class="text-center"><?=$data['sched_description']?></td>
                          <td class="text-center"><?=$data['stud_email_address']?></td>
                          <td class="text-center"><?=$data['stud_contact']?></td>
                          <td class="text-center">
                            <?php 
                            $status = $data['stud_status'];
                            if ($status == 0) {
                              echo '<span class="badge label-table badge-warning">In Progress</span>';
                            } else {
                              echo '<span class="badge label-table badge-success">Done</span>';
                            }
                            ?>
                          </td>
                          <td class="text-center">
                            <?php 
                            $stud_payment = $data['stud_payment'];
                            if ($stud_payment == 0) {
                              echo '<span class="badge label-table badge-danger">Receivable</span>';
                            } elseif ($stud_payment == 1) {
                              echo '<span class="badge label-table badge-warning">Partially Paid</span>';
                            } else {
                              echo '<span class="badge label-table badge-success">Fully Paid</span>';
                            }
                            ?>
                          </td>
                          <td class="text-center">
                          <button type="button" class="btn btn-icon waves-effect waves-light btn-primary" data-toggle="modal" data-target="#update-student-modal" id="<?=$data['stud_id']?>" onclick="show_update_student(this.id)"> <i class="far fa-edit"></i> </button>
                          <button type="button" class="btn btn-icon waves-effect waves-light btn-danger" id="<?=$data['stud_id']?>" onclick="delete_student(this.id)"> <i class="fas fa-times"></i> </button>
                          </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
        <!--End This part for the list of all students -->
        <!-- end row -->

        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Add Student</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Select Schedule:</label>
                                    <select id="sched_id" class="form-control"> 
                                        <?php
                                        $query_schedule = mysqli_query($conn, "SELECT * FROM tbl_schedule WHERE sched_status = 1 ORDER BY sched_id DESC");
                                        while($data_schedule = mysqli_fetch_array($query_schedule)) {
                                            echo '<option value="'.$data_schedule['sched_id'].'">'.$data_schedule['sched_description'].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Student Name:</label>
                                    <input type="text" class="form-control" id="stud_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Student Email:</label>
                                    <input type="text" class="form-control" id="stud_email_address">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Student Contact:</label>
                                    <input type="text" class="form-control" id="stud_contact">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Student Birthdate:</label>
                                    <input type="date" class="form-control" id="stud_birthdate">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Student Address:</label>
                                    <textarea id="stud_address" class="form-control" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info waves-effect waves-light" onclick="save_student()">Add Student</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="update-student-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Update Student</h4>
                    </div>
                    <div class="modal-body">
                        <div id="show_update_student"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="update_student()">Update Student</button>
                    </div>
                </div>
            </div>
        </div>

      <script src="../assets/jquery.min.js"></script>
      <script type="text/javascript">
          function save_student() {
            sched_id = document.getElementById("sched_id").value;
            stud_name = document.getElementById("stud_name").value;
            stud_email_address = document.getElementById("stud_email_address").value;
            stud_contact = document.getElementById("stud_contact").value;
            stud_birthdate = document.getElementById("stud_birthdate").value;
            stud_address = document.getElementById("stud_address").value;

            if (stud_name == '' || stud_email_address == '' || stud_contact == '' || stud_birthdate == '' || stud_address == '') {
              alert('Please fill up all Student Information!!');
            } else {
              $.ajax({
                  url: 'student_query.php',
                  type: 'POST',
                  async: false,
                  data:{
                    sched_id:sched_id,
                    stud_name:stud_name,
                    stud_email_address:stud_email_address,
                    stud_contact:stud_contact,
                    stud_birthdate:stud_birthdate,
                    stud_address:stud_address,
                    save_student: 1,
                  },
                      success: function(response){
                        if (response == 'success') {
                          alert('Student Successfully Added!!');
                          location.reload();
                        }
                      }
                });
            }
          }

          function delete_student(id) {
            if (confirm('Are you sure?')) {
              $.ajax({
                  url: 'student_query.php',
                  type: 'POST',
                  async: false,
                  data:{
                    stud_id:id,
                    delete_student: 1,
                  },
                      success: function(response){
                        if (response == 'success') {
                          alert('Student Successfully Deleted!!');
                          location.reload();
                        }
                      }
                  });
            }
          }

          function show_update_student(id) {
            $.ajax({
                url: 'student_query.php',
                type: 'POST',
                async: false,
                data:{
                    stud_id:id,
                    show_update_student: 1,
                },
                    success: function(response){
                        $('#show_update_student').html(response);
                    }
                });
          }


          function update_student() {
            stud_id = document.getElementById("stud_id_update").value;
            sched_id = document.getElementById("sched_id_update").value;
            stud_status = document.getElementById("stud_status_update").value;
            stud_payment = document.getElementById("stud_payment_update").value;
            stud_name = document.getElementById("stud_name_update").value;
            stud_email_address = document.getElementById("stud_email_address_update").value;
            stud_contact = document.getElementById("stud_contact_update").value;
            stud_birthdate = document.getElementById("stud_birthdate_update").value;
            stud_address = document.getElementById("stud_address_update").value;
            stud_notes = document.getElementById("stud_notes_update").value;

            if (confirm('Are you sure?')) {
                  $.ajax({
                    url: 'student_query.php',
                    type: 'POST',
                    async: false,
                    data:{
                        stud_id:stud_id,
                        sched_id:sched_id,
                        stud_status:stud_status,
                        stud_payment:stud_payment,
                        stud_name:stud_name,
                        stud_email_address:stud_email_address,
                        stud_contact:stud_contact,
                        stud_birthdate:stud_birthdate,
                        stud_address:stud_address,
                        stud_notes:stud_notes,
                        update_student: 1,
                    },
                        success: function(response){
                          if (response == 'success') {
                            alert('Student Successfully Updated!!');
                            location.reload();
                          }
                        }
                    });
                }
            }
          
      </script>
