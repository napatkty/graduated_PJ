<?php 
include('../connectDB.php');
session_start();
$admin_id = $_SESSION['admin_id'];
$member_id = $_GET['member_id'];
$sql_addstatus = "UPDATE member SET status_id = 2 ,admin_approve_id = '$admin_id' WHERE member_id = '$member_id'";
$query=mysqli_query($conn,$sql_addstatus);
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
        alert("ปฏิเสธการเป็นสมาชิก");
       window.location.href="home.php";
    </script>
</body>
</html>