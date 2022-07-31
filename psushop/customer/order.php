<?php
session_start();
include('../connectDB.php');

function selectOrderId($conn, $sql)
{
    $query1 = mysqli_query($conn, $sql);
    $row1 = mysqli_fetch_assoc($query1);
    return $row1['order_id'];
}

$s_id = $_POST['s_id'];
$numbuy = $_POST['s_numbuy'];
$s_user = $_POST['s_user'];
$s_price = $_POST['s_price'];
$date_order = date("Y-m-d");
$order_id = "";
$sql_check_order = "SELECT order_id FROM orders WHERE buyer_id = '$_SESSION[member_id]'AND status_order_id=0";
$query = mysqli_query($conn, $sql_check_order);
//echo $sql_check_order;
$numrow = mysqli_num_rows($query);
$row = mysqli_fetch_assoc($query);
if ($numrow > 0) {
    $order_id = $row['order_id'];
} else {
    $sql_insert_order = "INSERT INTO `orders`(`order_id`, `date`, `buyer_id`, `status_order_id`)
     VALUES (NULL,'$date_order','$_SESSION[member_id]','0')";
    mysqli_query($conn, $sql_insert_order);
    $order_id = selectOrderId($conn, $sql_check_order);
}
//echo $order_id;

$sql_insert_orderdetail = "INSERT INTO `order_list`(`list_id`, `order_id`, `stock_id`, `num_buy`, `status_list_id`) 
VALUES (NULL,'$order_id','$s_id','$numbuy','0')";
mysqli_query($conn, $sql_insert_orderdetail);
echo $sql_insert_orderdetail;
