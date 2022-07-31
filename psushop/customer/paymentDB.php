<?php
$target_dir = "slip_custom/";
$target_file = $target_dir . basename($_FILES["payment_slip"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["payment_slip"]["tmp_name"]);
if ($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    //echo "File is not an image.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["payment_slip"]["tmp_name"], $target_file)) {
        //echo "The file " . htmlspecialchars(basename($_FILES["s_img"]["name"])) . " has been uploaded.";
    } else {
        // echo "Sorry, there was an error uploading your file.";
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["payment_slip"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

$name_pm = $_POST['name_pm'];
$lastname_pm = $_POST['lastname_pm'];
$address = $_POST['address'];
$payment_slip = $_FILES['payment_slip']['name'];
$time_stamp = date("Y-m-d H:i:s");
$order_id = $_POST['order_id'];
include('../connectDB.php');
session_start();
//echo "sessiom".$_SESSION['member_id'];
$sql_insert = "INSERT INTO `payment`(`payment_id`, `address`, `name_pm`, `lastname_pm`, `payment_slip`, `order_id`, `time_stamp`) 
VALUES (NULL,'$address','$name_pm','$lastname_pm','$payment_slip','$order_id','$time_stamp')";

mysqli_query($conn, $sql_insert);
$sql_update = "UPDATE orders SET status_order_id='1' WHERE order_id = '$order_id'";
mysqli_query($conn, $sql_update);
//echo "<br>".$sql_insert;

$select_shop = "SELECT stock_id, num_buy FROM order_list WHERE order_id = '$order_id'";
//echo $select_shop;
$query = mysqli_query($conn, $select_shop);
$shop_list = array();

while ($a = mysqli_fetch_assoc($query)) {
    array_push($shop_list, $a);
}
//print_r($shop_list);
$loop = 0;
while ($loop < count($shop_list)) {
    $nb = $shop_list[$loop]['num_buy'];
    $st = $shop_list[$loop]['stock_id'];
    $sqlUp = "UPDATE stock SET s_quantity = s_quantity- $nb WHERE s_id = '$st'";
    //echo $shop_list[$loop]['num_buy']."<br>".$sqlUp;
    mysqli_query($conn, $sqlUp);
    $loop++;
}

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
        alert("รอดำเนินการยืนยันคำสั่งซื้อ");
        window.location.href = "index.php?page=status_order";
    </script>
</body>

</html>