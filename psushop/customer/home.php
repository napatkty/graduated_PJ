<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM stock ORDER BY s_date_added DESC LIMIT 8');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>
<?php 
$var = isset($_SESSION['member_id']) ? $_SESSION['member_id'] : '';
//echo $var."var";
if ($var == '') {
    include('menu_nologin.php');
} else {
    include('menuLogin.php');
}
?>
<div class="featured">
    
</div>
<div class="recentlyadded content-wrapper">
    <h2>สินค้าล่าสุด</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['s_id']?>" class="product">
            <img src="imgs/<?=$product['s_img']?>" width="200" height="200" alt="<?=$product['s_name']?>">
            <span class="name"><?=$product['s_name']?></span>
            <span class="price">
                <?=$product['s_price']?> บาท
                
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>


<?=template_footer()?>