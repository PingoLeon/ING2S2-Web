<?php
include '../Auth/functions.php';
//! Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
list($user_id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
logout_button_POST();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ECEIn";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nomEntreprise = $_POST['nomEntreprise'];
$intitule = $_POST['intitule'];
$debut = $_POST['debut'];
$fin = $_POST['fin'];
$position = $_POST['position'];
$typeContrat = $_POST['typeContrat'];
$texte = $_POST['texte'];
$logo = $_FILES['logo']['name'];

$query = "SELECT Enterprise_ID FROM Enterprise WHERE Nom_Entreprise = '$nomEntreprise'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $enterprise_id = $row['Enterprise_ID'];
} else {

    $logo_path = 'path/to/save/logo/' . basename($logo); // Define the path to save the logo
    move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path); // Save the logo file

    $query = "INSERT INTO Enterprise (Nom_Entreprise, Logo) VALUES ('$nomEntreprise', '$logo_path')";
    if ($conn->query($query) === TRUE) {
        $enterprise_id = $conn->insert_id;
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
        exit();
    }
}

$query = "INSERT INTO Offre_Emploi (Enterprise_ID, Intitule, Debut, Fin, Position, Type_Contrat, Texte) 
          VALUES ('$enterprise_id', '$intitule', '$debut', '$fin', '$position', '$typeContrat', '$texte')";

if ($conn->query($query) === TRUE) {
    echo "Nouvelle offre d'emploi créée avec succès";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>