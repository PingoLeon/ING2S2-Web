<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ECEIn";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['nomEntreprise'])){
    $nomEntreprise = $_POST['nomEntreprise'];
    $stmt = $conn->prepare("SELECT COUNT(*) FROM entreprises WHERE nom = ?");
    $stmt->bind_param("s", $nomEntreprise);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    echo json_encode(['exists' => $count > 0]);
}
?>
