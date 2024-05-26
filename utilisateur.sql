CREATE DATABASE IF NOT EXISTS ECEIn;
USE ECEIn;

CREATE TABLE IF NOT EXISTS Utilisateur (
    User_ID INT(11) PRIMARY KEY AUTO_INCREMENT,
    Mail VARCHAR(255) NOT NULL,
    Nom VARCHAR(255) NOT NULL,
    Prenom VARCHAR(255) NOT NULL,
    Username VARCHAR(255) NOT NULL,
    MDP VARCHAR(255) NOT NULL,
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
    Msg_ID INT PRIMARY KEY AUTO_INCREMENT,
    ID1 INT,
    ID2 INT,
    FOREIGN KEY (ID1) REFERENCES Utilisateur(User_ID),
    FOREIGN KEY (ID2) REFERENCES Utilisateur(User_ID),
    UNIQUE (ID1, ID2)
);

CREATE TABLE IF NOT EXISTS Messages (
    Message_ID INT PRIMARY KEY AUTO_INCREMENT,
    Msg_ID INT,
    Sender_ID INT,
    Timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    Content TEXT,
    FOREIGN KEY (Msg_ID) REFERENCES Messagerie(Msg_ID),
    FOREIGN KEY (Sender_ID) REFERENCES Utilisateur(User_ID)
);

CREATE TABLE IF NOT EXISTS Education (
    Edu_ID INT PRIMARY KEY  AUTO_INCREMENT,
    User_ID INT,
    Debut DATE,
    Fin DATE,
    Nom VARCHAR(255),
    Type_formation VARCHAR(255),
    FOREIGN KEY (User_ID) REFERENCES Utilisateur(User_ID)
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


INSERT INTO Utilisateur (User_ID, Mail, Nom, Prenom, Username, MDP, Photo, Pays, Statut_Admin) 
VALUES (1, 'fcadene@gmail.com', 'Cadene', 'Felix', 'FefeC', '1234', 'photos/photo1', 'France', 1),
       (2, 'ldalle@gmail.com', 'Dalle', 'Leon', 'PinguD', '1234', 'photos/photo2', 'France', 0),
       (3, 'atanguy@gmail.com', 'Tanguy', 'Alara', 'AlaraT', '1234', 'photos/photo3', 'France', 0),
       (4, 'aleoni@gmail.com', 'Leoni', 'Annabelle', 'AnnaL', '1234', 'photos/photo4', 'France', 0);

INSERT INTO Education (Edu_ID, User_ID, Debut, Fin, Nom, Type_formation)
VALUES (1, 1, '2022-09-01', '2027-06-01', 'ECE Paris', 'Ingenieurie');

INSERT INTO Projets (Proj_ID, User_ID, Debut, Fin, Nom, Edu_ID)
VALUES (1, 1, '2022-09-01', '2024-06-01', 'ECE_CUP', 1);

INSERT INTO Experience (Exp_ID, User_ID, Debut, Fin, Position, Type_Contrat, Enterprise_ID)
VALUES (1, 1, '2023-12-01', '2024-01-01', 'Stagiaire au Cabinet du Maire', 'Stage', 1);

INSERT INTO Enterprise (Enterprise_ID, Logo, Pays, Industrie, Nom_Entreprise, Tuteur)
VALUES (1, 'Entrprise/logo1', 'France', 'Administration', 'Mairie de Paris', 'Anne Hidalgo');

SELECT Utilisateur.Nom, Utilisateur.Prenom, Projets.Nom, Education.Nom, Experience.Position, Enterprise.Nom_Entreprise
FROM Utilisateur
JOIN Projets ON Utilisateur.User_ID = Projets.User_ID
JOIN Education ON Projets.Edu_ID = Education.Edu_ID
JOIN Experience ON Utilisateur.User_ID = Experience.User_ID
JOIN Enterprise ON Experience.Enterprise_ID = Enterprise.Enterprise_ID
WHERE Utilisateur.User_ID = 1;
