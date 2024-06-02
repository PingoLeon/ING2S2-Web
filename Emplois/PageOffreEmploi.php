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
        <h2>Notifications des Emplois Disponibles</h2>
        <div class="row">
            <?php
            

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ECEin";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 

            // Query to fetch job offers with Job_ID
            $query = 'SELECT Offre_Emploi.Job_ID, Offre_Emploi.Intitule, Offre_Emploi.Debut, Offre_Emploi.Fin, Offre_Emploi.Position, Offre_Emploi.Type_Contrat, Offre_Emploi.Texte, Enterprise.Nom_Entreprise, Enterprise.Logo
                      FROM Offre_Emploi
                      JOIN Enterprise ON Offre_Emploi.Enterprise_ID = Enterprise.Enterprise_ID';

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $photo = '../Profil_entreprises/logos/' . $row["Logo"];
                    echo '<div class="col-md-4">';
                    echo '<div class="card job-card">';
                    echo '<img class="card-img-top" src="' . $photo . '" alt="Card image cap">';
                    echo '<div class="card-body job-card-body">';
                    echo '<h5 class="card-title job-card-title">' . $row["Intitule"] . '</h5>';
                    echo '<p class="card-text job-card-text">' . $row["Texte"] . '</p>';
                    echo '<div class="job-card-footer">';
                    echo '<p>Entreprise: ' . $row["Nom_Entreprise"] . '</p>';
                    echo '<p>Début: ' . $row["Debut"] . '</p>';
                    echo '<p>Fin: ' . $row["Fin"] . '</p>';
                    echo '<p>Position: ' . $row["Position"] . '</p>';
                    echo '<p>Type de Contrat: ' . $row["Type_Contrat"] . '</p>';
                    echo '<form action="PostulerOffre.php" method="POST">';
                    echo '<input type="hidden" name="job_id" value="' . $row["Job_ID"] . '">';
                    echo '<button type="submit" class="btn btn-primary mt-3">Postuler pour cette offre</button>';
                    echo '</form>';
                    echo '</div></div></div></div>';
                }
            } else {
                echo '<div class="col-md-12"><p class="text-center">Aucune offre d\'emploi disponible pour le moment.</p></div>';
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
