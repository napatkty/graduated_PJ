<?= template_header('Products') ?>
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
    <h2>สินค้าทั้งหมด</h2>
    <div class="products">
        <?php
        include('../connectDB.php');
        $perpage = 12;
        if (isset($_GET['npage'])) {
            $page = $_GET['npage'];
        } else {
            $page = 1;
        }
        $start = ($page - 1) * $perpage;
        $sql = "select s.*,m.member_name,m.member_lastname from stock s LEFT JOIN member m ON s.s_user = m.member_id WHERE s.s_quantity > 0 ORDER BY s_id DESC limit {$start} , {$perpage} ";
        $query = mysqli_query($conn, $sql);
        // echo $sql;
        while ($result = mysqli_fetch_assoc($query)) {
        ?>
            <a href="#" onclick="openproduct('<?= $result['s_img'] ?>','<?= $result['s_name'] ?>','<?= $result['s_price'] ?>',
            '<?= $result['s_quantity'] ?>','<?= $result['s_desc'] ?>','<?= $result['s_id'] ?>','<?= $result['s_user'] ?>',
            '<?= $result['member_name'] ?>','<?= $result['member_lastname'] ?>')" class="product">
                <img src="imgs/<?= $result['s_img'] ?>" width="200" height="200" alt="<?= $result['s_name'] ?>">
                <span class="name"><?= $result['s_name'] ?></span>
                <span class="price">
                    <?= $result['s_price'] ?> บาท

                </span>
            </a>
        <?php } ?>
    </div>
</div>

<?php
$sql2 = "select s.*,m.member_name,m.member_lastname from stock s LEFT JOIN member m ON s.s_user = m.member_id WHERE s.s_quantity > 0";
$query2 = mysqli_query($conn, $sql2);
$total_record = mysqli_num_rows($query2);
$total_page = ceil($total_record / $perpage);
?>
<div class="container">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="index.php?page=product&npage=1">Previous</a></li>
        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
            <li><a class="page-link" href="index.php?page=product&npage=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li>
        <li class="page-item"><a class="page-link" href="index.php?page=product&npage=<?php echo $total_page; ?>">Next</a></li>
    </ul>
</div>

<!-- The Modal -->
<div class="modal fade" id="productdetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">รายละเอียดสินค้า</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <img id="picProduct" src="imgs/mouse3.jpg" width="300px" height="400px">
                    </div>
                    <div class="col-6">

                        <p id="s_name">ตุ๊กตา</p>
                        <p id="s_price">ราคา : 390</p>
                        <p id="s_quantity">จำนวนสินค้า : 2</p>
                        <p id="s_desc">รายละเอียดสินค้า :tggggggggggggggggggggggggggggggggggggggggg
                            ggggggggggggggggggggggggggggggggggggggggggggggggggg
                            ggggggggggggggggggggggg </p>
                    </div>
                    <input type="hidden" id="stock_id" name="stock_id">
                    <input type="hidden" id="stock_quantity" name="stock_quantity">
                    <input type="hidden" id="stock_user" name="stock_user">

                    <input type="hidden" id="stock_price" name="stock_price">
                </div>
                <div class="row">
                    <div class="col-12">
                        <u>
                            <h2 id="nameshop">ชื่อร้านค้า : ชนิดา</h2>
                        </u>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <form class="form-inline" action="/action_page.php">
                    <label for="number">จำนวน:</label>
                    <input type="number" class="form-control" id="newnumber" placeholder="กรุณากรอกจำนวนสินค้า" name="newnumber">

                    <button type="button" onclick="addorder()" class="btn btn-primary">ซื้อสินค้า</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                </form>

            </div>

        </div>
    </div>
</div>
<?php $login = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : 'no';
/* if ($login == "") {
    $login = "no";
} */
?>
<script>
    var login = '<?= $login ?>';


    function openproduct(img, name, price, quantity, desc, id, user, namemember, lastname) {
        console.log('img', img);
        console.log('name', name);
        console.log('price', price);
        console.log('quantity', quantity);
        console.log('desc', desc);
        document.getElementById('s_name').innerHTML = 'ชื่อสินค้า : ' + name;
        document.getElementById('s_price').innerHTML = 'ราคา : ' + price + " บาท";
        document.getElementById('s_quantity').innerHTML = 'คลัง : ' + quantity;
        document.getElementById('s_desc').innerHTML = 'รายละเอียดสินค้า : ' + desc;
        document.getElementById("picProduct").src = "imgs/" + img;
        document.getElementById("stock_id").value = id;
        document.getElementById("stock_quantity").value = quantity;
        document.getElementById("stock_user").value = user;
        document.getElementById("stock_price").value = price;
        document.getElementById('nameshop').innerHTML = 'ชื่อร้าน : ' + namemember + ' ' + lastname;

        $('#productdetail').modal();
    }

    function addorder() {
        if (login != 'no') {
            var quantity = parseInt(document.getElementById("stock_quantity").value);
            var numbuy = parseInt(document.getElementById("newnumber").value);
            
            if ( numbuy > quantity) {
                alert("จำนวนสินค้าไม่เพียงพอ"); 
                
            } else {
                $.post("order.php", {
                        s_id: document.getElementById("stock_id").value,
                        s_numbuy: numbuy,
                        s_user: document.getElementById("stock_user").value,
                        s_price: document.getElementById("stock_price").value
                    },
                    function(data, status) {
                        alert("เพิ่มสินค้าในตะกร้าเรียบร้อยแล้ว");
                        $('#productdetail').modal('hide');
                    });
            }
        } else {
            alert("ไม่สามารถซื้อได้")
        }
        

    }
</script>
<?= template_footer() ?>