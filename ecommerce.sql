-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2023 at 10:01 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `cat_name`, `added_date`) VALUES
(1, 'cap', '2023-04-26 20:04:23'),
(2, 'android', '2023-04-26 20:05:00'),
(3, 'mans wear', '2023-04-26 20:05:16'),
(4, 'females wear', '2023-04-26 20:05:22'),
(5, 'sapa', '2023-04-26 20:28:01'),
(6, 'wristband', '2023-04-27 08:59:37'),
(7, 'iphone', '2023-04-29 17:33:27');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `id` int NOT NULL,
  `surname` varchar(100) NOT NULL,
  `other_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `pin` varchar(40) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `address` longtext,
  `status` varchar(20) DEFAULT NULL,
  `usertype` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `picture` varchar(300) DEFAULT NULL,
  `session` varchar(300) DEFAULT NULL,
  `auth` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`id`, `surname`, `other_name`, `email`, `phone`, `balance`, `pin`, `gender`, `state`, `address`, `status`, `usertype`, `password`, `picture`, `session`, `auth`) VALUES
(2, 'afolabi', 'temidayo timothy', 'afolabi8120@gmail.com', '0809094966900', 0.00, '4d8556', 'Male', 'Osun State', 'No. 1, Michael O Babatunde Ave, off Jankara Road, Ijaiye, Ojokoro, Lagos State.', 'active', 'admin', '827ccb0eea8a45&%Cdfgak1Waq7', 'IMG-2023-04-2827256412.jpg', 'p513fpp2cb6crhm3lciv5m1jkr', 'on'),
(3, 'albert', 'faith segun', 'albert@gmail.com', '08090949660', 228300.00, '4d8556', 'Male', 'Abia State', 'Tebun Fagbemi Street, off Nureni Yusuff Rd, Lagos State', 'active', 'customer', '827ccb0eea8a45&%Cdfgak1Waq7', 'IMG-2023-04-29428efa31.jpg', 'p513fpp2cb6crhm3lciv5m1jkr', 'on'),
(4, 'idowu', 'emmanuel tobiloba', 'emmytromal@protonmail.com', '', 0.00, '', '', '', '', 'active', 'customer', '8875ded0f79345&%Cdfgak1Waq7', '', 'a0l342q6blktrdf9nijdfcfohi', 'on'),
(11, 'bakare', 'abdullahi', 'ablinks@gmail.com', '08125488456', 3000.00, '865bed', 'Male', 'Lagos State', '28, Akogun street, ojo, lagos', 'active', 'customer', '827ccb0eea8a45&%Cdfgak1Waq7', '', 'md28hluo1fr9qs4k2q01c0q6g7', 'on'),
(13, 'test', 'test', 'test@gmail.com', '', 10000.00, '95F687', '', '', '', 'active', 'customer', '827ccb0eea8a45&%Cdfgak1Waq7', '', '471o675fjc3i094qgjj43pgarq', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `id` int NOT NULL,
  `invoiceno` varchar(100) NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`id`, `invoiceno`, `customer_id`, `product_id`, `price`, `quantity`, `total`, `status`) VALUES
(27, '20230503645224192589F1683104793', 3, 32, 3000.00, 1, 3000.00, 1),
(28, '20230512645E660A1A9C31683908106', 3, 36, 3800.00, 1, 3800.00, 1),
(29, '20230512645E660A1A9C31683908106', 3, 32, 3000.00, 1, 3000.00, 1),
(30, '20230512645E660A1A9C31683908106', 3, 35, 2700.00, 1, 2700.00, 1),
(41, '202305176464DFD14955A1684332497', 3, 36, 3800.00, 1, 3800.00, 1),
(42, '202305176464DFD14955A1684332497', 3, 35, 2700.00, 2, 5400.00, 1),
(43, '2023072464BE4C11960D81690192913', 3, 32, 3000.00, 2, 6000.00, 1),
(44, '2023072464BE4C11960D81690192913', 3, 33, 3800.00, 1, 3800.00, 1),
(45, '2023072464BE4C11960D81690192913', 3, 35, 2700.00, 1, 2700.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_payment`
--

