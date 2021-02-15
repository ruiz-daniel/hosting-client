-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2021 at 11:25 PM
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
(93, 'daniel', 'ruiz garcia', 'ruizd1710@gmail.com', '72064388', 'Natural'),
(94, 'david', 'carvajal iznaga', 'ruizd1710@gmail.com', '72353090', 'Natural');

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
-- Table structure for table `ldap_user`
--

CREATE TABLE `ldap_user` (
  `id` int(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `site_id` int(8) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ldap_user`
--

INSERT INTO `ldap_user` (`id`, `username`, `site_id`, `password`) VALUES
(45, 'testftp', 43, 'aqwfraqfa'),
(46, 'test2ftp', 44, 'asdfaff');

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
-- Table structure for table `quota`
--

CREATE TABLE `quota` (
  `id` int(7) NOT NULL,
  `packet_id` int(8) NOT NULL,
  `extra_disk_space` int(5) NOT NULL,
  `extra_db_space` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quota`
--

INSERT INTO `quota` (`id`, `packet_id`, `extra_disk_space`, `extra_db_space`) VALUES
(66, 2, 300, 200),
(67, 1, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `client_id` int(7) NOT NULL,
  `quota_id` int(8) NOT NULL,
  `index_name` varchar(30) NOT NULL DEFAULT 'index.html',
  `protected_dir` varchar(100) NOT NULL,
  `web_server_id` int(8) NOT NULL,
  `php_version` varchar(30) NOT NULL,
  `node_js` tinyint(1) NOT NULL DEFAULT 0,
  `db_server_id` int(8) NOT NULL,
  `db_name` varchar(30) NOT NULL,
  `db_user` varchar(30) NOT NULL,
  `db_password` varchar(30) NOT NULL,
  `template_id` int(8) NOT NULL,
  `template_version` varchar(30) NOT NULL,
  `hosted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `name`, `alias`, `client_id`, `quota_id`, `index_name`, `protected_dir`, `web_server_id`, `php_version`, `node_js`, `db_server_id`, `db_name`, `db_user`, `db_password`, `template_id`, `template_version`, `hosted`) VALUES
(43, 'www.test.nat.cu', 'prueba', 93, 66, 'index.html', '', 1, '7.2', 0, 1, 'testdb', 'testdbo', 'asfqawq', 1, '4', 0),
(44, 'www.test2.nat.cu', 'prueba2', 94, 67, 'index.html', '', 1, '7.2', 0, 1, 'test2db', 'test2dbo', 'asgfasfa', 2, '2', 0);

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
-- Indexes for table `database_server`
--
ALTER TABLE `database_server`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `ldap_user`
--
ALTER TABLE `ldap_user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `client_id` (`site_id`);

--
-- Indexes for table `packet`
--
ALTER TABLE `packet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quota`
--
ALTER TABLE `quota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packet_id` (`packet_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `site_ibfk_1` (`client_id`),
  ADD KEY `site_quota_fk` (`quota_id`),
  ADD KEY `site_database_fk` (`db_server_id`),
  ADD KEY `site_web_server_fk` (`web_server_id`),
  ADD KEY `site_template_fk` (`template_id`);

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
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `ldap_user`
--
ALTER TABLE `ldap_user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `packet`
--
ALTER TABLE `packet`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quota`
--
ALTER TABLE `quota`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ldap_user`
--
ALTER TABLE `ldap_user`
  ADD CONSTRAINT `ldap_site_fk` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quota`
--
ALTER TABLE `quota`
  ADD CONSTRAINT `quota_ibfk_2` FOREIGN KEY (`packet_id`) REFERENCES `packet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_client_fk` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_database_fk` FOREIGN KEY (`db_server_id`) REFERENCES `database_server` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_quota_fk` FOREIGN KEY (`quota_id`) REFERENCES `quota` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_template_fk` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_web_server_fk` FOREIGN KEY (`web_server_id`) REFERENCES `available_web_server` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
