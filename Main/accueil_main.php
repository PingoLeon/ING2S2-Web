<?php
    ob_start();
?>
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="modal.js"></script> <!-- Link to your modal script -->
    <style>
        /* Ensure the columns stack on smaller screens and sit side by side on larger screens */
        .row > .col-md-4,
        .row > .col-md-8 {
            padding: 10px;
        }
    </style>
    <script>
        function toggleCommentsAndMessageBar(postId) {
            var commentsSection = document.getElementById('section-comments-display-' + postId);
            var messageBar = document.getElementById('bar-post-comment-' + postId);
            var display = commentsSection.style.display == 'none' ? 'block' : 'none';
            commentsSection.style.display = display;
            messageBar.style.display = display;
        }
    </script>
    <style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    </style>
    <script>
        function openImageModal() {
            const modal = document.getElementById("imageModal");
            const span = document.getElementsByClassName("close")[0];
            const modalText = document.getElementById("modalText");
            // Call the JavaScript function to generate the text
            const text = generateModalText();
            modalText.innerHTML = text;
            // Display the modal
            modal.style.display = "block";
            // Close the modal when the user clicks on <span> (x)
            span.onclick = function () {
                modal.style.display = "none";
            }
            // Close the modal when the user clicks anywhere outside of the modal
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
        function generateModalText() {
            // Replace this with your dynamic text generation logic
            //The logo is displayed
            text1 = "<img src='../Photos/EngineerIN_logo.png' alt='ECE Paris' style='width: 100%;'>"
            text2 = "<h2>EngineerIN: Social Media Professionnel de l'ECE Paris</h2><br>"
            text3 = "<p>Nous sommes une platforme de reseau social pour les etudiants de l'ECE Paris.</p>"
            text4 = "<p>Cree par un groupe de 4 etudiants, notre objectif est de faciliter la communication entre les etudiants et des employeurs potentiels. On peut y trouver des offres d'emplois, des evenements des entreprises que vous aimez mais surtout, vous pouvez generer votre propre profil.</p>"
            text5 = "<p>Bienvenue sur ECEIn, la plateforme de réseaux sociaux professionnelle exclusivement conçue pour la communauté ECE Paris. Que vous soyez étudiant en licence, master ou doctorat, apprenti en entreprise, étudiant à la recherche d'un stage, professeur ou salarié à la recherche de partenaires de recherche, ce site s'adresse à toute personne prenant sa vie professionnelle au sérieux, visant pour découvrir de nouvelles opportunités de carrière et se connecter avec les autres pour atteindre des objectifs professionnels.</p>"
            return text1 + text2 + text3 + text4 + text5;
        }
    </script>
</head>
<body>
    <?php 
        include 'Header.php';
    ?>
    <div class="container" id="background">
        <br>
        <div class="row">
            <div class="col-md-4">
                <?php 
                    // First flag
                    $sql = "SELECT * FROM utilisateur WHERE User_ID = '$user_id';";
                    $result = mysqli_query($db_handle, $sql);
                    $data = mysqli_fetch_assoc($result);
                    $nom = $data['Nom'];
                    $prenom = $data['Prenom'];
                    $photo = $data['Photo'];
                    $photo = '../Photos/' . $photo . '';
                    echo '<div class="flag" style="position: relative; margin-bottom: 20px;">';
                        echo '<div class="azure"></div>';
                        echo '<div style="position: absolute; bottom:50%; left: 150px; transform: translate(-50%, -50%); width: 50%;">';
                            echo '<img src="' . $photo . '" class="rounded-circle img-fluid" alt="Profile Picture" style="object-fit: cover; width:100px; height:100px;">';
                        echo '</div>';
                        echo '<div class="white">';
                            echo '<br><br><br><br>';
                            echo '<h1>' . $prenom . ' ' . $nom . '</h1>';
                            echo '<br>';
                            echo '<a href="../Main/Profile_main.php" class="btn btn-primary">Voir mon profil</a>';
                        echo '</div>';
                    echo '</div>';

                    // PUBLICITE - LA PUB EST CLICKABLE ET RENVOIT VERS LE SITE DE DISCORD
                    echo '<a href="https://discord.com/" target="_blank" style="color: white;">';
                        echo '<img src="../Photos/pub1.png" style="object-fit: cover; width: 97%; ">';    
                    echo '</a>';
                ?>
            </div>

            <div class="col-md-8">
                <?php
                    $sql = "SELECT P.Post_ID, P.User_ID, P.Enterprise_ID, P.DatePublication, P.Photo, P.Texte, P.Titre, P.Lieu
                            FROM Posts AS P
                            JOIN Relations AS R ON (P.User_ID = R.UID1 OR P.User_ID = R.UID2)
                            WHERE (R.UID1 = '$user_id' OR R.UID2 = '$user_id')
                            ORDER BY P.DatePublication DESC;";
                    $result = mysqli_query($db_handle, $sql);

                    if (mysqli_num_rows($result) == 0) {
                        echo "Vous n'avez pas encore de posts.";
                    } else {
                        while ($data = mysqli_fetch_assoc($result)) {
                            $post_id = $data['Post_ID'];
                            $user_id_author = $data['User_ID'];
                            $entreprise_id = $data['Enterprise_ID'];
                            $date = $data['DatePublication'];
                            $photo = $data['Photo'];
                            $photo = '../' . $photo . '.png';
                            $texte = $data['Texte'];
                            $titre = $data['Titre'];
                            $lieu = $data['Lieu'];

                            echo "<div class='post-container-$post_id containerdepost' id='main_bloc';>";
                                echo "<div class='post-header'>";
                                    echo '<img src="' . $photo . '" alt="Photo du Post" style="width:100px;">';
                                    echo "<div><h3>$titre</h3><p>$date</p></div>";
                                echo "</div>";
                                echo "<div class='post-content'>";
                                    echo "<p>$texte</p>";
                                    echo "<p><strong>Lieu:</strong> $lieu</p>";
                                echo "</div>";
                                // Ajouter une section déroulante pour les commentaires
                                echo "<div>";
                                    echo "<button class='btn show-comments-button' onclick='toggleCommentsAndMessageBar($post_id)'>Afficher les commentaires</button>";
                                    echo "<div id='section-comments-display-$post_id' style='display:none' class='flex-grow-1 overflow-auto p-3 comments-section comments-container' >";
                                        // Charger les commentaires à partir de la base de données
                                        $sql_comments = "SELECT * FROM Commentaires WHERE Post_ID = $post_id;";
                                        $result_comments = mysqli_query($db_handle, $sql_comments);
                                        if (mysqli_num_rows($result_comments) == 0) {
                                            echo "<p>Aucun commentaire pour le moment.</p>";
                                        }else{
                                            while ($data_comment = mysqli_fetch_assoc($result_comments)) {
                                                $comment_text = $data_comment['Texte'];
                                                $comment_date = $data_comment['DatePubli'];
                                                $user_id_comment = $data_comment['User_ID'];
                                                $sql_user = "SELECT Nom, Prenom FROM utilisateur WHERE User_ID = $user_id_comment;";
                                                $result_user = mysqli_query($db_handle, $sql_user);
                                                $data_user = mysqli_fetch_assoc($result_user);
                                                $nom = $data_user['Nom'];
                                                $prenom = $data_user['Prenom'];
                                                echo "<p class='comment-left'>
                                                        <span style='font-size: 1rem; font-weight: 550; color: #6c757d;'>$prenom $nom</span>
                                                        <br> 
                                                        <span class='my-card-text'>
                                                        $comment_text 
                                                        </span>
                                                        <br> 
                                                        <small><small>$comment_date</small></small>
                                                    </p>";
                                                }
                                            }
                                    echo "</div>";
                                    echo " <form  id='bar-post-comment-$post_id' style='display:none' id='messageForm' class='align-items-center border-top p-3 mt-auto' method='post'>
                                                <div class='d-flex'>
                                                    <input type='hidden' name='post_id' value='$post_id'>
                                                    <input id='MessageBar' type='text' name='commentaire' class='form-control flex-grow-1 me-2' placeholder='Écrire un message' autocomplete='off' required>
                                                    <button type='submit' class='btn btn-primary'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-send' viewBox='0 0 16 16'>
                                                            <path d='M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z'/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </form>
                                            ";
                                    //! Envoyer le message
                                    if (isset($_POST['post_id']) && isset($_POST['commentaire'])) {
                                        $post_id = mysqli_real_escape_string($db_handle, $_POST['post_id']);
                                        $comment = mysqli_real_escape_string($db_handle, $_POST['commentaire']);

                                        // Insérer le commentaire dans la base de données
                                        $sql_comment = "INSERT INTO Commentaires(Post_ID, User_ID, Texte) VALUES ('$post_id', '$user_id', '$comment')";
                                        $result = mysqli_query($db_handle, $sql_comment);

                                        if (!$result) {
                                            echo "Erreur: $sql_comment <br>" . mysqli_error($db_handle);
                                        } else {
                                            $_SESSION['current_post'] = $post_id;
                                            header("Location: ../Main/accueil_main.php");
                                            ob_end_flush();
                                            exit;
                                        }
                                    }
                                    echo "
                                        </div>
                                    </div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
        if (isset($_SESSION['current_post'])) {
            $current_post = $_SESSION['current_post'];
            unset($_SESSION['current_post']);
            echo "
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var element = document.querySelector('.post-container-$current_post');
                    element.scrollIntoView();
                    var button = document.querySelector('.post-container-$current_post .show-comments-button');
                    button.click();
                    var messagesContainer = document.querySelector('.post-container-$current_post .comments-container');
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                });
                </script>
            ";
        }
    ?>

    <?php
    echo '<div id="main_bloc" style="text-align: center;">';
        echo '<footer>';
            echo '<div id="footer">';
            echo '<a href="mailto:contact@engineerIN.fr">Contactez-nous: contact@engineerIN.fr</a> | Téléphone: 0609508625</p>';
                echo '<p>Adresse: 7 Rue Sextius Michel, Paris 75015, France</p>';
                echo '<div id="map">';
                    echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10501.426175804241!2d2.270454903290812!3d48.85141112749421!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b43f62b4b%3A0x43f21f781ac4586b!2s7%20Rue%20Sextius%20Michel%2C%2075015%20Paris!5e0!" width="300" height="225" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                echo '</div>';
            echo '</div>';
            echo '<a href="#" onclick="openImageModal()">';
                echo '<img src="../Photos/EngineerIN_logo.png" alt="ECE Paris" style="width: 10%;">';
            echo '</a>';
        echo '</footer>';
    echo '</div>';
    //Logo de l'entreprise that when clicked, a modal appears with the company's information
    /*<a href="#" onclick="openImageModal()">
                        <img src="../Photos/EngineerIN_logo.png" alt="ECE Paris" style="width: 60%;">
                    </a>*/
    
    
    ?>


    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalText"></p>
        </div>
    </div>


</body>
</html>
