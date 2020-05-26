-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 26 mai 2020 à 10:34
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ShareEventTogether`
--
CREATE DATABASE IF NOT EXISTS `ShareEventTogether` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ShareEventTogether`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_evenements`
--

DROP TABLE IF EXISTS `categorie_evenements`;
CREATE TABLE `categorie_evenements` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie_evenements`
--

INSERT INTO `categorie_evenements` (`id_categorie`, `nom_categorie`) VALUES
(1, 'plein air'),
(2, 'jeux de société'),
(3, 'tourisme'),
(4, 'soirée');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE `evenements` (
  `id_evenement` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date_poste` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL,
  `date_evenement` datetime NOT NULL,
  `titre_evenement` varchar(250) NOT NULL,
  `id_karma` int(11) DEFAULT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id_evenement`, `id_utilisateur`, `date_poste`, `description`, `date_evenement`, `titre_evenement`, `id_karma`, `lieu`, `id_categorie`) VALUES
(8, 2, '2020-04-29 14:58:15', 'je donne des cours de maths pour les nuls', '2020-05-16 10:00:00', 'cours de maths', NULL, 'Paris', NULL),
(10, 3, '2020-04-29 15:36:22', 'cours de CUISINE POUR JOJO', '2020-12-24 09:00:00', 'cours de CUISINE', NULL, 'BORDEAUX', NULL),
(12, 2, '2020-04-29 16:40:54', 'pot de depart pour romain et marie', '2020-09-10 20:00:00', 'pot de depart de romain', NULL, 'Toulouse', 4),
(16, 10, '2020-04-30 10:19:06', 'cours de samba trop bien', '2020-04-30 15:00:00', 'cours de samba POUR LES CHIEN', 25, 'Asnieres-sur-oise', NULL),
(17, 10, '2020-04-30 10:58:40', 'cours passé', '2020-04-30 11:04:00', 'Cours passé', NULL, 'Asnieres-sur-oise', NULL),
(18, 2, '2020-04-30 12:07:59', 'COURS DE SAMBA', '2020-04-30 12:09:00', 'cours de samba', NULL, 'Asnieres-sur-oise', NULL),
(19, 11, '2020-04-30 13:52:46', 'cours avec anga', '2020-05-08 16:00:00', 'Cours de code pour nul', 22, 'Pontoise', NULL),
(20, 12, '2020-04-30 20:56:14', 'petit concert de mon groupe à luzarches au café Lutecia le 15 juillet à 20h00 ! \r\nvenez nombreux !', '2020-07-15 20:00:00', 'Concert', NULL, 'Lutecia Luzarches', NULL),
(21, 10, '2020-05-03 16:58:55', 'l\'utilisateur ne doit pas pouvoir s\'inscrire', '2020-05-20 15:00:00', 'Nouveau cours', NULL, 'Dijon', NULL),
(22, 10, '2020-05-06 17:00:28', 'Apres midi jeux de société a cergy', '2020-06-07 15:00:00', 'Aprem jeux de société', 4, 'Cergy', 2),
(23, 10, '2020-05-21 11:04:01', 'soiree', '2020-05-21 11:05:00', 'soiree', 19, 'paris', 4),
(24, 10, '2020-05-25 09:27:15', 'tour de la ville de tours', '2020-10-01 10:00:00', 'tour de la ville', NULL, 'Tours', 3),
(25, 3, '2020-05-25 10:31:14', 'yoga en plein air', '2020-05-25 10:33:00', 'yoga', 23, 'BORDEAUX', 1),
(26, 13, '2020-05-25 10:48:38', 'soiree bellote à marseille', '2020-05-28 21:00:00', 'bellote', NULL, 'MARSEILLE', 4),
(27, 10, '2020-05-25 14:40:21', 'promenade chiens dans viarmes', '2020-05-25 14:42:00', 'promenade de chien', 26, 'viarmes', 1),
(28, 13, '2020-05-25 14:57:55', 'jouer aux sims c\'est cool', '2020-05-31 15:00:00', 'Les sims 4', NULL, 'Angers', 2);

