-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2019 at 04:21 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_catalogue`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `category_name`) VALUES
(1, 'Menswear'),
(2, 'Women\'s Clothing'),
(3, 'Men\'s Accessories'),
(4, 'Women\'s Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `landing`
--

CREATE TABLE `landing` (
  `id` int(11) NOT NULL,
  `caption` varchar(15) NOT NULL,
  `slide_pict` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `landing`
--

INSERT INTO `landing` (`id`, `caption`, `slide_pict`) VALUES
(1, 'lorem ipsum', '1.jpg'),
(2, 'dolor', '2.jpg'),
(3, 'sit amet', '3.jpg'),
(4, 'consectetur', '4.jpg'),
(5, 'adipisicing', '5.jpg'),
(6, 'elit', '6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` double NOT NULL,
  `product_pict` varchar(15) NOT NULL,
  `product_discount` float NOT NULL,
  `available` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `id_category`, `product_name`, `product_desc`, `product_price`, `product_pict`, `product_discount`, `available`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '1.png', 20, 1),
(2, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '2.png', 0, 0),
(3, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '3.png', 0, 1),
(4, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '4.png', 0, 1),
(5, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '5.png', 15, 0),
(6, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '6.png', 15, 1),
(7, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '7.png', 15, 1),
(8, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '8.png', 0, 1),
(9, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '9.png', 0, 1),
(10, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '10.png', 0, 1),
(11, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '11.png', 0, 1),
(12, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '12.png', 0, 1),
(13, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '13.png', 0, 1),
(14, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '14.png', 0, 1),
(15, 1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '15.png', 0, 1),
(16, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '16.png', 0, 1),
(17, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '17.png', 0, 1),
(18, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '18.png', 0, 1),
(19, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '19.png', 21, 1),
(20, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '20.png', 0, 1),
(21, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '21.png', 0, 0),
(22, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '22.png', 0, 0),
(23, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '23.png', 0, 1),
(24, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '24.png', 0, 1),
(25, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '25.png', 0, 1),
(26, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '26.png', 12, 1),
(27, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '27.png', 0, 1),
(28, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '28.png', 0, 1),
(29, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '29.png', 0, 1),
(30, 2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '30.png', 2.5, 1),
(31, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '31.png', 2.5, 1),
(32, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '32.png', 2.5, 1),
(33, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '33.png', 0, 1),
(34, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '34.png', 0, 1),
(35, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '35.png', 0, 1),
(36, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '36.png', 0, 1),
(37, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '37.png', 0, 0),
(38, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '38.png', 0, 0),
(39, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '39.png', 0, 1),
(40, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '40.png', 0, 1),
(41, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '41.png', 0, 1),
(42, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '42.png', 0, 1),
(43, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '43.png', 0, 1),
(44, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '44.png', 0, 1),
(45, 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '45.png', 0, 1),
(46, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '46.png', 5, 1),
(47, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '47.png', 0, 1),
(48, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '48.png', 0, 1),
(49, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '49.png', 0, 1),
(50, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '50.png', 11, 1),
(51, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '51.png', 7.2, 1),
(52, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '52.png', 0, 1),
(53, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '53.png', 0, 1),
(54, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '54.png', 2.5, 1),
(55, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '55.png', 0, 1),
(56, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'qwerty', 1000000, '56.jpg', 4.5, 1),
(57, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '57.png', 4.5, 1),
(58, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '58.png', 0, 0),
(59, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis non magni, maxime doloribus quo, aliquam animi natus nemo, vitae voluptatem blanditiis voluptate saepe architecto quasi velit! Eius laboriosam impedit alias.', 1000000, '59.png', 0, 1),
(60, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit', 'qwerty', 1000000, '60.png', 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`) VALUES
('dev.sys.email@gmail.com', '$2y$10$ijSr.PFe6seR4glwymBfAeOMwp2LoDAp71I4JMmSPw8KByWKi7due');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `landing`
--
ALTER TABLE `landing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `landing`
--
ALTER TABLE `landing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
