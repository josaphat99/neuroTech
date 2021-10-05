-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2021 at 08:21 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cognitive_covid`
--

-- --------------------------------------------------------

--
-- Table structure for table `assertion`
--

CREATE TABLE `assertion` (
  `id` int(11) NOT NULL,
  `assertion` varchar(255) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assertion`
--

INSERT INTO `assertion` (`id`, `assertion`, `question_id`) VALUES
(96, 'Fine', 44),
(97, 'Bad', 44),
(98, 'Yes', 46),
(99, 'No', 46),
(100, 'Yes', 48),
(101, 'No', 48),
(102, 'No', 51),
(103, 'Heart or lung disorder', 51),
(104, 'Disorder of the liver', 51),
(105, 'Obesitty', 51),
(106, 'On chemotherapy or radiotherapy', 51),
(107, 'Living with HIV', 51),
(108, 'Living with anemia', 51),
(109, 'Others', 51),
(110, 'Yes', 52),
(111, 'No', 52),
(112, 'Yes', 53),
(113, 'No', 53),
(114, 'Johnson johnson', 54),
(115, 'Atrazineca', 54),
(116, 'Sinovacs from chine', 54),
(117, 'Pfezer', 54),
(118, 'Yes', 55),
(119, 'No', 55),
(120, 'More than 37.5', 56),
(121, 'Between 35.5 and 37.5', 56),
(122, 'Less than 35.5', 56),
(123, 'Yes', 57),
(124, 'No', 57),
(125, 'Yes', 58),
(126, 'No', 58),
(127, 'More than 90', 59),
(128, '90', 59),
(129, 'Less than 90', 59),
(130, 'Yes', 60),
(131, 'No', 60),
(132, 'Yes', 61),
(133, 'No', 61),
(134, '1', 62),
(135, '2', 62),
(136, '3', 62),
(137, '4', 62),
(138, '5', 62),
(139, '1', 63),
(140, '2', 63),
(141, '3', 63),
(142, '4', 63),
(143, '5', 63),
(144, 'Yes', 65),
(145, 'No', 65),
(146, 'Yes', 66),
(147, 'No', 66),
(148, '0', 67),
(149, '1', 67),
(150, '2', 67),
(151, '3', 67),
(152, 'More than 3', 67),
(153, '0', 68),
(154, '1', 68),
(155, '2', 68),
(156, '3', 68),
(157, 'More than 3', 68);

-- --------------------------------------------------------

--
-- Table structure for table `detailniveau`
--

CREATE TABLE `detailniveau` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `niveau_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exercice`
--

CREATE TABLE `exercice` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `maximum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exercice`
--

