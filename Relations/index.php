<!-- profile_main.php -->
<?php
    include '../Auth/functions.php';
    //! Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
    list($user_id, $email, $db_handle,) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
    //! Checker si l'utilisateur a appuyé sur le bouton de déconnexion
    logout_button_POST();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Lien Boostrap, JQuery -->
    <link rel="cano nical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="theme-color" content="#712cf9">
    <link href="style.css" rel="stylesheet">

    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="../Main/Site.css">
</head>

<body>
    <!-- Ajout du header -->
    <?php include '../Main/Header.php'; ?>
    <!-- Using Bootstrap -->
    Vos Relations : 
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                
    <?php
        //! Récupérer les User_ID des relations de l'utilisateur
        $sql = "SELECT U.User_ID, U.Mail, U.Prenom, U.Nom, U.Photo
                FROM Relations AS R
                JOIN Utilisateur AS U ON (R.UID1 = U.User_ID OR R.UID2 = U.User_ID)
                WHERE (R.UID1 = '$user_id' OR R.UID2 = '$user_id')
                AND U.User_ID != '$user_id'";
        $result = mysqli_query($db_handle, $sql); 
        while($data_user = mysqli_fetch_assoc($result)) {
            $user_id = $data_user['User_ID'];
            $mail = $data_user['Mail'];
            $prenom = $data_user['Prenom'];
            $nom = $data_user['Nom'];
            $photo = $data_user['Photo'];
            echo "<div class='card' style='width: 18rem;'>
                    <img src='$photo' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>$prenom $nom</h5>
                        <p class='card-text'>$mail</p>
                        <a href='profile.php?user_id=$user_id' class='btn btn-primary'>Voir le profil</a>
                    </div>
                </div>";
        }
    ?>
            </div>
        </div>
    </div>
</body>