-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 24 avr. 2018 à 06:57
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `about`
--

DROP TABLE IF EXISTS `about`;
CREATE TABLE IF NOT EXISTS `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resume` longtext COLLATE utf8_unicode_ci NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `about`
--

INSERT INTO `about` (`id`, `resume`, `updated_date`) VALUES
(1, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Rhoncus urna neque viverra justo nec. Ultrices in iaculis nunc sed augue lacus viverra. In vitae turpis massa sed elementum. Ut sem viverra aliquet eget sit amet tellus cras adipiscing. Aliquet eget sit amet tellus. Et malesuada fames ac turpis. Curabitur gravida arcu ac tortor dignissim. Aenean euismod elementum nisi quis. Nisl nunc mi ipsum faucibus vitae.</p>', '2018-03-26 10:56:40');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'PHP'),
(2, 'Symfony'),
(3, 'Javascript'),
(5, 'Wordpress'),
(7, 'HTML & CSS');

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

DROP TABLE IF EXISTS `cv`;
CREATE TABLE IF NOT EXISTS `cv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intro` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `github` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `website_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `github_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `job` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cv`
--

INSERT INTO `cv` (`id`, `intro`, `mail`, `phone`, `linkedin`, `github`, `twitter`, `website_link`, `linkedin_link`, `github_link`, `twitter_link`, `website`, `name`, `job`, `filename`) VALUES
(1, '<p>lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vous pouvez Visiter mon portfolio ici. Aenean commodo ligula eget dolor aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu.</p>', 'contact@romain-ollier.com', '06 41 57 49 10', '/romain-ollier', 'github.com/RomainDW', '@twittername', 'https://www.romain-ollier.com', 'https://www.linkedin.com/in/romain-ollier-26b13611b/', 'https://github.com/RomainDW', 'https://twitter.com/#', 'www.romain-ollier.com', 'Romain Ollier', 'Développeur Web', 'profile.png');

-- --------------------------------------------------------

--
-- Structure de la table `cv_project`
--

DROP TABLE IF EXISTS `cv_project`;
CREATE TABLE IF NOT EXISTS `cv_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resume` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Cv_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cv_project`
--

INSERT INTO `cv_project` (`id`, `name`, `resume`, `Cv_id`, `link`) VALUES
(1, 'Blog pour un écrivain', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>', 1, 'https://romain-ollier.com/projet4'),
(2, 'Carte interactive de location de vélos', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 1, 'https://romain-ollier.com/projet3'),
(3, 'Créer un thème WordPress pour une Mairie', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 1, 'https://romain-ollier.com/wp-projet2'),
(4, 'Intégrer la maquette du site d\'une agence web', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 1, 'https://romain-ollier.com/projet1');

-- --------------------------------------------------------

--
-- Structure de la table `download`
--

DROP TABLE IF EXISTS `download`;
CREATE TABLE IF NOT EXISTS `download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `download`
--

INSERT INTO `download` (`id`, `number`, `name`) VALUES
(1, 9, 'cv');

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

DROP TABLE IF EXISTS `experience`;
CREATE TABLE IF NOT EXISTS `experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `resume` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Cv_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `experience`
--

INSERT INTO `experience` (`id`, `name`, `company`, `resume`, `date`, `Cv_id`) VALUES
(1, 'Stage Infographiste', 'Flash Enseignes', '<p>Description du role lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>', '2017', 1),
(2, 'Stage Infographiste', 'Flash Enseignes', 'Description du role lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.\r\n\r\n', '2016', 1),
(3, 'Stage Gestion des réseaux', 'Communauté de Commune du Clermontais', '<p>lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vous pouvez Visiter mon portfolio ici. Aenean commodo ligula eget dolor aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu.</p>', '2013', 1);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `niv` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `school` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `cv_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `niv`, `name`, `school`, `date`, `cv_id`) VALUES
(1, 'Bac +2', 'Développeur Web', 'OpenClassrooms', '2017-2018', 1),
(3, 'Bac', 'Infographiste Web/Print', 'IEFM 3D', '2016-2017', 1);

-- --------------------------------------------------------

--
-- Structure de la table `hobbie`
--

DROP TABLE IF EXISTS `hobbie`;
CREATE TABLE IF NOT EXISTS `hobbie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cv_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `hobbie`
--

INSERT INTO `hobbie` (`id`, `name`, `cv_id`) VALUES
(1, 'Cinéma', 1),
(2, 'Musique', 1),
(3, 'jeux vidéos', 1);

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `niv` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cv_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `language`
--

INSERT INTO `language` (`id`, `name`, `niv`, `cv_id`) VALUES
(1, 'Français', 'Native', 1),
(2, 'Anglais', 'Technique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` date NOT NULL,
  `edit_date` datetime DEFAULT NULL,
  `resume` longtext COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `project`
--

INSERT INTO `project` (`id`, `name`, `created_date`, `edit_date`, `resume`, `link`, `filename`) VALUES
(10, 'Projet 1', '2013-01-01', '2018-03-29 11:37:56', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nullam vehicula ipsum a arcu cursus vitae. Vitae congue mauris rhoncus aenean vel elit scelerisque mauris. Dolor sit amet consectetur adipiscing. Venenatis cras sed felis eget velit aliquet sagittis id consectetur. Lacus luctus accumsan tortor posuere ac ut. Tempus egestas sed sed risus pretium quam vulputate. Felis bibendum ut tristique et egestas. Rhoncus mattis rhoncus urna neque viverra justo nec. Amet est placerat in egestas erat imperdiet sed euismod</p>', 'https://romain-ollier.com/projet1', 'a-maze-in-escape-game-strasbourg.jpg'),
(11, 'Projet 2', '2018-05-04', '2018-03-24 11:55:35', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In mollis nunc sed id. Dictum non consectetur a erat nam at lectus urna duis. Id diam vel quam elementum. Volutpat odio facilisis mauris sit amet massa. Eros donec ac odio tempor. Hendrerit dolor magna eget est lorem ipsum dolor. Mattis nunc sed blandit libero volutpat sed cras ornare. Blandit libero volutpat sed cras. Consequat id porta nibh venenatis cras. Sollicitudin tempor id eu nisl nunc mi ipsum faucibus. In tellus integer feugiat scelerisque varius morbi enim nunc faucibus.', 'https://romain-ollier.com/projet2', '02-thumbnail.jpg'),
(12, 'Projet 3', '2017-06-18', '2018-03-28 12:10:17', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In mollis nunc sed id. Dictum non consectetur a erat nam at lectus urna duis. Id diam vel quam elementum. Volutpat odio facilisis mauris sit amet massa. Eros donec ac odio tempor. Hendrerit dolor magna eget est lorem ipsum dolor. Mattis nunc sed blandit libero volutpat sed cras ornare. Blandit libero volutpat sed cras. Consequat id porta nibh venenatis cras. Sollicitudin tempor id eu nisl nunc mi ipsum faucibus. In tellus integer feugiat scelerisque varius morbi enim nunc faucibus.</p>', 'https://romain-ollier.com/projet3', '03-thumbnail.jpg'),
(13, 'Projet 4', '2014-03-18', '2018-03-24 11:55:58', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In mollis nunc sed id. Dictum non consectetur a erat nam at lectus urna duis. Id diam vel quam elementum. Volutpat odio facilisis mauris sit amet massa. Eros donec ac odio tempor. Hendrerit dolor magna eget est lorem ipsum dolor. Mattis nunc sed blandit libero volutpat sed cras ornare. Blandit libero volutpat sed cras. Consequat id porta nibh venenatis cras. Sollicitudin tempor id eu nisl nunc mi ipsum faucibus. In tellus integer feugiat scelerisque varius morbi enim nunc faucibus.', 'https://romain-ollier.com/projet4', '04-thumbnail.jpg'),
(14, 'Projet 5', '2018-04-18', '2018-03-24 11:56:13', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In mollis nunc sed id. Dictum non consectetur a erat nam at lectus urna duis. Id diam vel quam elementum. Volutpat odio facilisis mauris sit amet massa. Eros donec ac odio tempor. Hendrerit dolor magna eget est lorem ipsum dolor. Mattis nunc sed blandit libero volutpat sed cras ornare. Blandit libero volutpat sed cras. Consequat id porta nibh venenatis cras. Sollicitudin tempor id eu nisl nunc mi ipsum faucibus. In tellus integer feugiat scelerisque varius morbi enim nunc faucibus.', 'https://romain-ollier.com/projet5', '05-thumbnail.jpg'),
(15, 'Projet 6', '2018-06-05', '2018-03-24 11:56:34', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In mollis nunc sed id. Dictum non consectetur a erat nam at lectus urna duis. Id diam vel quam elementum. Volutpat odio facilisis mauris sit amet massa. Eros donec ac odio tempor. Hendrerit dolor magna eget est lorem ipsum dolor. Mattis nunc sed blandit libero volutpat sed cras ornare. Blandit libero volutpat sed cras. Consequat id porta nibh venenatis cras. Sollicitudin tempor id eu nisl nunc mi ipsum faucibus. In tellus integer feugiat scelerisque varius morbi enim nunc faucibus.', 'https://romain-ollier.com/projet6', '06-thumbnail.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `project_category`
--

DROP TABLE IF EXISTS `project_category`;
CREATE TABLE IF NOT EXISTS `project_category` (
  `project_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`project_id`,`category_id`),
  KEY `IDX_3B02921A166D1F9C` (`project_id`),
  KEY `IDX_3B02921A12469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `project_category`
--

INSERT INTO `project_category` (`project_id`, `category_id`) VALUES
(10, 7),
(11, 1),
(11, 5),
(11, 7),
(12, 3),
(12, 7),
(13, 1),
(13, 7),
(14, 1),
(14, 2),
(14, 3),
(14, 7),
(15, 1),
(15, 2),
(15, 3),
(15, 7);

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `niv` int(11) NOT NULL,
  `Cv_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `skill`
--

INSERT INTO `skill` (`id`, `name`, `niv`, `Cv_id`) VALUES
(1, 'PHP & MySQL', 85, 1),
(2, 'Javascript & jQuery', 75, 1),
(3, 'Symfony', 70, 1),
(4, 'HTML & CSS', 95, 1),
(5, 'Wordpress', 80, 1),
(6, 'Illustrator & Photoshop', 85, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(2, 'romain.ollier34@gmail.com', '$2y$13$mXr3Q58tGqjY0l2Eb6/W0ONAO36.Y1P3qQiIPMAg.ideVaDof4zt.');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `project_category`
--
ALTER TABLE `project_category`
  ADD CONSTRAINT `FK_3B02921A12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_3B02921A166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
