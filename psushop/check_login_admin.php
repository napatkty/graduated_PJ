<?php
include('connectDB.php');
$admin_member = $_POST['username'];
$admin_password = $_POST['password'];

$select_admin = "SELECT * FROM `admin` WHERE admin_id = '$admin_member' AND admin_password = '$admin_password'" ;

$query_admin = mysqli_query($conn,$select_admin);

$numrow = mysqli_num_rows($query_admin);
// echo $numrow;
$row = mysqli_fetch_assoc($query_admin);

if ($numrow >0) {
    session_start();
    $_SESSION['admin_id'] = $row['admin_id'];
    header( "location: admin/home.php" );
} else {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
    alert('ชื่อผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง');
    window.location.href = 'login_admin.php';
    </script>
</body>
</html>
<?php
}
