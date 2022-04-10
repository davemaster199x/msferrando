<?php
  session_start();
  include("../connection.php");
  date_default_timezone_set('Asia/Manila');

  if (isset($_POST['cancel_booking'])) {
    $book_id = $_POST['book_id'];

    $result = mysqli_query($conn, "DELETE FROM tbl_book WHERE book_id = $book_id");
    if ($result) {
        echo 'success';
    }
  }

  if (isset($_POST['show_schedule'])) {
    $book_id = $_POST['book_id'];

    $query = mysqli_query($conn, "SELECT * FROM tbl_book INNER JOIN tbl_package ON tbl_book.package_id = tbl_package.package_id INNER JOIN tbl_student ON tbl_book.stud_id = tbl_student.stud_id WHERE book_id = '$book_id'");
    $data = mysqli_fetch_assoc($query);
    $stud_name = $data['stud_name'];
    $package_name = $data['package_name'];
    $book_status = $data['book_status'];
    $book_payment = $data['book_payment'];
    $book_notes = $data['book_notes'];

    echo '
        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-4 col-form-label">Student Name:</label>
                        <div class="col-7">
                            <input class="form-control" value="'.$stud_name.'" readonly></input>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-4 col-form-label">Package Name:</label>
                        <div class="col-7">
                            <input class="form-control" value="'.$package_name.'" readonly></input>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-4 col-form-label">Student Status:</label>
                        <div class="col-7">
                            <select class="form-control" id="book_status">
                                <option '; if($book_status == 0) { echo 'selected'; } echo ' value="0">Invalid</option>
                                <option '; if($book_status == 1) { echo 'selected'; } echo ' value="1">Validate</option>
                                <option '; if($book_status == 2) { echo 'selected'; } echo ' value="2">Done</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-4 col-form-label">Payment Status:</label>
                        <div class="col-7">
                            <select class="form-control" id="book_payment">
                                <option '; if($book_payment == 0) { echo 'selected'; } echo ' value="0">Unpaid</option>
                                <option '; if($book_payment == 1) { echo 'selected'; } echo ' value="1">Partially Paid</option>
                                <option '; if($book_payment == 2) { echo 'selected'; } echo ' value="2">Fully Paid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-4 col-form-label">Book Notes:</label>
                        <div class="col-7">
                            <textarea class="form-control" id="book_notes" cols="20" rows="5">'.$data['book_notes'].'</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <label style="text-align:center;" class="form-control"><strong>TDC</strong></label>
                <div class="row">
                    <div class="col-md-6">
                        <label for="vehicle1">15 Hours TDC:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="checkbox" '; if($data['book_tdc'] == 1) { echo 'checked'; } echo ' id="book_tdc" name="book_tdc" value="1">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="vehicle1">Weekends:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="checkbox" '; if($data['book_tdc_sched'] == 'wkds') { echo 'checked'; } echo ' id="book_tdc_schedds" name="book_tdc_sched" value="wkds">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="vehicle1">Weekdays:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="checkbox" '; if($data['book_tdc_sched'] == 'wkys') { echo 'checked'; } echo ' id="book_tdc_schedys" name="book_tdc_sched" value="wkys">
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <label style="text-align:center;" class="form-control"><strong>PDC</strong></label>
                <div class="row">
                    <div class="col-md-2">
                        <label for="vehicle1">Car:</label>
                    </div>
                    <div class="col-md-10">
                        <input type="checkbox" '; if($data['book_pdc_car'] == 'cmt') { echo 'checked'; } echo ' id="book_pdc_carm" name="book_pdc_car" value="cmt">
                        <label for="vehicle1">MT</label> |
                        <input type="checkbox" '; if($data['book_pdc_car'] == 'cat') { echo 'checked'; } echo ' id="book_pdc_cara" name="book_pdc_car" value="cat">
                        <label for="vehicle1">AT</label> |
                        <input type="checkbox" '; if($data['book_pdc_car'] == 'cbt') { echo 'checked'; } echo ' id="book_pdc_carb" name="book_pdc_car" value="cbt">
                        <label for="vehicle1">Both</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="vehicle1">Motor:</label>
                    </div>
                    <div class="col-md-9">
                        <input type="checkbox" '; if($data['book_pdc_motor'] == 'mmt') { echo 'checked'; } echo ' id="book_pdc_motorm" name="book_pdc_motor" value="mmt">
                        <label for="vehicle1">MT</label> |
                        <input type="checkbox" '; if($data['book_pdc_motor'] == 'mat') { echo 'checked'; } echo ' id="book_pdc_motora" name="book_pdc_motor" value="mat">
                        <label for="vehicle1">AT</label> |
                        <input type="checkbox" '; if($data['book_pdc_motor'] == 'mbt') { echo 'checked'; } echo ' id="book_pdc_motorb" name="book_pdc_motor" value="mbt">
                        <label for="vehicle1">Both</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="vehicle1">Hours:</label>
                    </div>
                    <div class="col-md-9">
                        <input type="checkbox" '; if($data['book_pdc_hours'] == '8') { echo 'checked'; } echo ' id="book_pdc_hours8" name="book_pdc_hours" value="8">
                        <label for="vehicle1">8</label> |
                        <input type="checkbox" '; if($data['book_pdc_hours'] == '10') { echo 'checked'; } echo ' id="book_pdc_hours10" name="book_pdc_hours" value="10">
                        <label for="vehicle1">10</label> |
                        <input type="checkbox" '; if($data['book_pdc_hours'] == '16') { echo 'checked'; } echo ' id="book_pdc_hours16" name="book_pdc_hours" value="16">
                        <label for="vehicle1">16</label> |
                        <input type="checkbox" '; if($data['book_pdc_hours'] == '30') { echo 'checked'; } echo ' id="book_pdc_hours30" name="book_pdc_hours" value="30">
                        <label for="vehicle1">30</label> |
                        <input type="checkbox" '; if($data['book_pdc_hours'] == '60') { echo 'checked'; } echo ' id="book_pdc_hours60" name="book_pdc_hours" value="60">
                        <label for="vehicle1">60</label>
                    </div>
                </div>
              </div>
            </div><hr>
            <input type="button" class="btn btn-success float-right" id="'.$book_id.'" value="Update Booking"  onclick="update_booking(this.id)">
        </div>
    ';
  }

  if (isset($_POST['update_booking'])) {
    $book_id = $_POST['book_id'];
    $book_status = $_POST['book_status'];
    $book_payment = $_POST['book_payment'];
    $book_notes = $_POST['book_notes'];
    $book_tdc = $_POST['book_tdc'];
    $book_tdc_sched = $_POST['book_tdc_sched'];
    $book_pdc = $_POST['book_pdc'];
    $book_pdc_car = $_POST['book_pdc_car'];
    $book_pdc_motor = $_POST['book_pdc_motor'];
    $book_pdc_hours = $_POST['book_pdc_hours'];

    $result = mysqli_query($conn, "UPDATE tbl_book SET book_status = '$book_status', book_payment = '$book_payment', book_notes = '$book_notes', book_tdc = '$book_tdc', book_tdc_sched = '$book_tdc_sched', book_pdc = '$book_pdc', book_pdc_car = '$book_pdc_car', book_pdc_motor = '$book_pdc_motor', book_pdc_hours = '$book_pdc_hours' WHERE book_id = $book_id");
    if ($result) {
        echo 'success';
    }
  }

  mysqli_close($conn);
 ?>
