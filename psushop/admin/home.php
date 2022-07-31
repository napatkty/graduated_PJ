<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../header.php'); ?>
    <title>Admin</title>
</head>

<body>
    <?php include('menu_admin.php'); ?>
    <div class="container">
        <h2>รายชื่อสมาชิก</h2>
        <p></p>
        <?php
        include('../connectDB.php');
        $sql_member = "SELECT * FROM `member`WHERE status_id = 1";
        $result = mysqli_query($conn, $sql_member);
        ?>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Tel</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?= $row['member_id'] ?></td>
                        <td><?= $row['member_name'] ?></td>
                        <td><?= $row['member_lastname'] ?></td>
                        <td><?= $row['e-mail'] ?></td>
                        <td><?= $row['tell'] ?></td>
                        <td><select class="form-control" id="mb_status" onchange="updatestatus('<?= $row['member_id'] ?>')">
                                <option value="">เลือกสถานะ</option>
                                <option value="0">ปฏิเสธการเป็นสมาชิก</option>
                                <option value="2">ให้สมาชิกมีสถานะถูก BAN </option>
                            </select></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script>
        function updatestatus(params) {
            var st = document.getElementById('mb_status').value
            //alert("memId" + params + "status" + st)
            $.post("update_status.php", {
                    status: st,
                    member_id: params
                },
                function(data, status) {
                    alert("อัพเดทสถานะแล้ว");
                    window.location.reload();
                });
        }
    </script>
</body>

</html>