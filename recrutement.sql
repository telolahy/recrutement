-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 27 mars 2024 à 08:34
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `recrutement`
--

-- --------------------------------------------------------

--
-- Structure de la table `accesoffres`
--

DROP TABLE IF EXISTS `accesoffres`;
CREATE TABLE IF NOT EXISTS `accesoffres` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `offre_id` int NOT NULL,
  `administrateur_id` int NOT NULL,
  `etat` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `administrateur_id` (`administrateur_id`),
  KEY `offre_id` (`offre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `accesoffres`
--

INSERT INTO `accesoffres` (`id`, `offre_id`, `administrateur_id`, `etat`) VALUES
(1, 1, 4, 'Active'),
(2, 6, 4, 'Descative'),
(3, 6, 5, 'Descative'),
(4, 7, 5, 'Descative'),
(5, 12, 4, 'Active'),
(6, 13, 4, 'Active');

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `poste_id` bigint UNSIGNED DEFAULT NULL,
  `direction_id` bigint UNSIGNED DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `administrateurs_role_id_foreign` (`role_id`),
  KEY `administrateurs_poste_id_foreign` (`poste_id`),
  KEY `administrateurs_direction_id_foreign` (`direction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `nom`, `prenom`, `email`, `password`, `role_id`, `poste_id`, `direction_id`, `status`) VALUES
(1, 'Nambinintsoa', 'andry', 'nambinintsoaandry@gmail.com', '$2y$10$RGa.EtWi7tbT9YUwR9iCBexbViZ3qskXCfjxmiEIMUFC7qbd6.9zK', 1, 2, 1, 'Active'),
(2, 'Rasoa', 'Nomena', 'service1@gmail.com', '$2y$10$7I4Bb1s69H7LKq5IYtiMj.PJOgLPrfYUQXmRud1vCuC3XYp4S6VH2', 1, 2, 1, 'Desactive'),
(3, 'Ratsaraefadahy', 'Narindra Sarobidy', 'narindra@gmail.com', '$2y$10$dxmUvNJMtf4oHFEdYo7TrewLqOdlTO430nOK3FNsR1c3fp.w3zk.m', 1, 1, 1, 'Active'),
(4, 'Rakotonarivo', 'Ravaka', 'ravaka@gmail.com', '$2y$10$RGa.EtWi7tbT9YUwR9iCBexbViZ3qskXCfjxmiEIMUFC7qbd6.9zK', 2, 1, 1, 'Active'),
(5, 'Rasoa', 'Narindra', 'coll@gmail.com', '$2y$10$VVZFyhZiMJjZgekQ7bB1ROvGFkF87nD5mfVrPzdLkVfbI3ZqXd/GS', 3, 2, 1, 'Active'),
(6, 'Rabe', 'Niony', 'serv@gmail.com', '$2y$10$gi304HoWzCV4rALsN54OhOLR/ubmWxJnccfodpQKIALrhhNwMrG0K', 3, 2, 1, 'Active'),
(7, 'Rajeriny', 'Sed', 'ad@gmail.com', '$2y$10$QzhpsMlSvHM5FKSN6Jskn.l08hefSx9rGDrzePIZLYAvpl3iTpol.', 2, 1, 1, 'Active');

-- --------------------------------------------------------

--
-- Structure de la table `directions`
--

DROP TABLE IF EXISTS `directions`;
CREATE TABLE IF NOT EXISTS `directions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomDirection` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `directions`
--

INSERT INTO `directions` (`id`, `nomDirection`) VALUES
(1, 'DSIC'),
(2, 'DFRS');

-- --------------------------------------------------------

--
-- Structure de la table `enqueteurs`
--

