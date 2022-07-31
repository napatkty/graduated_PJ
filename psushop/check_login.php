<?php
include('connectDB.php');
$user_member = $_POST['username'];
$User_password = $_POST['password'];

$select_user = "SELECT * FROM `member` WHERE member_id = '$user_member' AND member_password = '$User_password' AND status_id = '1'";

$query_user = mysqli_query($conn,$select_user);

$numrow = mysqli_num_rows($query_user);
// echo $numrow;
$row = mysqli_fetch_assoc($query_user);
if ($numrow >0) {
    session_start();
    //echo $row['member_id'];
    $_SESSION['member_id'] = $row['member_id'];
    header( "location: customer/index.php" );
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
    window.location.href = 'customer_login.php';
    </script>
</body>
</html>
<?php
}
