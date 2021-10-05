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
-- Database: `db_cognitive`
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
(1, 'Julie', 157),
(2, 'Echarpe rose', 157),
(3, 'Manteau blanc', 157),
(4, 'Sa fille', 158),
(5, 'Yvette', 158),
(6, 'Les courses', 158),
(7, 'les oeufs', 172),
(8, 'le lait', 172),
(9, 'la farine', 172),
(10, 'l\'eau', 173),
(11, 'le papier', 173),
(12, 'les poubelles', 173),
(13, 'Gospel', 174),
(14, 'Jazz', 174),
(15, 'Rhumba', 174),
(16, 'Ce soir', 175),
(17, 'A midi', 175),
(18, 'Ce matin', 175);

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

--
-- Dumping data for table `detailniveau`
--

INSERT INTO `detailniveau` (`id`, `date`, `niveau_id`, `utilisateur_id`) VALUES
(2, '18-01-2021, 11:47', 1, 3),
(3, '18-01-2021, 11:47', 1, 3),
(4, '18-01-2021, 11:50', 1, 3),
(5, '18-01-2021, 11:52', 2, 3),
(6, '18-01-2021, 12:05', 1, 3),
(7, '18-01-2021, 12:56', 3, 3),
(8, '18-01-2021, 13:13', 2, 3),
(9, '18-01-2021, 13:54', 1, 3),
(10, '19-01-2021, 05:13', 2, 3),
(11, '19-01-2021, 05:20', 2, 3),
(12, '21-01-2021, 10:42', 1, 3),
(13, '22-01-2021, 10:28', 1, 3),
(14, '22-01-2021, 10:50', 1, 3),
(15, '22-01-2021, 10:57', 4, 3),
(16, '22-01-2021, 12:15', 1, 3),
(17, '14-02-2021, 11:07', 4, 3),
(18, '14-02-2021, 11:10', 1, 3),
(19, '23-02-2021, 07:45', 4, 3),
(21, '02-03-2021, 09:52', 2, 21),
(22, '04-03-2021, 11:51', 3, 20),
(23, '04-03-2021, 14:28', 3, 24),
(24, '04-03-2021, 15:38', 2, 25),
(25, '27-04-2021, 22:45', 3, 28),
(26, '17-06-2021, 23:08', 2, 29),
(27, '22-06-2021, 12:48', 3, 29);

-- --------------------------------------------------------

--
-- Table structure for table `exercice`
--

CREATE TABLE `exercice` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL,
  `maximum` int(11) NOT NULL,
  `niveau_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exercice`
--

