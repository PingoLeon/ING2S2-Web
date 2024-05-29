<?php
    include '../../Profils_entreprises/details/accueil.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>bannière</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 

    <link rel="stylesheet" type="text/css" href="details.css">
    <script>
        function showText() {
            alert("Vous avez cliqué sur Accueil !");
        }
    </script>
    
</head>

<body>
    

<div class="container" id="background"> 
    <div class="container" id="main_bloc">
        <div class="row">
            <img src="../../Profil_entreprises/bannieres/apple.png" alt="APPLE banniere" style="width: 100%; height: 10%">             
            <img id ="ban" class="image" src="../../Profil_entreprises/logos/logo1.png" alt="APPLE LOGO" style="width: 15%; background-color :white">
        </div><br><br><br>

        Fabrication de produits informatiques et électroniques Cupertino, California <br>

        <button onclick="window.location.href='https://www.apple.com/careers/us/'">Consulter le site web</button><br><br>

        

    <div class="nav-bar">
        <form method="post" action="">
            <input type="hidden" name="OngletNavBar" value="Accueil">
            <button type="submit">Accueil</button>
        </form>
        <form method="post" action="">
            <input type="hidden" name="OngletNavBar" value="A propos">
            <button type="submit">A propos</button>
        </form>
        <form method="post" action="">
            <input type="hidden" name="OngletNavBar" value="Posts">
            <button type="submit">Posts</button>
        </form>
        <form method="post" action="">
            <input type="hidden" name="OngletNavBar" value="Emplois">
            <button type="submit">Emplois</button>
        </form>


        <?php 

            if isset($_POST['OngletNavBar']) {
                $current_page = $_POST['OngletNavBar'];
            }
            else {
                $current_page = "Accueil";
            }

            
            //$sql = "SELECT Content FROM Entreprises WHERE Nom = 'Apple'" AND "Onglet = $current_page";
        ?>
        
    </div>
    </div>

</div>

</body>
</html>