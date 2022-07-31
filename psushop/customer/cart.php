<?php
//echo $_SESSION['member_id']."var";
if ($_SESSION['member_id'] == "") {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../header.php');
    ?>
    <title>Document</title>
</head>

<body>
    <?php
    include('menu_sell.php');
    ?>
    <div class="container">
        <h2>ตะกร้าสินค้าของฉัน</h2>

        <?php
        include('../connectDB.php');
        //session_start();
        // $in = "INSERT INTO `status_orders`(`st_id`, `st_name`) VALUES 

        // (null,'รอดำเนินการชำระเงิน'),
        // (null,'รอดำเนินการตรวจสอบการชำระเงิน'),
        // (null,'การยืนยันเสร็จสิ้น'),
        // (null,'ไม่อนุมัติการซื้อ')";
        // mysqli_query($conn, $in);
        $select_order = "SELECT * FROM `orders`WHERE buyer_id = '$_SESSION[member_id]' AND status_order_id='0'";
        $result = mysqli_query($conn, $select_order);
        $row1 = mysqli_fetch_assoc($result);
        $numrow = mysqli_num_rows($result);
        //echo $numrow;
        if ($numrow == 0) {
            echo "<h2>ยังไม่มีสินค้า</h2>";
        } else {

            //echo $select_order;
            $select_shop = "SELECT s.s_user FROM order_list ol LEFT JOIN stock s ON ol.stock_id = s.s_id WHERE ol.order_id = '$row1[order_id]' GROUP BY s.s_user";
            $query = mysqli_query($conn, $select_shop);
            $shop_list = array();
            while ($a = mysqli_fetch_assoc($query)) {
                array_push($shop_list, $a['s_user']);
            }
            //echo $select_shop;
            //print_r($shop_list);
            //echo "<br>".$shop_list[0]['0'];
            //echo $row1['order_id'];
            $total = 0;
            $n = 0;
            while ($n < count($shop_list)) {
                $select_product = "SELECT ol.*,s.s_name,s.s_price,s.s_img,s.s_user,s.s_id FROM order_list ol
              LEFT JOIN stock s ON ol.stock_id = s.s_id WHERE  s.s_user = $shop_list[$n] AND ol.order_id = '$row1[order_id]'";
                $select_shopname = "SELECT member_name,member_lastname FROM member s
              WHERE member_id = $shop_list[$n]";
                $q = mysqli_query($conn, $select_shopname);
                $row_name = mysqli_fetch_assoc($q);
                $query_shop = mysqli_query($conn, $select_product);
                //echo $select_product;
        ?>
                <p>ชื่อร้านค้า : <?= $row_name['member_name'] . " " . $row_name['member_lastname'] ?> </p>
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>รูปภาพ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($query_shop)) {
                            $str = $row['s_id'];
                            //echo $str;
                            $select_qn = "SELECT s_quantity FROM stock WHERE s_id = " . $str . "";
                            $qn = mysqli_query($conn, $select_qn);
                            $rowqn = mysqli_fetch_assoc($qn);

                            //echo "*******";
                            //echo $rowqn['s_quantity'];
                            //echo "*******";
                            //echo $row['num_buy'];

                            if (number_format($row['num_buy']) <= number_format($rowqn['s_quantity'])) {
                                //echo "***";



                        ?>

                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['s_id'] ?></td>
                                    <td><?= $row['s_name'] ?></td>
                                    <td><?= $row['s_price'] ?></td>
                                    <td><?= $row['num_buy'] ?></td>
                                    <td><img src="imgs/<?= $row['s_img'] ?>" width="100px" height="100px"></td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="Delete('<?= $row['list_id'] ?>')">ลบ</button>
                                    </td>
                                </tr>




                            <?php
                                $total += $row['s_price'] * $row['num_buy'];
                                $no++;
                            } ?>

                        <?php

                        } ?>
                    </tbody>
                </table>
            <?php
                $n++;
            }

            ?>
            <div class="row">
                <div class="col-12">
                    <div class="float-right"><label class="mr-2 " id="total">ราคาทั้งหมด : <?= $total ?></label>
                        <button class="btn btn-success " onclick="payment('<?= $row1['order_id'] ?>')">ชำระเงิน</button></div>
                </div>
            </div>
    </div>
<?php } ?>
<!-- The Modal -->
<div class="modal fade" id="payment">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">ชำระเงิน</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img src="imgs/QR1.jpg" width="200px" height="200px" alt="">
                        </div>
                    </div>
                    <form enctype="multipart/form-data" method="post" action="paymentDB.php">

                        <div class="row mb-2">
                            <div class="col">
                                <input type="text" class="form-control" id="name_pm" placeholder="ชื่อ" name="name_pm">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="lastname_pm" placeholder="นามสกุล" name="lastname_pm">
                                <input type="hidden" class="form-control" id="order_id" placeholder="นามสกุล" name="order_id">
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <textarea rows="3" type="text" class="form-control" id="address" placeholder="ที่อยู่" name="address"></textarea>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                สลิป
                            </div>
                            <div class="col">
                                <input type="file" class="form-control" id="payment_slip" name="payment_slip">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success"> บันทึก</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
<script>
    function edit(params) {
        window.location.href = 'edit_sell.php?id_goods=' + params;
    }

    function Delete(params) {

        var r = confirm("ยืนยันการลบรายการ");
        if (r == true) {
            window.location.href = 'deletecart.php?list_id=' + params;
        } else {

        }

    }

    function payment(params) {
        document.getElementById('order_id').value = params;
        $('#payment').modal();
        console.log(params);
    }
</script>
</body>

</html>