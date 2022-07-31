-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2020 at 09:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psushop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(10) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_password`) VALUES
('1234567890', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `goods_id` varchar(10) NOT NULL,
  `seller_id` varchar(10) NOT NULL,
  `num_items` int(11) NOT NULL,
  `price` float NOT NULL,
  `name_goods` varchar(50) NOT NULL,
  `details` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` varchar(10) NOT NULL,
  `member_name` varchar(50) NOT NULL,
  `member_lastname` varchar(50) NOT NULL,
  `member_password` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `tell` varchar(10) NOT NULL,
  `e-mail` varchar(50) NOT NULL,
  `admin_approve_id` varchar(10) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_name`, `member_lastname`, `member_password`, `address`, `tell`, `e-mail`, `admin_approve_id`, `status_id`) VALUES
('1111111111', 'รัชมน', 'ตันติย์ขจร', '123456', '88', '0869321654', 'ratchamon@gmail.com', '1234567890', 2),
('2222222222', 'มนพัทธ์', 'เหรัญณุภากุญ', '123456', '14', '0935886124', 'monnaphathae@gmail.com', '1234567890', 1),
('3333333333', 'กวิวัชร์', 'เกรียงไกร', '123456', '4', '0934569981', 'kaviwathkavin@hotmail.com', '1234567890', 1),
('5910210185', 'บุญสิริ', 'ขวัญทองยิ้ม', '123456789', '8/11', '0968043617', '5910210185@gmail.com', '1234567890', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `payment_slip` varchar(100) NOT NULL,
  `buyer_id` varchar(10) NOT NULL,
  `status_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `payment_slip` varchar(100) NOT NULL,
  `buyer_id` varchar(10) NOT NULL,
  `status_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `date`, `payment_slip`, `buyer_id`, `status_order_id`) VALUES
(25, '2020-11-19', '', '3333333333', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `list_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `stock_id` int(10) NOT NULL,
  `num_buy` int(11) NOT NULL,
  `status_list_id` int(11) NOT NULL,
  `status_sell` varchar(100) NOT NULL DEFAULT 'รอจัดส่งสินค้า',
  `status_recive` varchar(100) NOT NULL DEFAULT 'ยังไม่ได้รับสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`list_id`, `order_id`, `stock_id`, `num_buy`, `status_list_id`, `status_sell`, `status_recive`) VALUES