INSERT INTO `exercice` (`id`, `titre`, `type`, `maximum`) VALUES
(2, 'Test', NULL, NULL),
(3, 'MEDICAL CONDITION', 'pre_test', NULL),
(4, 'DAILY MONITORING', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `main` tinyint(1) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `niveau`
--

CREATE TABLE `niveau` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `indice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `niveau`
--

INSERT INTO `niveau` (`id`, `nom`, `indice`) VALUES
(1, 'Déficit cognitif léger', 1),
(2, 'Déficit cognitif moderé', 2),
(3, 'Déficit cognitif sévère', 3),
(4, 'Etat mental normal', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ordonnance`
--

CREATE TABLE `ordonnance` (
  `id` int(11) NOT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `description` text NOT NULL,
  `patient_id` int(11) NOT NULL,
  `passation_id` int(11) NOT NULL,
  `type` varchar(200) DEFAULT 'doctor'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordonnance`
--

INSERT INTO `ordonnance` (`id`, `numero`, `description`, `patient_id`, `passation_id`, `type`) VALUES
(9, NULL, ',,', 42, 10, 'patient'),
(10, NULL, 'Vitamin C,Vitamin B,Cunine', 41, 11, 'patient'),
(12, NULL, 'Panado,Paracetamol', 41, 20, 'patient'),
(13, NULL, 'Aspirine,Dexametazol,Vitamin C', 41, 21, 'patient'),
(14, '0023', 'Aspirine,Luther ford', 41, 21, 'doctor'),
(15, '0023', 'Aspirine,Chloroquine', 42, 22, 'doctor'),
(16, NULL, 'Panada,Aspirine', 50, 26, 'patient'),
(17, NULL, 'Panado,Paracetamol', 51, 28, 'patient'),
(18, '0023', 'Panado,Paracetamol', 41, 14, 'doctor');

-- --------------------------------------------------------

--
-- Table structure for table `passation`
--

CREATE TABLE `passation` (
  `id` int(11) NOT NULL,
  `datepassation` varchar(200) DEFAULT NULL,
  `datestarted` varchar(20) DEFAULT NULL,
  `resultat` int(11) DEFAULT NULL,
  `started` int(11) NOT NULL DEFAULT '0',
  `done` int(11) NOT NULL DEFAULT '0',
  `utilisateur_id` int(11) NOT NULL,
  `exercice_id` int(11) NOT NULL,
  `rendezvous_id` int(11) DEFAULT NULL,
  `diagnostic_file` varchar(255) DEFAULT NULL,
  `medical_plan_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passation`
--

INSERT INTO `passation` (`id`, `datepassation`, `datestarted`, `resultat`, `started`, `done`, `utilisateur_id`, `exercice_id`, `rendezvous_id`, `diagnostic_file`, `medical_plan_file`) VALUES
(2, '15-08-2021, 00:02', '15-08-2021', NULL, 1, 1, 41, 2, 2, NULL, NULL),
(10, '15-08-2021, 03:45', '15-08-2021', NULL, 1, 1, 42, 2, 10, NULL, NULL),
(11, '15-08-2021, 03:47', '15-08-2021', NULL, 1, 1, 41, 2, 11, NULL, NULL),
(13, '22-08-2021, 09:28', '22-08-2021', NULL, 1, 1, 41, 3, 13, NULL, NULL),
(14, '22-08-2021, 12:53', '22-08-2021', NULL, 1, 1, 41, 3, 14, '0b252f5300b2d2c65f8ecacd46869b8b-contrat_french.pdf', NULL),
(15, '22-08-2021, 13:04', '22-08-2021', NULL, 1, 1, 42, 3, 15, NULL, NULL),
(16, '22-08-2021, 14:38', '22-08-2021', NULL, 1, 1, 42, 3, 16, NULL, NULL),
(17, '22-08-2021, 14:53', '22-08-2021', NULL, 1, 1, 41, 3, 17, NULL, NULL),
(18, '24-08-2021, 12:50', '24-08-2021', NULL, 1, 1, 42, 3, 18, NULL, NULL),
(19, '24-08-2021, 12:57', '24-08-2021', NULL, 1, 1, 42, 3, 19, NULL, NULL),
(20, '24-08-2021, 13:03', '24-08-2021', NULL, 1, 1, 41, 3, 20, NULL, NULL),
(21, '24-08-2021, 13:07', '24-08-2021', NULL, 1, 1, 41, 3, 21, 'ab512a2e155831fbc4576d341044b7bf-MOS_Word_Expert_2013_Exam_Objectives___Part_2.pdf', 'f47e7c92452a2e5ce0fe7a16854df8d7-MOS_Word_2013_Exam_Objectives.pdf'),
(22, '27-08-2021, 19:06', '27-08-2021', NULL, 1, 1, 42, 3, 22, 'd6989dcd51c7edc5bafa63d2f76c9a1e-devoir.pdf', '72f90bc875f42919270ac39f327bbfbb-MOS_Word_Expert_2013_Exam_Objectives___Part_2.pdf'),
(23, '27-08-2021, 19:35', '27-08-2021', NULL, 1, 1, 42, 3, 26, NULL, NULL),
(24, NULL, '27-08-2021', NULL, 1, 0, 42, 4, 27, NULL, NULL),
(25, '27-08-2021, 20:06', '27-08-2021', NULL, 1, 1, 41, 3, 23, '3126d7a8c9c55975a76bf423227ae270-MOS_Word_2013_Exam_Objectives.pdf', 'cf4f18c8906dad4cee668bb45e972aa2-MOS_Word_2013_Exam_Objectives.pdf'),
(26, '16-09-2021, 09:49', '16-09-2021', NULL, 1, 1, 50, 3, 28, '5ba0092f9501b616bbf425a0e5afb117-MOS_Word_2013_Exam_Objectives.pdf', NULL),
(27, '16-09-2021, 10:04', '16-09-2021', NULL, 1, 1, 50, 3, 29, '754ad5062d06e88af2c2c6d1e002db31-MOS_Word_2013_Exam_Objectives.pdf', '6fcce96a58a21748bea40a2a6a38d0ba-MOS_Word_Expert_2013_Exam_Objectives___Part_1.pdf'),
(28, '17-09-2021, 10:09', '17-09-2021', NULL, 1, 1, 51, 4, 30, '9bb2cd068be6d968d214330904fe7ba4-MOS_Word_2013_Exam_Objectives.pdf', NULL),
(29, '03-10-2021, 20:29', '03-10-2021', NULL, 1, 1, 41, 3, 25, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `question` varchar(255) NOT NULL,
  `cote` int(11) DEFAULT NULL,
  `vraireponse` varchar(255) DEFAULT NULL,
  `exercice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `type`, `question`, `cote`, `vraireponse`, `exercice_id`) VALUES
(44, 'choixmultiple', 'How are you now?', NULL, NULL, 2),
(45, 'traditionnelle', 'How old are you?', NULL, NULL, 2),
(46, 'choixmultiple', 'Are you diabetic?', NULL, NULL, 3),
(47, 'traditionnelle', 'What is your sugar?', NULL, NULL, 3),
(48, 'choixmultiple', 'Are you hypertensive?', NULL, NULL, 3),
(49, 'traditionnelle', 'What is Blood Pressure?', NULL, NULL, 3),
(51, 'choixmultiple', 'Do you have any chronic illness? ', NULL, NULL, 3),
(52, 'choixmultiple', 'Ever been admitted for covid19', NULL, NULL, 3),
(53, 'choixmultiple', 'Are you vaccinated', NULL, NULL, 3),
(54, 'choixmultiple', 'Which type of vaccine?', NULL, NULL, 3),
(55, 'choixmultiple', 'Do you have chills?', NULL, NULL, 4),
(56, 'choixmultiple', 'What\'s your temperature?', NULL, NULL, 4),
(57, 'choixmultiple', 'Shortness of breath?', NULL, NULL, 4),
(58, 'choixmultiple', 'Cough?', NULL, NULL, 4),
(59, 'choixmultiple', 'Saturation?', NULL, NULL, 4),
(60, 'choixmultiple', 'Sore throat?', NULL, NULL, 4),
(61, 'choixmultiple', 'Headech?', NULL, NULL, 4),
(62, 'choixmultiple', 'Body weakness? Give a mark from 1 to 5', NULL, NULL, 4),
(63, 'choixmultiple', 'Body pains? Give a mark from 1 to 5', NULL, NULL, 4),
(64, 'traditionnelle', 'What is your Blood Pressure?', NULL, NULL, 4),
(65, 'choixmultiple', 'Loss of smell?', NULL, NULL, 4),
(66, 'choixmultiple', 'Loss of taste?', NULL, NULL, 4),
(67, 'choixmultiple', 'Vomitting? How many time per day?', NULL, NULL, 4),
(68, 'choixmultiple', 'Diarrhea? How many time per day?', NULL, NULL, 4),
(69, 'traditionnelle', 'What is your sugar', NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `recommandation`
--

CREATE TABLE `recommandation` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `date` varchar(25) DEFAULT NULL,
  `heure` varchar(15) DEFAULT NULL,
  `etat` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recommandation`
--

INSERT INTO `recommandation` (`id`, `doctor_id`, `utilisateur_id`, `date`, `heure`, `etat`) VALUES
(36, 44, 41, NULL, NULL, 1),
(37, 36, 41, NULL, NULL, 1),
(38, NULL, 42, NULL, NULL, 1),
(39, 44, 42, NULL, NULL, 1),
(40, 36, 41, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `heure` varchar(10) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT '0',
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rendezvous`
--

INSERT INTO `rendezvous` (`id`, `date`, `heure`, `etat`, `patient_id`, `doctor_id`) VALUES
(1, '2021-08-12', '12h30', 1, 42, 44),
(2, '2021-08-14', '12h30', 1, 41, 44),
(10, '2021-08-15', '12h30', 1, 42, 44),
(11, '2021-08-15', '12h30', 1, 41, 44),
(12, '2021-08-15', '12h30', 1, 41, 44),
(13, '2021-08-22', '12h30', 1, 41, 44),
(14, '2021-08-22', '12h30', 1, 41, 44),
(15, '2021-08-22', '12h30', 1, 42, 44),
(16, '2021-08-22', '12h30', 1, 42, 44),
(17, '2021-08-22', '12h30', 1, 41, 44),
(18, '2021-08-24', '12h30', 1, 42, 44),
(19, '2021-08-25', '12h30', 1, 42, 44),
(20, '2021-08-24', '12h30', 1, 41, 44),
(21, '2021-08-24', '12h30', 1, 41, 44),
(22, '2021-08-27', '12h30', 1, 42, 44),
(23, '2021-08-27', '12h30', 1, 41, 44),
(24, '2021-08-27', '12h30', 0, 42, 36),
(25, '2021-08-28', '08h30', 1, 41, 44),
(26, '2021-08-28', '08h30', 1, 42, 44),
(27, '2021-08-29', '10h00', 1, 42, 44),
(28, '2021-09-17', '08h30', 1, 50, 36),
(29, '2021-09-16', '10h00', 1, 50, 36),
(30, '2021-09-17', '10h00', 1, 51, 44);

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `reponse` text,
  `question_id` int(11) NOT NULL,
  `passation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reponse`
--

INSERT INTO `reponse` (`id`, `reponse`, `question_id`, `passation_id`) VALUES
(15, 'Fine', 44, 2),
(16, '19', 45, 2),
(31, 'Fine', 44, 10),
(32, '90', 45, 10),
(33, 'Fine', 44, 11),
(34, '90', 45, 11),
(49, 'Yes', 46, 13),
(50, '7', 47, 13),
(51, 'Yes', 48, 13),
(52, '40', 49, 13),
(54, 'Living with HIV', 51, 13),
(55, 'Yes', 52, 13),
(56, 'Yes', 53, 13),
(57, '  Viral vector vaccine', 54, 13),
(58, 'Yes', 46, 14),
(59, '32', 47, 14),
(60, 'Yes', 48, 14),
(61, '232', 49, 14),
(63, 'Disorder of the liver', 51, 14),
(64, 'Yes', 52, 14),
(65, 'No', 53, 14),
(66, 'No', 46, 15),
(67, 'No', 48, 15),
(69, 'No', 51, 15),
(70, 'Yes', 52, 15),
(71, 'Yes', 53, 15),
(72, '  Viral vector vaccine', 54, 15),
(73, '--', 47, 16),
(74, 'No', 46, 16),
(75, 'No', 48, 16),
(76, '--', 49, 16),
(78, 'Heart or lung disorder', 51, 16),
(79, 'Yes', 52, 16),
(80, 'No', 53, 16),
(81, '--', 47, 17),
(82, 'No', 46, 17),
(83, '--', 49, 17),
(84, 'No', 48, 17),
(86, 'Heart or lung disorder', 51, 17),
(87, 'Yes', 52, 17),
(88, 'No', 53, 17),
(89, 'Yes', 46, 18),
(90, '9', 47, 18),
(91, 'No', 48, 18),
(92, '--', 49, 18),
(94, 'Obesitty', 51, 18),
(95, 'No', 52, 18),
(96, 'Yes', 53, 18),
(97, 'Live attenuated vaccine', 54, 18),
(99, 'Yes', 46, 19),
(100, '9', 47, 19),
(101, 'No', 48, 19),
(102, '--', 49, 19),
(104, 'Living with HIV', 51, 19),
(105, 'Yes', 52, 19),
(106, 'Yes', 53, 19),
(107, 'Live attenuated vaccine', 54, 19),
(108, 'Yes', 46, 20),
(109, '40', 47, 20),
(110, 'Yes', 48, 20),
(111, '80/40', 49, 20),
(113, 'Disorder of the liver', 51, 20),
(114, 'No', 52, 20),
(115, 'Yes', 53, 20),
(116, 'Inactivated vaccine', 54, 20),
(117, 'No', 46, 21),
(118, '--', 47, 21),
(119, 'Yes', 48, 21),
(120, '40/8', 49, 21),
(122, 'On chemotherapy or radiotherapy', 51, 21),
(123, 'Yes', 52, 21),
(124, '--', 54, 21),
(125, 'No', 53, 21),
(126, '--', 47, 22),
(127, 'No', 46, 22),
(128, 'Yes', 48, 22),
(129, '60/40', 49, 22),
(131, 'Heart or lung disorder', 51, 22),
(132, 'Yes', 52, 22),
(133, '--', 54, 22),
(134, 'No', 53, 22),
(135, 'Yes', 46, 23),
(136, '23', 47, 23),
(137, '--', 49, 23),
(138, 'No', 48, 23),
(140, 'No', 51, 23),
(141, 'No', 52, 23),
(142, 'Yes', 53, 23),
(143, 'Inactivated vaccine', 54, 23),
(144, 'Yes', 46, 25),
(145, '7', 47, 25),
(146, 'No', 48, 25),
(147, '--', 49, 25),
(149, 'Living with HIV', 51, 25),
(150, 'Yes', 52, 25),
(151, 'Yes', 53, 25),
(152, 'Others', 54, 25),
(153, 'No', 46, 26),
(154, '--', 47, 26),
(155, '--', 49, 26),
(156, 'No', 48, 26),
(157, 'Disorder of the liver', 51, 26),
(158, 'Yes', 52, 26),
(159, 'Yes', 53, 26),
(160, 'Atrazineca', 54, 26),
(161, 'Yes', 46, 27),
(162, '7', 47, 27),
(163, 'Yes', 48, 27),
(164, '40/26', 49, 27),
(165, 'Disorder of the liver', 51, 27),
(166, 'Yes', 52, 27),
(167, 'Yes', 53, 27),
(168, 'Atrazineca', 54, 27),
(169, 'Yes', 55, 28),
(170, 'Between 35.5 and 37.5', 56, 28),
(171, 'Yes', 57, 28),
(172, 'No', 58, 28),
(173, 'More than 90', 59, 28),
(174, 'Yes', 60, 28),
(175, 'No', 61, 28),
(176, '2', 62, 28),
(177, '3', 63, 28),
(178, '40/5', 64, 28),
(179, 'Yes', 65, 28),
(180, 'No', 66, 28),
(181, '3', 67, 28),
(182, '2', 68, 28),
(183, '8', 69, 28),
(184, 'No', 46, 29),
(185, '--', 47, 29),
(186, 'Yes', 48, 29),
(187, '56/98', 49, 29),
(188, 'Living with HIV', 51, 29),
(189, 'Yes', 52, 29),
(190, 'Yes', 53, 29),
(191, 'Atrazineca', 54, 29);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nomcomplet` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `mdp` varchar(45) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `birth_date` varchar(200) DEFAULT NULL,
  `sex` enum('Male','Female','Female and Pregnant','') DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `house_number` varchar(20) DEFAULT NULL,
  `etat` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nomcomplet`, `type`, `username`, `mdp`, `email`, `phone`, `birth_date`, `sex`, `town`, `street`, `house_number`, `etat`) VALUES
(15, 'KABULU MBOLELA JEANLUC', 'admin', 'jeanluc', '0000', 'jeanluc@gmail.com', '+260965032149', NULL, NULL, 'Ndola', 'Angola', '2267', 0),
(34, 'Kyungu Daniel', 'reception', 'daniel', '0000', 'daniel@gmail.com', '+260965032149', NULL, NULL, 'Ndola', 'Angola', '889', 0),
(36, 'Jinny Mutambay', 'doctor', 'jinny', '0000', 'jinny@gmail.com', '+260965032149', NULL, 'Female', NULL, NULL, NULL, 0),
(41, 'Manang Kafutshi Elsa', 'patient', 'elsa', '0000', '', '+260965032149', '1997-08-16', 'Female', 'Ndola', 'Petauke', '1045', 1),
(42, 'Katomb Mukaz Youri', 'patient', 'youri', '0000', '', '+260965032149', '1994-07-09', 'Male', 'Kitwe', 'Petauke road', '705', 1),
(44, 'Adam KALONJI', 'doctor', 'adam', '0000', 'adam@gmail.com', '+260965032149', NULL, 'Male', NULL, NULL, NULL, 1),
(46, 'Junior Kasenda', 'patient', 'junior', '0000', 'junior@gmail.com', '+260965032149', '2021-08-31', 'Male', 'Ndola', 'Chintu road', '2037', 1),
(47, 'Jemimah Kalonje', 'patient', 'jemimah', '0000', 'jemima@gmail.com', '+260965032149', '2002-08-18', 'Female', 'Ndola', 'Petauke', '67', 1),
(48, 'Jenomica', 'patient', 'Jenomica', '@Jenomica2021', 'jenomica@gmail.com', '+260965032149', '2009-05-24', 'Female', 'Kitwe', 'Shineke', '67', 1),
(50, 'Pascal Mpundu', 'patient', 'pascal', '@pascal2021', 'pascal@gmail.com', '+260965032149', '1997-02-04', 'Male', 'Ndola', 'Petauke', '889', 1),
(51, 'Richard Kasongo', 'patient', 'richard', '@richard2021', 'richard@gmail.com', '+260965032149', '1976-07-14', 'Male', 'Ndola', 'Petauke', '67', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assertion`
--
ALTER TABLE `assertion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_question_idx` (`question_id`);

--
-- Indexes for table `detailniveau`
--
ALTER TABLE `detailniveau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_us_idx` (`utilisateur_id`),
  ADD KEY `fk_nv_idx` (`niveau_id`);

--
-- Indexes for table `exercice`
--
ALTER TABLE `exercice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_qust_idx` (`question_id`);

--
-- Indexes for table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordonnance`
--
ALTER TABLE `ordonnance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ptfk` (`patient_id`),
  ADD KEY `pss-fk` (`passation_id`);

--
-- Indexes for table `passation`
--
ALTER TABLE `passation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_idx` (`utilisateur_id`),
  ADD KEY `fk_exercise_idx` (`exercice_id`),
  ADD KEY `rdv-fk` (`rendezvous_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_exercice_idx` (`exercice_id`);

--
-- Indexes for table `recommandation`
--
ALTER TABLE `recommandation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usr_idx` (`utilisateur_id`),
  ADD KEY `fk_exr` (`doctor_id`);

--
-- Indexes for table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pfk` (`patient_id`),
  ADD KEY `dffk` (`doctor_id`);

--
-- Indexes for table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_qs_idx` (`question_id`),
  ADD KEY `pss-fk` (`passation_id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assertion`
--
ALTER TABLE `assertion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `detailniveau`
--
ALTER TABLE `detailniveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exercice`
--
ALTER TABLE `exercice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ordonnance`
--
ALTER TABLE `ordonnance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `passation`
--
ALTER TABLE `passation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `recommandation`
--
ALTER TABLE `recommandation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assertion`
--
ALTER TABLE `assertion`
  ADD CONSTRAINT `fk_question` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detailniveau`
--
ALTER TABLE `detailniveau`
  ADD CONSTRAINT `fk_nv` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_us` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_qust` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordonnance`
--
ALTER TABLE `ordonnance`
  ADD CONSTRAINT `pss-ffk` FOREIGN KEY (`passation_id`) REFERENCES `passation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ptf-k` FOREIGN KEY (`patient_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passation`
--
ALTER TABLE `passation`
  ADD CONSTRAINT `fk_exercise` FOREIGN KEY (`exercice_id`) REFERENCES `exercice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rdv` FOREIGN KEY (`rendezvous_id`) REFERENCES `rendezvous` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_exercice` FOREIGN KEY (`exercice_id`) REFERENCES `exercice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recommandation`
--
ALTER TABLE `recommandation`
  ADD CONSTRAINT `fk_exr` FOREIGN KEY (`doctor_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usr` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD CONSTRAINT `d-ffk` FOREIGN KEY (`doctor_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p-fk` FOREIGN KEY (`patient_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `fk_pss` FOREIGN KEY (`passation_id`) REFERENCES `passation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_qs` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
