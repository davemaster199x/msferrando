    <div class="row">
        <div class="col-lg-12">
                <div class="card-box">
                    <h4 class="header-title mb-4">List of Packages</h4>

                    <ul class="nav nav-pills navtab-bg nav-justified">
                        <li class="nav-item">
                            <a href="#allin" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <span class="d-block d-sm-none">Ultimate ALL IN</span>
                                <span class="d-none d-sm-block">Ultimate ALL IN</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tdcpdc" data-toggle="tab" aria-expanded="true" class="nav-link">
                                <span class="d-block d-sm-none">TDC/PDC</span>
                                <span class="d-none d-sm-block">TDC/PDC</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#refresh" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <span class="d-block d-sm-none">Refresh</span>
                                <span class="d-none d-sm-block">Refresh</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#defensive" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <span class="d-block d-sm-none">Defensive Driving</span>
                                <span class="d-none d-sm-block">Defensive Driving</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="allin">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-deck-wrapper">
                                        <div class="card-deck">
                                            <?php $result_allin = mysqli_query($conn, "SELECT * FROM tbl_package WHERE package_type = 'allin'");
                                            while($data_allin = mysqli_fetch_array($result_allin)) {
                                            ?>
                                            <div class="card">
                                                <a href="../../package/<?php echo $data_allin['package_img']; ?>" class="" data-lightbox="#single-image-callcenter">
                                                    <img style="max-width: 60%; display: block; margin-left: auto; margin-right: auto;" class="card-img-top img-fluid" src="../../package/<?php echo $data_allin['package_img']; ?>" alt="Card image cap">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">Package Description:</h5>
                                                    <p class="card-text"><?php echo $data_allin['package_name']; ?></p>
                                                    <p class="card-text text-center">
                                                        <button class="btn btn-success" id="<?php echo $data_allin['package_id']; ?>" onclick="book_now(this.id)">Book Now!</button>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tdcpdc">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-deck-wrapper">
                                        <div class="card-deck">
                                            <?php $result_pdctdc = mysqli_query($conn, "SELECT * FROM tbl_package WHERE package_type = 'tdc/pdc'");
                                            while($data_pdctdc = mysqli_fetch_array($result_pdctdc)) {
                                            ?>
                                            <div class="card">
                                                <a href="../../package/<?php echo $data_pdctdc['package_img']; ?>" class="" data-lightbox="#single-image-callcenter">
                                                    <img style="max-width: 60%; display: block; margin-left: auto; margin-right: auto;" class="card-img-top img-fluid" src="../../package/<?php echo $data_pdctdc['package_img']; ?>" alt="Card image cap">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">Package Description:</h5>
                                                    <p class="card-text"><?php echo $data_pdctdc['package_name']; ?></p>
                                                    <p class="card-text text-center">
                                                        <button class="btn btn-success" id="<?php echo $data_pdctdc['package_id']; ?>" onclick="book_now(this.id)">Book Now!</button>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="refresh">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-deck-wrapper">
                                        <div class="card-deck">
                                            <?php $result_refresh = mysqli_query($conn, "SELECT * FROM tbl_package WHERE package_type = 'refresh'");
                                            while($data_refresh = mysqli_fetch_array($result_refresh)) {
                                            ?>
                                            <div class="card">
                                                <a href="../../package/<?php echo $data_refresh['package_img']; ?>" class="" data-lightbox="#single-image-callcenter">
                                                    <img style="max-width: 60%; display: block; margin-left: auto; margin-right: auto;" class="card-img-top img-fluid" src="../../package/<?php echo $data_refresh['package_img']; ?>" alt="Card image cap">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">Package Description:</h5>
                                                    <p class="card-text"><?php echo $data_refresh['package_name']; ?></p>
                                                    <p class="card-text text-center">
                                                        <button class="btn btn-success" id="<?php echo $data_refresh['package_id']; ?>" onclick="book_now(this.id)">Book Now!</button>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="defensive">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-deck-wrapper">
                                        <div class="card-deck">
                                            <?php $result_defensive = mysqli_query($conn, "SELECT * FROM tbl_package WHERE package_type = 'defensive'");
                                            while($data_defensive = mysqli_fetch_array($result_defensive)) {
                                            ?>
                                            <div class="card">
                                                <a href="../../package/<?php echo $data_defensive['package_img']; ?>" class="" data-lightbox="#single-image-callcenter">
                                                    <img style="max-width: 60%; display: block; margin-left: auto; margin-right: auto;" class="card-img-top img-fluid" src="../../package/<?php echo $data_defensive['package_img']; ?>" alt="Card image cap">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">Package Description:</h5>
                                                    <p class="card-text"><?php echo $data_defensive['package_name']; ?></p>
                                                    <p class="card-text text-center">
                                                        <button class="btn btn-success" id="<?php echo $data_defensive['package_id']; ?>" onclick="book_now(this.id)">Book Now!</button>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div> <!-- end col -->
    </div>
        <!-- end row -->
      <!-- For the modal -->
      <?php // include './packages_modal.php'; ?>
      <!--End For the modal -->

      <script src="../assets/jquery.min.js"></script>
      <script>
          function book_now(id) {
            if (confirm('Are you sure?')) {
                $.ajax({
                url: 'package_query.php',
                type: 'POST',
                async: false,
                data:{
                    package_id:id,
                    book_now: 1,
                },
                    success: function(response){    
                        if (response == 'success') {
                            Swal.fire({
                                title: "Success!",
                                // text: "You clicked the button!",
                                type: "success",
                                confirmButtonClass: "btn btn-confirm mt-2"
                            })
                        } else {
                            Swal.fire({
                                type: "error",
                                title: "Oops...",
                                text: "You can only book once!",
                                confirmButtonClass: "btn btn-confirm mt-2",
                            })
                        }
                    }
                });
            } 
          }
      </script>