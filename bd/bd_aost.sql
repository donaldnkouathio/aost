-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 11 déc. 2021 à 12:49
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table des administrateurs de la plateforme';

-- --------------------------------------------------------

--
-- Structure de la table `candidacy`
--

DROP TABLE IF EXISTS `candidacy`;
CREATE TABLE IF NOT EXISTS `candidacy` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_offer` bigint(20) NOT NULL,
  `id_customer` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_domain` bigint(11) NOT NULL,
  `cv_file` varchar(255) DEFAULT NULL,
  `motivation_file` varchar(255) DEFAULT NULL,
  `deleted` int(2) NOT NULL DEFAULT '0' COMMENT 'Vaudra 1 si supprimé par un admin',
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_job` (`id_offer`),
  KEY `id_customer` (`id_customer`),
  KEY `id_user` (`id_user`),
  KEY `fk_domain` (`id_domain`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table contenant les candidatures des clients';

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `id_compagny` bigint(20) NOT NULL COMMENT 'id de l''entreprise qui publie l''offre',
  `id_user` bigint(20) NOT NULL COMMENT 'id de l''utilisateur qui publie l''offre',
  `id_domain` bigint(20) NOT NULL,
  `profession` varchar(100) NOT NULL COMMENT 'Poste demandé',
  `City` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext COMMENT 'Description globale de la demande',
  `missions` longtext COMMENT 'description détaillée (par mission) de la demande',
  `skill` longtext COMMENT 'compétences requises du postulant',
  `candidate_profile` longtext COMMENT 'Informations requises du postulant (age, annee d''experience, caractere etc...)',
  `cv` int(1) NOT NULL DEFAULT '0' COMMENT 'vaudra 1 si un CV est requit pour postuler',
  `motivation` int(1) NOT NULL DEFAULT '0' COMMENT 'Vaudra 1 si une lettre de motivation est requise pour postuler',
  `validated` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0' COMMENT 'Vaudra 1 si supprimé par un admin (restera présente dans un onglet archives ou corbeille)',
  `expired` int(2) NOT NULL DEFAULT '0' COMMENT 'vaudra 1 si déjà expiré',
  `deadline` datetime NOT NULL COMMENT 'Date limite',
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_compagny` (`id_compagny`),
  KEY `fk_domain` (`id_domain`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table qui contient les differentes offres';

-- --------------------------------------------------------

--
-- Structure de la table `subdomains`
--

DROP TABLE IF EXISTS `subdomains`;
CREATE TABLE IF NOT EXISTS `subdomains` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_domain` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_domain` (`id_domain`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
