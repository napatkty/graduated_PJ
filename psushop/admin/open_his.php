
        <?php
        include('../connectDB.php');
        $order_ids = $_POST['order_id'];
        //echo $select_order;
        $select_shop = "SELECT s.s_user FROM order_list ol LEFT JOIN stock s ON ol.stock_id = s.s_id WHERE ol.order_id = '$order_ids' GROUP BY s.s_user";
        $query = mysqli_query($conn, $select_shop);
        $shop_list = array();
        while ($a = mysqli_fetch_assoc($query)) {
            array_push($shop_list, $a['s_user']);
        }
        $total = 0;
        $n = 0;
        $data = array();
        while ($n < count($shop_list)) {
            $select_product = "SELECT ol.*,s.s_name,s.s_price,s.s_img,s.s_user FROM order_list ol
              LEFT JOIN stock s ON ol.stock_id = s.s_id WHERE s.s_user = $shop_list[$n] AND ol.order_id = '$order_ids'";
            // echo $select_product;
            $select_shopname = "SELECT member_name,member_lastname FROM member 
              WHERE member_id = $shop_list[$n]";
            $q = mysqli_query($conn, $select_shopname);
            $row_name = mysqli_fetch_assoc($q);
            $query_shop = mysqli_query($conn, $select_product);
            $query_shop2 = mysqli_query($conn, $select_product);

            //echo $select_product;
            while ($row = mysqli_fetch_assoc($query_shop2)) {
                array_push($data, $row);
            }
            //print_r($data);
            echo "<p style='font-weight:boldsss'>ชื่อร้านค้า : $row_name[member_name]  $row_name[member_lastname]</p>
            <table border='1' width='100%' style='margin-bottom:10px'> 
            <tr>
            <th>ชื่อ</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>ภาพสินค้า</th>
            <th>สถานะสินค้า</th>
            <th>สถานะรับสินค้า</th>
            </tr>";
            $no = 0;
            while ($no < count($data)) {
               // echo "<br>".$data[$no]['s_name'].$data[$no]['s_price'].$data[$no]['num_buy'].$data[$no]['s_img'];
                echo"
                    <tr>
                        <td>".$data[$no]['s_name']."</td>
                        <td>".$data[$no]['s_price']."</td>
                        <td>".$data[$no]['num_buy']."</td>
                        <td><img src='../customer/imgs/".$data[$no]['s_img']."' width='100' height='100'></td>
                        <td>".$data[$no]['status_sell']."</td>
                        <td>".$data[$no]['status_recive']."</td>
                    </tr>
                ";
                $total += $data[$no]['s_price']*$data[$no]['num_buy'];
                $no++;
            }
            echo "</table>";
            
            $n++;
        }
        echo "<h3>ราคารวม : $total</h3>";