INSERT INTO `exercice` (`id`, `titre`, `type`, `maximum`, `niveau_id`) VALUES
(13, 'Mini Mental State Examination', 'mmse', 30, 3),
(16, 'Exercice de stimulation', 'cognitif', 20, 1),
(17, 'Calcul Mental', 'cognitif', 10, 3),
(18, 'Mémoire et Attention', 'cognitif', 15, 3),
(19, 'Exercice d\'entrainement  cognitif', 'cognitif', 15, 2),
(20, 'Exercice de mémorisation', 'cognitif', 10, 2),
(21, 'Mémoire d\'éléphant', 'cognitif', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fonction`
--

CREATE TABLE `fonction` (
  `id` int(11) NOT NULL,
  `fonction` varchar(100) NOT NULL,
  `indice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fonction`
--

INSERT INTO `fonction` (`id`, `fonction`, `indice`) VALUES
(1, 'Orientation', 1),
(2, 'Apprentissage', 2),
(3, 'Attention', 3),
(4, 'Rappel', 4),
(5, 'Langage', 5);

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

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `image`, `main`, `question_id`) VALUES
(1, 'fichier4116e01fa25356981deab0e7cfc6d064_montre-maserati--homme-r8871621012_1224563_1200x1200.jpg', 1, 144),
(2, 'fichierc8f72d837e02c5571734414fe3fec042_Single-Pencil-1-1030x488.jpg', 1, 145),
(3, 'fichier0399cfa6bebe9428cb23f554a8d16ca9_images (7).jpg', 1, 151),
(4, 'fichier0399cfa6bebe9428cb23f554a8d16ca9_images (4).jpg', 0, 151),
(5, 'fichier0399cfa6bebe9428cb23f554a8d16ca9_images (6).jpg', 1, 154),
(6, 'fichier0399cfa6bebe9428cb23f554a8d16ca9_images (3).jpg', 0, 154),
(7, 'fichier0399cfa6bebe9428cb23f554a8d16ca9_images (4).jpg', 0, 154),
(8, 'fichier0399cfa6bebe9428cb23f554a8d16ca9_images.jpg', 0, 154),
(9, 'fichier0399cfa6bebe9428cb23f554a8d16ca9_images (7).jpg', 0, 154),
(10, 'fichier0399cfa6bebe9428cb23f554a8d16ca9_image_2021-01-31_112534.png', 1, 155),
(11, 'fichier0399cfa6bebe9428cb23f554a8d16ca9_image_2021-01-31_123819.png', 1, 156),
(12, 'chat2.jpg', 0, 154),
(13, 'fichier776d4193669ccd5f8b2676211b1bd68d_calcul-mental1.png.png', 1, 159),
(14, 'fichier776d4193669ccd5f8b2676211b1bd68d_calcul-mental2.png.png', 1, 160),
(18, 'fichier95db827d8d251dcbac1593504ea36252_2-fruit.png', 1, 164),
(19, 'fichier6a3dfc616a0dbb7250c63a0d3023cf1a_attention-severe.png', 1, 165),
(20, 'fichier6a3dfc616a0dbb7250c63a0d3023cf1a_memoire-severe-2.png.png', 1, 166),
(21, 'fichiere752cb2d838190284c3e3db1d475f4b6_memoire-modere.png', 1, 167),
(22, 'fichiere752cb2d838190284c3e3db1d475f4b6_memoire-modere-2.png', 1, 168),
(23, 'fichiere752cb2d838190284c3e3db1d475f4b6_attention-modere.png', 1, 169),
(24, 'fichiere752cb2d838190284c3e3db1d475f4b6_operation-modere.png', 1, 170),
(25, 'fichier9db9dc892ee71c19b486866a49535368_memoire-modere-2-2.png', 1, 171),
(26, 'fichier662ae202272763768e607cf97bcd1d74_memoire-leger1.png', 1, 176),
(27, 'fichier662ae202272763768e607cf97bcd1d74_memoire-leger3.png', 1, 177),
(28, 'fichier662ae202272763768e607cf97bcd1d74_elephant-1.png', 1, 178),
(29, 'fichier662ae202272763768e607cf97bcd1d74_elephant-3.png', 1, 179);

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
-- Table structure for table `passation`
--

CREATE TABLE `passation` (
  `id` int(11) NOT NULL,
  `datepassation` varchar(200) NOT NULL,
  `resultat` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `exercice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passation`
--

INSERT INTO `passation` (`id`, `datepassation`, `resultat`, `utilisateur_id`, `exercice_id`) VALUES
(1, '2021-01-20 04:09:00', 30, 3, 13),
(2, '0000-00-00 00:00:00', 30, 3, 13),
(3, '0000-00-00 00:00:00', 30, 3, 13),
(4, '0000-00-00 00:00:00', 22, 3, 13),
(5, '0000-00-00 00:00:00', 13, 3, 13),
(6, '0000-00-00 00:00:00', 27, 3, 13),
(7, '0000-00-00 00:00:00', 0, 3, 13),
(8, '0000-00-00 00:00:00', 17, 3, 13),
(9, '0000-00-00 00:00:00', 23, 3, 13),
(10, '0000-00-00 00:00:00', 19, 3, 13),
(11, '0000-00-00 00:00:00', 19, 3, 13),
(12, '0000-00-00 00:00:00', 26, 3, 13),
(13, '0000-00-00 00:00:00', 27, 3, 13),
(14, '0000-00-00 00:00:00', 30, 3, 13),
(15, '22-01-2021, 12:54', 30, 3, 13),
(16, '22-01-2021, 12:15', 23, 3, 13),
(17, '05-02-2021, 10:52', 15, 3, 16),
(19, '14-02-2021, 11:07', 30, 3, 13),
(20, '14-02-2021, 11:10', 22, 3, 13),
(124, '04-03-2021, 11:52', 10, 20, 20),
(125, '04-03-2021, 14:28', 4, 24, 13),
(126, '04-03-2021, 14:32', 10, 24, 17),
(127, '04-03-2021, 14:33', 15, 24, 18),
(128, '04-03-2021, 15:38', 9, 25, 13),
(129, '04-03-2021, 15:39', 15, 25, 18),
(130, '04-03-2021, 15:40', 10, 25, 20),
(131, '04-03-2021, 16:08', 10, 25, 17),
(132, '06-04-2021, 11:16', 10, 25, 19),
(133, '06-04-2021, 11:54', 12, 25, 16),
(134, '06-04-2021, 12:07', 0, 25, 21),
(135, '06-04-2021, 12:22', 0, 20, 17),
(136, '06-04-2021, 12:25', 15, 20, 18),
(137, '27-04-2021, 22:45', 6, 28, 13),
(138, '27-04-2021, 22:47', 15, 28, 18),
(139, '27-04-2021, 22:50', 10, 28, 17),
(140, '27-04-2021, 22:52', 10, 28, 20),
(141, '17-06-2021, 23:08', 18, 29, 13),
(142, '17-06-2021, 23:11', 15, 29, 19),
(143, '17-06-2021, 23:16', 10, 29, 20),
(144, '22-06-2021, 12:48', 4, 29, 13),
(145, '22-06-2021, 12:50', 14, 29, 18),
(146, '22-06-2021, 12:54', 0, 29, 17),
(147, '22-06-2021, 12:56', 17, 29, 16),
(148, '22-06-2021, 12:58', 0, 29, 21);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `question` varchar(255) NOT NULL,
  `cote` int(11) NOT NULL,
  `vraireponse` varchar(255) NOT NULL,
  `exercice_id` int(11) NOT NULL,
  `fonction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `type`, `question`, `cote`, `vraireponse`, `exercice_id`, `fonction_id`) VALUES
