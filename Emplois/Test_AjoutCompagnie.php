<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ECEIn";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['nomEntreprise']) && isset($_POST['paysEntreprise']) && isset($_POST['industrieEntreprise']) && isset($_POST['nomTuteur'])){
    $nomEntreprise = $_POST['nomEntreprise'];
    $paysEntreprise = $_POST['paysEntreprise'];
    $industrieEntreprise = $_POST['industrieEntreprise'];
    $nomTuteur = $_POST['nomTuteur'];
    $photoEntreprise = $_FILES['photoEntreprise'];

    $target_dir = "PhotosEntreprises/";
    $target_file = $target_dir . basename($photoEntreprise["name"]);
    move_uploaded_file($photoEntreprise["tmp_name"], $target_file);

    $stmt = $conn->prepare("INSERT INTO entreprises (nom, pays, industrie, tuteur, photo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nomEntreprise, $paysEntreprise, $industrieEntreprise, $nomTuteur, $target_file);
    if($stmt->execute()){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    $stmt->close();
}
?>
