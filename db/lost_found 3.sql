-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 10:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lost_found`
--

-- --------------------------------------------------------

--
-- Table structure for table `founditems`
--

CREATE TABLE `founditems` (
  `FoundItemID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `LostItemID` int(11) DEFAULT NULL,
  `DateFound` date DEFAULT NULL,
  `LocationFound` varchar(100) DEFAULT NULL,
  `ItemName` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `founditems`
--

INSERT INTO `founditems` (`FoundItemID`, `UserID`, `LostItemID`, `DateFound`, `LocationFound`, `ItemName`, `Description`, `category_id`) VALUES
(1, NULL, NULL, '2024-01-01', 'CET', 'M31', 'Phone', 1),
(12, 1, NULL, '2024-05-01', 'Hostel', 's23', 'phone', 1),
(13, 1, NULL, '2024-05-03', 'Hostel', '12 pro', 'phone', 1),
(14, 2, NULL, '2024-05-07', 'Hostel', '13 pro', 'apple', 1),
(16, 3, NULL, '2024-05-01', 'TKM', 's24', 'phone', 1),
(17, 1, NULL, '2024-05-01', 'Hostel', 's21', 'phone', 1),
(18, 1, NULL, '0000-00-00', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemcategories`
--

CREATE TABLE `itemcategories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itemcategories`
--

INSERT INTO `itemcategories` (`CategoryID`, `CategoryName`, `Description`) VALUES
(0, 'Others', 'None of the above'),
(1, 'Electronics', 'Electronic devices and gadgets'),
(2, 'Clothing', 'Clothes and accessories'),
(3, 'Books', 'Books and printed materials'),
(4, 'Jewellery', 'Accessories'),
(5, 'Luggage', 'Baggages'),
(6, 'Toys', 'Children Toys'),
(7, 'Furniture', 'Household furnitures');

-- --------------------------------------------------------

--
-- Table structure for table `lostitems`
--

CREATE TABLE `lostitems` (
  `LostItemID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ItemName` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `DateLost` date DEFAULT NULL,
  `LocationLost` varchar(100) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `RewardOffered` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lostitems`
--

INSERT INTO `lostitems` (`LostItemID`, `UserID`, `ItemName`, `Description`, `category_id`, `DateLost`, `LocationLost`, `Status`, `RewardOffered`) VALUES
(1, NULL, 'GF63', 'MSI GAMING LAPTOP', 1, '2024-04-01', 'MACE', 'Pending', 999.00),
(2, NULL, 'M31', 'SAMSUNG GALAXY M31', 1, '2024-01-01', 'CET', 'Pending', 327.27),
(3, NULL, 'S23', 'Ultra', 1, '2024-04-26', 'MACE', NULL, 100.00),
(4, 2, '13 pro', 'apple phone', 1, '2024-05-01', 'MACE', NULL, 5000.00),
(5, 3, 's24', 'phone', 1, '2024-01-01', 'TKM', NULL, 2000.00);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ItemID` int(11) DEFAULT NULL,
  `TransactionType` varchar(20) DEFAULT NULL,
  `TransactionDate` date DEFAULT NULL,
  `TransactionLocation` varchar(100) DEFAULT NULL,
  `RewardReceived` decimal(10,2) DEFAULT NULL,
  `AdditionalDetails` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `OtherInfo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `OtherInfo`) VALUES
(1, 'admin', 'qwerty@123', 'akashkrishna1111198@gmail.com', 'Administrator'),
(2, 'Akash', 'akash', 'akash199699@gmail.com', 'User'),
(3, 'krishna', 'akash', 'akash199699@gmail.com', 'User'),
(5, 'Albert', 'albert', 'albert123@gmail.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `founditems`
--
ALTER TABLE `founditems`
  ADD PRIMARY KEY (`FoundItemID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `LostItemID` (`LostItemID`),
  ADD KEY `FK_founditems_category_id` (`category_id`);

--
-- Indexes for table `itemcategories`
--
ALTER TABLE `itemcategories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `lostitems`
--
ALTER TABLE `lostitems`
  ADD PRIMARY KEY (`LostItemID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `founditems`
--
ALTER TABLE `founditems`
  MODIFY `FoundItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lostitems`
--
ALTER TABLE `lostitems`
  MODIFY `LostItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `founditems`
--
ALTER TABLE `founditems`
  ADD CONSTRAINT `FK_founditems_category_id` FOREIGN KEY (`category_id`) REFERENCES `itemcategories` (`CategoryID`),
  ADD CONSTRAINT `founditems_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `founditems_ibfk_2` FOREIGN KEY (`LostItemID`) REFERENCES `lostitems` (`LostItemID`);

--
-- Constraints for table `lostitems`
--
ALTER TABLE `lostitems`
  ADD CONSTRAINT `lostitems_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `lostitems_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `itemcategories` (`categoryid`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `lostitems` (`LostItemID`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`ItemID`) REFERENCES `founditems` (`FoundItemID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
