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
    Post_ID INT,
    Nb_likes INT,
    PRIMARY KEY (Post_ID),
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
    Edu_ID INT PRIMARY KEY AUTO_INCREMENT,
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
    Proj_ID INT PRIMARY KEY,
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
    Lst_ID INT,
    FOREIGN KEY (Lst_ID) REFERENCES Utilisateur(User_ID)
);

INSERT INTO Utilisateur (Mail, Nom, Prenom, Username, MDP, Photo, Pays, Statut_Admin) 
VALUES ('fcadene@gmail.com', 'Cadene', 'Felix', 'FefeC', '1234', 'photos/photo1', 'France', 1),
       ('ldalle@gmail.com', 'Dalle', 'Leon', 'PinguD', '1234', 'photos/photo2', 'France', 0),
       ('atanguy@gmail.com', 'Tanguy', 'Alara', 'AlaraT', '1234', 'photos/photo3', 'France', 0),
       ('aleoni@gmail.com', 'Leoni', 'Annabelle', 'AnnaL', '1234', 'photos/photo4', 'France', 0);

INSERT INTO Education (User_ID, Debut, Fin, Nom, Type_formation)
VALUES (1, '2018-09-01', '2023-06-01', 'ECE Paris', 'Ingenieurie');

INSERT INTO Projets 

-- Requete SQL pour afficher les utilisateurs
SELECT * FROM Utilisateur;

-- Requete SQL pour afficher les projets de Felix Cadene
SELECT 
