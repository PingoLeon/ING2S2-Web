<!-- ProfileProjects.php -->
<?php
$database = "ecein";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

echo '<div class="container" id="main_bloc_profile">';
    echo '<br>';
    
    echo '<div class="row">';
        echo '<div class="col-md-10"><h2 style="color: black; text-align: left;">Projets</h2></div>';
        echo '<div class="col-md-2">';
            echo '<a href="Modification.php?id=projet" id="projet">';
            echo '<img src="../Photos/edit.png" alt="Modifier" width="40" height="40" >';
            echo '</a>';
        echo '</div>';

    echo '</div>';

    echo '<br>';

    echo '<div class="row">';
        $result = Recherche_Projet($db_handle, 1);
        while ($data = mysqli_fetch_assoc($result)) {
            Affichage_Projet($data);
        }
    echo '</div>';
    echo '<br>';
echo '</div>';

function Recherche_Projet($db_handle, $user_id) {
    $sql = "SELECT Utilisateur.Nom, Utilisateur.Prenom, Projets.Nom, Projets.Debut, Projets.Fin, Education.Nom, Enterprise.Nom_Entreprise, Enterprise.Logo
    FROM Utilisateur
    JOIN Projets ON Utilisateur.User_ID = Projets.User_ID
    JOIN Education ON Projets.Edu_ID = Education.Edu_ID
    JOIN Enterprise ON Education.Nom = Enterprise.Nom_Entreprise
    WHERE Utilisateur.User_ID = 1
    ORDER BY Projets.Debut DESC;";
    $result = mysqli_query($db_handle, $sql);
    return $result;
}

function Affichage_Projet($data) {
    echo '<div class="col-md-2">';
        echo '<img src="../' . $data['Logo'] . '.png" alt="Logo de l\'entreprise" width="100" height="100">';
    echo '</div>';
    echo '<div class="col-md-10">';
        echo '<table>';
            echo '<tr><h3 style="color: black; text-align: left;">' . $data['Nom'] . ' chez ' . $data['Nom_Entreprise'] . '</h3></tr>';
            echo '<tr><h5 style="color: black;">' . $data['Debut'] . ' - ' . $data['Fin'] . '</h5></tr>';
            echo '<tr><h5 style="color: black;">' . $data['Nom'] . '</h5></tr>';
        echo '</table>';
    echo '</div>';
}


?>
