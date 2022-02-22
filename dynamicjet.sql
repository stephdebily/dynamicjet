-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 05 fév. 2021 à 09:34
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dynamicjet`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` int(15) NOT NULL,
  `datenaissance` date NOT NULL,
  `numpermiscotier` varchar(100) NOT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id_client`, `nom`, `prenom`, `adresse`, `telephone`, `datenaissance`, `numpermiscotier`) VALUES
(1, 'DUPONT', 'etdupont', 'Rue du Pont', 123456789, '2000-09-15', '1234'),
(2, 'DURAND', 'cetemps', 'Rue du manque de temps', 987654321, '2002-02-17', '45656785'),
(5, 'test', 'test', 'TESTTTTTTTTTT', 56778, '2021-02-19', '567'),
(7, 'testtttttt', 'testttttttttt', 'testt', 5767898, '2021-02-04', '4556'),
(8, 'testtt', 'testtt', 'testtt', 6543, '1978-10-27', 'NON');

-- --------------------------------------------------------

--
-- Structure de la table `dureelocation`
--

DROP TABLE IF EXISTS `dureelocation`;
CREATE TABLE IF NOT EXISTS `dureelocation` (
  `id_duree` int(11) NOT NULL AUTO_INCREMENT,
  `temps` time NOT NULL,
  PRIMARY KEY (`id_duree`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dureelocation`
--

INSERT INTO `dureelocation` (`id_duree`, `temps`) VALUES
(1, '00:30:00'),
(2, '01:00:00'),
(3, '02:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

DROP TABLE IF EXISTS `employes`;
CREATE TABLE IF NOT EXISTS `employes` (
  `id_employe` int(11) NOT NULL,
  `nom_employe` varchar(150) NOT NULL,
  `dateembauche_employe` date NOT NULL,
  `datevisitemedicale_employe` date DEFAULT NULL,
  `typecontrat_employe` varchar(50) NOT NULL,
  `permiscotier_employe` int(100) DEFAULT NULL,
  `poste_employe` varchar(100) NOT NULL,
  PRIMARY KEY (`id_employe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employes`
--

INSERT INTO `employes` (`id_employe`, `nom_employe`, `dateembauche_employe`, `datevisitemedicale_employe`, `typecontrat_employe`, `permiscotier_employe`, `poste_employe`) VALUES
(78765, 'TESTTT', '2020-12-12', '2020-12-12', 'CDD', 98765, 'TEST'),
(78999, 'TEST', '2020-12-01', '2020-12-01', 'CDD', 865454, 'Pilote Mastercraft'),
(1234567, 'ROMAIN', '2021-02-03', '2021-02-03', 'CDD', 1232344, 'MONITEUR DE JETSKI');

-- --------------------------------------------------------

--
-- Structure de la table `equipements`
--

DROP TABLE IF EXISTS `equipements`;
CREATE TABLE IF NOT EXISTS `equipements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `puissance` float NOT NULL,
  `etat` varchar(30) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipements`
--

INSERT INTO `equipements` (`id`, `nom`, `description`, `puissance`, `etat`, `image`) VALUES
(1, 'KAWASAKI STX 15F', 'KAWASAKI STX 15F', 200, 'BON ETAT', 'img1.jpeg'),
(2, 'See-Doo 4tec', 'See-Doo 4tec', 210, 'NEUF', 'img2.jpeg'),
(3, 'Yamaha Fx SHO', 'Yamaha Fx SHO', 220, 'TRES BON ETAT', 'img3.jpeg'),
(5, 'WAKEBOARD', 'WAKEBOARD tractÃ©e par bateau', 30, 'NEUF', 'img5.jpg'),
(9, 'BOUEE', 'TRACTEE PAR BATEAU', 202, 'TRES BON ETAT', 'img4.jpg'),
(11, 'SKI NAUTIQUE', 'SKI NAUTIQUE TRACTEE BAR BATEAU', 30, 'BON ETAT', ''),
(12, 'BATEAU MASTERCRAFT', 'BATEAU', 350, 'NEUF', 'mastercraft.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id_reza` int(11) NOT NULL AUTO_INCREMENT,
  `date_deb_reza` datetime NOT NULL,
  `date_fin_reza` datetime NOT NULL,
  `activite` varchar(100) NOT NULL,
  `client` int(11) NOT NULL,
  `employe` int(11) DEFAULT NULL,
  `equipement` int(11) NOT NULL,
  `tarif_reza` int(11) NOT NULL,
  PRIMARY KEY (`id_reza`),
  KEY `fk_idclient_clients` (`client`),
  KEY `fk_idequipement_equipements` (`equipement`),
  KEY `fk_idemploye_employes` (`employe`),
  KEY `fk_idtariflocation_tariflocation` (`tarif_reza`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id_reza`, `date_deb_reza`, `date_fin_reza`, `activite`, `client`, `employe`, `equipement`, `tarif_reza`) VALUES
(1, '2021-02-05 10:15:47', '2021-02-05 12:15:47', 'BOUEE', 1, 1234567, 9, 1),
(2, '2021-02-04 22:11:21', '2021-02-04 23:11:21', 'WAKEBOARD NOCTURNE', 2, 1234567, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tariflocation`
--

DROP TABLE IF EXISTS `tariflocation`;
CREATE TABLE IF NOT EXISTS `tariflocation` (
  `id_tarif` int(11) NOT NULL AUTO_INCREMENT,
  `tarifloc` int(11) NOT NULL,
  `equipement` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  PRIMARY KEY (`id_tarif`),
  KEY `fk_id_equipement_equipements` (`equipement`),
  KEY `fk_id_dureelocation_dureelocation` (`duree`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tariflocation`
--

INSERT INTO `tariflocation` (`id_tarif`, `tarifloc`, `equipement`, `duree`) VALUES
(1, 80, 1, 1),
(2, 130, 1, 2),
(3, 220, 1, 3),
(4, 70, 2, 1),
(5, 120, 2, 2),
(6, 200, 2, 3),
(7, 90, 3, 1),
(8, 140, 3, 2),
(9, 240, 3, 3),
(10, 40, 9, 1),
(11, 40, 5, 1),
(12, 40, 11, 1),
(13, 100, 12, 2),
(14, 180, 12, 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_idclient_clients` FOREIGN KEY (`client`) REFERENCES `clients` (`id_client`),
  ADD CONSTRAINT `fk_idemploye_employes` FOREIGN KEY (`employe`) REFERENCES `employes` (`id_employe`),
  ADD CONSTRAINT `fk_idequipement_equipements` FOREIGN KEY (`equipement`) REFERENCES `equipements` (`id`),
  ADD CONSTRAINT `fk_idtariflocation_tariflocation` FOREIGN KEY (`tarif_reza`) REFERENCES `tariflocation` (`id_tarif`);

--
-- Contraintes pour la table `tariflocation`
--
ALTER TABLE `tariflocation`
  ADD CONSTRAINT `fk_id_dureelocation_dureelocation` FOREIGN KEY (`duree`) REFERENCES `dureelocation` (`id_duree`),
  ADD CONSTRAINT `fk_id_equipement_equipements` FOREIGN KEY (`equipement`) REFERENCES `equipements` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
