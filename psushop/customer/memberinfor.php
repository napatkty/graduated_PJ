<?php
//echo $_SESSION['member_id']."var";
if ($_SESSION['member_id'] == "") {
    header( "location: index.php" );
}
?>
<?php
include('../connectDB.php');
// Get the 4 most recently added products
// session_start();
$stmt = "SELECT * FROM member WHERE member_id = '$_SESSION[member_id]'";
$query = mysqli_query($conn,$stmt);
$row = mysqli_fetch_assoc($query);
?>

<?= template_header('Home') ?>
<?php 
$var = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : '';
//echo $var."var";
if ($var == '') {
    include('menu_nologin.php');
} else {
    include('menuLogin.php');
}
?>

<div class="recentlyadded content-wrapper">
    <h2>แก้ไขข้อมูลส่วนตัว</h2>
    <form action="memberUD.php" method="POST">
        <div class="form-group">
            <label for="member_name">ชื่อ :</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อ" id="member_name"
             name="member_name" value="<?=$row['member_name']?>">
        </div>
        <div class="form-group">
            <label for="member_lastname">นามสกุล :</label>
            <input type="text" class="form-control" placeholder="กรุณากรอกนามสกุล" id="member_lastname" 
            name="member_lastname" value="<?=$row['member_lastname']?>">
        </div>
        <div class="form-group">
            <label for="address">ที่อยู่ :</label>
            <input type="text" class="form-control" placeholder="กรอกที่อยู่ใหม่" id="address"
             name="address" value="<?=$row['address']?>">
        </div>
        <div class="form-group">
            <label for="tell">เบอร์ :</label>
            <input type="text" class="form-control" placeholder="กรอกเบอร์โทรศัพท์ใหม่" id="tell" 
            name="tell" value="<?=$row['tell']?>">
        </div>
        <div class="form-group">
            <label for="email">E-mail :</label>
            <input type="email" class="form-control" placeholder="กรอกเบอร์ E-mail ใหม่" id="email"
             name="email" value="<?=$row['e-mail']?>">
           
        </div>
        
    
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<?= template_footer() ?>