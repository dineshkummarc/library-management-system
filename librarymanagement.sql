-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2022 at 06:33 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `librarymanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_number`
--

CREATE TABLE IF NOT EXISTS `admission_number` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `adm_no` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admission_number`
--

INSERT INTO `admission_number` (`id`, `adm_no`) VALUES
(1, '1005');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bookname` varchar(50) NOT NULL,
  `bookcode` varchar(20) NOT NULL,
  `author` varchar(50) NOT NULL,
  `publisher` longtext NOT NULL,
  `stock` int(10) NOT NULL,
  `doc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `bookname`, `bookcode`, `author`, `publisher`, `stock`, `doc`) VALUES
(1, 'The Guide', 'BK2100', 'R.K. Narayan', 'ABCD Publications', 5, '2022-01-26 17:12:39'),
(2, 'God of Small Things', 'BK2101', 'Arundhati Roy', 'XYZ Publications', 15, '2022-01-26 17:13:45'),
(3, 'Gitanjali', 'BK2102', 'Rabindranath Tagore', 'PQRS Publications', 5, '2022-01-26 17:14:26'),
(4, 'Train to Pakistan', 'BK2103', 'Khushwant Singh', 'AFCBFGUJ Publishers', 6, '2022-01-26 17:16:04'),
(5, 'In Custody', 'BK2104', 'Anita Desai', 'ASCDF Publication', 17, '2022-01-26 17:16:52'),
(6, 'The Story Of My Experiments With The Truth', 'BK2105', 'Mahatma Gandhi', 'PQRSdsfvb Publications', 10, '2022-01-26 17:17:55'),
(7, 'A Fine Balance', 'BK2106', 'Rohinton Mistry', 'PQRS Publications', 6, '2022-01-26 17:20:39'),
(9, 'A Suitable Boy', 'BK2107', 'Vikram Seth', 'PQRS Publications', 15, '2022-01-26 17:21:43'),
(10, 'The Interpreter Of Maladies', 'BK2108', 'Jhumpa Lahiri', 'PQRS Publications', 8, '2022-01-26 17:24:09'),
(11, 'The Glass Palace', 'BK2109', 'Amitav Ghosh', 'PQRSdsfvb Publications', 17, '2022-01-26 17:25:07'),
(12, 'The Private Life of an Indian Prince', 'BK2110', 'Mulk Raj Anand', 'ABCD Publications', 45, '2022-01-26 17:25:44'),
(13, 'Midnights Children', 'BK2111', 'Salman Rushdie', 'AFCBFGUJ Publishers', 12, '2022-01-26 17:26:33'),
(14, 'Maximum City', 'BK2112', 'Suketu Mehta', 'PQRSdsfvb Publications', 30, '2022-01-26 17:27:12'),
(15, 'The Autobiography of an Unknown Indian', 'BK2113', 'Nirad C. Chaudhuri', 'ABCD Publications', 10, '2022-01-26 17:27:55'),
(16, 'In Search of Lost Time', 'BK2114', 'Marcel Proust', 'SRMIST', 10, '2022-03-14 07:18:58'),
(17, 'Ulysses', 'BK2115', 'James Joyce', 'ADSCVGFG Publication', 4, '2022-03-14 07:22:57'),
(18, 'Don Quixote', 'BK2116', 'Miguel de Cervantes', 'sfcc Publ', 14, '2022-03-14 07:24:57'),
(19, 'The Great Gatsby', 'BK2117', 'F. Scott Fitzgerald', 'ABXCD SXCV', 20, '2022-03-14 07:25:42'),
(22, 'War and Peace', 'BK2118', 'Leo Tolstoy', 'PQRS Publications', 17, '2022-03-14 15:52:48'),
(23, 'The Catcher in the Rye', 'BK2119', 'J D Salinger', 'ABCD Publications', 21, '2022-04-12 04:54:46'),
(25, 'Ulysses', 'BK2120', 'James Joyce', 'PQRS Publications', 18, '2022-04-17 12:52:25'),
(26, 'To Kill a Mockingbird', 'BK2121', 'Harper Lee', 'AFCBFGUJ Publishers', 10, '2022-04-21 05:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `book_code`
--

CREATE TABLE IF NOT EXISTS `book_code` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bookcode` int(10) NOT NULL,
  `doc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `book_code`
--

INSERT INTO `book_code` (`id`, `bookcode`, `doc`) VALUES
(1, 2122, '2022-03-13 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admission_no` varchar(10) NOT NULL,
  `bookcode` varchar(20) NOT NULL,
  `status` int(5) NOT NULL,
  `doc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`id`, `admission_no`, `bookcode`, `status`, `doc`) VALUES
(1, '1000', 'BK2102', 1, '2022-01-02 19:12:04'),
(2, '1003', 'BK2105', 1, '2021-11-08 19:28:31'),
(3, '1002', 'BK2103', 1, '2022-01-09 19:29:33'),
(4, '1000', 'BK2114', 0, '2021-12-26 19:30:11'),
(5, '1002', 'BK2104', 1, '2021-12-14 19:30:33'),
(6, '1000', 'BK2110', 0, '2022-01-26 19:30:47'),
(7, '1001', 'BK2103', 1, '2022-01-26 19:46:34'),
(9, '1003', 'BK2101', 0, '2022-02-25 07:01:34'),
(10, '1001', 'BK2116', 0, '2022-02-08 04:58:27'),
(11, '1003', 'BK2119', 1, '2022-04-17 12:54:00'),
(12, '1001', 'BK2120', 0, '2022-02-15 12:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE IF NOT EXISTS `return` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admission_no` varchar(10) NOT NULL,
  `bookcode` varchar(20) NOT NULL,
  `issue_date` varchar(15) NOT NULL,
  `fine` varchar(5) NOT NULL,
  `doc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `return`
--

INSERT INTO `return` (`id`, `admission_no`, `bookcode`, `issue_date`, `fine`, `doc`) VALUES
(2, '1000 ', 'BK2114', '27-12-2021', '3', '2022-01-27 07:15:11'),
(3, '1000 ', 'BK2110', '27-01-2022', '48', '2022-03-14 06:37:24'),
(4, '1003 ', 'BK2101', '25-02-2022', '0', '2022-03-14 07:04:35'),
(5, '1001 ', 'BK2116', '08-02-2022', '99', '2022-04-12 05:00:14'),
(6, '1001 ', 'BK2120', '15-02-2022', '93', '2022-04-17 12:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admission_no` varchar(10) NOT NULL,
  `studentname` varchar(50) NOT NULL,
  `fathername` varchar(50) NOT NULL,
  `mothername` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `image` varchar(30) NOT NULL,
  `class` varchar(10) NOT NULL,
  `doc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `admission_no`, `studentname`, `fathername`, `mothername`, `gender`, `dob`, `mobile`, `image`, `class`, `doc`) VALUES
(1, '1000', 'Madhuja Sinha', 'Manoj Sinha', 'Sushma Sinha', 'female', '2000-12-01', '9475861254', '1000.jpg', 'Twelve', '2022-01-26 06:49:46'),
(2, '1001', 'Ayushi Chouhan', 'Awadhesh Chouhan', 'Bindu Singh', 'female', '2001-04-01', '8457912458', '1001.jpg', 'Ten', '2022-01-26 06:52:38'),
(3, '1002', 'Soham Das', 'Shekhar Das', 'Anita Das', 'male', '2001-09-26', '7841258946', '1002.jpg', 'Eleven', '2022-03-14 06:55:32'),
(4, '1003', 'Sithara Swamynathan', 'Hemant Swamynathan', 'Savita Swamynathan', 'female', '2001-09-08', '9774486124', '1003.jpg', 'Five', '2022-03-14 06:56:30'),
(5, '1004', 'Aryan Singh', 'Ashutosh Singh', 'Neha Singh', 'male', '2012-11-13', '8745126943', '1004.jpg', 'Six', '2022-04-21 05:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `doc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `UserID`, `Password`, `doc`) VALUES
(1, 'Madhuja01', 'user1', '2022-01-27 18:34:29');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
