<?php
include '../Auth/functions.php';
// Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
list($user_id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
logout_button_POST();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['job_id'])) {
    $job_id = mysqli_real_escape_string($db_handle, $_POST['job_id']);

    if (isset($user_id)) {
        $current_date = date("Y-m-d"); // Getting the current date

        $sql = "INSERT INTO Applications (Job_ID, User_ID, application_date) VALUES (?, ?, ?)";
        $stmt = $db_handle->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iis", $job_id, $user_id, $current_date);
            if ($stmt->execute()) {
                $message = "Application soumise avec succès.";
            } else {
                $message = "Erreur lors de la soumission de l'application.";
            }
            $stmt->close();
        } else {
            $message = "Erreur lors de la préparation de la requête.";
        }
    } else {
        $message = "User ID manquant.";
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
        <p id="modalMessage"><?php echo $message; ?></p>
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
