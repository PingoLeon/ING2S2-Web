<?php
include '../Auth/functions.php';
list($user_id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
logout_button_POST();
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['job_id'])) {
        
        //$job_id = mysqli_real_escape_string($db_handle, $_POST['job_id']);
        $entreprise_id = isset($_POST['entreprise_id']) ? $_POST['entreprise_id'] : '';
        $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
        $message = "L'utilisateur <a href='mailto:" . $email . "'>" . $email . "</a> a postulé pour l'offre d'emploi " . $titre . ".\n\n";
        $message = $db_handle->real_escape_string($message);
        
        //!Obtenir les IDS multiples de l'entreprise et envoyer un message à tous les admins
        $sql = "SELECT User_ID FROM Utilisateur WHERE Entreprise_ID = '$entreprise_id'";
        $result = mysqli_query($db_handle, $sql);
        $admin_ids = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($admin_ids) {
            foreach ($admin_ids as $admin_id) {
                $admin_id = $admin_id['User_ID'];
                $sql = "SELECT Convers_ID FROM Messagerie WHERE (ID1 = -1 AND ID2 = '$admin_id') OR (ID1 = '$admin_id' AND ID2 = -1)";
                $result = $db_handle->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $convers_id = $row['Convers_ID'];
                    $convers_id = (string)$convers_id;
                }
                
                //! Insérer le message dans la table Messages
                $sql = "INSERT INTO Messages (Convers_ID, Sender_ID, Content) VALUES ('$convers_id', -1, '$message')";
                $result = $db_handle->query($sql);
                if ($result) {
                    $message_success = "Votre candidature a été envoyée avec succès.";
                } else {
                    $message_success = "Erreur: " . $db_handle->error;
                }
            }
        }
        
    } else {
        $message = "Job ID manquant.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Job Application</title>
<style>
    body {
        background-color: grey;
    }

    .container {
        background-color: white; 
        padding: 20px;
        border-radius: 5px; 
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
        padding-top: 60px;
    }
    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        border-radius: 15px;
        width: 80%;
        max-width: 300px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .modal-content p {
        margin-bottom: 20px;
    }
    .modal-content button {
        background-color: lightblue;
        border: 3px black solid;
        border-radius: 12px;
        color: black;
        text-align: center;
        font-size: 20px;
        display: block;
        margin: 10px auto;
        padding: 5px 10px;
    }
</style>
</head>
<body>

<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <p id="modalMessage"><?php echo $message_success; ?></p>
        <button onclick="window.location.href='../Main/accueil_main.php'">Revenir à la page d'accueil</button>
        <button onclick="window.location.href='PageOffreEmploi.php'">Voir les offres</button>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Display the modal
    modal.style.display = "block";
</script>

</body>
</html>
