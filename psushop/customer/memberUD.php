<?php 
include('../connectDB.php');
session_start();
$member_name = $_POST['member_name'];
$member_lastname = $_POST['member_lastname'];
$address = $_POST['address'];
$tell= $_POST['tell'];
$email = $_POST['email'];
$sql_update = "UPDATE `member` SET `member_name`='$member_name',`member_lastname`= '$member_lastname',
`address`='$address',`tell`='$tell',`e-mail`='$email' WHERE member_id='$_SESSION[member_id]'";
mysqli_query($conn,$sql_update);

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
        alert("แก้ไขเรียบร้อย");
        window.location.href="index.php?page=home";
    </script>
</body>
</html>