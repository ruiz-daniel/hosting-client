-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2021 at 11:10 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostinglocaldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_web_server`
--

CREATE TABLE `available_web_server` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `available_web_server`
--

INSERT INTO `available_web_server` (`id`, `name`) VALUES
(1, 'Apache/PHP/Node.js'),
(2, 'Apache Tomcat');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `type` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `last_name`, `email`, `phone`, `type`) VALUES
(87, 'dan', 'ruiz', 'ruizd1710@gmail.com', '72064388', 'Natural'),
(88, 'dan', 'ruiz', 'ruizd1710@gmail.com', '71161351', 'Natural');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `id` int(7) NOT NULL,
  `packet_id` int(8) NOT NULL,
  `extra_disk_space` int(5) NOT NULL,
  `extra_db_space` int(5) NOT NULL,
  `client_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`id`, `packet_id`, `extra_disk_space`, `extra_db_space`, `client_id`) VALUES
(61, 1, 0, 0, 88);

-- --------------------------------------------------------

--
-- Table structure for table `database_server`
--

CREATE TABLE `database_server` (
  `name` varchar(30) NOT NULL,
  `id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `database_server`
--

INSERT INTO `database_server` (`name`, `id`) VALUES
('MySQL', 1),
('PostgreSQL', 2);

-- --------------------------------------------------------

--
-- Table structure for table `hosted_site`
--

CREATE TABLE `hosted_site` (
  `id` int(11) NOT NULL,
  `web_server` int(8) NOT NULL,
  `php_version` varchar(5) NOT NULL,
  `uses_nodejs` tinyint(1) NOT NULL DEFAULT 0,
  `db_server` int(8) NOT NULL,
  `db_password` varchar(50) NOT NULL,
  `site_id` int(8) NOT NULL,
  `template_id` int(8) NOT NULL,
  `template_version` varchar(5) NOT NULL,
  `protected_dir` text NOT NULL,
  `index_name` varchar(12) NOT NULL,
  `ldap_user_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hosted_site`
--

INSERT INTO `hosted_site` (`id`, `web_server`, `php_version`, `uses_nodejs`, `db_server`, `db_password`, `site_id`, `template_id`, `template_version`, `protected_dir`, `index_name`, `ldap_user_id`) VALUES
(48, 1, '5.6', 1, 1, 'asfaf', 40, 1, '4', '', 'index.html', 42);

-- --------------------------------------------------------

--
-- Table structure for table `ldap_user`
--

CREATE TABLE `ldap_user` (
  `id` int(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `client_id` int(7) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ldap_user`
--

INSERT INTO `ldap_user` (`id`, `username`, `client_id`, `password`) VALUES
(42, 'www.test.nat.cuftp', 88, 'asgagag');

-- --------------------------------------------------------

--
-- Table structure for table `packet`
--

CREATE TABLE `packet` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `disk_space` int(20) NOT NULL,
  `db_space` int(20) NOT NULL,
  `client_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packet`
--

INSERT INTO `packet` (`id`, `name`, `disk_space`, `db_space`, `client_type`) VALUES
(1, 'Profesional', 800, 200, 'Natural'),
(2, 'Giga', 2400, 600, 'Natural'),
(3, 'Extra', 4000, 1000, 'Natural'),
(4, 'Premium', 8000, 2000, 'Natural'),
(6, 'Profesional', 700, 100, 'Empresarial');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `client_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `name`, `alias`, `client_id`) VALUES
(40, 'test.nat.cu', 'prueba', 88);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `web_technology_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `name`, `web_technology_type`) VALUES
(1, 'symfony', 'framework'),
(2, 'wordpress', 'CMS'),
(3, 'autónomo', 'autónomo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `available_web_server`
--
ALTER TABLE `available_web_server`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_ibfk_1` (`client_id`),
  ADD KEY `packet_id` (`packet_id`);

--
-- Indexes for table `database_server`
--
ALTER TABLE `database_server`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `hosted_site`
--
ALTER TABLE `hosted_site`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hosted_site_db_server` (`db_server`),
  ADD KEY `hosted_site_web_server` (`web_server`),
  ADD KEY `hosted_site_ldap` (`ldap_user_id`),
  ADD KEY `hosted_site_site` (`site_id`),
  ADD KEY `hosted_site_template` (`template_id`);

--
-- Indexes for table `ldap_user`
--
ALTER TABLE `ldap_user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `packet`
--
ALTER TABLE `packet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `site_ibfk_1` (`client_id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `hosted_site`
--
ALTER TABLE `hosted_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `ldap_user`
--
ALTER TABLE `ldap_user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `packet`
--
ALTER TABLE `packet`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `contract_ibfk_2` FOREIGN KEY (`packet_id`) REFERENCES `packet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contract_ibfk_3` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hosted_site`
--
ALTER TABLE `hosted_site`
  ADD CONSTRAINT `hosted_site_db_server` FOREIGN KEY (`db_server`) REFERENCES `database_server` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hosted_site_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hosted_site_ibfk_2` FOREIGN KEY (`ldap_user_id`) REFERENCES `ldap_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hosted_site_template` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hosted_site_web_server` FOREIGN KEY (`web_server`) REFERENCES `available_web_server` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ldap_user`
--
ALTER TABLE `ldap_user`
  ADD CONSTRAINT `ldap_user_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
