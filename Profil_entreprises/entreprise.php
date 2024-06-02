<?php
include '../Auth/functions.php';
//! Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
list($id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
$user_id = $id;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>❤❤</title>
    <link rel="icon" href="../Photos/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="details.css">
</head>

<body>
<?php 
    $entre_id = 3;
    $sql = 'SELECT * FROM enterprise, informations, events WHERE enterprise.Information_ID = '.$entre_id.' AND informations.Information_ID = '.$entre_id.' AND events.Enterprise_ID = '.$entre_id.';';
    $result = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 0) {
        echo "Aucune entreprise trouvée";
        exit;
    }
?>


<div class="container" id="background"> 
    <div class="container" id="main_bloc" style="background-image: url('../Profil_entreprises/bannieres/<?php echo $data['Banniere']; ?>');">
        <div class="row">
            <?php echo '<img id ="ban" class="image" src="../Profil_entreprises/logos/'.$data['Logo'].'" alt="Logo">'; ?>
        </div>
        
        <br><br><br><br><br><br><br><br><br><br>

        <?php
        echo '<p style="background-color: white">'.$data['Intro'].'</p>'; ?>
    
        <?php  
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
                        <select name="OngletNavBar" onchange="this.form.submit()">
                            <option value="">Events</option>
                            <option value="Events_Semaine">Events de la semaine</option>
                            <option value="Tous">Tous les events</option>
                        </select>
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
            include '../Profil_entreprises/details/accueil1.php';
        } elseif ($current_page === "A propos") {
            include '../Profil_entreprises/details/apropos1.php';
        } elseif ($current_page === "Posts") {
            include '../Profil_entreprises/details/posts1.php';
        }
        elseif ($current_page === "Events_Semaine") {
            include '../Profil_entreprises/details/events_semaine1.php';
        }
        elseif ($current_page === "Tous") {
            include '../Profil_entreprises/details/posts1.php';
            echo 'test';
        }
    } else {
        $current_page = "Accueil";
    }

?>

</body>
</html>