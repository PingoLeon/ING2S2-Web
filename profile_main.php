<!-- profile_main.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="Site.css">
</head>
<body>
    <?php include 'Header.html'; ?>

    <br>
    <br>

    <?php
    $database = "ecein";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    $sql = "SELECT * FROM utilisateur WHERE User_ID = 1";
    $result = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($result);

    $prenom = $data['Prenom'];
    $nom = $data['Nom'];
    $email = $data['Mail'];
    $pays = $data['Pays'];
    $photo = $data['Photo'];
    $admin = $data['Statut_Admin'];

    /*****************
     * Profile TITRE *
     *****************/
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class = "row">';
            echo '<div class = "col-md-6">';
            echo '<img src="' . $photo . '" class="rounded-circle" alt="Photo de profil" width="304" height="304">';
            echo '</div>';
            echo '<div class = "col-md-6" style="margin-top:auto; margin-bottom:auto;">';
                echo '<table>';
                echo '<tr><h1 style="color: black;">' . $prenom . ' ' . $nom . '</h1></tr>';
                echo '<tr><h3 style="color: black;">' . $email . '</h3></tr>';
                echo '</table>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
    echo '</div>';

    echo '<br>';

    /*********
     * POSTS *
     *********/
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<h2 style="color: black; text-align: left;">Activités</h2><br>';
        echo '<div class = "row">';
            
            $sql = "SELECT Utilisateur.Nom, Utilisateur.Prenom, Posts.Texte, Posts.Date
            FROM Utilisateur
            JOIN Posts ON Utilisateur.User_ID = Posts.User_ID
            WHERE Utilisateur.User_ID = 1
            ORDER BY Posts.Date DESC;";
            $result = mysqli_query($db_handle, $sql);
            while ($data = mysqli_fetch_assoc($result)) {
                echo '<div class = "col-md-12">';
                    echo '<table>';
                        echo '<tr><h3 style="color: black; text-align: left;">' . $data['Prenom'] . ' ' . $data['Nom'] . '</h3></tr>';
                        echo '<tr><h5 style="color: black;">' . $data['Date'] . '</h5></tr>';
                        echo '<tr><h5 style="color: black;">' . $data['Texte'] . '</h5></tr>';
                    echo '</table>';
                echo '</div>';
            }
            
        echo '</div>';
        echo '<br>';
    echo '</div>';

    echo '<br>';

    /**************
     * EXPERIENCE *
     **************/
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<h2 style="color: black; text-align: left;">Expériences</h2><br>';
        echo '<div class = "row">';
            $sql = "SELECT Utilisateur.Nom, Utilisateur.Prenom, Experience.Position, Experience.Debut, Experience.Fin, Experience.Type_Contrat, Enterprise.Nom_Entreprise, Enterprise.Logo
            FROM Utilisateur
            JOIN Experience ON Utilisateur.User_ID = Experience.User_ID
            JOIN Enterprise ON Experience.Enterprise_ID = Enterprise.Enterprise_ID
            WHERE Utilisateur.User_ID = 1
            ORDER BY Experience.Fin DESC;";
            $result = mysqli_query($db_handle, $sql);
            while ($data = mysqli_fetch_assoc($result)) {
                echo '<div class = "col-md-2">';
                    echo '<img src="' . $data['Logo'] . '.png" alt="Logo de l\'entreprise" width="100" height="100">';
                echo '</div>';
                echo '<div class = "col-md-10">';
                    echo '<table>';
                        echo '<tr><h3 style="color: black; text-align: left;">' . $data['Position'] . ' chez ' . $data['Nom_Entreprise'] . '</h3></tr>';
                        echo '<tr><h5 style="color: black;">' . $data['Debut'] . ' - ' . $data['Fin'] . '</h5></tr>';
                        echo '<tr><h5 style="color: black;">' . $data['Type_Contrat'] . '</h5></tr>';
                    echo '</table>';
                echo '</div>';
            }
            
        echo '</div>';
        echo '<br>';
    echo '</div>';

    echo '<br>';

    /*************
     * EDUCATION *
     *************/
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<h2 style="color: black; text-align: left;">Education</h2><br>';
        echo '<div class = "row">';
            
            $sql = "SELECT Utilisateur.Nom, Utilisateur.Prenom, Education.Nom, Education.Debut, Education.Fin, Education.Type_formation, Enterprise.Nom_Entreprise, Enterprise.Logo
            FROM Utilisateur
            JOIN Education ON Utilisateur.User_ID = Education.User_ID
            JOIN Enterprise ON Education.Enterprise_ID = Enterprise.Enterprise_ID
            WHERE Utilisateur.User_ID = 1
            ORDER BY Education.Debut DESC;";
            $result = mysqli_query($db_handle, $sql);
            while ($data = mysqli_fetch_assoc($result)) {
                echo '<div class = "col-md-2">';
                    echo '<img src="' . $data['Logo'] . '.png" alt="Logo de l\'entreprise" width="100" height="100">';
                echo '</div>';
                echo '<div class = "col-md-10">';
                    echo '<table>';
                        echo '<tr><h3 style="color: black; text-align: left;">' . $data['Nom'] . ' chez ' . $data['Nom_Entreprise'] . '</h3></tr>';
                        echo '<tr><h5 style="color: black;">' . $data['Debut'] . ' - ' . $data['Fin'] . '</h5></tr>';
                        echo '<tr><h5 style="color: black;">' . $data['Type_formation'] . '</h5></tr>';
                    echo '</table>';
                echo '</div>';
            }
            
        echo '</div>';
        echo '<br>';
    echo '</div>';

    echo '<br>';

    /***********
     * PROJETS *
     ***********/
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<h2 style="color: black; text-align: left;">Projets</h2><br>';
        echo '<div class = "row">';
            
            $sql = "SELECT Utilisateur.Nom, Utilisateur.Prenom, Projets.Nom, Projets.Debut, Projets.Fin, Education.Nom, Enterprise.Nom_Entreprise, Enterprise.Logo
            FROM Utilisateur
            JOIN Projets ON Utilisateur.User_ID = Projets.User_ID
            JOIN Education ON Projets.Edu_ID = Education.Edu_ID
            JOIN Enterprise ON Education.Nom = Enterprise.Nom_Entreprise
            WHERE Utilisateur.User_ID = 1
            ORDER BY Projets.Debut DESC;";
            $result = mysqli_query($db_handle, $sql);
            while ($data = mysqli_fetch_assoc($result)) {
                echo '<div class = "col-md-2">';
                    echo '<img src="' . $data['Logo'] . '.png" alt="Logo de l\'entreprise" width="100" height="100">';
                echo '</div>';
                echo '<div class = "col-md-10">';
                    echo '<table>';
                        echo '<tr><h3 style="color: black; text-align: left;">' . $data['Nom'] . ' chez ' . $data['Nom_Entreprise'] . '</h3></tr>';
                        echo '<tr><h5 style="color: black;">' . $data['Debut'] . ' - ' . $data['Fin'] . '</h5></tr>';
                        echo '<tr><h5 style="color: black;">' . $data['Nom'] . '</h5></tr>';
                    echo '</table>';
                echo '</div>';
            }
            
        echo '</div>';
        echo '<br>';
    echo '</div>';

    echo '<br>';

    ?>
</body>
</html>
