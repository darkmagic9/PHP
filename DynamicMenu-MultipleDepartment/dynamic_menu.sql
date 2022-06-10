-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2020 at 06:54 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dynamic_menu_multiple_department`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) NOT NULL,
  `department_status` varchar(10) NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dynamic_menu_multiple_department.department: ~3 rows (approximately)
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` (`department_id`, `department_name`, `department_status`) VALUES
	(1, 'Admin', 'Enable');
INSERT INTO `department` (`department_id`, `department_name`, `department_status`) VALUES
	(2, 'Accounts', 'Enable');
INSERT INTO `department` (`department_id`, `department_name`, `department_status`) VALUES
	(3, 'HR', 'Enable');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;

-- Dumping structure for table dynamic_menu_multiple_department.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL,
  `menu_icon` varchar(200) NOT NULL,
  `menu_status` varchar(20) NOT NULL DEFAULT 'Enable',
  `menu_department` varchar(50) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dynamic_menu_multiple_department.menu: ~4 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_icon`, `menu_status`, `menu_department`) VALUES
	(1, 'Category', 'fa fa-list', 'Enable', '1');
INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_icon`, `menu_status`, `menu_department`) VALUES
	(2, 'User', 'fa fa-user', 'Enable', '1');
INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_icon`, `menu_status`, `menu_department`) VALUES
	(3, 'Salary', 'fa-money', 'Enable', '1');
INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_icon`, `menu_status`, `menu_department`) VALUES
	(4, 'Setting', 'fa fa-cogs', 'Enable', '1');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table dynamic_menu_multiple_department.menu_useraccess
CREATE TABLE IF NOT EXISTS `menu_useraccess` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_permission` varchar(50) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dynamic_menu_multiple_department.menu_useraccess: ~18 rows (approximately)
/*!40000 ALTER TABLE `menu_useraccess` DISABLE KEYS */;
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(13, 1, 1, 2, 'False');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(14, 2, 3, 2, 'False');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(15, 3, 2, 2, 'False');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(16, 1, 1, 3, 'False');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(17, 2, 3, 3, 'False');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(18, 3, 2, 3, 'False');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(43, 1, 1, 1, 'False');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(44, 2, 2, 1, 'True');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(45, 2, 3, 1, 'True');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(46, 1, 4, 1, 'True');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(47, 1, 5, 1, 'True');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(48, 3, 6, 1, 'True');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(49, 3, 7, 1, 'True');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(50, 4, 8, 1, 'True');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(51, 4, 9, 1, 'True');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(52, 4, 10, 1, 'True');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(53, 4, 11, 1, 'True');
INSERT INTO `menu_useraccess` (`permission_id`, `menu_id`, `sub_menu_id`, `user_id`, `user_permission`) VALUES
	(54, 4, 12, 1, 'True');
/*!40000 ALTER TABLE `menu_useraccess` ENABLE KEYS */;

-- Dumping structure for table dynamic_menu_multiple_department.submenu_department
CREATE TABLE IF NOT EXISTS `submenu_department` (
  `subid` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (`subid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dynamic_menu_multiple_department.submenu_department: ~22 rows (approximately)
/*!40000 ALTER TABLE `submenu_department` DISABLE KEYS */;
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(1, 1, 1, 1, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(2, 3, 2, 2, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(3, 3, 2, 3, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(4, 2, 3, 2, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(5, 4, 10, 1, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(6, 4, 10, 2, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(7, 4, 10, 3, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(8, 4, 11, 1, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(9, 4, 11, 2, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(10, 4, 11, 3, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(11, 4, 12, 1, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(12, 4, 12, 2, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(13, 4, 12, 3, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(14, 2, 13, 1, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(15, 2, 13, 2, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(16, 2, 13, 3, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(17, 3, 14, 1, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(18, 3, 14, 2, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(19, 3, 14, 3, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(20, 3, 15, 1, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(21, 3, 15, 2, 'Enable');
INSERT INTO `submenu_department` (`subid`, `menu_id`, `sub_menu_id`, `department_id`, `status`) VALUES
	(22, 3, 15, 3, 'Enable');
/*!40000 ALTER TABLE `submenu_department` ENABLE KEYS */;

-- Dumping structure for table dynamic_menu_multiple_department.sub_menu
CREATE TABLE IF NOT EXISTS `sub_menu` (
  `submenu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `submenu_name` varchar(100) NOT NULL,
  `submenu_url` varchar(200) NOT NULL,
  `submenu_display` varchar(10) NOT NULL,
  `submenu_order` int(11) NOT NULL,
  `submenu_status` varchar(20) NOT NULL DEFAULT 'Enable',
  `submenu_department` varchar(50) NOT NULL,
  PRIMARY KEY (`submenu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dynamic_menu_multiple_department.sub_menu: ~14 rows (approximately)
/*!40000 ALTER TABLE `sub_menu` DISABLE KEYS */;
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(1, 1, 'Category List', 'category_list.php', 'Yes', 2, 'Enable', '1');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(2, 2, 'User List', 'user_list.php', 'Yes', 0, 'Enable', '1');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(3, 2, 'Add User', 'user_add.php', 'Yes', 0, 'Enable', '3');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(4, 1, 'Category Add', 'category_add.php', 'Yes', 0, 'Enable', '1');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(5, 1, 'Category Edit', 'category_edit.php', 'Yes', 1, 'Enable', '1');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(6, 3, 'Salary Generate', 'salary_generate.php', 'Yes', 0, 'Enable', '3');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(7, 3, 'Salary Paid', 'salary_paid.php', 'Yes', 0, 'Enable', '2');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(8, 3, 'Demo Add', 'demo_add.php', 'Yes', 1, 'Enable', '1');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(9, 3, 'Demo Edit', 'demo_edit.php', 'Yes', 2, 'Enable', '1');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(10, 4, 'Add Menu', 'menu_add.php', 'Yes', 0, 'Enable', '1');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(11, 4, 'Add Sub Menu', 'submenu_add.php', 'Yes', 1, 'Enable', '1');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(12, 4, 'Permission', 'user_permission.php', 'Yes', 2, 'Enable', '1');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(13, 2, 'User Edit', 'user_edit.php', 'Yes', 0, 'Enable', '1');
INSERT INTO `sub_menu` (`submenu_id`, `menu_id`, `submenu_name`, `submenu_url`, `submenu_display`, `submenu_order`, `submenu_status`, `submenu_department`) VALUES
	(14, 3, 'Salary Paid', 'salary_paid.php', 'Yes', 0, 'Enable', '1');
/*!40000 ALTER TABLE `sub_menu` ENABLE KEYS */;

-- Dumping structure for table dynamic_menu_multiple_department.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_department` varchar(100) NOT NULL,
  `user_status` varchar(20) NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table dynamic_menu_multiple_department.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `user_name`, `user_department`, `user_status`) VALUES
	(1, 'Knowledge', '1', 'Enable');
INSERT INTO `users` (`user_id`, `user_name`, `user_department`, `user_status`) VALUES
	(2, 'Thruster', '2', 'Enable');
INSERT INTO `users` (`user_id`, `user_name`, `user_department`, `user_status`) VALUES
	(3, 'User', '3', 'Enable');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
