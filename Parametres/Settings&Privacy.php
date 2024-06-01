<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Mode Settings</title>
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
    <a href="#">Preferences du compte</a>
    <a href="#">Identification et securite</a>
    <a href="#">Visibilite</a>
    <a href="#">Confidentialite des donnees</a>
    <a href="#">Donnees relatives a la publicite</a>
    <a href="#">Services EngineerIN</a>
    <a href="#">Notifications</a>
    </div>
</body>

<?php

function Preferences_du_compte() {
    echo '<div class="main">';
    echo '<h2>Preferences du compte</h2>';
    echo '<p>Modifier les parametres de votre compte</p>';
    echo '</div>';
}

?>

</html>
