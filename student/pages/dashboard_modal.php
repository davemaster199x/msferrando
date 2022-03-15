<!-- // This modal for the adding of TDC schedule -->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <?php
                    $result_packages = mysqli_query($conn, "SELECT * FROM tbl_package");
                    $result_count = mysqli_query($conn, "SELECT * FROM tbl_package");
                ?>
                <h4 class="modal-title">Select Packages</h4><br>
            </div>
            <div class="modal-body">
                <div class="row mt-12">
                    <div class="col-lg-12">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php $count = 0; $count1 = 0; while($data = mysqli_fetch_array($result_count)) { ?>
                                <li data-target="#carouselExampleFade" data-slide-to="<?php echo $count++; ?>" class="<?php if($count1++ == 0) { echo 'active'; } else { echo '';} ?>"></li>
                                <?php } ?>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <?php $con = 0; while($datas = mysqli_fetch_array($result_packages)) { ?>
                                <div class="carousel-item <?php if($con++ == 0) { echo 'active'; } else { echo '';} ?> ">
                                    <img style="max-height:900px; display: block; margin-left: auto; margin-right: auto;" class="d-block img-fluid" src="../../package/<?php echo $datas['package_img']; ?>" alt="First slide" />
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h3 class="text-white">First slide label</h3>
                                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                    </div> -->
                                </div>
                                <?php } ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- // END modal for the adding of TDC schedule -->

<!-- // This modal for the Viewing of TDC schedule -->
<div id="view-schedule" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">View/Update TDC Schedule</h4>
            </div>
            <div class="modal-body">
                <div id="show_schedule"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- // END modal for the Viewing of TDC schedule -->

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
            <center><label>*Note: If you pay online, just take a screenshot of the transaction and visit <a href="https://www.facebook.com/MSFerrandoDriving" target="_blank">MS Ferrando</a> Facebook Page to confirm your schedule, same goes to walk-in applicants. Please be advised that unconfirmed bookings will result to auto-cancellation in 24 hours. Thank you.</label></center>
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