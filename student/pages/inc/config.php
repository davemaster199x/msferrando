<?php
session_start();
include("../connection.php");
date_default_timezone_set('Asia/Manila');
$stud_id = $_SESSION['stud_id'];
$result = mysqli_query($conn, "SELECT * FROM tbl_student INNER JOIN tbl_book ON tbl_student.stud_id = tbl_book.stud_id WHERE tbl_student.stud_id = '$stud_id' AND book_status = 0 LIMIT 1");
$data = mysqli_fetch_assoc($result);
$today = date('Y-m-d H:i:s');
$book_id = isset($data['book_id']) ? $data['book_id'] : '';
$tdc_created = isset($data['tdc_created']) ? $data['tdc_created'] : '';
$tdc_invalid = date('Y-m-d H:i:s', strtotime( $tdc_created . " +1 days"));
if ($today >= $tdc_invalid) {
    mysqli_query($conn, "DELETE FROM tbl_book WHERE book_id = '$book_id'");
} 
if (empty($_SESSION['stud_id'])) {
    header("Location: ../index.php");
}
 ?>