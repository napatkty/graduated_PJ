<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('../header.php'); ?>
    <title>Admin</title>
</head>

<body>
    <?php include('menu_admin.php'); ?>
    <div class="container">
        <h2>อนุญาตการเป็นสมาชิก</h2>
        <p></p>
        <?php
        include('../connectDB.php');
        $sql_member="SELECT * FROM `member`WHERE status_id = 0";
        $result=mysqli_query($conn,$sql_member);
        ?>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Tell</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?=$row['member_id']?></td>
                    <td><?=$row['member_name']?></td>
                    <td><?=$row['member_lastname']?></td>
                    <td><?=$row['e-mail']?></td>
                    <td><?=$row['tell']?></td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="Add('<?=$row['member_id']?>')">Add</button>
                        <button type="button" class="btn btn-danger"onclick="Delete('<?=$row['member_id']?>')">Delete</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script >
        function Add(params) {
            window.location.href = 'add_status.php?member_id='+params;
        }
        function Delete(params) {
            window.location.href = 'delete_status.php?member_id='+params;
        }
    </script>
</body>
</html>