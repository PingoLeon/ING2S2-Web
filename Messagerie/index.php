<?php
    ob_start();
    include '../Auth/functions.php';
    
    //! Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
    list($id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
    
    //! Checker si l'utilisateur a appuyé sur le bouton de déconnexion
    logout_button_POST();
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EngineerIN - Messagerie</title>
    
    <link rel="cano nical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="theme-color" content="#712cf9">
    <link href="style.css" rel="stylesheet">
    
    <!-- Import d'Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    </head>
    <!-- Page principale de la messagerie -->
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
                
                <!-- Sélection des Conversations -->
                <div class="fw-bold text-black mb-2">CONVERSATIONS</div>
                <div class="box-selection-action">
                    <div id="select-conversation" class="d-flex flex-column overflow-auto">
                    <?php                        
                        //! Fetch tous les mails qui ont une conversation avec la personne connectée
                        $sql = "SELECT User_ID, Photo, Nom, Prenom FROM Utilisateur WHERE User_ID IN (SELECT ID1 FROM Messagerie WHERE ID2 = '$id') OR User_ID IN (SELECT ID2 FROM Messagerie WHERE ID1 = '$id')";
                        $result = mysqli_query($db_handle, $sql);
                        $no_relationship = false;
                        if (mysqli_num_rows($result) != 0) {
                            while($row = mysqli_fetch_assoc($result)){
                                $friend_id = $row['User_ID'];
                                $friend_photo = $row['Photo'];
                                $friend_name = $row['Nom'];
                                $friend_first_name = $row['Prenom'];
                                echo "<form method='post'>";
                                echo "<input type='hidden' name='friend_id' value='$friend_id'>";
                                echo "<input type='hidden' name='friend_photo' value='$friend_photo'>";
                                echo "<input type='hidden' name='friend_nom' value='$friend_name'>";
                                echo "<input type='hidden' name='friend_prenom' value='$friend_first_name'>";
                                echo "<button type='submit' class='btn btn-whatsapp'>";
                                echo "<img src='".$friend_photo."' alt='Avatar' class='rounded-circle' style='border: 1px solid #000; border-color: black;' width='50' height='50'>";
                                echo "$friend_first_name $friend_name</button>";
                                echo "</form><br>";                        
                            }
                        }else{
                            echo "  <div style='height: 100vh; display: flex; align-items: center; justify-content: center;'>
                                        <div class='alert alert-danger' role='alert'>Aucune conversation :/</div>
                                    </div>
                                ";
                            $no_relationship = true;
                            $friend_id = '';
                        }
                    
                    ?>
                    </div>
                    <!-- Déconnexion et Retour au Menu -->
                    <div id="action-buttons-messagerie">
                        <form method="post">
                            <button class="btn btn-info w-100 py-2" style="margin-bottom: 6px" type="submit" name="menu">Retour au Menu</button>
                            <?php
                                if (isset($_POST['menu'])) {
                                    header('Location: ../Main/accueil_main.php');
                                    ob_end_flush(); 
                                    exit;
                                }
                            ?>
                        </form>
                        <form method="post">
                            <button class="btn btn-danger w-100 py-2" type="submit" name="logout">Déconnexion</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Conteneur de messages -->
            <div id="box-conversation" class="d-flex flex-column flex-grow-1 p-3 bg-light">
                <!-- Conteneur d'informations sur l'ami -->
                <div class="d-flex flex-column flex-grow-1 border rounded p-3">
                    <div class="d-flex flex-row align-items-center mb-3">
                        <img src="
                        <?php
                            $friend_id = isset($_POST['friend_id']) ? $_POST['friend_id'] : "$friend_id";
                            if ($no_relationship){
                                echo "https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png";
                            }else{
                                if (isset($_SESSION['current_conversation'])) { //? Si une conversation est déjà en cours (un message a été envoyé)
                                    $friend_id = $_SESSION['current_conversation'];
                                    unset($_SESSION['current_conversation']);
                                }
                                $sql = "SELECT Photo, Nom, Prenom FROM Utilisateur WHERE User_ID = '$friend_id'";
                                $result = mysqli_query($db_handle, $sql);
                                $friend_first_name = "";
                                $friend_name = "";
                                if (mysqli_num_rows($result) != 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['Photo'];
                                    $friend_name = $row['Nom'];
                                    $friend_first_name = $row['Prenom'];
                                }
                            }
                            
                            
                        ?>
                        " alt="Avatar" class="rounded-circle" style="border: 1px solid #000; border-color: black;" width="50" height="50">
                        <div class="ms-3">
                            <!-- Nom de l'ami -->
                            <div class="fw-bold">
                                <?php 
                                    if ($friend_id === ''){
                                        $friend_first_name = "";
                                        $friend_name = "";
                                    }
                                    echo "$friend_first_name $friend_name"; 
                                ?>
                            </div>
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
                                            if (!$no_relationship){
                                                echo "Pas d'expérience actuelle";
                                            }else{
                                                echo "";
                                            }
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
                                        if (!$no_relationship){
                                            echo "Pas d'expérience actuelle";
                                        }else{
                                            echo "";
                                        }
                                    }
                                ?>      
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Conteneur de messages -->
                <div id="conversation" class="d-flex flex-column-reverse flex-grow-1 overflow-auto p-3">
                    <?php
                        $sql = "SELECT Sender_ID, Content, MSG_ID FROM Messages 
                                WHERE Convers_ID = (
                                    SELECT Convers_ID FROM Messagerie 
                                    WHERE       (ID1 = '$id' AND ID2 = '$friend_id')
                                        OR      (ID1 = '$friend_id' AND ID2 = '$id'))
                                ORDER BY MSG_ID DESC";
                        $result = mysqli_query($db_handle, $sql);
                        
                        //!Obtenir le nombre de messages dans la conversation
                        $msg_count = mysqli_num_rows($result);
                        if ($msg_count != 0) {
                            echo $msg_count;
                            echo "<br>";
                            echo "friend_id: $friend_id<br>";
                            while($row = mysqli_fetch_assoc($result)){
                                $sender_id = $row['Sender_ID'];
                                $content = $row['Content'];
                                $message_id = $row['MSG_ID'];
                                if ($sender_id == $id) {
                                    echo "
                                        <div class='message-container-right'>
                                            <form method='post'>
                                                <input type='hidden' name='delete_message' value='$message_id'>
                                                <input type='hidden' name='friend_id' value='$friend_id'>
                                                    <button class='button-delete-msg' type='submit'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                                            <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
                                                            <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            <div class='message-right'>
                                                $content 
                                            </div>
                                        </div>  
                                    "; 
                                } else if ($sender_id == $friend_id) {
                                    echo "
                                    <div class='message-container-left'>
                                        <div class='message-left'>
                                            $content 
                                        </div>
                                    </div>  
                                    ";            
                                }
                            }
                        }else{
                            echo "  <div style='height: 100vh; display: flex; align-items: center; justify-content: center;'>
                                        <div class='alert alert-danger' role='alert'>Aucun message :/</div>
                                    </div>
                                ";
                        }
                    ?>
                </div>
                <!-- Formulaire d'envoi de messages -->
                <form id="messageForm" class="d-flex flex-row align-items-center border-top p-3 mt-auto" method="post">
                    <input type="hidden" name="friend_id" value="<?php echo $friend_id; ?>">
                    <input id="MessageBar" type="text" name="message" class="form-control flex-grow-1 me-2" placeholder="Écrire un message" autocomplete="off" required>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                        </svg>
                    </button>
                </form>    
                <?php
                    //! Supprimer un message
                    if (isset($_POST['delete_message'])) {
                        $friend_id = mysqli_real_escape_string($db_handle, $_POST['friend_id']);
                        $message_id = mysqli_real_escape_string($db_handle, $_POST['delete_message']);
                        $sql = "DELETE FROM Messages WHERE MSG_ID = '$message_id'";
                        $result = mysqli_query($db_handle, $sql);
                        if (!$result) {
                            echo "Erreur: $sql <br>" . mysqli_error($db_handle);
                        } else {
                            $_SESSION['current_conversation'] = $friend_id;
                            header("Location: ../Messagerie/");
                            ob_end_flush(); 
                            exit;
                        }
                    }
                    
                    //! Envoyer le message
                    if (isset($_POST['message'])) {
                        $friend_id = mysqli_real_escape_string($db_handle, $_POST['friend_id']);
                        $message = mysqli_real_escape_string($db_handle, $_POST['message']);
                        $sql = "INSERT INTO Messages (Sender_ID, Convers_ID, Content) VALUES ('$id', (SELECT Convers_ID FROM Messagerie WHERE (ID1 = '$id' AND ID2 = '$friend_id') OR (ID1 = '$friend_id' AND ID2 = '$id')), '$message')";
                        $result = mysqli_query($db_handle, $sql);
                        if (!$result) {
                            echo "Erreur: $sql <br>" . mysqli_error($db_handle);
                        } else {
                            $_SESSION['current_conversation'] = $friend_id;
                            header("Location: ../Messagerie/");
                            ob_end_flush(); 
                            exit;
                        }
                    }
                ?>
            </div>      
        </div>
    </body>
    <script>
        //! Fonctions JS pour gérer certaines parties dynamiques de la page
        //? Focus sur la barre de message et récupération du contenu précédent
        window.onload = function() {
            var messageBar = document.getElementById("MessageBar");
            messageBar.value = localStorage.getItem("messageBarContent") || "";
            messageBar.focus();
        };
        
        //? Rechargement de la page si un nouveau message est reçu ou supprimé
        setInterval(function() {
            $.ajax({
                url: '../Auth/functions.php',
                type: 'post',
                data: {
                    'check_new_msg': true,
                    'id': <?php echo $id; ?>,
                    'friend_id': <?php echo $friend_id; ?>,
                    'current_message_count': <?php echo $msg_count; ?>
                },
                success: function(response) {
                    console.log("Response: " + response);
                    if(response.trim() === "reload") {
                        //Envoi du contenu de la barre de message dans le localStorage pour le récupérer après le rechargement et reload
                        localStorage.setItem("messageBarContent", document.getElementById("MessageBar").value);
                        location.reload();
                    }
                }
            });
        }, 1000); //Load les messages toute les secondes
    </script>
</html>
    