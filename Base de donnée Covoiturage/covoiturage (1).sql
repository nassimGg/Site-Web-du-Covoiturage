-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 19 Mai 2016 à 02:11
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `covoiturage`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `ID_admin` int(10) NOT NULL AUTO_INCREMENT,
  `MP_admin` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`ID_admin`, `MP_admin`, `Email`) VALUES
(1, 'azerty123', 'nassim.guergouri@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `ID_commentaire` int(20) NOT NULL AUTO_INCREMENT,
  `Contenu_commentaire` longtext NOT NULL,
  `Date_commentaire` date NOT NULL,
  `ID_participant` int(10) DEFAULT NULL,
  `ID_conducteur` int(10) DEFAULT NULL,
  `Num_trajet` int(10) NOT NULL,
  PRIMARY KEY (`ID_commentaire`),
  KEY `fk_participant` (`ID_participant`),
  KEY `fk_conducteur2` (`ID_conducteur`),
  KEY `fk_trajet` (`Num_trajet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`ID_commentaire`, `Contenu_commentaire`, `Date_commentaire`, `ID_participant`, `ID_conducteur`, `Num_trajet`) VALUES
(3, 'bieeeeen', '2016-05-06', NULL, 4, 4),
(4, 'bienoooo', '2016-05-13', 1, NULL, 8),
(6, 'ouiiiii', '2016-05-08', NULL, 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `conducteur`
--

CREATE TABLE IF NOT EXISTS `conducteur` (
  `ID_conducteur` int(10) NOT NULL AUTO_INCREMENT,
  `MP_conducteur` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Sexe` enum('M','F') NOT NULL,
  `Date_Naissance` date NOT NULL,
  `Date_inscription` date NOT NULL,
  `Tel` varchar(13) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Minibio` varchar(255) DEFAULT NULL,
  `Preference` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_conducteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `conducteur`
--

INSERT INTO `conducteur` (`ID_conducteur`, `MP_conducteur`, `Email`, `Nom`, `Prenom`, `Sexe`, `Date_Naissance`, `Date_inscription`, `Tel`, `Photo`, `Minibio`, `Preference`) VALUES
(1, 'azerty123', 'Nassim_008@hotmail.com', 'Guergouri', 'Nassim', 'M', '1993-09-16', '2016-05-01', '05555555', 'male.jpg', NULL, 'NFOMOA'),
(2, 'azerty123', 'aa.aa@gmail.com', 'soualeh', 'khalil', 'M', '1993-04-04', '2016-04-04', '055555555', 'male.jpg', NULL, 'NFOMOA'),
(3, 'azerty123', 'qq.qq@gmail.com', 'maiza', 'redha', 'M', '1993-04-17', '2016-04-09', '055555555', 'male.jpg', NULL, 'NFOMOA'),
(4, 'azerty123', 'nnn.sqsqs@gmail.com', 'dfsdf', 'zdeszd', 'M', '1992-10-10', '2016-04-11', '055555', 'male.jpg', NULL, 'NFOMOA'),
(7, 'azerty123', 'dfgdf.sdfs@sdfsdf', 'sdfsdf', 'wdfgwdfg', 'M', '1993-06-10', '2016-05-08', '', 'male.jpg', NULL, 'NFOMOA'),
(8, 'azerty123', 'naaaa.aaaa@homms', 'dsfsdf', 'dvcdf', 'M', '1992-10-10', '2016-05-08', '', 'male.jpg', NULL, 'NFNMOA'),
(10, 'azerty123', 'chahra@gmail.com', 'guergouri', 'chahra', 'M', '1992-07-30', '2016-05-11', '', 'male.jpg', NULL, 'NFOMOA');

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `ID_participant` int(10) NOT NULL AUTO_INCREMENT,
  `MP_participant` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Sexe` enum('M','F') NOT NULL,
  `Date_Naissance` date NOT NULL,
  `Date_inscription` date NOT NULL,
  `Tel` varchar(13) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Minibio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_participant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `participant`
--

INSERT INTO `participant` (`ID_participant`, `MP_participant`, `Email`, `Nom`, `Prenom`, `Sexe`, `Date_Naissance`, `Date_inscription`, `Tel`, `Photo`, `Minibio`) VALUES
(1, 'azerty123', 'Sqs.ssq@gmail.com', 'Sqsqs', 'Aya', 'F', '1995-01-15', '2016-04-13', '055555555', 'femelle.jpg', NULL),
(2, 'azerty123', 'qqq.jss@gmail.com', 'rehahla', 'hamza', 'M', '1993-04-11', '2016-04-17', '056666666', 'male.jpg', NULL),
(3, 'azerty123', 'jjqq.kjjj@gmail.com', 'jjhhhs', 'rabah', 'M', '1993-04-10', '2016-04-26', '0544444444', 'male.jpg', NULL),
(4, 'azerty123', 'seif.guergouri@gmail.com', 'Guergouri', 'Seif', 'M', '1992-07-30', '2016-05-07', '05555555', NULL, NULL),
(5, 'azerty123', 'oussama.g@gmail.com', 'hhhhh', 'ffggg', 'M', '1991-05-20', '2016-05-07', '', 'male.jpg', NULL),
(6, 'azerty123', 'nnnnnnnn@nnbb.com', 'zedfzsf', 'dsfsef', 'M', '1992-11-10', '2016-05-07', '', 'male.jpg', NULL),
(7, 'azerty123', 'naaqaq@aqaqa', 'nnnn', 'szszszs', 'M', '1992-10-20', '2016-05-08', '', 'male.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `ID_participant` int(10) NOT NULL,
  `Num_trajet` int(10) NOT NULL,
  `Nombre_place` int(3) NOT NULL,
  KEY `ID_participant` (`ID_participant`),
  KEY `Num_trajet` (`Num_trajet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`ID_participant`, `Num_trajet`, `Nombre_place`) VALUES
(1, 16, 1);

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE IF NOT EXISTS `trajet` (
  `Num_Trajet` int(10) NOT NULL AUTO_INCREMENT,
  `Type` varchar(5) NOT NULL,
  `Num_Ville1` int(5) NOT NULL,
  `Num_Ville2` int(5) NOT NULL,
  `Date_aller` date NOT NULL,
  `Date_retour` date DEFAULT NULL,
  `Heure_aller` varchar(7) NOT NULL,
  `Heure_retour` varchar(7) DEFAULT NULL,
  `Prix` double NOT NULL,
  `Nombre_place` int(3) NOT NULL,
  `ID_conducteur` int(10) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Num_Trajet`),
  KEY `fk_ville1` (`Num_Ville1`),
  KEY `fk_ville2` (`Num_Ville2`),
  KEY `fk_conducteur` (`ID_conducteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `trajet`
--

INSERT INTO `trajet` (`Num_Trajet`, `Type`, `Num_Ville1`, `Num_Ville2`, `Date_aller`, `Date_retour`, `Heure_aller`, `Heure_retour`, `Prix`, `Nombre_place`, `ID_conducteur`, `Description`) VALUES
(4, 'R', 19, 16, '2016-05-15', '2016-05-15', '18h00', '22h30', 100, 0, 3, NULL),
(6, 'R', 19, 16, '2016-05-15', '2016-05-15', '18h00', '22h30', 100, 4, 3, NULL),
(8, 'A', 19, 16, '2016-05-15', '0000-00-00', '15h00', '', 100, 2, 2, NULL),
(10, 'A', 19, 16, '2016-05-15', '0000-00-00', '16h0', '', 100, 3, 10, ''),
(11, 'A', 19, 16, '2016-05-15', '0000-00-00', '16h0', '', 100, 3, 10, 'je fais ce trajet toujours '),
(13, 'R', 4, 10, '2016-05-29', '2016-05-30', '08h00', '08h00', 1000, 3, 4, NULL),
(14, 'A', 6, 16, '2016-05-27', '2016-05-29', '07h00', NULL, 2000, 3, 7, NULL),
(15, 'A', 13, 11, '2016-05-31', NULL, '12h00', NULL, 200, 3, 4, NULL),
(16, 'A', 19, 16, '2016-05-20', '0000-00-00', '15h20', '', 100, 2, 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE IF NOT EXISTS `ville` (
  `Num_Ville` int(5) NOT NULL,
  `Nom_Ville` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`Num_Ville`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`Num_Ville`, `Nom_Ville`) VALUES
(1, 'Adrar'),
(2, 'Chlef'),
(3, 'Lagouat'),
(4, 'Oum El Bouaghi'),
(5, 'Batna'),
(6, 'Béjaia'),
(7, 'Biskra'),
(8, 'Béchar'),
(9, 'Blida'),
(10, 'Bouira'),
(11, 'Tamanrasset'),
(12, 'Tébessa'),
(13, 'Tlemcen'),
(14, 'Tiaret'),
(15, 'Tizi Ouzou'),
(16, 'Alger'),
(17, 'Djelfa'),
(18, 'Jijel'),
(19, 'Sétif'),
(20, 'Saida'),
(21, 'Skikda'),
(22, 'Sidi Bel Abbes'),
(23, 'Annaba'),
(24, 'Guelma'),
(25, 'Constantine'),
(26, 'Médéa'),
(27, 'Mostaganem'),
(28, 'M''Sila'),
(29, 'Mascara'),
(30, 'Ouargla'),
(31, 'Oran'),
(32, 'Bayadh'),
(33, 'Illizi'),
(34, 'Bordj Bou Arreridj'),
(35, 'Boumerdès'),
(36, 'El Tarf'),
(37, 'Tindouf'),
(38, 'Tissemsilt'),
(39, 'El Oued'),
(40, 'Khenchela'),
(41, 'Souk Ahras'),
(42, 'Tipaza'),
(43, 'Mila'),
(44, 'Ain Defla'),
(45, 'Naâma'),
(46, 'Ain Témouchent'),
(47, 'Ghardaia'),
(48, 'Relizane');

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

CREATE TABLE IF NOT EXISTS `voiture` (
  `Num_immatriculation` int(20) NOT NULL,
  `Marque` varchar(30) NOT NULL,
  `Annee` year(4) NOT NULL,
  `Kilometrage` float NOT NULL,
  `Nb_place` int(2) NOT NULL,
  `Couleur` varchar(20) NOT NULL,
  `ID_conducteur` int(10) NOT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Num_immatriculation`),
  KEY `fk_conducteur1` (`ID_conducteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `voiture`
--

INSERT INTO `voiture` (`Num_immatriculation`, `Marque`, `Annee`, `Kilometrage`, `Nb_place`, `Couleur`, `ID_conducteur`, `Photo`) VALUES
(3212345, 'Polo', 2015, 300000, 5, 'Noir', 1, 'car.png'),
(33322344, 'Atos', 2015, 70000, 4, 'Bleu', 10, NULL),
(33333223, '208', 2015, 300000, 5, 'Blanc', 7, NULL),
(45543266, 'Golf', 2014, 150000, 5, 'gris', 4, NULL),
(322456643, 'Polo', 2015, 50000, 4, 'Blanc', 3, NULL),
(333223443, 'Polo', 2015, 300000, 5, 'Noir', 8, NULL),
(344556775, 'QQ', 2012, 50000, 5, 'Bleu', 2, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_conducteur2` FOREIGN KEY (`ID_Conducteur`) REFERENCES `conducteur` (`ID_conducteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_conducteur3` FOREIGN KEY (`ID_conducteur`) REFERENCES `conducteur` (`ID_conducteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_participant` FOREIGN KEY (`ID_participant`) REFERENCES `participant` (`ID_participant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_trajet` FOREIGN KEY (`Num_trajet`) REFERENCES `trajet` (`Num_Trajet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_id_participant` FOREIGN KEY (`ID_participant`) REFERENCES `participant` (`ID_participant`),
  ADD CONSTRAINT `fk_num_trajet` FOREIGN KEY (`Num_trajet`) REFERENCES `trajet` (`Num_Trajet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `fk_conducteur` FOREIGN KEY (`ID_conducteur`) REFERENCES `conducteur` (`ID_conducteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ville1` FOREIGN KEY (`Num_Ville1`) REFERENCES `ville` (`Num_Ville`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ville2` FOREIGN KEY (`Num_Ville2`) REFERENCES `ville` (`Num_Ville`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD CONSTRAINT `fk_conducteur1` FOREIGN KEY (`ID_conducteur`) REFERENCES `conducteur` (`ID_conducteur`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
