DROP DATABASE IF EXISTS ECEIn;
CREATE DATABASE ECEIn;
USE ECEIn;

DROP TABLE IF EXISTS `commentaires`, `education`, `applications`, `informations`,  `enterprise`, `events`, `experience`, `likes`, `messagerie`, `messages`, `offre_emploi`, `posts`, `projets`, `reseau`, `utilisateur`;

CREATE TABLE IF NOT EXISTS Informations (
    Information_ID INT PRIMARY KEY AUTO_INCREMENT,
    Site_Web VARCHAR(255),
    Intro TEXT,
    Informations TEXT,
    Taille VARCHAR(255),
    Telephone VARCHAR(255),
    Annee_Fondation DATE,
    Lieu VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Enterprise (
    Enterprise_ID INT PRIMARY KEY AUTO_INCREMENT,
    Logo VARCHAR(255),
    Pays VARCHAR(255),
    Industrie VARCHAR(255),
    Banniere VARCHAR(255),
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
    Statut_Utilisateur INT NOT NULL
);

CREATE TABLE IF NOT EXISTS Applications (
    Applications_ID INT PRIMARY KEY AUTO_INCREMENT,
    job_id INT,
    user_id INT,
    application_date DATE,
    FOREIGN KEY (job_id) REFERENCES Offre_Emploi(Job_ID),
    FOREIGN KEY (user_id) REFERENCES Utilisateur(User_ID)
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
    FOREIGN KEY (Enterprise_ID) REFERENCES Entreprise(Enterprise_ID)
);

CREATE TABLE IF NOT EXISTS Likes (
    Like_ID INT PRIMARY KEY AUTO_INCREMENT,
    Post_ID INT,
    Nb_likes INT,
    FOREIGN KEY (Post_ID) REFERENCES Posts(Post_ID)
);

CREATE TABLE IF NOT EXISTS Commentaires (
    Comment_ID INT PRIMARY KEY AUTO_INCREMENT,
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
    FOREIGN KEY (Enterprise_ID) REFERENCES Entreprise(Enterprise_ID)
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
    FOREIGN KEY (Enterprise_ID) REFERENCES Entreprise(Enterprise_ID)
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
    Event_ID INT PRIMARY KEY AUTO_INCREMENT,
    Enterprise_ID INT,
    Intitule VARCHAR(255),
    Debut DATE,
    Fin DATE,
    Photo VARCHAR(255),
    Texte TEXT,
    FOREIGN KEY (Enterprise_ID) REFERENCES Entreprise(Enterprise_ID)
);

CREATE TABLE IF NOT EXISTS Offre_Emploi (
    Job_ID INT PRIMARY KEY AUTO_INCREMENT,
    Enterprise_ID INT,
    Intitule VARCHAR(255),
    Debut DATE,
    Fin DATE,
    Position VARCHAR(255),
    Type_Contrat VARCHAR(255),
    Photo VARCHAR(255),
    Texte TEXT,
    FOREIGN KEY (Enterprise_ID) REFERENCES Entreprise(Enterprise_ID)
);

CREATE TABLE IF NOT EXISTS Reseau (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Lst_ID INT
);


-- Sample data insertion
INSERT INTO `utilisateur` (`User_ID`, `Mail`, `Nom`, `Prenom`, `Username`, `MDP`, `Token`, `Photo`, `Pays`, `Statut_Admin`, `Statut_Utilisateur`) VALUES
(1, 'fcadene@gmail.com', 'Cadene', 'Félix', 'FefeC', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo1.png', 'France', 1, 0),
(2, 'ldalle@gmail.com', 'Dalle', 'Leon', 'PinguD', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '8fa7521521dd24b4', '../photos/photo2.png', 'France', 0, 1),
(3, 'atanguy@gmail.com', 'Tanguy', 'Alara', 'AlaraT', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo3.png', 'France', 0, 2),
(4, 'aleoni@gmail.com', 'Leoni', 'Annabelle', 'AnnaL', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo4.png', 'France', 0, 2);

INSERT INTO Education (Edu_ID, User_ID, Debut, Fin, Nom, Type_formation, Enterprise_ID)
VALUES (1, 1, '2022-09-01', '2027-06-01', 'Etudiant', 'Ingenieur', 1);

INSERT INTO Projets (Proj_ID, User_ID, Debut, Fin, Nom, Edu_ID)
VALUES (1, 1, '2022-09-01', '2024-06-01', 'ECE_CUP', 1);

INSERT INTO Experience (Exp_ID, User_ID, Debut, Fin, Position, Type_Contrat, Enterprise_ID)
VALUES (1, 1, '2023-09-01', '2024-06-01', 'Ambassadeur', 'Contrat', 1);

INSERT INTO `enterprise` (`Enterprise_ID`, `Logo`, `Pays`, `Industrie`, `Nom_Entreprise`, `Tuteur`, `Information_ID`) VALUES
(1, 'PhotosEntreprises/logoece.png', 'France', 'Education', 'ECE Paris', 'Dr. Xian Fernand', 1),
(2, 'PhotosEntreprises/logotechcorp.png', 'France', 'Technologie', 'TechCorp', 'Mme. Sophie Martin', 2),
(3, 'PhotosEntreprises/logomarketingplus.png', 'France', 'Marketing', 'MarketingPlus', 'Mr. Kamel Leclerc', 3),
(4, 'PhotosEntreprises/logofinancegroup.png', 'France', 'Finance', 'FinanceGroup', 'Mme. Ben Zacomi', 4),
(5, 'PhotosEntreprises/logoitworld.png', 'France', 'Informatique', 'ITWorld', 'Mr. Thomas Petit', 5);

INSERT INTO `offre_emploi` (`Job_ID`, `Enterprise_ID`, `Intitule`, `Debut`, `Fin`, `Position`, `Type_Contrat`, `Photo`, `Texte`) VALUES
(1, 1, 'Enseignant Permanent', '2024-09-01', '2025-08-31', 'Enseignant Senior en Mathématiques', 'Permanent', NULL, 'Nous recherchons un enseignant senior en mathématiques dédié pour rejoindre notre équipe de manière permanente. Le candidat doit avoir une solide formation en mathématiques et une expérience en enseignement.'),
(2, 3, 'Stage en Marketing', '2024-06-01', '2024-12-01', 'Stagiaire en Marketing', 'Stage', NULL, 'Notre entreprise partenaire offre un stage de six mois en marketing. C\'est une excellente opportunité pour acquérir de l\'expérience pratique dans un environnement dynamique.'),
(3, 2, 'Développeur Logiciel', '2024-07-01', '2025-06-30', 'Développeur Logiciel Junior', 'Temporaire', NULL, 'Rejoignez notre équipe technique en tant que Développeur Logiciel Junior pour un contrat d\'un an. Vous travaillerez sur des projets passionnants et acquerrez une expérience précieuse en développement logiciel.'),
(4, 4, 'Apprentissage en Finance', '2024-09-01', '2026-06-01', 'Apprenti en Finance', 'Apprentissage', NULL, 'Une opportunité d\'apprentissage en finance est disponible à FinanceGroup. Ce programme est conçu pour les personnes souhaitant démarrer une carrière en finance.'),
(5, 5, 'Chargé de Cours à Temps Partiel', '2024-10-01', '2025-06-30', 'Chargé de Cours en Informatique', 'Temps Partiel', NULL, 'Nous recherchons un chargé de cours à temps partiel en informatique pour enseigner des cours de premier cycle. Le candidat idéal aura une expérience dans l\'industrie et une passion pour l\'enseignement.');


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


INSERT INTO `informations` (`Information_ID`, `Intro`, `Site_Web`, `Informations`, `Taille`, `Telephone`, `Annee_Fondation`, `Lieu`) VALUES
(1, 'Programmes d’administration de l’éducation Paris, île-de-france · 26 K abonnés · 15 K anciens élèves', 'https://www.ece.fr', 'L\'ECE école d\'ingénieurs multiprogrammes, multi-campus et multi-secteurs, spécialisée dans l\'ingénierie numérique, forme les ingénieurs et les experts en technologie du 21ème siècle, capables de relever les défis de la double révolution numérique et du développement durable.\r\n <br><br> \r\n Les nombreuses associations étudiantes et les voyages internationaux proposés aux étudiants leur offrent une expérience de premier ordre, ainsi qu\'une large ouverture sur le monde d\'aujourd\'hui et de demain.\r\n <br><br> ECE propose trois programmes d\'enseignement supérieur : le programme Grande Ecole d\'ingénieurs, le programme Bachelor et le programme MSc.', '51-200 employés', '+33 1 44 39 06 00', '1919-01-01', 'https://www.google.fr/maps/place/ECE++Ecole+d\'ingénieurs++Campus+de+Paris/@48.8516383,2.2847697,17z/data=!3m1!5s0x47e670049820700f:0x5e9c35374e6fe5df!4m10!1m2!2m1!1sece!3m6!1s0x47e6701b4f58251b:0x167f5a60fb94aa76!8m2!3d48.8512252!4d2.2885659!15sCgNlY2UiA4'),
(2, '', 'https://www.TechCorps', 'TechCorps est une entreprise', '', '', '0000-00-00', ''),
(3, '', 'https://www.MarketingPlus', '', '', '', '0000-00-00', ''),
(4, '', 'https://www.FinanceGroup', '', '', '', '0000-00-00', ''),
(5, '', 'https://www.ITWorld', '', '', '', '0000-00-00', ''),
(6, 'Fabrication de produits informatiques et électroniques Cupertino, California · 18 M d’abonnés · Plus de 10 K employés', 'http://www.apple.com/careers', 'We\'re a diverse collective of thinkers and doers, continually reimagining what\'s possible to help us all do what we love in new ways. And the same innovation that goes into our products also applies to our practices — strengthening our commitment to leave the world better than we found it. This is where your work can make a difference in people\'s lives. Including your own. <br><br> Apple is an equal opportunity employer that is committed to inclusion and diversity. Visit apple.com/careers to learn more.', '10 001 employés et plus<br><br>171 219 membres associés', '+33 1 56 52 96 00', '1976-01-01', 'https://www.bing.com/maps?where=1+Apple+Park+Way%2C+Cupertino%2C+California+95014%2C+US&cp=37.32939%7E-122.008397&lvl=16.8'),
(7, 'Assurances Paris · FR 1 M d’abonnés · Plus de 10 K employés', 'https://www.axa.fr', 'Un point de départ : nos clients.<br><br>En tant que l\'un des plus grands assureurs au monde, notre raison d’être est d\'agir pour le progrès humain en protégeant ce qui compte.<br><br>La protection a toujours été au cœur de nos activités, en aidant les individus, les entreprises et les sociétés à prospérer. Et AXA a toujours été un leader, un innovateur, une société entrepreneuriale, favorisant le progrès dans toutes ses dimensions.<br><br>Notre raison d\'être renvoie aussi aux racines mêmes du Groupe. Depuis ses débuts, AXA s\'est engagé pour le bien collectif. Que ce soit au travers d\'actions solidaires avec AXA Atout Cœur, sur des sujets de prévention avec le Fonds AXA pour la Recherche, ou en matière de lutte contre le changement climatique… AXA s\'est toujours montré à l\'écoute de son environnement social et senti investi d\'une responsabilité en tant qu\'assureur ; celle d\'agir en amont pour mieux comprendre les risques. Dans un seul but : mieux protéger.', '10 001 employés et plus<br><br>136 176 membres associés', '+33 1 09 78 56 34', '1994-01-01', 'adresse'),
(8, 'Développement de logiciels Mountain View, CA · 33 M d’abonnés · Plus de 10 K employés', 'https://goo.gle/3DLEokh', 'A problem isn\'t truly solved until it\'s solved for all. Googlers build products that help create opportunities for everyone, whether down the street or across the globe. Bring your insight, imagination and a healthy disregard for the impossible. Bring everything that makes you unique. Together, we can build for everyone.<br><br>Check out our career opportunities at goo.gle/3DLEokh', '10 001 employés et plus<br><br>287 009 membres associés', '+33 1 09 89 78 56', '1998-01-01', 'adresse'),
(9, 'Enseignement supérieur Courbevoie · 17 K abonnés · 8 K anciens élèves', 'https://www.esilv.fr', 'L’ESILV, Ecole Supérieure d’Ingénieurs Léonard de Vinci est une école d’ingénieurs généraliste au cœur des technologies du numérique située à Paris-La-Défense. Elle recrute principalement au niveau Baccalauréat (S et STI2D) et forme en 5 ans des ingénieurs opérationnels s’insérant parfaitement dans le monde professionnel. Le projet pédagogique de l’ESILV s’articule autour des sciences et des technologies numériques combinées à 4 grandes spécialisations : Informatique/Big Data & Objets connectés, Mécanique Numérique et Modélisation, Ingénierie Financière, Nouvelles Energies.', '201-500 employés', '+ 33 1 41 16 70 00', '1995-01-01', 'adresse');

INSERT INTO `applications` (`Applications_ID`, `job_id`, `user_id`, `application_date`) VALUES
(1, 5, 1, '2024-05-30 14:33:49'),
(2, 5, 1, '2024-05-30 14:49:51'),
(3, 4, 1, '2024-05-30 14:51:27'),
(4, 3, 0, '2024-05-30 14:52:57'),
(5, 3, 0, '2024-05-30 14:53:33'),
(6, 3, 0, '2024-05-30 14:56:57'),
(7, 3, 0, '2024-05-30 14:57:33'),
(8, 3, 2, '2024-05-30 14:57:52');