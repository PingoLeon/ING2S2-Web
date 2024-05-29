<!-- ProfileProjects.php -->
<?php
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
        $result = Recherche_Projet($db_handle, $user_id);
        while ($data = mysqli_fetch_assoc($result)) {
            Affichage_Projet($data);
        }
    echo '</div>';
    echo '<br>';
echo '</div>';

function Recherche_Projet($db_handle, $user_id) {
    $sql = "SELECT Utilisateur.Nom, Utilisateur.Prenom, Projets.Nom AS ProjNom, Projets.Debut, Projets.Fin, Education.Nom, Enterprise.Nom_Entreprise, Enterprise.Logo
    FROM Utilisateur
    JOIN Projets ON Utilisateur.User_ID = Projets.User_ID
    JOIN Education ON Projets.Edu_ID = Education.Edu_ID
    JOIN Enterprise ON Education.Enterprise_ID = Enterprise.Enterprise_ID
    WHERE Utilisateur.User_ID = $user_id
    ORDER BY Projets.Fin DESC;";
    $result = mysqli_query($db_handle, $sql);
    return $result;
}

function Affichage_Projet($data) {
    echo '<div class="col-md-2">';
        echo '<img src="../' . $data['Logo'] . '.png" alt="Logo de l\'entreprise" width="100" height="100">';
    echo '</div>';
    echo '<div class="col-md-10">';
        echo '<table>';
            echo '<tr><h3 style="color: black; text-align: left;">' . $data['ProjNom'] . ' chez ' . $data['Nom_Entreprise'] . '</h3></tr>';
            echo '<tr><h5 style="color: black;">' . $data['Debut'] . ' - ' . $data['Fin'] . '</h5></tr>';
            echo '<tr><h5 style="color: black;">' . $data['Nom'] . '</h5></tr>';
        echo '</table>';
    echo '</div>';
}


?>