CREATE TABLE `tblorder_payment` (
  `id` int NOT NULL,
  `invoiceno` varchar(100) DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `other_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `address` longtext,
  `amount` decimal(10,2) DEFAULT NULL,
  `order_status` int DEFAULT NULL,
  `date_paid` varchar(20) DEFAULT NULL,
  `time_paid` varchar(20) DEFAULT NULL,
  `payment_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblorder_payment`
--

INSERT INTO `tblorder_payment` (`id`, `invoiceno`, `customer_id`, `surname`, `other_name`, `email`, `phone`, `gender`, `state`, `address`, `amount`, `order_status`, `date_paid`, `time_paid`, `payment_status`) VALUES
(30, '20230503645224192589F1683104793', 3, 'albert', 'faith segun', 'albert@gmail.com', '08090949660', 'Male', 'Abia State', 'Tebun Fagbemi Street, off Nureni Yusuff Rd, Lagos State', 3000.00, 0, '03 May 2023 10:06 AM', '10:06 AM', 1),
(32, '20230512645E660A1A9C31683908106', 3, 'albert', 'faith segun', 'albert@gmail.com', '08090949660', 'Male', 'Abia State', 'Tebun Fagbemi Street, off Nureni Yusuff Rd, Lagos State', 9500.00, 0, '12 May 2023 5:15 PM', '5:15 PM', 1),
(33, '202305176464DFD14955A1684332497', 3, 'albert', 'faith segun', 'albert@gmail.com', '08090949660', 'Male', 'Abia State', 'Tebun Fagbemi Street, off Nureni Yusuff Rd, Lagos State', 9200.00, 0, '17 May 2023 3:08 PM', '3:08 PM', 1),
(34, '2023072464BE4C11960D81690192913', 3, 'albert', 'faith segun', 'albert@gmail.com', '08090949660', 'Male', 'Abia State', 'Tebun Fagbemi Street, off Nureni Yusuff Rd, Lagos State', 12500.00, 0, '24 Jul 2023 11:01 AM', '11:01 AM', 1),
(35, '2023072464BE4C11960D81690192913', 3, 'albert', 'faith segun', 'albert@gmail.com', '08090949660', 'Male', 'Abia State', 'Tebun Fagbemi Street, off Nureni Yusuff Rd, Lagos State', 12500.00, 0, '24 Jul 2023 11:01 AM', '11:01 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `new_price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `description` longtext NOT NULL,
  `category_id` int NOT NULL,
  `stock` int NOT NULL,
  `status` int NOT NULL,
  `picture` varchar(300) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `product_name`, `sku`, `new_price`, `old_price`, `description`, `category_id`, `stock`, `status`, `picture`, `added_date`, `updated_date`) VALUES
