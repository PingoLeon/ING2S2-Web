<?php
    session_start();
    
    //? Page vers laquelle on redirige l'utilisateur une fois connecté
    $page_to_send_to_once_connected = "../Main/accueil_main.php"; 
    
    //! Fonction pour se connecter à la BDD ECEin
    function connect_to_db() {
        $database = "ECEin";  
        $db_handle = mysqli_connect('localhost', 'root', '' );  
        $db_found = mysqli_select_db($db_handle, $database);
        return $db_handle;
    }
    
    //! Fonction pour générer un token et un nouveau cookie
    function update_token_of_cookie($db_handle){
        if (isset($_COOKIE['token'])) {
            $token2 = bin2hex(random_bytes(8));
            $token = $_COOKIE['token']; //! A ce stade si le cookie existe, le token existe forcément, donc pas besoin de rechecker si c'est vide
            $sql = "UPDATE Utilisateur SET Token = '$token2' WHERE Token = '$token'";
            $result_cookie = mysqli_query($db_handle, $sql);
            if (!$result_cookie) {
                echo "Erreur: $sql <br>" . mysqli_error($db_handle);
            }else{
                echo '<div class="alert alert-warning" role="alert">Nouveau cookie généré</div>';
                echo "<div class='alert alert-info' role='alert'>Token 1 : $token <br>Token 2 : $token2</div>";
                $cookieSet = set_distinct_cookie($token2);   
            }
        }
    }
    
    //! Fonction pour générer un cookie
    function set_distinct_cookie($token){
        $cookieSet = setcookie("token", $token, [ //! Le site du zéro en réf pour les options du cookie
            'expires' => time() + 86400,
            'path' => '/',
            'domain' => 'localhost',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict',
            ]); 
        return $cookieSet;
    }
    
    //! Fonction pour vérifier si l'utilisateur possède un cookie ou une session
    function cookie_or_session(){
        $token = "";
        if (isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
        } elseif (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
        }
        return $token;
    }

    //! Fonction pour récupérer les offres d'emploi
    function get_job_offers_by_company($db_handle, $user_id) {
        $query = "SELECT * FROM offre_emploi WHERE enterprise_id = (SELECT entreprise_id FROM utilisateur WHERE user_id = ?)";
        $stmt = $db_handle->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //! Fonction pour vérifier si l'utilisateur est connecté et récupérer son ID et son email
    function check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle($type = "normal", $page_to_send_to_once_connected = "../Main/accueil_main.php"){
        //? Si l'utilisateur est déjà connecté, on le redirige vers la page d'accueil
        //? Sinon, on l'envoie vers la page de connexion
        //? Mais si l'utilisateur est déjà sur la page de connexion, on le laisse dessus
        //? Paramètres $type et $page_to_send_to_once_connected sont optionnels pour ajuster le comportement de la fonction et assurer sa réutilisabilité
        $token = cookie_or_session(); //? Fonction pour récupérer le token si il existe
        $id = $email = $db_handle = "";
        if (!empty($token)) {  //! Le token existe -> potentiellement connecté
            $db_handle = connect_to_db(); //? Connexion à la BDD ECEin
            $sql = "SELECT * FROM Utilisateur WHERE Token = '$token'";
            $result = mysqli_query($db_handle, $sql);
            if (mysqli_num_rows($result) > 0) { //!Le token existe dans la BDD -> connexion confirmée
                $row = mysqli_fetch_assoc($result);
                $email = $row['Mail'];
                $id = $row['User_ID'];
                if ($type == "normal") { //!Il est connecté et on le laisse sur la page
                    return array($id, $email, $db_handle);
                }else if ($type == "connexion"){ //! Il est connecté et on le redirige vers la page d'accueil       
                    header("Location: $page_to_send_to_once_connected");
                }
            }else{//! Le token n'existe pas dans la BDD -> pas connecté
                if ($type == "normal") { //? On redirige l'utilisateur vers la page de connexion
                    header('Location: /ING2S2-WEB/Auth/');
                    exit;
                }else if ($type == "connexion"){ //? On renvoie juste ce qu'il faut, on ne redirige pas l'utilisateur car il est déjà sur la page de connexion
                    return array($id, $email, $db_handle);
                }
            }
        }else{ //! Le token n'existe pas -> pas connecté
            if ($type == "normal") { //? On redirige l'utilisateur vers la page de connexion
                header('Location: /ING2S2-WEB/Auth/');
                exit;
            }else if ($type == "connexion"){ //? On renvoie juste ce qu'il faut, on ne redirige pas l'utilisateur car il est déjà sur la page de connexion
                return array($id, $email, $db_handle);
            }
        }
    }
    
    //! Fonction pour gérer l'action du bouton de déconnexion
    function logout_button_POST(){
        if (isset($_POST['logout'])) {
            //! On Détruit la session
            session_unset();
            session_destroy();
            
            //! On Supprime le cookie et en crée un nouveau de temps négatif, invalide
            if (isset($_COOKIE['token'])) {
                unset($_COOKIE['token']);
                setcookie('token', '', time() - 3600, '/');
            }
            
            //! On Redirige vers la page d'inscription
            header('Location: /ING2S2-WEB/Auth/');
            exit;
        }
    }
    
    //! Fonction pour compter le nombre de messages dans la conversation à partir de l'ID de l'utilisateur et de l'ID de son ami (Utilisée dans le chat)
    function check_if_new_msg_in_conv($db_handle, $id, $friend_id, $current_message_count){ 
        //Compter le nombre de messages dans la conversation
        $sql = "SELECT COUNT(*) AS nb_msg FROM Messages 
                WHERE Convers_ID = (
                    SELECT Convers_ID FROM Messagerie 
                    WHERE       (ID1 = '$id' AND ID2 = '$friend_id')
                        OR      (ID1 = '$friend_id' AND ID2 = '$id'))";
        $result = mysqli_query($db_handle, $sql);
        $row = mysqli_fetch_assoc($result);
        $nb_msg = $row['nb_msg'];
        if ($nb_msg != $current_message_count) {
            $_SESSION['current_conversation'] = $friend_id;
            echo "reload";
            exit;
        }
        return $nb_msg;
    }

    //! Fonction pour récupérer les messages de la conversation à partir de l'ID de l'utilisateur et de l'ID de son ami (Utilisée dans le chat)
    //? Sert à updater ou non le chat en fonction du nombre de messages chargés et ceux dans la BDD
if (isset($_POST['check_new_msg'])) {
    $id = $_POST['id'];
    $friend_id = $_POST['friend_id'];
    $current_message_count = $_POST['current_message_count'];
    $db_handle = connect_to_db();
    echo check_if_new_msg_in_conv($db_handle, $id, $friend_id, $current_message_count);
    exit;
}   

    //! Fonction utilisée pour exécuter une requête SQL et renvoyer les données en JSON pour les requêtes AJAX
    function fetch_data($user_id, $db_handle){
        if (isset($_GET['sql']) && isset($_GET['id'])) {
            $sql = $_GET['sql'];
            $id = $_GET['id'];
        
            // Replace placeholder with actual ID
            $sql = str_replace(':id', $id, $sql);
        
            $result = mysqli_query($db_handle, $sql);
        
            if ($result) {
                $data = mysqli_fetch_assoc($result);
                echo json_encode($data);
            } else {
                echo json_encode(['error' => 'Query failed']);
            }
        }
    }
    

?>