DROP DATABASE IF EXISTS ECEIn;
CREATE DATABASE ECEIn;
USE ECEIn;

DROP TABLE IF EXISTS `commentaires`, `education`, `informations`,  `enterprise`, `events`, `experience`, `likes`, `messagerie`, `messages`, `offre_emploi`, `posts`, `projets`, `reseau`, `utilisateur`;

CREATE TABLE IF NOT EXISTS Informations (
    Information_ID INT PRIMARY KEY AUTO_INCREMENT,
    Site_Web VARCHAR(255),
    Texte_Intro TEXT,
    Taille VARCHAR(255),
    Quartier_General VARCHAR(255),
    Annee_Fondation DATE,
    Lieu VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Enterprise (
    Enterprise_ID INT PRIMARY KEY AUTO_INCREMENT,
    Logo VARCHAR(255),
    Pays VARCHAR(255),
    Industrie VARCHAR(255),
    Nom_Entreprise VARCHAR(255) NOT NULL,
    Tuteur VARCHAR(255),
    Information_ID INT,
    FOREIGN KEY (Information_ID) REFERENCES Informations(Information_ID)
);

CREATE TABLE IF NOT EXISTS Utilisateur (
    User_ID INT PRIMARY KEY AUTO_INCREMENT,
    Mail VARCHAR(255) NOT NULL,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Username VARCHAR(255) NOT NULL,
    MDP VARCHAR(255) NOT NULL,
    Token VARCHAR(255),
    Photo VARCHAR(255),
    Pays VARCHAR(100),
    Statut_Admin INT NOT NULL,
    Statut_Utilisateur INT NOT NULL,
    Entreprise_ID INT,
    FOREIGN KEY (Entreprise_ID) REFERENCES Enterprise(Enterprise_ID)
);

CREATE TABLE IF NOT EXISTS Posts (
    Post_ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT,
    Enterprise_ID INT,
    DatePublication DATETIME,
    Photo VARCHAR(255),
    Texte TEXT,
    Titre VARCHAR(255),
    Lieu VARCHAR(255),
    FOREIGN KEY (User_ID) REFERENCES Utilisateur(User_ID),
    FOREIGN KEY (Enterprise_ID) REFERENCES Enterprise(Enterprise_ID)
);

CREATE TABLE IF NOT EXISTS Likes (
    Like_ID INT PRIMARY KEY AUTO_INCREMENT,
    Post_ID INT,
    Nb_likes INT,
    FOREIGN KEY (Post_ID) REFERENCES Posts(Post_ID)
);

CREATE TABLE IF NOT EXISTS Commentaires (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Post_ID INT,
    User_ID INT,
    Texte TEXT,
    FOREIGN KEY (Post_ID) REFERENCES Posts(Post_ID),
    FOREIGN KEY (User_ID) REFERENCES Utilisateur(User_ID)
);

CREATE TABLE IF NOT EXISTS Messagerie (
    Convers_ID INT PRIMARY KEY AUTO_INCREMENT,
    ID1 INT,
    ID2 INT,
    FOREIGN KEY (ID1) REFERENCES Utilisateur(User_ID),
    FOREIGN KEY (ID2) REFERENCES Utilisateur(User_ID)
);

CREATE TABLE IF NOT EXISTS Messages (
    MSG_ID INT PRIMARY KEY AUTO_INCREMENT,
    Convers_ID INT,
    Sender_ID INT,
    Timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    Content TEXT,
    FOREIGN KEY (Convers_ID) REFERENCES Messagerie(Convers_ID),
    FOREIGN KEY (Sender_ID) REFERENCES Utilisateur(User_ID)
);

CREATE TABLE IF NOT EXISTS Education (
    Edu_ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT,
    Debut DATE,
    Fin DATE,
    Nom VARCHAR(255),
    Type_formation VARCHAR(255),
    Enterprise_ID INT,
    FOREIGN KEY (User_ID) REFERENCES Utilisateur(User_ID),
    FOREIGN KEY (Enterprise_ID) REFERENCES Enterprise(Enterprise_ID)
);

CREATE TABLE IF NOT EXISTS Experience (
    Exp_ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT,
    Debut DATE,
    Fin DATE,
    Position VARCHAR(255),
    Type_Contrat VARCHAR(255),
    Enterprise_ID INT,
    FOREIGN KEY (User_ID) REFERENCES Utilisateur(User_ID),
    FOREIGN KEY (Enterprise_ID) REFERENCES Enterprise(Enterprise_ID)
);

CREATE TABLE IF NOT EXISTS Projets (
    Proj_ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT,
    Debut DATE,
    Fin DATE,
    Nom VARCHAR(255),
    Edu_ID INT,
    FOREIGN KEY (User_ID) REFERENCES Utilisateur(User_ID),
    FOREIGN KEY (Edu_ID) REFERENCES Education(Edu_ID)
);

CREATE TABLE IF NOT EXISTS Events (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Enterprise_ID INT,
    Intitule VARCHAR(255),
    Debut DATE,
    Fin DATE,
    Photo VARCHAR(255),
    Texte TEXT,
    FOREIGN KEY (Enterprise_ID) REFERENCES Enterprise(Enterprise_ID)
);

CREATE TABLE IF NOT EXISTS Offre_Emploi (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Enterprise_ID INT,
    Intitule VARCHAR(255),
    Debut DATE,
    Fin DATE,
    Position VARCHAR(255),
    Type_Contrat VARCHAR(255),
    Photo VARCHAR(255),
    Texte TEXT,
    FOREIGN KEY (Enterprise_ID) REFERENCES Enterprise(Enterprise_ID)
);

CREATE TABLE IF NOT EXISTS Relations (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UID1 INT,
    UID2 INT
);

INSERT INTO Relations (UID1, UID2)
VALUES  (1, 2),
        (1, 3),
        (1, 4),
        (2, 3),
        (2, 4),
        (3, 4);

-- Sample data insertion
INSERT INTO Utilisateur (User_ID, Mail, Nom, Prenom, Username, MDP, Token, Photo, Pays, Statut_Admin, Statut_Utilisateur, Entreprise_ID) 
VALUES (1, 'fcadene@gmail.com', 'Cadene', 'Félix', 'FefeC', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo1.png', 'France', 1, 0, 0),
        (2, 'ldalle@gmail.com', 'Dalle', 'Leon', 'PinguD', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo2.png', 'France', 0, 1, 0),
        (3, 'atanguy@gmail.com', 'Tanguy', 'Alara', 'AlaraT', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo3.png', 'France', 0, 2, 1),
        (4, 'aleoni@gmail.com', 'Leoni', 'Annabelle', 'AnnaL', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo4.png', 'France', 0, 2, 2);

INSERT INTO Education (Edu_ID, User_ID, Debut, Fin, Nom, Type_formation, Enterprise_ID)
VALUES (1, 1, '2022-09-01', '2027-06-01', 'Etudiant', 'Ingenieur', 1);

INSERT INTO Projets (Proj_ID, User_ID, Debut, Fin, Nom, Edu_ID)
VALUES (1, 1, '2022-09-01', '2024-06-01', 'ECE_CUP', 1);

INSERT INTO Experience (Exp_ID, User_ID, Debut, Fin, Position, Type_Contrat, Enterprise_ID)
VALUES (1, 1, '2023-09-01', '2024-06-01', 'Ambassadeur', 'Contrat', 1);

INSERT INTO Enterprise (Logo, Pays, Industrie, Nom_Entreprise, Tuteur, Information_ID)
VALUES
('logoece.png', 'France', 'Education', 'ECE Paris', 'Dr. Xian Fernand', 1),
('logotechcorp.png', 'France', 'Technologie', 'TechCorp', 'Mme. Sophie Martin', 2),
('logomarketingplus.png', 'France', 'Marketing', 'MarketingPlus', 'Mr. Kamel Leclerc', 3),
('logofinancegroup.png', 'France', 'Finance', 'FinanceGroup', 'Mme. Ben Zacomi', 4),
('logoitworld.png', 'France', 'Informatique', 'ITWorld', 'Mr. Thomas Petit', 5);

INSERT INTO Offre_Emploi (Enterprise_ID, Intitule, Debut, Fin, Position, Type_Contrat, Texte)
VALUES
(1, 'Enseignant Permanent', '2024-09-01', '2025-08-31', 'Enseignant Senior en Mathématiques', 'Permanent', 'Nous recherchons un enseignant senior en mathématiques dédié pour rejoindre notre équipe de manière permanente. Le candidat doit avoir une solide formation en mathématiques et une expérience en enseignement.'),
(3, 'Stage en Marketing', '2024-06-01', '2024-12-01', 'Stagiaire en Marketing', 'Stage', 'Notre entreprise partenaire offre un stage de six mois en marketing. C\'est une excellente opportunité pour acquérir de l\'expérience pratique dans un environnement dynamique.'),
(2, 'Développeur Logiciel', '2024-07-01', '2025-06-30', 'Développeur Logiciel Junior', 'Temporaire', 'Rejoignez notre équipe technique en tant que Développeur Logiciel Junior pour un contrat d\'un an. Vous travaillerez sur des projets passionnants et acquerrez une expérience précieuse en développement logiciel.'),
(4, 'Apprentissage en Finance', '2024-09-01', '2026-06-01', 'Apprenti en Finance', 'Apprentissage', 'Une opportunité d\'apprentissage en finance est disponible à FinanceGroup. Ce programme est conçu pour les personnes souhaitant démarrer une carrière en finance.'),
(5, 'Chargé de Cours à Temps Partiel', '2024-10-01', '2025-06-30', 'Chargé de Cours en Informatique', 'Temps Partiel', 'Nous recherchons un chargé de cours à temps partiel en informatique pour enseigner des cours de premier cycle. Le candidat idéal aura une expérience dans l\'industrie et une passion pour l\'enseignement.');


INSERT INTO Messagerie (ID1, ID2)
VALUES (1, 2),
        (1, 4),
        (1, 3),
        (2, 4),
        (2, 3),
        (3, 4);

INSERT INTO Messages (Convers_ID, Sender_ID, Content)
VALUES  (1, 1, 'Salut Leon, comment vas-tu ?'),
        (1, 2, 'Salut Felix, je vais bien merci et toi ?'),
        (1, 1, 'Je vais bien aussi, merci. Comment se passe ta journée ?'),
        (1, 2, 'Ma journée se passe bien, j\'ai eu une réunion importante ce matin.'),
        (1, 1, 'C\'est super, j\'espère que ça s\'est bien passé.'),
        (1, 2, 'Oui, tout s\'est bien passé. Merci pour ton soutien.'),
        (1, 1, 'De rien, c\'est normal. N\'hésite pas si tu as besoin d\'aide.');
        
INSERT INTO Messages (Convers_ID, Sender_ID, Content)
VALUES  (2, 1, 'Salut Annabelle, comment vas-tu ?'),
        (2, 4, 'Salut Felix, je vais bien merci et toi ?'),
        (2, 1, 'Je vais bien aussi, merci. Comment se passe ta journée ?'),
        (2, 4, 'Ma journée se passe bien, j\'ai eu une réunion importante ce matin.'),
        (2, 1, 'C\'est super, j\'espère que ça s\'est bien passé.'),
        (2, 4, 'Oui, tout s\'est bien passé. Merci pour ton soutien.'),
        (2, 1, 'De rien, c\'est normal. N\'hésite pas si tu as besoin d\'aide.');

INSERT INTO Messages (Convers_ID, Sender_ID, Content)
VALUES  (3, 1, 'Salut Alara, comment vas-tu ?'),
        (3, 3, 'Salut Felix, je vais bien merci et toi ?'),
        (3, 1, 'Je vais bien aussi, merci. Comment se passe ta journée ?'),
        (3, 3, 'Ma journée se passe bien, j\'ai eu une réunion importante ce matin.'),
        (3, 1, 'C\'est super, j\'espère que ça s\'est bien passé.'),
        (3, 3, 'Oui, tout s\'est bien passé. Merci pour ton soutien.'),
        (3, 1, 'De rien, c\'est normal. N\'hésite pas si tu as besoin d\'aide.');

INSERT INTO Messages (Convers_ID, Sender_ID, Content)
VALUES  (4, 2, 'Salut Annabelle, comment vas-tu ?'),
        (4, 4, 'Salut Leon, je vais bien merci et toi ?'),
        (4, 2, 'Je vais bien aussi, merci. Comment se passe ta journée ?'),
        (4, 4, 'Ma journée se passe bien, j\'ai eu une réunion importante ce matin.'),
        (4, 2, 'C\'est super, j\'espère que ça s\'est bien passé.'),
        (4, 4, 'Oui, tout s\'est bien passé. Merci pour ton soutien.'),
        (4, 2, 'De rien, c\'est normal. N\'hésite pas si tu as besoin d\'aide.');

INSERT INTO Messages (Convers_ID, Sender_ID, Content)
VALUES  (5, 2, 'Salut Alara, comment vas-tu ?'),
        (5, 3, 'Salut Leon, je vais bien merci et toi ?'),
        (5, 2, 'Je vais bien aussi, merci. Comment se passe ta journée ?'),
        (5, 3, 'Ma journée se passe bien, j\'ai eu une réunion importante ce matin.'),
        (5, 2, 'C\'est super, j\'espère que ça s\'est bien passé.'),
        (5, 3, 'Oui, tout s\'est bien passé. Merci pour ton soutien.'),
        (5, 2, 'De rien, c\'est normal. N\'hésite pas si tu as besoin d\'aide.');