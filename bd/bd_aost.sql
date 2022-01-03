-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 03 jan. 2022 à 00:40
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_aost`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` binary(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Table des administrateurs de la plateforme';

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `role`, `name`, `added_at`) VALUES
(1, 'dimcompte@gmail.com', 0x0000000000000000000000000000000000000000, 'super', 'Ego Buster', '2021-12-29 03:58:01');

-- --------------------------------------------------------

--
-- Structure de la table `alerts`
--

DROP TABLE IF EXISTS `alerts`;
CREATE TABLE IF NOT EXISTS `alerts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_city` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `domain` longtext NOT NULL,
  `name` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `about` longtext,
  `cv_file` varchar(255) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_city` (`id_city`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `candidacy`
--

DROP TABLE IF EXISTS `candidacy`;
CREATE TABLE IF NOT EXISTS `candidacy` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_offer` bigint(20) NOT NULL,
  `id_subdomain` bigint(20) NOT NULL,
  `city` varchar(100) DEFAULT NULL COMMENT 'Ville du postulant',
  `name` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `domains` varchar(200) DEFAULT NULL,
  `about` longtext,
  `cv_file` varchar(255) DEFAULT NULL,
  `motivation_file` varchar(255) DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0' COMMENT 'Vaudra 1 si supprimé par un admin',
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_job` (`id_offer`),
  KEY `fk_subdomain` (`id_subdomain`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table contenant les candidatures des clients';

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`id`, `name`, `added_at`) VALUES
(1, 'Quebec', '2021-12-29 04:08:01'),
(2, 'Montreal', '2021-12-29 04:11:18');

-- --------------------------------------------------------

--
-- Structure de la table `compagny`
--

DROP TABLE IF EXISTS `compagny`;
CREATE TABLE IF NOT EXISTS `compagny` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) NOT NULL,
  `id_domain` bigint(20) NOT NULL,
  `other_domain` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `fk_domain_1` (`id_domain`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table contenant les entreprises';

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL COMMENT 'Type du contact (sécrétaire etc...)',
  `email` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT 'Nom de la personne',
  `phone` varchar(50) DEFAULT NULL,
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table des differentes sortes de contact de la plateforme';

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_1` varchar(30) DEFAULT NULL,
  `phone_2` varchar(30) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL COMMENT 'Prénom',
  `date_birth` date DEFAULT NULL COMMENT 'Date de naissance',
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL COMMENT 'Quartier (numero de rue etc...)',
  `sex` varchar(20) DEFAULT NULL,
  `about` longtext COMMENT 'A savoir sur l''utilisateur (sera visible par les admins)',
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table qui regroupe les personnes pouvant postuler pour un job';

-- --------------------------------------------------------

--
-- Structure de la table `domains`
--

