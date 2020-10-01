-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2020 at 10:43 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ShoppingCart`
--

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `in_stock` int(4) NOT NULL,
  `image_url` varchar(60) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`id`, `name`, `description`, `in_stock`, `image_url`, `price`) VALUES
(1, 'Sony Headphones', 'A brand new product from Sony with high volume and great bass.', 4, 'Images/headphone.jpg', 1700),
(2, 'Red Shirt', NULL, 6, 'Images/shirt1.jpg', 700),
(3, 'Black Striped Tshirt', 'Made with cotton. And has latest design.', 2, 'Images/shirt2.jpg', 1000),
(4, 'Superstar Shoes', 'Adidas Shoes with brand new design and color.', 3, 'Images/shoes1.jpg', 2700),
(5, 'Superstar Lite', NULL, 4, 'Images/shoes2.jpg', 2100),
(7, 'Fila White Shoes', 'Brand new FILA shoes for running as well as for party.', 1, 'Images/shoes3.jpg', 3000),
(8, 'JBL Flip 4', 'Brand new flip 4 speakers by JBL for better sound experience.', 2, 'Images/speaker.jpg', 10000),
(9, 'Sony Pocket Speaker', NULL, 3, 'Images/speaker2.jpg', 6000);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Id` int(11) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Id`, `firstname`, `lastname`, `email`, `contact`, `password`) VALUES
(2, 'Hitesh', 'Munjal', 'hiteshmunjal22@gmail.com', '8168496550', '1d0f071b6e5428bb961b6714d117a056'),
(3, 'Kanika', 'Jindal', 'kanikajindal00@gmail.com', '8168496550', '38a6f62c5f2be72da7f87df009c62424');

-- --------------------------------------------------------

--
-- Table structure for table `user_product`
--

CREATE TABLE `user_product` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_product`
--

INSERT INTO `user_product` (`id`, `quantity`, `customer_id`, `product_id`) VALUES
(30, 1, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_product`
--
ALTER TABLE `user_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer` (`customer_id`),
  ADD KEY `fk_product` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_product`
--
ALTER TABLE `user_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_product`
--
ALTER TABLE `user_product`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`customer_id`) REFERENCES `Users` (`Id`),
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `Products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
