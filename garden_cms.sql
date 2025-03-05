-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 12:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garden_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Gardening Tools', NULL),
(2, 'Plant Accessories', NULL),
(3, 'Lawn Care', NULL),
(4, 'Watering Equipment', NULL),
(5, 'Fertilizers', NULL),
(6, 'Patio Furniture', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `name`, `description`, `date`, `location`) VALUES
(1, 'Tech Conference 2024', 'A conference for technology enthusiasts, featuring keynote speakers and workshops.', '2024-12-10', 'Grand Hall, City Center'),
(2, 'Music Fest', 'An outdoor music festival featuring popular bands and local talent.', '2024-12-15', 'Central Park'),
(3, 'Art Exhibition', 'A display of contemporary and classic artwork from renowned artists.', '2024-12-20', 'Art Gallery, Downtown'),
(4, 'Coding Bootcamp', 'A hands-on bootcamp for beginners to learn coding in Python.', '2024-12-25', 'Tech Hub, Innovation Street'),
(5, 'Startup Pitch Night', 'An evening where entrepreneurs pitch their ideas to investors.', '2025-01-05', 'Startup Arena, Business District');

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `role_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','shipped','completed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `order_date`, `status`) VALUES
(1, 1, 0.00, '2024-11-19 14:59:26', 'pending'),
(2, 1, 1799.94, '2024-11-19 15:21:08', 'pending'),
(3, 4, 451.47, '2025-01-29 16:46:02', 'pending'),
(4, 5, 150.49, '2025-03-05 06:12:21', 'pending'),
(5, 5, 4150.48, '2025-03-05 09:42:54', 'pending'),
(6, 5, 451.47, '2025-03-05 09:46:43', 'pending'),
(7, 5, 150.49, '2025-03-05 09:54:30', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 2, 23, 3, 299.99),
(2, 2, 23, 3, 299.99),
(3, 3, 22, 3, 150.49),
(4, 4, 22, 1, 150.49),
(5, 5, 28, 1, 3999.99),
(6, 5, 22, 1, 150.49),
(7, 6, 22, 3, 150.49),
(8, 7, 22, 1, 150.49);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `stock`, `category_id`, `created_at`) VALUES
(21, 'Garden Shovel', 'A sturdy and reliable garden shovel for all soil types.', 249.99, 50, 1, '2024-11-19 09:23:01'),
(22, 'Flower Pot', 'A beautiful ceramic flower pot for your indoor plants.', 150.49, 91, 2, '2024-11-19 09:23:01'),
(23, 'Lawn Mower', 'High-performance lawn mower with adjustable settings.', 2999.99, 10, 3, '2024-11-19 09:23:01'),
(24, 'Garden Hose', 'Flexible garden hose with a spray nozzle included.', 199.99, 0, 4, '2024-11-19 09:23:01'),
(25, 'Fertilizer', 'Organic fertilizer to keep your plants healthy and strong.', 99.99, 200, 5, '2024-11-19 09:23:01'),
(26, 'Gardening Gloves', 'Durable gloves for protecting your hands while gardening.', 129.99, 150, 1, '2024-11-19 09:23:01'),
(27, 'Pruning Shears', 'Sharp and precise pruning shears for trimming plants.', 529.99, 35, 1, '2024-11-19 09:23:01'),
(28, 'Patio Set', 'Elegant patio set with table and four chairs.', 3999.99, 4, 6, '2024-11-19 09:23:01'),
(29, 'Hanging Basket', 'Metal hanging basket for flowers and decorations.', 189.75, 75, 2, '2024-11-19 09:23:01'),
(30, 'Weed Killer', 'Effective and eco-friendly weed killer for lawns.', 749.99, 90, 5, '2024-11-19 09:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `product_description`
--

CREATE TABLE `product_description` (
  `description_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `detailed_description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `additional_info` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_description`
--

