<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferences du compte</title>
    <?php include '../Main/Header.php'; ?>
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

    <div class="sidenav">
    <a href="Pref_cpt.php">Preferences du compte</a>
    <a href="#">Identification et securite</a>
    <a href="#">Visibilite</a>
    <a href="#">Confidentialite des donnees</a>
    <a href="#">Donnees relatives a la publicite</a>
    <a href="#">Services EngineerIN</a>
    <a href="#">Notifications</a>
    </div>

    <div class="main">
        
        <div id="main_bloc">
            <h1>Informations de profil</h1>
            <?php
            $sql = "SELECT * FROM utilisateur WHERE User_ID = $user_id";
            $result = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($result);

            $nom = $data['Nom'];
            $prenom = $data['Prenom'];
            $email = $data['Mail'];
            $pays = $data['Pays'];

            //button if clicked, the name and surname is displayed
            echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Modifier</button>';
            echo '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            



            ?>

    </div>

</body>

</html>
