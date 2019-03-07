-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 02 mars 2019 à 11:13
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `plk2`
--

-- --------------------------------------------------------

--
-- Structure de la table `ecologie`
--

DROP TABLE IF EXISTS `ecologie`;
CREATE TABLE IF NOT EXISTS `ecologie` (
  `membre_id` int(11) NOT NULL AUTO_INCREMENT,
  `membre_nom` varchar(70) NOT NULL,
  `membre_postnom` varchar(70) NOT NULL,
  `membre_prenom` varchar(50) NOT NULL,
  `membre_email` varchar(50) NOT NULL,
  `membre_age` varchar(80) NOT NULL,
  `membre_tel` varchar(15) NOT NULL,
  `membre_pics` varchar(50) NOT NULL,
  `membre_promotion` varchar(50) NOT NULL,
  `motivation` text NOT NULL,
  PRIMARY KEY (`membre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ecologie`
--

INSERT INTO `ecologie` (`membre_id`, `membre_nom`, `membre_postnom`, `membre_prenom`, `membre_email`, `membre_age`, `membre_tel`, `membre_pics`, `membre_promotion`, `motivation`) VALUES
(1, 'Bruno', 'Morgan', 'Bruno', 'fideleplk@gmail.com', '0', '0974217408', 'user.png', 'PREPA', 'je ne suis pas motive'),
(2, 'Paluku', 'Kahumba', 'Paluku', 'fidele.bruno@gmail.com', '23', '0850762370', 'delion.jpg', 'G2SI', 'j\'aime la nature et mon environnement '),
(3, 'Tumaini', 'Munguwna', 'Corneille', 'corneiimemg@gmail.com', '1', '0970559675', 'DSC_8374_1.jpg', 'G2TLC', 'je ne suis pas motivÃ©  c\'est juste par curiositÃ©'),
(4, 'fidele', 'paluku', 'fidele', 'fidele.bruno@gmail.com', '0', '0974217408', 'images (2).jpeg', 'PREPA', 'je ne suis pas motivÃ©');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
