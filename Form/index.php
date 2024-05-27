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
        <form method="post">
        <?php
          session_start();
          if (isset($_POST['logout'])) {
            // Détruit la session
            session_unset();
            session_destroy();
            
            // Supprime le cookie
            if (isset($_COOKIE['token'])) {
                unset($_COOKIE['token']);
                setcookie('token', '', time() - 3600, '/'); // Ancien temps pour supprimer le cookie
            }
            
            // Redirige vers la page d'inscription
            header('Location: connexion.php');
            exit;
          }
          
          $token = "";
          
          if (isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
          } elseif (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
          }
          
          if (!empty($token)) { //!Le token n'est pas vide
            // Connexion à la base de données
            $db_handle = mysqli_connect('localhost', 'root', '' );
            $database = "linkedin";  
            $db_found = mysqli_select_db($db_handle, $database);
            $sql = "SELECT * FROM users WHERE token = '$token'";
            $result = mysqli_query($db_handle, $sql);
            
            if (mysqli_num_rows($result) > 0) { //!Le token existe dans la BDD
              if (isset($_SESSION['token'])) {
                echo "<div class='alert alert-success' role='alert'>Vous êtes connecté avec une session</div>";
              } else {
                echo "<div class='alert alert-success' role='alert'>Vous êtes connecté avec un cookie</div>";
              }
              
              $row = mysqli_fetch_assoc($result);
              $email = $row['email'];
              $id = $row['id'];
              echo "<div class='alert alert-info' role='alert'>Informations de l'utilisateur :";
              echo "<br>Email: $email";
              echo "<br>ID: $id</div>";
              
              //!Générer un nouveau cookie si l'utilisateur s'est authentifié par cookie
              if (isset($_COOKIE['token'])) {
                $token2 = bin2hex(random_bytes(8));
                $sql = "UPDATE users SET token = '$token2' WHERE token = '$token'";
                $result_cookie = mysqli_query($db_handle, $sql);
                if (!$result) {
                  echo "Erreur: $sql <br>" . mysqli_error($db_handle);
                }else{
                  echo '<div class="alert alert-warning" role="alert">Nouveau cookie généré</div>';
                  echo "<div class='alert alert-info' role='alert'>Token 1 : $token <br>Token 2 : $token2</div>";
                  setcookie("token", $token2, [
                    'expires' => time() + 86400,
                    'path' => '/',
                    'domain' => $_SERVER['HTTP_HOST'],
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'Strict',
                  ]);     
                }
              }
            } else {
              echo "Token invalide !<br>";
              echo "Token: $token<br>";
              header('Location: connexion.php'); //?Le token n'existe pas dans la BDD, redirection vers la page de connexion
            }
          } else {
            echo "Token invalide !<br>";
            echo "Token: $token<br>";
            header('Location: connexion.php');//? Token vide, redirection vers la page de connexion
          }
        ?>
        <button class="btn btn-warning w-100 py-2" type="submit" name="logout">Déconnexion</button>
      </form>
    </main>
  </body>
</html>