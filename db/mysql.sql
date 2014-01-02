-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2013 at 05:30 AM
-- Server version: 5.5.23
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `icsevoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricNumber` varchar(10) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `othernames` varchar(45) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `role` enum('super','other') NOT NULL DEFAULT 'other',
  `created_on` datetime NOT NULL,
  `last_modified_on` datetime NOT NULL,
  `department_id` int(11) NOT NULL,
  `Faculty_id` int(11) NOT NULL,
  `University_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ssn_UNIQUE` (`matricNumber`),
  KEY `fk_administrators_departments1` (`department_id`),
  KEY `fk_administrators_Faculties1` (`Faculty_id`),
  KEY `fk_administrators_Universities1` (`University_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='maintain administrator data' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `matricNumber`, `firstname`, `lastname`, `othernames`, `password`, `role`, `created_on`, `last_modified_on`, `department_id`, `Faculty_id`, `University_id`) VALUES
(1, '10/52HA068', 'Peter', 'Makafan', 'Oseanemo', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'super', '2013-05-29 16:46:57', '2013-06-18 04:30:14', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricNumber` varchar(10) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `othernames` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `isvoted` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `last_modified_on` datetime NOT NULL,
  `department_id` int(11) NOT NULL,
  `University_id` int(11) NOT NULL,
  `Faculty_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ssn_UNIQUE` (`matricNumber`),
  KEY `Voters_department` (`department_id`),
  KEY `Voters_University` (`University_id`),
  KEY `Voters_Faculty` (`Faculty_id`),
  KEY `candidate_position` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='maintain candidate data' AUTO_INCREMENT=9 ;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `matricNumber`, `firstname`, `lastname`, `othernames`, `password`, `isvoted`, `created_on`, `last_modified_on`, `department_id`, `University_id`, `Faculty_id`, `position_id`) VALUES
