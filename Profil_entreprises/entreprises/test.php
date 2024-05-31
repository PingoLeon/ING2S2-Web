<?php
include 'C:\wamp64\www\ING2S2-Web/Auth/functions.php';
//! Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
list($id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
$user_id = $id;
?>

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
    $entre_id = 9;
    $sql = 'SELECT * FROM enterprise, informations WHERE enterprise.Information_ID = '.$entre_id.' AND informations.Information_ID = '.$entre_id.'';
    $result = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($result);
?>


<div class="container" id="background"> 
    <div class="container" id="main_bloc" style="background-image: url('../../Profil_entreprises/bannieres/<?php echo $data['Banniere']; ?>');">
        <div class="row">
            <?php echo '<img id ="ban" class="image" src="../../Profil_entreprises/logos/'.$data['Logo'].'" alt="Logo">'; ?>
        </div>
        
        <br><br><br><br><br><br><br><br><br><br>

        <?php
        echo '<p style="background-color: white">'.$data['Intro'].'</p>'; ?>
    
        <?php //echo '<button onclick="window.location.href='.$data['Site_Web']'">Consulter le site web</button><br><br>'; 
        echo '<button onclick="window.location.href=\''.$data['Site_Web'].'\'">Consulter le site web</button><br><br>'; ?>

        
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
            include 'C:\wamp64\www\ING2S2-Web/Profil_entreprises/details/accueil1.php';
        } elseif ($current_page === "A propos") {
            include '../../Profil_entreprises/details/apropos1.php';
        } elseif ($current_page === "Posts") {
            include 'C:\wamp64\www\ING2S2-Web/Profil_entreprises/details/posts1.php';
        }
    } else {
        $current_page = "Accueil";
    }

    $sql = "SELECT Content FROM Entreprises WHERE Nom = 'Apple' AND Onglet = '$current_page'";
?>

</body>
</html>