(137, 'traditionnelle', 'Quelle est la date complète d\'aujourd\'hui?', 5, '', 13, 1),
(138, 'mmse', 'Quel est le nom de la ville où nous sommes?', 2, '', 13, 1),
(139, 'mmse', 'Dans quelle province ou région sommes-nous?', 3, '', 13, 1),
(140, 'mmse', 'Cigare,Fleur,Porte', 0, '', 13, 2),
(141, 'mmse', 'Voulez-vous compter à partir de 100 en retirant 7 à chaque fois?', 5, '', 13, 3),
(142, 'mmse', 'Voulez-vous épeler le mot MONDE à l\'envers?', 2, 'ednom', 13, 3),
(143, 'mmse', 'Pouvez-vous me dire quels étaient les 3 mots que je vous ai demandés de répéter et de réténir tout à l\'heure?', 6, 'cigare,fleur,porte', 13, 4),
(144, 'traditionnelle', 'Quel est le nom de cet objet?', 1, 'montre', 13, 5),
(145, 'traditionnelle', 'Quel est le nom de cet objet?', 1, 'crayon', 13, 5),
(146, 'mmse', 'Ecoutez bien et repetez apres mois. PAS DES MAIS, DE SI, NI DE ET', 5, 'mais,si,et', 13, 5),
(151, 'traditionnelle', 'Mémorisez-bien ces images', 0, 'image', 16, 0),
(152, 'traditionnelle', 'Combien font   8:2+4 ?', 1, '8', 16, 0),
(153, 'traditionnelle', 'Combien font  2+6:3?', 1, '4', 16, 0),
(154, 'traditionnelle', 'Quelles sont les deux images que vous avez vues tout à l\'heure? Séparez les 2 numéros par une virgule. Exemple:2,1\r\n', 5, '3,5', 16, 0),
(155, 'traditionnelle', 'Combien des fois cette suite de lettres apparait-elle? YUPH', 5, '11', 16, 0),
(156, 'traditionnelle', 'Placez ces dates dans l\'ordre chronologique', 3, 'FDBAGCHE', 16, 0),
(157, 'choixmultiple', 'Julie a mis son écharpe rose, car elle est jolie avec son manteau blanc. A qui ou quoi le pronom \"elle\"  fait-il  référence ?', 2, 'Echarpe rose', 16, 0),
(158, 'choixmultiple', 'Que va faire Yvette à manger ce midi? Elle n\' a pas pensé à faire les courses depuis un moment. Sa fille qui vient déjeuner va le lui reprocher. A qui le pronom \"lui\" Fait-il référence?', 3, 'Yvette', 16, 0),
(159, 'traditionnelle', 'Donnez les resultas de ces calculs du plus grand au plus petit.', 3, 'b,c,d,a', 17, 0),
(160, 'traditionnelle', 'Donnez les resultats de ces calculs du plus petit au plus grand', 7, 'f,e,a,c,b,d', 17, 0),
(164, 'traditionnelle', 'Mémorisez bien ces deux images', 0, 'image', 18, 0),
(165, 'traditionnelle', 'Comptez les \"1\" est donnez leur nombre', 8, '10', 18, 0),
(166, 'traditionnelle', 'Quelles sont les deux images ques vous avez vues tout à l\'heure?', 7, 'a,c', 18, 0),
(167, 'traditionnelle', 'Mémorisez bien ces six mots (Tenez compte de la position de chaque mot). ', 0, 'image', 19, 0),
(168, 'traditionnelle', 'Quels sont les mots qui ont changé de position?', 5, 'b,d', 19, 0),
(169, 'traditionnelle', 'Combien de fois la lettre \"E\" apparait dans le texte ci-dessous? (Les \"é\" comptent aussi) ', 7, '33', 19, 0),
(170, 'traditionnelle', 'Résolvez ce problème', 3, '46', 19, 0),
(171, 'traditionnelle', 'Lisez attentivement les 4 phrases suivantes', 0, 'image', 20, 0),
(172, 'choixmultiple', 'Qu\'avait oublié Céline dans sa préparation?', 3, 'les oeufs', 20, 0),
(173, 'choixmultiple', 'Que recycle la ville depuis plusieurs années?', 3, 'le papier', 20, 0),
(174, 'choixmultiple', 'Dans quel type de groupe chantait-Serge?', 2, 'Jazz', 20, 0),
(175, 'choixmultiple', 'Quand est-ce que Odile a acheté des truites?', 2, 'Ce matin', 20, 0),
(176, 'traditionnelle', 'Mémorisez pendant deux minutes les 16 mots présents sur cette grilles.', 0, 'image', 21, 0),
(177, 'traditionnelle', 'Pouvez-vous retrouver les 16 mots de la grille précédente parmi ces 32 mots?(Dans l\'ordre alphabétique et arithmétique)', 8, 'c,d,g,i,l,n,q,r,t,w,y,1,2,3,4,6', 21, 0),
(178, 'traditionnelle', 'Mémorisez les 6 mots proposés et leur emplacement dans la grille.', 0, 'image', 21, 0),
(179, 'traditionnelle', 'Donnez (Dans l\'ordre alphabétique) les lettres des cases qui contenaient un mot.', 7, 'a,h,j,o,r,v', 21, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recommandation`
--

CREATE TABLE `recommandation` (
  `id` int(11) NOT NULL,
  `exercice_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `on_exe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recommandation`
--

INSERT INTO `recommandation` (`id`, `exercice_id`, `utilisateur_id`, `on_exe_id`) VALUES
(21, 19, 21, 21),
(23, 21, 20, 20),
(24, 20, 24, 17),
(33, 21, 28, 20);

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `reponse` varchar(255) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reponse`
--

INSERT INTO `reponse` (`id`, `reponse`, `question_id`) VALUES
(188, '2021,pluie,2,23,2', 137),
(189, '2021,pluie,2,23,2', 137),
(190, '2021,pluie,2,23,2', 137),
(191, 'lubumbashi', 138),
(192, 'katanga', 139),
(193, '100,93,86,79,72,65,58,51,44,37,30,23,16,09,02', 141),
(194, 'demon', 142),
(195, 'cigare,fleur', 143),
(196, '2021,pluie,2,23,2', 137),
(197, 'montre', 144),
(198, 'crayon', 145),
(199, 'mais,ci,et', 146),
(200, '2021,pluie,2,23,2', 137),
(201, 'lubumbashi', 138),
(202, 'haut-katanga ', 139),
(203, '2021,pluie,2,25,4', 137),
(204, 'lubumbashi', 138),
(205, 'haut-katanga', 139),
(206, '100,93,86,79,72,65,58,51,44,37,30,23,16,9,2', 141),
(207, 'ednom', 142),
(208, 'cigare,fleur,porte', 143),
(209, 'montre', 144),
(210, 'crayon', 145),
(211, 'met,si,est', 146),
(212, '8', 152),
(213, '4', 153),
(214, '3,5', 154),
(215, '11', 155),
(216, 'fdbagche', 156),
(217, 'Echarpe rose', 157),
(218, 'Yvette', 158),
(219, '2021,pluie,2,29,0', 137),
(220, 'lubumbashi', 138),
(221, 'haut-katanga', 139),
(222, '100,93,91,2,23,21,23,11,22,1,21,23,32,12,2', 141),
(223, 'edmon', 142),
(224, 'cigare,fleur,porte', 143),
(225, 'montre', 144),
(226, 'crayon', 145),
(227, 'met,si,est', 146),
(228, '2021,pluie,Mois,2,1', 137),
(229, 'e', 138),
(230, '2021,seche,2,25,4', 137),
(231, '8', 152),
(232, '99', 153),
(233, '2,1', 154),
(234, '10', 155),
(235, 'edrftgyh', 156),
(236, 'Echarpe rose', 157),
(237, 'Sa fille', 158),
(242, '8', 152),
(243, '4', 153),
(244, '2,1', 154),
(245, '11', 155),
(246, 'fdbagche', 156),
(247, 'Echarpe rose', 157),
(248, 'Yvette', 158),
(259, '8', 152),
(260, '4', 153),
(261, '4,1', 154),
(262, '44', 155),
(263, 'abcvd', 156),
(264, 'Julie', 157),
(265, 'Yvette', 158),
(268, '8', 152),
(269, '4', 153),
(270, '3,5', 154),
(271, '11', 155),
(272, 'bnmnmnmn', 156),
(273, 'Echarpe rose', 157),
(274, 'Yvette', 158),
(279, '8', 152),
(280, '4', 153),
(281, '3,5', 154),
(282, '11', 155),
(283, 'huygj', 156),
(284, 'Echarpe rose', 157),
(289, '8', 152),
(290, '4', 153),
(291, '3,5', 154),
(292, '8', 152),
(293, '4', 153),
(294, '3,5', 154),
(295, '11', 155),
(296, 'fdbagche', 156),
(297, 'Assertions', 157),
(298, 'Yvette', 158),
(301, '8', 152),
(302, '4', 153),
(303, '3,5', 154),
(304, '11', 155),
(305, 'fdbagche', 156),
(306, 'Assertions', 157),
(307, 'Yvette', 158),
(308, '2021,pluie,3,2,2', 137),
(309, 'lubumbashi', 138),
(310, 'haut-katanga', 139),
(311, '2021,pluie,3,2,2', 137),
(312, 'lubumbashi', 138),
(313, 'haut-katanga', 139),
(314, '2020,pluie,3,2,1', 137),
(315, 'lubumbashi', 138),
(316, 'haut-katanga', 139),
(317, '100,93,86,79,2,1,1,21,2,2,2,21,12,2,1', 141),
(318, 'ednom', 142),
(319, 'cigare,fleur,por', 143),
(320, 'adsv', 144),
(321, 'sdvd', 145),
(322, 'met,si,est', 146),
(323, 'bcda', 159),
(324, 'b,c,d,a', 159),
(325, 'ndhjvhsdc', 159),
(326, 'hc', 159),
(327, 'ccgchg', 159),
(328, 'b,c,d,a', 159),
(329, 'f,e,a,c,b,d', 160),
(331, '10', 165),
(332, '10', 165),
(333, '10', 165),
(334, '10', 165),
(335, '10', 165),
(336, '10', 165),
(337, '10', 165),
(338, '10', 165),
(339, '10', 165),
(340, '10', 165),
(341, '10', 165),
(342, '10', 165),
(343, '10', 165),
(344, '10', 165),
(345, '10', 165),
(346, '10', 165),
(347, '10', 165),
(348, '10', 165),
(349, 'a,c', 166),
(350, 'b,c,d,a', 159),
(351, 'f,e,c,,a,b,', 160),
(354, '8', 152),
(355, '4', 153),
(356, '3,5', 154),
(357, '11', 155),
(358, 'hjcjhfjh', 156),
(359, '2', 152),
(360, '2', 153),
(361, '3,2', 154),
(362, '3', 155),
(363, 'scdcd', 156),
(364, 'Echarpe rose', 157),
(365, 'Yvette', 158),
(366, 'b,d', 168),
(367, '33', 169),
(368, 'b,d', 168),
(369, '33', 169),
(370, 'b,d', 168),
(371, '33', 169),
(372, 'b,d', 168),
(373, '33', 169),
(374, '46', 170),
(375, 'b,c,d,a', 159),
(376, 'f,e,a,c,b,d', 160),
(377, '10', 165),
(378, 'a,c', 166),
(379, 'b,d', 168),
(380, '33', 169),
(381, '46', 170),
(382, '8', 152),
(383, '4', 153),
(384, '3,5', 154),
(385, '11', 155),
(386, 'fdbagche', 156),
(387, 'Echarpe rose', 157),
(388, 'Yvette', 158),
(389, 'b,c,d,a', 159),
(390, 'f,e,a,c,b,d', 160),
(391, 'les oeufs', 172),
(392, 'le papier', 173),
(393, 'Jazz', 174),
(394, 'Assertions', 172),
(395, 'Assertions', 173),
(396, 'Assertions', 174),
(397, 'les oeufs', 172),
(398, 'le papier', 173),
(399, 'Jazz', 174),
(400, 'Ce matin', 175),
(401, 'b,c', 168),
(402, '33', 169),
(403, '46', 170),
(404, 'les oeufs', 172),
(405, 'le papier', 173),
(406, 'Jazz', 174),
(407, 'Ce matin', 175),
(408, '8', 152),
(409, '4', 153),
(410, '3,5', 154),
(411, '11', 155),
(412, 'fdbagche', 156),
(413, 'Echarpe rose', 157),
(414, 'Yvette', 158),
(415, 'j,cds,ds', 177),
(416, 'a,h,j,o,r,v', 179),
(417, '2021,pluie,3,4,4', 137),
(418, 'lubumbashi', 138),
(419, 'haut-katanga', 139),
(420, '3,3,3,3,3,4,3,3,4,3,3,4,4,3,3', 141),
(421, 'sfvsfvd', 142),
(422, 'vsv,sdvsdv,sdvdsv', 143),
(423, 'vfvfvsv', 144),
(424, 'vsvds', 145),
(425, 'met,si,est', 146),
(426, 'b,c', 168),
(427, '33', 169),
(428, '46', 170),
(429, 'les oeufs', 172),
(430, 'le papier', 173),
(431, 'Jazz', 174),
(432, 'Ce matin', 175),
(433, 'fsmfm', 177),
(434, '2021,pluie,3,4,3', 137),
(435, 'lubumbashi', 138),
(436, 'haut-katanga', 139),
(437, '3,3,3,3,4,3,3,4,3,3,3,3,2,2,2', 141),
(438, 'svfdv', 142),
(439, 'sdvsvds', 143),
(440, 'dsddd', 144),
(441, 'vdvdfv', 145),
(442, 'met,si,est', 146),
(443, 'b,c,d,a', 159),
(444, 'f,e,a,c,b,d', 160),
(445, '10', 165),
(446, 'a,c', 166),
(447, '2021,pluie,3,2,1', 137),
(448, 'lubumbashi', 138),
(449, 'haut-katanga', 139),
(450, '100,23,3,332,3,44,2,3,23,3,2,32,3,32,3', 141),
(451, 'edmx', 142),
(452, 'cigare,fleur,orange', 143),
(453, 'papier', 144),
(454, 'stylo', 145),
(455, 'met,si,est', 146),
(456, '10', 165),
(457, 'a,c', 166),
(458, 'les oeufs', 172),
(459, 'le papier', 173),
(460, 'Jazz', 174),
(461, 'Ce matin', 175),
(462, 'b,c,d,a', 159),
(463, 'f,e,a,c,b,d', 160),
(464, 'b,c', 168),
(465, '2021,seche,4,6,2', 137),
(466, 'lubumbashi', 138),
(467, 'ndola', 139),
(468, 'b,c', 168),
(469, '33', 169),
(470, '46', 170),
(471, '8', 152),
(472, '4', 153),
(473, '3,5', 154),
(474, '7', 155),
(475, '8', 152),
(476, '4', 153),
(477, '3,5', 154),
(478, '11', 155),
(479, '8', 152),
(480, '4', 153),
(481, '3,5', 154),
(482, '7', 155),
(483, 'a,cbdfehg', 156),
(484, 'Echarpe rose', 157),
(485, 'Yvette', 158),
(486, 'f,t,v,2,4,5', 177),
(487, 'a,b,c,d', 179),
(489, 'bcda', 159),
(490, 'f,a,e,c,d,b', 160),
(491, '10', 165),
(492, 'a,c', 166),
(493, '2021,pluie,4,27,2', 137),
(494, 'Ndola', 138),
(495, 'Coperbelt', 139),
(496, '100,4,33,22,3,3,323,3,3,3,2,3,23,3,3', 141),
(497, 'edno', 142),
(498, 'cigare,fleur,port', 143),
(499, 'mona', 144),
(500, 'bic', 145),
(501, 'met,si,et', 146),
(502, '10', 165),
(503, 'a,c', 166),
(504, 'b,c,d,a', 159),
(505, 'f,e,a,c,b,d', 160),
(506, 'les oeufs', 172),
(507, 'le papier', 173),
(508, 'Jazz', 174),
(509, 'Ce matin', 175),
(510, '2021,pluie,1,17,4', 137),
(511, 'Ndola', 138),
(512, 'Copperbelt', 139),
(513, '100,93,86,79,72,65,58,51,44,37,30,23,16,9,2', 141),
(514, 'ednom', 142),
(515, 'cigare,fleur,porte', 143),
(516, 'montre', 144),
(517, 'cray', 145),
(518, 'met,si,est', 146),
(519, 'b,d', 168),
(520, '33', 169),
(521, '46', 170),
(522, 'les oeufs', 172),
(523, 'le papier', 173),
(524, 'Jazz', 174),
(525, 'Ce matin', 175),
(526, '2021,seche,6,17,4', 137),
(527, '2021,pluie,6,17,4', 137),
(528, '2021,pluie,6,17,4', 137),
(529, '2021,pluie,6,17,4', 137),
(530, 'n', 138),
(531, 'n', 139),
(532, '2021,pluie,6,23,2', 137),
(533, 'Ndola', 138),
(534, 'copperbelt', 139),
(535, '10,2,2,2,2,2,3,2,3,5,1,8,3,2,1', 141),
(536, 'cdfvfv', 142),
(537, 'sfvs,sdcsdc,scds', 143),
(538, 'csds', 144),
(539, 'sdcdcsdc', 145),
(540, 'met,si,est', 146),
(541, '12', 165),
(542, 'a,c', 166),
(543, 'a,c', 166),
(544, 'a,d,c,b', 159),
(545, 'f,e,c,a,,b,d', 160),
(546, '8', 152),
(547, '4', 153),
(548, '3,5', 154),
(549, '11', 155),
(550, 'dfrtgfff', 156),
(551, 'Echarpe rose', 157),
(552, 'Yvette', 158),
(553, 'sf,fd', 177),
(554, 'a,d,v,f', 179);

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
  `lieudeconsultation` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nomcomplet`, `type`, `username`, `mdp`, `lieudeconsultation`, `email`) VALUES
