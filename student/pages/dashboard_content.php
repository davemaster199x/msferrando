
        <!-- This part for the list of all patients -->
        <div class="row">
          <div class="col-12">
            <div class="card-box table-responsive">
                <h4 class="header-title">TDC/PDC Schedule
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
                        <th class="text-center">Schedule Created/Info</th>
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
                          tbl_book.package_id = tbl_package.package_id WHERE tbl_student.stud_id = $stud_id ");
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
                              if ($data['book_status'] == 0) {
                                echo 'Please contact the Official Facebook Page of MS Ferrando for the validation <br> of your schedule. Failure to validate schedule within 24 hours will <br> automatically cancel your booking. Thank you and stay safe!';
                              } else {
                                echo $data['tdc_created'];
                              }               
                            ?>
                          </td>
                          <td class="text-center">
                            <?php 
                              if ($data['book_status'] == 2) {
                                $disabled = 'disabled';
                              } else {
                                $disabled = '';
                              }
                            ?>
                            <input type="button" <?=$disabled?> class="btn btn-success" value="Update Schedule" data-toggle="modal" data-target="#view-schedule" id="<?=$data['book_id']?>" onclick="show_schedule(this.id)">
                            <?php 
                              if ($data['book_status'] == 0) {
                               echo '
                                <input type="button" class="btn btn-danger" value="X" title="Cancel Schedule" id="'.$data['book_id'].'" onclick="cancel_booking(this.id)">
                              ';
                              }    
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
      <?php include './dashboard_modal.php'; ?>
      <!--End For the modal -->

      <script src="../assets/jquery.min.js"></script>
      <script type="text/javascript">

    function cancel_booking(id) {
      if (confirm('Are you sure you want to cancel you booking?')) {
        $.ajax({
        url: 'dashboard_query.php',
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
        url: 'dashboard_query.php',
        type: 'POST',
        async: false,
        data:{
            tdc_id:id,
            show_schedule: 1,
        },
            success: function(response){
              $('#show_schedule').html(response);
            }
        });
    }

    function reset_tdc_schedule_update() {
      if (confirm('Are you sure?')) {
        // document.getElementById("tdc_first_day_update").disabled = false;
        // document.getElementById("tdc_first_time_update").disabled = true;
        // document.getElementById("tdc_second_day_update").disabled = true;
        // document.getElementById("tdc_second_time_update").disabled = true;
        // document.getElementById("tdc_third_day_update").disabled = true;
        // document.getElementById("tdc_third_time_update").disabled = true;

        document.getElementById("tdc_first_day_update").value = '';
        document.getElementById("tdc_first_time_update").value = '';
        document.getElementById("tdc_second_day_update").value = '';
        document.getElementById("tdc_second_time_update").value = '';
        document.getElementById("tdc_third_day_update").value = '';
        document.getElementById("tdc_third_time_update").value = '';
      }
    }

    function first_day_update() {
      tdc_first_day = document.getElementById("tdc_first_day_update").value;
      var d = new Date(tdc_first_day);
      var weekday = new Array(7);
      weekday[0] = "Sunday";
      weekday[1] = "Monday";
      weekday[2] = "Tuesday";
      weekday[3] = "Wednesday";
      weekday[4] = "Thursday";
      weekday[5] = "Friday";
      weekday[6] = "Saturday";
      var n = weekday[d.getDay()];

      var dtToday = new Date(tdc_first_day); 
      var month = dtToday.getMonth() + 1;
      var day = dtToday.getDate();
      var year = dtToday.getFullYear();
      if(month < 10)
          month = "0" + month.toString();
      if(day < 10)
          day = "0" + day.toString();
      var minDate= year + "-" + month + "-" + day;
      $("#tdc_second_day_update").attr("min", minDate);

      if (n == 'Tuesday' || n == 'Friday') {
        // document.getElementById("tdc_first_time_update").disabled = false;
      } else {
        alert('Please select Tuesday or Friday for First Day Schedule!! Thank you..');
        document.getElementById("tdc_first_day_update").value = '';
        // document.getElementById("tdc_first_time_update").disabled = true;
      }
    }

    function first_time_update() {
      tdc_first_day = document.getElementById("tdc_first_day_update").value;
      tdc_first_time = document.getElementById("tdc_first_time_update").value;

      $.ajax({
        url: 'dashboard_query.php',
        type: 'POST',
        async: false,
        data:{
            tdc_first_day:tdc_first_day,
            tdc_first_time,tdc_first_time,
            day1: 1,
        },
            success: function(response){
              if (response == 'sobra') {
                alert('Sorry the maximum students for this schedule are already Completed!! Please try another schedule. Thank you...');
                document.getElementById("tdc_first_time_update").value = '';
              } else {
                // document.getElementById("tdc_first_day_update").disabled = true;
                // document.getElementById("tdc_first_time_update").disabled = true;
                // document.getElementById("tdc_second_day_update").disabled = false;
              }
            }
        });
    }

    function second_day_update() {
      tdc_second_day = document.getElementById("tdc_second_day_update").value;
      var d = new Date(tdc_second_day);
      var weekday = new Array(7);
      weekday[0] = "Sunday";
      weekday[1] = "Monday";
      weekday[2] = "Tuesday";
      weekday[3] = "Wednesday";
      weekday[4] = "Thursday";
      weekday[5] = "Friday";
      weekday[6] = "Saturday";
      var n = weekday[d.getDay()];

      var dtToday = new Date(tdc_second_day); 
      var month = dtToday.getMonth() + 1;
      var day = dtToday.getDate();
      var year = dtToday.getFullYear();
      if(month < 10)
          month = "0" + month.toString();
      if(day < 10)
          day = "0" + day.toString();
      var minDate= year + "-" + month + "-" + day;
      $("#tdc_third_day_update").attr("min", minDate);

      if (n == 'Wednesday' || n == 'Saturday') {
        // document.getElementById("tdc_second_time_update").disabled = false;
      } else {
        alert('Please select Wednesday or Saturday for Second Day Schedule!! Thank you..');
        document.getElementById("tdc_second_day_update").value = '';
        // document.getElementById("tdc_second_time_update").disabled = true;
      }
    }

    function second_time_update() {
      tdc_second_day = document.getElementById("tdc_second_day_update").value;
      tdc_second_time = document.getElementById("tdc_second_time_update").value;

      $.ajax({
        url: 'dashboard_query.php',
        type: 'POST',
        async: false,
        data:{
            tdc_second_day:tdc_second_day,
            tdc_second_time,tdc_second_time,
            day2: 1,
        },
            success: function(response){
              if (response == 'sobra') {
                alert('Sorry the maximum students for this schedule are already Completed!! Please try another schedule. Thank you...');
                document.getElementById("tdc_second_time_update").value = '';
              } else {
                // document.getElementById("tdc_second_day_update").disabled = true;
                // document.getElementById("tdc_second_time_update").disabled = true;
                // document.getElementById("tdc_third_day_update").disabled = false;
              }
            }
        });
    }

    function third_day_update() {
      tdc_third_day = document.getElementById("tdc_third_day_update").value;
      var d = new Date(tdc_third_day);
      var weekday = new Array(7);
      weekday[0] = "Sunday";
      weekday[1] = "Monday";
      weekday[2] = "Tuesday";
      weekday[3] = "Wednesday";
      weekday[4] = "Thursday";
      weekday[5] = "Friday";
      weekday[6] = "Saturday";
      var n = weekday[d.getDay()];

      if (n == 'Thursday' || n == 'Sunday') {
        // document.getElementById("tdc_third_time_update").disabled = false;
      } else {
        alert('Please select Thursday or Sunday for Third Day Schedule!! Thank you..');
        document.getElementById("tdc_third_day_update").value = '';
        // document.getElementById("tdc_third_time_update").disabled = true;
      }
    }

    function third_time_update() {
      tdc_third_day = document.getElementById("tdc_third_day_update").value;
      tdc_third_time = document.getElementById("tdc_third_time_update").value;

      $.ajax({
        url: 'dashboard_query.php',
        type: 'POST',
        async: false,
        data:{
            tdc_third_day:tdc_third_day,
            tdc_third_time,tdc_third_time,
            day3: 1,
        },
            success: function(response){
              if (response == 'sobra') {
                alert('Sorry the maximum students for this schedule are already Completed!! Please try another schedule. Thank you...');
                document.getElementById("tdc_third_time_update").value = '';
              } else {
                // document.getElementById("tdc_third_day_update").disabled = true;
                // document.getElementById("tdc_third_time_update").disabled = true;
                // document.getElementById("show_application_update").disabled = false;
              }
            }
        });
    }

    function save_application_update() {
      tdc_id = document.getElementById("tdc_id_update").value;

      tdc_first_day = document.getElementById("tdc_first_day_update").value;
      tdc_first_time = document.getElementById("tdc_first_time_update").value;

      tdc_second_day = document.getElementById("tdc_second_day_update").value;
      tdc_second_time = document.getElementById("tdc_second_time_update").value;

      tdc_third_day = document.getElementById("tdc_third_day_update").value;
      tdc_third_time = document.getElementById("tdc_third_time_update").value;
      if (confirm('Please take a screenshot or picture for the following 3 days Schedule for you Reference!! Thank you.')) {
          $.ajax({
          url: 'dashboard_query.php',
          type: 'POST',
          async: false,
          data:{
              tdc_id:tdc_id,
              tdc_first_day:tdc_first_day,
              tdc_first_time:tdc_first_time,
              tdc_second_day:tdc_second_day,
              tdc_second_time:tdc_second_time,
              tdc_third_day:tdc_third_day,
              tdc_third_time:tdc_third_time,
              save_application_update: 1,
          },
              success: function(response){
                if (response == '1') {
                  alert('Opps!! Someone already take the last seat of the "'+tdc_first_time+'" First Schedule. Please try to reschedule again.. Thank you.');
                  document.getElementById("tdc_first_time_update").disabled = false;
                } else if (response == '2') {
                  alert('Opps!! Someone already take the last seat of the "'+tdc_second_time+'" Second Schedule. Please try to reschedule again.. Thank you.');
                  document.getElementById("tdc_second_time_update").disabled = false;
                } else if (response == '3') {
                  alert('Opps!! Someone already take the last seat of the "'+tdc_third_time+'" Third Schedule. Please try to reschedule again.. Thank you.');
                  document.getElementById("tdc_third_time_update").disabled = false;
                } else if (response == 'success') {
                  alert('Your TDC Schedule Successfully Updated. Please click on the “Payment Method” to successfully secure your slot.');
                  location.reload();
                } else {
                  alert('Opps!! Someone already take your Schedule at the same day and time. Please try to rechedule it again. Thank you..');
                  document.getElementById("tdc_first_day_update").value = '';
                  document.getElementById("tdc_first_day_update").disabled = false;
                  document.getElementById("tdc_first_time_update").value = '';

                  document.getElementById("tdc_second_day_update").value = '';
                  document.getElementById("tdc_second_time_update").value = '';

                  document.getElementById("tdc_third_day_update").value = '';
                  document.getElementById("tdc_third_time_update").value = '';

                }
              }
          });
      }
    }
          
      </script>
