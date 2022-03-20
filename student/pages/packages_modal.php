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