(3, 'BWANA WA BWANA ELIEZER', 'patient', 'eliezer', '0000', 'A la maison', 'eliezer@gmail.com'),
(15, 'KABULU MBOLELA JEANLUC', 'admin', 'jeanluc', '0000', 'Home', 'jeanluc@gmail.com'),
(17, 'ANISKHAEL REVEDI', 'patient', 'jeanluc', '0000', 'A la maison', 'REVEDI@gmail.com'),
(20, 'eiisha  kaionjil', 'patient', 'elisha', '9999', 'A la maison', 'elisa@gmail.com'),
(21, 'Ovraniel', 'patient', 'ovraniel', '0000', 'A la maison', ''),
(24, 'Patrick Zoom', 'patient', 'patrick', '0000', 'A la maison', ''),
(25, 'Elisha Elisee', 'patient', 'elisha', '0000', 'A la maison', ''),
(26, 'KATOMB MUKAZ YOURI', 'patient', 'jeanluc', '0000', 'A la maison', 'kazembe@gmail.com'),
(27, 'Adam elisha', 'patient', 'adam', '0000', 'A la maison', ''),
(28, 'Jane', 'patient', 'jane', '0000', 'A la maison', 'jane@gmail.com'),
(29, 'Joshua Kalonji', 'patient', 'joshua', '0000', 'A la maison', '');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_niveau_idx` (`niveau_id`);

--
-- Indexes for table `fonction`
--
ALTER TABLE `fonction`
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
-- Indexes for table `passation`
--
ALTER TABLE `passation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_idx` (`utilisateur_id`),
  ADD KEY `fk_exercise_idx` (`exercice_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_exercice_idx` (`exercice_id`),
  ADD KEY `fonction_id` (`fonction_id`);

--
-- Indexes for table `recommandation`
--
ALTER TABLE `recommandation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usr_idx` (`utilisateur_id`),
  ADD KEY `fk_exr` (`exercice_id`);

--
-- Indexes for table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_qs_idx` (`question_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `detailniveau`
--
ALTER TABLE `detailniveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `exercice`
--
ALTER TABLE `exercice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `passation`
--
ALTER TABLE `passation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `recommandation`
--
ALTER TABLE `recommandation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=555;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
-- Constraints for table `exercice`
--
ALTER TABLE `exercice`
  ADD CONSTRAINT `fk_niveau` FOREIGN KEY (`niveau_id`) REFERENCES `niveau` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_qust` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passation`
--
ALTER TABLE `passation`
  ADD CONSTRAINT `fk_exercise` FOREIGN KEY (`exercice_id`) REFERENCES `exercice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `fk_exr` FOREIGN KEY (`exercice_id`) REFERENCES `exercice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usr` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `fk_qs` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
