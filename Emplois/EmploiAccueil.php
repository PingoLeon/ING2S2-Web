<?php
//! Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
list($user_id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
logout_button_POST();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ECEin";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Entreprise_ID FROM utilisateur WHERE User_ID = ?"; // on 
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($id_entreprise);
$stmt->fetch();
$stmt->close();

if ($id_entreprise > 0 && $id_entreprise != -1) {
    header("Location: ../Emplois/FormulaireOffreEmploi.php");
    ob_end_flush();
    exit();
} elseif ($id_entreprise == 0) {
    header("Location: ../Emplois/PageOffreEmploi.php");
    ob_end_flush();
    exit();
} elseif ($id_entreprise == -1) {
    header("Location: ../Emplois/FormulaireOffreEmploi.php");
    ob_end_flush();
} else {
    echo "Erreur : id_entreprise a une valeur inattendue.";
}

// Fermer la connexion
$conn->close();
?>
