<?php
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

$conn->close();
?>
