-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 19 Novembre 2024 à 12:18
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `run`
--

-- --------------------------------------------------------

--
-- Structure de la table `entrainement`
--

CREATE TABLE `entrainement` (
  `id_entrainement` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `categorie` int(11) NOT NULL,
  `date_et_heure` datetime NOT NULL,
  `nombre_max_de_participants` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `entrainement`
--

INSERT INTO `entrainement` (`id_entrainement`, `nom`, `description`, `categorie`, `date_et_heure`, `nombre_max_de_participants`, `photo`) VALUES
(1, 'a', 'a', 0, '2024-11-21 11:46:00', 5, '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_membre` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `statut` enum('membre','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_membre`, `nom`, `prenom`, `email`, `password`, `statut`) VALUES
(5, 'seppou sauvalle', 'tanouchka kyria', 'sauvalle.seppou@groupe-esigelec.org', '$2y$10$sskDo5895iXnh39n.i3KyeTqMa9YM5sfntQMIrPJj/R8ijGY5oFsO', 'admin'),
(6, 'moustapha', 'mokhtar', 'mokhtar@groupe-esigelec.org', '$2y$10$X03nUqYKqcMYXjgcRqjjRe1hDOSi6ooT6Yg7j1QbYS7Iu1Y99wX8.', 'membre'),
(7, 'moustapha', 'mokhtar', 'mokhtar@groupe-esigelec.org', '$2y$10$UoGiyao8dLISyAssPkzVb.gwwDDfpYUjEKHH04fDHJp9LzCot46KO', 'membre');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `entrainement`
--
ALTER TABLE `entrainement`
  ADD PRIMARY KEY (`id_entrainement`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_membre`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `entrainement`
--
ALTER TABLE `entrainement`
  MODIFY `id_entrainement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
