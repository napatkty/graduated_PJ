<?php
$target_dir = "imgs/";
$target_file = $target_dir . basename($_FILES["s_img"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["s_img"]["tmp_name"]);
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
    if (move_uploaded_file($_FILES["s_img"]["tmp_name"], $target_file)) {
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
if ($_FILES["s_img"]["size"] > 500000) {
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

$s_name = $_POST['s_name'];
$s_desc = $_POST['s_desc'];
$s_price = $_POST['s_price'];
$s_quantity = $_POST['s_quantity'];
$s_date_added = $_POST['s_date_added'];
$s_img = $_FILES['s_img']['name'];

include('../connectDB.php');
session_start();
//echo "sessiom".$_SESSION['member_id'];
$sql_insert = "INSERT INTO `stock`(`s_id`, `s_name`, `s_desc`, `s_price`, `s_quantity`, 
`s_img`, `s_date_added`, `s_user`) VALUES (NULL,'$s_name','$s_desc','$s_price','$s_quantity','$s_img',
'$s_date_added','$_SESSION[member_id]')";

mysqli_query($conn, $sql_insert);
//echo "<br>".$sql_insert;
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
        alert("ทำเพิ่มเพิ่มรายการสำเร็จ");
        window.location.href = "index.php?page=sell";
    </script>
</body>

</html>