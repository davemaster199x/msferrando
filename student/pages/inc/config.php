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
if (empty($_SESSION['stud_id'])) {
    header("Location: ../index.php");
}
 ?>