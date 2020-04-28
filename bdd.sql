-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 28 avr. 2020 à 14:44
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `ShareEventTogether`
--

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
  `lieu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id_evenement`, `id_utilisateur`, `date_poste`, `description`, `date_evenement`, `titre_evenement`, `id_karma`, `lieu`) VALUES
(1, 2, '2020-04-28 11:10:35', 'ksfjgbnodfbiq', '2020-06-04 00:00:00', 'titre 1', NULL, 'Pontoise'),
(2, 1, '2020-04-28 11:45:28', 'kihkvjkgbhjk', '2020-12-12 00:00:00', 'titre 2', NULL, 'hjgcvb'),
(3, 1, '2020-04-28 12:10:42', 'dhgbfv', '2020-07-07 00:00:00', 'titre 3', NULL, 'jhngbvc'),
(4, 3, '2020-04-28 14:34:06', 'TEST ', '2020-04-28 15:50:00', 'TEST', NULL, 'TEST');

-- --------------------------------------------------------

--
-- Structure de la table `inscription_evenements`
--

CREATE TABLE `inscription_evenements` (
  `id_inscription` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `karma`
--

CREATE TABLE `karma` (
  `id_karma` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'sarah', 'Hayat', '1997-09-15', '49Bis Grande rue', 95270, 'France', 1234567890, 'saraahyt@gmail.com', 'sarah.hayat', 'TEST', 'particulier', 'Asnieres-sur-oise', '2020-04-01 00:00:00'),
(2, 'Jonathan', 'Debailleux', '1997-06-21', '2 place de paris', 95000, 'France', 987654321, 'jojo.debailleux@gmail.com', 'jojo', 'JOJO', 'professionnel', 'Pontoise', '2020-04-07 00:00:00'),
(3, 'Marie', 'Tchydemian', '1998-08-06', 'rue de la gare', 95270, 'France', 1357908642, 'marie.tdm@gmail.com', 'marie.tdm', 'MARIE', 'particulier', 'Viarmes', '2020-04-17 00:00:00'),
(6, 'Florent', 'Debuchy', '1997-04-04', '1 rue de eaubonne', 95400, 'France', 1234567890, 'flo.debuchy@gmail.com', 'floflo', 'FLOFLO', 'professionnel', 'Eaubonne', '2020-04-28 09:54:43');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id_evenement`);

--
-- Index pour la table `karma`
--
ALTER TABLE `karma`
  ADD PRIMARY KEY (`id_karma`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `karma`
--
ALTER TABLE `karma`
  MODIFY `id_karma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
