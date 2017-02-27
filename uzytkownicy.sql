-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Lut 2017, 15:43
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cvcmd`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `pass` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `godnosc` text COLLATE utf8mb4_polish_ci NOT NULL,
  `adres` text COLLATE utf8mb4_polish_ci NOT NULL,
  `tel` text COLLATE utf8mb4_polish_ci NOT NULL,
  `emailcv` text COLLATE utf8mb4_polish_ci NOT NULL,
  `data_urodzenia` text COLLATE utf8mb4_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `pass`, `email`, `godnosc`, `adres`, `tel`, `emailcv`, `data_urodzenia`) VALUES
(2, 'kuba', '$2y$10$5AFjrIWrgUFwJE2NCu/VG.i1kUMFIjOvbj0xL2NheoPRqhr2460Sq', 'kuba@gmail.com', 'Jakub Giedrys', 'os. Bolesława Śmiałego 37/108, 60-682 Poznań', '727 933 007', 'kuba@gmail.com', '01.11.1991'),
(3, 'maras', '$2y$10$J3zlXBiHoen0tXIM3RHxFOHaxdkZuoZVJyLkBdGsxFzjnN8fvqdPy', 'maras@gmail.com', '', '', '', '', ''),
(4, 'Zosia', '$2y$10$Kkm6OH8UksZX.E7gVWVKgOeSYFCrS.rYi1dEc3atvJfuSAYD44GMe', 'zosia@gmail.com', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
