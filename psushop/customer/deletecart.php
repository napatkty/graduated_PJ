<?php
include('../connectDB.php');

$list_id = $_GET['list_id'];
$sql_addstatus = "DELETE FROM order_list  WHERE list_id = '$list_id'";
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
        window.location.href = "index.php?page=cart";
    </script>
</body>

</html>