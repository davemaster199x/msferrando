
        <!-- This part for the list of all patients -->
        <div class="row">
          <div class="col-12">
            <div class="card-box table-responsive">
                <h4 class="header-title">Theoretical Driving Course Schedule
                  <div class="float-right">
                    <?php
                      $tdc_rec = mysqli_query($conn, "SELECT COUNT(tbl_tdc.tdc_stud_status) AS total_stud FROM tbl_tdc WHERE stud_id = '$stud_id'");
                      $data = mysqli_fetch_assoc($tdc_rec);
                      $total_stud = $data['total_stud'];
                      if ($total_stud == 0) {
                        $disabled = '';
                      } else {
                        $disabled = 'style="display: none;"';
                      }
                    ?>
                    <button  type="button" <?=$disabled?> class="btn btn-success btn-block" data-toggle="modal" data-target="#con-close-modal" style="white-space: nowrap;"><i class="fa fa-plus"></i> Add TDC</button>
                  </div>
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
                        <th class="text-center">Schedule Created/Info</th>
                        <th class="text-center">TDC Price</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $count = 1;
                        $query_tdc = mysqli_query($conn, "SELECT tdc_first_day, tdc_first_time, tdc_second_day, tdc_second_time, tdc_third_day, tdc_third_time, tbl_student.stud_name, tbl_tdc.tdc_stud_status, tbl_tdc.tdc_stud_payment_status, tbl_tdc.tdc_created, tbl_tdc.tdc_price, tbl_tdc.tdc_id FROM tbl_student INNER JOIN tbl_tdc ON tbl_student.stud_id = tbl_tdc.stud_id WHERE tbl_student.stud_id = $stud_id ");
                        while($data = mysqli_fetch_array($query_tdc)) {
                        $first_day = date('M d, Y', strtotime($data['tdc_first_day']));
                        $first_time = ($data['tdc_first_time'] == 'am') ? '7am-12pm' : '1pm-6pm';

                        $second_day = date('M d, Y', strtotime($data['tdc_second_day']));
                        $second_time = ($data['tdc_second_time'] == 'am') ? '7am-12pm' : '1pm-6pm';

                        $third_day = date('M d, Y', strtotime($data['tdc_third_day']));
                        $third_time = ($data['tdc_third_time'] == 'am') ? '7am-12pm' : '1pm-6pm';
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
                                echo 'Please contact the Official Facebook Page of MS Ferrando for the validation <br> of your schedule. Failure to validate schedule within 24 hours will <br> automatically cancel your booking. Thank you and stay safe!';
                              } else {
                                echo $data['tdc_created'];
                              }               
                            ?>
                          </td>
                          <td class="text-center">₱ <?=number_format($data['tdc_price'])?></td>
                          <td class="text-center">
                            <?php 
                              if ($data['tdc_stud_status'] == 2) {
                                $disabled = 'disabled';
                              } else {
                                $disabled = '';
                              }
                            ?>
                            <input type="button" <?=$disabled?> class="btn btn-success" value="Update Schedule" data-toggle="modal" data-target="#view-schedule" id="<?=$data['tdc_id']?>" onclick="show_schedule(this.id)">
                            <?php 
                              if ($data['tdc_stud_status'] == 0) {
                               echo '
                                <input type="button" class="btn btn-danger" value="X" title="Cancel Schedule" id="'.$data['tdc_id'].'" onclick="cancel_booking(this.id)">
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
          
          <!-- For PDC table -->
          <!-- <div class="col-12">
            <div class="card-box table-responsive">
                <h4 class="header-title">Practical Driving Schedule
                  <div class="float-right">
                    <button  type="button" class="btn btn-icon waves-effect waves-light btn-success" data-toggle="modal" data-target="#modal-pdc"><i class="fa fa-plus"></i> Add PDC</button>
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
          </div> -->
          
        </div>
        <!--End This part for the list of all patients -->
        <!-- end row -->
      <!-- For the modal -->
      <?php include './dashboard_modal.php'; ?>
      <!--End For the modal -->

      <script src="../assets/jquery.min.js"></script>
      <script type="text/javascript">
        $(function(){
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = "0" + month.toString();
            if(day < 10)
                day = "0" + day.toString();
            
            var minDate= year + "-" + month + "-" + day;
            
            $("#tdc_first_day").attr("min", minDate);
        });

    function reset_tdc_schedule() {
      if (confirm('Are you sure?')) {
        document.getElementById("tdc_first_day").disabled = false;
        document.getElementById("tdc_first_time").disabled = true;
        document.getElementById("tdc_second_day").disabled = true;
        document.getElementById("tdc_second_time").disabled = true;
        document.getElementById("tdc_third_day").disabled = true;
        document.getElementById("tdc_third_time").disabled = true;

        document.getElementById("tdc_first_day").value = '';
        document.getElementById("tdc_first_time").value = '';
        document.getElementById("tdc_second_day").value = '';
        document.getElementById("tdc_second_time").value = '';
        document.getElementById("tdc_third_day").value = '';
        document.getElementById("tdc_third_time").value = '';
      }
    }

    function first_day() {
      tdc_first_day = document.getElementById("tdc_first_day").value;
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
      $("#tdc_second_day").attr("min", minDate);

      if (n == 'Monday' || n == 'Thursday') {
        document.getElementById("tdc_first_time").disabled = false;
      } else {
        alert('Please select Monday or Thursday for First Day Schedule!! Thank you..');
        document.getElementById("tdc_first_day").value = '';
        document.getElementById("tdc_first_time").disabled = true;
      }
    }

    function first_time() {
      tdc_first_day = document.getElementById("tdc_first_day").value;
      tdc_first_time = document.getElementById("tdc_first_time").value;

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
                document.getElementById("tdc_first_time").value = '';
              } else {
                document.getElementById("tdc_first_day").disabled = true;
                document.getElementById("tdc_first_time").disabled = true;
                document.getElementById("tdc_second_day").disabled = false;
              }
            }
        });
    }

    function second_day() {
      tdc_second_day = document.getElementById("tdc_second_day").value;
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
      $("#tdc_third_day").attr("min", minDate);

      if (n == 'Tuesday' || n == 'Friday') {
        document.getElementById("tdc_second_time").disabled = false;
      } else {
        alert('Please select Tuesday or Friday for Second Day Schedule!! Thank you..');
        document.getElementById("tdc_second_day").value = '';
        document.getElementById("tdc_second_time").disabled = true;
      }
    }

    function second_time() {
      tdc_second_day = document.getElementById("tdc_second_day").value;
      tdc_second_time = document.getElementById("tdc_second_time").value;

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
                document.getElementById("tdc_second_time").value = '';
              } else {
                document.getElementById("tdc_second_day").disabled = true;
                document.getElementById("tdc_second_time").disabled = true;
                document.getElementById("tdc_third_day").disabled = false;
              }
            }
        });
    }

    function third_day() {
      tdc_third_day = document.getElementById("tdc_third_day").value;
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
        document.getElementById("tdc_third_time").disabled = false;
      } else {
        alert('Please select Wednesday or Saturday for Third Day Schedule!! Thank you..');
        document.getElementById("tdc_third_day").value = '';
        document.getElementById("tdc_third_time").disabled = true;
      }
    }

    function third_time() {
      tdc_third_day = document.getElementById("tdc_third_day").value;
      tdc_third_time = document.getElementById("tdc_third_time").value;

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
                document.getElementById("tdc_third_time").value = '';
              } else {
                document.getElementById("tdc_third_day").disabled = true;
                document.getElementById("tdc_third_time").disabled = true;
                document.getElementById("show_application").disabled = false;
                document.getElementById("reminder").style = '';
              }
            }
        });
    }

    function save_application() {
      tdc_first_day = document.getElementById("tdc_first_day").value;
      tdc_first_time = document.getElementById("tdc_first_time").value;

      tdc_second_day = document.getElementById("tdc_second_day").value;
      tdc_second_time = document.getElementById("tdc_second_time").value;

      tdc_third_day = document.getElementById("tdc_third_day").value;
      tdc_third_time = document.getElementById("tdc_third_time").value;
      if (confirm('Please take a screenshot or picture for the following 3 days Schedule for you Reference!! Thank you.')) {
          $.ajax({
          url: 'dashboard_query.php',
          type: 'POST',
          async: false,
          data:{
              tdc_first_day:tdc_first_day,
              tdc_first_time:tdc_first_time,
              tdc_second_day:tdc_second_day,
              tdc_second_time:tdc_second_time,
              tdc_third_day:tdc_third_day,
              tdc_third_time:tdc_third_time,
              save_application: 1,
          },
              success: function(response){
                if (response == '1') {
                  alert('Opps!! Someone already take the last seat of the "'+tdc_first_time+'" First Schedule. Please try to reschedule again.. Thank you.');
                  document.getElementById("tdc_first_time").disabled = false;
                } else if (response == '2') {
                  alert('Opps!! Someone already take the last seat of the "'+tdc_second_time+'" Second Schedule. Please try to reschedule again.. Thank you.');
                  document.getElementById("tdc_second_time").disabled = false;
                } else if (response == '3') {
                  alert('Opps!! Someone already take the last seat of the "'+tdc_third_time+'" Third Schedule. Please try to reschedule again.. Thank you.');
                  document.getElementById("tdc_third_time").disabled = false;
                } else if (response == 'success') {
                  alert('Your TDC Schedule Successfully Submit!!');
                  location.reload();
                } else {
                  alert('Opps!! Someone already take your Schedule at the same day and time. Please try to rechedule it again. Thank you..');
                  document.getElementById("tdc_first_day").value = '';
                  document.getElementById("tdc_first_day").disabled = false;
                  document.getElementById("tdc_first_time").value = '';

                  document.getElementById("tdc_second_day").value = '';
                  document.getElementById("tdc_second_time").value = '';

                  document.getElementById("tdc_third_day").value = '';
                  document.getElementById("tdc_third_time").value = '';

                }
              }
          });
      }
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