(31, 'iphone 6s plus', 'PRO-7637378', 68000.00, 70000.00, 'This is an Iphone 6s UK used description', 7, 21, 1, 'PRO20230429348011.png', '2023-04-29 17:34:30', '29 Apr 2023 10:44 PM'),
(32, 'mens mini clothe', 'PRO-378829', 3000.00, 0.00, 'Just a sample clothe description', 3, 38, 1, 'PRO2023042908D92D.png', '2023-04-29 19:08:53', '29 Apr 2023 10:45 PM'),
(33, 'old men hat', 'PRO-378029', 3800.00, 4500.00, 'A description of a cap', 1, 31, 1, 'PRO20230429383901.png', '2023-04-29 19:38:33', '29 Apr 2023 10:46 PM'),
(34, 'female high heels', 'PRO-092928', 6500.00, 7000.00, 'A sample female heels', 4, 8, 1, 'PRO202304295994B0.png', '2023-04-29 19:59:22', '29 Apr 2023 10:46 PM'),
(35, 'mens free plain tee shirt', 'PRO-2982828', 2700.00, 3200.00, 'Just a sample description of mens free plain tee shirt', 3, 48, 1, 'PRO2023043049969E.png', '2023-04-30 14:49:39', '30 Apr 2023 6:52 PM'),
(36, 'mens plain tee shirt', 'PRO-09228', 3800.00, 4000.00, 'This is just a sample description', 3, 41, 1, 'PRO202304302177A8.png', '2023-04-30 15:21:52', '12 May 2023 5:06 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct_image`
--

CREATE TABLE `tblproduct_image` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_sku` varchar(50) NOT NULL,
  `picture` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblproduct_image`
--

INSERT INTO `tblproduct_image` (`id`, `product_id`, `product_sku`, `picture`) VALUES
(21, 31, 'PRO-7637378', 'PRO2023042934AC5E.png'),
(22, 31, 'PRO-7637378', 'PRO20230429349B1B.png'),
(23, 31, 'PRO-7637378', 'PRO20230429348011.png'),
(24, 32, 'PRO-378829', 'PRO20230429082899.png'),
(25, 32, 'PRO-378829', 'PRO2023042908CEA3.png'),
(26, 32, 'PRO-378829', 'PRO2023042908D92D.png'),
(27, 33, 'PRO-378029', 'PRO20230429383901.png'),
(28, 34, 'PRO-092928', 'PRO2023042959B61A.png'),
(29, 34, 'PRO-092928', 'PRO202304295994B0.png'),
(30, 35, 'PRO-2982828', 'PRO2023043049D8A7.png'),
(31, 35, 'PRO-2982828', 'PRO2023043049CB92.png'),
(32, 35, 'PRO-2982828', 'PRO2023043049969E.png'),
(33, 36, 'PRO-09228', 'PRO2023043021250E.png'),
(34, 36, 'PRO-09228', 'PRO2023043021A90B.png'),
(35, 36, 'PRO-09228', 'PRO202304302177A8.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblreview`
--

CREATE TABLE `tblreview` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `review` longtext,
  `status` int NOT NULL DEFAULT '0',
  `date_reviewed` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblreview`
--

INSERT INTO `tblreview` (`id`, `product_id`, `customer_id`, `rating`, `review`, `status`, `date_reviewed`) VALUES
(1, 32, 4, 3, 'Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan', 1, '28 Apr 2023 1:35 PM'),
(2, 32, 3, 5, 'This is a very nice product, i love how nice it looks on me', 1, '30 Apr 2023 5:02 PM'),
(5, 32, 2, 4, 'Just a sample review test', 1, '24 Jul 2023 10:38 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbltransaction`
--

CREATE TABLE `tbltransaction` (
  `id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `invoiceno` varchar(100) DEFAULT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `description` longtext,
  `amount` decimal(10,2) DEFAULT NULL,
  `oldbalance` decimal(10,2) DEFAULT NULL,
  `newbalance` decimal(10,2) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltransaction`
--

INSERT INTO `tbltransaction` (`id`, `customer_id`, `invoiceno`, `service_type`, `description`, `amount`, `oldbalance`, `newbalance`, `date`) VALUES
(14, 3, '20230503645224192589F1683104793', 'Wallet Balance', 'Dear Albert, 3000.00 has been deducted from your wallet balance', 3000.00, 4000.00, 1000.00, '03 May 2023 10:06 AM'),
(15, 3, '20230512645E660A1A9C31683908106', 'Wallet Balance', 'Dear Albert, 9500.00 has been deducted from your wallet balance', 9500.00, 12000.00, 2500.00, '12 May 2023 5:15 PM'),
(16, 3, '202305176464DFD14955A1684332497', 'Wallet Balance', 'Dear Albert, 9200.00 has been deducted from your wallet balance', 9200.00, 250000.00, 240800.00, '17 May 2023 3:08 PM'),
(17, 3, '2023072464BE4C11960D81690192913', 'Wallet Balance', 'Dear Albert, 12500.00 has been deducted from your wallet balance', 12500.00, 240800.00, 228300.00, '24 Jul 2023 11:01 AM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tblorder_payment`
--
ALTER TABLE `tblorder_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tblproduct_image`
--
ALTER TABLE `tblproduct_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tblreview`
--
ALTER TABLE `tblreview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tblorder_payment`
--
ALTER TABLE `tblorder_payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblproduct_image`
--
ALTER TABLE `tblproduct_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tblreview`
--
ALTER TABLE `tblreview`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
