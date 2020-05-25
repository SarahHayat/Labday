-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 25 mai 2020 à 10:26
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `ShareEventTogether`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_evenements`
--

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
(8, 2, '2020-04-29 14:58:15', 'je donne des cours de maths pour les nuls', '2020-05-16 10:00:00', 'cours de maths', NULL, 'Paris', NULL),
(10, 3, '2020-04-29 15:36:22', 'cours de CUISINE POUR JOJO', '2020-12-24 09:00:00', 'cours de CUISINE', NULL, 'BORDEAUX', NULL),
(12, 2, '2020-04-29 16:40:54', 'pot de depart pour romain et marie', '2020-09-10 20:00:00', 'pot de depart de romain', NULL, 'Toulouse', 4),
(16, 10, '2020-04-30 10:19:06', 'cours de samba trop bien', '2020-04-30 15:00:00', 'cours de samba POUR LES CHIEN', NULL, 'Asnieres-sur-oise', NULL),
(17, 10, '2020-04-30 10:58:40', 'cours passé', '2020-04-30 11:04:00', 'Cours passé', NULL, 'Asnieres-sur-oise', NULL),
(18, 2, '2020-04-30 12:07:59', 'COURS DE SAMBA', '2020-04-30 12:09:00', 'cours de samba', NULL, 'Asnieres-sur-oise', NULL),
(19, 11, '2020-04-30 13:52:46', 'cours avec anga', '2020-05-08 16:00:00', 'Cours de code pour nul', 22, 'Pontoise', NULL),
(20, 12, '2020-04-30 20:56:14', 'petit concert de mon groupe à luzarches au café Lutecia le 15 juillet à 20h00 ! \r\nvenez nombreux !', '2020-07-15 20:00:00', 'Concert', NULL, 'Lutecia Luzarches', NULL),
(21, 10, '2020-05-03 16:58:55', 'l\'utilisateur ne doit pas pouvoir s\'inscrire', '2020-05-20 15:00:00', 'Nouveau cours', NULL, 'Dijon', NULL),
(22, 10, '2020-05-06 17:00:28', 'Apres midi jeux de société a cergy', '2020-06-07 15:00:00', 'Aprem jeux de société', 4, 'Cergy', 2),
(23, 10, '2020-05-21 11:04:01', 'soiree', '2020-05-21 11:05:00', 'soiree', 19, 'paris', 4),
(24, 10, '2020-05-25 09:27:15', 'tour de la ville de tours', '2020-10-01 10:00:00', 'tour de la ville', NULL, 'Tours', 3);

-- --------------------------------------------------------

--
-- Structure de la table `inscription_evenements`
--

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
(47, 2, 23);

-- --------------------------------------------------------

--
-- Structure de la table `karma`
--

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
(22, 11, 8);

-- --------------------------------------------------------

--
-- Structure de la table `photo_utilisateurs`
--

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
(19, 10, '../assets/photoProfil/femme.jpg'),
(20, 3, '../assets/photoProfil/femme.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

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
  `date_creation_utilisateur` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `date_naissance`, `adresse`, `code_postale`, `pays`, `telephone`, `mail`, `pseudo`, `mot_de_passe`, `type_utilisateur`, `ville`, `date_creation_utilisateur`) VALUES
(2, 'Jonathan', 'Debailleux', '1997-06-21', '2 place de paris', 95000, 'France', 987654321, 'jojo.debailleux@gmail.com', 'jojo', 'JOJO', 'professionnel', 'Pontoise', '2020-04-07 00:00:00'),
(3, 'Marie', 'Tchydemian', '1998-08-06', 'rue de la gare', 95270, 'France', 1357908642, 'marie.tdm@gmail.com', 'marie.tdm', 'MARIE', 'particulier', 'Viarmes', '2020-04-17 00:00:00'),
(10, 'sarah', 'Hayat', '1997-09-15', '49Bis Grande rue', 95270, 'France', 770139965, 'saraahyt@gmail.com', 'sarah', 'SARAH', 'professionnel', 'Asnieres-sur-oise', '2020-04-30 10:03:31'),
(11, 'Anga', 'Anga', '1992-03-03', '2 rue de beaumont', 95000, 'France', 1234565678, 'anga@gmail.com', 'Anga', 'ANGA', 'professionnel', 'Pontoise', '2020-04-30 13:52:03'),
(12, 'Léna', 'Pancher', '1997-08-04', 'lenapancher@gmail.com', 95270, 'France', 987654321, 'lenapancher@gmail.com', 'lena', 'LENA', 'professionnel', 'Asnieres-sur-oise', '2020-04-30 20:54:22');

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
-- Index pour la table `photo_utilisateurs`
--
ALTER TABLE `photo_utilisateurs`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `foreign_key_user_photo` (`id_utilisateur`);

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
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `inscription_evenements`
--
ALTER TABLE `inscription_evenements`
  MODIFY `id_inscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `karma`
--
ALTER TABLE `karma`
  MODIFY `id_karma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `photo_utilisateurs`
--
ALTER TABLE `photo_utilisateurs`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- Contraintes pour la table `photo_utilisateurs`
--
ALTER TABLE `photo_utilisateurs`
  ADD CONSTRAINT `foreign_key_user_photo` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
