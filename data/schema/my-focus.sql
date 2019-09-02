-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Jeu 25 Avril 2019 à 02:35
-- Version du serveur :  5.7.25-0ubuntu0.18.04.2
-- Version de PHP :  7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `my-focus`
--

-- --------------------------------------------------------

--
-- Structure de la table `applications`
--

CREATE TABLE `applications` (
  `id_app` int(11) NOT NULL,
  `id_label` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `business_name`
--

CREATE TABLE `business_name` (
  `id_business_name` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `id_type` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_label` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `categories_sub_categories`
--

CREATE TABLE `categories_sub_categories` (
  `id_category` int(11) NOT NULL,
  `id_subcategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

CREATE TABLE `content` (
  `id_content` int(11) NOT NULL,
  `id_subcategory` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

CREATE TABLE `countries` (
  `id_country` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `country_code` varchar(45) NOT NULL,
  `iso_code` varchar(45) NOT NULL,
  `populations` int(11) DEFAULT NULL,
  `area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `countries`
--

INSERT INTO `countries` (`id_country`, `name`, `country_code`, `iso_code`, `populations`, `area`) VALUES
(1, 'Switzerland', '44', 'CH / CHE', 758100, 41290);

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

CREATE TABLE `cv` (
  `id_cv` varbinary(36) NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_working_license` int(11) DEFAULT NULL,
  `id_department` int(11) DEFAULT NULL,
  `id_type_cv` int(11) DEFAULT NULL,
  `id_country` int(11) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `street` varchar(45) NOT NULL,
  `street_number` varchar(45) NOT NULL,
  `locality` varchar(45) NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `phone_number` varchar(45) NOT NULL,
  `anniversary` datetime NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `presentation` blob,
  `published_at` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `cv`
--

INSERT INTO `cv` (`id_cv`, `id_order`, `id_working_license`, `id_department`, `id_type_cv`, `id_country`, `title`, `name`, `lastname`, `street`, `street_number`, `locality`, `postal_code`, `mail`, `phone_number`, `anniversary`, `creation_date`, `presentation`, `published_at`, `active`) VALUES
(0x39346436316435322d363666312d313165392d396536332d303030633239383038313939, NULL, 1, 1, 2, NULL, 'Mr', 'Kenny', 'Alonzo', 'Route de Chavannes', '143', 'Lausanne', '1007', 'kalonzo@bluewin.ch', '+41787365639', '2014-01-01 00:00:00', '2019-04-25 00:32:18', 0x6866666766676667, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cv_driver_s_license`
--

CREATE TABLE `cv_driver_s_license` (
  `id_cv` varbinary(36) NOT NULL,
  `id_driver_s_license` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `cv_experiences`
--

CREATE TABLE `cv_experiences` (
  `id_cv` varbinary(36) NOT NULL,
  `id_experience` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `cv_hobbies`
--

CREATE TABLE `cv_hobbies` (
  `id_cv` varbinary(36) NOT NULL,
  `id_hobbie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `cv_skills`
--

CREATE TABLE `cv_skills` (
  `id_cv` varbinary(36) NOT NULL,
  `id_skill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `cv_training`
--

CREATE TABLE `cv_training` (
  `id_cv` varbinary(36) NOT NULL,
  `id_training` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `departments`
--

CREATE TABLE `departments` (
  `id_department` int(11) NOT NULL,
  `id_country` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `departments`
--

INSERT INTO `departments` (`id_department`, `id_country`, `name`) VALUES
(1, 1, 'Fribourg');

-- --------------------------------------------------------

--
-- Structure de la table `driver_s_license`
--

CREATE TABLE `driver_s_license` (
  `id_driver_s_license` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `experiences`
--

CREATE TABLE `experiences` (
  `id_experience` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_label` int(11) DEFAULT NULL,
  `id_business_name` int(11) DEFAULT NULL,
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context` blob,
  `action` blob,
  `results` blob,
  `technical_environments` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `footer`
--

CREATE TABLE `footer` (
  `id_footer` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `galleries`
--

CREATE TABLE `galleries` (
  `id_gallery` int(11) NOT NULL,
  `id_type` int(11) DEFAULT NULL,
  `fileName` varchar(100) NOT NULL,
  `uniqueFileName` varchar(100) NOT NULL,
  `image` blob,
  `duration` varchar(45) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `header`
--

CREATE TABLE `header` (
  `id_header` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `hobbies`
--

CREATE TABLE `hobbies` (
  `id_hobbie` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_label` int(11) DEFAULT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `labels`
--

CREATE TABLE `labels` (
  `id_label` int(11) NOT NULL,
  `id_type_label` int(11) DEFAULT NULL,
  `label` varchar(45) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `label_types`
--

CREATE TABLE `label_types` (
  `id_type_label` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id_menu` int(11) NOT NULL,
  `id_type` int(11) DEFAULT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_label` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `menus_categories`
--

CREATE TABLE `menus_categories` (
  `id_menu` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `menu_content`
--

CREATE TABLE `menu_content` (
  `id_menu_content` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `menu_content_menus`
--

CREATE TABLE `menu_content_menus` (
  `id_menu_content` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `navbar`
--

CREATE TABLE `navbar` (
  `id_navbar` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_order_type` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `order_types`
--

CREATE TABLE `order_types` (
  `id_order_type` int(11) NOT NULL,
  `label` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `portfolios`
--

CREATE TABLE `portfolios` (
  `id_portfolio` varbinary(36) NOT NULL,
  `id_header` int(11) DEFAULT NULL,
  `id_navbar` int(11) DEFAULT NULL,
  `id_menu_content` int(11) DEFAULT NULL,
  `id_widget` int(11) DEFAULT NULL,
  `id_content` int(11) DEFAULT NULL,
  `id_footer` int(11) DEFAULT NULL,
  `id` varbinary(36) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `portfolios`
--

INSERT INTO `portfolios` (`id_portfolio`, `id_header`, `id_navbar`, `id_menu_content`, `id_widget`, `id_content`, `id_footer`, `id`, `name`, `slug`, `descn`, `creation_date`, `published_at`, `active`) VALUES
(0x36333065386363302d363665662d313165392d613132342d303030633239383038313939, NULL, NULL, NULL, NULL, NULL, NULL, 0x35326430356632382d363665662d313165392d396566342d303030633239383038313939, 'Portfolio Administrateur', 'portfolio-administrateur', 0x5265736f7572636520696420233337, '2019-04-24 22:00:00', '2014-01-01 00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `portfolios_applications`
--

CREATE TABLE `portfolios_applications` (
  `id_portfolio` varbinary(36) NOT NULL,
  `id_app` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `portfolios_cv`
--

CREATE TABLE `portfolios_cv` (
  `id_portfolio` varbinary(36) NOT NULL,
  `id_cv` varbinary(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `portfolios_cv`
--

INSERT INTO `portfolios_cv` (`id_portfolio`, `id_cv`) VALUES
(0x36333065386363302d363665662d313165392d613132342d303030633239383038313939, 0x39346436316435322d363666312d313165392d396536332d303030633239383038313939);

-- --------------------------------------------------------

--
-- Structure de la table `portfolios_galleries`
--

CREATE TABLE `portfolios_galleries` (
  `id_portfolio` varbinary(36) NOT NULL,
  `id_gallery` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `portfolios_projects`
--

CREATE TABLE `portfolios_projects` (
  `id_portfolio` varbinary(36) NOT NULL,
  `id_project` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `portfolios_websites`
--

CREATE TABLE `portfolios_websites` (
  `id_portfolio` varbinary(36) NOT NULL,
  `id_web` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id_project` int(11) NOT NULL,
  `id_business_name` int(11) DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `scope` varchar(45) DEFAULT 'General',
  `quality` varchar(45) NOT NULL,
  `cost` varchar(45) NOT NULL,
  `budget` varchar(45) NOT NULL,
  `benefit` varchar(45) NOT NULL,
  `risk` varchar(45) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(45) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  `valuenow` int(4) DEFAULT '0',
  `valuemin` int(4) DEFAULT '0',
  `valuemax` int(4) DEFAULT '100',
  `style` varchar(45) DEFAULT 'info'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `rules`
--

CREATE TABLE `rules` (
  `id_rule` int(11) NOT NULL,
  `label` varchar(45) NOT NULL,
  `descn` blob NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `scheduler`
--

CREATE TABLE `scheduler` (
  `id_schedule` int(11) NOT NULL,
  `id_label` int(11) DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `descn` blob,
  `active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

CREATE TABLE `skills` (
  `id_skill` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_type_skill` int(11) NOT NULL,
  `id_label` int(11) NOT NULL,
  `star` float NOT NULL,
  `year_acquisition` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `subcategories`
--

CREATE TABLE `subcategories` (
  `id_subcategory` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_label` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE `tasks` (
  `id_task` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `descn` blob,
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(45) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  `valuenow` int(4) DEFAULT '0',
  `valuemin` int(4) DEFAULT '0',
  `valuemax` int(4) DEFAULT '100',
  `style` varchar(45) DEFAULT 'info'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `tasks_scheduler`
--

CREATE TABLE `tasks_scheduler` (
  `id_task` int(11) NOT NULL,
  `id_schedule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `training`
--

CREATE TABLE `training` (
  `id_training` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_label` int(11) NOT NULL,
  `id_business_name` int(11) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id_type` int(11) NOT NULL,
  `label` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `type_cv`
--

CREATE TABLE `type_cv` (
  `id_type_cv` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `type_cv`
--

INSERT INTO `type_cv` (`id_type_cv`, `name`, `creation_date`) VALUES
(1, 'Web Developer', '2018-11-13 09:01:13'),
(2, 'Project Manager', '2018-11-13 09:01:13');

-- --------------------------------------------------------

--
-- Structure de la table `type_skills`
--

CREATE TABLE `type_skills` (
  `id_type_skill` int(11) NOT NULL,
  `id_label` int(11) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` varbinary(36) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `las_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nb_visits` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  `visible` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `creation_date`, `las_log`, `nb_visits`, `active`, `visible`) VALUES
(0x35326430356632382d363665662d313165392d396566342d303030633239383038313939, 'kalonzo@bluewin.ch', '[]', '$argon2i$v=19$m=1024,t=2,p=2$MGdPd3EvZGozTWpyblVMbw$ykTG6FNQaFvUlqUd6KsJJW7ZpBp0vh5XSdCiHK5+PO8', '2019-04-25 00:16:08', '2019-04-25 00:16:08', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_rules`
--

CREATE TABLE `user_rules` (
  `id` varbinary(36) NOT NULL,
  `id_rule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `websites`
--

CREATE TABLE `websites` (
  `id_web` int(11) NOT NULL,
  `id_label` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `widget`
--

CREATE TABLE `widget` (
  `id_widget` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `slug` varchar(45) NOT NULL,
  `descn` blob,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `working_license`
--

CREATE TABLE `working_license` (
  `id_working_license` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `duration` varchar(45) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `working_license`
--

INSERT INTO `working_license` (`id_working_license`, `name`, `duration`, `creation_date`) VALUES
(1, 'B permit', '2019', '2018-11-13 09:01:16'),
(2, 'G permit', '2019', '2018-11-13 09:01:16');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id_app`),
  ADD KEY `id_label` (`id_label`);

--
-- Index pour la table `business_name`
--
ALTER TABLE `business_name`
  ADD PRIMARY KEY (`id_business_name`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_label` (`id_label`);

--
-- Index pour la table `categories_sub_categories`
--
ALTER TABLE `categories_sub_categories`
  ADD PRIMARY KEY (`id_category`,`id_subcategory`),
  ADD KEY `id_subcategory` (`id_subcategory`);

--
-- Index pour la table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id_content`),
  ADD KEY `id_subcategory` (`id_subcategory`);

--
-- Index pour la table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id_country`);

--
-- Index pour la table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id_cv`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_working_license` (`id_working_license`),
  ADD KEY `id_department` (`id_department`),
  ADD KEY `id_type_cv` (`id_type_cv`),
  ADD KEY `id_country` (`id_country`);

--
-- Index pour la table `cv_driver_s_license`
--
ALTER TABLE `cv_driver_s_license`
  ADD PRIMARY KEY (`id_cv`,`id_driver_s_license`),
  ADD KEY `id_driver_s_license` (`id_driver_s_license`);

--
-- Index pour la table `cv_experiences`
--
ALTER TABLE `cv_experiences`
  ADD PRIMARY KEY (`id_cv`,`id_experience`),
  ADD KEY `id_experience` (`id_experience`);

--
-- Index pour la table `cv_hobbies`
--
ALTER TABLE `cv_hobbies`
  ADD PRIMARY KEY (`id_cv`,`id_hobbie`),
  ADD KEY `id_hobbie` (`id_hobbie`);

--
-- Index pour la table `cv_skills`
--
ALTER TABLE `cv_skills`
  ADD PRIMARY KEY (`id_cv`,`id_skill`),
  ADD KEY `id_skill` (`id_skill`);

--
-- Index pour la table `cv_training`
--
ALTER TABLE `cv_training`
  ADD PRIMARY KEY (`id_cv`,`id_training`),
  ADD KEY `id_training` (`id_training`);

--
-- Index pour la table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id_department`),
  ADD KEY `id_country` (`id_country`);

--
-- Index pour la table `driver_s_license`
--
ALTER TABLE `driver_s_license`
  ADD PRIMARY KEY (`id_driver_s_license`);

--
-- Index pour la table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id_experience`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_label` (`id_label`),
  ADD KEY `id_business_name` (`id_business_name`);

--
-- Index pour la table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id_footer`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Index pour la table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id_gallery`),
  ADD KEY `id_type` (`id_type`);

--
-- Index pour la table `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id_header`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Index pour la table `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`id_hobbie`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_label` (`id_label`);

--
-- Index pour la table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id_label`),
  ADD KEY `id_type_label` (`id_type_label`);

--
-- Index pour la table `label_types`
--
ALTER TABLE `label_types`
  ADD PRIMARY KEY (`id_type_label`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_label` (`id_label`);

--
-- Index pour la table `menus_categories`
--
ALTER TABLE `menus_categories`
  ADD PRIMARY KEY (`id_menu`,`id_category`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `menu_content`
--
ALTER TABLE `menu_content`
  ADD PRIMARY KEY (`id_menu_content`);

--
-- Index pour la table `menu_content_menus`
--
ALTER TABLE `menu_content_menus`
  ADD PRIMARY KEY (`id_menu_content`,`id_menu`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `navbar`
--
ALTER TABLE `navbar`
  ADD PRIMARY KEY (`id_navbar`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_order_type` (`id_order_type`);

--
-- Index pour la table `order_types`
--
ALTER TABLE `order_types`
  ADD PRIMARY KEY (`id_order_type`);

--
-- Index pour la table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id_portfolio`),
  ADD KEY `id_header` (`id_header`),
  ADD KEY `id_navbar` (`id_navbar`),
  ADD KEY `id_menu_content` (`id_menu_content`),
  ADD KEY `id_widget` (`id_widget`),
  ADD KEY `id_content` (`id_content`),
  ADD KEY `id_footer` (`id_footer`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `portfolios_applications`
--
ALTER TABLE `portfolios_applications`
  ADD PRIMARY KEY (`id_portfolio`,`id_app`),
  ADD KEY `id_app` (`id_app`);

--
-- Index pour la table `portfolios_cv`
--
ALTER TABLE `portfolios_cv`
  ADD PRIMARY KEY (`id_portfolio`,`id_cv`),
  ADD KEY `id_cv` (`id_cv`);

--
-- Index pour la table `portfolios_galleries`
--
ALTER TABLE `portfolios_galleries`
  ADD PRIMARY KEY (`id_portfolio`,`id_gallery`),
  ADD KEY `id_gallery` (`id_gallery`);

--
-- Index pour la table `portfolios_projects`
--
ALTER TABLE `portfolios_projects`
  ADD PRIMARY KEY (`id_portfolio`,`id_project`),
  ADD KEY `id_project` (`id_project`);

--
-- Index pour la table `portfolios_websites`
--
ALTER TABLE `portfolios_websites`
  ADD PRIMARY KEY (`id_portfolio`,`id_web`),
  ADD KEY `id_web` (`id_web`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id_project`),
  ADD KEY `id_business_name` (`id_business_name`);

--
-- Index pour la table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id_rule`);

--
-- Index pour la table `scheduler`
--
ALTER TABLE `scheduler`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `id_label` (`id_label`);

--
-- Index pour la table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id_skill`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_type_skill` (`id_type_skill`),
  ADD KEY `id_label` (`id_label`);

--
-- Index pour la table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id_subcategory`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_label` (`id_label`);

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `id_project` (`id_project`);

--
-- Index pour la table `tasks_scheduler`
--
ALTER TABLE `tasks_scheduler`
  ADD PRIMARY KEY (`id_task`,`id_schedule`),
  ADD KEY `id_schedule` (`id_schedule`);

--
-- Index pour la table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id_training`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_label` (`id_label`),
  ADD KEY `id_business_name` (`id_business_name`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `type_cv`
--
ALTER TABLE `type_cv`
  ADD PRIMARY KEY (`id_type_cv`);

--
-- Index pour la table `type_skills`
--
ALTER TABLE `type_skills`
  ADD PRIMARY KEY (`id_type_skill`),
  ADD KEY `id_label` (`id_label`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `user_rules`
--
ALTER TABLE `user_rules`
  ADD PRIMARY KEY (`id`,`id_rule`),
  ADD KEY `id_rule` (`id_rule`);

--
-- Index pour la table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`id_web`),
  ADD KEY `id_label` (`id_label`);

--
-- Index pour la table `widget`
--
ALTER TABLE `widget`
  ADD PRIMARY KEY (`id_widget`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `working_license`
--
ALTER TABLE `working_license`
  ADD PRIMARY KEY (`id_working_license`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `business_name`
--
ALTER TABLE `business_name`
  MODIFY `id_business_name` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `departments`
--
ALTER TABLE `departments`
  MODIFY `id_department` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `driver_s_license`
--
ALTER TABLE `driver_s_license`
  MODIFY `id_driver_s_license` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `labels`
--
ALTER TABLE `labels`
  MODIFY `id_label` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `label_types`
--
ALTER TABLE `label_types`
  MODIFY `id_type_label` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `order_types`
--
ALTER TABLE `order_types`
  MODIFY `id_order_type` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rules`
--
ALTER TABLE `rules`
  MODIFY `id_rule` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `type_cv`
--
ALTER TABLE `type_cv`
  MODIFY `id_type_cv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `type_skills`
--
ALTER TABLE `type_skills`
  MODIFY `id_type_skill` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `working_license`
--
ALTER TABLE `working_license`
  MODIFY `id_working_license` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`id_label`) REFERENCES `labels` (`id_label`);

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `types` (`id_type`),
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `categories_ibfk_3` FOREIGN KEY (`id_label`) REFERENCES `labels` (`id_label`);

--
-- Contraintes pour la table `categories_sub_categories`
--
ALTER TABLE `categories_sub_categories`
  ADD CONSTRAINT `FK_A7C7563115CE69BF` FOREIGN KEY (`id_subcategory`) REFERENCES `subcategories` (`id_subcategory`),
  ADD CONSTRAINT `FK_A7C756315697F554` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`);

--
-- Contraintes pour la table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`id_subcategory`) REFERENCES `subcategories` (`id_subcategory`);

--
-- Contraintes pour la table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `cv_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `cv_ibfk_3` FOREIGN KEY (`id_working_license`) REFERENCES `working_license` (`id_working_license`),
  ADD CONSTRAINT `cv_ibfk_4` FOREIGN KEY (`id_department`) REFERENCES `departments` (`id_department`),
  ADD CONSTRAINT `cv_ibfk_5` FOREIGN KEY (`id_type_cv`) REFERENCES `type_cv` (`id_type_cv`),
  ADD CONSTRAINT `cv_ibfk_6` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id_country`);

--
-- Contraintes pour la table `cv_driver_s_license`
--
ALTER TABLE `cv_driver_s_license`
  ADD CONSTRAINT `FK_F3EF539476120795` FOREIGN KEY (`id_cv`) REFERENCES `cv` (`id_cv`),
  ADD CONSTRAINT `FK_F3EF5394A58D7F7B` FOREIGN KEY (`id_driver_s_license`) REFERENCES `driver_s_license` (`id_driver_s_license`);

--
-- Contraintes pour la table `cv_experiences`
--
ALTER TABLE `cv_experiences`
  ADD CONSTRAINT `FK_9C7C0A8D76120795` FOREIGN KEY (`id_cv`) REFERENCES `cv` (`id_cv`),
  ADD CONSTRAINT `FK_9C7C0A8DA01A41D4` FOREIGN KEY (`id_experience`) REFERENCES `experiences` (`id_experience`);

--
-- Contraintes pour la table `cv_hobbies`
--
ALTER TABLE `cv_hobbies`
  ADD CONSTRAINT `FK_734367533BAB1C1A` FOREIGN KEY (`id_hobbie`) REFERENCES `hobbies` (`id_hobbie`),
  ADD CONSTRAINT `FK_7343675376120795` FOREIGN KEY (`id_cv`) REFERENCES `cv` (`id_cv`);

--
-- Contraintes pour la table `cv_skills`
--
ALTER TABLE `cv_skills`
  ADD CONSTRAINT `FK_58B61F5576120795` FOREIGN KEY (`id_cv`) REFERENCES `cv` (`id_cv`),
  ADD CONSTRAINT `FK_58B61F55B0B8A547` FOREIGN KEY (`id_skill`) REFERENCES `skills` (`id_skill`);

--
-- Contraintes pour la table `cv_training`
--
ALTER TABLE `cv_training`
  ADD CONSTRAINT `FK_443D6F4B76120795` FOREIGN KEY (`id_cv`) REFERENCES `cv` (`id_cv`),
  ADD CONSTRAINT `FK_443D6F4B85C9661A` FOREIGN KEY (`id_training`) REFERENCES `training` (`id_training`);

--
-- Contraintes pour la table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id_country`);

--
-- Contraintes pour la table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `experiences_ibfk_2` FOREIGN KEY (`id_label`) REFERENCES `labels` (`id_label`),
  ADD CONSTRAINT `experiences_ibfk_3` FOREIGN KEY (`id_business_name`) REFERENCES `business_name` (`id_business_name`);

--
-- Contraintes pour la table `footer`
--
ALTER TABLE `footer`
  ADD CONSTRAINT `footer_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id_menu`);

--
-- Contraintes pour la table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `types` (`id_type`);

--
-- Contraintes pour la table `header`
--
ALTER TABLE `header`
  ADD CONSTRAINT `header_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id_menu`);

--
-- Contraintes pour la table `hobbies`
--
ALTER TABLE `hobbies`
  ADD CONSTRAINT `hobbies_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `hobbies_ibfk_2` FOREIGN KEY (`id_label`) REFERENCES `labels` (`id_label`);

--
-- Contraintes pour la table `labels`
--
ALTER TABLE `labels`
  ADD CONSTRAINT `labels_ibfk_1` FOREIGN KEY (`id_type_label`) REFERENCES `label_types` (`id_type_label`);

--
-- Contraintes pour la table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `types` (`id_type`),
  ADD CONSTRAINT `menus_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `menus_ibfk_3` FOREIGN KEY (`id_label`) REFERENCES `labels` (`id_label`);

--
-- Contraintes pour la table `menus_categories`
--
ALTER TABLE `menus_categories`
  ADD CONSTRAINT `FK_2C7F3E255697F554` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`),
  ADD CONSTRAINT `FK_2C7F3E25F6252691` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id_menu`);

--
-- Contraintes pour la table `menu_content_menus`
--
ALTER TABLE `menu_content_menus`
  ADD CONSTRAINT `FK_3F75098B55DF5865` FOREIGN KEY (`id_menu_content`) REFERENCES `menu_content` (`id_menu_content`),
  ADD CONSTRAINT `FK_3F75098BF6252691` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id_menu`);

--
-- Contraintes pour la table `navbar`
--
ALTER TABLE `navbar`
  ADD CONSTRAINT `navbar_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menus` (`id_menu`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_order_type`) REFERENCES `order_types` (`id_order_type`);

--
-- Contraintes pour la table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_ibfk_1` FOREIGN KEY (`id_header`) REFERENCES `header` (`id_header`),
  ADD CONSTRAINT `portfolios_ibfk_2` FOREIGN KEY (`id_navbar`) REFERENCES `navbar` (`id_navbar`),
  ADD CONSTRAINT `portfolios_ibfk_3` FOREIGN KEY (`id_menu_content`) REFERENCES `menu_content` (`id_menu_content`),
  ADD CONSTRAINT `portfolios_ibfk_4` FOREIGN KEY (`id_widget`) REFERENCES `widget` (`id_widget`),
  ADD CONSTRAINT `portfolios_ibfk_5` FOREIGN KEY (`id_content`) REFERENCES `content` (`id_content`),
  ADD CONSTRAINT `portfolios_ibfk_6` FOREIGN KEY (`id_footer`) REFERENCES `footer` (`id_footer`),
  ADD CONSTRAINT `portfolios_ibfk_7` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `portfolios_applications`
--
ALTER TABLE `portfolios_applications`
  ADD CONSTRAINT `FK_60EDC61729D8AC45` FOREIGN KEY (`id_portfolio`) REFERENCES `portfolios` (`id_portfolio`),
  ADD CONSTRAINT `FK_60EDC61757CA9895` FOREIGN KEY (`id_app`) REFERENCES `applications` (`id_app`);

--
-- Contraintes pour la table `portfolios_cv`
--
ALTER TABLE `portfolios_cv`
  ADD CONSTRAINT `FK_14B5F9B29D8AC45` FOREIGN KEY (`id_portfolio`) REFERENCES `portfolios` (`id_portfolio`),
  ADD CONSTRAINT `FK_14B5F9B76120795` FOREIGN KEY (`id_cv`) REFERENCES `cv` (`id_cv`);

--
-- Contraintes pour la table `portfolios_galleries`
--
ALTER TABLE `portfolios_galleries`
  ADD CONSTRAINT `FK_43216C829D8AC45` FOREIGN KEY (`id_portfolio`) REFERENCES `portfolios` (`id_portfolio`),
  ADD CONSTRAINT `FK_43216C899B6D14A` FOREIGN KEY (`id_gallery`) REFERENCES `galleries` (`id_gallery`);

--
-- Contraintes pour la table `portfolios_projects`
--
ALTER TABLE `portfolios_projects`
  ADD CONSTRAINT `FK_D99A84B629D8AC45` FOREIGN KEY (`id_portfolio`) REFERENCES `portfolios` (`id_portfolio`),
  ADD CONSTRAINT `FK_D99A84B6F12E799E` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id_project`);

--
-- Contraintes pour la table `portfolios_websites`
--
ALTER TABLE `portfolios_websites`
  ADD CONSTRAINT `FK_A02EE09F29D8AC45` FOREIGN KEY (`id_portfolio`) REFERENCES `portfolios` (`id_portfolio`),
  ADD CONSTRAINT `FK_A02EE09F8B6DD00B` FOREIGN KEY (`id_web`) REFERENCES `websites` (`id_web`);

--
-- Contraintes pour la table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`id_business_name`) REFERENCES `business_name` (`id_business_name`);

--
-- Contraintes pour la table `scheduler`
--
ALTER TABLE `scheduler`
  ADD CONSTRAINT `scheduler_ibfk_1` FOREIGN KEY (`id_label`) REFERENCES `labels` (`id_label`);

--
-- Contraintes pour la table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `skills_ibfk_2` FOREIGN KEY (`id_type_skill`) REFERENCES `type_skills` (`id_type_skill`),
  ADD CONSTRAINT `skills_ibfk_3` FOREIGN KEY (`id_label`) REFERENCES `labels` (`id_label`);

--
-- Contraintes pour la table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `types` (`id_type`),
  ADD CONSTRAINT `subcategories_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `subcategories_ibfk_3` FOREIGN KEY (`id_label`) REFERENCES `labels` (`id_label`);

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`id_project`) REFERENCES `projects` (`id_project`);

--
-- Contraintes pour la table `tasks_scheduler`
--
ALTER TABLE `tasks_scheduler`
  ADD CONSTRAINT `tasks_scheduler_ibfk_1` FOREIGN KEY (`id_task`) REFERENCES `tasks` (`id_task`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_scheduler_ibfk_2` FOREIGN KEY (`id_schedule`) REFERENCES `scheduler` (`id_schedule`) ON DELETE CASCADE;

--
-- Contraintes pour la table `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `training_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `training_ibfk_2` FOREIGN KEY (`id_label`) REFERENCES `labels` (`id_label`),
  ADD CONSTRAINT `training_ibfk_3` FOREIGN KEY (`id_business_name`) REFERENCES `business_name` (`id_business_name`);

--
-- Contraintes pour la table `type_skills`
--
ALTER TABLE `type_skills`
  ADD CONSTRAINT `type_skills_ibfk_1` FOREIGN KEY (`id_label`) REFERENCES `labels` (`id_label`);

--
-- Contraintes pour la table `websites`
--
ALTER TABLE `websites`
  ADD CONSTRAINT `websites_ibfk_1` FOREIGN KEY (`id_label`) REFERENCES `labels` (`id_label`);

--
-- Contraintes pour la table `widget`
--
ALTER TABLE `widget`
  ADD CONSTRAINT `widget_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
