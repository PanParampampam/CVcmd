-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Lut 2017, 15:44
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
-- Struktura tabeli dla tabeli `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usera` int(11) NOT NULL,
  `naglowek` text COLLATE utf8mb4_polish_ci NOT NULL,
  `info` text COLLATE utf8mb4_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci AUTO_INCREMENT=24 ;

--
-- Zrzut danych tabeli `info`
--

INSERT INTO `info` (`id`, `id_usera`, `naglowek`, `info`) VALUES
(12, 3, 'Wykształcenie', '1994 - 2003 - Jakaś szkoła\r\n2003 - 2007 - Inna szkoła'),
(13, 3, 'Doświadczenie', '• Praca gdzieśtam\r\n• Praca gdzieś indziej\r\n• Praca jeszcze gdzieś indziej'),
(14, 3, 'Zainteresowania', 'Sporty ekstremalne, muzyka klasyczna, krótkie jeansy'),
(15, 2, 'Wykształcenie', '1998 - 2003 - Jakaś szkoła\r\n2003 - 2007 - Inna szkoła\r\n2007 - 2013 - Studia'),
(16, 2, 'Doświadczenie', '•Praca w jakimś miejscu\r\n•Praca w innym miejscu'),
(17, 2, 'Zainteresowania', 'Sporty ekstremalne, akwarystyka, zbieranie znaczków, ludobójstwo'),
(18, 2, 'Zapychacz', 'lskadj;g\r\nsdlkgj\r\nsgdakljdsaglk\r\n\r\n\r\n\r\nsadg\r\nasdg\r\nsdag\r\ngdas\r\ngds\r\ndgasgds\r\ndgsa\r\n\r\ngdsa\r\nsda\r\nhdsahg\r\nsdaf\r\nes\r\ngf\r\ndsag\r\nds\r\ng\r\nsdg\r\ndgsa\r\ngdsadgds\r\nahg\r\nsae\r\ngh\r\ndsah\r\nhdsa\r\nh\r\nasshg\r\nds\r\na\r\nhsaa\r\nh\r\n'),
(19, 2, 'zapychacz 2', 'lsadjg\r\nsadlgkjsad\r\nsdaglkjasgd\r\nlsdkagj\r\nlskadgjkl\r\nsaglkjksadgj\r\ngasdgdsa\r\n\r\n\r\n\r\nasdgsadg\r\n\r\nsdag\r\ngsad\r\ngds\r\ngads\r\ngads\r\n\r\nags\r\n'),
(20, 4, 'Zainteresowania', 'sadl;gkjs;dlagjks;dlkgjds;akgjsd;kgjs;dalkgjds;kjgds;kagjsd;akjg;dslakjgds;ajg;lsgdj;ldskaj;sdkgja;ldskajg;lsdajgl;sdkajf;dslkagds;lakjgsa;sldgjsd;aljkgads\r\n'),
(21, 2, 'COstam', 'sadg;lkjsaf;kjsd;alfkjs;dfkjd;klja;fdlkjs;dfalkjsd;aflkjfd;slakjfsad;lkfjdsa;lkfjdas;fkja;ldsakjf;ldsakjf;lskadj;flsadjf;dlaskjfd;asljfd;slakfjds;afjds;alkfjsdalfkjds;alkjfs;adlkjf;sdlakfj;sdalkfj;sladjf'),
(22, 2, 'Costam', 's;ldakfgj;ldsafkj\r\nalfdkjdflkj;\r\ndasfldasjkldfsa;kj\r\nflkjasdlfk\r\n\r\n\r\n\r\nadsfsdaf\r\nadsfsdaf\r\nsadf\r\nsdaf\r\nsdaf\r\nads\r\nfsfa\r\nd\r\ndsfa\r\nsdaf\r\nsad\r\nf\r\ndsaf\r\nads\r\nfsda\r\nf\r\nsdaf\r\nsda\r\nfsda\r\nf\r\nads\r\nf\r\nsdaf\r\nfad\r\nfdsa\r\nfad\r\nfad\r\nfads\r\nfads\r\nds\r\nfas\r\ndf\r\nsdaf\r\nads'),
(23, 2, 'dla;skgj', ';sladkfjsdaf\r\nsdfafdsa\r\nfds\r\nadsf\r\nfdsa\r\nsdfa\r\nfsd\r\nadsagsd\r\nags\r\ndag\r\n\r\n\r\n\r\n\r\nsdag\r\nsa\r\ndg\r\ndsg\r\nas\r\ndg\r\ndsa\r\ng\r\ndsag\r\nsdag\r\ns\r\ndag\r\nsadg\r\nsadg\r\ndag\r\nsd\r\ng\r\nsdag\r\ndsa\r\ngsd\r\nag\r\ndsa\r\ngads\r\ng\r\nasdg\r\n');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
