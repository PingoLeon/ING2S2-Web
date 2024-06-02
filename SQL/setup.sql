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
    Entreprise_ID INT,
    Mood VARCHAR(255),
    FOREIGN KEY (Entreprise_ID) REFERENCES Enterprise(Enterprise_ID)
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
    Visibility_Private BOOLEAN DEFAULT 1,
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
    DatePubli DATETIME DEFAULT CURRENT_TIMESTAMP,
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
    events_ID INT PRIMARY KEY AUTO_INCREMENT,
    Enterprise_ID INT,
    Date_publication DATE,
    Intitulé VARCHAR(255),
    Début DATE,
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

CREATE TABLE IF NOT EXISTS Relations (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    UID1 INT,
    UID2 INT
);

-- Sample data insertion
INSERT INTO `utilisateur` (`User_ID`, `Mail`, `Nom`, `Prenom`, `Username`, `MDP`, `Token`, `Photo`, `Pays`, `Entreprise_ID`, `Mood`) VALUES
(1, 'fcadene@gmail.com', 'Cadene', 'Félix', 'FefeC', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo1.png', 'France',-1, ''),
(2, 'ldalle@gmail.com', 'Dalle', 'Leon', 'PinguD', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo2.png', 'France', 0, ''),
(3, 'atanguy@gmail.com', 'Tanguy', 'Alara', 'AlaraT', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo3.png', 'France', 0, ''),
(4, 'aleoni@gmail.com', 'Leoni', 'Annabelle', 'AnnaL', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo4.png', 'France', 0, ''),
(5, 'admin@google.com', '', 'Bob', 'BobG', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo5.png', 'France', 8, ''),
(6, 'admin@axa.fr', 'Jesus', 'Rafael', 'RafaelJ', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo6.png', 'France', 7, ''),
(7, 'admin@esilv.fr', '🤓', '🤓', '🤓🤓', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo7.png', 'France', 9, ''),
(8, 'admin@apple.com', 'Bobby', 'BobbyB','',  'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo8.png', 'France', 6, ''),
(9, 'admin@ece.fr', 'Stephan', 'Francois','',  'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo10.png', 'France', 1, ''),
(10, 'admin@techcorp.fr', 'Martin', 'Sophie','',  'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo11.png', 'France', 2, ''),
(11, 'admin@marketingplus.fr', 'Leclerc', 'Kamel','',  'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo12.png', 'France', 3, ''),
(12, 'admin@financegrp.fr', 'Zacomi', 'Ben','',  'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo13.png', 'France', 4, ''),
(13, 'admin@itworld.fr', 'Petit', 'Thomas','',  'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '', '../photos/photo14.png', 'France', 5, '');


INSERT INTO Education (Edu_ID, User_ID, Debut, Fin, Nom, Type_formation, Enterprise_ID)
VALUES (1, 1, '2022-09-01', '2027-06-01', 'Etudiant', 'Ingenieur', 1);

INSERT INTO Projets (Proj_ID, User_ID, Debut, Fin, Nom, Edu_ID)
VALUES (1, 1, '2022-09-01', '2024-06-01', 'ECE_CUP', 1);

INSERT INTO Experience (Exp_ID, User_ID, Debut, Fin, Position, Type_Contrat, Enterprise_ID)
VALUES (1, 1, '2023-09-01', '2024-06-01', 'Ambassadeur', 'Contrat', 1);

INSERT INTO `enterprise` (`Enterprise_ID`, `Logo`, `Pays`, `Industrie`, `Banniere`, `Nom_Entreprise`, `Tuteur`, `Information_ID`) VALUES
(9, 'logo9.png', 'France', 'Education', 'banniere9.png', 'Esilv', 'Pascal Pinot', 9),
(8, 'logo8.png', 'France', 'Informatique', 'banniere8.png', 'Google', 'Sergey Brin', 8),
(7, 'logo7.png', 'France', 'Assurance', 'banniere7.png', 'Axa', 'Claude Bébéar', 7),
(5, 'logo5.png', 'France', 'Informatique', 'banniere5.png', 'ITWorld', 'Mr. Thomas Petit', 5),
(6, 'logo6.png', 'France', 'Technologie', 'banniere6.png', 'Apple', 'Steve Jobs', 6),
(3, 'logo3.png', 'France', 'Marketing', 'banniere3.png', 'MarketingPlus', 'Mr. Kamel Leclerc', 3),
(4, 'logo4.png', 'France', 'Finance', 'banniere4.png', 'FinanceGroup', 'Mme. Ben Zacomi', 4),
(2, 'logo2.png', 'France', 'Technologie', 'banniere2.png', 'TechCorp', 'Mme. Sophie Martin', 2),
(1, 'logo1.png', 'France', 'Education', 'banniere1.png', 'ECE Paris', 'Dr. Xian Fernand', 1);

INSERT INTO `offre_emploi` (`Job_ID`, `Enterprise_ID`, `Intitule`, `Debut`, `Fin`, `Position`, `Type_Contrat`, `Photo`, `Texte`) VALUES
(5, 5, 'Chargé de Cours à Temps Partiel', '2024-10-01', '2025-06-30', 'Chargé de Cours en Informatique', 'Temps Partiel', NULL, 'Nous recherchons un chargé de cours à temps partiel en informatique pour enseigner des cours de premier cycle. Le candidat idéal aura une expérience dans l\'industrie et une passion pour l\'enseignement.'),
(4, 4, 'Apprentissage en Finance', '2024-09-01', '2026-06-01', 'Apprenti en Finance', 'Apprentissage', NULL, 'Une opportunité d\'apprentissage en finance est disponible à FinanceGroup. Ce programme est conçu pour les personnes souhaitant démarrer une carrière en finance.'),
(3, 2, 'Développeur Logiciel', '2024-07-01', '2025-06-30', 'Développeur Logiciel Junior', 'Temporaire', NULL, 'Rejoignez notre équipe technique en tant que Développeur Logiciel Junior pour un contrat d\'un an. Vous travaillerez sur des projets passionnants et acquerrez une expérience précieuse en développement logiciel.'),
(2, 3, 'Stage en Marketing', '2024-06-01', '2024-12-01', 'Stagiaire en Marketing', 'Stage', NULL, 'Notre entreprise partenaire offre un stage de six mois en marketing. C\'est une excellente opportunité pour acquérir de l\'expérience pratique dans un environnement dynamique.'),
(1, 1, 'Enseignant Permanent', '2024-09-01', '2025-08-31', 'Enseignant Senior en Mathématiques', 'Permanent', NULL, 'Nous recherchons un enseignant senior en mathématiques dédié pour rejoindre notre équipe de manière permanente. Le candidat doit avoir une solide formation en mathématiques et une expérience en enseignement.'),
(6, 6, 'Ingénieur Logiciel', '2024-07-01', '2025-06-30', 'Ingénieur Logiciel Senior', 'Permanent', NULL, 'Apple recherche un ingénieur logiciel senior pour rejoindre son équipe de développement. Le candidat idéal aura une expérience significative en développement logiciel et une passion pour l\'innovation.'),
(7, 6, 'Stage en Gestion de Projet', '2024-06-15', '2024-12-15', 'Stagiaire en Gestion de Projet', 'Stage', NULL, 'Apple propose un stage de six mois en gestion de projet. C\'est une opportunité unique pour acquérir de l\'expérience dans la gestion de projets technologiques innovants.'),
(8, 7, 'Analyste en Assurance', '2024-09-01', '2025-08-31', 'Analyste en Assurance Junior', 'Temporaire', NULL, 'Axa recherche un analyste en assurance junior pour un contrat d\'un an. Vous serez responsable de l\'analyse des risques et de la gestion des polices d\'assurance. Une formation en assurance est requise.'),
(9, 7, 'Responsable du Développement Durable', '2024-07-01', '2025-06-30', 'Responsable Développement Durable', 'Permanent', NULL, 'Axa recrute un responsable du développement durable pour intégrer son équipe de manière permanente. Le candidat devra avoir une expérience dans les initiatives de développement durable et une passion pour l\'environnement.'),
(10, 8, 'Développeur Front-End', '2024-06-01', '2025-05-31', 'Développeur Front-End Junior', 'Temporaire', NULL, 'Google cherche un développeur front-end junior pour travailler sur des projets web innovants. Ce poste temporaire d\'un an est une excellente opportunité pour acquérir de l\'expérience en développement web.'),
(11, 8, 'Stage en Analyse de Données', '2024-07-01', '2024-12-31', 'Stagiaire en Analyse de Données', 'Stage', NULL, 'Google propose un stage de six mois en analyse de données. Ce stage offre une expérience pratique dans l\'analyse de grandes quantités de données et la création de rapports exploitables.'),
(12, 9, 'Enseignant en Physique', '2024-09-01', '2025-08-31', 'Enseignant en Physique', 'Permanent', NULL, 'Esilv recherche un enseignant en physique pour rejoindre son équipe pédagogique. Le candidat idéal aura une solide formation en physique et une expérience en enseignement à l\'université.'),
(13, 9, 'Assistant de Recherche en Informatique', '2024-09-01', '2026-08-31', 'Assistant de Recherche', 'Temps Partiel', NULL, 'Esilv offre un poste d\'assistant de recherche en informatique. Ce poste à temps partiel est idéal pour les étudiants souhaitant acquérir de l\'expérience en recherche tout en poursuivant leurs études.');

INSERT INTO Messages (Convers_ID, Sender_ID, Content)
VALUES  (1, 1, 'Salut Leon, comment vas-tu ?'),
        (1, 2, 'Salut Felix, je vais bien merci et toi ?'),
        (1, 1, 'Je vais bien aussi, merci. Comment se passe ta journée ?'),
        (1, 2, 'Ma journée se passe bien, j\'ai eu une réunion importante ce matin.'),
        (1, 1, 'C\'est super, j\'espère que ça s\'est bien passé.'),
        (1, 2, 'Oui, tout s\'est bien passé. Merci pour ton soutien.'),
        (1, 1, 'De rien, c\'est normal. N\'hésite pas si tu as besoin d\'aide.');
        
INSERT INTO Relations (UID1, UID2)
VALUES (1, 2);

INSERT INTO Messagerie (ID1, ID2)
VALUES (1, 2);

INSERT INTO `informations` (`Information_ID`, `Site_Web`, `Intro`, `Informations`, `Taille`, `Telephone`, `Annee_Fondation`, `Lieu`) VALUES
(5, 'https://www.ITWorld.com', 'Technologies de l\'information Paris · 30 K abonnés · 20 K anciens élèves', 'ITWorld est une entreprise de premier plan dans le secteur des technologies de l\'information, fournissant des solutions innovantes en matière de cloud computing, de cybersécurité et de développement de logiciels. Nous nous engageons à aider nos clients à réussir dans un monde numérique en constante évolution.', '1001-5000 employés', '+33 1 34 56 78 90', '2000-07-05', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20335368.604213215!2d-37.03920670000004!3d51.52523540000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761b309e0db9e7%3A0x692f07be2bb261d4!2sAlara%20Health%20Store!5e0!3m2!1sfr!2sfr!4v171716'),
(6, 'http://www.apple.com/careers', 'Fabrication de produits informatiques et électroniques Cupertino, California · 18 M d’abonnés · Plus de 10 K employés', 'We\'re a diverse collective of thinkers and doers, continually reimagining what\'s possible to help us all do what we love in new ways. And the same innovation that goes into our products also applies to our practices — strengthening our commitment to leave the world better than we found it. This is where your work can make a difference in people\'s lives. Including your own. <br><br> Apple is an equal opportunity employer that is committed to inclusion and diversity. Visit apple.com/careers to learn more.', '10 001 employés et plus<br><br>171 219 membres associés', '+33 1 56 52 96 00', '1976-01-01', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22012552.236437067!2d-37.105987296154495!3d47.66345914703737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fe5296f0f4b%3A0xc33d115f0e33b9d2!2sApple%20Champs-%C3%89lys%C3%A9es!5e0!3m2!1sfr!2s'),
(4, 'https://www.FinanceGroup.com', 'Services financiers Paris · 15 K abonnés · 10 K anciens élèves', 'FinanceGroup offre une gamme complète de services financiers, incluant la gestion d\'actifs, les conseils en investissement et les solutions de financement pour les entreprises et les particuliers. Notre mission est de fournir des conseils éclairés et des solutions financières innovantes pour aider nos clients à atteindre leurs objectifs financiers.', '501-1000 employés', '+33 1 56 34 78 90', '1985-02-11', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d42009.113538834885!2d2.2648036402798!3d48.84734790302945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671d71f61ad1d%3A0x604aca12c472870c!2sannabel%20Winship!5e0!3m2!1sfr!2sfr!4v1717160383349!'),
(3, 'https://www.MarketingPlus.com', 'Services de marketing digital Paris · 20 K abonnés · 12 K anciens élèves', 'MarketingPlus est un leader dans le domaine du marketing digital, offrant des services complets pour aider les entreprises à maximiser leur présence en ligne et à atteindre leurs objectifs de croissance. Nos experts travaillent avec passion pour concevoir des stratégies personnalisées qui répondent aux besoins uniques de chaque client.', '51-200 employés', '+33 1 78 90 12 34', '2010-08-23', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10503.706423983367!2d2.267722003225654!3d48.84053862741909!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671fb5223c419%3A0x55babbca7fabe39d!2sFELIX%20FAURE%20INFORMATIQUE!5e0!3m2!1sfr!2sfr!4v1'),
(2, 'https://www.TechCorps.com', 'Entreprises technologiques Paris · 12 K abonnés · 8 K anciens élèves', 'TechCorps est une entreprise innovante spécialisée dans le développement de solutions technologiques avancées pour divers secteurs, incluant la santé, la finance, et l\'éducation. Nous croyons en l\'innovation collaborative et en l\'importance de la diversité pour alimenter notre succès. <br><br>Nos équipes de recherche et développement travaillent sans relâche pour créer des produits qui transforment le quotidien de millions de personnes à travers le monde.', '201-500 employés', '+33 1 23 45 67 89', '2005-04-15', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.3604246976092!2d2.3017353760993844!3d48.870405271333745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fc3be434c47%3A0xbed819370377e4f0!2sVolfoni%20Champs-Elys%C3%A9es!5e0!3m2!1sfr!2sfr!'),
(1, 'https://www.ece.fr', 'Programmes d’administration de l’éducation Paris, île-de-france · 26 K abonnés · 15 K anciens élèves', 'L\'ECE école d\'ingénieurs multiprogrammes, multi-campus et multi-secteurs, spécialisée dans l\'ingénierie numérique, forme les ingénieurs et les experts en technologie du 21ème siècle, capables de relever les défis de la double révolution numérique et du développement durable.\r\n <br><br> \r\n Les nombreuses associations étudiantes et les voyages internationaux proposés aux étudiants leur offrent une expérience de premier ordre, ainsi qu\'une large ouverture sur le monde d\'aujourd\'hui et de demain.\r\n <br><br> ECE propose trois programmes d\'enseignement supérieur : le programme Grande Ecole d\'ingénieurs, le programme Bachelor et le programme MSc.', '51-200 employés', '+33 1 44 39 06 00', '1919-01-01', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10501.426175804241!2d2.270454903290812!3d48.85141112749421!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b43f62b4b%3A0x43f21f781ac4586b!2s7%20Rue%20Sextius%20Michel%2C%2075015%20Paris!5e0!'),
(7, 'https://www.axa.fr', 'Assurances Paris · FR 1 M d’abonnés · Plus de 10 K employés', 'Un point de départ : nos clients.<br><br>En tant que l\'un des plus grands assureurs au monde, notre raison d’être est d\'agir pour le progrès humain en protégeant ce qui compte.<br><br>La protection a toujours été au cœur de nos activités, en aidant les individus, les entreprises et les sociétés à prospérer. Et AXA a toujours été un leader, un innovateur, une société entrepreneuriale, favorisant le progrès dans toutes ses dimensions.<br><br>Notre raison d\'être renvoie aussi aux racines mêmes du Groupe. Depuis ses débuts, AXA s\'est engagé pour le bien collectif. Que ce soit au travers d\'actions solidaires avec AXA Atout Cœur, sur des sujets de prévention avec le Fonds AXA pour la Recherche, ou en matière de lutte contre le changement climatique… AXA s\'est toujours montré à l\'écoute de son environnement social et senti investi d\'une responsabilité en tant qu\'assureur ; celle d\'agir en amont pour mieux comprendre les risques. Dans un seul but : mieux protéger.', '10 001 employés et plus<br><br>136 176 membres associés', '+33 1 09 78 56 34', '1994-01-01', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10501.931906030963!2d2.2469890554199337!3d48.84899990000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e67ab01f6c3f41%3A0xdba0e0f972fa894f!2sAXA%20Assurance%20et%20Banque%20Alain%20Didier!5e'),
(8, 'https://goo.gle/3DLEokh', 'Développement de logiciels Mountain View, CA · 33 M d’abonnés · Plus de 10 K employés', 'A problem isn\'t truly solved until it\'s solved for all. Googlers build products that help create opportunities for everyone, whether down the street or across the globe. Bring your insight, imagination and a healthy disregard for the impossible. Bring everything that makes you unique. Together, we can build for everyone.<br><br>Check out our career opportunities at goo.gle/3DLEokh', '10 001 employés et plus<br><br>287 009 membres associés', '+33 1 09 89 78 56', '1998-01-01', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2691810.800430667!2d-2.3221479430408487!3d48.78720721553861!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e30ecee128b%3A0x2fad446b03297242!2sGoogle%20France!5e0!3m2!1sfr!2sfr!4v1717160633949'),
(9, 'https://www.esilv.fr', 'Enseignement supérieur Courbevoie · 17 K abonnés · 8 K anciens élèves', 'L’ESILV, Ecole Supérieure d’Ingénieurs Léonard de Vinci est une école d’ingénieurs généraliste au cœur des technologies du numérique située à Paris-La-Défense. Elle recrute principalement au niveau Baccalauréat (S et STI2D) et forme en 5 ans des ingénieurs opérationnels s’insérant parfaitement dans le monde professionnel. Le projet pédagogique de l’ESILV s’articule autour des sciences et des technologies numériques combinées à 4 grandes spécialisations : Informatique/Big Data & Objets connectés, Mécanique Numérique et Modélisation, Ingénierie Financière, Nouvelles Energies.', '201-500 employés', '+ 33 1 41 16 70 00', '1995-01-01', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10492.065387357945!2d2.201739303558038!3d48.89602562780586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e665004f10715d%3A0xecaad41f0d62f658!2sCampus%20des%20Terrasses%20ESILV!5e0!3m2!1sfr!2sfr');

INSERT INTO `applications` (`Applications_ID`, `job_id`, `user_id`, `application_date`) VALUES
(1, 5, 1, '2024-05-30 14:33:49'),
(2, 5, 1, '2024-05-30 14:49:51'),
(3, 4, 1, '2024-05-30 14:51:27'),
(4, 3, 0, '2024-05-30 14:52:57'),
(5, 3, 0, '2024-05-30 14:53:33'),
(6, 3, 0, '2024-05-30 14:56:57'),
(7, 3, 0, '2024-05-30 14:57:33'),
(8, 3, 2, '2024-05-30 14:57:52');

INSERT INTO `events` (`events_ID`, `Enterprise_ID`, `Date_publication`, `Intitulé`, `Début`, `Fin`, `Photo`, `Texte`) VALUES
(3, 1, '2024-05-24', '[#Lancement / #IntelligenceLab / #Innovation]', '2024-06-04', '2024-06-04', 'photo3.png', 'L’ECE vous convie au lancement de son « Intelligence Lab », une plateforme pédagogique, de recherche et d’innovation inédite centrée sur l’IA générative. <br><br>➡ A cette occasion, l’école dévoilera le premier benchmark français de modèles LLM (Large Language Models) développé par des enseignants, des chercheurs et des étudiants de l’ECE 👨‍🏫 🤖 <br><br>\r\n💡 Plateforme inédite en France, l’Intelligence Lab a l’ambition de former par la pratique tous les étudiants de l’ECE aux technologies d’hashtag#IA générative, en y associant ses partenaires académiques, les entreprises et les acteurs publics ✨'),
(2, 1, '2024-04-21', '[#Rugby / #LesOvalies / #Sport]', '2024-05-09', '2024-05-11', 'photo2.png', 'Les Ovalies UniLaSalle, grand tournoi de rugby à vocation solidaire, fondé en 1994 à Beauvais, est une association riche d\'une histoire écrite par des milliers d\'étudiants venus de France et d\'Europe pour partager les valeurs du rugby et de la solidarité. Chaque année, la ville de Beauvais, à travers son stade Marcel Communeau, se transforme en capitale du rugby universitaire européen 😊.<br><br>\r\n\r\nCinq équipes de l\'ECE étaient représentées lors des Ovalies :<br>\r\n 📍 Rugby à XV masculin avec l\'équipe ECE Rugby 👨 <br>\r\n 📍 Rugby à VII féminin 👩 <br>\r\n 📍 Pom-pom girls avec les ECE Pom-poms 💃<br>\r\n 📍 Rugby fauteuil (rugby paralympique) ♿ <br>\r\n 📍 Les Ultras pour le concours des supporters avec la Team ECE Ultra 🔵 <br><br>\r\n \r\nLes résultats de nos équipes ECE pour 2024 :<br>\r\n📍 3ème place pour le Rugby Fauteuil 🥉 <br>\r\n📍 Défaite en ¼ de finale pour le XV Masculin 👌 <br>\r\n📍 Défaite en 1/8ème de finale par forfait du Rugby à VII Féminin 👍'),
(1, 1, '2024-05-30', '[#Evénement / #WelcomeDay]', '2024-06-15', '2024-06-16', 'photo1.png', 'Avec les Welcome Day de l\'ECE, vivez une journée portes ouvertes qui sort de l\'ordinaire 🎉 <br><br>L\'ensemble de nos équipes pédagogiques et de nos étudiants viennent à votre rencontre afin de vous faire découvrir l\'école, avec des animations, de la musique, de la street-food, lors d\'une journée unique ✨'),
(4, 2, '0000-00-00', 'NULL', '0000-00-00', '0000-00-00', 'photo4.png', ''),
(5, 3, '0000-00-00', '', '0000-00-00', '0000-00-00', 'photo5.png', ''),
(6, 4, '0000-00-00', '', '0000-00-00', '0000-00-00', 'photo6.png', ''),
(7, 5, '0000-00-00', '', '0000-00-00', '0000-00-00', 'photo7.png', ''),
(8, 6, '0000-00-00', '', '0000-00-00', '0000-00-00', 'photo8.png', ''),
(9, 7, '2024-05-30', NULL, '0000-00-00', '0000-00-00', 'photo9.png', '🔔 A strategic partnership between ClimateSeed and AXA Climate to enhance organizational resilience in the face of climate change and support their greenhouse gas emission reduction efforts. <br><br>\r\n\r\nBy combining Climate Seed technologies and AXA Climate expertise, this partnership provides an integrated solution helping organizations in their strategies by:<br><br>\r\n\r\n📉 Measuring: with Climate Seed technologies, identify decarbonization levers and initiate an effective and realistic trajectory for reducing their direct and indirect emissions.<br><br>\r\n\r\n🔄 Learning and Adapting: leverage AXA Climate educational programs like the AXA Climate School, and its expertise in climate insurance to foster climate adaptation strategies for each organization.<br><br>\r\n\r\nTogether, we believe in a more resilient, sustainable future. #partnership #climatechange #sustainability #AXAClimate #ClimateSeed #AXAInvestmentManagers'),
(10, 7, '2024-05-31', NULL, '0000-00-00', '0000-00-00', 'photo10.png', '⚽🧢 As Jurgen Klopp bids farewell to Liverpool Football Club, we at AXA are grateful for his extraordinary contributions. Klopp once ignited the spirit of belief, inspiring us to \"change from a doubter to a believer.\" <br><br> Thank you, Jurgen, for instilling in us the power of teamwork and determination. <br><br> Your influence will forever motivate us to embrace challenges with confidence.<br><br> Best wishes for your future endeavors. #AXA #KnowYouCan #OfficialGlobalTrainingPartner #JurgenKlopp #LFC #LFCW'),
(11, 8, '2024-06-01', NULL, '0000-00-00', '0000-00-00', 'photo11.png', 'Doogler Haas told us, \"My human says coding is like teaching tricks. Treats for every compiled line? Now that\'s a command I can follow!\" 🐕'),
(12, 9, '2024-05-31', 'Devinci Race 2024 : une compétition étudiante d\'aviron internationale sur la Seine', '0000-00-00', '0000-00-00', 'photo12.png', 'L’association Aviron DeVinci a organisé la deuxième édition de la Devinci Race, un événement qui s’impose déjà comme un rendez-vous incontournable de l’aviron étudiant international !<br><br>\r\n\r\nÀ cette occasion, 170 participants provenant de 9 grandes écoles, dont deux internationales, se sont affrontés dans des duels sur une distance de 500 mètres le long des rives du quai de Grenelle, avec la tour Eiffel en toile de fond.<br><br>\r\n<a href=\"https://lnkd.in/gzs-HdfD\">https://lnkd.in/gzs-HdfD</a>'),
(13, 9, '2024-02-27', 'Remise des Diplômes 2022', '2024-04-23', '2024-04-24', 'photo13.png', '🎓 Vous êtes déjà + de 1000 inscrits à la Remise des Diplômes de la PROMO 2023 !<br><br>\r\nEMLV - Ecole de Management Léonard de Vinci ESILV - Ecole Supérieure d\'Ingénieurs Léonard de Vinci IIM Digital School Devinci Executive Education');

INSERT INTO posts (Post_ID, User_ID, Enterprise_ID, DatePublication, Photo, Texte, Titre, Lieu, Visibility_Private) VALUES
(1, 1, NULL, '2024-05-31 12:32:42', 'Photos/post1', 'POSTE #1', 'Enfin Ambassadeur', 'Paris', 0),
(3, 3, NULL, '2024-05-31 15:32:42', 'Photos/photo7', 'Toujours', 'Leon me saoule', 'Versailles', 0),
(2, 1, NULL, '2024-05-31 14:32:42', 'Photos/photo3', 'J\'aime Alara de tout mon coeur', 'J\'aime Leon', 'Paris', 1),
(5, 1, NULL, '2024-05-31 00:00:00', 'Photos/photo6', 'Demain je vais devoir faire la Journee Portes Ouvertes de l`ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. Demain je vais devoir faire la Journee Portes Ouvertes de l\'ECE. ', 'FINI CETTE MERDE', '', 1),
(6, 1, NULL, '2024-05-31 22:38:08', 'Photos/Photo4', 'qqqqqqqqqqqqqqqqqqqqqqqqqqqq', 'Testing', 'Versailles', 1),
(7, 1, NULL, '2024-05-31 22:39:10', 'Photos/edit', 'GIGA CHAD', 'Testing post #5', 'fr', 1);

INSERT INTO Commentaires(Post_ID, User_ID, Texte)
VALUES  (1, 2, 'Félicitations pour ton nouveau poste !'),
        (1, 1, 'Merci beaucoup ! Je suis très heureux de rejoindre l\'équipe.'),
        (1, 2, 'Je suis sûr que tu vas faire un excellent travail.'),
        (1, 1, 'J\'espère pouvoir contribuer positivement à l\'équipe.'),
        (1, 2, 'Je n\'en doute pas. Tu as toutes les compétences nécessaires.'),
        (1, 1, 'Merci pour ton soutien, Leon.'),
        (1, 2, 'De rien, c\'est normal. Tu es un excellent collègue.'),
        (1, 1, 'Merci, Leon. C\'est très gentil de ta part.'),
        (1, 2, 'Pas de problème, Félix. Nous sommes une équipe.'),
        (1, 1, 'Oui, c\'est vrai. Ensemble, nous pouvons accomplir de grandes choses.'),
        (1, 2, 'Exactement. Nous sommes plus forts ensemble.'),
        (1, 1, 'C\'est ça. Merci encore pour ton soutien, Leon.'),
        (1, 2, 'De rien, Félix. C\'est un plaisir de travailler avec toi.'),
        (1, 1, 'Merci, Leon. À bientôt !'),
        (1, 2, 'À bientôt, Félix !');