<?php
$status = $_POST['status'];
$order_id = $_POST['order_id'];
include('../connectDB.php');
$sql = "UPDATE orders SET status_order_id = '$status' WHERE order_id = '$order_id' ";
mysqli_query($conn, $sql);
echo $sql;
?>