-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 oct. 2022 à 06:51
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `libelle` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `ordre` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `titre`, `libelle`, `date_creation`, `ordre`) VALUES
(1, 'HTML', 'html', '2022-09-27 07:58:48', 0),
(2, 'CSS', 'css', '2022-09-27 07:58:48', 0),
(3, 'PHP', 'php', '2022-09-27 07:58:48', 0);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `contenu` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modification` datetime NOT NULL,
  `id_post` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`id`, `titre`, `contenu`, `date_creation`, `date_modification`, `id_post`, `id_utilisateur`) VALUES
(1, 'Mon premier topic', 'Bonjour,\r\n\r\nVoici mon premier topic !\r\n\r\nIl est le premier d\'une longue liste', '2022-09-26 08:29:41', '2022-09-27 08:29:41', 1, 1),
(2, 'Mon deuxième topic', 'Bonjour,\r\n\r\nVoici mon deuxième topic.\r\n\r\nIl est le second et l\'un des plus beaux.', '2022-09-26 08:29:41', '2022-09-27 08:29:41', 1, 1),
(3, 'Mon troisième topic', 'Bonjour,\r\n\r\nVoici mon troisième topic.\r\n\r\nComme on dit, jamais deux sans trois.', '2022-09-27 08:29:41', '2022-09-27 08:29:41', 2, 1),
(4, 'Mon quatrième topic', 'Bonjour ,\r\n\r\nCeci est mon quatrième topic.\r\n\r\nIl est magnifique.', '2022-10-02 12:20:33', '2022-10-02 12:20:33', 3, 1),
(7, 'Test', 'test\r\n\r\ntest\r\n\r\ntest', '2022-10-04 16:49:47', '2022-10-04 16:49:47', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pword` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_connexion` datetime NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `mail`, `pword`, `date_creation`, `date_connexion`, `role`) VALUES
(1, 'Chasseloup', 'Axel', 'axel.chasseloup@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$Zi5Yem9RMmNzRGR1UUl5Ng$CUeWOq7zaWhmHsCjggcTEUp3TQEEq+uKUoiKV2wfoR4', '2022-09-23 18:35:32', '2022-10-04 16:48:15', 1),
(2, 'Rossi', 'Adalberto', 'AdalbertoRossi@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$NFhoNVFyNi5HWjgyTDN6Tw$yAMSCyuQZCz9MGDcsTNc4SLL0DR5EY+3QEb4DAFO8b4', '2022-09-23 08:25:13', '2022-09-23 08:25:13', 0),
(3, 'Lanoie', 'Delphine', 'DelphineLanoie@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$Z1haZ2xRLk9ONElsNHBMVg$lsY/Y1peY28evrdrdHaX3ba6ohh47IsAFK8SV8houO0', '2022-09-23 08:26:39', '2022-09-23 08:26:39', 0),
(4, 'Caouette', 'Gérard', 'GerardCaouette@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$LmlKMXJBLnd0dVI4S1FpZQ$+cnG2HVCRC/GbcfBJLYjWHiVgs+MxyDRvLONFSR9+uw', '2022-09-23 08:27:27', '2022-09-23 08:27:27', 0),
(5, 'Bordeaux', 'Lirienne', 'LirienneBordeaux@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$RGZuLkhWYVp5cjdWU2l5dg$pv3laK9KktuE0KDwMs8Le4d+YHZJzXWXMtEfezqOseE', '2022-09-23 08:28:05', '2022-09-23 08:28:05', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