(32, 25, 16, 1, 0, 'ได้รับสินค้าแล้ว', 'ได้รับสินค้าแล้ว'),
(33, 25, 15, 1, 0, 'รอจัดส่งสินค้า', 'ได้รับสินค้าแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `address` varchar(500) COLLATE utf8mb4_thai_520_w2 NOT NULL,
  `name_pm` varchar(50) COLLATE utf8mb4_thai_520_w2 NOT NULL,
  `lastname_pm` varchar(50) COLLATE utf8mb4_thai_520_w2 NOT NULL,
  `payment_slip` varchar(200) COLLATE utf8mb4_thai_520_w2 NOT NULL,
  `order_id` int(10) NOT NULL,
  `time_stamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_thai_520_w2;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `address`, `name_pm`, `lastname_pm`, `payment_slip`, `order_id`, `time_stamp`) VALUES
(24, '99/441', 'ทดสอบ', 'ยืนยัน', 'scb-easy-app-11.jpg', 25, '2020-11-19 21:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES
(1, 'Smart Watch', '<p>Unique watch made with stainless steel, ideal for those that prefer interative watches.</p>\r\n<h3>Features</h3>\r\n<ul>\r\n<li>Powered by Android with built-in apps.</li>\r\n<li>Adjustable to fit most.</li>\r\n<li>Long battery life, continuous wear for up to 2 days.</li>\r\n<li>Lightweight design, comfort on your wrist.</li>\r\n</ul>', '29.99', '0.00', 10, 'watch.jpg', '2019-03-13 17:55:22'),
(2, 'Wallet', '', '14.99', '19.99', 34, 'wallet.jpg', '2019-03-13 18:52:49'),
(3, 'Headphones', '', '19.99', '0.00', 23, 'headphones.jpg', '2019-03-13 18:47:56'),
(4, 'Digital Camera', '', '69.99', '0.00', 7, 'camera.jpg', '2019-03-13 17:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `status_list`
--

CREATE TABLE `status_list` (
  `status_list_id` int(11) NOT NULL,
  `status_list_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_list`
--

INSERT INTO `status_list` (`status_list_id`, `status_list_name`) VALUES
(0, 'waiting for payment'),
(1, 'watting for Admin appove your '),
(2, 'Finished');

-- --------------------------------------------------------

--
-- Table structure for table `status_member`
--

CREATE TABLE `status_member` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_member`
--

INSERT INTO `status_member` (`status_id`, `status_name`) VALUES
(0, 'not member'),
(1, 'member'),
(2, 'BAN');

-- --------------------------------------------------------

--
-- Table structure for table `status_order`
--

CREATE TABLE `status_order` (
  `status_order_id` int(11) NOT NULL,
  `status_order_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_thai_520_w2 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_order`
--

INSERT INTO `status_order` (`status_order_id`, `status_order_name`) VALUES
(0, '???????????????????'),
(1, '\0\0??\0\0\0?\0\0\0?\0\0\0?\0\0\0?'),
(2, '\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?'),
(6, '\0\0\0?\0\0\0?\0\0\0?\0\0\0?\0\0\0?');

-- --------------------------------------------------------

--
-- Table structure for table `status_orders`
--

CREATE TABLE `status_orders` (
  `st_id` int(6) NOT NULL,
  `st_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_orders`
--

INSERT INTO `status_orders` (`st_id`, `st_name`) VALUES
(0, 'รอดำเนินการชำระเงิน'),
(1, 'รอดำเนินการตรวจสอบการชำระเงิน'),
(2, 'การยืนยันเสร็จสิ้น'),
(3, 'ไม่อนุมัติการซื้อ');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(20) COLLATE utf8mb4_thai_520_w2 NOT NULL,
  `s_desc` varchar(200) COLLATE utf8mb4_thai_520_w2 NOT NULL,
  `s_price` float NOT NULL,
  `s_quantity` int(11) NOT NULL,
  `s_img` varchar(200) COLLATE utf8mb4_thai_520_w2 NOT NULL,
  `s_date_added` date NOT NULL,
  `s_user` varchar(10) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_thai_520_w2;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`s_id`, `s_name`, `s_desc`, `s_price`, `s_quantity`, `s_img`, `s_date_added`, `s_user`) VALUES
(3, 'เมาส์', 'green', 890, 32, 'mouse2.jpg', '2020-11-14', '3333333333'),
(4, 'เมาส์', 'สีนีออน', 350, 3, 'mouse3.jpg', '2020-11-14', '3333333333'),
(5, 'เมาส์', 'สีดำ', 129, 1, 'download.jpg', '2020-11-14', '3333333333'),
(6, 'ปากกา', 'สวย', 54, 11, 'download (1).jpg', '2020-11-14', '2222222222'),
(7, 'ปากกา', 'blue', 14, 3, 'download (2).jpg', '2020-11-14', '2222222222'),
(8, 'ปากกา', 'แพ็คน้ำเงิน', 79, 10, 'download (3).jpg', '2020-11-14', '2222222222'),
(9, 'ตุ๊กตา', 'สีน้ำตาล', 350, 2, 'download (4).jpg', '2020-11-14', '2222222222'),
(10, 'ตุ๊กตา', 'ไอ้เขียว', 280, 229, 'Slide125.jpg', '2020-11-14', '2222222222'),
(11, 'ตุ๊กตา', 'ไอ้เทา', 500, 4, 'ปุ๊กเทา.webp', '2020-11-14', '2222222222'),
(13, 'หมวก', 'สีดำ', 899, 3, 'หมวกดำ.jpg', '2020-11-14', '2222222222'),
(14, 'หมวก', 'หมวกบีน สีเหลืองหล่อเท่', 320, 2, 'บีนเหลือง.jpg', '2020-11-21', '2222222222'),
(15, 'หมวก', 'สีดำadidas', 399, 2, 'อะดิ.jpg', '2020-11-12', '2222222222'),
(16, 'หมวก', 'FILA', 890, 2, 'ฟิล่าแดง.jpg', '2020-11-14', '2222222222'),
(17, 'หมวกFILA', 'สวย', 699, 1, 'ฟิล่าแดง.jpg', '2020-11-14', '2222222222'),
(18, 'หมวกadidas', 'สีดำ', 469, 0, 'อะดิ.jpg', '2020-11-14', '2222222222'),
(20, 'รองเท้าผ้าใบ Corza', 'รองเท้ากีฬารุ่น Corza สำหรับวิ่ง สีส้ม-เทา สภาพใหม่ ขนาดไซส์ 7.5US  ', 1250, 0, 'รองเท้าส้ม.jpg', '2020-11-15', '3333333333'),
(21, 'เสื้อ', 'กกก', 655, 0, 'kidkai.DOP-325เสื้อยืดการ์ตูนวันพีซ-Law-T-Shirt-One-Piece-Law-1.jpg', '2020-11-16', '5910210185');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`goods_id`),
  ADD KEY `Goods_fk0` (`seller_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `Member_fk1` (`status_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `Order_fk0` (`buyer_id`),
  ADD KEY `Order_fk1` (`status_order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `status_order_id` (`status_order_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `Order_list_fk0` (`order_id`),
  ADD KEY `Order_list_fk2` (`status_list_id`),
  ADD KEY `Order_list_fk1` (`stock_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_list`
--
ALTER TABLE `status_list`
  ADD PRIMARY KEY (`status_list_id`);

--
-- Indexes for table `status_member`
--
ALTER TABLE `status_member`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `status_order`
--
ALTER TABLE `status_order`
  ADD PRIMARY KEY (`status_order_id`);

--
-- Indexes for table `status_orders`
--
ALTER TABLE `status_orders`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `list_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status_member`
--
ALTER TABLE `status_member`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_orders`
--
ALTER TABLE `status_orders`
  MODIFY `st_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `Goods_fk0` FOREIGN KEY (`seller_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `Member_fk1` FOREIGN KEY (`status_id`) REFERENCES `status_member` (`status_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `Order_fk0` FOREIGN KEY (`buyer_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `Order_fk1` FOREIGN KEY (`status_order_id`) REFERENCES `status_orders` (`st_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_order_id`) REFERENCES `status_orders` (`st_id`);

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `Order_list_fk2` FOREIGN KEY (`status_list_id`) REFERENCES `status_list` (`status_list_id`),
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`s_id`),
  ADD CONSTRAINT `order_list_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
