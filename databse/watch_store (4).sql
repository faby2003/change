-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 07:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watch_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandname` varchar(40) NOT NULL,
  `brandid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandname`, `brandid`) VALUES
('FastTrack', 2),
('CASIO', 5),
('SONATA', 6),
('TITAN', 7),
('ROLEX', 8),
('RADO', 9),
('Cabinate', 10),
('RAM', 11),
('ROM', 12),
('Graphics Card', 13);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cid`, `user_id`, `product_id`) VALUES
(21, 25, 3),
(25, 14, 7),
(26, 14, 21),
(28, 14, 6),
(29, 20, 2),
(30, 20, 24),
(31, 20, 24);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(20) NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'watch'),
(2, 'Accessories'),
(3, 'Luxury Collection'),
(4, 'limited edition');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `password` varchar(30) NOT NULL,
  `usertype` int(4) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`password`, `usertype`, `email`) VALUES
('asd', 1, 'thufail9613@gmail.com'),
('asd', 1, 'thufail9613@gmail.com'),
('qwerty', 1, 'm@gmail.com'),
('9613', 1, 'remu@gmail.com'),
('123', 1, 'mmm3@gmail.com'),
('3366', 1, 'kunj@gmail.com'),
('admin123', 0, 'admin@gmail.com'),
('1010', 1, 'adhiiikuttan@gmail.com'),
('123456789', 1, 'midhu@gmail.com'),
('123456', 1, '123g@gmail.com'),
('Pork@123', 1, 'bork@gmail.com'),
('Ramlath@123', 1, 'ramlath9613@gmail.com'),
('fathimafathima', 2, 'fathima@gmail.com'),
('shammeee', 2, 'shameem@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(40) NOT NULL,
  `address` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `quantity`, `order_date`, `total_price`, `status`, `address`) VALUES
(11, 14, 2, 1, '2024-09-20 09:48:00', 15000.00, 'COD', 'Gokulam(h) near perikapalam aluva-2'),
(12, 14, 2, 1, '2024-09-28 07:37:43', 15000.00, 'COD', 'sdsass'),
(13, 14, 2, 1, '2024-09-29 20:34:55', 15000.00, 'COD', 'gdssrhg'),
(14, 20, 1, 1, '2024-09-29 20:39:10', 10000.00, 'COD', 'xdsds'),
(15, 14, 2, 1, '2024-10-08 15:48:55', 15000.00, 'COD', 'padinjakkara'),
(16, 27, 22, 1, '2024-10-08 19:39:48', 249300.00, 'COD', 'kummanod'),
(17, 14, 9, 1, '2024-10-08 21:00:02', 3995.00, 'COD', 'padinjakkara'),
(18, 28, 6, 1, '2024-10-08 22:46:31', 1095.00, 'COD', 'kakkanad'),
(19, 15, 20, 1, '2024-12-19 06:41:39', 437700.00, 'Paid', 'ergj');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `model` varchar(30) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(30) NOT NULL,
  `image` varchar(50) NOT NULL,
  `productid` int(10) NOT NULL,
  `pdiscription` varchar(200) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`model`, `price`, `quantity`, `image`, `productid`, `pdiscription`, `brand`, `category`) VALUES
