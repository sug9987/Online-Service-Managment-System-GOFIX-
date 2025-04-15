-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 09:56 AM
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
-- Database: `newgofix`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignwork_tb`
--

CREATE TABLE `assignwork_tb` (
  `rno` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `request_info` text NOT NULL,
  `request_desc` text NOT NULL,
  `requester_name` varchar(60) NOT NULL,
  `requester_add1` text NOT NULL,
  `requester_add2` text NOT NULL,
  `requester_city` varchar(60) NOT NULL,
  `requester_state` varchar(60) NOT NULL,
  `requester_zip` int(11) NOT NULL,
  `requester_email` varchar(60) NOT NULL,
  `requester_mobile` bigint(20) NOT NULL,
  `assign_tech` varchar(60) NOT NULL,
  `assign_date` date NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `transaction_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `assignwork_tb`
--

INSERT INTO `assignwork_tb` (`rno`, `request_id`, `request_info`, `request_desc`, `requester_name`, `requester_add1`, `requester_add2`, `requester_city`, `requester_state`, `requester_zip`, `requester_email`, `requester_mobile`, `assign_tech`, `assign_date`, `payment_status`, `payment_method`, `transaction_id`) VALUES
(1, 1, 'AC Repair', 'Fix AC gas leak', 'Amit Sharma', '123 Main Street', 'Near Market', 'Delhi', 'Delhi', 110001, 'amit@example.com', 9876543210, 'Rajesh Kumar', '2025-01-10', 'Paid', 'Card', 'TXN202501'),
(2, 2, 'CCTV Installation', 'Install CCTV cameras', 'Rajesh Kumar', '456 Park Avenue', 'Opp. Bank', 'Mumbai', 'Maharashtra', 400001, 'rajesh@example.com', 9123456780, 'Amit Verma', '2025-01-12', 'Pending', 'UPI', 'TXN202502'),
(3, 3, 'Plumbing Issue', 'Fix leaking pipe', 'Suresh Gupta', '789 Green Street', 'Near School', 'Bangalore', 'Karnataka', 560001, 'suresh@example.com', 9998887776, 'Suresh Gupta', '2025-02-15', 'Paid', 'QR', 'TXN202503'),
(4, 4, 'Electrical Issue', 'Repair home wiring issues', 'Manoj Yadav', '159 Industrial Road', 'Near Factory', 'Chennai', 'Tamil Nadu', 600001, 'manoj@example.com', 9988776655, 'Manoj Yadav', '2025-02-18', 'Failed', 'Card', 'TXN202504'),
(5, 5, 'Fridge Repair', 'Fix refrigerator cooling problem', 'Pankaj Verma', '753 Residency Lane', 'Near Park', 'Kolkata', 'West Bengal', 700001, 'pankaj@example.com', 9876541230, 'Pankaj Verma', '2025-03-20', 'Paid', 'UPI', 'TXN202505');

-- --------------------------------------------------------

--
-- Table structure for table `customer_tb`
--

