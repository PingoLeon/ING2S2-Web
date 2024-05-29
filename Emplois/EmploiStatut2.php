<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="SiteEmplois.css">
    <link rel="stylesheet" type="text/css" href="../Site.css">
    <title>Header</title>
</head>

<body>
<div class="container" id="background">
    <div class="container" id="main_bloc">
        <div class="row align-items-center">
            <div class="col-md-6">
                <nav>
                    <a class="navbar-brand" href="accueil_main.php"><b>EngineerIN: Social Media Professionnel de l'ECE Paris</b></a>
                </nav>
            </div>
            <div class="col-md-4 text-center">
                <a href="accueil_main.php"><img src="../EngineerIN_logo.png" alt="ECE Paris" class="img-fluid" style="width: 60%;"></a>
            </div>
            <div class="col-md-2 text-right">
                <a href="deconnexion.php" class="button_1">Deconnexion</a>
            </div>
        </div>
        <br>
        <div class="row text-center">
            <div class="col-md-2"><a href="accueil_main.php" class="button_1">Accueil</a></div>
            <div class="col-md-2"><a href="reseau_main.php" class="button_1">Mon reseau</a></div>
            <div class="col-md-2"><a href="profile_main.php" class="button_1">Vous</a></div>
            <div class="col-md-2"><a href="notifications_main.php" class="button_1">Notifications</a></div>
            <div class="col-md-2"><a href="messagerie_main.php" class="button_1">Messagerie</a></div>
            <div class="col-md-2"><a href="emplois_main.php" class="button_1">Emplois</a></div>
        </div>
        <br>
    </div>
</div>

<div class="container mt-5">
    <h2>Notifications des Emplois Disponibles</h2>
    <div class="row">
        <?php
        // Connexion
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ECEIn";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = 'SELECT Offre_Emploi.Intitule, Offre_Emploi.Debut, Offre_Emploi.Fin, Offre_Emploi.Position, Offre_Emploi.Type_Contrat, Offre_Emploi.Logo AS Photo, Offre_Emploi.Texte, Enterprise.Nom_Entreprise, Enterprise.Logo, Enterprise.Email
                  FROM Offre_Emploi
                  JOIN Enterprise ON Offre_Emploi.Enterprise_ID = Enterprise.Enterprise_ID';

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $photo = '../' . $row["Photo"];
                echo '<div class="col-md-4">';
                echo '<div class="card mb-4 shadow-sm">';
                echo '<img class="card-img-top" src="' . $photo . '" alt="Card image cap">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["Intitule"] . '</h5>';
                echo '<p class="card-text">' . $row["Texte"] . '</p>';
                echo '<p class="card-text"><small class="text-muted">Entreprise: ' . $row["Nom_Entreprise"] . '</small></p>';
                echo '<p class="card-text"><small class="text-muted">Début: ' . $row["Debut"] . '</small></p>';
                echo '<p class="card-text"><small class="text-muted">Fin: ' . $row["Fin"] . '</small></p>';
                echo '<p class="card-text"><small class="text-muted">Position: ' . $row["Position"] . '</small></p>';
                echo '<p class="card-text"><small class="text-muted">Type de Contrat: ' . $row["Type_Contrat"] . '</small></p>';
                
                // Form to upload CV
                echo '<form action="submit_cv.php" method="POST" enctype="multipart/form-data">';
                echo '<input type="hidden" name="enterprise_email" value="' . $row["Email"] . '">';
                echo '<div class="form-group">';
                echo '<label for="cvFile">Télécharger votre CV</label>';
                echo '<input type="file" class="form-control-file" id="cvFile" name="cvFile" required>';
                echo '</div>';
                echo '<button type="submit" class="btn btn-primary mt-2">Postuler</button>';
                echo '</form>';
                echo '</div></div></div>';
            }
        } else {
            echo '<div class="col-md-12"><p class="text-center">Aucune offre d\'emploi disponible pour le moment.</p></div>';
        }
        $conn->close();
        ?>
    </div>
</div>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="alert alert-success mt-4" role="alert">
        Votre CV a bien été envoyé!
    </div>
<?php endif; ?>

</body>
</html>