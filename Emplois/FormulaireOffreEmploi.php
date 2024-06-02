<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ECEin";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Entreprise_ID FROM utilisateur WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($entreprise_id);
$stmt->fetch();
$stmt->close();

$sql_offres = "SELECT * FROM offre_emploi WHERE Enterprise_ID = ?";
$stmt_offres = $conn->prepare($sql_offres);
if (!$stmt_offres) {
    die("Prepare failed: " . $conn->error);
}

$stmt_offres->bind_param("i", $entreprise_id);
$stmt_offres->execute();
$result = $stmt_offres->get_result();
$job_offers = $result->fetch_all(MYSQLI_ASSOC);
$stmt_offres->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="SiteEmplois.css">
    <title>Notifications des Emplois Disponibles</title>
</head>
<body>
    <?php include '../Main/Header.php'; ?>

    <div class="container mt-5">
        <h2>Créer une Nouvelle Offre d'Emploi</h2>
        <form action="CreationOffre.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nomEntreprise">Nom de l'Entreprise</label>
                <input type="text" class="form-control" id="nomEntreprise" name="nomEntreprise" required>
            </div>
            <div class="form-group">
                <label for="intitule">Intitulé</label>
                <input type="text" class="form-control" id="intitule" name="intitule" required>
            </div>
            <div class="form-group">
                <label for="debut">Date de Début</label>
                <input type="date" class="form-control" id="debut" name="debut" required>
            </div>
            <div class="form-group">
                <label for="fin">Date de Fin</label>
                <input type="date" class="form-control" id="fin" name="fin" required>
            </div>

            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            
            <div class="form-group">
                <label for="typeContrat">Type de Contrat</label>
                <input type="text" class="form-control" id="typeContrat" name="typeContrat" required>
            </div>
            <div class="form-group">
                <label for="logo">Logo de l'Entreprise</label>
                <input type="file" class="form-control-file" id="logo" name="logo" required>
            </div>
            <div class="form-group">
                <label for="texte">Texte de Motivation</label>
                <textarea class="form-control" id="texte" name="texte" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Créer l'Offre</button>
        </form>

        <h2 class="mt-5">Offres d'Emploi Existantes</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom de l'Entreprise</th>
                    <th>Intitulé</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Position</th>
                    <th>Type de Contrat</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                $sql = "SELECT e.Nom_Entreprise, o.Intitule, o.Debut, o.Fin, o.Position, o.Type_Contrat
                        FROM utilisateur u
                        JOIN enterprise e ON u.Entreprise_ID = e.Enterprise_ID
                        JOIN offre_emploi o ON e.Enterprise_ID = o.Enterprise_ID
                        WHERE u.User_ID = $user_id";
                $result = mysqli_query($db_handle, $sql);
                $job_offers = mysqli_fetch_all($result, MYSQLI_ASSOC);
                if (empty($job_offers)) {
                    echo '<tr><td colspan="6">Aucune offre d\'emploi existante</td></tr>';
                }else{
                    foreach ($job_offers as $job_offer) {
                        echo '<tr>';
                        echo '<td>' . $job_offer['Nom_Entreprise'] . '</td>';
                        echo '<td>' . $job_offer['Intitule'] . '</td>';
                        echo '<td>' . $job_offer['Debut'] . '</td>';
                        echo '<td>' . $job_offer['Fin'] . '</td>';
                        echo '<td>' . $job_offer['Position'] . '</td>';
                        echo '<td>' . $job_offer['Type_Contrat'] . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
