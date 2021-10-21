<!-- // This modal for the adding of TDC schedule -->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <?php
                    $result_tdc_price = mysqli_query($conn, "SELECT * FROM tbl_tdc_price");
                    $data = mysqli_fetch_assoc($result_tdc_price);
                    $tdc_price = $data['tdc_price'];
                    $tdc = number_format($tdc_price);
                ?>
                <h4 class="modal-title">Select TDC Schedule @<label style="color: red;"><?=$tdc?></label></h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12">
                    <center>
                        <label>You can select any schedule but please follow the DAY SIMULTANEOUSLY!! </label>
                    </center>
                    <div class="row">
                        <div class="col-md-4">
                            <label>First Day</label>
                            <ul style="margin-top: 0px;">
                                <li>Monday</li>
                                <li>Thursday</li>
                            </ul>  
                        </div>
                        <div class="col-md-4">
                            <label>Second Day</label>
                            <ul style="margin-top: 0px;">
                                <li>Tuesday</li>
                                <li>Friday</li>
                            </ul> 
                        </div>
                        <div class="col-md-4">
                            <label>Third Day</label>
                            <ul style="margin-top: 0px;">
                                <li>Wednesday</li>
                                <li>Saturday</li>
                            </ul> 
                        </div>
                    </div>
                    <center>
                        <strong>No Schedule on SUNDAY!</strong>
                    </center>
                    <hr>
                    <form >
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Day:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="tdc_first_day" onchange="first_day()">
                                </div>
                                <div class="col-md-6">
                                    <select id="tdc_first_time" class="form-control" disabled onchange="first_time()">
                                        <option disabled selected>-Select Time-</option>
                                        <option value="am">AM</option>
                                        <option value="pm">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Second Day:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="tdc_second_day" disabled onchange="second_day()">
                                </div>
                                <div class="col-md-6">
                                    <select id="tdc_second_time" class="form-control" disabled onchange="second_time()">
                                        <option disabled selected>-Select Time-</option>
                                        <option value="am">AM</option>
                                        <option value="pm">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Third Day:</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="tdc_third_day" disabled onchange="third_day()">
                                </div>
                                <div class="col-md-6">
                                    <select id="tdc_third_time" class="form-control" disabled onchange="third_time()">
                                        <option disabled selected>-Select Time-</option>
                                        <option value="am">AM</option>
                                        <option value="pm">PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <label id="reminder" style="display: none;">Please take a screenshot or picture for the following 3 days Schedule for you Reference!! Thank you.</label>
                        <input type="button" class="btn btn-danger float-left" value="Reset Schedule" onclick="reset_tdc_schedule()">
                        <input type="button" class="btn btn-success float-right" value="Submit Application" onclick="save_application()" disabled id="show_application">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- // END modal for the adding of TDC schedule -->

<!-- The Modal -->
<div class="modal fade" id="myModal-payment" data-backdrop="static">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">MS Ferrando Driving School Institute</h4><br>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <div>
            <h4 align="center">Slots get filled in a snap! You can enroll online or walk-in before slots run out!</h4>
            <center><label>*Note: If you pay online, just take a screenshot of the transaction and visit <a href="https://www.facebook.com/MSFerrandoDriving" target="_blank">MS Ferrando</a> Facebook Page to confirm your schedule, same goes to walk-in applicants. Please be advised that unconfirm bookings will result to auto-cancellation in 24 hours. Thank you.</label></center>
            <img class="img-fluid" src="../../images/payment.jpg" alt="" style="display: block; margin-left: auto; margin-right: auto;">
        </div>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      </div>
      
    </div>
  </div>
</div>