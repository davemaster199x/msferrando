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
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
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
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">MT</label> |
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">AT</label> |
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Both</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="vehicle1">Motor:</label>
                    </div>
                    <div class="col-md-9">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">MT</label> |
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">AT</label> |
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Both</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="vehicle1">Hours:</label>
                    </div>
                    <div class="col-md-9">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">8</label> |
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">10</label> |
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">16</label> |
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">30</label> |
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">60</label>
                    </div>
                </div>
              </div>
            </div><hr>
            <input type="button" class="btn btn-success float-right" value="Update Schedule"  onclick="update_schedule()">
        </div>
    ';
  }

  mysqli_close($conn);
 ?>
