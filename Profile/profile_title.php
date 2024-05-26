<!-- ProfileTitle.php -->
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

echo '<div class="container" id="main_bloc_profile">';
    echo '<br>';
    echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<img src="../' . $photo . '" class="rounded-circle" alt="Photo de profil" width="304" height="304">';
        echo '</div>';
        echo '<div class="col-md-6" style="margin-top:auto; margin-bottom:auto;">';
            echo '<table>';
            echo '<tr><h1 style="color: black;">' . $prenom . ' ' . $nom . '</h1></tr>';
            echo '<tr><h3 style="color: black;">' . $email . '</h3></tr>';
            echo '<tr><h3 style="color: black;">' . $pays . '</h3></tr>';
            echo '<br>';
            echo '<tr><a href="CV.php" class="btn btn-primary">Générer un CV</a></tr>';
            echo '</table>';
        echo '</div>';
    echo '</div>';
    echo '<br>';
echo '</div>';
?>
