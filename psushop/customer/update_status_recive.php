<?php
$status = $_POST['status'];
$list_id = $_POST['list_id'];
include('../connectDB.php');
$sql = "UPDATE `order_list` SET `status_recive` = 'ได้รับสินค้าแล้ว' WHERE `order_list`.`list_id` = $list_id;";
mysqli_query($conn, $sql);
echo $sql;
?>