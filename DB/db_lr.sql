-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2021 at 05:08 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `fname`, `username`, `email`, `pass`) VALUES
(7, 'Salim Hosen', 'king_khan', 'King_khan@ymail.com', 'b699c56ffedd1c02ffa7f7095f200870'),
(8, 'Atikur Rahman', 'king_khan6', 'King_khan@ymail.co', 'b699c56ffedd1c02ffa7f7095f200870'),
(9, 'Jahangir Alam', 'jahangir', 'jahangir@gmail.com', '492ef9f848b829a14491bd195b0a110a'),
(6, 'Salim Hosen', 'salim_hosen', 'salimhosen19@gmail.com', '80bb3ca15ddd907e15a4659d70db4461'),
(10, 'kamal hosen', 'kamal', 'kamal@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(11, 'Mahmuda Begam', 'Mahmuda', 'Mahamuda@gmail.com', '987654321'),
(12, 'Salim Hosen', 'mohammad_salim', 'salimhosen37@yahoo.com', 'jannatul'),
(13, 'raz', 'slayerboyraz', 'raz.rahad@gmail.com', 'rahad3636'),
(14, 'mohammad hosen', 'salim7', 'salimhosen832@gmail.com', 'salimhosen'),
(15, 'md.rahman', 'mdrahman', 'rahman@yahoo.com', '123456789'),
(16, 'salim', 'salim', 'salim@gmail.com', 'jannatul');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
