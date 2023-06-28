-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : mar. 27 juin 2023 à 09:47
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `studentscard`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `classe_prof`
--

DROP TABLE IF EXISTS `classe_prof`;
CREATE TABLE IF NOT EXISTS `classe_prof` (
  `classe_id` int NOT NULL,
  `prof_id` int NOT NULL,
  PRIMARY KEY (`classe_id`,`prof_id`),
  KEY `IDX_45A9055D8F5EA509` (`classe_id`),
  KEY `IDX_45A9055DABC1F7FE` (`prof_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230622161300', '2023-06-27 08:15:52', 1087);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int NOT NULL AUTO_INCREMENT,
  `classe_id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naissance` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ECA105F78F5EA509` (`classe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `eleve_interro`
--

DROP TABLE IF EXISTS `eleve_interro`;
CREATE TABLE IF NOT EXISTS `eleve_interro` (
  `eleve_id` int NOT NULL,
  `interro_id` int NOT NULL,
  PRIMARY KEY (`eleve_id`,`interro_id`),
  KEY `IDX_CADD19C3A6CC7B2` (`eleve_id`),
  KEY `IDX_CADD19C394F005C0` (`interro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `interro`
--

DROP TABLE IF EXISTS `interro`;
CREATE TABLE IF NOT EXISTS `interro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `matiere_id` int NOT NULL,
  `libelle_interro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` decimal(4,2) NOT NULL,
  `coefficient` decimal(3,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_266722DFF46CD258` (`matiere_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `interro_eleve`
--

DROP TABLE IF EXISTS `interro_eleve`;
CREATE TABLE IF NOT EXISTS `interro_eleve` (
  `interro_id` int NOT NULL,
  `eleve_id` int NOT NULL,
  PRIMARY KEY (`interro_id`,`eleve_id`),
  KEY `IDX_A4C1CE1D94F005C0` (`interro_id`),
  KEY `IDX_A4C1CE1DA6CC7B2` (`eleve_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matiere_interro`
--

DROP TABLE IF EXISTS `matiere_interro`;
CREATE TABLE IF NOT EXISTS `matiere_interro` (
  `matiere_id` int NOT NULL,
  `interro_id` int NOT NULL,
  PRIMARY KEY (`matiere_id`,`interro_id`),
  KEY `IDX_4541AD23F46CD258` (`matiere_id`),
  KEY `IDX_4541AD2394F005C0` (`interro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matiere_prof`
--

DROP TABLE IF EXISTS `matiere_prof`;
CREATE TABLE IF NOT EXISTS `matiere_prof` (
  `matiere_id` int NOT NULL,
  `prof_id` int NOT NULL,
  PRIMARY KEY (`matiere_id`,`prof_id`),
  KEY `IDX_2868F6E5F46CD258` (`matiere_id`),
  KEY `IDX_2868F6E5ABC1F7FE` (`prof_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prof`
--

DROP TABLE IF EXISTS `prof`;
CREATE TABLE IF NOT EXISTS `prof` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_prof` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prof_classe`
--

DROP TABLE IF EXISTS `prof_classe`;
CREATE TABLE IF NOT EXISTS `prof_classe` (
  `prof_id` int NOT NULL,
  `classe_id` int NOT NULL,
  PRIMARY KEY (`prof_id`,`classe_id`),
  KEY `IDX_199FD698ABC1F7FE` (`prof_id`),
  KEY `IDX_199FD6988F5EA509` (`classe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prof_matiere`
--

DROP TABLE IF EXISTS `prof_matiere`;
CREATE TABLE IF NOT EXISTS `prof_matiere` (
  `prof_id` int NOT NULL,
  `matiere_id` int NOT NULL,
  PRIMARY KEY (`prof_id`,`matiere_id`),
  KEY `IDX_773A6224ABC1F7FE` (`prof_id`),
  KEY `IDX_773A6224F46CD258` (`matiere_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe_prof`
--
ALTER TABLE `classe_prof`
  ADD CONSTRAINT `FK_45A9055D8F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_45A9055DABC1F7FE` FOREIGN KEY (`prof_id`) REFERENCES `prof` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `FK_ECA105F78F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`);

--
-- Contraintes pour la table `eleve_interro`
--
ALTER TABLE `eleve_interro`
  ADD CONSTRAINT `FK_CADD19C394F005C0` FOREIGN KEY (`interro_id`) REFERENCES `interro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CADD19C3A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `interro`
--
ALTER TABLE `interro`
  ADD CONSTRAINT `FK_266722DFF46CD258` FOREIGN KEY (`matiere_id`) REFERENCES `matiere` (`id`);

--
-- Contraintes pour la table `interro_eleve`
--
ALTER TABLE `interro_eleve`
  ADD CONSTRAINT `FK_A4C1CE1D94F005C0` FOREIGN KEY (`interro_id`) REFERENCES `interro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A4C1CE1DA6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `matiere_interro`
--
ALTER TABLE `matiere_interro`
  ADD CONSTRAINT `FK_4541AD2394F005C0` FOREIGN KEY (`interro_id`) REFERENCES `interro` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4541AD23F46CD258` FOREIGN KEY (`matiere_id`) REFERENCES `matiere` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `matiere_prof`
--
ALTER TABLE `matiere_prof`
  ADD CONSTRAINT `FK_2868F6E5ABC1F7FE` FOREIGN KEY (`prof_id`) REFERENCES `prof` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2868F6E5F46CD258` FOREIGN KEY (`matiere_id`) REFERENCES `matiere` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `prof_classe`
--
ALTER TABLE `prof_classe`
  ADD CONSTRAINT `FK_199FD6988F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_199FD698ABC1F7FE` FOREIGN KEY (`prof_id`) REFERENCES `prof` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `prof_matiere`
--
ALTER TABLE `prof_matiere`
  ADD CONSTRAINT `FK_773A6224ABC1F7FE` FOREIGN KEY (`prof_id`) REFERENCES `prof` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_773A6224F46CD258` FOREIGN KEY (`matiere_id`) REFERENCES `matiere` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
