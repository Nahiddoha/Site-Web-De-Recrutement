-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 16 mars 2023 à 00:13
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidatures`
--

CREATE TABLE `candidatures` (
  `id` int(4) NOT NULL,
  `offre_id` int(4) NOT NULL,
  `candidat_id` int(4) NOT NULL,
  `motivation` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `candidatures`
--

INSERT INTO `candidatures` (`id`, `offre_id`, `candidat_id`, `motivation`) VALUES
(1, 1, 1, 'up'),
(2, 1, 1, 'up'),
(3, 1, 1, 'up');

-- --------------------------------------------------------

--
-- Structure de la table `condidat`
--

CREATE TABLE `condidat` (
  `id_candidat` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `domaine` varchar(255) NOT NULL,
  `Sexe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `exigences` text NOT NULL,
  `recruteur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `offres`
--

INSERT INTO `offres` (`id`, `titre`, `description`, `exigences`, `recruteur_id`) VALUES
(1, 'Développeur Full Stack', 'Nous cherchons un développeur Full Stack pour rejoindre notre équipe', 'Expérience en PHP, JavaScript, HTML, CSS et frameworks comme Laravel ou Vue.js', 1),
(2, 'Chef de projet', 'Nous recherchons un chef de projet expérimenté pour gérer des projets complexes', 'Expérience en gestion de projets, leadership, communication et organisation', 2),
(3, 'Spécialiste en marketing numérique', 'Nous cherchons un spécialiste en marketing numérique pour optimiser notre présence en ligne', 'Expérience en SEO, SEM, PPC, réseaux sociaux et analyses de données', 3),
(4, 'Développeur mobile', 'Nous sommes à la recherche d\'un développeur mobile pour créer des applications iOS et Android', 'Expérience en développement natif ou hybride, connaissances des langages comme Swift, Kotlin et React Native', 3),
(6, 'dev', 'dev', 'dev', 2);

-- --------------------------------------------------------

--
-- Structure de la table `offre_emp`
--

CREATE TABLE `offre_emp` (
  `id_emp` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `domaine` varchar(255) DEFAULT NULL,
  `poste` varchar(255) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `mission` varchar(255) DEFAULT NULL,
  `requis` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id_recruteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `offre_emp`
--

INSERT INTO `offre_emp` (`id_emp`, `nom`, `domaine`, `poste`, `desc`, `mission`, `requis`, `email`, `id_recruteur`) VALUES
(0, '[value-2]', '[value-3]', '[value-4]', '[value-5]', '[value-6]', '[value-7]', '[value-8]', 1);

-- --------------------------------------------------------

--
-- Structure de la table `recruteur`
--

CREATE TABLE `recruteur` (
  `id_recruteur` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `fonctionnalite` varchar(255) DEFAULT NULL,
  `societe` varchar(255) DEFAULT NULL,
  `secteur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `recruteur`
--

INSERT INTO `recruteur` (`id_recruteur`, `nom`, `prenom`, `email`, `password`, `sex`, `fonctionnalite`, `societe`, `secteur`) VALUES
(1, 'tarik', 'ismail', 'ismailtarik@gamail.com', 'tarik2000', 'M', 'RH', 'rocka', 'Informatique'),
(9, 'Tarik', 'Ismail', 'tarikismail600@gmail.com', 'tttttt', 'M', 'deve', 'rocka', 'Informatique');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'user', 'user', 'candidat'),
(2, 'user1', 'user1', 'recreteur'),
(3, 'bilal', '$2y$10$CWoLlv5YCVjxR74N2O', 'recreteur'),
(4, 'nahid', '&é\"', 'candidat');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `candidatures`
--
ALTER TABLE `candidatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_candidat` (`candidat_id`),
  ADD KEY `FK_offres` (`offre_id`);

--
-- Index pour la table `condidat`
--
ALTER TABLE `condidat`
  ADD PRIMARY KEY (`id_candidat`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recruteur_id` (`recruteur_id`);

--
-- Index pour la table `offre_emp`
--
ALTER TABLE `offre_emp`
  ADD PRIMARY KEY (`id_emp`),
  ADD KEY `id_recruteur` (`id_emp`),
  ADD KEY `id_recruteur_2` (`id_recruteur`);

--
-- Index pour la table `recruteur`
--
ALTER TABLE `recruteur`
  ADD PRIMARY KEY (`id_recruteur`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `candidatures`
--
ALTER TABLE `candidatures`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `condidat`
--
ALTER TABLE `condidat`
  MODIFY `id_candidat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `recruteur`
--
ALTER TABLE `recruteur`
  MODIFY `id_recruteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidatures`
--
ALTER TABLE `candidatures`
  ADD CONSTRAINT `FK_candidat` FOREIGN KEY (`candidat_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_offres` FOREIGN KEY (`offre_id`) REFERENCES `offres` (`id`);

--
-- Contraintes pour la table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `offres_ibfk_1` FOREIGN KEY (`recruteur_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `offre_emp`
--
ALTER TABLE `offre_emp`
  ADD CONSTRAINT `offre_emp_ibfk_1` FOREIGN KEY (`id_recruteur`) REFERENCES `recruteur` (`id_recruteur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
