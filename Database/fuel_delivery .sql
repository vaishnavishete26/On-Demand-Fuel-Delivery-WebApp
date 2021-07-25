-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 08:07 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuel_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `fld_id` int(10) NOT NULL,
  `fld_username` varchar(30) NOT NULL,
  `fld_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`fld_id`, `fld_username`, `fld_password`) VALUES
(1, 'admin', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `fld_cart_id` int(11) NOT NULL,
  `fld_product_id` bigint(11) NOT NULL,
  `fld_customer_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`fld_cart_id`, `fld_product_id`, `fld_customer_id`) VALUES
(29, 13, 'mariajones@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `fld_cust_id` int(10) NOT NULL,
  `fld_name` varchar(30) NOT NULL,
  `fld_email` varchar(30) NOT NULL,
  `fld_mobile` bigint(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`fld_cust_id`, `fld_name`, `fld_email`, `fld_mobile`, `password`, `address`) VALUES
(4, 'Maria Jones', 'mariajones@gmail.com', 9821966552, 'mariajones', 'A102,Sreekrupa,Pune,Maharashtr'),
(6, 'Vaishnavi Vijay Shete', 'vaishnavishete26@gmail.com', 8999918915, 'V123456', 'Pune');

-- --------------------------------------------------------

--
-- Table structure for table `fuel`
--

CREATE TABLE `fuel` (
  `fuel_id` int(11) NOT NULL,
  `fldvendor_id` int(11) NOT NULL,
  `fuelname` varchar(100) NOT NULL,
  `cost` bigint(15) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `paymentmode` varchar(50) NOT NULL,
  `fldimage` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fuel`
--

INSERT INTO `fuel` (`fuel_id`, `fldvendor_id`, `fuelname`, `cost`, `quantity`, `paymentmode`, `fldimage`) VALUES
(10, 25, 'Bharat-Petroleum Petrol', 77, '1 ltr', 'COD,Online Payment', '101157144-petrol-logo-isolated-on-white-background-for-your-web-and-mobile-app-design-colorful-vector-icon.jpg'),
(11, 26, 'HP Petrol', 85, '1 ltr', 'COD', '1564041975417_0..webp'),
(12, 25, 'Bharat-Petroleum Diesel', 90, '1 ltr', 'COD', '109356838-diesel-in-sale-allowed-to-buy-diesel-fuel-gas-station-red-circular-road-sign-isolated.jpg'),
(13, 26, 'HP Diesel', 97, '1 ltr', 'COD', '9763f034872d30433c054f6073baae59.png'),
(14, 27, 'Indian-Oil Petrol', 80, '1', 'COD', '1564041975417_0..webp');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `fld_msg_id` int(10) NOT NULL,
  `fld_name` varchar(50) NOT NULL,
  `fld_email` varchar(50) NOT NULL,
  `fld_phone` bigint(10) DEFAULT NULL,
  `fld_msg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`fld_msg_id`, `fld_name`, `fld_email`, `fld_phone`, `fld_msg`) VALUES
(1, 'Vaishnavi Vijay Shete', 'vaishnavishete26@gmail.com', 8999918915, 'Hiii'),
(2, 'Vaishnavi Vijay Shete', 'vaishnavishete26@gmail.com', 8999918915, 'Hiii');

-- --------------------------------------------------------

--
-- Table structure for table `myorder`
--

CREATE TABLE `myorder` (
  `fld_order_id` int(10) NOT NULL,
  `fld_cart_id` bigint(10) NOT NULL,
  `fldvendor_id` bigint(10) DEFAULT NULL,
  `fld_fuel_id` bigint(10) DEFAULT NULL,
  `fld_email_id` varchar(50) DEFAULT NULL,
  `fld_payment` varchar(20) DEFAULT NULL,
  `fldstatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `myorder`
--

INSERT INTO `myorder` (`fld_order_id`, `fld_cart_id`, `fldvendor_id`, `fld_fuel_id`, `fld_email_id`, `fld_payment`, `fldstatus`) VALUES
(1, 1, 21, 1, 'customer3@gmail.com', '50', 'Delivered'),
(2, 2, 22, 3, 'customer3@gmail.com', '20', 'Out Of Stock'),
(3, 3, 22, 2, 'mariajones@gmail.com', '50', 'Delivered'),
(4, 4, 24, 8, 'mariajones@gmail.com', '300', 'Delivered'),
(5, 5, 25, 10, 'mariajones@gmail.com', '77', 'Delivered'),
(6, 6, 25, 10, 'mariajones@gmail.com', '77', 'cancelled'),
(7, 7, 25, 10, 'mariajones@gmail.com', '77', 'cancelled'),
(8, 10, 26, 11, 'mariajones@gmail.com', '85', 'cancelled'),
(9, 11, 26, 13, 'mariajones@gmail.com', '97', 'cancelled'),
(10, 15, 26, 13, 'mariajones@gmail.com', '97', 'cancelled'),
(11, 16, 25, 10, 'mariajones@gmail.com', '77', 'In Process'),
(12, 17, 25, 12, 'vaishnavishete26@gmail.com', '83', 'cancelled'),
(13, 19, 26, 13, 'mariajones@gmail.com', '97', 'In Process'),
(15, 21, 27, 14, 'vaishnavishete26@gmail.com', '80', 'Delivered'),
(16, 22, 27, 14, 'vaishnavishete26@gmail.com', '80', 'cancelled'),
(17, 23, 25, 10, 'vaishnavishete26@gmail.com', '77', 'cancelled'),
(18, 24, 27, 14, 'vaishnavishete26@gmail.com', '80', 'cancelled'),
(20, 27, 27, 14, 'vaishnavishete26@gmail.com', '80', 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `fldvendor_id` int(10) NOT NULL,
  `fld_name` varchar(30) NOT NULL,
  `fld_email` varchar(50) NOT NULL,
  `fld_password` varchar(50) NOT NULL,
  `fld_mob` bigint(10) NOT NULL,
  `fld_phone` bigint(10) NOT NULL,
  `fld_address` varchar(50) NOT NULL,
  `fld_logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`fldvendor_id`, `fld_name`, `fld_email`, `fld_password`, `fld_mob`, `fld_phone`, `fld_address`, `fld_logo`) VALUES
(25, 'Bharat Petroleum', 'bharatpetrol@gmail.com', 'bharatpetrol', 9722097265, 112737611, 'Bharat Petroleum, E-67, Sector 18, New Panvel', 'bpcl.jpg'),
(26, 'HP Petroleum', 'hppetrol@gmail.com', 'hppetrol', 9731676623, 112376771, 'Bhumi Heritage, D-4, Sector 2, Kharghar, Navi Mumb', 'images.png'),
(27, 'Indian Oil', 'indianoil@gmail.com', 'Indian123', 8999918915, 111234567, 'Mumbai', 'img4_indexpage.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`fld_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`fld_cart_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`fld_cust_id`);

--
-- Indexes for table `fuel`
--
ALTER TABLE `fuel`
  ADD PRIMARY KEY (`fuel_id`),
  ADD KEY `fldvendor_id` (`fldvendor_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`fld_msg_id`);

--
-- Indexes for table `myorder`
--
ALTER TABLE `myorder`
  ADD PRIMARY KEY (`fld_order_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`fldvendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `fld_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `fld_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `fld_cust_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fuel`
--
ALTER TABLE `fuel`
  MODIFY `fuel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `fld_msg_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `myorder`
--
ALTER TABLE `myorder`
  MODIFY `fld_order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `fldvendor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fuel`
--
ALTER TABLE `fuel`
  ADD CONSTRAINT `fuel_ibfk_1` FOREIGN KEY (`fldvendor_id`) REFERENCES `vendor` (`fldvendor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