DROP TABLE IF EXISTS `enqueteurs`;
CREATE TABLE IF NOT EXISTS `enqueteurs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `motdepasse` varchar(250) NOT NULL,
  `dateNaissance` date NOT NULL,
  `photo` varchar(250) NOT NULL,
  `diplomes` varchar(250) NOT NULL,
  `experiences` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
--
-- Déchargement des données de la table `enqueteurs`
--

INSERT INTO `enqueteurs` (`id`, `nom`, `prenom`, `email`, `motdepasse`, `dateNaissance`, `photo`, `diplomes`, `experiences`) VALUES
(1, 'Ratsaraefadahy', 'Narindra sarobidy', 'sarobidy@gmail.com', '$2y$10$Egm1AqbZFAx2OPAn2Oaxaeyuu1JJd3Poj2FkGHh7EI1eAaoyUQMOS', '2022-10-28', '2022101514435.jpg', '-Bacc\r\n-Licence', 'dgggfrhgf'),
(2, 'Randrianantenaina', 'Elysa', 'elysa@gmail.com', '$2y$10$0vWUhrLToQhhYj41pzrD3.IugGKzh9ozhz.GKTiDm9vzJjctLnWCC', '1995-01-27', 'agent2.jpg', '- Bacc,\r\n- Licences', NULL),
(3, 'Rasoarinandrianina', 'Sitraka', 'sitraka@gmail.com', '$2y$10$sz/lxKEE7pxqB8NZCqLF6ejRuzSMD27A3RKylu36njfA24xYOkF6O', '2000-01-06', 'agent.jpg', 'LIcence,Master', '3 ans experiences'),
(4, 'NAMBININTSOA', 'Andry', 'nambinintsoaandry@gmail.com', '$2y$10$.nOWs6bbUfoR0fUOEFscJe1NLTcf6/9zbYLK6kFNMMMe9K3wslz3i', '2000-03-16', 'andrana.jpg', 'dea', 'enqueteur et chef d\'equipe');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_08_11_074545_create_postes_table', 1),
(3, '2022_08_11_074636_create_roles_table', 1),
(4, '2022_08_11_074745_create_directions_table', 1),
(5, '2022_08_23_090858_create_administrateurs_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

DROP TABLE IF EXISTS `offres`;
CREATE TABLE IF NOT EXISTS `offres` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomEnquete` varchar(250) NOT NULL,
  `detailsEnquete` text NOT NULL,
  `dateDebut` timestamp NULL DEFAULT NULL,
  `dateLimite` timestamp NULL DEFAULT NULL,
  `administrateur_id` int NOT NULL,
  `formulaire` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `statusOffres` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `administrateur_id` (`administrateur_id`)
) ;

--
-- Déchargement des données de la table `offres`
--

INSERT INTO `offres` (`id`, `nomEnquete`, `detailsEnquete`, `dateDebut`, `dateLimite`, `administrateur_id`, `formulaire`, `statusOffres`) VALUES
(13, 'Enquete EPM', '<p><font color=\"#ff9c00\">Enquete concernant le hfgfhgd</font><p><img style=\"width: 50%;\" data-filename=\"sfd.PNG\" src=\"http://127.0.0.1:8000/images/upload/6367deb7170c1.png\"><font color=\"#ff9c00\"><br></font></p></p>\n', '2022-11-06 16:20:09', '2022-11-25 16:16:00', 3, '[{\"champs\":\"Nom\",\"type\":\"text\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"5\"},{\"champs\":\"Pr\\u00e9nom\",\"type\":\"text\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"5\"},{\"champs\":\"CV\",\"type\":\"file\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"5\"},{\"champs\":\"Adresse\",\"type\":\"text\",\"typechamps\":\"Non Obligatoire\",\"anneeExperience\":\"5\"},{\"champs\":\"Exp\\u00e9rience\",\"type\":\"number\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"5\"},{\"champs\":\"R\\u00e9gion\",\"type\":\"text\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"5\"},{\"champs\":\"LM\",\"type\":\"file\",\"typechamps\":\"Non Obligatoire\",\"anneeExperience\":\"5\"}]', 'publie'),
(11, 'enquete dgf', '<p>ddddddddddddd</p>\n', '2022-11-04 10:09:01', '2022-11-18 10:04:00', 3, '[{\"champs\":\"Nom\",\"type\":\"text\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"7\"},{\"champs\":\"Prenom\",\"type\":\"text\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"7\"},{\"champs\":\"Exp\\u00e9rience\",\"type\":\"number\",\"typechamps\":\"Non Obligatoire\",\"anneeExperience\":\"7\"},{\"champs\":\"R\\u00e9gion\",\"type\":\"text\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"7\"},{\"champs\":\"CV\",\"type\":\"file\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"7\"}]', 'publie'),
(12, 'enquete lll', '<p>vtttttttttt</p>\n', '2022-11-05 14:25:28', '2022-11-23 14:23:00', 3, '[{\"champs\":\"Nom\",\"type\":\"text\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"10\"},{\"champs\":\"Prenom\",\"type\":\"text\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"10\"},{\"champs\":\"R\\u00e9gion\",\"type\":\"text\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"10\"},{\"champs\":\"Exp\\u00e9rience\",\"type\":\"number\",\"typechamps\":\"Obligatoire\",\"anneeExperience\":\"10\"},{\"champs\":\"Adresse\",\"type\":\"text\",\"typechamps\":\"Non Obligatoire\",\"anneeExperience\":\"10\"}]', 'publie');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `postes`
--

