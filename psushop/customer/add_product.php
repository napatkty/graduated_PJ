<!DOCTYPE html>
<html lang="en">

<head>

    <title>Document</title>
    <?php include('../header.php'); ?>
</head>

<body>
    <div class="container">
        <h2>กรอกรายละเอียดสินค้า</h2>
        <form action="add_productDB.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>ชื่อสินค้า:</label>
                <input type="text" class="form-control" id="s_name" placeholder="กรอกชื่อสินค้า" name="s_name">
            </div>
            <div class="form-group">
                <label>รายละเอียดสินค้า:</label>
                <input type="text" class="form-control" id="s_desc" placeholder="รายละเอียดของสินค้า" name="s_desc">
            </div>
            <div class="form-group">
                <label> ราคา :</label>
                <input type="text" class="form-control" id="s_price" placeholder="ราคา" name="s_price">
            </div>
            <div class="form-group">
                <label> จำนวน :</label>
                <input type="text" class="form-control" id="s_quantity" placeholder="จำนวนสินค้า" name="s_quantity">
            </div>
            <div class="form-group">
                <label> รูปสินค้า :</label>
                <input type="file" class="form-control" id="s_img" placeholder="รูปภาพของสินค้า" name="s_img">
            </div>
            <div class="form-group">
                <label for="email">วันที่ :</label>
                <input type="date" class="form-control" id="s_date_added" placeholder="วันที่" name="s_date_added">
            </div>
            

           
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>