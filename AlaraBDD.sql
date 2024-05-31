-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 31 mai 2024 à 15:10
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecein`
--

-- --------------------------------------------------------

--
-- Structure de la table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `Applications_ID` int NOT NULL AUTO_INCREMENT,
  `job_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `application_date` date DEFAULT NULL,
  PRIMARY KEY (`Applications_ID`),
  KEY `job_id` (`job_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `applications`
--

INSERT INTO `applications` (`Applications_ID`, `job_id`, `user_id`, `application_date`) VALUES
(1, 5, 1, '2024-05-30'),
(2, 5, 1, '2024-05-30'),
(3, 4, 1, '2024-05-30'),
(4, 3, 0, '2024-05-30'),
(5, 3, 0, '2024-05-30'),
(6, 3, 0, '2024-05-30'),
(7, 3, 0, '2024-05-30'),
(8, 3, 2, '2024-05-30');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `Comment_ID` int NOT NULL AUTO_INCREMENT,
  `Post_ID` int DEFAULT NULL,
  `User_ID` int DEFAULT NULL,
  `Texte` text,
  PRIMARY KEY (`Comment_ID`),
  KEY `Post_ID` (`Post_ID`),
  KEY `User_ID` (`User_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `education`
--

DROP TABLE IF EXISTS `education`;
CREATE TABLE IF NOT EXISTS `education` (
  `Edu_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int DEFAULT NULL,
  `Debut` date DEFAULT NULL,
  `Fin` date DEFAULT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Type_formation` varchar(255) DEFAULT NULL,
  `Enterprise_ID` int DEFAULT NULL,
  PRIMARY KEY (`Edu_ID`),
  KEY `User_ID` (`User_ID`),
  KEY `Enterprise_ID` (`Enterprise_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `education`
--

INSERT INTO `education` (`Edu_ID`, `User_ID`, `Debut`, `Fin`, `Nom`, `Type_formation`, `Enterprise_ID`) VALUES
(1, 1, '2022-09-01', '2027-06-01', 'Etudiant', 'Ingenieur', 1);

-- --------------------------------------------------------

--
-- Structure de la table `enterprise`
--

DROP TABLE IF EXISTS `enterprise`;
CREATE TABLE IF NOT EXISTS `enterprise` (
  `Enterprise_ID` int NOT NULL AUTO_INCREMENT,
  `Logo` varchar(255) DEFAULT NULL,
  `Pays` varchar(255) DEFAULT NULL,
  `Industrie` varchar(255) DEFAULT NULL,
  `Banniere` varchar(255) DEFAULT NULL,
  `Nom_Entreprise` varchar(255) NOT NULL,
  `Tuteur` varchar(255) DEFAULT NULL,
  `Information_ID` int DEFAULT NULL,
  PRIMARY KEY (`Enterprise_ID`),
  KEY `Information_ID` (`Information_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enterprise`
--

INSERT INTO `enterprise` (`Enterprise_ID`, `Logo`, `Pays`, `Industrie`, `Banniere`, `Nom_Entreprise`, `Tuteur`, `Information_ID`) VALUES
(1, 'logo1.png', 'France', 'Education', 'banniere1.png', 'ECE Paris', 'Dr. Xian Fernand', 1),
(2, 'logo2.png', 'France', 'Technologie', 'banniere2.png', 'TechCorp', 'Mme. Sophie Martin', 2),
(3, 'logo3.png', 'France', 'Marketing', 'banniere3.png', 'MarketingPlus', 'Mr. Kamel Leclerc', 3),
(4, 'logo4.png', 'France', 'Finance', 'banniere4.png', 'FinanceGroup', 'Mme. Ben Zacomi', 4),
(5, 'logo5.png', 'France', 'Informatique', 'banniere5.png', 'ITWorld', 'Mr. Thomas Petit', 5),
(6, 'logo6.png', 'France', 'Technologie', 'banniere6.png', 'Apple', 'Steve Jobs', 6),
(7, 'logo7.png', 'France', 'Assurance', 'banniere7.png', 'Axa', 'Claude Bébéar', 7),
(8, 'logo8.png', 'France', 'Informatique', 'banniere8.png', 'Google', 'Sergey Brin', 8),
(9, 'logo9.png', 'France', 'Education', 'banniere9.png', 'Esilv', 'Pascal Pinot', 9);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `Event_ID` int NOT NULL AUTO_INCREMENT,
  `Enterprise_ID` int DEFAULT NULL,
  `Intitule` varchar(255) DEFAULT NULL,
  `Debut` date DEFAULT NULL,
  `Fin` date DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Texte` text,
  PRIMARY KEY (`Event_ID`),
  KEY `Enterprise_ID` (`Enterprise_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

DROP TABLE IF EXISTS `experience`;
CREATE TABLE IF NOT EXISTS `experience` (
  `Exp_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int DEFAULT NULL,
  `Debut` date DEFAULT NULL,
  `Fin` date DEFAULT NULL,
  `Position` varchar(255) DEFAULT NULL,
  `Type_Contrat` varchar(255) DEFAULT NULL,
  `Enterprise_ID` int DEFAULT NULL,
  PRIMARY KEY (`Exp_ID`),
  KEY `User_ID` (`User_ID`),
  KEY `Enterprise_ID` (`Enterprise_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `experience`
--

INSERT INTO `experience` (`Exp_ID`, `User_ID`, `Debut`, `Fin`, `Position`, `Type_Contrat`, `Enterprise_ID`) VALUES
(1, 1, '2023-09-01', '2024-06-01', 'Ambassadeur', 'Contrat', 1);

-- --------------------------------------------------------

--
-- Structure de la table `informations`
--

DROP TABLE IF EXISTS `informations`;
CREATE TABLE IF NOT EXISTS `informations` (
  `Information_ID` int NOT NULL AUTO_INCREMENT,
  `Site_Web` varchar(255) DEFAULT NULL,
  `Intro` text,
  `Informations` text,
  `Taille` varchar(255) DEFAULT NULL,
  `Telephone` varchar(255) DEFAULT NULL,
  `Annee_Fondation` date DEFAULT NULL,
  `Lieu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Information_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `informations`
--

INSERT INTO `informations` (`Information_ID`, `Site_Web`, `Intro`, `Informations`, `Taille`, `Telephone`, `Annee_Fondation`, `Lieu`) VALUES
(1, 'https://www.ece.fr', 'Programmes d’administration de l’éducation Paris, île-de-france · 26 K abonnés · 15 K anciens élèves', 'L\'ECE école d\'ingénieurs multiprogrammes, multi-campus et multi-secteurs, spécialisée dans l\'ingénierie numérique, forme les ingénieurs et les experts en technologie du 21ème siècle, capables de relever les défis de la double révolution numérique et du développement durable.\r\n <br><br> \r\n Les nombreuses associations étudiantes et les voyages internationaux proposés aux étudiants leur offrent une expérience de premier ordre, ainsi qu\'une large ouverture sur le monde d\'aujourd\'hui et de demain.\r\n <br><br> ECE propose trois programmes d\'enseignement supérieur : le programme Grande Ecole d\'ingénieurs, le programme Bachelor et le programme MSc.', '51-200 employés', '+33 1 44 39 06 00', '1919-01-01', 'https://www.google.fr/maps/place/ECE++Ecole+d\'ingénieurs++Campus+de+Paris/@48.8516383,2.2847697,17z/data=!3m1!5s0x47e670049820700f:0x5e9c35374e6fe5df!4m10!1m2!2m1!1sece!3m6!1s0x47e6701b4f58251b:0x167f5a60fb94aa76!8m2!3d48.8512252!4d2.2885659!15sCgNlY2UiA4'),
(2, 'https://www.TechCorps', '', 'TechCorps est une entreprise', '', '', '0000-00-00', ''),
(3, 'https://www.MarketingPlus', '', '', '', '', '0000-00-00', ''),
(4, 'https://www.FinanceGroup', '', '', '', '', '0000-00-00', ''),
(5, 'https://www.ITWorld', '', '', '', '', '0000-00-00', ''),
(6, 'http://www.apple.com/careers', 'Fabrication de produits informatiques et électroniques Cupertino, California · 18 M d’abonnés · Plus de 10 K employés', 'We\'re a diverse collective of thinkers and doers, continually reimagining what\'s possible to help us all do what we love in new ways. And the same innovation that goes into our products also applies to our practices — strengthening our commitment to leave the world better than we found it. This is where your work can make a difference in people\'s lives. Including your own. <br><br> Apple is an equal opportunity employer that is committed to inclusion and diversity. Visit apple.com/careers to learn more.', '10 001 employés et plus<br><br>171 219 membres associés', '+33 1 56 52 96 00', '1976-01-01', 'https://www.bing.com/maps?where=1+Apple+Park+Way%2C+Cupertino%2C+California+95014%2C+US&cp=37.32939%7E-122.008397&lvl=16.8'),
(7, 'https://www.axa.fr', 'Assurances Paris · FR 1 M d’abonnés · Plus de 10 K employés', 'Un point de départ : nos clients.<br><br>En tant que l\'un des plus grands assureurs au monde, notre raison d’être est d\'agir pour le progrès humain en protégeant ce qui compte.<br><br>La protection a toujours été au cœur de nos activités, en aidant les individus, les entreprises et les sociétés à prospérer. Et AXA a toujours été un leader, un innovateur, une société entrepreneuriale, favorisant le progrès dans toutes ses dimensions.<br><br>Notre raison d\'être renvoie aussi aux racines mêmes du Groupe. Depuis ses débuts, AXA s\'est engagé pour le bien collectif. Que ce soit au travers d\'actions solidaires avec AXA Atout Cœur, sur des sujets de prévention avec le Fonds AXA pour la Recherche, ou en matière de lutte contre le changement climatique… AXA s\'est toujours montré à l\'écoute de son environnement social et senti investi d\'une responsabilité en tant qu\'assureur ; celle d\'agir en amont pour mieux comprendre les risques. Dans un seul but : mieux protéger.', '10 001 employés et plus<br><br>136 176 membres associés', '+33 1 09 78 56 34', '1994-01-01', 'adresse'),
(8, 'https://goo.gle/3DLEokh', 'Développement de logiciels Mountain View, CA · 33 M d’abonnés · Plus de 10 K employés', 'A problem isn\'t truly solved until it\'s solved for all. Googlers build products that help create opportunities for everyone, whether down the street or across the globe. Bring your insight, imagination and a healthy disregard for the impossible. Bring everything that makes you unique. Together, we can build for everyone.<br><br>Check out our career opportunities at goo.gle/3DLEokh', '10 001 employés et plus<br><br>287 009 membres associés', '+33 1 09 89 78 56', '1998-01-01', 'adresse'),
(9, 'https://www.esilv.fr', 'Enseignement supérieur Courbevoie · 17 K abonnés · 8 K anciens élèves', 'L’ESILV, Ecole Supérieure d’Ingénieurs Léonard de Vinci est une école d’ingénieurs généraliste au cœur des technologies du numérique située à Paris-La-Défense. Elle recrute principalement au niveau Baccalauréat (S et STI2D) et forme en 5 ans des ingénieurs opérationnels s’insérant parfaitement dans le monde professionnel. Le projet pédagogique de l’ESILV s’articule autour des sciences et des technologies numériques combinées à 4 grandes spécialisations : Informatique/Big Data & Objets connectés, Mécanique Numérique et Modélisation, Ingénierie Financière, Nouvelles Energies.', '201-500 employés', '+ 33 1 41 16 70 00', '1995-01-01', 'adresse');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `Like_ID` int NOT NULL AUTO_INCREMENT,
  `Post_ID` int DEFAULT NULL,
  `Nb_likes` int DEFAULT NULL,
  PRIMARY KEY (`Like_ID`),
  KEY `Post_ID` (`Post_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
CREATE TABLE IF NOT EXISTS `messagerie` (
  `Convers_ID` int NOT NULL AUTO_INCREMENT,
  `ID1` int DEFAULT NULL,
  `ID2` int DEFAULT NULL,
  PRIMARY KEY (`Convers_ID`),
  KEY `ID1` (`ID1`),
  KEY `ID2` (`ID2`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`Convers_ID`, `ID1`, `ID2`) VALUES
(1, 1, 2),
(2, 1, 4),
(3, 1, 3),
(4, 2, 4),
(5, 2, 3),
(6, 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `MSG_ID` int NOT NULL AUTO_INCREMENT,
  `Convers_ID` int DEFAULT NULL,
  `Sender_ID` int DEFAULT NULL,
  `Timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `Content` text,
  PRIMARY KEY (`MSG_ID`),
  KEY `Convers_ID` (`Convers_ID`),
  KEY `Sender_ID` (`Sender_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`MSG_ID`, `Convers_ID`, `Sender_ID`, `Timestamp`, `Content`) VALUES
(1, 1, 1, '2024-05-31 12:08:38', 'Salut Leon, comment vas-tu ?'),
(2, 1, 2, '2024-05-31 12:08:38', 'Salut Felix, je vais bien merci et toi ?'),
(3, 1, 1, '2024-05-31 12:08:38', 'Je vais bien aussi, merci. Comment se passe ta journée ?'),
(4, 1, 2, '2024-05-31 12:08:38', 'Ma journée se passe bien, j\'ai eu une réunion importante ce matin.'),
(5, 1, 1, '2024-05-31 12:08:38', 'C\'est super, j\'espère que ça s\'est bien passé.'),
(6, 1, 2, '2024-05-31 12:08:38', 'Oui, tout s\'est bien passé. Merci pour ton soutien.'),
(7, 1, 1, '2024-05-31 12:08:38', 'De rien, c\'est normal. N\'hésite pas si tu as besoin d\'aide.'),
(8, 2, 1, '2024-05-31 12:08:38', 'Salut Annabelle, comment vas-tu ?'),
(9, 2, 4, '2024-05-31 12:08:38', 'Salut Felix, je vais bien merci et toi ?'),
(10, 2, 1, '2024-05-31 12:08:38', 'Je vais bien aussi, merci. Comment se passe ta journée ?'),
(11, 2, 4, '2024-05-31 12:08:38', 'Ma journée se passe bien, j\'ai eu une réunion importante ce matin.'),
(12, 2, 1, '2024-05-31 12:08:38', 'C\'est super, j\'espère que ça s\'est bien passé.'),
(13, 2, 4, '2024-05-31 12:08:38', 'Oui, tout s\'est bien passé. Merci pour ton soutien.'),
(14, 2, 1, '2024-05-31 12:08:38', 'De rien, c\'est normal. N\'hésite pas si tu as besoin d\'aide.'),
(15, 3, 1, '2024-05-31 12:08:38', 'Salut Alara, comment vas-tu ?'),
(16, 3, 3, '2024-05-31 12:08:38', 'Salut Felix, je vais bien merci et toi ?'),
(17, 3, 1, '2024-05-31 12:08:38', 'Je vais bien aussi, merci. Comment se passe ta journée ?'),
(18, 3, 3, '2024-05-31 12:08:38', 'Ma journée se passe bien, j\'ai eu une réunion importante ce matin.'),
(19, 3, 1, '2024-05-31 12:08:38', 'C\'est super, j\'espère que ça s\'est bien passé.'),
(20, 3, 3, '2024-05-31 12:08:38', 'Oui, tout s\'est bien passé. Merci pour ton soutien.'),
(21, 3, 1, '2024-05-31 12:08:38', 'De rien, c\'est normal. N\'hésite pas si tu as besoin d\'aide.'),
(22, 4, 2, '2024-05-31 12:08:38', 'Salut Annabelle, comment vas-tu ?'),
(23, 4, 4, '2024-05-31 12:08:38', 'Salut Leon, je vais bien merci et toi ?'),
(24, 4, 2, '2024-05-31 12:08:38', 'Je vais bien aussi, merci. Comment se passe ta journée ?'),
(25, 4, 4, '2024-05-31 12:08:38', 'Ma journée se passe bien, j\'ai eu une réunion importante ce matin.'),
(26, 4, 2, '2024-05-31 12:08:38', 'C\'est super, j\'espère que ça s\'est bien passé.'),
(27, 4, 4, '2024-05-31 12:08:38', 'Oui, tout s\'est bien passé. Merci pour ton soutien.'),
(28, 4, 2, '2024-05-31 12:08:38', 'De rien, c\'est normal. N\'hésite pas si tu as besoin d\'aide.'),
(29, 5, 2, '2024-05-31 12:08:39', 'Salut Alara, comment vas-tu ?'),
(30, 5, 3, '2024-05-31 12:08:39', 'Salut Leon, je vais bien merci et toi ?'),
(31, 5, 2, '2024-05-31 12:08:39', 'Je vais bien aussi, merci. Comment se passe ta journée ?'),
(32, 5, 3, '2024-05-31 12:08:39', 'Ma journée se passe bien, j\'ai eu une réunion importante ce matin.'),
(33, 5, 2, '2024-05-31 12:08:39', 'C\'est super, j\'espère que ça s\'est bien passé.'),
(34, 5, 3, '2024-05-31 12:08:39', 'Oui, tout s\'est bien passé. Merci pour ton soutien.'),
(35, 5, 2, '2024-05-31 12:08:39', 'De rien, c\'est normal. N\'hésite pas si tu as besoin d\'aide.');

-- --------------------------------------------------------

--
-- Structure de la table `offre_emploi`
--

DROP TABLE IF EXISTS `offre_emploi`;
CREATE TABLE IF NOT EXISTS `offre_emploi` (
  `Job_ID` int NOT NULL AUTO_INCREMENT,
  `Enterprise_ID` int DEFAULT NULL,
  `Intitule` varchar(255) DEFAULT NULL,
  `Debut` date DEFAULT NULL,
  `Fin` date DEFAULT NULL,
  `Position` varchar(255) DEFAULT NULL,
  `Type_Contrat` varchar(255) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Texte` text,
  PRIMARY KEY (`Job_ID`),
  KEY `Enterprise_ID` (`Enterprise_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `offre_emploi`
--

INSERT INTO `offre_emploi` (`Job_ID`, `Enterprise_ID`, `Intitule`, `Debut`, `Fin`, `Position`, `Type_Contrat`, `Photo`, `Texte`) VALUES
(1, 1, 'Enseignant Permanent', '2024-09-01', '2025-08-31', 'Enseignant Senior en Mathématiques', 'Permanent', NULL, 'Nous recherchons un enseignant senior en mathématiques dédié pour rejoindre notre équipe de manière permanente. Le candidat doit avoir une solide formation en mathématiques et une expérience en enseignement.'),
(2, 3, 'Stage en Marketing', '2024-06-01', '2024-12-01', 'Stagiaire en Marketing', 'Stage', NULL, 'Notre entreprise partenaire offre un stage de six mois en marketing. C\'est une excellente opportunité pour acquérir de l\'expérience pratique dans un environnement dynamique.'),
(3, 2, 'Développeur Logiciel', '2024-07-01', '2025-06-30', 'Développeur Logiciel Junior', 'Temporaire', NULL, 'Rejoignez notre équipe technique en tant que Développeur Logiciel Junior pour un contrat d\'un an. Vous travaillerez sur des projets passionnants et acquerrez une expérience précieuse en développement logiciel.'),
(4, 4, 'Apprentissage en Finance', '2024-09-01', '2026-06-01', 'Apprenti en Finance', 'Apprentissage', NULL, 'Une opportunité d\'apprentissage en finance est disponible à FinanceGroup. Ce programme est conçu pour les personnes souhaitant démarrer une carrière en finance.'),
(5, 5, 'Chargé de Cours à Temps Partiel', '2024-10-01', '2025-06-30', 'Chargé de Cours en Informatique', 'Temps Partiel', NULL, 'Nous recherchons un chargé de cours à temps partiel en informatique pour enseigner des cours de premier cycle. Le candidat idéal aura une expérience dans l\'industrie et une passion pour l\'enseignement.');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `Post_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int DEFAULT NULL,
  `Enterprise_ID` int DEFAULT NULL,
  `DatePublication` datetime DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Texte` text,
  `Titre` varchar(255) DEFAULT NULL,
  `Lieu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Post_ID`),
  KEY `User_ID` (`User_ID`),
  KEY `Enterprise_ID` (`Enterprise_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

DROP TABLE IF EXISTS `projets`;
CREATE TABLE IF NOT EXISTS `projets` (
  `Proj_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int DEFAULT NULL,
  `Debut` date DEFAULT NULL,
  `Fin` date DEFAULT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Edu_ID` int DEFAULT NULL,
  PRIMARY KEY (`Proj_ID`),
  KEY `User_ID` (`User_ID`),
  KEY `Edu_ID` (`Edu_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`Proj_ID`, `User_ID`, `Debut`, `Fin`, `Nom`, `Edu_ID`) VALUES
(1, 1, '2022-09-01', '2024-06-01', 'ECE_CUP', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reseau`
--

DROP TABLE IF EXISTS `reseau`;
CREATE TABLE IF NOT EXISTS `reseau` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Lst_ID` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `Mail` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `MDP` varchar(255) NOT NULL,
  `Token` varchar(255) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Pays` varchar(100) DEFAULT NULL,
  `Entreprise_ID` int DEFAULT NULL,
  PRIMARY KEY (`User_ID`),
  KEY `Entreprise_ID` (`Entreprise_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`User_ID`, `Mail`, `Nom`, `Prenom`, `Username`, `MDP`, `Token`, `Photo`, `Pays`, `Entreprise_ID`) VALUES
(8, 'admin@apple.com', 'Bobby', 'Bobby', 'BobbyB', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo8.png', 'France', 6),
(7, 'admin@esilv.fr', '🤓', '🤓', '🤓🤓', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo7.png', 'France', 9),
(6, 'admin@axa.fr', 'Jesus', 'Rafael', 'RafaelJ', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo6.png', 'France', 7),
(5, 'admin@google.com', '', 'Bob', 'BobG', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo5.png', 'France', 8),
(4, 'aleoni@gmail.com', 'Leoni', 'Annabelle', 'AnnaL', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo4.png', 'France', 0),
(3, 'atanguy@gmail.com', 'Tanguy', 'Alara', 'AlaraT', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo3.png', 'France', 0),
(2, 'ldalle@gmail.com', 'Dalle', 'Leon', 'PinguD', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'f102a091187e54dc', '../photos/photo2.png', 'France', 0),
(1, 'fcadene@gmail.com', 'Cadene', 'Félix', 'FefeC', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo1.png', 'France', -1),
(9, 'admin@ece.com', 'Admin', 'Ece', 'EceP', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '94af072fa8177783', NULL, 'France', 1),
(10, 'admin@techcorp.com', 'Admin', 'Tech', 'TechC', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', NULL, 'France', 2),
(11, 'admin@marketingplus.com', 'Admin', 'Mark', 'MarkP', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', NULL, 'France', 3),
(12, 'admin@financegroup.com', 'Admin', 'Finance', 'FinG', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', NULL, 'France', 4),
(13, 'admin@itworld.com', 'Admin', 'World', 'WorldIT', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', NULL, 'France', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
