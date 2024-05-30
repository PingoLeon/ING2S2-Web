<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>TEST</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="details.css">
</head>

<body>
<?php 
    include '../Profil_entreprises/entreprises/entreprise.php';
    $xml = Creation_XML(); ?>

<div class="container" id="background"> 
    <div class="container" id="main_bloc">
        <div class="row">
            <img src="<?php echo $xml->enterprise->Banniere; ?>" alt="banniere" style="width: 100%" style=" height: 10%"/>             
            <img id ="ban" class="image" src="<?php echo $xml->enterprise->Logo; ?>" alt="Logo" style="width: 15%" style="background-color :white">
        </div><br><br><br>

        <?php echo $xml->informations->Intro; ?><br><br>

        <button onclick="window.location.href='<?php echo $xml ->informations->Site_Web; ?>'">Consulter le site web</button><br><br>

        
    <table>
        <td>
            <div class="nav-bar">
                <tr>
                    <form method="post" action="">
                        <input type="hidden" name="OngletNavBar" value="Accueil">
                        <button type="submit">Accueil</button>
                    </form>
                </tr>
                <tr>
                    <form method="post" action="">
                        <input type="hidden" name="OngletNavBar" value="A propos">
                        <button type="submit">A propos</button>
                    </form>
                </tr>
                <tr>
                    <form method="post" action="">
                        <input type="hidden" name="OngletNavBar" value="Posts">
                        <button type="submit">Posts</button>
                    </form>
                </tr>
                <tr>
                    <form method="post" action="">
                        <input type="hidden" name="OngletNavBar" value="Offres">
                        <button type="submit">Offres</button>
                    </form>
                    
            </div>
        </td>
    </table>
    </div>
    </div>
</div>

<?php

    if (isset($_POST['OngletNavBar'])) {
        $current_page = $_POST['OngletNavBar'];

        if ($current_page === "Accueil") {
            include 'C:/wamp64/www/ING2S2-WEB/Profil_entreprises/details/accueil1.php';
        } elseif ($current_page === "A propos") {
            include 'C:/wamp64/www/ING2S2-WEB/Profil_entreprises/details/apropos1.php';
        } elseif ($current_page === "Posts") {
            include 'C:/wamp64/www/ING2S2-WEB/Profil_entreprises/details/posts1.php';
        }
    } else {
        $current_page = "Accueil";
    }

    $sql = "SELECT Content FROM Entreprises WHERE Nom = 'Apple' AND Onglet = '$current_page'";
?>

</body>
</html>