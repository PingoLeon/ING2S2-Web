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
          include 'functions.php';
          
          logout_button_POST(); //? Fonction de déconnexion
          
          //! Si l'utilisateur est déjà connecté, on le redirige vers la page d'accueil
          list($id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
          echo "<div class='alert alert-info' role='alert'>Informations de l'utilisateur :";
          echo "<br>Email: $email";
          echo "<br>ID: $id</div>";
              
          //!Générer un nouveau cookie si l'utilisateur s'est authentifié par cookie
          update_token_of_cookie($db_handle);
        ?>
        <button class="btn btn-warning w-100 py-2" type="submit" name="logout">Déconnexion</button>   
      </form>
      <br>
      <a class="btn btn-info w-100 py-2" name="refresh" href="/ING2S2-WEB/Auth-msg-test/messagerie.php">Messagerie</a>
    </main>
  </body>
</html>