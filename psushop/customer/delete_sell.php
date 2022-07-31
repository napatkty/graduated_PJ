<?php
include('../connectDB.php');
session_start();
$user_id = $_SESSION['member_id'];
$s_id = $_GET['s_id'];
$sql_addstatus = "DELETE FROM stock  WHERE s_id = '$s_id'";
$query = mysqli_query($conn, $sql_addstatus);
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
        alert("ลบสำเร็จ");
        window.location.href = "index.php?page=sell";
    </script>
</body>

</html>