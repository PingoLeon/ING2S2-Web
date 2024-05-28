<!-- ProfileEducation.php -->
<?php
$database = "ecein";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$user_id = 1;

echo '<div class="container" id="main_bloc_profile">';
    echo '<br>';

    echo '<div class="row">';
        echo '<div class="col-md-10"><h2 style="color: black; text-align: left;">Education</h2></div>';
        echo '<div class="col-md-2">';
            echo '<a href="Modification.php?id=education" id="education">';
            echo '<img src="../Photos/edit.png" alt="Modifier" width="40" height="40" >';
            echo '</a>';
        echo '</div>';

    echo '</div>';

    echo '<br>';
    echo '<div class="row">';
        $result = Recherche_Education($db_handle, $user_id);
        while ($data = mysqli_fetch_assoc($result)) {
            Affichage_Education($data);
        }
    echo '</div>';
    echo '<br>';
echo '</div>';

function Recherche_Education($db_handle, $user_id) {
    $sql = "SELECT Utilisateur.Nom, Utilisateur.Prenom, Education.Nom, Education.Debut, Education.Fin, Education.Type_formation, Enterprise.Nom_Entreprise, Enterprise.Logo
    FROM Utilisateur
    JOIN Education ON Utilisateur.User_ID = Education.User_ID
    JOIN Enterprise ON Education.Enterprise_ID = Enterprise.Enterprise_ID
    WHERE Utilisateur.User_ID = $user_id
    ORDER BY Education.Debut DESC;";
    $result = mysqli_query($db_handle, $sql);
    return $result;
}

function Affichage_Education($data) {
    echo '<div class="col-md-2">';
        echo '<img src="../' . $data['Logo'] . '.png" alt="Logo de l\'entreprise" width="100" height="100">';
    echo '</div>';
    echo '<div class="col-md-10">';
        echo '<table>';
            echo '<tr><h3 style="color: black; text-align: left;">' . $data['Nom'] . ' chez ' . $data['Nom_Entreprise'] . '</h3></tr>';
            echo '<tr><h5 style="color: black;">' . $data['Debut'] . ' - ' . $data['Fin'] . '</h5></tr>';
            echo '<tr><h5 style="color: black;">' . $data['Type_formation'] . '</h5></tr>';
        echo '</table>';
    echo '</div>';
}

?>