-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 16 Juin 2024 à 17:03
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `sae23`
--

-- --------------------------------------------------------

--
-- Structure de la table `Administration`
--

CREATE TABLE IF NOT EXISTS `Administration` (
  `login` varchar(10) NOT NULL,
  `mot de passe` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Administration`
--

INSERT INTO `Administration` (`login`, `mot de passe`) VALUES
('root', 'passroot');

-- --------------------------------------------------------

--
-- Structure de la table `Batiment`
--

CREATE TABLE IF NOT EXISTS `Batiment` (
  `identifiant_bat` varchar(1) NOT NULL,
  `nom` varchar(15) NOT NULL,
  `login_gest` varchar(15) NOT NULL,
  `mdp_gest` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Batiment`
--

INSERT INTO `Batiment` (`identifiant_bat`, `nom`, `login_gest`, `mdp_gest`) VALUES
('B', 'B', 'Gest_B', 'default'),
('C', 'C', 'Gest_C', 'default'),
('E', 'E', 'Gest_E', 'default');

-- --------------------------------------------------------

--
-- Structure de la table `Capteur`
--

CREATE TABLE IF NOT EXISTS `Capteur` (
  `nom_capteur` varchar(10) NOT NULL,
  `type` varchar(15) NOT NULL,
  `unite` varchar(5) NOT NULL,
  `nom_salle` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Capteur`
--

INSERT INTO `Capteur` (`nom_capteur`, `type`, `unite`, `nom_salle`) VALUES
('AM107-3', 'temperature', '°C', 'B113'),
('AM107-35', 'co2', 'ppm', 'E007'),
('AM107-47', 'illumination_ty', 'lux', 'E001'),
('AM107-7', 'humidity', '%', 'C002');

-- --------------------------------------------------------

--
-- Structure de la table `Mesure`
--

CREATE TABLE IF NOT EXISTS `Mesure` (
`identifiant` int(11) NOT NULL,
  `date` date NOT NULL,
  `horaire` time NOT NULL,
  `valeur` float NOT NULL,
  `nom_capteur` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9134 ;

--
-- Contenu de la table `Mesure`
--

INSERT INTO `Mesure` (`identifiant`, `date`, `horaire`, `valeur`, `nom_capteur`) VALUES
(9126, '2024-06-15', '17:33:00', 23.2, 'AM107-3'),
(9127, '2024-06-15', '17:33:01', 54, 'AM107-7'),
(9128, '2024-06-15', '17:34:31', 396, 'AM107-35'),
(9129, '2024-06-15', '17:34:39', 33, 'AM107-47'),
(9130, '2024-06-15', '17:54:32', 23.6, 'AM107-3'),
(9131, '2024-06-15', '17:54:39', 48, 'AM107-7'),
(9132, '2024-06-15', '17:55:01', 417, 'AM107-35'),
(9133, '2024-06-15', '17:55:02', 82, 'AM107-47');

-- --------------------------------------------------------

--
-- Structure de la table `Salle`
--

CREATE TABLE IF NOT EXISTS `Salle` (
  `nom_salle` varchar(10) NOT NULL,
  `type` varchar(15) NOT NULL,
  `capacité` int(11) NOT NULL,
  `identifiant_bat` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Salle`
--

INSERT INTO `Salle` (`nom_salle`, `type`, `capacité`, `identifiant_bat`) VALUES
('B112', '------', 0, 'B'),
('B113', '------', 0, 'B'),
('C002', '------', 0, 'C'),
('E001', '------', 0, 'E'),
('E007', '------', 0, 'E');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Batiment`
--
ALTER TABLE `Batiment`
 ADD PRIMARY KEY (`identifiant_bat`);

--
-- Index pour la table `Capteur`
--
ALTER TABLE `Capteur`
 ADD PRIMARY KEY (`nom_capteur`), ADD KEY `nom_salle` (`nom_salle`);

--
-- Index pour la table `Mesure`
--
ALTER TABLE `Mesure`
 ADD PRIMARY KEY (`identifiant`), ADD KEY `nom_capteur` (`nom_capteur`);

--
-- Index pour la table `Salle`
--
ALTER TABLE `Salle`
 ADD PRIMARY KEY (`nom_salle`), ADD KEY `identifiant_bat` (`identifiant_bat`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Mesure`
--
ALTER TABLE `Mesure`
MODIFY `identifiant` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9134;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Capteur`
--
ALTER TABLE `Capteur`
ADD CONSTRAINT `Capteur_ibfk_1` FOREIGN KEY (`nom_salle`) REFERENCES `Salle` (`nom_salle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Mesure`
--
ALTER TABLE `Mesure`
ADD CONSTRAINT `Mesure_ibfk_1` FOREIGN KEY (`nom_capteur`) REFERENCES `Capteur` (`nom_capteur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Salle`
--
ALTER TABLE `Salle`
ADD CONSTRAINT `Salle_ibfk_1` FOREIGN KEY (`identifiant_bat`) REFERENCES `Batiment` (`identifiant_bat`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
