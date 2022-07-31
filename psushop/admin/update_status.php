<?php
$status = $_POST['status'];
$member_id = $_POST['member_id'];
include('../connectDB.php');
$sql = "UPDATE member SET status_id = '$status' WHERE member_id = '$member_id' ";
mysqli_query($conn, $sql);
echo "success";
?>