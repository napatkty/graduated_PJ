<?php
$user_id = $_POST['user_id'];
$user_password = $_POST['user_password'];
$user_name = $_POST['user_name'];
$user_lastname = $_POST['user_lastname'];
$Tell = $_POST['Tell'];
$email = $_POST['email'];
$address = $_POST['address'];

include('../connectDB.php');
$sql_insert = "INSERT INTO `member`(`member_id`, `member_name`, `member_lastname`, `member_password`, `address`, `tell`, `e-mail` , `status_id`) 
VALUES ('$user_id','$user_name','$user_lastname','$user_password','$address','$Tell','$email','0')";

mysqli_query($conn,$sql_insert);
//echo $sql_insert;
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
        alert("กรุณารอแอดมินทำการยืนยันการสมัคร");
       window.location.href="shop.php";
    </script>
</body>
</html>