INSERT INTO `product_description` (`description_id`, `product_id`, `detailed_description`, `image_url`, `additional_info`, `created_at`) VALUES
(1, 21, 'A sturdy and reliable garden shovel designed for all types of soil work. Ergonomic grip ensures minimal strain.', '../assets/images/garden_shovel.jpg', 'Material: Steel, Handle: Wood', '2024-11-19 13:56:07'),
(2, 22, 'A beautiful ceramic flower pot suitable for indoor and outdoor plants. Adds elegance to any space.', '../assets/images/flower_pot.jpg', 'Diameter: 25cm, Color: White', '2024-11-19 13:56:07'),
(3, 23, 'High-performance lawn mower with adjustable height settings and a powerful engine. Ideal for medium to large gardens.', '../assets/images/lawn_mower.jpg', 'Cutting Width: 50cm, Power: 1500W', '2024-11-19 13:56:07'),
(4, 24, 'Flexible garden hose with a spray nozzle included. Perfect for watering plants and washing surfaces.', '../assets/images/garden_hose.jpg', 'Length: 30m, Nozzle Settings: 7 modes', '2024-11-19 13:56:07'),
(5, 25, 'Organic fertilizer to keep your plants healthy and thriving. Promotes strong root growth.', '../assets/images/fertilizer.jpg', 'Weight: 10kg, NPK Ratio: 10-10-10', '2024-11-19 13:56:07'),
(6, 26, 'Durable gloves for protecting your hands while gardening. Comfortable fit and breathable material.', '../assets/images/gardening_gloves.jpg', 'Size: Medium, Material: Leather', '2024-11-19 13:56:07'),
(7, 27, 'Sharp and precise pruning shears for trimming plants and branches. Ideal for delicate pruning tasks.', '../assets/images/pruning_shears.jpg', 'Blade Material: Stainless Steel, Handle: Non-slip', '2024-11-19 13:56:07'),
(8, 28, 'Elegant patio set with a table and four chairs. Perfect for outdoor dining and relaxation.', '../assets/images/patio_set.jpg', 'Material: Rattan, Table Diameter: 1.2m', '2024-11-19 13:56:07'),
(9, 29, 'Metal hanging basket for flowers and decorative items. Comes with a durable chain.', '../assets/images/hanging_basket.jpg', 'Diameter: 30cm, Finish: Powder-coated', '2024-11-19 13:56:07'),
(10, 30, 'Effective and eco-friendly weed killer for lawns. Fast-acting formula, safe for pets once dry.', '../assets/images/weed_killer.jpeg', 'Volume: 1L, Coverage: 200m²', '2024-11-19 13:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `contact_number`, `created_at`, `status`) VALUES
(1, 'Samuel Kaye', 'samuel.ki8492@gmail.com', '$2y$10$.ds2qGKSuCmWbjojpconPOBNUi8bRYBFyJNezK0bT9wlV2JoV3Dee', '0760486293', '2024-11-18 16:43:19', 'active'),
(2, 'Test1', 'test@gmail.com', '$2y$10$6OjZ90qo.Y1WGzfRfdn9IO1ucJG2HlTP2X3WVB2p/MFA.c7nHksCK', '99999999', '2024-11-19 14:24:44', 'active'),
(3, 'Tes2', 'Test2@gamil.com', '$2y$10$kkhUBawPC8FVTRVhkJYj1uG5TO8H7Vso0zEkGLLVubjOV/3iww8Zu', '00000000000', '2024-11-21 08:48:15', 'active'),
(4, 'Claude', 'cluade@gmail.com', '$2y$10$cuPvsB9dOwakz0oD/gNu9OylmB6hnXehfxfuJYw2KpWlC.BaAwd6e', '0760486293', '2025-01-29 16:44:09', 'active'),
(5, 'yolo', 'yolo@gmail.com', '$2y$10$yHLbOU86LGSZkt.r2jQiXe4c.XfKZxM.sD0n0skBI9cInVJrS5C.m', '0760486293', '2025-03-05 06:00:02', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_description`
--
ALTER TABLE `product_description`
  ADD PRIMARY KEY (`description_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `product_description`
--
ALTER TABLE `product_description`
  MODIFY `description_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;

--
-- Constraints for table `product_description`
--
ALTER TABLE `product_description`
  ADD CONSTRAINT `product_description_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