DROP TABLE IF EXISTS `domains`;
CREATE TABLE IF NOT EXISTS `domains` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_admin` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_admin` (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `domains`
--

INSERT INTO `domains` (`id`, `id_admin`, `name`, `color`, `image`, `added_at`) VALUES
(1, 1, 'Informatique', '85a7e1', 'dom2', '2021-12-11 23:23:43'),
(2, 1, 'Commerce de detail & de gros', 'fa1254', '', '2021-12-13 17:48:16'),
(4, 1, 'Ressources humaines', '', '', '2021-12-13 17:48:16'),
(5, 1, 'Marketing', '', '', '2021-12-13 17:48:16'),
(6, 1, 'Administration', '', '', '2021-12-13 17:48:16'),
(7, 1, 'Construction et metiers specialises', '', '', '2021-12-13 17:48:16'),
(8, 1, 'Finances et comptabilite', '', '', '2021-12-13 17:48:16'),
(9, 1, 'Assurances', '', '', '2021-12-13 17:48:16'),
(10, 1, 'Sante', '', 'dom2', '2021-12-13 17:48:16'),
(11, 1, 'Travail general', '', '', '2021-12-13 17:48:16'),
(12, 1, 'Entretien menager', '', '', '2021-12-13 17:48:16'),
(13, 1, 'Administration', '', '', '2021-12-13 17:48:16'),
(14, 1, 'Service a la clientele', '', '', '2021-12-13 17:48:16'),
(15, 1, 'Transport & Logistique', '', '', '2021-12-13 17:48:16'),
(16, 1, 'education', '', '', '2021-12-13 17:48:16'),
(17, 1, 'Securite', '', '', '2021-12-13 17:48:16'),
(18, 1, 'Hotellerie, restauration, evenements speciaux', '', '', '2021-12-13 17:48:16'),
(19, 1, 'Pharmaceutique', '', '', '2021-12-13 17:48:16'),
(3, 1, 'Soutien aux familles ', '', '', '2021-12-13 17:48:16');

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_admin` bigint(20) NOT NULL COMMENT 'id de l''administrateur qui a effectué l''action',
  `id_target` bigint(20) NOT NULL COMMENT 'id de l''objet (client, entreprise, offre, candidature, contact) concerné',
  `action` varchar(50) NOT NULL COMMENT 'type d''action effectuée (bloquer compte, suppression offre, ajout contact etc...)',
  `description` longtext NOT NULL COMMENT 'texte à afficher (ex: Donald a supprimé une offre)',
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_admin` (`id_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table qui concervera l''ensemble des actions effectuées par les administrateurs';

-- --------------------------------------------------------

--
-- Structure de la table `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE IF NOT EXISTS `offers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_admin` bigint(20) NOT NULL,
  `id_subdomain` bigint(20) NOT NULL,
  `id_city` bigint(20) NOT NULL,
  `compagny` varchar(100) NOT NULL,
  `description` longtext COMMENT 'Description globale de la demande',
  `missions` longtext COMMENT 'description détaillée (par mission) de la demande',
  `skill` longtext COMMENT 'compétences requises du postulant',
  `candidate_profile` longtext COMMENT 'Informations requises du postulant (age, annee d''experience, caractere etc...)',
  `cv` int(1) NOT NULL DEFAULT '0' COMMENT 'vaudra 1 si un CV est requit pour postuler',
  `motivation` int(1) NOT NULL DEFAULT '0' COMMENT 'Vaudra 1 si une lettre de motivation est requise pour postuler',
  `deleted` int(2) NOT NULL DEFAULT '0' COMMENT 'Vaudra 1 si supprimé par un admin (restera présente dans un onglet archives ou corbeille)',
  `expired` int(2) NOT NULL DEFAULT '0' COMMENT 'vaudra 1 si déjà expiré',
  `deadline` datetime NOT NULL COMMENT 'Date limite',
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_city` (`id_city`),
  KEY `fk_subdomain` (`id_subdomain`),
  KEY `fk_admin` (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Table qui contient les differentes offres';

--
-- Déchargement des données de la table `offers`
--

INSERT INTO `offers` (`id`, `id_admin`, `id_subdomain`, `id_city`, `compagny`, `description`, `missions`, `skill`, `candidate_profile`, `cv`, `motivation`, `deleted`, `expired`, `deadline`, `added_at`) VALUES
(1, 1, 21, 2, 'Black-Sarl', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 0, 0, 0, '2021-12-22 00:00:00', '2021-12-29 04:24:51'),
(3, 1, 21, 1, 'DNK-Sarl', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0, 0, 0, 0, '2021-12-13 00:00:00', '2021-12-29 16:40:32');

-- --------------------------------------------------------

--
-- Structure de la table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `compagny` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `compagny_type` varchar(200) NOT NULL,
  `person` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `fax_phone` varchar(30) DEFAULT NULL,
  `need` longtext NOT NULL,
  `deleted` int(1) DEFAULT '0',
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `subdomains`
--

DROP TABLE IF EXISTS `subdomains`;
CREATE TABLE IF NOT EXISTS `subdomains` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_admin` bigint(20) NOT NULL,
  `id_domain` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `color` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_domain` (`id_domain`),
  KEY `fk_admin` (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `subdomains`
--

INSERT INTO `subdomains` (`id`, `id_admin`, `id_domain`, `name`, `color`, `image`, `added_at`) VALUES
(2, 1, 2, 'commis entrepot', 'e1e6ff', 'dom.jpg', '2021-12-13 17:53:37'),
(3, 1, 2, 'coordonnateur marchandisage', 'e1e6ff', 'dom.jpg', '2021-12-13 17:53:37'),
(4, 1, 2, 'gerant de magasin', 'e1e6ff', 'dom.jpg', '2021-12-13 17:53:37'),
(5, 1, 2, 'assistant gerant', 'e1e6ff', 'dom.jpg', '2021-12-13 17:53:37'),
(6, 1, 2, 'analyste', 'e1e6ff', 'dom.jpg', '2021-12-13 17:53:37'),
(7, 1, 2, 'formation et developpement- concepteur de contenu', 'e1e6ff', 'dom.jpg', '2021-12-13 17:53:37'),
(8, 1, 2, 'chef d’equipe', 'e1e6ff', 'dom.jpg', '2021-12-13 17:53:37'),
(9, 1, 2, 'gestionnaire des ventes', 'e1e6ff', 'dom.jpg', '2021-12-13 17:53:37'),
(10, 1, 2, 'chauffeurs', 'e1e6ff', 'dom.jpg', '2021-12-13 17:53:37'),
(11, 1, 2, 'manutentionnaire', 'e1e6ff', 'dom.jpg', '2021-12-13 17:53:37'),
(12, 1, 1, 'Developpeur', 'e1e6ff', 'dom.jpg', '2021-12-13 17:56:00'),
(13, 1, 1, 'Administrateur de base de donnees', 'e1e6ff', 'dom.jpg', '2021-12-13 17:58:43'),
(14, 1, 1, 'Administrateur de reseaux', 'e1e6ff', 'dom.jpg', '2021-12-13 17:58:43'),
(15, 1, 1, 'Administrateur de systemes', 'e1e6ff', 'dom.jpg', '2021-12-13 17:58:43'),
(16, 1, 1, 'Analyste de contenu', 'e1e6ff', 'dom.jpg', '2021-12-13 17:58:43'),
(17, 1, 1, 'Technicien Reseaux Niveau', 'e1e6ff', 'dom.jpg', '2021-12-13 17:58:43'),
(18, 1, 1, 'Responsable de Projet TI', 'e1e6ff', 'dom.jpg', '2021-12-13 17:58:43'),
(19, 1, 1, 'Analyste de donnees', 'e1e6ff', 'dom.jpg', '2021-12-13 17:58:43'),
(20, 1, 1, 'Analyste en securite TI', 'e1e6ff', 'dom.jpg', '2021-12-13 17:58:43'),
(21, 1, 1, 'Analyste fonctionnel', 'e1e6ff', 'dom.jpg', '2021-12-13 17:58:43'),
(22, 1, 1, 'Analyste en assurance-qualite', 'e1e6ff', 'dom.jpg', '2021-12-13 17:58:43'),
(23, 1, 1, 'soutien technique informatique', 'e1e6ff', 'dom.jpg', '2021-12-13 17:58:43'),
(24, 1, 4, 'coordonnateur des RH', 'e1e6ff', 'dom.jpg', '2021-12-13 18:00:40'),
(25, 1, 4, 'generaliste des RH', 'e1e6ff', 'dom.jpg', '2021-12-13 18:00:40'),
(26, 1, 4, 'gestionnaire RH', 'e1e6ff', 'dom.jpg', '2021-12-13 18:00:40'),
(27, 1, 4, 'recruteur du personnel', 'e1e6ff', 'dom.jpg', '2021-12-13 18:00:40'),
(28, 1, 4, 'adjoint des RH', 'e1e6ff', 'dom.jpg', '2021-12-13 18:00:40'),
(29, 1, 5, 'technicien(ne) marketing', 'e1e6ff', 'dom.jpg', '2021-12-13 18:03:12'),
(30, 1, 5, 'specialiste des medias et des evenements', 'e1e6ff', 'dom.jpg', '2021-12-13 18:03:12'),
(31, 1, 5, 'coordonnateur(trice) marketing', 'e1e6ff', 'dom.jpg', '2021-12-13 18:03:12'),
(32, 1, 5, 'coordinateur des services aux clients', 'e1e6ff', 'dom.jpg', '2021-12-13 18:03:12'),
(33, 1, 5, 'reception et developpement', 'e1e6ff', 'dom.jpg', '2021-12-13 18:03:12'),
(34, 1, 5, 'conseiller(ere)', 'e1e6ff', 'dom.jpg', '2021-12-13 18:03:12'),
(35, 1, 5, 'marketing et communication', 'e1e6ff', 'dom.jpg', '2021-12-13 18:03:12');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` binary(20) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `blocked` int(2) NOT NULL DEFAULT '0' COMMENT 'vaudra 1 si il a été bloqué par un admin',
  `token_checked` varchar(255) DEFAULT NULL COMMENT 'Token de vérification de l''email',
  `verified_at` datetime DEFAULT NULL COMMENT 'date de vérification du compte',
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table contenant tous les utilisateurs (client / entreprise) de la plateforme (hors mis les admins)';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