(1, '11/52HA103', 'Olumide', 'Oyeyipo', 'Lumex', 'cf964f777bb23be9988ce6f0f2b9d562fb145498', 0, '2013-05-30 18:11:09', '2013-05-30 18:33:48', 1, 1, 1, 1),
(2, '10/52HA087', 'Fatimah', 'Oyewusi', 'Fatty', 'df4f92acfd37b67ba23a6aebcb0a8ec33459d0af', 0, '2013-05-30 18:12:33', '2013-05-30 18:12:33', 1, 1, 1, 2),
(3, '10/52HA000', 'Steven', 'Abikoye', 'Baby boo', '6f65172d26f0847195809f9263f59acce9d96ae4', 0, '2013-05-30 18:15:25', '2013-05-30 18:15:25', 1, 1, 1, 3),
(4, '10/52HA078', 'Oke', 'John', 'Oluranti (Aristotle)', '6d73d34e71cd212d35f709b9dff6a52b2aa582ec', 0, '2013-05-30 18:21:05', '2013-05-30 18:21:05', 1, 1, 1, 4),
(5, '11/52HA001', 'Ibrahim', 'Abati', 'AceKyd', 'd86caede0264d429ed6b1d3fe83ec87a18eed990', 0, '2013-05-30 18:23:50', '2013-05-30 18:23:50', 1, 1, 1, 5),
(6, '10/52HA064', 'Hajarah', 'Jibril', 'Jewels', 'ab10ac5f56ff0214de4e4e4fb67e171800525e37', 0, '2013-05-30 18:25:25', '2013-05-30 18:25:25', 1, 1, 1, 6),
(7, '10/52HA004', 'Adekunle', 'Bakare', 'K-Bars', '2ed45186c72f9319dc64338cdf16ab76b44cf3d1', 0, '2013-05-30 18:27:09', '2013-05-30 18:34:50', 1, 1, 1, 7),
(8, '10/52HA009', 'Moruf', 'Adefamoye', 'Murphy', '5d517c7e79d61abf838cff63b7781ed7382bc655', 0, '2013-05-30 18:28:39', '2013-05-30 18:28:39', 1, 1, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `Faculty_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_belongs_to_Faculty1` (`Faculty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='maintain department data' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `Faculty_id`) VALUES
(1, 'Computer Science', 1);

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE IF NOT EXISTS `elections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `name`, `starttime`, `endtime`) VALUES
(1, 'NACOSS ELECTION', '2013-05-31 00:00:00', '2013-05-31 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `elections_has_candidates`
--

CREATE TABLE IF NOT EXISTS `elections_has_candidates` (
  `elections_id` int(11) NOT NULL,
  `candidates_id` int(11) NOT NULL,
  PRIMARY KEY (`elections_id`,`candidates_id`),
  KEY `fk_elections_has_candidates_candidates` (`candidates_id`),
  KEY `fk_elections_has_candidates_elections` (`elections_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='maintains voters who registered for an election';

--
-- Dumping data for table `elections_has_candidates`
--

INSERT INTO `elections_has_candidates` (`elections_id`, `candidates_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `elections_has_voters`
--

CREATE TABLE IF NOT EXISTS `elections_has_voters` (
  `elections_id` int(11) NOT NULL,
  `Voters_id` int(11) NOT NULL,
  PRIMARY KEY (`elections_id`,`Voters_id`),
  KEY `elections_has_Voters_Voters` (`Voters_id`),
  KEY `elections_has_Voters_elections` (`elections_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elections_has_voters`
--

INSERT INTO `elections_has_voters` (`elections_id`, `Voters_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139),
(1, 140),
(1, 141),
(1, 142),
(1, 143),
(1, 144),
(1, 145),
(1, 146),
(1, 147),
(1, 148),
(1, 149),
(1, 150),
(1, 151),
(1, 152),
(1, 153),
(1, 154),
(1, 155),
(1, 156),
(1, 157),
(1, 158),
(1, 159),
(1, 160),
(1, 161),
(1, 162),
(1, 163),
(1, 164),
(1, 165),
(1, 166),
(1, 167),
(1, 168),
(1, 169),
(1, 170),
(1, 171),
(1, 172),
(1, 173),
(1, 174),
(1, 175),
(1, 176),
(1, 177),
(1, 178),
(1, 179),
(1, 180),
(1, 181),
(1, 182),
(1, 183),
(1, 184),
(1, 185),
(1, 186),
(1, 187),
(1, 188),
(1, 189),
(1, 190),
(1, 191),
(1, 192),
(1, 193),
(1, 194),
(1, 195),
(1, 196),
(1, 197),
(1, 198),
(1, 199),
(1, 200),
(1, 201),
(1, 202),
(1, 203),
(1, 204),
(1, 205),
(1, 206),
(1, 207),
(1, 208),
(1, 209),
(1, 210),
(1, 211),
(1, 212),
(1, 213),
(1, 214),
(1, 215),
(1, 216),
(1, 217),
(1, 218),
(1, 219),
(1, 220),
(1, 221),
(1, 222),
(1, 223),
(1, 224),
(1, 225),
(1, 226),
(1, 227),
(1, 228),
(1, 229),
(1, 230),
(1, 231),
(1, 232),
(1, 233),
(1, 234),
(1, 235),
(1, 236),
(1, 237),
(1, 238),
(1, 239),
(1, 240),
(1, 241),
(1, 242),
(1, 243),
(1, 244),
(1, 245),
(1, 246),
(1, 247),
(1, 248),
(1, 249),
(1, 250),
(1, 251),
(1, 252),
(1, 253),
(1, 254),
(1, 255),
(1, 256),
(1, 257),
(1, 258),
(1, 259),
(1, 260),
(1, 261),
(1, 262),
(1, 263),
(1, 264),
(1, 265),
(1, 266),
(1, 267),
(1, 268),
(1, 269),
(1, 270),
(1, 271),
(1, 272),
(1, 273),
(1, 274),
(1, 275),
(1, 276),
(1, 277),
(1, 278),
(1, 279),
(1, 280),
(1, 281),
(1, 282),
(1, 283),
(1, 284),
(1, 285),
(1, 286),
(1, 287),
(1, 288),
(1, 289),
(1, 290),
(1, 291),
(1, 292),
(1, 293),
(1, 294),
(1, 295),
(1, 296),
(1, 297),
(1, 298),
(1, 299),
(1, 300),
(1, 301),
(1, 302),
(1, 303),
(1, 304),
(1, 305),
(1, 306),
(1, 307),
(1, 308),
(1, 309),
(1, 310),
(1, 311),
(1, 312),
(1, 313),
(1, 314),
(1, 315),
(1, 316),
(1, 317),
(1, 318),
(1, 319),
(1, 320),
(1, 321),
(1, 322),
(1, 323),
(1, 324),
(1, 325),
(1, 326),
(1, 327),
(1, 328),
(1, 329),
(1, 330),
(1, 331),
(1, 332),
(1, 333),
(1, 334),
(1, 335),
(1, 336),
(1, 337),
(1, 338),
(1, 339),
(1, 340),
(1, 341),
(1, 342),
(1, 343),
(1, 344),
(1, 345),
(1, 346),
(1, 347),
(1, 348),
(1, 349),
(1, 350),
(1, 351),
(1, 352),
(1, 353),
(1, 354),
(1, 355),
(1, 356),
(1, 357),
(1, 358),
(1, 359),
(1, 360),
(1, 361),
(1, 362),
(1, 363),
(1, 364),
(1, 365),
(1, 366),
(1, 367),
(1, 368),
(1, 369),
(1, 370),
(1, 371),
(1, 372),
(1, 373),
(1, 374),
(1, 375),
(1, 376),
(1, 377),
(1, 378),
(1, 379),
(1, 380),
(1, 381),
(1, 382),
(1, 383),
(1, 384),
(1, 385),
(1, 386),
(1, 387),
(1, 388),
(1, 389),
(1, 390),
(1, 391),
(1, 392),
(1, 393),
(1, 394),
(1, 395),
(1, 396),
(1, 397),
(1, 398),
(1, 399),
(1, 400),
(1, 401),
(1, 402),
(1, 403),
(1, 404),
(1, 405),
(1, 406),
(1, 407),
(1, 408),
(1, 409),
(1, 410),
(1, 411),
(1, 412),
(1, 413),
(1, 414),
(1, 415),
(1, 416),
(1, 417),
(1, 418),
(1, 419),
(1, 420),
(1, 421),
(1, 422),
(1, 423),
(1, 424),
(1, 425),
(1, 426),
(1, 427),
(1, 428);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `University_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `faculty_belongs_to_University` (`University_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='maintains faculty data' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `University_id`) VALUES
(1, 'Communication and Information Science', 1);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `level` enum('department','faculty','university') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `level`) VALUES
(1, 'President', 'department'),
(2, 'Vice President', 'department'),
(3, 'General Secretary', 'department'),
(4, 'Finacial Secretary', 'department'),
(5, 'Software Director', 'department'),
(6, 'Social Director', 'department'),
(7, 'Treasurer', 'department'),
(8, 'Sport Director', 'department');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `votecount` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidate_id_UNIQUE` (`candidate_id`),
  KEY `fk_results_candidate1` (`candidate_id`),
  KEY `fk_results_position1` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `candidate_id`, `position_id`, `date_created`, `votecount`) VALUES
(1, 1, 1, '2013-05-31 09:04:27', 78),
(3, 2, 2, '2013-05-31 09:14:20', 69),
(4, 3, 3, '2013-05-31 09:14:20', 70),
(5, 4, 4, '2013-05-31 09:14:20', 69),
(6, 5, 5, '2013-05-31 09:14:20', 71),
(7, 6, 6, '2013-05-31 09:14:20', 72),
(8, 7, 7, '2013-05-31 09:14:20', 66),
(9, 8, 8, '2013-05-31 09:14:20', 65);

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE IF NOT EXISTS `universities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='maintain university data' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`id`, `name`) VALUES
(1, 'University Of Ilorin');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE IF NOT EXISTS `voters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricNumber` varchar(10) NOT NULL,
  `firstname` varchar(160) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `othernames` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `isvoted` tinyint(1) NOT NULL DEFAULT '0',
  `last_modified_on` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  `department_id` int(11) NOT NULL,
  `University_id` int(11) NOT NULL,
  `Faculty_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ssn_UNIQUE` (`matricNumber`),
  KEY `Voters_department` (`department_id`),
  KEY `Voters_University` (`University_id`),
  KEY `Voters_Faculty` (`Faculty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='maintains the voters data' AUTO_INCREMENT=429 ;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`id`, `matricNumber`, `firstname`, `lastname`, `othernames`, `password`, `isvoted`, `last_modified_on`, `created_on`, `department_id`, `University_id`, `Faculty_id`) VALUES
(1, '12/52HA001', 'ABIOLA, Ridwan Folarin', '', '', '05sp', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(2, '12/52HA002', 'ABOBARIN, Adebayo Samson', '', '', 'kif0', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(3, '12/52HA003', 'ABRAHAM, Tomisin Pelumi', '', '', 'cug3', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(4, '12/52HA004', 'ADEBAYO, Abolaji ', '', '', 'qb1d', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(5, '12/52HA005', 'ADEBAYO, Tunde Kamil', '', '', 'raql', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(6, '12/52HA006', 'ADEBIMPE, Dorcas Tolulope', '', '', 'v93p', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(7, '12/52HA007', 'ADEBISI, Samuel Segun', '', '', 'lej2', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(8, '12/52HA008', 'ADEGUN, Ayodeji David', '', '', 'pnmb', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(9, '12/52HA009', 'ADELEYE, David Adewunmi', '', '', 'eyce', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(10, '12/52HA010', 'ADEMARATI, Oluwatoyin Atinuke', '', '', 'y9w9', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(11, '12/52HA011', 'ADEMOLA, Agbolahan Adam', '', '', 'z57r', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(12, '12/52HA012', 'ADESANYA, Abayomi Ayomide', '', '', 'tt1h', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(13, '12/52HA013', 'ADESIBIKAN, Ademola Oluseyi', '', '', 'u5nm', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(14, '12/52HA014', 'AIYEDONA, Oluwafemi Tanimola', '', '', '0svj', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(15, '12/52HA015', 'AJAYI, Ayodeji Elijah', '', '', 'i82z', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(16, '12/52HA016', 'AJIBOLA, Qudus Oluwadamilola', '', '', 's0px', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(17, '12/52HA017', 'AKINBODE, Segun Emmanuel', '', '', '8mm1', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(18, '12/52HA018', 'ALIU, Abdul Mujeeb', '', '', 'gsb8', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(19, '12/52HA019', 'AMATARE, Sunday Ayebiowei', '', '', 'hg5j', 0, '2013-05-29 16:48:03', '2013-05-29 16:48:03', 1, 1, 1),
(20, '12/52HA020', 'AMOO, Nafisat Abiodun', '', '', '5qyh', 0, '2013-05-29 16:48:04', '2013-05-29 16:48:04', 1, 1, 1),
(21, '12/52HA021', 'AMUDA, Nafisat Adejoke', '', '', '98fe', 0, '2013-05-29 16:48:04', '2013-05-29 16:48:04', 1, 1, 1),
(22, '12/52HA022', 'ATEKO, Adekunle Goodness', '', '', 'fujt', 0, '2013-05-29 16:48:04', '2013-05-29 16:48:04', 1, 1, 1),
(23, '12/52HA023', 'AWOTUNDE, Abiodun Adewale', '', '', 'hj3k', 0, '2013-05-29 16:48:04', '2013-05-29 16:48:04', 1, 1, 1),
(24, '12/52HA024', 'BABAJIDE, Kayode Samuel', '', '', 'ct4u', 0, '2013-05-29 16:48:04', '2013-05-29 16:48:04', 1, 1, 1),
(25, '12/52HA025', 'BALOGUN, Sodiq Olatunji', '', '', 'teqz', 0, '2013-05-29 16:48:04', '2013-05-29 16:48:04', 1, 1, 1),
(26, '12/52HA026', 'BANKOLE, Susan Temitope', '', '', 'zzf8', 0, '2013-05-29 16:48:04', '2013-05-29 16:48:04', 1, 1, 1),
(27, '12/52HA027', 'EREGBUO, Viola Chidinma', '', '', 'al05', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(28, '12/52HA028', 'EZEUGWU, Paschal Nnachetam', '', '', 'd3uk', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(29, '12/52HA029', 'GANIYU, Simbiat Omobola', '', '', 'awlk', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(30, '12/52HA030', 'IBRAHIM, Abdulrasaq Kayode', '', '', '8y9c', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(31, '12/52HA031', 'ISAGI, Godfrey Isagi', '', '', 'hly0', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(32, '12/52HA032', 'ITOGBE, Adeoye Jeremiah', '', '', 'wc1c', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(33, '12/52HA033', 'ITUA, Favour Osalumhense', '', '', 'upue', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(34, '12/52HA034', 'JIMOH, Sodiq Olawale', '', '', 'rm4g', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(35, '12/52HA035', 'KADRI, Oluwayomi Segun', '', '', 'nego', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(36, '12/52HA036', 'KAREEM, Doyinsola Amoke', '', '', 'a4vf', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(37, '12/52HA037', 'KOMOLAFE, Oluwayonusimi Jehovah-shalom', '', '', 'gmfb', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(38, '12/52HA038', 'LERAMO, Oluwatoyosi Abosede', '', '', 'fpsc', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(39, '12/52HA039', 'MURAINA, Shakiru Adebare', '', '', '7t27', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(40, '12/52HA040', 'ODESANMI, Victor Oluwaseun', '', '', 'lnvq', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(41, '12/52HA041', 'ODUBAJO, Idris Adetokunbo', '', '', 'sagd', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(42, '12/52HA042', 'ODULOYE, Kayode Adeniyi', '', '', '869k', 0, '2013-05-29 16:48:05', '2013-05-29 16:48:05', 1, 1, 1),
(43, '12/52HA043', 'OGUNDIRAN, Opeyemi Aramide', '', '', 'xetd', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(44, '12/52HA044', 'OLADUNNI, Opeyemi Isaac', '', '', 'ci6e', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(45, '12/52HA045', 'OLAGBOYE, Abimbola Elijah', '', '', 'h2rt', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(46, '12/52HA046', 'OLAJIDE, Emmanuel Seun', '', '', 'u1qp', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(47, '12/52HA047', 'OLAOYE, Toheeb Babatunde', '', '', 'mmi8', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(48, '12/52HA048', 'OLARINOYE, Ridwan Damilare', '', '', 'zdfp', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(49, '12/52HA049', 'OLORUNOJE, Taofeek Ayotunde', '', '', 'e7id', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(50, '12/52HA050', 'OLORUNSHOLA, Godwin Opeyemi', '', '', 'kub2', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(51, '12/52HA051', 'OMONIWA, Shina Ayobami', '', '', 'mjfy', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(52, '12/52HA052', 'OTUNLA, Adeyemo Afolabi', '', '', '6jaj', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(53, '12/52HA053', 'OTUWE, Patience Queen', '', '', 'oaie', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(54, '12/52HA054', 'OYEFOLU, Solomon Oluwatobi', '', '', 'gwqa', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(55, '12/52HA055', 'OYELADE, Oluwapelumi Kikelomo', '', '', 'j3s8', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(56, '12/52HA056', 'QUADRI, Nureni Ayodeji', '', '', 'xcak', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(57, '12/52HA057', 'RAHEEM, Ahmed ', '', '', 'wh3r', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(58, '12/52HA058', 'SALISU, Mubarak Kolawole', '', '', 'vezw', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(59, '12/52HA059', 'SODIQ, Qudus Folorunsho', '', '', 'zobs', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(60, '12/52HA060', 'UDOKA, Prince ', '', '', '510a', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(61, '12/52HA061', 'UKAEGBU, Emeka Bright', '', '', '4qf1', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(62, '12/52HA067', 'EDOIMIOYA,, Osareti Felix', '', '', 'i57p', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(63, '11/52HA050', 'JIMOH, Ayodeji Julius', '', '', 'fltu', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(64, '12/52HA062', 'ABIKOYE, Matthew Oluwasesan', '', '', 'xq9n', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(65, '12/52HA063', 'ABOLARIN, Adeola Muyiwa', '', '', '2pbx', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(66, '12/52HA064', 'ALAKE, Oluwatobi Peter', '', '', 'n2q4', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(67, '12/52HA065', 'BECHI, Philip ', '', '', 'wq0l', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(68, '12/52HA066', 'CHUKWU, Ikechukwu Michael', '', '', '6ejq', 1, '2013-05-31 12:13:09', '2013-05-29 16:48:06', 1, 1, 1),
(69, '12/52HA068', 'EKWOTE, Luke Adanu', '', '', 'uahz', 0, '2013-05-29 16:48:06', '2013-05-29 16:48:06', 1, 1, 1),
(70, '12/52HA069', 'IBRAHIM, Ahmed Oladapo', '', '', 'd599', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(71, '12/52HA070', 'KAWU, Riliwan Olasunkanmi', '', '', 'kgiq', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(72, '12/52HA071', 'OLADIPUPO, Kehinde Rasaq', '', '', 'o4e5', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(73, '12/52HA072', 'OLADOTUN, Abdulsalam Adeola', '', '', 'wcgh', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(74, '12/52HA073', 'OLAYIWOLA, Abiodun Waheed', '', '', '0n0b', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(75, '12/52HA074', 'OPARA, Stella Onyinyechi', '', '', 'eyxl', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(76, '12/52HA075', 'POPOOLA, Funmilayo Omowumi', '', '', '17rr', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(77, '12/52HA076', 'UMOLE, Sylvester Oshiogwemoh', '', '', 'i7xu', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(78, '11/52HA004', 'ABIJOGUN, Osigbodi Charles', '', '', 'nupd', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(79, '11/52HA012', 'AFOLABI, Omowumi Rofiat', '', '', '5182', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(80, '11/52HA013', 'AHMED, Semiha Moji', '', '', 'xxsl', 1, '2013-05-31 10:52:24', '2013-05-29 16:48:07', 1, 1, 1),
(81, '11/52HA033', 'BADERIN, Faramade Josephine', '', '', 'l6xd', 1, '2013-05-31 11:58:26', '2013-05-29 16:48:07', 1, 1, 1),
(82, '11/52HA040', 'DERE, Gbenga Ameen', '', '', 'ybjj', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(83, '11/52HA056', 'LAWAL, OMOTAYO Motolani', '', '', 'rcjc', 1, '2013-05-31 11:59:28', '2013-05-29 16:48:07', 1, 1, 1),
(84, '11/52HA093', 'SULEIMAN, Adija ', '', '', '3p5i', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(85, '09/52HA138', 'PATRICK, Deborah Imoleayo', '', '', 'dbdw', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(86, '11/52HA001', 'ABATI, Ibrahim Adewale', '', '', '49di', 1, '2013-05-31 10:41:44', '2013-05-29 16:48:07', 1, 1, 1),
(87, '11/52HA003', 'ABDULRAHEEM, Abdulrasheed O', '', '', 'nmeq', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(88, '11/52HA005', 'ADEBAYO, Asmau Aderonke', '', '', '3amb', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(89, '11/52HA006', 'ADEDOYIN, Ogo-Oluwa E', '', '', 'zitw', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(90, '10/55EI015', 'ADEGOKE, Adetoun Sofiat', '', '', 'k4jm', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(91, '11/52HA007', 'ADEMARATI, Tunde Sulaimon', '', '', 't5lb', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(92, '11/52HA008', 'ADESHINA, Ibrahim Adebowale', '', '', 'p8ne', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(93, '11/52HA011', 'ADEYEMO, Victor Elijah', '', '', '09ce', 1, '2013-05-31 10:39:42', '2013-05-29 16:48:07', 1, 1, 1),
(94, '11/52HA014', 'AJADI, Olamide Shefinatu', '', '', 'ooqh', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(95, '11/52HA015', 'AKANDE, Ayodeji Akeem', '', '', 's782', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(96, '11/52HA016', 'AKANDE, Bashirat Abimbola', '', '', 'jd2q', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(97, '11/52HA017', 'AKANDE, Habib Adedamola', '', '', '59wq', 1, '2013-05-31 10:17:51', '2013-05-29 16:48:07', 1, 1, 1),
(98, '11/52HA018', 'AKINDELE, Emmanuel Igbekele', '', '', '41ed', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(99, '11/52HA019', 'AKINWANDE, Victor Abayomi', '', '', 'tbbe', 1, '2013-05-31 12:07:38', '2013-05-29 16:48:07', 1, 1, 1),
(100, '11/52HA020', 'ALABA, Mustapha Olalekan', '', '', 'kdgr', 0, '2013-05-29 16:48:07', '2013-05-29 16:48:07', 1, 1, 1),
(101, '11/52HA021', 'ALAO, Daniel Olamide', '', '', 'znah', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(102, '11/52HA022', 'AMAECHINA, Charles Tochukwu', '', '', '251m', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(103, '11/52HA023', 'ARE, Adegoke Azeez', '', '', 'okab', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(104, '11/52HA024', 'AREO, Samuel Shola', '', '', '1mtn', 1, '2013-05-31 12:12:27', '2013-05-29 16:48:08', 1, 1, 1),
(105, '11/52HA025', 'ARINZE, Salvation Arinze', '', '', 'qenz', 1, '2013-05-31 12:06:46', '2013-05-29 16:48:08', 1, 1, 1),
(106, '11/52HA026', 'ASAJU, Olawale Abdulquadri', '', '', 'gu6w', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(107, '11/52HA027', 'ATEMA, Samuel Terdoo', '', '', 'de3c', 1, '2013-05-31 12:48:35', '2013-05-29 16:48:08', 1, 1, 1),
(108, '11/52HA028', 'AYILARA, Opeyemi Olaitan', '', '', 'nhb8', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(109, '11/52HA030', 'AYINLA, Yusuf Remilekun', '', '', 'wyq1', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(110, '11/52HA032', 'BABALOLA, Muhammad ', '', '', 'nda5', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(111, '11/52HA034', 'BAKARE, Moruf Hakinbola', '', '', 'qyeb', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(112, '11/52HA035', 'BALOGUN, Adekunle R', '', '', 'khp2', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(113, '11/52HA036', 'BAZARIA, Deborah Abubakar', '', '', 'x67y', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(114, '11/52HA037', 'BELLO, Adejumoke Adetola', '', '', '138g', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(115, '11/52HA038', 'DARAMOLA, Hammed Olasunkanmi', '', '', '5wfw', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(116, '11/52HA039', 'DAVID, Gabriel Olusegun', '', '', 'm1mx', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(117, '11/52HA041', 'DOUGHBO, Atesipaomie ', '', '', 'o3dp', 1, '2013-05-31 13:28:04', '2013-05-29 16:48:08', 1, 1, 1),
(118, '11/52HA043', 'EZEKWEM, Chukwuemeka Nwachukwu', '', '', 'i9gz', 1, '2013-05-31 13:26:37', '2013-05-29 16:48:08', 1, 1, 1),
(119, '11/52HA049', 'ISHAQ, Mojeed Siyanbola', '', '', 'uol4', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(120, '11/52HA051', 'KADIRI, Kazeem Abolaji', '', '', 'mldq', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(121, '11/52HA052', 'KILO, Olasubomi Comfort', '', '', 'hlrg', 1, '2013-05-31 11:58:22', '2013-05-29 16:48:08', 1, 1, 1),
(122, '11/52HA053', 'KOLAWOLE, Temitope Joshua', '', '', '1sad', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(123, '11/52HA054', 'KOLAWOLE, Toheeb Olalekan', '', '', 'caoo', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(124, '11/52HA055', 'LATEEF, Yusuf Olayinka', '', '', 'durh', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(125, '11/52HA057', 'MOHAMMED, Fatima Binta', '', '', 'kcl6', 1, '2013-05-31 12:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(126, '11/52HA058', 'MOMOH, Silm Omeiza', '', '', 'znou', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(127, '11/52HA059', 'MUSTAPHA, Moshood Olabode', '', '', 'q0wy', 1, '2013-05-31 11:28:38', '2013-05-29 16:48:08', 1, 1, 1),
(128, '11/52HA061', 'NKWOCHA, Victor Chukwuyerem', '', '', 'gvbb', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(129, '11/52HA062', 'NWOKOLO, Ndidiamaka Patience', '', '', 'krm8', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(130, '11/52HA063', 'OBADARE, Akinwumi Isaac', '', '', 's91f', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(131, '11/52HA064', 'OBIANO, Francis Nkem', '', '', 'oapx', 1, '2013-05-31 12:04:12', '2013-05-29 16:48:08', 1, 1, 1),
(132, '11/52HA065', 'ODEREMI, Christiana Oluwatoyin', '', '', 'j4qg', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(133, '11/52HA067', 'ODUSANYA, Aanuoluwapo Rebecca', '', '', 'dulw', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(134, '11/52HA068', 'OGBOMON, Godwin Aimuanmwosa', '', '', 'orh5', 0, '2013-05-29 16:48:08', '2013-05-29 16:48:08', 1, 1, 1),
(135, '11/52HA071', 'OGUNSAKIN, Isaac Adewale', '', '', 'dz6f', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(136, '11/52HA074', 'OLAOLUWA, Aduragbemi Oluwatobi', '', '', 'avkf', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(137, '11/52HA075', 'OLOKE, Emmanuel Oluwagbemiro', '', '', 'bcpb', 1, '2013-05-31 10:38:56', '2013-05-29 16:48:09', 1, 1, 1),
(138, '11/52HA076', 'OLORITUN, Babawale Abdulgarfar', '', '', '5f6e', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(139, '11/52HA077', 'OLOWE, Victor ', '', '', 'artc', 1, '2013-05-31 12:12:10', '2013-05-29 16:48:09', 1, 1, 1),
(140, '11/52HA078', 'OLUGBEMI, Oluwaseun Ayokanmi', '', '', 's2r2', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(141, '11/52HA079', 'OMEIZA, Daniel Amoto', '', '', 'ljlf', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(142, '11/52HA081', 'OSENI, Usman Olanrewaju', '', '', 'xu6e', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(143, '11/52HA082', 'OSO, Mueez Adebayo', '', '', '7rzq', 1, '2013-05-31 14:38:06', '2013-05-29 16:48:09', 1, 1, 1),
(144, '11/52HA083', 'OTOKITI, Temitope Olaoluwa', '', '', '3b2x', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(145, '11/52HA084', 'OWHERE, Oghenekome Gift', '', '', 'rpyi', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(146, '11/52HA085', 'OWOJAIYE, Babafemi Omotola', '', '', 'og1c', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(147, '11/52HA086', 'OZIOKO, Paul Chikadibia', '', '', '4shf', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(148, '11/52HA087', 'RAIMI, Oluwatosin Joseph', '', '', '81tj', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(149, '11/52HA088', 'SALAMI, Adekunle Sunday', '', '', '1445', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(150, '11/52HA089', 'SALAWU, Opeyemi Idris', '', '', 'gg7v', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(151, '11/52HA091', 'SANNI, Zainab Oyindamola', '', '', 'a4ck', 1, '2013-05-31 11:42:54', '2013-05-29 16:48:09', 1, 1, 1),
(152, '11/52HA092', 'SANUSI, Aminat Kehinde', '', '', 'uw6z', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(153, '11/52HA094', 'TEJUMOLA, Pelumi Ademola', '', '', 'hz3w', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(154, '11/52HA095', 'UKADIKE, Tochukwu Fortune', '', '', 'm9xx', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(155, '11/52HA097', 'WINTOLA, Ayooluwapo Samuel', '', '', 'ne8f', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(156, '10/52HA022', 'ADIMULA, Adebayo Damilola', '', '', 'n7z7', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(157, '11/52HA098', 'AGBE, Christiana Mwuese', '', '', '7vlg', 1, '2013-05-31 11:42:40', '2013-05-29 16:48:09', 1, 1, 1),
(158, '11/52HA099', 'AYANSOLA, Damilare Joshua', '', '', '0tnd', 1, '2013-05-31 11:38:19', '2013-05-29 16:48:09', 1, 1, 1),
(159, '11/52HA100', 'EFUNTOYE, Bisola Ajoke', '', '', 'toep', 1, '2013-05-31 10:30:05', '2013-05-29 16:48:09', 1, 1, 1),
(160, '11/52HA101', 'MAMUDU, Fatimah Aloaye', '', '', 'yjrh', 1, '2013-05-31 14:32:52', '2013-05-29 16:48:09', 1, 1, 1),
(161, '10/52HA109', 'MOROUNRANTI, Adeola Sulaiman', '', '', 'y8yj', 0, '2013-05-29 16:48:09', '2013-05-29 16:48:09', 1, 1, 1),
(162, '11/52HA102', 'OLALERE, Abayomi Olaniyi', '', '', 'pnpv', 1, '2013-05-31 11:09:41', '2013-05-29 16:48:09', 1, 1, 1),
(163, '11/52HA103', 'OYEYIPO, Olumide Taiye', '', '', '8vwt', 1, '2013-05-31 10:30:34', '2013-05-29 16:48:09', 1, 1, 1),
(164, '11/52HA104', 'WAHAB, Olayinka Abraham', '', '', 'gox5', 1, '2013-05-31 11:48:21', '2013-05-29 16:48:09', 1, 1, 1),
(165, '10/52HA003', 'ABDULWAHAB, Mohammed Mubarak', '', '', '3m8o', 1, '2013-05-31 10:27:06', '2013-05-29 16:48:09', 1, 1, 1),
(166, '10/52HA007', 'ADE-LAWAL, Temitope Olufunke', '', '', '0vtf', 1, '2013-05-31 12:25:37', '2013-05-29 16:48:09', 1, 1, 1),
(167, '10/52HA014', 'ADEKUNBI, Abiola Adeife', '', '', '247q', 1, '2013-05-31 10:19:58', '2013-05-29 16:48:10', 1, 1, 1),
(168, '10/52HA016', 'ADELEKE, Adetooke Josephine', '', '', 'jxe8', 1, '2013-05-31 11:40:54', '2013-05-29 16:48:10', 1, 1, 1),
(169, '10/52HA021', 'ADEYEMO, Hope Ayoade', '', '', '566k', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(170, '10/52HA024', 'AKINBIODUN, Adekeye Damilare', '', '', 'zfzn', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(171, '10/52HA026', 'ALABI, Temitope Juliet', '', '', 'vm5d', 1, '2013-05-31 12:02:34', '2013-05-29 16:48:10', 1, 1, 1),
(172, '10/52HA032', 'ANYANWU, Danulta Chiamaka', '', '', 'fixx', 1, '2013-05-31 11:48:25', '2013-05-29 16:48:10', 1, 1, 1),
(173, '10/52HA039', 'AZEEZ, Hammed Ade', '', '', 'e6p6', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(174, '10/52HA043', 'BAKARE, Ridwan Adekunle', '', '', '2t4n', 1, '2013-05-31 10:33:06', '2013-05-29 16:48:10', 1, 1, 1),
(175, '10/52HA044', 'BALOGUN, Oluwagbenga James', '', '', 'taoq', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(176, '10/52HA047', 'BOROKINI, Tobiloba Stephen', '', '', 's3gz', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(177, '10/52HA050', 'EKERUVWE, Omonigho Edward', '', '', 'jraq', 1, '2013-05-31 10:14:20', '2013-05-29 16:48:10', 1, 1, 1),
(178, '10/52HA063', 'ILORI, Oluwadamilare Adebayo', '', '', 'oqle', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(179, '10/52HA071', 'ODEPIDAN, Oyindunmola Temitope', '', '', 'y8ci', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(180, '10/52HA074', 'OGBUAGU, Nkechinyere Chinasa', '', '', '4l6i', 1, '2013-05-31 11:46:54', '2013-05-29 16:48:10', 1, 1, 1),
(181, '10/52HA076', 'OKE, Maryam Adesola', '', '', 'r522', 1, '2013-05-31 12:53:51', '2013-05-29 16:48:10', 1, 1, 1),
(182, '10/52HA085', 'OSUJI, Chidera Wilson', '', '', 'd9n8', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(183, '10/52HA089', 'RUFAI, Titilayo Adebukola', '', '', 'txqa', 1, '2013-05-31 10:25:52', '2013-05-29 16:48:10', 1, 1, 1),
(184, '10/52HA096', 'TAIWO, Olanrewaju Sikiru', '', '', 'fffb', 1, '2013-05-31 10:56:58', '2013-05-29 16:48:10', 1, 1, 1),
(185, '09/52HA004', 'ADAM, Mansurah Lolade', '', '', 't9z1', 1, '2013-05-31 12:37:21', '2013-05-29 16:48:10', 1, 1, 1),
(186, '09/52HA029', 'AKPAN, Victor Emmanuel', '', '', '94sc', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(187, '09/52HA091', 'MOHAMMED, Dauda Kayode', '', '', 'czhi', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(188, '09/52HA094', 'MURAINA, Opeyemi Ramat', '', '', '7pji', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(189, '10/52HA002', 'ABDULKAREEM, Sulyman Age', '', '', 'adhu', 1, '2013-05-31 11:26:33', '2013-05-29 16:48:10', 1, 1, 1),
(190, '10/52HA005', 'ABIKOYE, Stephen Morakinyo', '', '', 'l6e6', 1, '2013-05-31 10:35:37', '2013-05-29 16:48:10', 1, 1, 1),
(191, '10/52HA008', 'ADEBAYO, Michael Omolayole', '', '', '9n6t', 1, '2013-05-31 10:58:15', '2013-05-29 16:48:10', 1, 1, 1),
(192, '08/30GB006', 'ADEDIGBA, Ibraheem Adekunle', '', '', '0xdf', 1, '2013-05-31 10:55:40', '2013-05-29 16:48:10', 1, 1, 1),
(193, '10/52HA009', 'ADEDIJI, Ademola Oluyemi', '', '', 'osjr', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(194, '10/52HA010', 'ADEFAMOYE, Moruf Adebowale', '', '', 'em0a', 1, '2013-05-31 10:35:16', '2013-05-29 16:48:10', 1, 1, 1),
(195, '10/52HA011', 'ADEGBOYE, Kayode ', '', '', 'm5af', 1, '2013-05-31 14:28:30', '2013-05-29 16:48:10', 1, 1, 1),
(196, '10/52HA018', 'ADESIJI, Boluwatife Aderinsola', '', '', 'l0j9', 1, '2013-05-31 12:01:57', '2013-05-29 16:48:10', 1, 1, 1),
(197, '10/52HA019', 'ADEWUYI, Simbiat Adebola', '', '', 'fitg', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(198, '10/52HA020', 'ADEYEMI, Rafiat Jumoke', '', '', '3t94', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(199, '10/52HA023', 'AFOLABI, Ganiyat Kemi', '', '', 'cwo3', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(200, '10/52HA025', 'AKINSUSI, Hannah Omowunmi', '', '', 'dhre', 1, '2013-05-31 10:22:07', '2013-05-29 16:48:10', 1, 1, 1),
(201, '10/52HA027', 'ALAGBO, Olumide Emmanuel', '', '', 'yo3g', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(202, '10/52HA031', 'AMOSA, Muhammed Jamiu', '', '', 'hcat', 0, '2013-05-29 16:48:10', '2013-05-29 16:48:10', 1, 1, 1),
(203, '10/52HA033', 'ARE, Jorg ', '', '', '5zqt', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(204, '10/52HA034', 'ATANDA, Azeez Adedeji', '', '', '7jta', 1, '2013-05-31 10:17:20', '2013-05-29 16:48:11', 1, 1, 1),
(205, '10/52HA035', 'ATOBATELE, Naheem Opeyemi', '', '', 'zgvi', 1, '2013-05-31 14:35:00', '2013-05-29 16:48:11', 1, 1, 1),
(206, '10/52HA036', 'ATOYEBI, Ritamary Adenike', '', '', 'q7wj', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(207, '10/52HA038', 'AYANTOLA, Akeem Lekan', '', '', '9j0p', 1, '2013-05-31 11:10:35', '2013-05-29 16:48:11', 1, 1, 1),
(208, '10/52HA040', 'AZIKE, Osita ', '', '', 'pmvk', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(209, '10/52HA041', 'BABARINDE, Jubril Babatunde', '', '', '5vdc', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(210, '10/52HA045', 'BELLO, Aminat Ajoke', '', '', '6ity', 1, '2013-05-31 12:51:37', '2013-05-29 16:48:11', 1, 1, 1),
(211, '10/52HA046', 'BELLO, Sodiq Olabisi', '', '', '8awz', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(212, '10/52HA051', 'FALOLA, Kehinde Omotayo', '', '', 't87g', 1, '2013-05-31 10:22:39', '2013-05-29 16:48:11', 1, 1, 1),
(213, '10/52HA054', 'FATOSA, Damilola Olawale', '', '', '8740', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(214, '10/52HA055', 'FAYEMI, Ifedayo Oyindamola', '', '', '57s9', 1, '2013-05-31 12:54:45', '2013-05-29 16:48:11', 1, 1, 1),
(215, '10/52HA056', 'GIDADO, Abdulrauf Aremu', '', '', 'va2s', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(216, '10/52HA057', 'HAMMED, Adedamola Sodiq', '', '', 'ocn5', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(217, '10/52HA058', 'IBRAHIM, Muhammed Aduvoh', '', '', 'd9dc', 1, '2013-05-31 10:21:49', '2013-05-29 16:48:11', 1, 1, 1),
(218, '10/52HA059', 'IBRAHIM, Omobolaji Lateef', '', '', 'ayyd', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(219, '10/52HA060', 'IDOWU, Ayodeji Oluseyi', '', '', 'm4mj', 1, '2013-05-31 10:19:42', '2013-05-29 16:48:11', 1, 1, 1),
(220, '10/52HA061', 'IDRIS, Kazeem Abiodun', '', '', 'gaj1', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(221, '10/52HA062', 'IJIDAKINRO, Akinlabi Adebayo', '', '', '41t8', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(222, '10/52HA064', 'JIBRIL, Hajarah Afor', '', '', 'v7nl', 1, '2013-05-31 10:28:57', '2013-05-29 16:48:11', 1, 1, 1),
(223, '10/52HA065', 'JIMOH, Abiola Jamiu', '', '', '2tjn', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(224, '10/52HA066', 'JIMOH, Fatai Olanrewaju', '', '', 'x7au', 1, '2013-05-31 10:28:37', '2013-05-29 16:48:11', 1, 1, 1),
(225, '10/52HA067', 'KOLAWOLE, Abiodun Michael', '', '', 'okl6', 1, '2013-05-31 13:43:46', '2013-05-29 16:48:11', 1, 1, 1),
(226, '10/52HA068', 'MAKAFAN, Peter Oseanemo', '', '', '87xl', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(227, '10/52HA069', 'MALOMO, Akinola Oludare', '', '', '3z9j', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(228, '10/52HA070', 'OBASEKI, Nosa ', '', '', 'mohv', 1, '2013-05-31 12:27:21', '2013-05-29 16:48:11', 1, 1, 1),
(229, '10/52HA073', 'ODUNTAN, Oluwatobiloba Stephen', '', '', 'r2uz', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(230, '10/52HA075', 'OGUNTOLA, Yusuf Damilola', '', '', 'p0ty', 1, '2013-05-31 14:33:40', '2013-05-29 16:48:11', 1, 1, 1),
(231, '10/52HA077', 'OKE, Oluranti John', '', '', 'bmet', 1, '2013-05-31 10:31:09', '2013-05-29 16:48:11', 1, 1, 1),
(232, '10/52HA079', 'OLATUNDE, Yusuf Owolabi', '', '', 'xmh4', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(233, '10/52HA083', 'OMIDIWURA, Rashidat Olajumoke', '', '', 'v36h', 1, '2013-05-31 12:01:44', '2013-05-29 16:48:11', 1, 1, 1),
(234, '08/30GD073', 'OMOKANJU, Toyese Adelabu', '', '', 'x1zo', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(235, '10/52HA086', 'OYELAMI, Akeem Oyewale', '', '', 'ph9d', 0, '2013-05-29 16:48:11', '2013-05-29 16:48:11', 1, 1, 1),
(236, '10/52HA087', 'OYEWUSI, Fatimah Adeola', '', '', '7jl1', 1, '2013-05-31 10:31:30', '2013-05-29 16:48:11', 1, 1, 1),
(237, '08/30GD082', 'OYEYELE, Oyeyipo Paul', '', '', '4v5c', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(238, '10/52HA090', 'SALAHDEEN, Nasiru Kehinde', '', '', 'yhl7', 1, '2013-05-31 10:18:09', '2013-05-29 16:48:12', 1, 1, 1),
(239, '10/52HA091', 'SALAMI, Olawale Afeez', '', '', 'j16s', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(240, '10/52HA092', 'SALAWU, Azeez Olanrewaju', '', '', 'w5ms', 1, '2013-05-31 12:29:33', '2013-05-29 16:48:12', 1, 1, 1),
(241, '10/52HA094', 'SANNI, Ramota Tunrayo', '', '', 'r3s5', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(242, '10/52HA095', 'SANUSI, Samuel Shola', '', '', 'clh3', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(243, '08/30GB083', 'SANYAOLU, Samuel Setemi', '', '', '6mc9', 1, '2013-05-31 14:36:05', '2013-05-29 16:48:12', 1, 1, 1),
(244, '10/52HA097', 'TAIWO, Oluwatoyin Omolayo', '', '', 's6he', 1, '2013-05-31 10:46:08', '2013-05-29 16:48:12', 1, 1, 1),
(245, '10/52HA099', 'UTOJUBA, Emeka ', '', '', 'v8nl', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(246, '10/52HA100', 'UWUKHOR, Paul Omo', '', '', 'q4nw', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(247, '10/52HA101', 'YAKUBU, Kabir Omodolapo', '', '', 'la0o', 1, '2013-05-31 10:23:32', '2013-05-29 16:48:12', 1, 1, 1),
(248, '10/52HA102', 'YUSUF, Mubarak Opeyemi', '', '', 'ov3k', 1, '2013-05-31 10:31:57', '2013-05-29 16:48:12', 1, 1, 1),
(249, '10/52HA103', 'ADEJARE, Iyabo Bidemi', '', '', '2xnn', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(250, '10/52HA104', 'ADENIJI, Cecilia Oluwadoyinsola', '', '', 't1ye', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(251, '10/52HA105', 'ADEOYE, Abass Ojo', '', '', 'trmk', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(252, '10/52HA106', 'ADEPOJU, Hafeez Oluwajuwon', '', '', '0701', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(253, '10/52HA107', 'ALANAMU, Zubair Olayemi', '', '', '0kax', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(254, '10/52HA108', 'JOSEPH, Oloruntobi Ayobami', '', '', '79pi', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(255, '10/52HA110', 'OLAOSEBIKAN, Oluwaseun Jacob', '', '', '96rf', 1, '2013-05-31 11:07:05', '2013-05-29 16:48:12', 1, 1, 1),
(256, '10/52HA111', 'OLARINDE, Mobolaji Olusola', '', '', 'n4tb', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(257, '10/52HA112', 'OLORUNTOBA, Ibironke Tayo', '', '', 'ozjx', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(258, '10/52HA113', 'OSENI, Akeem Adewale', '', '', '29nk', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(259, '10/52HA114', 'OYEDEPO, Afolabi David', '', '', 'krxy', 1, '2013-05-31 10:43:50', '2013-05-29 16:48:12', 1, 1, 1),
(260, '10/52HA115', 'RAHEEM, Kazeem Olawale', '', '', 'fo93', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(261, '09/52HA002', 'ABDULSALAM, Kolawole Muhammed', '', '', 'w2z1', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(262, '09/52HA007', 'ADEGBOYE, Opeyemi Oyedeji', '', '', 'ptsz', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(263, '09/52HA008', 'ADELEKE, Abdullahi Oyekunle', '', '', '81yb', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(264, '09/52HA013', 'ADEWOLE, Victor Tosin', '', '', '9ade', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(265, '09/52HA016', 'ADEYI, Ganiyat Abimbola', '', '', 't1j7', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(266, '09/52HA022', 'AJALA, Oluwadamilola Sunday', '', '', 'gdrd', 1, '2013-05-31 11:04:09', '2013-05-29 16:48:12', 1, 1, 1),
(267, '09/52HA023', 'AJAYI, Dorcas Oyiza', '', '', 'b5dq', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(268, '09/52HA025', 'AKANO, Ibrahim Adekunle', '', '', '992l', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(269, '09/52HA030', 'ALLI, Taiwo Funmilayo', '', '', '6xgi', 0, '2013-05-29 16:48:12', '2013-05-29 16:48:12', 1, 1, 1),
(270, '09/52HA032', 'AMODU, Shadiat Adekunbi', '', '', 'hl6v', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(271, '09/52HA034', 'AROWOLO, Afeez Olalekan', '', '', 'd19y', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(272, '09/52HA035', 'ASHIRU, Abdul-Ganiyu Adisa', '', '', '6t3p', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(273, '09/52HA038', 'ATTE, Oluwafunke Abigael', '', '', 'vnid', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(274, '09/52HA043', 'BABATUNDE, Bashirat Kikelomo', '', '', 'jfhi', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(275, '09/52HA047', 'BAMIDELE, Oluwabusayo Adedayo', '', '', 'oq82', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(276, '09/52HA049', 'BAMIKOLE, Opeyemi Temitope', '', '', '2ebn', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(277, '09/52HA058', 'DURODOLA, Segun Moses', '', '', 'x98b', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(278, '09/52HA063', 'FAGBEMIRO, Muyiwa Olatunde', '', '', 'od1m', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(279, '09/52HA074', 'IGE, Joshua Oluwaseun', '', '', '1nmp', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(280, '09/52HA075', 'ILEBIYI, Olajide Ayodele', '', '', 'gsva', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(281, '09/52HA076', 'ILORI, Josephine Oluwatoyin', '', '', 'h520', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(282, '09/52HA084', 'KILA, Samuel Sunday', '', '', '7yg3', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(283, '09/52HA092', 'MOHAMMED, Halimah ', '', '', 'i3jb', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(284, '09/52HA093', 'MOJEED, Hammed Adeleye', '', '', 'zzyt', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(285, '09/52HA095', 'MUSA, Badamasi Abubakar', '', '', 'gqb7', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(286, '09/52HA096', 'NAYYAR, Maria Noor', '', '', '9uux', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(287, '09/52HA097', 'NELSON, Oluomachi Gladys', '', '', '9spk', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(288, '09/52HA098', 'NOSIRU, Opeyemi Oluwaseyi', '', '', '4i5r', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(289, '09/52HA103', 'ODUNAIYA, Abdulhakim Akanni', '', '', '5rsh', 0, '2013-05-29 16:48:13', '2013-05-29 16:48:13', 1, 1, 1),
(290, '09/52HA105', 'OGUNSESAN, Kudirat Doyin', '', '', 'j5c0', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(291, '09/52HA106', 'OJE, Adepeju Deborah', '', '', 'q553', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(292, '09/52HA116', 'OLANIYI, Yemisi Oyelola', '', '', 'u2cq', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(293, '09/52HA117', 'OLAWUYI, Imoleayo Comfort', '', '', 'n3yq', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(294, '09/52HA118', 'OLOGUNDUDU, Oluwaseun Olalekan', '', '', 'hd76', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(295, '09/52HA119', 'OLOWOLAFE, Modupe Olakitan', '', '', 'm3qm', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(296, '09/52HA126', 'ONOMERIHRI, Tejiri Oride', '', '', 'qoul', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(297, '09/52HA132', 'OWODUNNI, Tunde Abdul-Rahim', '', '', 'ejgh', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(298, '09/52HA136', 'OYETUNDE, Oyekunle Aderemi', '', '', 'kdc9', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(299, '09/52HA137', 'OYEWOLE, Olamide Aishat', '', '', 'nakh', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(300, '09/52HA139', 'POPOOLA, Adekunle Abayomi', '', '', 'so82', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(301, '09/52HA143', 'SALAMI, Dolapo Ramota', '', '', 'nops', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(302, '09/52HA145', 'SOLOMON, Oluwatobi Daniel', '', '', 'gz7u', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(303, '09/52HA154', 'YUSUF, Olaiya Kazeem', '', '', 'y0fn', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(304, '07/55EC006', 'ABDULHAMID, Moshood ', '', '', 'fitb', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(305, '08/52HA003', 'ABDULRAUF, Bashir Salihu', '', '', '6y9h', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(306, '08/52HA015', 'ADEDIRE, Usman Adedamola', '', '', '6o7x', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(307, '08/52HA016', 'ADEFAJO, Nurudeen Adewale', '', '', 'd1az', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(308, '07/55EC026', 'ADEKEYE, Adebayo ', '', '', '1x4v', 0, '2013-05-29 16:48:14', '2013-05-29 16:48:14', 1, 1, 1),
(309, '07/55EC027', 'ADEKUNLE, Adeshina Adeyemi', '', '', 'tlq7', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(310, '07/55EC033', 'ADENIYI, Lawrence Shola', '', '', '981g', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(311, '07/55EC042', 'ADIMULA, Micheal Toba', '', '', 'emif', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(312, '08/52HA033', 'AJAYI, Oluwatosin Olalekan', '', '', 't3w4', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(313, '07/55EC054', 'AKERELE, Odunayo ', '', '', 'agpq', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(314, '08/52HA038', 'AKINDELE, Victor Opeyemi', '', '', 'eb0k', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(315, '08/52HA039', 'AKINLEYE, Akinniyi Akinsola', '', '', '6huw', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(316, '07/55EC056', 'AKINRINOLA, Bukola Funmilayo', '', '', '8kst', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(317, '07/55EC064', 'ALIMI, Abdulhameed ', '', '', 'n444', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(318, '07/55EC066', 'AMINU, Rabiat Alaya', '', '', 'vljz', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(319, '08/52HA048', 'AMUDA, Haruna Femi', '', '', '3y3y', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(320, '08/52HA050', 'ARAOYE, Joseph Abiodun', '', '', 'j89t', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(321, '07/55EC073', 'ASALA, Oluwatobi ', '', '', 'j2xw', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(322, '07/55EC075', 'AWOYEMI, Olanrewaju Samuel', '', '', 'ym1w', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(323, '07/55EC076', 'AYANTUNDE, Ayanniyi Olaoluwa', '', '', '9eyd', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(324, '07/55EC078', 'AYINLA, Tunbosun Gbolahan', '', '', '7iut', 0, '2013-05-29 16:48:15', '2013-05-29 16:48:15', 1, 1, 1),
(325, '08/52HA055', 'BABANIYI, Asorose Ayodeji', '', '', 'gwzw', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(326, '07/55EC084', 'BADA, Moshood Abiola', '', '', '10lr', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(327, '07/55EC087', 'BALOGUN, Bilikis Oyinlola', '', '', '01r4', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(328, '07/55EC088', 'BALOGUN, Lukman Busayo', '', '', '9ngz', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(329, '06/55EC082', 'BIALA, Oluwaseyi Ayodeji', '', '', 'oxu6', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(330, '08/52HA061', 'BISIRIYU, Jamiu Olajide', '', '', 'uet2', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(331, '08/52HA066', 'DAMISA, Abdulmalik Ozaovehe', '', '', 'lqmp', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(332, '07/55EC100', 'DANIEL, Unyime Hogan', '', '', 'tkrm', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(333, '07/55EC103', 'DURODOLA, Olanrewaju Azeez', '', '', 'thwh', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(334, '08/52HA078', 'FAKINLEDE, Tomiiwo Abosede', '', '', '90oy', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(335, '08/52HA079', 'FAKORODE, Segun ', '', '', 'p7vz', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(336, '06/55ED039', 'IBITOYE, Olushola Samson', '', '', 'mki2', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(337, '07/55EC118', 'IBRAHIM, Olufemi Abdulrasaq', '', '', '6yj4', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(338, '08/52HA095', 'KILANSE, Ahmed Idowu', '', '', 'f56t', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(339, '07/55EC133', 'MAYAKI, Bolanle Mariam', '', '', 'x0rk', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(340, '07/55EC135', 'MOHAMMED, Habeeb Afolabi', '', '', 'n1wb', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(341, '08/52HA104', 'MUSA, Ifedapo Abdulazeez', '', '', '95dd', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(342, '08/52HA108', 'ODEYEMI, Tirimisiyu ', '', '', 'f30l', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(343, '07/55EC151', 'OKEWOYE, Obafemi Gideon', '', '', 'sq4c', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(344, '07/55EC154', 'OLADEYI, Rahman Ishola', '', '', 'mla9', 0, '2013-05-29 16:48:16', '2013-05-29 16:48:16', 1, 1, 1),
(345, '08/52HA122', 'OLADIMEJI, Lateef Oyeniyi', '', '', 'f6eg', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(346, '08/52HA166', 'OLANIYAN, Toyin Afusat', '', '', '1jh7', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(347, '08/52HA130', 'OMOSAGBA, Olawale ', '', '', 'aejy', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(348, '08/52HA133', 'ONOTU, Kabiru Itopa', '', '', 'dlov', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(349, '07/55EC177', 'ONWUDIMEGWU, Chukwuemeka ', '', '', 'nzoq', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(350, '07/55EC182', 'OWOLABI, Adekunle Temitope', '', '', 'zo24', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(351, '08/52HA138', 'OYEBAMIJI, Sefiu Kehinde', '', '', 'qijf', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(352, '08/52HA139', 'OYEBOADE, Tolulope Ronke', '', '', '5nmp', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(353, '07/55EC186', 'OYELADUN, Mueez Olasunkanmi', '', '', 'axno', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(354, '07/55EC191', 'SAADU, Lukman ', '', '', '7il6', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(355, '08/52HA141', 'SALAMI, Zainab Oluwabukola', '', '', '5gcq', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(356, '07/55EC204', 'TOLORUNLOJU, Christiana Oluwaseyi', '', '', 'kmy9', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(357, '09/52HA003', 'ABOLAJI, Femi Okikiola', '', '', 'tkh3', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(358, '09/52HA005', 'ADEBAYO, Shakirat Adenike', '', '', '6e33', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(359, '09/52HA009', 'ADENIYI, Ahmed ', '', '', 'fibt', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(360, '09/52HA011', 'ADEOTI, Francis Damilola', '', '', 'ci11', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(361, '09/52HA015', 'ADEYEMI, Aishat Aderonke', '', '', 'h6zx', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(362, '09/52HA018', 'AFOLAYAN, Isaiah Kunle', '', '', 'ypa0', 1, '2013-05-31 10:04:27', '2013-05-29 16:48:17', 1, 1, 1),
(363, '09/52HA019', 'AGARRY, Elo Patience', '', '', 'wx3q', 0, '2013-05-29 16:48:17', '2013-05-29 16:48:17', 1, 1, 1),
(364, '09/52HA020', 'AGBAJE, Abimbola Zainab', '', '', '5dpp', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(365, '09/52HA026', 'AKINNIYI, Akinwale Abdul-Azeez', '', '', 'mp3l', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(366, '09/52HA027', 'AKINOLA, Yusuf Akinjide', '', '', '0yak', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(367, '09/52HA028', 'AKOGUN, Olusesan Philips', '', '', 'io5d', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(368, '09/52HA033', 'AMOO, Florence Oluwakemi', '', '', 'bc4c', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(369, '06/10AC099', 'AROWOLO, Adebayo Johnson', '', '', 'pzxp', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(370, '09/52HA036', 'ATOLAGBE, Hawau Abimbola', '', '', '58jj', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(371, '09/52HA037', 'ATOYEBI, Olusola John', '', '', 'joi7', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(372, '09/52HA040', 'AYEDUN, Oluwatosin Abiola', '', '', 'zs9j', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(373, '09/52HA044', 'BAKARE, Hafiz Oluwasegun', '', '', 'zbwy', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(374, '09/52HA045', 'BALOGUN, Abiodun Delight', '', '', 's0h4', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(375, '09/52HA046', 'BALOGUN, Ifeoluwamipo Aishat', '', '', 'hwql', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(376, '06/55EJ092', 'BAMITEKO, Adeyemi Omotosho', '', '', 'qxsf', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(377, '09/52HA051', 'BANKOLE, Richard Ademola', '', '', 'xqtr', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(378, '09/52HA052', 'BELLO, Ajifolawe Mubaraq', '', '', 'dd3i', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(379, '09/52HA053', 'BELLO, Samiat Olayide', '', '', 'jgy2', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(380, '09/52HA056', 'DAIRO, Ridwan Ayomipo', '', '', '11g3', 1, '2013-05-31 13:09:53', '2013-05-29 16:48:18', 1, 1, 1),
(381, '09/52HA057', 'DAUD, Monsurat Yetunde', '', '', 'io60', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(382, '09/52HA059', 'EJETEH, Perpetua ', '', '', '5do6', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(383, '09/52HA061', 'EPELLE, Boma Rachael', '', '', 'r575', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(384, '09/52HA064', 'FAJIMITE, Oluwafemi Ayomide', '', '', 'datd', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(385, '09/52HA067', 'GANIYU, Ridwan Bayo', '', '', 'o4a5', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(386, '09/52HA068', 'GEORGE, Astor Igwe', '', '', 'sbry', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(387, '09/52HA069', 'GIDIGBI, Oladosu Mobolaji', '', '', 'beoc', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(388, '09/52HA070', 'IBITOYE, Omoyele Al-Azeem', '', '', 'wzo8', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(389, '09/52HA071', 'IBRAHIM, Suliat Oloriegbe', '', '', 'rnm4', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(390, '09/52HA072', 'IBRAHIM, Toheeb Olanrewaju', '', '', 'lwma', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(391, '09/52HA073', 'IBUOYE, Opeyemi Michael', '', '', 'xoyk', 1, '2013-05-31 13:11:17', '2013-05-29 16:48:18', 1, 1, 1),
(392, '09/52HA077', 'IYELA, Abomo Olubukola', '', '', 'v1vl', 0, '2013-05-29 16:48:18', '2013-05-29 16:48:18', 1, 1, 1),
(393, '09/52HA080', 'JINADU, Habeeb ', '', '', 'ho0k', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(394, '09/52HA088', 'KOSEMANI, Salem Bolaji', '', '', '5gyk', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(395, '09/52HA089', 'LAWAL, Moshood Abiola', '', '', 'uiac', 1, '2013-05-31 11:18:35', '2013-05-29 16:48:19', 1, 1, 1),
(396, '09/52HA090', 'MAKINDE, Dotun Abiola', '', '', 'yewc', 1, '2013-05-31 11:35:42', '2013-05-29 16:48:19', 1, 1, 1),
(397, '09/52HA099', 'NWOGA, Thankgod ', '', '', 'l32b', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(398, '09/52HA100', 'OBAITOR, Victor Adinoyi', '', '', '8061', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(399, '09/52HA101', 'ODELEYE, Oluwafemi Joseph', '', '', 'vvch', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(400, '09/52HA104', 'OGUNGBADE, Adeyemi Azeez', '', '', '9obp', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(401, '06/30GD091', 'OGUNLOLA, Folajimi Abraham', '', '', 'gv6x', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(402, '09/52HA107', 'OJOMU, Tawakalitu Eniola', '', '', 'cbyc', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(403, '09/52HA109', 'OKPETU, Jummai Doris', '', '', '3dex', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(404, '09/52HA110', 'OKUNLOLA, Olugbade Elijah', '', '', 'l2xj', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(405, '09/52HA111', 'OLABODE, Olaleye Abimbola', '', '', 'rq9q', 1, '2013-05-31 14:21:19', '2013-05-29 16:48:19', 1, 1, 1),
(406, '09/52HA112', 'OLADEJI, Oluwafemi Olatunde', '', '', '8q30', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(407, '09/52HA113', 'OLADOYIN, Hameedat Temitope', '', '', 't6wf', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(408, '09/52HA114', 'OLAGOKE, Kehinde Hassan', '', '', 'jajv', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(409, '09/52HA115', 'OLANIYAN, Olayemi Afeez', '', '', 'cfmh', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(410, '07/30GC121', 'OLOWOLENI, Oluwamuyiwa Olaolu', '', '', 'uado', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(411, '09/52HA120', 'OLUSEGUN, Ibukun ', '', '', 'jghf', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(412, '09/52HA123', 'ONDOMA, Jude Inalegwu', '', '', '6cch', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(413, '09/52HA124', 'ONIFADE, James Dare', '', '', 'b2g0', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(414, '09/52HA129', 'OSENI, Ridwan Olasunkanmi', '', '', '6ot2', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1);
INSERT INTO `voters` (`id`, `matricNumber`, `firstname`, `lastname`, `othernames`, `password`, `isvoted`, `last_modified_on`, `created_on`, `department_id`, `University_id`, `Faculty_id`) VALUES
(415, '09/52HA130', 'OSUOLALE, Rasheedat Biola', '', '', 'hnfr', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(416, '09/52HA131', 'OWODUNNI, Safurat Ibitola', '', '', 'cgaq', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(417, '09/52HA133', 'OYEBANJI, Adetunji Suleiman', '', '', 'fe5v', 1, '2013-05-31 10:23:52', '2013-05-29 16:48:19', 1, 1, 1),
(418, '02/30GC184', 'OYEBOLA, Folabo Kehinde', '', '', 'xbl6', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(419, '09/52HA134', 'OYEKANMI, Oluwabusayo ', '', '', '12or', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(420, '09/52HA140', 'RAHEEM, Folajimi Qudus', '', '', 'qw9i', 0, '2013-05-29 16:48:19', '2013-05-29 16:48:19', 1, 1, 1),
(421, '09/52HA142', 'SAKA, Itopa Azeez', '', '', 'tdhj', 0, '2013-05-29 16:48:20', '2013-05-29 16:48:20', 1, 1, 1),
(422, '09/52HA144', 'SALAUDEEN, Ibraheem Olayiwola', '', '', 'p086', 0, '2013-05-29 16:48:20', '2013-05-29 16:48:20', 1, 1, 1),
(423, '09/52HA146', 'SULAIMON, Ismail Abiodun', '', '', 'arl1', 0, '2013-05-29 16:48:20', '2013-05-29 16:48:20', 1, 1, 1),
(424, '09/52HA147', 'UDEAJA, Chinweuba Udeh', '', '', '9mf0', 0, '2013-05-29 16:48:20', '2013-05-29 16:48:20', 1, 1, 1),
(425, '09/52HA149', 'WASULU, Habib Olawale', '', '', 'zoor', 0, '2013-05-29 16:48:20', '2013-05-29 16:48:20', 1, 1, 1),
(426, '09/52HA150', 'YAHAYA, Abdulrazaq ', '', '', 'cyoy', 0, '2013-05-29 16:48:20', '2013-05-29 16:48:20', 1, 1, 1),
(427, '09/52HA151', 'YAKUBU, Ibrahim Tunde', '', '', 'o42b', 0, '2013-05-29 16:48:20', '2013-05-29 16:48:20', 1, 1, 1),
(428, '09/52HA153', 'YUSUF, Ayomide Adekunle', '', '', 'bz5x', 0, '2013-05-29 16:48:20', '2013-05-29 16:48:20', 1, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrators`
--
ALTER TABLE `administrators`
  ADD CONSTRAINT `fk_administrators_departments1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_administrators_Faculties1` FOREIGN KEY (`Faculty_id`) REFERENCES `faculties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_administrators_Universities1` FOREIGN KEY (`University_id`) REFERENCES `universities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidate_position` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Voters_department0` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Voters_Faculty0` FOREIGN KEY (`Faculty_id`) REFERENCES `faculties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Voters_University0` FOREIGN KEY (`University_id`) REFERENCES `universities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `department_belongs_to_Faculty1` FOREIGN KEY (`Faculty_id`) REFERENCES `faculties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `elections_has_candidates`
--
ALTER TABLE `elections_has_candidates`
  ADD CONSTRAINT `fk_elections_has_candidates_candidates` FOREIGN KEY (`candidates_id`) REFERENCES `candidates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_elections_has_candidates_elections` FOREIGN KEY (`elections_id`) REFERENCES `elections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `elections_has_voters`
--
ALTER TABLE `elections_has_voters`
  ADD CONSTRAINT `elections_has_Voters_elections` FOREIGN KEY (`elections_id`) REFERENCES `elections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `elections_has_Voters_Voters` FOREIGN KEY (`Voters_id`) REFERENCES `voters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculty_belongs_to_University` FOREIGN KEY (`University_id`) REFERENCES `universities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `fk_results_candidate1` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_results_position1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `voters`
--
ALTER TABLE `voters`
  ADD CONSTRAINT `Voters_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Voters_Faculty` FOREIGN KEY (`Faculty_id`) REFERENCES `faculties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Voters_University` FOREIGN KEY (`University_id`) REFERENCES `universities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
