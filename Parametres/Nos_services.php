<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferences du compte</title>
    <?php include '../Main/Header.php'; ?>
    <link rel="stylesheet" type="text/css" href="../Main/Site.css">
    <!-- Source: W3Schools -->
    <style>
        
        .sidenav {
        height: 100%;
        width: 200px;
        position: fixed;
        z-index: 1;
        top: 80px;
        background-color: white;
        overflow-x: hidden;
        padding-top: 20px;
        border-top: 5px solid #dee2e6;
        }

        .sidenav a {
        padding: 6px 6px 15px 32px;
        text-decoration: none;
        font-size: 15px;
        color: #818181;
        display: block;
        }

        .sidenav a:hover {
        color: #f1f1f1;
        }

        .main {
        margin-left: 200px; /* Same as the width of the sidenav */
        }

        @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
        }
    </style>
</head>

<body>
    <br>

    <div class="sidenav">
    <a href="Pref_cpt.php">Preferences du compte</a>
    <a href="Securite.php">Identification et securite</a>
    <a href="Nos_services.php">Services EngineerIN</a>
    </div>

    <div class="main">
        <div class = "container">
            <div id="main_bloc">
                <h1><b>Services EngineerIN<b></h1>
        </div>
        <br>
        <div id="main_bloc">
            <div class="row">
                <div class="col-md-12" style="width: 10%; align-items: center; justify-content: center; display: flex;">
                    <img src="../Photos/EngineerIN_logo.png" alt="ECE Paris" >
                </div>
            </div>
        </div>
        <br>
        <div id="main_bloc">
            <h2><b>EngineerIN: Social Media Professionnel de l'ECE Paris<b></h2><br>
            <p>Nous sommes une platforme de reseau social pour les etudiants de l'ECE Paris. 
            <br>Cree par un groupe de 4 etudiants, notre objectif est de faciliter la communication entre les etudiants et des employeurs potentiels. On peut y trouver des offres d'emplois, des evenements des entreprises que vous aimez mais surtout, vous pouvez generer votre propre profil. 
            <br>Bienvenue sur ECEIn, la plateforme de réseaux sociaux professionnelle exclusivement conçue pour la communauté ECE Paris. Que vous soyez étudiant en licence, master ou doctorat, apprenti en entreprise, étudiant à la recherche d'un stage, professeur ou salarié à la recherche de partenaires de recherche, ce site s'adresse à toute personne prenant sa vie professionnelle au sérieux, visant pour découvrir de nouvelles opportunités de carrière et se connecter avec les autres pour atteindre des objectifs professionnels.</p>
            <br>
        </div>
        <br>

        <div id="main_bloc">
            <h2><b>Contactez-nous<b></h2><br>
            <a href="mailto:contact@engineerIN.fr">Contactez-nous: contact@engineerIN.fr</a> | Téléphone: 0609508625</p>
            <br>
        </div>
    </div>
</body>
</html>
