<?php ob_start(); ?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
    <head>

    <meta charset="utf-8">
    <link rel="icon" href="../Photos/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EngineerIN</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Favicons -->
    <meta name="theme-color" content="#712cf9">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    
    <script>
        window.onload = toggleDiv;
        function toggleDiv() {
            var entrepriseRadio = document.getElementById('signin-entreprise');
            var hiddenSectionChoice = document.getElementById('hiddenSectionChoice');

            if (entrepriseRadio.checked) {
                hiddenSectionChoice.style.display = 'block'; // Affiche le div si le bouton "Entreprise" est coché
            } else {
                hiddenSectionChoice.style.display = 'none'; // Cache le div si le bouton "Entreprise" n'est pas coché
            }
            
        }
    </script>
    </head>
    <body class="d-flex align-items-center py-2 bg-body-tertiary">    
    <main class="form-signin w-100 m-auto">
        <form action="" method="post">
            <img class="mb-4" src="../Photos/EngineerIN_logo.png" alt="" width="300" height="72">
            <h1 class="h3 mb-3 fw-normal">Inscription</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Mail</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Mot de Passe</label>
            </div>
            <div class="form-check text-start my-3" style="display: flex; flex-direction: column; align-items: flex-start;">
                <div>
                    <input class="form-check-input" type="radio" value="signin-user" id="signin-user" name="user-type" onclick="toggleDiv()" checked>
                    <label class="form-check-label" for="signin-user">
                        Utilisateur
                    </label>
                </div>
                <div>
                    <input class="form-check-input" type="radio" value="signin-entreprise" id="signin-entreprise" name="user-type" onclick="toggleDiv()">
                    <label class="form-check-label" for="signin-entreprise">
                        Entreprise
                    </label>
                </div>
            </div>    
            <div id="hiddenSectionChoice" style="display: none;">
                <label for="entreprise">Nom de l'entreprise:</label>
                <select class="form-control" id="entreprise" name="entreprise">   
                    <div class="form-group">
                        <?php
                            include '../Auth/functions.php';
                            //! Si l'utilisateur est déjà connecté, on le redirige vers la page d'accueil
                            $db_handle = connect_to_db();
                            
                            
                            $sql = "SELECT Enterprise_ID, Nom_Entreprise FROM Enterprise";
                            $result = mysqli_query($db_handle, $sql);
                            while ($data = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $data['Enterprise_ID'] . '">' . $data['Nom_Entreprise'] . '</option>';
                            }
                        ?>
                    </div>
                </select>
                <label class="small-text">Votre entreprise n'est pas dans la liste ? <a href="mailto:contact@engineerIN.fr">Contactez-nous !</a></label>
            </div>        
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault" name="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                Rester connecté
                </label>
            </div>
            <button class="btn btn-primary w-100" type="submit">Inscription</button>
            </form>
            <?php          
                //! Si l'utilisateur est déjà connecté, on le redirige vers la page d'accueil
                list($id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle('connexion');
                if (isset($_SESSION['error_message'])) {
                    echo "<br><br>";
                    echo $_SESSION['error_message'];
                    unset($_SESSION['error_message']); // Pour ne pas afficher le même message d'erreur plusieurs fois
                }
            ?>
            <p class="mt-5 mb-3 text-body">&copy; 2024</p>
        
        <a href="/ING2S2-WEB/Auth/">Déjà un compte ? Connexion</a>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>

<?php
    $email = $password = "";
    $remember = false;
    
    //! Vérification des données du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST["floatingInput"]) && !empty($_POST["floatingInput"])) {
            $email = $_POST["floatingInput"];
        }else{
            $_SESSION['error_message'] = "<div class='alert alert-danger' role='alert'>Email non renseigné</div>";
            ob_end_flush();
            header('Location: inscription.php');
            exit();
        }
        
        if (isset($_POST["floatingPassword"]) && !empty($_POST["floatingPassword"])) {
            $password = $_POST["floatingPassword"];
        }else{
            $_SESSION['error_message'] = "<div class='alert alert-danger' role='alert'>Mot de Passe non renseigné</div>";
            ob_end_flush();
            header('Location: inscription.php');
            exit();
        }
        
        if (isset($_POST["user-type"]) && !empty($_POST["user-type"])) {
            $userType = $_POST["user-type"];
        }else{
            $_SESSION['error_message'] = "<div class='alert alert-danger' role='alert'>Type d'utilisateur non renseigné</div>";
            ob_end_flush();
            header('Location: inscription.php');
            exit();
        }
        
        if (isset($_POST["flexCheckDefault"])) {
            $remember = true;
        } else {
            $remember = false;
        }
    
    
        //!MDP et Token
        //?hashage du mot de passe et salage dans la méthode la plus sécurisée avec SHA512
        $password = hash('sha512', $password);
        //?création d'un token pour la session ou le cookie
        $token = bin2hex(random_bytes(8));
        
        //!Vérifier si le mail existe déjà
        $db_handle = connect_to_db();
        $email = mysqli_real_escape_string($db_handle, $email);
        $sql = "SELECT COUNT(User_ID) AS count FROM Utilisateur WHERE Mail = '$email'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        if ($data['count'] > 0) {
            $_SESSION['error_message'] = "<div class='alert alert-danger' role='alert'>Email déjà utilisé</div>";
            ob_end_flush();
            header('Location: ../Main/inscription.php');
            exit();
        }
        
        //!Insérer les données dans la base de données
        if ($userType == 'signin-user') {
            $entreprise = 0;
        } else if ($userType == 'signin-entreprise') {
            $entreprise = $_POST["entreprise"];
        }
        $sql = "INSERT INTO Utilisateur (Mail, MDP, Token, Entreprise_ID) VALUES ('$email', '$password', '$token', '$entreprise')";
        $result = mysqli_query($db_handle, $sql);
        if ($result === false) { //! Si la requête SQL a échoué, on affiche l'erreur
            mysqli_error($db_handle);
            $_SESSION['error_message'] = "<div class='alert alert-danger' role='alert'>Erreur lors de la connexion</div>";
            ob_end_flush();
            header('Location: inscription.php');
            exit();
        } else {
            //créer une discussion entre l'utilisateur et le compte de notification
            $sql = "INSERT INTO Messagerie (ID1, ID2) VALUES (-1, (SELECT User_ID FROM Utilisateur WHERE Mail = '$email'))";
            $result = mysqli_query($db_handle, $sql);
            if ($remember) { //!Si l'utilisateur a coché la case "Rester connecté", on crée un cookie, sinon on crée une session
                $cookieSet = set_distinct_cookie($token);
                if ($cookieSet) {
                    
                    header('Location: '. $page_to_send_to_once_connected);
                    exit();
                } else {
                    
                    $_SESSION['error_message'] = "<div class='alert alert-danger' role='alert'>Erreur lors de la création du cookie</div>";
                    ob_end_flush();
                    header('Location: ../Main/inscription.php');
                    exit();
                }
            }else{ //! Sinon on crée une session
                
                $_SESSION["token"] = $token;
                header('Location: '. $page_to_send_to_once_connected);
                exit();
            }  
        }
    }
?>