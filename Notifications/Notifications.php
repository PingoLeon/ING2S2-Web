<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="SiteEmplois.css">
    <title>Notifications des Emplois Disponibles et Autres Notifications</title>
    <style>
        .notification-section {
            margin-top: 30px;
        }
        .notification {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .notification h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .notification img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .notification-actions {
            margin-top: 10px;
        }
        .notification-actions button {
            margin-right: 5px;
        }
    </style>
    <script>
        function handleLike(postId, action) {
            var formData = new FormData();
            formData.append('post_id', postId);
            formData.append('action', action);

            fetch('Likes.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
            .then(data => {
                console.log(data);
                location.reload(); 
            });
        }
    </script>
</head>
<body>
    <?php include '../Main/Header.php'; ?>

    <div class="container mt-5">
        <h2>Notifications</h2>

        <!-- Section des Notifications de Posts -->
        <div class="notification-section">
            <h3>Notifications de Posts</h3>
            <div class="row">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ECEin";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql_posts = "
                    SELECT 
                        posts.Post_ID, posts.User_ID, posts.Enterprise_ID, posts.DatePublication, posts.Photo, posts.Texte, posts.Titre, posts.Lieu, posts.Nb_likes, Utilisateur.Prenom 
                    FROM 
                        posts 
                    JOIN 
                        Utilisateur ON posts.User_ID = Utilisateur.User_ID 
                    ORDER BY 
                        DatePublication DESC
                ";
                $result_posts = $conn->query($sql_posts);

                if ($result_posts->num_rows > 0) {
                    while($row = $result_posts->fetch_assoc()) {
                        echo "<div class='col-md-12 notification'>";
                        echo "<h2>Oui, " . htmlspecialchars($row["Prenom"]) . " a rédigé un nouveau post</h2>";
                        echo "<h2>" . htmlspecialchars($row["Titre"]) . "</h2>";
                        echo "<p>" . htmlspecialchars($row["Texte"]) . "</p>";
                        if (!empty($row["Photo"])) {
                            echo "<img src='../Photos/" . htmlspecialchars($row["Photo"]) . "' alt='Photo'>";
                        }
                        if (!empty($row["Lieu"])) {
                            echo "<p><strong>Lieu :</strong> " . htmlspecialchars($row["Lieu"]) . "</p>";
                        }
                        echo "<p><strong>Date de publication :</strong> " . htmlspecialchars($row["DatePublication"]) . "</p>";
                        echo "<p><strong>Nombre de likes :</strong> " . htmlspecialchars($row["Nb_likes"]) . "</p>";
                        echo "<div class='notification-actions'>";
                        echo "<button class='btn btn-primary' onclick='handleLike(" . $row["Post_ID"] . ", \"like\")'>Like</button>";
                        echo "<button class='btn btn-secondary' onclick='handleLike(" . $row["Post_ID"] . ", \"unlike\")'>Unlike</button>";
                        echo "</div></div>";
                    }
                } else {
                    echo "<div class='col-md-12'><p class='text-center'>Aucune notification trouvée.</p></div>";
                }
                ?>
            </div>
        </div>

        <!-- Section des Notifications d'Événements -->
        <div class="notification-section">
            <h3>Notifications d'Événements</h3>
            <div class="row">
                <?php
                $sql_events = "
                    SELECT 
                        events.events_ID, events.Enterprise_ID, events.Date_publication, events.Intitulé, events.Début, events.Fin, events.Photo, events.Texte, Utilisateur.Prenom 
                    FROM 
                        events 
                    JOIN 
                        Utilisateur ON events.Enterprise_ID = Utilisateur.Entreprise_ID 
                    ORDER BY 
                        Date_publication DESC
                ";
                $result_events = $conn->query($sql_events);

                if ($result_events === FALSE) {
                    echo "<div class='col-md-12'><p class='text-center'>Erreur dans la requête des événements : " . $conn->error . "</p></div>";
                } else if ($result_events->num_rows > 0) {
                    while($row = $result_events->fetch_assoc()) {
                        echo "<div class='col-md-12 notification'>";
                        echo "<h2>Oui, " . htmlspecialchars($row["Prenom"]) . " a planifié un nouvel événement</h2>";
                        echo "<h2>" . htmlspecialchars($row["Intitulé"]) . "</h2>";
                        echo "<p>" . htmlspecialchars($row["Texte"]) . "</p>";
                        if (!empty($row["Photo"])) {
                            echo "<img src='../Profil_entreprises/photo_events/" . htmlspecialchars($row["Photo"]) . "' alt='Event Image'>";
                        }
                        echo "<p><strong>Date de début :</strong> " . htmlspecialchars($row["Début"]) . "</p>";
                        echo "<p><strong>Date de fin :</strong> " . htmlspecialchars($row["Fin"]) . "</p>";
                        echo "<div class='notification-actions'>";
                        echo "<button class='btn btn-primary'>Say congrats</button>";
                        echo "<button class='btn btn-secondary'>Like</button>";
                        echo "</div></div>";
                    }
                } else {
                    echo "<div class='col-md-12'><p class='text-center'>Aucun événement trouvé.</p></div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
