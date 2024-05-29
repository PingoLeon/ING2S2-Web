<?php
session_start();

// Détails de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ECEIn";
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Récupérer l'email de l'utilisateur depuis la session
$user_email = $_SESSION['user_email'];

// Préparer et exécuter la requête SQL pour récupérer le statut de l'utilisateur
$sql = "SELECT statut FROM utilisateurs WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $statut = $row['statut'];
} else {
    // Si l'utilisateur n'est pas trouvé, détruire la session et rediriger vers la page de connexion
    session_destroy();
    header("Location: login.php");
    exit();
}

// Rediriger en fonction du statut
switch ($statut) {
    case 0:
        header("Location: EmploiStatut0.php");
        break;
    case 1:
        header("Location: EmploiStatut1.php");
        break;
    case 2:
        header("Location: EmploiStatut2.php");
        break;
    default:
        // Si le statut est inconnu, rediriger vers une page d'erreur ou de déconnexion
        session_destroy();
        header("Location: login.php");
        break;
}
exit();
?>
