CREATE DATABASE IF NOT EXISTS ECEIn;
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
    Email VARCHAR(255), -- Ajout du champ Email
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
    Email VARCHAR(255) NOT NULL, -- Ajout du champ Email
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
    Logo VARCHAR(255),
    Texte TEXT,
    FOREIGN KEY (Enterprise_ID) REFERENCES Enterprise(Enterprise_ID)
);

CREATE TABLE IF NOT EXISTS Reseau (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Lst_ID INT
);

INSERT INTO Enterprise (Logo, Pays, Industrie, Nom_Entreprise, Tuteur, Information_ID, Email)
VALUES
('logoece.png', 'France', 'Education', 'ECE Paris', 'Dr. Xian Fernand', 1, 'info@eceparis.com'),
('logotechcorp.png', 'France', 'Technologie', 'TechCorp', 'Mme. Sophie Martin', 2, 'info@techcorp.com'),
('logomarketingplus.png', 'France', 'Marketing', 'MarketingPlus', 'Mr. Kamel Leclerc', 3, 'info@marketingplus.com'),
('logofinancegroup.png', 'France', 'Finance', 'FinanceGroup', 'Mme. Ben Zacomi', 4, 'info@financegroup.com'),
('logoitworld.png', 'France', 'Informatique', 'ITWorld', 'Mr. Thomas Petit', 5, 'info@itworld.com');

UPDATE Utilisateur SET Email = 'fcadene@gmail.com' WHERE User_ID = 1;
UPDATE Utilisateur SET Email = 'ldalle@gmail.com' WHERE User_ID = 2;
UPDATE Utilisateur SET Email = 'atanguy@gmail.com' WHERE User_ID = 3;
UPDATE Utilisateur SET Email = 'aleoni@gmail.com' WHERE User_ID = 4;

UPDATE Utilisateur u
JOIN Enterprise e ON u.Email = e.Email
SET u.Entreprise_ID = e.Enterprise_ID;