-- --------------------------------------------------------

--
-- Structure de la table `inscription_evenements`
--

DROP TABLE IF EXISTS `inscription_evenements`;
CREATE TABLE `inscription_evenements` (
  `id_inscription` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `inscription_evenements`
--

INSERT INTO `inscription_evenements` (`id_inscription`, `id_utilisateur`, `id_evenement`) VALUES
(31, 10, 12),
(33, 10, 17),
(35, 2, 18),
(40, 11, 18),
(41, 12, 16),
(42, 12, 12),
(43, 2, 19),
(44, 2, 10),
(45, 2, 10),
(46, 10, 20),
(47, 2, 23),
(48, 12, 25),
(51, 12, 26),
(52, 12, 24),
(54, 13, 27),
(55, 12, 28);

-- --------------------------------------------------------

--
-- Structure de la table `karma`
--

DROP TABLE IF EXISTS `karma`;
CREATE TABLE `karma` (
  `id_karma` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `karma`
--

INSERT INTO `karma` (`id_karma`, `id_utilisateur`, `note`) VALUES
(1, 10, 8),
(2, 10, 8),
(3, 2, 3),
(4, 2, 10),
(6, 2, 10),
(7, 10, 10),
(8, 10, 10),
(9, 10, 7),
(10, 10, 7),
(11, 11, 10),
(19, 10, 6),
(22, 11, 8),
(23, 3, 8),
(24, 13, 5),
(25, 10, 7),
(26, 10, 7);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `message` text NOT NULL,
  `id_sujet` int(11) NOT NULL,
  `date_message` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `id_utilisateur`, `message`, `id_sujet`, `date_message`) VALUES
(3, 10, 'j\'aime les velos', 4, '2020-05-26 08:19:20'),
(4, 12, 'moi j\'aime pas', 4, '2020-05-26 08:29:20'),
(7, 12, 'test', 4, '2020-05-26 08:39:20'),
(8, 12, ' Entrez votre messatestge', 4, '2020-05-26 08:49:20'),
(9, 2, 'coucou', 4, '2020-05-26 08:59:20'),
(10, 2, 'YO', 4, '2020-05-26 09:19:20'),
(11, 2, ' Entrez votre message', 4, '2020-05-26 10:19:20'),
(12, 2, 'zaeaze', 4, '2020-05-26 11:19:20'),
(13, 2, 'prions', 4, '2020-05-26 12:19:20'),
(14, 2, 'zaeazee', 4, '2020-05-26 13:19:20'),
(15, 2, ' Entre', 4, '2020-05-26 14:19:20'),
(16, 2, 'esperons', 4, '2020-05-26 15:19:20'),
(17, 2, 'message', 4, '2020-05-26 10:32:10'),
(18, 2, 'strval rip', 4, '2020-05-26 10:32:50');

-- --------------------------------------------------------

--
-- Structure de la table `photo_utilisateurs`
--

DROP TABLE IF EXISTS `photo_utilisateurs`;
CREATE TABLE `photo_utilisateurs` (
  `id_photo` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `photo_utilisateurs`
--

INSERT INTO `photo_utilisateurs` (`id_photo`, `id_utilisateur`, `url`) VALUES
(14, 2, '../assets/photoProfil/homme.jpg'),
(17, 12, '../assets/photoProfil/femme.jpg'),
(20, 3, '../assets/photoProfil/femme.jpg'),
(21, 13, '../assets/photoProfil/homme.jpg'),
(22, 10, '../assets/photoProfil/femme_2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `sujets_forum`
--

DROP TABLE IF EXISTS `sujets_forum`;
CREATE TABLE `sujets_forum` (
  `id_sujet` int(11) NOT NULL,
  `nom_sujet` varchar(100) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sujets_forum`
--

INSERT INTO `sujets_forum` (`id_sujet`, `nom_sujet`, `id_utilisateur`) VALUES
(4, 'velo', 10);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `date_naissance` date NOT NULL,
  `adresse` varchar(250) NOT NULL,
  `code_postale` int(5) NOT NULL,
  `pays` varchar(100) NOT NULL,
  `telephone` int(10) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `type_utilisateur` varchar(50) NOT NULL,
  `ville` varchar(200) NOT NULL,
  `date_creation_utilisateur` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `date_naissance`, `adresse`, `code_postale`, `pays`, `telephone`, `mail`, `pseudo`, `mot_de_passe`, `type_utilisateur`, `ville`, `date_creation_utilisateur`) VALUES
(2, 'Jonathan', 'Debailleux', '1997-06-21', '2 place de paris', 95000, 'France', 987654321, 'jojo.debailleux@gmail.com', 'jojo', 'JOJO', 'professionnel', 'Pontoise', '2020-04-07 00:00:00'),
(3, 'Marie', 'Tchydemian', '1998-08-06', 'rue de la gare', 95270, 'France', 1357908642, 'marie.tdm@gmail.com', 'marie.tdm', 'MARIE', 'particulier', 'Viarmes', '2020-04-17 00:00:00'),
(10, 'sarah', 'Hayat', '1997-09-15', '49Bis Grande rue', 95270, 'France', 770139965, 'saraahyt@gmail.com', 'sarah', 'SARAH', 'professionnel', 'Asnieres-sur-oise', '2020-04-30 10:03:31'),
(11, 'Anga', 'Anga', '1992-03-03', '2 rue de beaumont', 95000, 'France', 1234565678, 'anga@gmail.com', 'Anga', 'ANGA', 'professionnel', 'Pontoise', '2020-04-30 13:52:03'),
(12, 'Léna', 'Pancher', '1997-08-04', 'lenapancher@gmail.com', 95270, 'France', 987654321, 'lenapancher@gmail.com', 'lena', 'LENA', 'particulier', 'Asnieres-sur-oise', '2020-04-30 20:54:22'),
(13, 'William', 'Andrieu', '1999-02-04', '25 rue du douare', 95570, 'France', 987659856, 'william.andrieu@live.fr', 'william', 'william', 'particulier', 'Villaines', '2020-05-25 10:46:45');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie_evenements`
--
ALTER TABLE `categorie_evenements`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id_evenement`),
  ADD KEY `evenements_ibfk_1` (`id_utilisateur`);

--
-- Index pour la table `inscription_evenements`
--
ALTER TABLE `inscription_evenements`
  ADD PRIMARY KEY (`id_inscription`),
  ADD KEY `inscription_evenements_ibfk_1` (`id_utilisateur`);

--
-- Index pour la table `karma`
--
ALTER TABLE `karma`
  ADD PRIMARY KEY (`id_karma`),
  ADD KEY `karma_ibfk_1` (`id_utilisateur`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_sujet` (`id_sujet`);

--
-- Index pour la table `photo_utilisateurs`
--
ALTER TABLE `photo_utilisateurs`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `foreign_key_user_photo` (`id_utilisateur`);

--
-- Index pour la table `sujets_forum`
--
ALTER TABLE `sujets_forum`
  ADD PRIMARY KEY (`id_sujet`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie_evenements`
--
ALTER TABLE `categorie_evenements`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `inscription_evenements`
--
ALTER TABLE `inscription_evenements`
  MODIFY `id_inscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `karma`
--
ALTER TABLE `karma`
  MODIFY `id_karma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `photo_utilisateurs`
--
ALTER TABLE `photo_utilisateurs`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `sujets_forum`
--
ALTER TABLE `sujets_forum`
  MODIFY `id_sujet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `inscription_evenements`
--
ALTER TABLE `inscription_evenements`
  ADD CONSTRAINT `inscription_evenements_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `karma`
--
ALTER TABLE `karma`
  ADD CONSTRAINT `karma_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`id_sujet`) REFERENCES `sujets_forum` (`id_sujet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `photo_utilisateurs`
--
ALTER TABLE `photo_utilisateurs`
  ADD CONSTRAINT `foreign_key_user_photo` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sujets_forum`
--
ALTER TABLE `sujets_forum`
  ADD CONSTRAINT `sujets_forum_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
