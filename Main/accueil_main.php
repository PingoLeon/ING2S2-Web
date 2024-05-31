<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="Site.css">
</head>

<body>
    <?php include 'Header.php';
list($user_id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
?>
    <div class="container" id="background">
        <br>
        <div class="container" id="main_bloc">
            <h1>Accueil</h1>
            <br>
            <?php
            
            $sql = "SELECT P.Post_ID, P.User_ID, P.Enterprise_ID, P.DatePublication, P.Photo, P.Texte, P.Titre, P.Lieu
            FROM Posts AS P
            JOIN Relations AS R ON (P.User_ID = R.UID1 OR P.User_ID = R.UID2)
            WHERE (R.UID1 = '$user_id' OR R.UID2 = '$user_id')
            AND P.User_ID != '$user_id'
            ORDER BY P.DatePublication ASC;";
            $result = mysqli_query($db_handle, $sql);

            if (mysqli_num_rows($result) == 0) {
                echo "Vous n'avez pas encore de posts.";
            } else {
                while ($data = mysqli_fetch_assoc($result)) {
                    $post_id = $data['Post_ID'];
                    $user_id = $data['User_ID'];
                    $entreprise_id = $data['Enterprise_ID'];
                    $date = $data['DatePublication'];
                    $photo = $data['Photo'];
                    $photo = '../' . $photo . '.png';
                    $texte = $data['Texte'];
                
                    echo "<div class='container' id='post_bloc'>";
                    echo '<img src="' . $photo . '" alt="Photo de profil" id="photo_profil" style="width:100px;">';
                    echo "<h3>$date</h3>";
                    echo "<p>$texte</p>";
                    echo "<a href='Profil_entreprises/entreprise.php?user_id=$user_id'>Voir le profil</a>";
                    echo "</div>";
                }
            }
            ?>

            
        </div>

        
    
        
    </div>


    
    
</body>

</html>