<?php
// Get the 4 most recently added products
session_start();
include('../connectDB.php');
$sql_history = "SELECT o.*,so.st_name,p.payment_slip FROM orders o 
LEFT JOIN status_orders so ON o.status_order_id=so.st_id 
LEFT JOIN payment p ON o.order_id = p.order_id
WHERE o.status_order_id = '1'";
$result_history = mysqli_query($conn, $sql_history);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../header.php'); ?>
    <title>Admin</title>
</head>

<body>
    <?php
    //echo $var."var";
    include('menu_admin.php');

    ?>
    <div class="container-fluid">
        <div class="recentlyadded content-wrapper">
            <h2>ยืนยันการชำระเงิน</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Slip</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result_history)) {

                    ?>
                        <tr>
                            <td><?= $row['order_id'] ?></td>
                            <td><?= $row['date'] ?></td>
                            <td><?= $row['st_name'] ?></td>
                            <td><img src="../customer/slip_custom/<?= $row['payment_slip'] ?>" width="200px" height="400px"></td>
                            <td><button class="btn btn-info" onclick="hist('<?= $row['order_id'] ?>')">ดูรายละเอียด</button></td>
                            <td>
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">เลือกสถานะ</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="updateOrders('<?= $row['order_id'] ?>', '2')">การชำระเงินเรียบร้อย</a>
                                        <a class="dropdown-item" href="#" onclick="updateOrders('<?= $row['order_id'] ?>', '3')">ไม่อนุมัติการชำระเงิน</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="history">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ประวัติการซื้อ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container-fluid" id="showData">

                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        function hist(oid) {
            $.post("open_his.php", {
                    order_id: oid
                },
                function(data, status) {
                    document.getElementById('showData').innerHTML = data;
                });
            $('#history').modal();
        }

        function updateOrders(params, value) {
            var r = confirm("ยืนยันอัพเดทสถานะการชำระเงิน");
            if (r == true) {
                $.post("update_status_payment.php", {
                        order_id: params,
                        status: value
                    },
                    function(data, status) {
                        window.location.reload()
                    });

            } else {

            }
        }
    </script>
</body>

</html>