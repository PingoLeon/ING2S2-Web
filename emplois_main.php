<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="SiteEmplois.css">
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
                    <a href="accueil_main.php"><img src="EngineerIN_logo.png" alt="ECE Paris" class="img-fluid" style="width: 60%;"></a>
                </div>
                <div class="col-md-2 text-right">
                    <a href="deconnexion.php" class="button_1">Deconnexion</a>
                </div>
            </div>
            <br>
            <div class="row text-center">
                <div class="col-md-2">
                    <a href="accueil_main.php" class="button_1">Accueil</a>
                </div>
                <div class="col-md-2">
                    <a href="reseau_main.php" class="button_1">Mon reseau</a>
                </div>
                <div class="col-md-2">
                    <a href="profile_main.php" class="button_1">Vous</a>
                </div>
                <div class="col-md-2">
                    <a href="notifications_main.php" class="button_1">Notifications</a>
                </div>
                <div class="col-md-2">
                    <a href="messagerie_main.php" class="button_1">Messagerie</a>
                </div>
                <div class="col-md-2">
                    <a href="emplois_main.php" class="button_1">Emplois</a>
                </div>
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

            session_start();

            // Check if user_id is set
            if (!isset($_SESSION['user_id'])) {
                echo '<div class="col-md-12"><p class="text-center">Veuillez vous connecter pour voir les offres d\'emploi.</p></div>';
                exit();
            }

            $userID = $_SESSION['user_id'];

            // Check if the user is an admin
            $admin_check_sql = "SELECT Statut_Admin FROM utilisateur WHERE User_ID = $userID";
            $admin_check_result = $conn->query($admin_check_sql);
            $is_admin = false;

            if ($admin_check_result->num_rows > 0) {
                $admin_row = $admin_check_result->fetch_assoc();
                $is_admin = $admin_row['Statut_Admin'] == 1;
            }

            if ($is_admin) {
                echo '<div class="col-md-12 text-right mb-3">';
                echo '<a href="ajouter_offre.php" class="btn btn-primary">Ajouter une Offre d\'Emploi</a>';
                echo '</div>';
            }

            // Fetch job offers
            $sql = "SELECT Offre_Emploi.Offre_ID, Offre_Emploi.Intitule, Offre_Emploi.Debut, Offre_Emploi.Fin, Offre_Emploi.Position, Offre_Emploi.Type_Contrat, Offre_Emploi.Photo, Offre_Emploi.Texte, Enterprise.Nom_Entreprise, Enterprise.Logo
                    FROM Offre_Emploi
                    JOIN Enterprise ON Offre_Emploi.Enterprise_ID = Enterprise.Enterprise_ID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card shadow-sm">';
                    echo '<img class="card-img-top" src="' . $row["Photo"] . '" alt="Image">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["Intitule"] . '</h5>';
                    echo '<p class="card-text">' . $row["Texte"] . '</p>';
                    echo '<p class="card-text"><small class="text-muted">Entreprise: ' . $row["Nom_Entreprise"] . '</small></p>';
                    echo '<p class="card-text"><small class="text-muted">Début: ' . $row["Debut"] . '</small></p>';
                    echo '<p class="card-text"><small class="text-muted">Fin: ' . $row["Fin"] . '</small></p>';
                    echo '<p class="card-text"><small class="text-muted">Position: ' . $row["Position"] . '</small></p>';
                    echo '<p class="card-text"><small class="text-muted">Type de Contrat: ' . $row["Type_Contrat"] . '</small></p>';
                    echo '<a href="postuler.php?offre_id=' . $row["Offre_ID"] . '" class="btn btn-primary">Postuler</a>';
                    echo '</div></div></div>';
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
