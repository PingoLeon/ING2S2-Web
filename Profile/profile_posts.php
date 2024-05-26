<!-- ProfilePosts.php -->
<?php
$database = "ecein";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

echo '<div class="container" id="main_bloc_profile">';
    echo '<br>';
    echo '<h2 style="color: black; text-align: left;">Activités</h2><br>';
    echo '<div class="row">';
        
        $sql = "SELECT Utilisateur.Nom, Utilisateur.Prenom, Posts.Texte, Posts.Date
        FROM Utilisateur
        JOIN Posts ON Utilisateur.User_ID = Posts.User_ID
        WHERE Utilisateur.User_ID = 1
        ORDER BY Posts.Date DESC;";
        $result = mysqli_query($db_handle, $sql);
        while ($data = mysqli_fetch_assoc($result)) {
            echo '<div class="col-md-12">';
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
?>
