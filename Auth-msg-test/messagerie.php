<?php
    ob_start();
    include 'functions.php';
    
    //! Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
    list($id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
    <head>
        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EngineerIN</title>
    
    <link rel="cano nical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Favicons -->
    <meta name="theme-color" content="#712cf9">
    
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    
    <!-- Import d'Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    </head>
    <body class="d-flex align-items-center py-4 bg-body-tertiary">
        <main class="form-signin w-1000 m-auto">
            <?php
                echo "<div class='alert alert-success' role='alert'>Vous êtes connecté en tant que $email</div>";
                
                
                //! Fetch tous les mails qui ont une conversation avec la personne connectée
                $sql = "SELECT User_ID, Mail FROM Utilisateur WHERE User_ID IN (SELECT ID1 FROM Messagerie WHERE ID2 = '$id') OR User_ID IN (SELECT ID2 FROM Messagerie WHERE ID1 = '$id')";
                $result = mysqli_query($db_handle, $sql);
                if (mysqli_num_rows($result) != 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        $friend_email = $row['Mail'];
                        $friend_id = $row['User_ID'];
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='friend_email' value='$friend_email'>";
                        echo "<input type='hidden' name='friend_id' value='$friend_id'>";
                        echo "<button type='submit' class='btn btn-primary'>Conversation avec $friend_email, $friend_id</button>";
                        echo "</form><br>";                        
                    }
                } 
            ?>
            <div id="conversation" style="width: 300px; height: 500px; overflow-y: auto;" data-friend-email="" data-friend-id="">
                <?php
                    // Récupérer les messages de la conversation avec un ami entre l'adresse connectée et l'adresse de l'ami
                    $friend_email = isset($_POST['friend_email']) ? $_POST['friend_email'] : "$friend_email";
                    $friend_id = isset($_POST['friend_id']) ? $_POST['friend_id'] : "$friend_id";
                    $sql = "SELECT * FROM Messages 
                            WHERE Convers_ID = (
                                SELECT Convers_ID FROM Messagerie 
                                WHERE       (ID1 = '$id' AND ID2 = '$friend_id')
                                    OR      (ID1 = '$friend_id' AND ID2 = '$id'))
                            ORDER BY MSG_ID DESC";
                    $result = mysqli_query($db_handle, $sql);
                    
                    //!get the number of messages in the conversation
                    $msg_count = mysqli_num_rows($result);
                    
                    if (mysqli_num_rows($result) != 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            $sender_id = $row['Sender_ID'];
                            if ($sender_id == $id) {
                                $sender_mail = $email;
                            } else if ($sender_id == $friend_id) {
                                $sender_mail = $friend_email;
                            }
                            $content = $row['Content'];
                            $timestamp = $row['Timestamp'];
                            if ($sender_id == $id) {
                                echo "<div class='alert alert-success' role='alert'>$sender_mail : $content ($timestamp)</div>";
                            } else if ($sender_id == $friend_id) {
                                echo "<div class='alert alert-warning' role='alert'>$sender_mail : $content ($timestamp)</div>";
                            }
                        }
                    }else{
                        echo "<div class='alert alert-warning' role='alert'>Pas de messages</div>";
                    }
                ?>
            </div>
            <form id="messageForm" method="post" action="">
            //! Envoyer un message à l'ami
            <input type="hidden" name="friend_email" value="<?php echo $friend_email; ?>">
            <input type="hidden" name="friend_id" value="<?php echo $friend_id; ?>">
            <input type="text" name="message" class="form-control" placeholder="Message" required>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
            <?php
                //! Envoyer le message
                if (isset($_POST['message'])) {
                    $message = mysqli_real_escape_string($db_handle, $_POST['message']);
                    $sql = "INSERT INTO Messages (Sender_ID, Convers_ID, Content) VALUES ('$id', (SELECT Convers_ID FROM Messagerie WHERE (ID1 = '$id' AND ID2 = '$friend_id') OR (ID1 = '$friend_id' AND ID2 = '$id')), '$message')";
                    $result = mysqli_query($db_handle, $sql);
                    if (!$result) {
                        echo "Erreur: $sql <br>" . mysqli_error($db_handle);
                    } else {
                        echo '<div class="alert alert-success" role="alert">Message envoyé</div>';
                        header("Location: messagerie.php");
                        ob_end_flush(); 
                        exit;
                    }
                }
            ?>
        </main>
    </body>
    <script> 
        //! Vérifier les nouveaux messages
        //? On regarde toute les secondes si il y a de nouveaux messages en appelant la fonction check_if_new_msg_in_conv
        //? Si le nombre est différent de celui qu'on avait avant, on recharge la page
        var currentMessageCount = <?php echo mysqli_num_rows($result); ?>; // Le nombre actuel de messages
        setInterval(function() {
            $.ajax({
                url: 'functions.php', // L'URL de votre fichier PHP
                type: 'post',
                data: {
                    'check_new_msg': true, // Une variable pour indiquer que vous voulez vérifier les nouveaux messages
                    'id': <?php echo $id; ?>, // L'ID de l'utilisateur actuel
                    'friend_id': <?php echo $friend_id; ?> // L'ID de l'ami
                },
                success: function(response) {
                    var newMessageCount = parseInt(response);
                    if (newMessageCount > currentMessageCount) {
                        location.reload(); // Recharge la page si de nouveaux messages ont été ajoutés
                    }
                }
            });
        }, 1000); // Vérifie les nouveaux messages toutes les 5 secondes
    </script>
</html>
    