CREATE TABLE `customer_tb` (
  `custid` int(11) NOT NULL,
  `custname` varchar(60) NOT NULL,
  `custadd` varchar(60) NOT NULL,
  `cpname` varchar(60) NOT NULL,
  `cpquantity` int(11) NOT NULL,
  `cpeach` int(11) NOT NULL,
  `cptotal` int(11) NOT NULL,
  `cpdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `customer_tb`
--

INSERT INTO `customer_tb` (`custid`, `custname`, `custadd`, `cpname`, `cpquantity`, `cpeach`, `cptotal`, `cpdate`) VALUES
(1, 'Amit Sharma', '123 Main Street, Delhi', 'Screwdriver Set', 2, 599, 1198, '2025-03-05'),
(2, 'Rajesh Kumar', '456 Park Avenue, Mumbai', 'CCTV Camera', 1, 4500, 4500, '2025-03-07'),
(3, 'Suresh Gupta', '789 Green Street, Bangalore', 'Plumbing Kit', 3, 1200, 3600, '2025-03-09'),
(4, 'Manoj Yadav', '159 Industrial Road, Chennai', 'Electric Drill', 1, 3500, 3500, '2025-03-10'),
(5, 'Pankaj Verma', '753 Residency Lane, Kolkata', 'Refrigerator Gas Refill', 2, 800, 1600, '2025-03-11'),
(6, 'Pravin', 'Kopar', 'CCTV Camera', 2, 4500, 9000, '2025-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `gofix_adminlogin_tb`
--

CREATE TABLE `gofix_adminlogin_tb` (
  `a_login_id` int(11) NOT NULL,
  `a_name` varchar(60) NOT NULL,
  `a_email` varchar(60) NOT NULL,
  `a_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `gofix_adminlogin_tb`
--

INSERT INTO `gofix_adminlogin_tb` (`a_login_id`, `a_name`, `a_email`, `a_password`) VALUES
(1, 'GoFix Admin', 'gofix@gmail.com', 'gofix@123#');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_tb`
--

CREATE TABLE `inventory_tb` (
  `pid` int(11) NOT NULL,
  `pname` varchar(60) NOT NULL,
  `pdop` date NOT NULL,
  `pava` int(11) NOT NULL,
  `ptotal` int(11) NOT NULL,
  `poriginalprice` int(11) NOT NULL,
  `psellingprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `inventory_tb`
--

INSERT INTO `inventory_tb` (`pid`, `pname`, `pdop`, `pava`, `ptotal`, `poriginalprice`, `psellingprice`) VALUES
(1, 'Screwdriver Set', '2025-01-05', 20, 11980, 500, 599),
(2, 'CCTV Camera', '2025-01-10', 8, 45000, 4000, 4500),
(3, 'Plumbing Kit', '2025-01-15', 15, 18000, 1000, 1200),
(4, 'Electric Drill', '2025-02-01', 12, 42000, 3200, 3500),
(5, 'Refrigerator Gas Refill', '2025-02-10', 8, 6400, 700, 800);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_id` varchar(20) NOT NULL,
  `method` enum('Card','UPI','QR') NOT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `upi_id` varchar(50) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Success','Failed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `customer_email`, `amount`, `transaction_id`, `method`, `card_number`, `upi_id`, `qr_code`, `status`, `created_at`) VALUES
(1, 'amit@example.com', 99.00, 'TXN938475621', 'Card', '1234567812345678', NULL, NULL, 'Success', '2025-03-14 08:17:11'),
(2, 'rajesh@example.com', 99.00, 'TXN284756193', 'UPI', NULL, 'rajesh@upi', NULL, 'Success', '2025-03-14 08:17:11'),
(3, 'suresh@example.com', 99.00, 'TXN573829104', 'QR', NULL, NULL, 'qr_code_2025_1.png', 'Pending', '2025-03-14 08:17:11'),
(4, 'manoj@example.com', 99.00, 'TXN849201356', 'Card', '9876543210987654', NULL, NULL, 'Failed', '2025-03-14 08:17:11'),
(5, 'pankaj@example.com', 99.00, 'TXN195837462', 'UPI', NULL, 'pankaj@upi', NULL, 'Success', '2025-03-14 08:17:11'),
(6, 'sumitgupta2436@gmail.com', 99.00, 'TXN63749E9AFF', 'QR', NULL, NULL, 'QR63749E9A', 'Success', '2025-03-14 08:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `requesterlogin_tb`
--

CREATE TABLE `requesterlogin_tb` (
  `r_login_id` int(11) NOT NULL,
  `r_name` varchar(60) NOT NULL,
  `r_email` varchar(60) NOT NULL,
  `r_password` varchar(60) NOT NULL,
  `r_confirmpassword` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `requesterlogin_tb`
--

INSERT INTO `requesterlogin_tb` (`r_login_id`, `r_name`, `r_email`, `r_password`, `r_confirmpassword`) VALUES
(1, 'Amit Sharma', 'amit@example.com', 'Amit@123#', 'Amit@123#'),
(2, 'Rajesh Kumar', 'rajesh@example.com', 'Rajesh@456#', 'Rajesh@456#'),
(3, 'Suresh Gupta', 'suresh@example.com', 'Suresh@789#', 'Suresh@789#'),
(4, 'Manoj Yadav', 'manoj@example.com', 'Manoj@1234#', 'Manoj@1234#'),
(5, 'Pankaj Verma', 'pankaj@example.com', 'Pankaj@5678#', 'Pankaj@5678#'),
(6, 'Sumit Tiwari', 'sumitect@example.com', 'Sumit@123#', 'Sumit@123#'),
(7, 'Rita Sharma', 'rita1234@gmail.com', 'Rita@123#', 'Rita@123#');

-- --------------------------------------------------------

--
-- Table structure for table `submitrequest_tb`
--

CREATE TABLE `submitrequest_tb` (
  `request_id` int(11) NOT NULL,
  `request_info` text NOT NULL,
  `request_desc` text NOT NULL,
  `requester_name` varchar(60) NOT NULL,
  `requester_add1` text NOT NULL,
  `requester_add2` text NOT NULL,
  `requester_city` varchar(60) NOT NULL,
  `requester_state` varchar(60) NOT NULL,
  `requester_zip` int(11) NOT NULL,
  `requester_email` varchar(60) NOT NULL,
  `requester_mobile` bigint(11) NOT NULL,
  `request_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `submitrequest_tb`
--

INSERT INTO `submitrequest_tb` (`request_id`, `request_info`, `request_desc`, `requester_name`, `requester_add1`, `requester_add2`, `requester_city`, `requester_state`, `requester_zip`, `requester_email`, `requester_mobile`, `request_date`) VALUES
(1, 'AC Repair', 'AC not cooling properly', 'Amit Sharma', '123 Main Street', 'Near Market', 'Delhi', 'Delhi', 110001, 'amit@example.com', 9876543210, '2025-03-05'),
(2, 'CCTV Installation', 'Need CCTV cameras installed at office', 'Rajesh Kumar', '456 Park Avenue', 'Opp. Bank', 'Mumbai', 'Maharashtra', 400001, 'rajesh@example.com', 9123456780, '2025-03-07'),
(3, 'Plumbing Issue', 'Leaking pipe in bathroom', 'Suresh Gupta', '789 Green Street', 'Near School', 'Bangalore', 'Karnataka', 560001, 'suresh@example.com', 9998887776, '2025-03-09'),
(4, 'Electrical Issue', 'Voltage fluctuations at home', 'Manoj Yadav', '159 Industrial Road', 'Near Factory', 'Chennai', 'Tamil Nadu', 600001, 'manoj@example.com', 9988776655, '2025-03-10'),
(5, 'Refrigerator Repair', 'Fridge not cooling', 'Pankaj Verma', '753 Residency Lane', 'Near Park', 'Kolkata', 'West Bengal', 700001, 'pankaj@example.com', 9876541230, '2025-03-11'),
(6, 'System Issue', 'My Windows Software is not working properly', 'Sumit Gupta', '303/B Wing, 3rd Floor Murlidhar Verma Building', 'Near Kopar', 'Thane', 'Maharashtra', 400604, 'sumitgupta2436@gmail.com', 9987251836, '2025-03-13');

-- --------------------------------------------------------

--
-- Table structure for table `technician_tb`
--

CREATE TABLE `technician_tb` (
  `tech_id` int(11) NOT NULL,
  `tech_name` varchar(60) NOT NULL,
  `tech_city` varchar(60) NOT NULL,
  `tech_mobile` bigint(11) NOT NULL,
  `tech_email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `technician_tb`
--

INSERT INTO `technician_tb` (`tech_id`, `tech_name`, `tech_city`, `tech_mobile`, `tech_email`) VALUES
(1, 'Amit Sharma', 'Delhi', 9876543211, 'amit@fix.com'),
(2, 'Rajesh Kumar', 'Mumbai', 9876543212, 'rajesh@fix.com'),
(3, 'Suresh Gupta', 'Bangalore', 9876543213, 'suresh@fix.com'),
(4, 'Manoj Yadav', 'Chennai', 9876543214, 'manoj@fix.com'),
(5, 'Pankaj Verma', 'Kolkata', 9876543215, 'pankaj@fix.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignwork_tb`
--
ALTER TABLE `assignwork_tb`
  ADD PRIMARY KEY (`rno`);

--
-- Indexes for table `customer_tb`
--
ALTER TABLE `customer_tb`
  ADD PRIMARY KEY (`custid`);

--
-- Indexes for table `gofix_adminlogin_tb`
--
ALTER TABLE `gofix_adminlogin_tb`
  ADD PRIMARY KEY (`a_login_id`);

--
-- Indexes for table `inventory_tb`
--
ALTER TABLE `inventory_tb`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `requesterlogin_tb`
--
ALTER TABLE `requesterlogin_tb`
  ADD PRIMARY KEY (`r_login_id`);

--
-- Indexes for table `submitrequest_tb`
--
ALTER TABLE `submitrequest_tb`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `technician_tb`
--
ALTER TABLE `technician_tb`
  ADD PRIMARY KEY (`tech_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignwork_tb`
--
ALTER TABLE `assignwork_tb`
  MODIFY `rno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_tb`
--
ALTER TABLE `customer_tb`
  MODIFY `custid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gofix_adminlogin_tb`
--
ALTER TABLE `gofix_adminlogin_tb`
  MODIFY `a_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_tb`
--
ALTER TABLE `inventory_tb`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requesterlogin_tb`
--
ALTER TABLE `requesterlogin_tb`
  MODIFY `r_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `submitrequest_tb`
--
ALTER TABLE `submitrequest_tb`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `technician_tb`
--
ALTER TABLE `technician_tb`
  MODIFY `tech_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
