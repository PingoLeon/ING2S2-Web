<?php
include '../Auth/functions.php';
//! Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
list($user_id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
logout_button_POST();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job_id = $_POST['job_id'];
    $user_id = $_POST['user_id'];

    $servername = "localhost";
    $username = "root"  ;
    $password = "";
    $dbname = "ECEin";
    $conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    $sql = "INSERT INTO Applications (Job_ID, User_ID) VALUES ('$job_id', '$user_id')"; // Assuming User_ID is 1 for demo purposes

    if ($conn->query($sql) === TRUE) {
        echo "Application soumis avec succès.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
