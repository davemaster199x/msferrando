
        <!-- This part for the list of all patients -->
        <div class="row">
          <div class="col-12">
            <div class="card-box table-responsive">
                <h4 class="header-title">List of Packages's Book by the Student
                </h4>

                <br>
                <table id="datatable" class="table table-bordered dt-responsive nowrap table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Student Name</th>
                        <th class="text-center">Packages</th>
                        <th class="text-center">Student Status</th>
                        <th class="text-center">Payment Status</th>
                        <th class="text-center">Schedule Created</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $count = 1;
                        $query = mysqli_query($conn, "SELECT
                        tbl_book.book_created,
                        tbl_book.book_status,
                        tbl_book.book_payment,
                        tbl_student.stud_name,
                        tbl_package.package_name,
                        tbl_book.book_id
                      FROM
                        tbl_book
                        INNER JOIN
                        tbl_student
                        ON
                          tbl_book.stud_id = tbl_student.stud_id
                        INNER JOIN
                        tbl_package
                        ON
                          tbl_book.package_id = tbl_package.package_id ORDER BY tbl_book.book_created DESC ");
                        while($data = mysqli_fetch_array($query)) {
                      ?>
                      <tr style="cursor: pointer;">
                          <td><?=$count++?></td>
                          <td><?=$data['stud_name'];?></td>
                          <td><?=$data['package_name'];?></td>
                          <td class="text-center">
                            <?php
                              if ($data['book_status'] == 0) {
                                echo '<span class="badge label-table badge-danger">Invalid</span>';
                              } elseif ($data['book_status'] == 1) {
                                echo '<span class="badge label-table badge-primary">Validate</span>';
                              } else {
                                echo '<span class="badge label-table badge-success">Done</span>';
                              }
                            ?>
                          </td>
                          <td class="text-center">
                            <?php
                              if ($data['book_payment'] == 0) {
                                echo '<span class="badge label-table badge-danger">Unpaid</span>';
                              } elseif ($data['book_payment'] == 1) {
                                echo '<span class="badge label-table badge-warning">Partially Paid</span>';
                              } else {
                                echo '<span class="badge label-table badge-success">Fully Paid</span>';
                              }
                            ?>
                          </td>
                          <td class="text-center">
                            <?php
                                echo $data['book_created'];
                            ?>
                          </td>
                          <td class="text-center">
                            <?php
                              if ($data['book_status'] == 2) {
                                $disabled = 'disabled';
                              } else {
                                $disabled = '';
                              }
                              echo '<input type="button" '.$disabled.' class="btn btn-success" value="Manage Schedule" data-toggle="modal" data-target="#view-schedule" id="'.$data['book_id'].'" onclick="show_schedule(this.id)">';
                            ?>
                            <?php
                               echo '
                                <input type="button" class="btn btn-danger" value="X" title="Cancel Schedule" id="'.$data['book_id'].'" onclick="cancel_booking(this.id)">
                              ';
                            ?>
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
      <?php include './schedule_modal.php'; ?>
      <!--End For the modal -->

      <script src="../assets/jquery.min.js"></script>
      <script type="text/javascript">

    function cancel_booking(id) {
      if (confirm('Are you sure you want to cancel this booking?')) {
        $.ajax({
        url: 'schedule_query.php',
        type: 'POST',
        async: false,
        data:{
            book_id:id,
            cancel_booking: 1,
        },
            success: function(response){
              if (response == 'success') {
                Swal.fire({
                    title: "Success!",
                    // text: "You clicked the button!",
                    type: "success",
                    confirmButtonClass: "btn btn-confirm mt-2"
                })
                location.reload();
              } else {
                Swal.fire({
                    type: "error",
                    title: "Oops...",
                    text: "Something went wrong!",
                    confirmButtonClass: "btn btn-confirm mt-2",
                })
              }
            }
        });
      }
    }

    function show_schedule(id) {
      $.ajax({
        url: 'schedule_query.php',
        type: 'POST',
        async: false,
        data:{
            book_id:id,
            show_schedule: 1,
        },
            success: function(response){
              $('#show_schedule').html(response);
            }
        });
    }
    
    function update_booking(id) {
      // alert(id);
      book_status = document.getElementById("book_status").value;
      book_payment = document.getElementById("book_payment").value;
      book_notes = document.getElementById("book_notes").value;

      book_tdc = document.getElementById("book_tdc").checked;
      book_tdc_schedds = document.getElementById("book_tdc_schedds").checked;
      book_tdc_schedys = document.getElementById("book_tdc_schedys").checked;

      book_pdc_carm = document.getElementById("book_pdc_carm").checked;
      book_pdc_cara = document.getElementById("book_pdc_cara").checked;
      book_pdc_carb = document.getElementById("book_pdc_carb").checked;

      book_pdc_motorm = document.getElementById("book_pdc_motorm").checked;
      book_pdc_motora = document.getElementById("book_pdc_motora").checked;
      book_pdc_motorb = document.getElementById("book_pdc_motorb").checked;

      book_pdc_hours8 = document.getElementById("book_pdc_hours8").checked;
      book_pdc_hours10 = document.getElementById("book_pdc_hours10").checked;
      book_pdc_hours16 = document.getElementById("book_pdc_hours16").checked;
      book_pdc_hours30 = document.getElementById("book_pdc_hours30").checked;
      book_pdc_hours60 = document.getElementById("book_pdc_hours60").checked;

      book_pdc = '';

      if (confirm('Are you sure?')) {
        
      //Get checked value in tdc
      schedds = (book_tdc_schedds == true) ? document.getElementById("book_tdc_schedds").value : '';
      schedys = (book_tdc_schedys == true) ? document.getElementById("book_tdc_schedys").value : '';
      tdc = (book_tdc == true) ? document.getElementById("book_tdc").value : '';
      book_tdc_sched = schedds + schedys;
      

      //Get checked value in pdc
      if (book_pdc_hours8  == true || book_pdc_hours10  == true || book_pdc_hours16  == true || book_pdc_hours30  == true || book_pdc_hours60  == true) {
          book_pdc = '1';
        }

      carm = (book_pdc_carm == true) ? document.getElementById("book_pdc_carm").value : '';
      cara = (book_pdc_cara == true) ? document.getElementById("book_pdc_cara").value : '';
      carb = (book_pdc_carb == true) ? document.getElementById("book_pdc_carb").value : '';
      book_pdc_car = carm + cara + carb;

      motorm = (book_pdc_motorm == true) ? document.getElementById("book_pdc_motorm").value : '';
      motora = (book_pdc_motora == true) ? document.getElementById("book_pdc_motora").value : '';
      motorb = (book_pdc_motorb == true) ? document.getElementById("book_pdc_motorb").value : '';
      book_pdc_motor = motorm + motora + motorb;

      hours8 = (book_pdc_hours8 == true) ? document.getElementById("book_pdc_hours8").value : '';
      hours10 = (book_pdc_hours10 == true) ? document.getElementById("book_pdc_hours10").value : '';
      hours16 = (book_pdc_hours16 == true) ? document.getElementById("book_pdc_hours16").value : '';
      hours30 = (book_pdc_hours30 == true) ? document.getElementById("book_pdc_hours30").value : '';
      hours60 = (book_pdc_hours60 == true) ? document.getElementById("book_pdc_hours60").value : '';
      book_pdc_hours = hours8 + hours10 + hours16 + hours30 + hours60;

        $.ajax({
          url: 'schedule_query.php',
          type: 'POST',
          async: false,
          data:{
              book_id:id,
              book_status:book_status,
              book_payment:book_payment,
              book_notes:book_notes,
              book_tdc:tdc,
              book_tdc_sched:book_tdc_sched,
              book_pdc:book_pdc,
              book_pdc_car:book_pdc_car,
              book_pdc_motor:book_pdc_motor,
              book_pdc_hours:book_pdc_hours,
              update_booking: 1,
          },
              success: function(response){
                if (response == 'success') {
                Swal.fire({
                    title: "Success!",
                    type: "success",
                    confirmButtonClass: "btn btn-confirm mt-2"
                })
                } else {
                  Swal.fire({
                      type: "error",
                      title: "Oops...",
                      text: "Something went wrong!",
                      confirmButtonClass: "btn btn-confirm mt-2",
                  })
                }
              }
          });

      }
    }

      </script>
