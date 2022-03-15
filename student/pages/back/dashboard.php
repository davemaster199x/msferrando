<?php
session_start();
include("../connection.php");
date_default_timezone_set('Asia/Manila');
$stud_id = $_SESSION['stud_id'];
$result = mysqli_query($conn, "SELECT * FROM tbl_student INNER JOIN tbl_tdc ON tbl_student.stud_id = tbl_tdc.stud_id WHERE tbl_student.stud_id = '$stud_id' AND tdc_stud_status = 0 ORDER BY tdc_id DESC LIMIT 1");
$data = mysqli_fetch_assoc($result);
$today = date('Y-m-d H:i:s');
$tdc_id = isset($data['tdc_id']) ? $data['tdc_id'] : '';
$tdc_created = isset($data['tdc_created']) ? $data['tdc_created'] : '';
$tdc_invalid = date('Y-m-d H:i:s', strtotime( $tdc_created . " +1 days"));
if ($today >= $tdc_invalid) {
    mysqli_query($conn, "DELETE FROM tbl_tdc WHERE tdc_id = '$tdc_id'");
} 
// else {
//     echo '
//     <script>
//         alert("Nag alert");
//     </script>
//     ';
// }
if (empty($_SESSION['stud_id'])) {
    header("Location: ../index.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>MS Ferrando | Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../../images/MSFDILOGO5INCH.png">
        <!-- C3 Chart css -->
        <link href="../assets/libs/c3/c3.min.css" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />
        <link href="../assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <?php include './inc/top_bar.php'; ?>
            <!-- end Topbar -->
            <!-- ========== Left Sidebar Start ========== -->
            <?php include './inc/left_sidebar.php'; ?>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-8">
                                <div class="page-title-box">
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="page-title-box">
                                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal-payment" style="float: right;" value="Payment Method">
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <?php include './dashboard_content.php'; ?>
                        <!-- end row -->
                    </div> <!-- end container-fluid -->
                </div> <!-- end content -->



                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?php $year_now = date('Y'); ?>
                                2020 - <?=$year_now?>&copy; WebDave <i class="mdi mdi-heart-flash"></i>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>
        <!--C3 Chart-->
        <script src="../assets/libs/d3/d3.min.js"></script>
        <script src="../assets/libs/c3/c3.min.js"></script>
        <script src="../assets/libs/echarts/echarts.min.js"></script>
        <script src="../assets/js/pages/dashboard.init.js"></script>
        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>

        <script>
        $(function () {
          $('#datatable').DataTable()
        })
        </script>

        <script>
        $(function () {
          $('#datatable1').DataTable()
        })
        </script>
        <!-- Required datatable js -->
        <script src="../assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="../assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="../assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="../assets/libs/datatables/buttons.print.min.js"></script>
        <script src="../assets/libs/datatables/buttons.colVis.js"></script>
        <!-- Responsive examples -->
        <script src="../assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/libs/datatables/responsive.bootstrap4.min.js"></script>
        <!-- Datatables init -->
        <script src="../assets/js/pages/datatables.init.js"></script>

    </body>
</html>