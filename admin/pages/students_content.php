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
                        <th class="text-center">Email Address</th>
                        <th class="text-center">Contact #</th>
                        <th class="text-center">Birthdate</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $count = 1;
                        $query = mysqli_query($conn, "SELECT * FROM tbl_student ORDER BY stud_name");
                        while($data = mysqli_fetch_array($query)) {
                      ?>
                      <tr style="cursor: pointer;">
                          <td><?=$count++?></td>
                          <td><?=$data['stud_name']?></td>
                          <td class="text-center"><?=$data['stud_email_address']?></td>
                          <td class="text-center"><?=$data['stud_contact_number']?></td>
                          <td class="text-center"><?=$data['stud_birthdate']?></td>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Student Name:</label>
                                    <input type="text" class="form-control" id="stud_name" placeholder="Enter Student Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Student Email:</label>
                                    <input type="text" class="form-control" id="stud_email_address" placeholder="Enter Student Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Student Password:</label>
                                    <input type="password" class="form-control" id="stud_password" placeholder="Enter Student Password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Show Password</label><br>
                                    <input type="checkbox" onclick="myFunction()" > 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Student Contact:</label>
                                    <input type="number" class="form-control" id="stud_contact_number" placeholder="Enter Student Contact">
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
                                    <textarea id="stud_address" class="form-control" cols="30" rows="4" placeholder="Enter Student Address"></textarea>
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
          function myFunction() {
            var x = document.getElementById("stud_password");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
          }

          function myFunctions() {
            var x = document.getElementById("stud_password_update");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
          }
    
          function save_student() {
            stud_name = document.getElementById("stud_name").value;
            stud_email_address = document.getElementById("stud_email_address").value;
            stud_password = document.getElementById("stud_password").value;
            stud_contact = document.getElementById("stud_contact_number").value;
            stud_birthdate = document.getElementById("stud_birthdate").value;
            stud_address = document.getElementById("stud_address").value;

            if (stud_name == '' || stud_email_address == '' || stud_contact == '' || stud_birthdate == '' || stud_address == '' || stud_password == '') {
              alert('Please fill up all Student Information!!');
            } else {
              $.ajax({
                  url: 'student_query.php',
                  type: 'POST',
                  async: false,
                  data:{
                    stud_name:stud_name,
                    stud_email_address:stud_email_address,
                    stud_password:stud_password,
                    stud_contact:stud_contact,
                    stud_birthdate:stud_birthdate,
                    stud_address:stud_address,
                    save_student: 1,
                  },
                      success: function(response){
                        if (response == 'success') {
                          alert('Student Successfully Added!!');
                          location.reload();
                        } else if (response == 'duplicate') {
                          alert('Student already exist!');
                        } else {
                          alert('Something went wrong!!');
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
            stud_name = document.getElementById("stud_name_update").value;
            stud_email_address = document.getElementById("stud_email_address_update").value;
            stud_password = document.getElementById("stud_password_update").value;
            stud_contact_number = document.getElementById("stud_contact_number_update").value;
            stud_birthdate = document.getElementById("stud_birthdate_update").value;
            stud_address = document.getElementById("stud_address_update").value;

            if (confirm('Are you sure?')) {
                  $.ajax({
                    url: 'student_query.php',
                    type: 'POST',
                    async: false,
                    data:{
                        stud_id:stud_id,
                        stud_name:stud_name,
                        stud_email_address:stud_email_address,
                        stud_password:stud_password,
                        stud_contact_number:stud_contact_number,
                        stud_birthdate:stud_birthdate,
                        stud_address:stud_address,
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