('GA 1000', 15000, 45, 'gshock.avif', 2, 'From G-SHOCK, the toughness watches that are ever evolving in an endless pursuit of strength, this combination model combines analog and digital displays. Equipped with a millisecond stopwatch and spe', 'casio', 'watch'),
('F-91W-1', 1095, 98, 'image.avif', 6, 'Casio Youth Series Digital Black Dial Unisex Watch - F-91W-1Q(D002)', '5', 'watch'),
('A168WEUC-1A', 7995, 50, 'image (1).avif', 7, 'Introducing a one-of-a-kind design that brings together the nostalgia of Casio and the classic card game sensation you know and love, Mattel’s UNO™!   This singular collaboration begins with the popul', '5', 'watch'),
('LTP-1234DD-1A', 3695, 50, 'image (2).avif', 8, 'Make a singular statement with the timelessness of a classic analog watch with tonneau case.  Water resistance for daily use frees you from worry when washing up or out in the rain.', '5', 'limited edition'),
('Fastrack Vivid Pro Smart dial', 3995, 49, '38110PP01_1.webp', 9, 'Fastrack Vivid Pro Smart dial Silicone Strap Watch for Unisex', '2', 'watch'),
('Fastrack Quartz Analog', 2555, 50, '3273NM01_1.webp', 10, 'Fastrack Quartz Analog Black Dial Black Stainless Steel Strap Watch for Guys', '2', 'limited edition'),
('Fastrack Tick Tock Quartz Anal', 4545, 50, '3287KM06_1.webp', 11, 'Fastrack Tick Tock Quartz Analog Black Dial With Black Stainless steel Strap Watch for Guys', '2', 'watch'),
('Fastrack Opulence Sun Moon Chr', 6395, 50, '3315KM01_1.webp', 12, 'Fastrack Opulence Sun Moon Chronograph Black Dial Black Metal Strap Analog Quartz Watch For Guys', '2', 'watch'),
('Sonata Unveil Quartz ', 3499, 50, '7140KM02_1.webp', 13, 'Sonata Unveil Quartz Analog Silver Dial Stainless Steel Strap Watch for Men', '6', 'limited edition'),
('SF Hexa Metal', 1449, 50, '77134PM01W_1.webp', 14, 'SF Hexa Metal Digital Digital Black Dial Stainless Steel Strap Watch for Unisex', '6', 'watch'),
('SF Vigour Quartz', 1495, 50, '87058PP03_1.webp', 15, 'SF Vigour Quartz Digital Analog Digital Black Dial With Black Color Plastic Strap Watch For Unisex', '6', 'limited edition'),
('Sonata Floral Folkart ', 945, 50, '8976YL04_1.webp', 16, 'Sonata Floral Folkart Pink Dial Women Watch With Leather Strap', '6', 'watch'),
('Sonata Traditional Essentials ', 1775, 50, '77083BM01_1.webp', 17, 'Sonata Traditional Essentials Quartz Analog Green Dial Stainless Steel Strap Watch for Men', '6', 'watch'),
('Sonata Poze Quartz', 1500, 50, 'SP80051KD01W_1.webp', 18, 'Sonata Poze Quartz Analog Mother Of Pearl Dial Metal & Plastic Strap Watch for Women', '6', 'watch'),
('Day-Date', 999999, 10, 'new-watches-2024-day-date-cover-m228235-0055_2401j', 19, 'Everose Day-Date Fashioned from 18 kt Everose gold, this version of the Oyster Perpetual Day-Date 40 introduces a slate ombré dial. This new ombré hue offers a delicate transition between light at the', '8', 'Luxury Collection'),
('Captain Cook High-Tech Ceramic', 437700, 29, 'captaincook_r32148162_sld_web.avif', 20, 'The Captain Cook High-Tech Ceramic Skeleton showcases its innovative R808 movement, a marvel of contrasts, know-how and clever geometry, that allows a distinct view of the various parts. It’s equipped', '9', 'Luxury Collection'),
('DiaStar Original Automatic', 188400, 30, 'diastar_r12161653_sld_web.avif', 21, 'The unique DiaStar Original has a diameter of 38 mm and is water resistant down to 100 m. Framed by an ultra-shiny yellow gold couloured Ceramos™ coiffe with polished angles and detailing set over a m', '9', 'Luxury Collection'),
('Captain Cook Over-Pole', 249300, 29, 'captaincook_r32116158_sld_web.avif', 22, 'The Captain Cook Over-Pole is an iconic “worldtimer” watch with a rotating bezel with some city names engraved in order to read the time in multiple time zones at glance. This vintage style watch has ', '9', 'Luxury Collection'),
('g shock', 1500, 50, 'Gshock-GA110-straps-1.webp', 23, 'g shock g100 watch strap set', 'CASIO', 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `created_at`, `status`) VALUES
(1, 'fathima', 'fathima@gmail.com', '2024-11-07 06:47:23', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Name` varchar(15) NOT NULL,
  `Number` varchar(25) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Address` varchar(40) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `UserID` int(10) NOT NULL,
  `status` varchar(10) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Number`, `Email`, `Address`, `Password`, `UserID`, `status`) VALUES
('Muhammed Thufai', '9569569565', 'thufail9613@gmail.com', 'padinjakkara', 'asd', 14, 'inactive'),
('midlaj', '2147483647', 'm@gmail.com', 'qwerty', 'qwerty', 15, 'active'),
('ramesh', '1234567890', 'remu@gmail.com', 'arrrstd', '9613', 16, 'active'),
('Midhuna', '456987890', 'mmm3@gmail.com', 'jjjjj', '123', 17, 'active'),
('kunjmon', '1554466878', 'kunj@gmail.com', 'heuidg', '3366', 18, 'active'),
('adhikuttan', '2147483647', 'adhiiikuttan@gmail.com', 'zsdsdsdsadas', '1010', 20, 'active'),
('Anubhav', '123456789', '123g@gmail.com', 'HMT', '123456', 26, 'active'),
('K N shahar', '9526917338', 'bork@gmail.com', 'kummanod', 'Pork@123', 27, 'active'),
('Ramlath P P', '9562565843', 'ramlath9613@gmail.com', 'kakkanad', 'Ramlath@123', 28, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
