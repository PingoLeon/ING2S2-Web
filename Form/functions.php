<?php
    session_start();
    
    function connect_to_db() {
        $database = "ECEin";  
        $db_handle = mysqli_connect('localhost', 'root', '' );  
        $db_found = mysqli_select_db($db_handle, $database);
        return $db_handle;
    }
    
    function set_distinct_cookie($token){
        $cookieSet = setcookie("token", $token, [
            'expires' => time() + 86400,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
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