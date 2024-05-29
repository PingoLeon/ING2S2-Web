<?php
    session_start();
    
    //! POUR FELIX : 
    $page_to_send_to_once_connected = "../Main/accueil_main.php"; //? Page vers laquelle on redirige l'utilisateur une fois connecté
    
    function connect_to_db() {
        $database = "ECEin";  
        $db_handle = mysqli_connect('localhost', 'root', '' );  
        $db_found = mysqli_select_db($db_handle, $database);
        return $db_handle;
    }
    
    function update_token_of_cookie($db_handle){
        if (isset($_COOKIE['token'])) {
            $token2 = bin2hex(random_bytes(8));
            $token = $_COOKIE['token']; //! A ce stade si le cookie existe, le token existe forcément
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
    
    function set_distinct_cookie($token){
        $cookieSet = setcookie("token", $token, [
            'expires' => time() + 86400,
            'path' => '/',
            'domain' => $_SERVER['localhost'],
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict',
            ]); 
        return $cookieSet;
    }
    
    function cookie_or_session(){
        $token = "";
        if (isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
        } elseif (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
        }
        return $token;
    }
    
    function check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle($type = "normal"){
        //! Si l'utilisateur est déjà connecté, on le redirige vers la page d'accueil
        //!Sinon, on l'envoie vers la page de connexion
        //! Mais si l'utilisateur est déjà sur la page de connexion, on le laisse dessus
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
                    header('Location: index.php');
                }
            }else{//! Le token n'existe pas dans la BDD -> pas connecté
                if ($type == "normal") { //? On redirige l'utilisateur vers la page de connexion
                    header('Location: connexion.php');
                    exit;
                }else if ($type == "connexion"){ //? On renvoie juste ce qu'il faut, on ne redirige pas l'utilisateur car il est déjà sur la page de connexion
                    return array($id, $email, $db_handle);
                }
            }
        }else{ //! Le token n'existe pas -> pas connecté
            if ($type == "normal") { //? On redirige l'utilisateur vers la page de connexion
                header('Location: connexion.php');
                exit;
            }else if ($type == "connexion"){ //? On renvoie juste ce qu'il faut, on ne redirige pas l'utilisateur car il est déjà sur la page de connexion
                return array($id, $email, $db_handle);
            }
        }
    }
    
    function logout_button_POST(){
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
    }
    

?>