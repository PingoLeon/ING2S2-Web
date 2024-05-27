CREATE DATABASE IF NOT EXISTS ECEIn;
USE ECEIn;

DROP TABLE IF EXISTS `commentaires`, `education`, `enterprise`, `events`, `experience`, `likes`, `messagerie`, `messages`, `offre_emploi`, `posts`, `projets`, `reseau`, `utilisateur`;


CREATE TABLE IF NOT EXISTS Utilisateur (
    User_ID INT(11) PRIMARY KEY AUTO_INCREMENT,
    Mail VARCHAR(255) NOT NULL,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Username VARCHAR(255) NOT NULL,
    MDP VARCHAR(255) NOT NULL,
    Token VARCHAR(255) NOT NULL,
    Photo VARCHAR(255) NOT NULL,
    Pays VARCHAR(100) NOT NULL,
    Statut_Admin INT NOT NULL
);



CREATE TABLE IF NOT EXISTS Enterprise (
    Enterprise_ID INT PRIMARY KEY AUTO_INCREMENT,
    Logo VARCHAR(255),
    Pays VARCHAR(255),
    Industrie VARCHAR(255),
    Nom_Entreprise VARCHAR(255) NOT NULL,
    Tuteur VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Posts (
    Post_ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT,
    Enterprise_ID INT,
    Date DATETIME,
    Photo VARCHAR(255),
    Texte TEXT,
    FOREIGN KEY (User_ID) REFERENCES Utilisateur(User_ID),
    FOREIGN KEY (Enterprise_ID) REFERENCES Enterprise(Enterprise_ID)
);

CREATE TABLE IF NOT EXISTS Likes (
    Post_ID INT PRIMARY KEY AUTO_INCREMENT,
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
    MSG_ID INT PRIMARY KEY,
    Convers_ID INT,
    Sender_ID INT,
    Timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    Content TEXT,
    FOREIGN KEY (Convers_ID) REFERENCES Messagerie(Convers_ID),
    FOREIGN KEY (Sender_ID) REFERENCES Utilisateur(User_ID)
);

CREATE TABLE IF NOT EXISTS Education (
    Edu_ID INT PRIMARY KEY  AUTO_INCREMENT,
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

CREATE TABLE IF NOT EXISTS Reseau (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Lst_ID INT
);


INSERT INTO Utilisateur (User_ID, Mail, Nom, Prenom, Username, MDP, Token, Photo, Pays, Statut_Admin) 
VALUES (1, 'fcadene@gmail.com', 'Cadene', 'Felix', 'FefeC', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', 'photos/photo1', 'France', 1),
       (2, 'ldalle@gmail.com', 'Dalle', 'Leon', 'PinguD', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', 'photos/photo2', 'France', 0),
       (3, 'atanguy@gmail.com', 'Tanguy', 'Alara', 'AlaraT', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', 'photos/photo3', 'France', 0),
       (4, 'aleoni@gmail.com', 'Leoni', 'Annabelle', 'AnnaL', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', 'photos/photo4', 'France', 0);

INSERT INTO Education (Edu_ID, User_ID, Debut, Fin, Nom, Type_formation, Enterprise_ID)
VALUES (1, 1, '2022-09-01', '2027-06-01', 'ECE Paris', 'Ingenieur', 2);

INSERT INTO Projets (Proj_ID, User_ID, Debut, Fin, Nom, Edu_ID)
VALUES (1, 1, '2022-09-01', '2024-06-01', 'ECE_CUP', 1);

INSERT INTO Experience (Exp_ID, User_ID, Debut, Fin, Position, Type_Contrat, Enterprise_ID)
VALUES (1, 1, '2023-12-01', '2024-01-01', 'Stagiaire au Cabinet du Maire', 'Stage', 1);

INSERT INTO Enterprise (Enterprise_ID, Logo, Pays, Industrie, Nom_Entreprise, Tuteur)
VALUES (1, 'Entreprise/logo1', 'France', 'Administration', 'Mairie de Paris', 'Anne Hidalgo');

INSERT INTO Experience (User_ID, Debut, Fin, Position, Type_Contrat, Enterprise_ID)
VALUES (1, '2023-09-01', '2024-06-01', 'Ambassadeur', 'Contrat', 2);

INSERT INTO Enterprise (Logo, Pays, Industrie, Nom_Entreprise, Tuteur)
VALUES ('Entreprise/logo2', 'France', 'Ingenieur', 'ECE Paris', 'Vanessa');

INSERT INTO Enterprise (Logo, Pays, Industrie, Nom_Entreprise, Tuteur)
VALUES ('Entreprise/logo3', 'France', 'Ingenieur', 'ESILV', 'Bobby');

/*
SELECT Utilisateur.Nom, Utilisateur.Prenom, Projets.Nom, Education.Nom, Experience.Position, Enterprise.Nom_Entreprise
FROM Utilisateur
JOIN Projets ON Utilisateur.User_ID = Projets.User_ID
JOIN Education ON Projets.Edu_ID = Education.Edu_ID
JOIN Experience ON Utilisateur.User_ID = Experience.User_ID
JOIN Enterprise ON Experience.Enterprise_ID = Enterprise.Enterprise_ID
WHERE Utilisateur.User_ID = 1;



SELECT Utilisateur.Nom, Utilisateur.Prenom, Experience.Position, Experience.Debut, Experience.Fin, Experience.Type_Contrat, Enterprise.Nom_Entreprise, Enterprise.Logo
FROM Utilisateur
JOIN Experience ON Utilisateur.User_ID = Experience.User_ID
JOIN Enterprise ON Experience.Enterprise_ID = Enterprise.Enterprise_ID
WHERE Utilisateur.User_ID = 1
ORDER BY Experience.Debut DESC;

-- Same as above but instead of experience, we want to see the projects
SELECT Utilisateur.Nom, Utilisateur.Prenom, Projets.Nom, Projets.Debut, Projets.Fin, Education.Nom
FROM Utilisateur
JOIN Projets ON Utilisateur.User_ID = Projets.User_ID
JOIN Education ON Projets.Edu_ID = Education.Edu_ID
JOIN Enterprise ON Education.User_ID = Enterprise.Enterprise_ID
WHERE Utilisateur.User_ID = 1
ORDER BY Projets.Debut DESC;

-- Same as above but instead of projects, we want to see the posts
SELECT Utilisateur.Nom, Utilisateur.Prenom, Posts.Texte, Posts.Date
FROM Utilisateur
JOIN Posts ON Utilisateur.User_ID = Posts.User_ID
WHERE Utilisateur.User_ID = 1
ORDER BY Posts.Date DESC;

-- Same as above but instead of posts, we want to see the education
SELECT Utilisateur.Nom, Utilisateur.Prenom, Education.Nom, Education.Debut, Education.Fin, Education.Type_formation, Enterprise.Nom_Entreprise, Enterprise.Logo
FROM Utilisateur
JOIN Education ON Utilisateur.User_ID = Education.User_ID
JOIN Enterprise ON Education.Enterprise_ID = Enterprise.Enterprise_ID
WHERE Utilisateur.User_ID = 1
ORDER BY Education.Debut DESC;
*/
