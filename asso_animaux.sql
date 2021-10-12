-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 12, 2021 at 07:26 PM
-- Server version: 5.7.35
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asso_animaux`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
CREATE TABLE IF NOT EXISTS `animals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `dateAjout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `nom`, `description`, `age`, `dateAjout`) VALUES
(1, 'vvvvv', 'gentilvvv', 5, '2021-10-11 16:34:17'),
(2, 'test', 'a', 2, '2021-10-11 17:19:30'),
(3, 'aaaaa', 'cqrvb', 2, '2021-10-11 22:20:57'),
(4, 'grigbiq', 'vqjbbnsr', 5, '2021-10-11 22:22:30'),
(5, 'btqiubgq', 'bjsnbs', 2, '2021-10-11 22:23:12'),
(6, 'zzzz', 'zzzz', 2, '2021-10-11 22:24:37'),
(7, 'zzzz', 'zzz', 2, '2021-10-11 22:25:50'),
(8, 'zzzz', 'zzzz', 10, '2021-10-11 22:26:31'),
(9, 'zzzz', 'zzzz', 4, '2021-10-11 22:27:05'),
(10, 'zzzz', 'zzzz', 7, '2021-10-11 22:27:29'),
(11, 'gggggggggggg', 'ggggggggggg', 6, '2021-10-11 22:28:43'),
(12, 'zzzz', 'zzzz', 4, '2021-10-12 09:21:24'),
(13, 'azerty', 'azerty mlk', 1, '2021-10-12 15:10:01'),
(14, 'aaa', 'aaa', 9, '2021-10-12 19:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `demandeclient`
--

DROP TABLE IF EXISTS `demandeclient`;
CREATE TABLE IF NOT EXISTS `demandeclient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_animal` int(11) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `dateAjout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demandeclient`
--

INSERT INTO `demandeclient` (`id`, `id_animal`, `contact`, `text`, `dateAjout`) VALUES
(4, 13, 'azerty@mail.com', 'je le veux', '2021-10-12 21:25:19'),
(3, 13, 'azerty@mail.com', 'je voudrais reservÃ© ce ct animal', '2021-10-12 15:14:43');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` int(11) NOT NULL DEFAULT '0' COMMENT '0 = user et 1 = admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `created_at`, `role`) VALUES
(4, 'azerty', 'azerty@mail.com', '$2y$10$Z10m9IiYK7VCwyExQD0K7erXCBSTTaIz3Ksub9Awm/rhYuFsiK792', '2021-10-12 10:14:07', 0),
(5, 'nd', 'nd@nd.com', '$2y$10$OLgTE.gASNqMt60RIWsQ/ewavy62NPcsoDdjtrdX7g0rzncV0JXja', '2021-10-12 11:44:01', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
