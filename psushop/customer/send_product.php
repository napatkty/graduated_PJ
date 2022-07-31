<?php
//echo $_SESSION['member_id']."var";
session_start();
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
    <div class="container-fluid">
        <h2 class="mt-2">สินค้าที่ต้องจัดส่ง</h2>
        <?php
        include('../connectDB.php');
        //session_start();
        $sql_member = "SELECT ol.*, o.buyer_id, o.status_order_id, s.s_name, s.s_price, 
        p.address,p.name_pm,p.lastname_pm,s.s_img FROM order_list ol 
        LEFT JOIN orders o ON ol.order_id = o.order_id 
        LEFT JOIN stock s ON ol.stock_id = s.s_id 
        LEFT JOIN payment p ON ol.order_id = p.order_id 
        WHERE s.s_user = '$_SESSION[member_id]' AND o.status_order_id = '2'";
        //echo $sql_member;
        $result = mysqli_query($conn, $sql_member);
        ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อสินค้า</th>
                    <th>ภาพสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                    <th>ชื่อลูกค้า</th>
                    <th>ที่อยู่</th>
                    <th>สถานะส่งสินค้า</th>
                    <th>สถานะรับสินค้า</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>

                        <td><?= $no ?></td>
                        <td><?= $row['s_name'] ?></td>
                        <td><img src="imgs/<?= $row['s_img'] ?>" width="100px" height="100px"></td>
                        <td><?= $row['num_buy'] ?></td>
                        <td><?= $row['s_price'] ?></td>
                        <td><?= $row['name_pm'] . ' ' . $row['lastname_pm'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['status_sell'] ?></td>
                        <td><?= $row['status_recive'] ?></td>

                        <td>
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">อัพเดทสถานะ</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="updatestatus('<?= $row['list_id'] ?>', 'ส่งสินค้าแล้ว')">ส่งสินค้าแล้ว</a>
                                    <a class="dropdown-item" href="#" onclick="updatestatus('<?= $row['list_id'] ?>', 'สินค้าถึงแล้ว')">สินค้าถึงแล้ว</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
    <script>
        function updatestatus(params, st) {
            var r = confirm("ยืนยันอัพเดทสถานะการส่งสินค้า");
            if (r == true) {
                $.post("update_status_order_list.php", {
                        list_id: params,
                        status: st
                    },
                    function(data, status) {
                        console.log('success');
                    });
                window.location.reload()
            } else {

            }
        }
    </script>
</body>

</html>