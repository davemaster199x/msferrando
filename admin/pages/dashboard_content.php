
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
            <div class="card-box table-responsive">
                <h4 class="header-title">Theoretical Driving Course Schedule
                </h4>
                <br>
                <table id="datatable" class="table table-bordered dt-responsive nowrap table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Student Name</th>
                        <th class="text-center">Schedule</th>
                        <th class="text-center">Student Status</th>
                        <th class="text-center">Payment Status</th>
                        <th class="text-center">Schedule Validation/Created</th>
                        <th class="text-center">TDC Price</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $count = 1;
                        $query_tdc = mysqli_query($conn, "SELECT tdc_first_day, tdc_first_time, tdc_second_day, tdc_second_time, tdc_third_day, tdc_third_time, tbl_student.stud_name, tbl_tdc.tdc_stud_status, tbl_tdc.tdc_stud_payment_status, tbl_tdc.tdc_created, tbl_tdc.tdc_price, tbl_tdc.tdc_id FROM tbl_student INNER JOIN tbl_tdc ON tbl_student.stud_id = tbl_tdc.stud_id WHERE tdc_stud_status IN (0,1) ORDER BY tdc_first_day ");
                        while($data = mysqli_fetch_array($query_tdc)) {
                        $first_day = date('M d, Y', strtotime($data['tdc_first_day']));
                        $first_time = ($data['tdc_first_time'] == 'am') ? '7am-12pm' : '1pm-6pm';

                        $second_day = date('M d, Y', strtotime($data['tdc_second_day']));
                        $second_time = ($data['tdc_second_time'] == 'am') ? '7am-12pm' : '1pm-6pm';

                        $third_day = date('M d, Y', strtotime($data['tdc_third_day']));
                        $third_time = ($data['tdc_third_time'] == 'am') ? '7am-12pm' : '1pm-6pm';
                        $tdc_invalid = date('Y-m-d H:i:s', strtotime( $data['tdc_created'] . " +1 days"));
                      ?>
                      <tr style="cursor: pointer;">
                          <td><?=$count++?></td>
                          <td><?=$data['stud_name'];?></td>
                          <td>
                          <?php
                            echo '
                            <label>
                                First Day: '.$first_day.' | Time: '.$first_time.'<br>
                                Second Day: '.$second_day.' | Time: '.$second_time.'<br>
                                Third Day: '.$third_day.' | Time: '.$third_time.'
                            </label>
                            ';
                          ?>
                          </td>
                          <td class="text-center">
                            <?php 
                              if ($data['tdc_stud_status'] == 0) {
                                echo '<span class="badge label-table badge-danger">Invalidate</span>';
                              } elseif ($data['tdc_stud_status'] == 1) {
                                echo '<span class="badge label-table badge-primary">Validate</span>';
                              } else {
                                echo '<span class="badge label-table badge-success">Done</span>';
                              }               
                            ?>
                          </td>
                          <td class="text-center">
                            <?php 
                              if ($data['tdc_stud_payment_status'] == 0) {
                                echo '<span class="badge label-table badge-danger">Unpaid</span>';
                              } elseif ($data['tdc_stud_payment_status'] == 1) {
                                echo '<span class="badge label-table badge-warning">Partially Paid</span>';
                              } else {
                                echo '<span class="badge label-table badge-success">Fully Paid</span>';
                              }               
                            ?>
                          </td>
                          <td class="text-center">
                            <?php 
                              if ($data['tdc_stud_status'] == 0) {
                                echo '<span class="badge label-table badge-danger">'.$tdc_invalid.'</span>';
                              } else {
                                echo '<span class="badge label-table badge-success">'.$data['tdc_created'].'</span>';
                              }              
                            ?>
                          </td>
                          <td class="text-center">₱ <?=number_format($data['tdc_price'])?></td>
                          <td class="text-center">
                            <input type="button" class="btn btn-success" value="Update Schedule" data-toggle="modal" data-target="#view-schedule" id="<?=$data['tdc_id']?>" onclick="show_schedule(this.id)">
                            <?php 
                               echo '
                                <input type="button" class="btn btn-danger" value="X" title="Cancel Schedule" id="'.$data['tdc_id'].'" onclick="cancel_booking(this.id)">
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
      <?php include './dashboard_modal.php'; ?>
      <!--End For the modal -->

  <script src="../assets/jquery.min.js"></script>
  <script type="text/javascript">
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

    function cancel_booking(id) {
      if (confirm('Are you sure you want to cancel you booking?')) {
        $.ajax({
        url: 'dashboard_query.php',
        type: 'POST',
        async: false,
        data:{
            tdc_id:id,
            cancel_booking: 1,
        },
            success: function(response){
              if (response == 'success') {
                alert('You have successfully cancel your booking.');
                location.reload();
              } else {
                alert('Error!');
              }
            }
        });
      }
    }

    function reset_tdc_schedule_update() {
      if (confirm('Are you sure?')) {
        document.getElementById("tdc_first_day_update").disabled = false;
        document.getElementById("tdc_first_time_update").disabled = true;
        document.getElementById("tdc_second_day_update").disabled = true;
        document.getElementById("tdc_second_time_update").disabled = true;
        document.getElementById("tdc_third_day_update").disabled = true;
        document.getElementById("tdc_third_time_update").disabled = true;

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

      if (n == 'Monday' || n == 'Thursday') {
        document.getElementById("tdc_first_time_update").disabled = false;
      } else {
        alert('Please select Monday or Thursday for First Day Schedule!! Thank you..');
        document.getElementById("tdc_first_day_update").value = '';
        document.getElementById("tdc_first_time_update").disabled = true;
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
                document.getElementById("tdc_first_day_update").disabled = true;
                document.getElementById("tdc_first_time_update").disabled = true;
                document.getElementById("tdc_second_day_update").disabled = false;
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

      if (n == 'Tuesday' || n == 'Friday') {
        document.getElementById("tdc_second_time_update").disabled = false;
      } else {
        alert('Please select Tuesday or Friday for Second Day Schedule!! Thank you..');
        document.getElementById("tdc_second_day_update").value = '';
        document.getElementById("tdc_second_time_update").disabled = true;
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
                document.getElementById("tdc_second_day_update").disabled = true;
                document.getElementById("tdc_second_time_update").disabled = true;
                document.getElementById("tdc_third_day_update").disabled = false;
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

      if (n == 'Wednesday' || n == 'Saturday') {
        document.getElementById("tdc_third_time_update").disabled = false;
      } else {
        alert('Please select Wednesday or Saturday for Third Day Schedule!! Thank you..');
        document.getElementById("tdc_third_day_update").value = '';
        document.getElementById("tdc_third_time_update").disabled = true;
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
                document.getElementById("tdc_third_day_update").disabled = true;
                document.getElementById("tdc_third_time_update").disabled = true;
                document.getElementById("show_application_update").disabled = false;
                document.getElementById("reminder_update").style = '';
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
                  alert('Your TDC Schedule Successfully Updated!');
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
