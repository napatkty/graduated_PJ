<?php
$status = $_POST['status'];
$list_id = $_POST['list_id'];
include('../connectDB.php');
$sql = "UPDATE order_list SET status_sell = '$status' WHERE list_id = '$list_id' ";
mysqli_query($conn, $sql);
echo $sql;
?>