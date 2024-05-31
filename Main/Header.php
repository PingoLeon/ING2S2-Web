</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Site.css">
    <title>Header</title>
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
            width: 80%;
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
            return text1 + text2 + text3 + text4;
        }
    </script>
</head>

<body>
    <div class="container" id="background">
        <div class="container" id="main_bloc">
            <div class="row">
                <div class="col-md-6">
                    <nav>
                        <a class="navbar-brand" href="accueil_main.php"><b>EngineerIN: Social Media Professionnel de l'ECE Paris</b></a>
                    </nav>
                </div>
                <div class="col-md-4">
                    <a href="#" onclick="openImageModal()">
                        <img src="../Photos/EngineerIN_logo.png" alt="ECE Paris" style="width: 60%;">
                    </a>
                </div>
                <div class="col-md-2">
                    <form method="post">
                        <button class="button_1" type="submit" name="logout">Déconnexion</button>  
                    </form>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-2">
                    <a href="../Main/accueil_main.php" class="button_1">Accueil</a>
                </div>
                <div class="col-md-2">
                    <a href="../Relations/" class="button_1">Mon reseau</a>
                </div>
                <div class="col-md-2">
                    <a href="../Main/profile_main.php" class="button_1">Vous</a>
                </div>
                <div class="col-md-2">
                    <a href="notifications_main.php" class="button_1">Notifications</a>
                </div>
                <div class="col-md-2">
                    <a href="../Messagerie/" class="button_1">Messagerie</a>
                </div>
                <div class="col-md-2">
                    <a href="../Emplois/EmploiAccueil.php" class="button_1">Emplois</a>
                </div>
            </div>
            <br>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalText"></p>
        </div>
    </div>
</body>

</html>
