<?php
//echo $_SESSION['member_id']."var";
if ($_SESSION['member_id'] == "") {
    header( "location: index.php" );
}
?>
<?php
// Get the 4 most recently added products
include('../connectDB.php');
$sql_history = "SELECT o.*,so.st_name FROM orders o LEFT JOIN status_orders so ON o.status_order_id=so.st_id 
WHERE buyer_id = '$_SESSION[member_id]' ";
$result_history = mysqli_query($conn, $sql_history);

?>

<?= template_header('ดูสถานะสินค้า') ?>
<?php 
$var = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : '';
//echo $var."var";
if ($var == '') {
    include('menu_nologin.php');
} else {
    include('menuLogin.php');
}
?>
<div class="recentlyadded content-wrapper">
    <h2>ดูสถานะ</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Date</th>
                <th>Status</th>
                <th></th>
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
                    <td><button class="btn btn-info" onclick="hist('<?= $row['order_id'] ?>')">ดูรายละเอียด</button></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
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
    function updatestatus(params, st) {
            var r = confirm("ยืนยันอัพเดทสถานะรับสินค้า");
            if (r == true) {
                $.post("update_status_recive.php", {
                        list_id: params,
                        status: 'ได้รับสินค้าแล้ว'
                    },
                    function(data, status) {
                        console.log('success');
                    });
                window.location.reload()
            } else {

            }
        }
</script>
<?= template_footer() ?>