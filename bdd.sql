-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 04 juin 2020 à 11:45
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `ShareEventTogether`
--
CREATE DATABASE IF NOT EXISTS `ShareEventTogether` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
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
  `date_poste` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
(8, 2, '2020-04-29 14:58:15', 'je donne des cours de maths pour les nuls', '2020-05-16 10:00:00', 'cours de maths', NULL, 'Paris', 1),
(10, 3, '2020-04-29 15:36:22', 'cours de CUISINE POUR JOJO', '2020-12-24 09:00:00', 'cours de CUISINE', NULL, 'BORDEAUX', NULL),
(12, 2, '2020-04-29 16:40:54', 'pot de depart pour romain et marie', '2020-09-10 20:00:00', 'pot de depart de romain', NULL, 'Toulouse', 4),
(16, 10, '2020-04-30 10:19:06', 'cours de samba trop bien', '2020-04-30 15:00:00', 'cours de samba POUR LES CHIEN', 25, 'Asnieres-sur-oise', NULL),
(17, 10, '2020-04-30 10:58:40', 'cours passé', '2020-04-30 11:04:00', 'Cours passé', NULL, 'Asnieres-sur-oise', NULL),
(18, 2, '2020-04-30 12:07:59', 'COURS DE SAMBA', '2020-04-30 12:09:00', 'cours de samba', NULL, 'Asnieres-sur-oise', NULL),
(21, 10, '2020-05-03 16:58:55', 'l\'utilisateur ne doit pas pouvoir s\'inscrire', '2020-05-20 15:00:00', 'Nouveau cours', NULL, 'Dijon', NULL),
(22, 10, '2020-05-06 17:00:28', 'Apres midi jeux de société a cergy', '2020-06-07 15:00:00', 'Aprem jeux de société', 4, 'Cergy', 2),
(23, 10, '2020-05-21 11:04:01', 'soiree', '2020-05-21 11:05:00', 'soiree', 19, 'paris', 4),
(24, 10, '2020-05-25 09:27:15', 'tour de la ville de tours', '2020-10-01 10:00:00', 'tour de la ville', NULL, 'Tours', 3),
(25, 3, '2020-05-25 10:31:14', 'yoga en plein air', '2020-05-25 10:33:00', 'yoga', 23, 'BORDEAUX', 1),
(27, 10, '2020-05-25 14:40:21', 'promenade chiens dans viarmes c\'est cool !!', '2020-05-25 14:42:00', 'promenade de chien', 26, 'viarmes', 1),
(29, 15, '2020-05-27 20:00:32', 'Bonjour, venez participer à mon jeu de sarbacane pour mon anniversaire ! Tout le monde est le bienvenue, plus on est de fou, plus on rit ! (n\'oubliez pas de m\'apporter un cadeau merciiii)', '2020-08-04 14:00:00', 'jeu de sarbacane ', NULL, 'paris', 1),
(31, 10, '2020-05-29 11:10:11', 'soiree mousse a paris', '2020-05-29 12:06:00', 'soiree mousse', NULL, 'paris', 4),
(32, 10, '2020-05-29 11:29:00', 'pique nique ', '2020-05-29 21:00:00', 'pique nique', NULL, 'parmain', 1),
(33, 10, '2020-05-29 14:35:40', 'football', '2020-05-30 15:00:00', 'football', NULL, 'belgique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE `favoris` (
  `id_favoris` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id_favoris`, `id_utilisateur`, `id_evenement`) VALUES
(66, 3, 22),
(67, 3, 22),
(68, 3, 12);

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
(43, 2, 19),
(44, 2, 10),
(45, 2, 10),
(46, 10, 20),
(47, 2, 23),
(56, 10, 26),
(57, 15, 26),
(58, 15, 22),
(59, 2, 31),
(60, 2, 32),
(61, 10, 29),
(62, 15, 31),
(63, 15, 32);

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
(19, 10, 6),
(23, 3, 8),
(25, 10, 7),
(26, 10, 7),
(27, 14, 5),
(28, 15, 5),
(30, 2, 5),
(31, 2, 5),
(32, 2, 5),
(33, 2, 5),
(34, 10, 8),
(40, 32, 5),
(41, 10, 1);

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
  `date_message` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `id_utilisateur`, `message`, `id_sujet`, `date_message`) VALUES
(3, 10, 'j\'aime les velos', 4, '2020-05-26 08:19:20'),
(9, 2, 'coucou', 4, '2020-05-26 08:59:20'),
(10, 2, 'YO', 4, '2020-05-26 09:19:20'),
(11, 2, ' Entrez votre message', 4, '2020-05-26 10:19:20'),
(12, 2, 'zaeaze', 4, '2020-05-26 11:19:20'),
(13, 2, 'prions', 4, '2020-05-26 12:19:20'),
(14, 2, 'zaeazee', 4, '2020-05-26 13:19:20'),
(15, 2, ' Entre', 4, '2020-05-26 14:19:20'),
(16, 2, 'esperons', 4, '2020-05-26 15:19:20'),
(17, 2, 'message', 4, '2020-05-26 10:32:10'),
(18, 2, 'strval rip', 4, '2020-05-26 10:32:50'),
(19, 2, 'Ceci est un test', 5, '2020-05-26 08:38:33'),
(20, 2, 'first', 5, '2020-05-26 11:02:35'),
(26, 2, 'ça marche !', 4, '2020-05-26 14:49:49'),
(27, 15, ' est-tu un mange mort ? ', 6, '2020-05-27 20:03:20'),
(28, 15, 'es*', 6, '2020-05-27 20:03:41'),
(29, 15, 'j\'aime les pédales des vélos ', 4, '2020-05-27 20:06:37'),
(30, 10, 'oui', 6, '2020-05-29 11:44:23'),
(31, 10, 'j\'aime le code', 7, '2020-05-29 11:44:37');

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
(20, 3, '../assets/photoProfil/femme.jpg'),
(30, 10, '../assets/photoProfil/femme.jpg'),
(31, 15, '../assets/photoProfil/homme_2.jpg');

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
(4, 'velo', 10),
(5, 'Test', 2),
(6, 'harry potter', 15),
(7, 'coding', 10);

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
  `date_creation_utilisateur` datetime DEFAULT CURRENT_TIMESTAMP,
  `karma` decimal(4,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `date_naissance`, `adresse`, `code_postale`, `pays`, `telephone`, `mail`, `pseudo`, `mot_de_passe`, `type_utilisateur`, `ville`, `date_creation_utilisateur`, `karma`) VALUES
(2, 'Jonathan', 'Debailleux', '1997-06-21', '2 place de paris', 95000, 'France', 987654321, 'jojo.debailleux@gmail.com', 'jojo', 'JOJO', 'particulier', 'Pontoise', '2020-04-07 00:00:00', '6.00'),
(3, 'Marie', 'Tchydemian', '1998-08-06', 'rue de la gare', 95270, 'France', 1357908642, 'marie.tdm@gmail.com', 'marie.tdm', 'MARIE', 'particulier', 'Viarmes', '2020-04-17 00:00:00', '8.00'),
(10, 'sarah', 'Hayat', '1997-09-15', '49Bis Grande rue', 95270, 'France', 770139965, 'saraahyt@gmail.com', 'sarah', 'SARAH', 'particulier', 'Asnieres-sur-oise', '2020-04-30 10:03:31', '7.18'),
(14, 'jonathan', 'Debailleux', '1997-11-08', '19 rue des vendanges prochaines', 95800, 'France', 777373735, 'jonathan.debailleux@edu.itescia.fr', 'jonathan', 'JOJO', 'particulier', 'CORMEILLES EN PARISIS', '2020-05-26 14:15:21', '0.00'),
(15, 'Léna', 'Pancher', '1997-08-04', '49 bis grande rue', 95270, 'France', 648314973, 'lenapancher@gmail.com', 'lenouch', 'coucou', 'particulier', 'Asnières-sur-Oise', '2020-05-27 19:43:40', '5.00'),
(32, 'test', 'test', '2018-12-02', 'test', 55555, 'Afghanistan', 987654321, 'test@test.com', 'test', 'test', 'particulier', 'test', '2020-05-31 15:35:35', '5.00');

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
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id_favoris`),
  ADD KEY `favoris` (`id_utilisateur`);

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
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

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
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id_favoris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `inscription_evenements`
--
ALTER TABLE `inscription_evenements`
  MODIFY `id_inscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `karma`
--
ALTER TABLE `karma`
  MODIFY `id_karma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `photo_utilisateurs`
--
ALTER TABLE `photo_utilisateurs`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `sujets_forum`
--
ALTER TABLE `sujets_forum`
  MODIFY `id_sujet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

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
