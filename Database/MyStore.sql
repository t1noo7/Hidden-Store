-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2025 at 03:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MyStore`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(9, 'Swiggy'),
(10, 'Zomato'),
(11, 'Mc.Donner'),
(12, 'Nike'),
(13, 'Adidas'),
(14, 'Amazon'),
(15, 'Babyboo Fashion Haul'),
(16, 'Hoka'),
(17, 'Human Breast');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(10, 'Fruits'),
(11, 'Fashion'),
(12, 'Juices'),
(13, 'Vegetables'),
(14, 'Milk Products'),
(15, 'Books'),
(16, 'Chips'),
(17, 'Drinks'),
(18, 'Fine Flour Product'),
(19, 'Animals'),
(20, 'Sketch Books');

-- --------------------------------------------------------

--
-- Table structure for table `order_pending`
--

CREATE TABLE `order_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_pending`
--

INSERT INTO `order_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 1, 104350446, 17, 1, 'pending'),
(2, 1, 411147831, 16, 1, 'pending'),
(3, 1, 126198365, 19, 1, 'pending'),
(4, 1, 2074901543, 14, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `datetime`, `status`) VALUES
(9, 'Fresh Mangos', 'Mangoes are always tasty. Eat once you will ask for more', 'mango,fresh mango,zomato', 10, 10, 'mango.jpg', 'Mango2.png', 'mango3.jpg', '200', '2025-05-31 09:55:33', 'true'),
(10, 'Fresh Apples', 'An apple a day keeps doctor away, try it!', 'apple,fresh apple,zomato', 10, 10, 'apples.jpg', 'apples2.jpg', 'apples3.png', '300', '2025-05-31 10:31:56', 'true'),
(11, 'Shoes', 'Shoes Online - Shop shoes online for Men, Women and Kids at 70% discount', 'shoe,sneaker,running shoes', 11, 16, 'shoes.jpg', 'shoes2.jpg', 'shoes3.jpg', '1300', '2025-05-31 10:38:24', 'true'),
(12, 'Supercool Frocks', 'It is simply another name for a dress commonly used in the UK', 'frocks,dress,women fashion', 11, 15, 'shortfrocks2.jpg', 'shorfrock.jpg', 'shortfrocks3.jpg', '1500', '2025-05-31 10:55:49', 'true'),
(13, 'Torn Jeans', 'Buy jeans for Men, Women & Kids online from our store, shop the latest collections', 'jeans,torn jeans,ripped jeans,men fashion,women fashion,kids fashion', 11, 9, 'jeans.jpg', 'jeans2.jpg', 'jeans3.jpg', '2000', '2025-05-31 11:01:44', 'true'),
(14, 'Milk products', 'Milk is a nutrient-rich liquid food produced by the mammary glands of mammals', 'dairy,milk,fresh milk,dairy milk,milk product', 14, 17, 'milkprod5.jpg', 'milk.jpg', 'milkprod.jpg', '1700', '2025-05-31 14:27:30', 'true'),
(15, 'Wisconsin Cheese', 'Treat EGGs do a morning. Wake up Call!', 'cheese,fresh cheese,wisconsin cheese,milk,milk product', 14, 9, 'cheese.jpg', 'cheese2.jpg', 'cheese3.jpeg', '1250', '2025-06-01 13:10:46', 'true'),
(16, 'Fresh Juices', 'Sip the Sun! Freshly Squeezed Juices That Burst with Flavor.', 'juice,fresh juice,fruits,fruits juice', 10, 10, 'juice2.jpg', 'juice.jpg', 'juice3.jpg', '150', '2025-06-01 13:29:21', 'true'),
(17, 'Coke', 'Cool fresh. Say whaaat?', 'coke,coca-cola,coca', 17, 10, 'coke.jpg', 'coke2.jpg', 'coke3.jpeg', '330', '2025-06-01 15:15:17', 'true'),
(18, 'Trivia Night Bakery', 'The Catchy Bakery. Love at first bite!', 'baked,bakery,bread,fresh bread', 18, 11, 'bakery2.jpg', 'bakery3.jpg', 'bakery8.jpg', '10000', '2025-06-01 15:22:07', 'true'),
(19, 'Areyou serious???', 'HOMELESS...', 'cat,homeless,wonder lust', 19, 11, 'cat5.png', 'cat4.png', 'cat3.jpg', '100000', '2025-06-01 15:31:31', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 1, 100480, 126198365, 3, '2025-06-02 17:37:28', 'pending'),
(2, 1, 3200, 2074901543, 2, '2025-06-02 18:33:25', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_method`, `date`) VALUES
(2, 2, 2074901543, 3200, 'cash on delivery', '2025-06-02 18:33:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_phone`) VALUES
(1, 'miak10021993', 'miakhalifa93_inquiries@myotis.co', '$2y$10$GLhzmRpAz.5ueaP5e.m10uZaOWBB1HAJdRWZJIG7bkiuokJoWD3G.', 'mia5.jpg', '::1', 'Beirut, Lebanon', '+5511997818953'),
(3, 'yua_mikami160893', 'yua@sushischool.jp', '$2y$10$K.PPFUVAEi1J8dhex9tF.O/HAQ92lEOZ.vuMYle3gCvhfFggMXWXq', 'yua.jpg', '::1', 'Nagoya, Japan', '+44 ** **** *653');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `order_pending`
--
ALTER TABLE `order_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_pending`
--
ALTER TABLE `order_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