DROP TABLE IF EXISTS `postes`;
CREATE TABLE IF NOT EXISTS `postes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomposte` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `postes`
--

INSERT INTO `postes` (`id`, `nomposte`) VALUES
(1, 'Directeur'),
(2, 'Chef de Service');

-- --------------------------------------------------------

--
-- Structure de la table `postuleoffres`
--

DROP TABLE IF EXISTS `postuleoffres`;
CREATE TABLE IF NOT EXISTS `postuleoffres` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `offre_id` int NOT NULL,
  `detailsEnqueteurs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `datepostule` timestamp NULL DEFAULT NULL,
  `enqueteur_id` int NOT NULL,
  `typeEnqueteurs` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enqueteur_id` (`enqueteur_id`),
  KEY `offre_id` (`offre_id`)
) ;

--
-- Déchargement des données de la table `postuleoffres`
--

INSERT INTO `postuleoffres` (`id`, `offre_id`, `detailsEnqueteurs`, `datepostule`, `enqueteur_id`, `typeEnqueteurs`) VALUES
(8, 7, '[{\"champs\":\"Nom\",\"valeur\":\"Rakotonarivo\",\"typefield\":\"text\"},{\"champs\":\"Pr\\u00e9nom\",\"valeur\":\"Saholy\",\"typefield\":\"text\"},{\"champs\":\"R\\u00e9gion\",\"valeur\":\"Analamanga\",\"typefield\":\"text\"},{\"champs\":\"Exp\\u00e9riences\",\"valeur\":\"gg\",\"typefield\":\"text\"}]', '2022-11-03 06:34:06', 3, 'Candidats potentiels'),
(9, 7, '[{\"champs\":\"Nom\",\"valeur\":\"pp\",\"typefield\":\"text\"},{\"champs\":\"Pr\\u00e9nom\",\"valeur\":\"g\",\"typefield\":\"text\"},{\"champs\":\"R\\u00e9gion\",\"valeur\":\"Analamanga\",\"typefield\":\"text\"},{\"champs\":\"Exp\\u00e9riences\",\"valeur\":null,\"typefield\":\"text\"}]', '2022-11-03 06:35:18', 1, 'Novice'),
(17, 12, '[{\"champs\":\"Nom\",\"valeur\":\"ddd\",\"typefield\":\"text\"},{\"champs\":\"Prenom\",\"valeur\":\"ddd\",\"typefield\":\"text\"},{\"champs\":\"R\\u00e9gion\",\"valeur\":\"Alaotra-Mangoro\",\"typefield\":\"text\"},{\"champs\":\"Exp\\u00e9rience\",\"valeur\":\"10\",\"typefield\":\"number\"},{\"champs\":\"Adresse\",\"valeur\":\"261 Ankadikely\",\"typefield\":\"text\"}]', '2022-11-05 14:31:04', 1, 'Moyen'),
(21, 13, '[{\"champs\":\"Nom\",\"valeur\":\"Rakoto\",\"typefield\":\"text\"},{\"champs\":\"Pr\\u00e9nom\",\"valeur\":\"Sitraka\",\"typefield\":\"text\"},{\"champs\":\"CV\",\"valeur\":\"728280FRENCH0W0Handbook0TR0020120FR (7).pdf\",\"typefield\":\"file\"},{\"champs\":\"Adresse\",\"valeur\":\"gggg\",\"typefield\":\"text\"},{\"champs\":\"Exp\\u00e9rience\",\"valeur\":\"4\",\"typefield\":\"number\"},{\"champs\":\"R\\u00e9gion\",\"valeur\":\"Betsiboka\",\"typefield\":\"text\"},{\"champs\":\"LM\",\"valeur\":\"CDI.pdf\",\"typefield\":\"file\"}]', '2022-11-06 17:07:02', 3, 'Novice'),
(19, 13, '[{\"champs\":\"Nom\",\"valeur\":\"Ratsaraefadahy\",\"typefield\":\"text\"},{\"champs\":\"Pr\\u00e9nom\",\"valeur\":\"Narindra Sarobidy\",\"typefield\":\"text\"},{\"champs\":\"CV\",\"valeur\":\"INSTAT_Organigramme.pdf\",\"typefield\":\"file\"},{\"champs\":\"Adresse\",\"valeur\":\"261 Ankadikely\",\"typefield\":\"text\"},{\"champs\":\"Exp\\u00e9rience\",\"valeur\":\"7\",\"typefield\":\"number\"},{\"champs\":\"R\\u00e9gion\",\"valeur\":\"Analanjirofo\",\"typefield\":\"text\"},{\"champs\":\"LM\",\"valeur\":\"Les-Cardinalites.pdf\",\"typefield\":\"file\"}]', '2022-11-06 16:51:49', 1, 'Moyen'),
(16, 11, '[{\"champs\":\"Nom\",\"valeur\":\"Rakotonarivo\",\"typefield\":\"text\"},{\"champs\":\"Prenom\",\"valeur\":\"ravaka\",\"typefield\":\"text\"},{\"champs\":\"Exp\\u00e9rience\",\"valeur\":\"2\",\"typefield\":\"number\"},{\"champs\":\"R\\u00e9gion\",\"valeur\":\"Bongolava\",\"typefield\":\"text\"},{\"champs\":\"CV\",\"valeur\":\"Etats_Analyses.pdf\",\"typefield\":\"file\"}]', '2022-11-05 13:22:48', 1, 'Novice');

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `nom`) VALUES
(1, 'Diana'),
(2, 'Sava'),
(3, 'Itasy'),
(4, 'Analamanga'),
(5, 'Vakinankaratra'),
(6, 'Bongolava'),
(7, 'Sofia'),
(8, 'Boeny'),
(9, 'Betsiboka'),
(10, 'Melaky'),
(11, 'Alaotra-Mangoro'),
(12, 'Atsinanana'),
(13, 'Analanjirofo'),
(14, 'Amoron i Mania'),
(15, 'Haute Matsiatra'),
(16, 'Vatovavy'),
(17, 'Fitovinany'),
(18, 'Atsimo-Atsinanana'),
(19, 'Ihorombe'),
(20, 'Menabe'),
(21, 'Atsimo-Andrefana'),
(22, 'Androy'),
(23, 'Anôsy');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomrole` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nomrole`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Collaborateurs');

-- --------------------------------------------------------

--
-- Structure de la table `typechamps`
--

DROP TABLE IF EXISTS `typechamps`;
CREATE TABLE IF NOT EXISTS `typechamps` (
  `id` int UNSIGNED NOT NULL,
  `nom` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `typechamps`
--

INSERT INTO `typechamps` (`id`, `nom`, `type`) VALUES
(1, 'texte', 'text'),
(2, 'image', 'image'),
(3, 'fichier', 'file'),
(4, 'nombre', 'number');

-- --------------------------------------------------------

--
-- Structure de la table `visiteurs`
--

DROP TABLE IF EXISTS `visiteurs`;
CREATE TABLE IF NOT EXISTS `visiteurs` (
  `id` int UNSIGNED NOT NULL,
  `offre_id` int NOT NULL,
  `nombreVisiteurs` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `offre_id` (`offre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `visiteurs`
--

INSERT INTO `visiteurs` (`id`, `offre_id`, `nombreVisiteurs`) VALUES
(1, 1, 49),
(2, 1, 18),
(3, 31, 1),
(4, 6, 2),
(5, 7, 16),
(6, 5, 16),
(7, 8, 6),
(8, 9, 2),
(9, 11, 15),
(10, 12, 5),
(11, 13, 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
