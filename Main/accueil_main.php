<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Site.css">
    <style>
        .post-container {
            margin: 20px 0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .post-header img {
            border-radius: 50%;
            margin-right: 15px;
        }
        .post-content {
            margin-top: 10px;
        }
        
        .flag {
        height: 500px;
        width: 500px;
        position: absolute;
        }

        .azure{
        height: 30%;
        width: 70%;
        }
        .white {
        height: 70%;
        width: 70%;
        }


        .azure {
        background-color: #0077B5;
        }

        .white {
        background-color: white;
        }
    </style>
</head>
<body>
    <?php 
        include 'Header.php';
        list($user_id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
    ?>
    <div class="container" id="background">
        <br>
        <div class="container">
            <br>
            <div class="row" style="margin-left: -10%;">
                    <?php 
                        $sql = "SELECT * FROM utilisateur WHERE User_ID = '$user_id';";
                        $result = mysqli_query($db_handle, $sql);
                        $data = mysqli_fetch_assoc($result);
                        $nom = $data['Nom'];
                        $prenom = $data['Prenom'];
                        $photo = $data['Photo'];
                        $photo = '../Photos/' . $photo . '';
                        echo '<div class="col-md-4">';
                            echo '<div class="flag" style="position: relative;">';
                                echo '<div class="azure">';
                                echo '</div>';
                                echo '<div style="position: absolute; bottom:35%; left: 150px; transform: translate(-50%, -50%); width: 50%;">'; // Adjust positioning and size here
                                    echo '<img src="' . $photo . '" class="rounded-circle img-fluid" alt="Profile Picture" style="object-fit: cover;">'; // Add img-fluid class and object-fit style here
                                echo '</div>';
                                echo '<div class="white">';
                                    echo '<br><br><br><br>';
                                    echo '<h1>' . $prenom . ' ' . $nom . '</h1>';
                                    echo '<br>';
                                    echo '<a href="../Main/Profile_main.php" class="btn btn-primary">Voir mon profil</a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    ?>
                <div class="col-md-8">
                    <?php
                        $sql = "SELECT P.Post_ID, P.User_ID, P.Enterprise_ID, P.DatePublication, P.Photo, P.Texte, P.Titre, P.Lieu
                                FROM Posts AS P
                                JOIN Relations AS R ON (P.User_ID = R.UID1 OR P.User_ID = R.UID2)
                                WHERE (R.UID1 = '$user_id' OR R.UID2 = '$user_id')
                                AND P.User_ID != '$user_id'
                                ORDER BY P.DatePublication DESC;";
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
                                $titre = $data['Titre'];
                                $lieu = $data['Lieu'];

                                echo "<div class='post-container' id='main_bloc' ;>";
                                    echo "<div class='post-header'>";
                                        echo '<img src="' . $photo . '" alt="Photo de profil" style="width:100px;">';
                                        echo "<div><h3>$titre</h3><p>$date</p></div>";
                                    echo "</div>";
                                    echo "<div class='post-content'>";
                                        echo "<p>$texte</p>";
                                        echo "<p><strong>Lieu:</strong> $lieu</p>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
