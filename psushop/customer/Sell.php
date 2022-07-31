<?php
//echo $_SESSION['member_id']."var";
if ($_SESSION['member_id'] == "") {
    header( "location: index.php" );
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
        <h2>รายการสินค้าของฉัน</h2>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-success float-right mb-1" href="add_product.php">เพิ่ม</a>
            </div>
        </div>
        <?php
        include('../connectDB.php');
        //session_start();
        $sql_member = "SELECT * FROM `stock`WHERE s_user = '$_SESSION[member_id]'";
        $result = mysqli_query($conn, $sql_member);
        ?>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียด</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>รูปภาพ</th>
                    <th>เวลา</th>
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
                        <td><?= $row['s_desc'] ?></td>
                        <td><?= $row['s_price'] ?></td>
                        <td><?= $row['s_quantity'] ?></td>
                        <td><img src="imgs/<?= $row['s_img'] ?>" width="100px" height="100px"></td>
                        <td><?= $row['s_date_added'] ?></td>

                        <td>
                            <button type="button" class="btn btn-primary" onclick="edit('<?= $row['s_id'] ?>')">แก้ไข</button>
                            <button type="button" class="btn btn-danger" onclick="Delete('<?= $row['s_id'] ?>')">ลบ</button>
                        </td>
                    </tr>
                <?php $no++;} ?>
            </tbody>
        </table>
    </div>
    <script>
        function edit(params) {
            window.location.href = 'edit_sell.php?id_goods=' + params;
        }

        function Delete(params) {
           
            var r = confirm("ยืนยันการลบรายการ");
            if (r == true) {
                window.location.href = 'delete_sell.php?s_id=' + params;
            } else {
                
            }
           
        }
    </script>
</body>

</html>