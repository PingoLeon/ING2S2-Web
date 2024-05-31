<!-- ProfileExperience.php -->
<?php
echo '<div class="container" id="main_bloc_profile">';
    echo '<br>';

    echo '<div class="row">';
        echo '<div class="col-md-10"><h2 style="color: black; text-align: left;">Experience</h2></div>';
        echo '<div class="col-md-2">';
            echo '<a href="Modification.php?id=experience" id="experience">';
            echo '<img src="../Photos/edit.png" alt="Modifier" width="40" height="40" >';
            echo '</a>';
        echo '</div>';

    echo '</div>';

    echo '<div class="row">';
        $result = Rechercher_Experience($db_handle, $user_id);
        while ($data = mysqli_fetch_assoc($result)) {
            Affichage_Experience($data);
        }
    echo '</div>';
    echo '<br>';
echo '</div>';


function Rechercher_Experience($db_handle, $user_id) {
    $sql = "SELECT Utilisateur.Nom, Utilisateur.Prenom, Experience.Position, Experience.Debut, Experience.Fin, Experience.Type_Contrat, Enterprise.Nom_Entreprise, Enterprise.Logo
    FROM Utilisateur
    JOIN Experience ON Utilisateur.User_ID = Experience.User_ID
    JOIN Enterprise ON Experience.Enterprise_ID = Enterprise.Enterprise_ID
    WHERE Utilisateur.User_ID = $user_id
    ORDER BY Experience.Fin DESC;";
    $result = mysqli_query($db_handle, $sql);
    return $result;
}

//Sql qui reprend tout les donnees de entreprise et de informations 
$sql = "SELECT * FROM Entreprise, Informations WHERE Entreprise.ID_Entreprise = Informations.ID_Entreprise";

function Affichage_Experience($data) {
    echo '<div class="col-md-2">';
        echo '<img src="../' . $data['Logo'] . '.png" alt="Logo de l\'entreprise" width="100" height="100">';
    echo '</div>';
    echo '<div class="col-md-10">';
        echo '<table>';
            echo '<tr><h3 style="color: black; text-align: left;">' . $data['Position'] . ' chez ' . $data['Nom_Entreprise'] . '</h3></tr>';
            echo '<tr><h5 style="color: black;">' . $data['Debut'] . ' - ' . $data['Fin'] . '</h5></tr>';
            echo '<tr><h5 style="color: black;">' . $data['Type_Contrat'] . '</h5></tr>';
        echo '</table>';
    echo '</div>';
}

?>
