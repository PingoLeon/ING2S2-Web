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
    <body class="d-flex flex-column">
        <div class="d-flex flex-row h-100">
            <!--Barre latérale -->
            <div id="barre-laterale" class="p-3 flex-shrink-0">
                <!-- Onglet personnel -->
                <div class="d-flex flex-row align-items-center mb-3">
                    <img src="<?php
                        $sql = "SELECT Photo, Nom, Prenom FROM Utilisateur WHERE User_ID = '$id'";
                        $result = mysqli_query($db_handle, $sql);
                        if (mysqli_num_rows($result) != 0) {
                            $row = mysqli_fetch_assoc($result);
                            echo $row['Photo'];
                            $nom = $row['Nom'];
                            $prenom = $row['Prenom'];
                        }
                    ?>" alt="Avatar" class="rounded-circle" style="border: 1px solid #000; border-color: black;" width="50" height="50">                
                    <div class="ms-3">
                        <div class="fw-bold text-black"><?php echo "$nom $prenom"; ?></div>
                        <div class="text-muted" style="color: #24bd5d !important;">En ligne</div>
                    </div>
                </div>
                <!-- Conversations -->
                <div class="fw-bold text-black mb-2 overflow-auto">CONVERSATIONS</div>
                <?php                        
                    //! Fetch tous les mails qui ont une conversation avec la personne connectée
                    $sql = "SELECT User_ID, Mail, Photo, Nom, Prenom FROM Utilisateur WHERE User_ID IN (SELECT ID1 FROM Messagerie WHERE ID2 = '$id') OR User_ID IN (SELECT ID2 FROM Messagerie WHERE ID1 = '$id')";
                    
                    $result = mysqli_query($db_handle, $sql);
                    if (mysqli_num_rows($result) != 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            $friend_email = $row['Mail'];
                            $friend_id = $row['User_ID'];
                            $Photo = $row['Photo'];
                            $Nom = $row['Nom'];
                            $Prenom = $row['Prenom'];
                            echo "<form method='post' action=''>";
                            echo "<input type='hidden' name='friend_email' value='$friend_email'>";
                            echo "<input type='hidden' name='friend_id' value='$friend_id'>";
                            echo "<button type='submit' class='btn btn-whatsapp'>";
                            echo "<img src='".$Photo."' alt='Avatar' class='rounded-circle' style='border: 1px solid #000; border-color: black;' width='50' height='50'>";
                            echo "$Prenom $Nom</button>";
                            echo "</form><br>";                        
                        }
                    } 
                ?>
                
                <!-- Déconnexion -->
                <form method="post">
                    <button id= "disconnect-messagerie" class="btn btn-danger w-100 py-2" type="submit" name="logout">Déconnexion</button>
                    <?php
                        logout_button_POST();
                    ?>
                </form>
            </div>
            
            <!-- Conteneur de messages -->
            <div id="box-conversation" class="d-flex flex-column flex-grow-1 p-3 bg-light">
                <!-- Conteneur d'informations sur l'ami -->
                <div class="d-flex flex-column flex-grow-1 border rounded p-3">
                    <div class="d-flex flex-row align-items-center mb-3">
                        <img src="
                        <?php
                            $friend_email = isset($_POST['friend_email']) ? $_POST['friend_email'] : "$friend_email";
                            $friend_id = isset($_POST['friend_id']) ? $_POST['friend_id'] : "$friend_id";
                            
                            $sql = "SELECT Photo, Nom, Prenom FROM Utilisateur WHERE User_ID = '$friend_id'";
                            $result = mysqli_query($db_handle, $sql);
                            if (mysqli_num_rows($result) != 0) {
                                $row = mysqli_fetch_assoc($result);
                                echo $row['Photo'];
                                $friend_nom = $row['Nom'];
                                $friend_prenom = $row['Prenom'];
                            }
                        ?>
                        " alt="Avatar" class="rounded-circle" style="border: 1px solid #000; border-color: black;" width="50" height="50">
                        <div class="ms-3">
                            <!-- Nom de l'ami -->
                            <div class="fw-bold"><?php echo "$friend_nom $friend_prenom"; ?></div>
                            <!-- Statut de l'ami -->
                            <div class="text-muted">
                                <?php
                                    $sql = "SELECT Position, Fin, Enterprise_ID FROM Experience WHERE User_ID = '$friend_id' ORDER BY Debut";
                                    $result = mysqli_query($db_handle, $sql);
                                    if (mysqli_num_rows($result) != 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        $date = date("Y-m-d");
                                        $Enterprise_ID = $row['Enterprise_ID'];
                                        if ($date > $row['Fin']) {
                                            echo "Pas d'expérience actuelle";
                                        } else {
                                            echo $row['Position'];
                                            $sql = "SELECT Nom_Entreprise FROM Enterprise WHERE Enterprise_ID = '$Enterprise_ID'";
                                            $result = mysqli_query($db_handle, $sql);
                                            if (mysqli_num_rows($result) != 0) {
                                                $row = mysqli_fetch_assoc($result);
                                                echo " chez ";
                                                echo $row['Nom_Entreprise'];
                                            }
                                        } 
                                    }else{
                                        echo "Pas d'expérience actuelle";
                                    }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Conteneur de messages 2-->
                <div id="conversation" class="d-flex flex-column-reverse flex-grow-1 overflow-auto p-3" data-friend-email="<?php echo $friend_email; ?>" data-friend-id="<?php echo $friend_id; ?>">
                        <?php
                        if (isset($_SESSION['current_conversation'])) { //? Si une conversation est déjà en cours (un message a été envoyé)
                            $friend_id = $_SESSION['current_conversation'];
                            unset($_SESSION['current_conversation']);
                        }
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
                                    echo "<div class='message-right'>$content</div>";
                                } else if ($sender_id == $friend_id) {
                                    echo "<div class='message-left'>$content</div>";
                                }
                            }
                        }else{
                            echo "<div class='alert alert-warning' role='alert'>Pas de messages</div>";
                        }
                    ?>
                </div>
                <!-- Formulaire d'envoi de messages -->
                <form id="messageForm" class="d-flex flex-row align-items-center border-top p-3 mt-auto" method="post" action="">
                    <input type="hidden" name="friend_email" value="<?php echo $friend_email; ?>">
                    <input type="hidden" name="friend_id" value="<?php echo $friend_id; ?>">
                    <input type="text" name="message" class="form-control flex-grow-1 me-2" placeholder="Écrire un message" autocomplete="off" required>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                        </svg>
                    </button>
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
                            $_SESSION['current_conversation'] = $friend_id;
                            header("Location: messagerie.php");
                            ob_end_flush(); 
                            exit;
                        }
                    }
                ?>
            </div>      
        </div>
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
    