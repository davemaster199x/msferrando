<?php
session_start();
include("../connection.php");
date_default_timezone_set('Asia/Manila');
if (empty($_SESSION['user_id'])) {
    header("Location: ../index.php");
}

$today = date('Y-m-d H:i:s');
$result = mysqli_query($conn, "SELECT * FROM tbl_student INNER JOIN tbl_tdc ON tbl_student.stud_id = tbl_tdc.stud_id WHERE tdc_stud_status = 0 ORDER BY tdc_id DESC");
while($data = mysqli_fetch_array($result)) {
    $tdc_id = isset($data['tdc_id']) ? $data['tdc_id'] : '';
    $tdc_created = isset($data['tdc_created']) ? $data['tdc_created'] : '';
    $tdc_invalid = date('Y-m-d H:i:s', strtotime( $tdc_created . " +1 days"));
    if ($today >= $tdc_invalid) {
        mysqli_query($conn, "DELETE FROM tbl_tdc WHERE tdc_id = '$tdc_id'");
    } else {
        // echo '
        // <script>
        //     alert("alert");
        // </script>
        // ';
    }
}
 ?>