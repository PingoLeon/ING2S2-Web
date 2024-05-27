<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EngineerIN</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Favicons -->
    <meta name="theme-color" content="#712cf9">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    </head>
    <body class="d-flex align-items-center py-4 bg-body-tertiary">    
    <main class="form-signin w-100 m-auto">
        <form action="" method="post">
            <img class="mb-4" src="logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 fw-normal">Inscription</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Mail</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Mot de Passe</label>
            </div>
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault" name="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                Rester connecté
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Inscription</button>
            <?php
                session_start();
                if (isset($_SESSION['error_message'])) {
                    echo "<br><br>";
                    echo $_SESSION['error_message'];
                    unset($_SESSION['error_message']); // Pour ne pas afficher le même message d'erreur plusieurs fois
                }
            ?>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2024</p>
        </form>
        <a href="connexion.php">Déjà un compte ? Connexion</a>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>

<?php
    //! Initialisation
    $database = "linkedin";  
    $db_handle = mysqli_connect('localhost', 'root', '' );  
    $db_found = mysqli_select_db($db_handle, $database);
    
    $email = $password = "";
    $remember = false;
    
    //! Vérifier si l'user à déjà un cookie ou une session
    $token = "";
    if (isset($_COOKIE['token'])) {
        $token = $_COOKIE['token'];
    } elseif (isset($_SESSION['token'])) {
        $token = $_SESSION['token'];
    }
    
    //! Si l'utilisateur est déjà connecté, on le redirige vers la page d'accueil
    if (!empty($token)) {
        $sql = "SELECT * FROM users WHERE token = '$token'";
        $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            header('Location: index.php');
        } else {
            header('Location: inscription.php');
        }
    }

    //! Vérification des données du formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["floatingInput"]) && !empty($_POST["floatingInput"])) {
            $email = $_POST["floatingInput"];
        }else{
            $_SESSION['error_message'] = "<div class='alert alert-danger' role='alert'>Email non renseigné</div>";
            header('Location: inscription.php');
            exit();
        }if (isset($_POST["floatingPassword"]) && !empty($_POST["floatingPassword"])) {
            $password = $_POST["floatingPassword"];
        }else{
            $_SESSION['error_message'] = "<div class='alert alert-danger' role='alert'>Mot de Passe non renseigné</div>";
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
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error_message'] = "<div class='alert alert-danger' role='alert'>Email déjà utilisé</div>";
            header('Location: inscription.php');
            exit();
        }
        
        //!Insérer les données dans la base de données
        $sql = "INSERT INTO users (email, password, token) VALUES ('$email', '$password', '$token')";
        $result = mysqli_query($db_handle, $sql);
        if ($result === false) { //! Si la requête SQL a échoué, on affiche l'erreur
            mysqli_error($db_handle);
            $_SESSION['error_message'] = "<div class='alert alert-danger' role='alert'>Erreur lors de la connexion</div>";
            header('Location: inscription.php');
            exit();
        } else {
            if ($remember) { //!Si l'utilisateur a coché la case "Rester connecté", on crée un cookie, sinon on crée une session
                $cookieSet = setcookie("token", $token, [
                    'expires' => time() + 86400,
                    'path' => '/',
                    'domain' => $_SERVER['HTTP_HOST'],
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'Strict',
                ]);
                if ($cookieSet) {
                    header('Location: /ING2S2-WEB/Form/');
                } else {
                    $_SESSION['error_message'] = "<div class='alert alert-danger' role='alert'>Erreur lors de la création du cookie</div>";
                    header('Location: inscription.php');
                    exit();
                }
            }else{ //! Sinon on crée une session
                $_SESSION["token"] = $token;
                header('Location: /ING2S2-WEB/Form/');
            }  
        }
    }
?>