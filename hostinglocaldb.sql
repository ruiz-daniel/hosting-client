-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2021 at 08:17 PM
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
  `id` varchar(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `type` varchar(12) NOT NULL,
  `user_id` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `last_name`, `email`, `phone`, `type`, `user_id`) VALUES
('115', 'DRG', 'weiss', 'ruizd1710@gmail.com', '21541251', 'Natural', NULL),
('116', 'DRG', 'co', 'ruizd1710@gmail.com', '32521351', 'Empresarial', NULL),
('15cc3609', 'test', 'ruiz', 'ruizd1710@gmail.com', '72064388', 'Natural', NULL),
('28393c5d', 'DRG', '1weqrqt', 'ruizd1710@gmail.com', '12456745', 'Natural', NULL),
('93', 'Daniel', 'ruiz garcia', 'ruizd1710@gmail.com', '72064388', 'Natural', NULL),
('94', 'david', 'carvajal iznaga', 'ruizd1710@gmail.com', '72353090', 'Natural', NULL),
('96', 'drg', 'weiss', 'weiss@gmail.com', '72065566', 'Natural', NULL),
('97', 'dan', 'ziur', 'ruizd1710@gmail.com', '15412512', 'Natural', NULL),
('98', 'grim', 'noire', 'ruizd1710@gmail.com', '2362136136', 'Natural', NULL),
('c637bfb9', 'DRG', 'rft', 'ruizd1710@gmail.com', '12456745', 'Natural', NULL);

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
('Sin Base de Datos', 0),
('MySQL', 1),
('PostgreSQL', 2);

-- --------------------------------------------------------

--
-- Table structure for table `deleted_site`
--

