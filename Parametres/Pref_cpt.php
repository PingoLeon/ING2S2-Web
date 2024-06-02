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
                <h1>Informations de profil</h1>
                <?php
                $sql = "SELECT * FROM utilisateur WHERE User_ID = $user_id";
                $result = mysqli_query($db_handle, $sql);
                $data = mysqli_fetch_assoc($result);

                $nom = $data['Nom'];
                $prenom = $data['Prenom'];
                $email = $data['Mail'];
                $pays = $data['Pays'];
                $photo = $data['Photo'];
                if ($photo == NULL) {
                    $photo = "../Photos/photo_placeholder.png";
                }else{
                    $photo = $data['Photo'];
                }

                //button if clicked, the name and surname is displayed
                echo '<div class="row">';
                    echo '<div class="col-md-6">';
                        echo '<img src="' . $photo . '" alt="Photo de profil" style="width: 100px; height: 100px; border-radius: 50%;">';
                        echo '<br><br><h4 style="text-align:left; margin-left: 10px;"><b>' . $nom . ' ' . $prenom . '</h4>';
                        echo '<p style="text-align:left; margin-left: 10px;">' . $email . '</p>';
                        echo '<p style="text-align:left; margin-left: 10px;">' . $pays . '</p></b>';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                        echo '<br><br><br><a href="../Main/profile_main.php" class="btn btn-primary" style="margin-left: 10px;">Voir plus</a>';
                    echo '</div>';
                echo '</div>';
                ?>
            </div>
            <br>
            <div id="main_bloc">
                <h1>Preferences du compte</h1>
                <div class="row">
                    <div class="col-md-6">
                        <h4 style="text-align:left; margin-left: 10px;"><b>Langue</b></h4>
                        <p style="text-align:left; margin-left: 10px;">Francais</p>
                    </div>
                    <div class="col-md-6">
                        <h4 style="text-align:left; margin-left: 10px;"><b>Langue du contenu</b></h4>
                        <p style="text-align:left; margin-left: 10px;">Francais</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4 style="text-align:left; margin-left: 10px;"><b>Notifications</b></h4>
                        <p style="text-align:left; margin-left: 10px;">Actives</p>
                    </div>
                    <div class="col-md-6">
                        <h4 style="text-align:left; margin-left: 10px;"><b>Theme</b></h4>
                        <p style="text-align:left; margin-left: 10px;">Clair</p>
                    </div>
                </div>
            </div>
            <br>
            <div id="main_bloc">
                <h1>Abonnements et paiements</h1>
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" style="text-align:left; margin-left: 25px;"><b>Essai EngineerinIN+<b></a>
                    </div>                        
                </div>
            </div>
            <br>
            <div id="main_bloc">
                <h1>Partenaires et services</h1>
                <div class="row">
                    <div class="col-md-12">
                        <a href="https://www.ece.fr/" style="text-align:left; margin-left: 25px;"><b>ECE<b></a>
                    </div>                        
                </div>
            </div>
        </div>
    </div>

</body>

</html>