CREATE TABLE `deleted_site` (
  `id` varchar(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `client_id` varchar(8) NOT NULL,
  `quota_id` int(8) NOT NULL,
  `index_name` varchar(30) NOT NULL DEFAULT 'index.html',
  `protected_dir` varchar(100) NOT NULL,
  `web_server_id` int(8) NOT NULL,
  `php_version` varchar(30) NOT NULL,
  `node_js` tinyint(1) NOT NULL DEFAULT 0,
  `db_server_id` int(8) DEFAULT 0,
  `db_name` varchar(30) DEFAULT NULL,
  `db_user` varchar(30) DEFAULT NULL,
  `db_password` varchar(30) DEFAULT NULL,
  `template_id` int(8) NOT NULL,
  `template_version` varchar(30) NOT NULL,
  `hosted` tinyint(1) NOT NULL DEFAULT 0,
  `IPs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ldap_user`
--

CREATE TABLE `ldap_user` (
  `id` varchar(8) NOT NULL,
  `username` varchar(30) NOT NULL,
  `site_id` varchar(8) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ldap_user`
--

INSERT INTO `ldap_user` (`id`, `username`, `site_id`, `password`) VALUES
('28309389', 'uidftp', '283906b6', 'asfgag'),
('46', 'test2ftp', '44', 'asdfaff'),
('47', 'test3ftp', '45', 'agasgags'),
('48', 'test4ftp', '46', 'agfasgags'),
('49', 'test5ftp', '47', 'asgashaha'),
('50', 'test5ftp1', '47', 'asfgasgag'),
('69', 'test6ftp', '63', 'qwgtaqwgqg'),
('a747bdbe', 'testftp', '43', '12346'),
('c6360888', 'md5ftp1', 'c6379477', '1c33c7e8661203a4'),
('f64fe304', 'test7ftp', '64', 'awtaqwgtaqg');

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
(66, 1, 350, 200),
(67, 1, 100, 0),
(69, 4, 0, 0),
(72, 3, 0, 0),
(73, 1, 0, 0),
(90, 2, 0, 0),
(91, 6, 0, 0),
(108, 2, 0, 0),
(109, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` varchar(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `alias` varchar(20) NOT NULL,
  `client_id` varchar(8) NOT NULL,
  `quota_id` int(8) NOT NULL,
  `index_name` varchar(30) NOT NULL DEFAULT 'index.html',
  `protected_dir` varchar(100) NOT NULL,
  `web_server_id` int(8) NOT NULL,
  `php_version` varchar(30) NOT NULL,
  `node_js` tinyint(1) NOT NULL DEFAULT 0,
  `db_server_id` int(8) DEFAULT 0,
  `db_name` varchar(30) DEFAULT NULL,
  `db_user` varchar(30) DEFAULT NULL,
  `db_password` varchar(30) DEFAULT NULL,
  `template_id` int(8) NOT NULL,
  `template_version` varchar(30) NOT NULL,
  `hosted` tinyint(1) NOT NULL DEFAULT 0,
  `IPs` text NOT NULL,
  `modified` tinyint(1) NOT NULL DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `name`, `alias`, `client_id`, `quota_id`, `index_name`, `protected_dir`, `web_server_id`, `php_version`, `node_js`, `db_server_id`, `db_name`, `db_user`, `db_password`, `template_id`, `template_version`, `hosted`, `IPs`, `modified`, `deleted`) VALUES
('283906b6', 'www.test8.nat.cu', 'uuid', '28393c5d', 108, 'index.html', '', 2, '', 0, 0, '', '', '', 3, '', 0, '', 0, 0),
('43', 'www.test.nat.cu', 'pruebas', '93', 66, 'index.html', '', 1, '7.1', 1, 2, 'testdb', 'testdbo', 'asfqawq', 1, '5', 0, '', 0, 0),
('44', 'www.test2.nat.cu', 'prueba2', '94', 67, 'index.html', '', 1, '7.2', 0, 1, 'test2db', 'test2dbo', 'asgfasfa', 2, '2', 0, '', 0, 0),
('45', 'www.test3.nat.cu', '', '96', 69, 'index.html', 'folder, folder1, folder2', 2, '', 0, 2, 'testdb', 'testdbo', 'asgasga', 3, '', 0, '', 0, 0),
('46', 'www.test4.nat.cu', '', '97', 72, 'index.html', '', 1, '7.2', 1, 1, 'test4db', 'test4dbo', 'qwrqwtgq', 1, '5', 0, '', 0, 0),
('47', 'www.test5.nat.cu', 'multildap', '98', 73, 'index.html', '', 1, '7.2', 0, 1, 'test5db', 'test5dbo', 'aeyqeyqh', 1, '5', 0, '', 0, 0),
('63', 'www.test6.nat.cu', 'nodb', '115', 90, 'index.html', '', 1, '7.1', 0, 0, '', '', '', 2, '', 0, '', 0, 0),
('64', 'www.test7.nat.cu', 'ips', '116', 91, 'index.html', '', 1, '7.1', 0, 0, '', '', '', 1, '', 0, '192.168.58.8, 192.168.78.9, 192.168.67.89, 192.168.76.54', 0, 0),
('c6379477', 'www.test9.nat.cu', 'md5', 'c637bfb9', 109, 'index.html', '', 2, '', 0, 0, '', '', '', 3, '', 0, '', 0, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(8) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(90) NOT NULL,
  `role_id` int(8) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role_id`) VALUES
('0', 'super', '9f6755788d156361df84ff2831b1411c', 3),
('3cf86dd7', 'daniel', '202cb962ac59075b964b07152d234b70', 2),
('6a24bdd0', 'cliente', '202cb962ac59075b964b07152d234b70', 1),
('ac1d3728', 'admin', '21232f297a57a5a743894a0e4a801fc3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'Cliente'),
(2, 'Especialista'),
(3, 'Administrador');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_user_fk` (`user_id`);

--
-- Indexes for table `database_server`
--
ALTER TABLE `database_server`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `deleted_site`
--
ALTER TABLE `deleted_site`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `site_ibfk_1` (`client_id`),
  ADD KEY `site_quota_fk` (`quota_id`),
  ADD KEY `site_database_fk` (`db_server_id`),
  ADD KEY `site_web_server_fk` (`web_server_id`),
  ADD KEY `site_template_fk` (`template_id`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_fk` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `packet`
--
ALTER TABLE `packet`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quota`
--
ALTER TABLE `quota`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_user_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_fk` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
