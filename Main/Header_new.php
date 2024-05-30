<!DOCTYPE html>
<html lang="en">
    
<?php
    include '../Auth/functions.php';
    //! Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
    list($user_id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
    logout_button_POST();

    $sql = "SELECT Nom, Prenom, Photo FROM utilisateur WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    $user = mysqli_fetch_assoc($result);
    $username = $user['Nom'] . ' ' . $user['Prenom'];
?>



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Header</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        body {
            width: 100%;
            height: 100vh;
            background: rgb(247, 242, 242);
        }

        header {
            height: 80px;
            width: 100%;
            background: #fff;
            box-shadow: 0px 2px 5px 5px rgba(204, 202, 202, 0.5);
            display: flex;
            align-items: center;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 92%;
            margin: 0 auto;
            position: relative;
        }

        .nav-left .logo img {
            width: 220px;
            height: auto;
            margin-left: -10px;
        }

        .nav-right {
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex: 1;
            margin-left: 100px;
        }

        .nav-right .nav-menus {
            text-align: center;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0 15px;
            position: relative;
        }

        .nav-right .nav-menus i {
            font-size: 25px;
            color: #706e6e;
            margin-bottom: 3px;
        }

        .nav-right .nav-menus p {
            font-size: 16px;
            color: #706e6e;
            margin: 0;
        }

        .nav-right .nav-menus:nth-child(7) {
            border-left: 1px solid #ccc;
            padding-left: 15px;
        }

        .sponsor a {
            font-size: 16px;
            color: rgb(185, 122, 5);
            margin-right: -60px;
            text-decoration: none;
        }

        .nav-right .nav-menus:hover::after {
            content: '';
            width: 100%;
            height: 2px;
            background: #000;
            position: absolute;
            bottom: -10px;
            left: 0;
        }

        .sub-menu-wrap {
            position: absolute;
            top: 120%;
            right: -30%;
            width: 320px;
            max-height: 0px;
            overflow: hidden;
            transition: max-height 0.5s;
            z-index: 999;
        }

        .sub-menu-wrap.open-menu {
            max-height: 400px;
        }

        .sub-menu {
            background: #fff;
            padding: 20px;
            margin: 10px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info h2 {
            font-weight: 500;
        }

        .user-info img {
            width: 60px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .sub-menu hr {
            border: 0;
            height: 1px;
            width: 100%;
            background: #ccc;
            margin: 15px 0 10px;
        }

        .sub-menu-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #525252;
            margin: 12px 0;
        }

        .sub-menu-link p {
            width: 100%;
        }

        .sub-menu-link img {
            width: 50px;
            background:#e5e5e5;
            border-radius: 50%;
            padding: 8px;
            margin-right: 15px;
        }

        .sub-menu-link span {
            font-size: 22px;
            transition: transform 0.5s;
        }

        .sub-menu-link:hover span {
            transform: translateX(5px);
        }

        .sub-menu-link:hover p {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="nav-left">
                <div class="logo">
                    <img src="../Photos/EngineerIN_logo.png" alt="ECE Paris">
                </div>
            </div>
            <div class="nav-right">
                <div class="nav-menus">
                    <a href="accueil_main.php">
                        <i class="fa-solid fa-house"></i>
                        <p>Home</p>
                    </a>
                </div>
                <div class="nav-menus">
                    <a href="../MonReseau/MonReseau.html">
                        <i class="fa-solid fa-users"></i>
                        <p>Mon Reseau</p>
                    </a>
                </div>
                <div class="nav-menus">
                    <a href="../Emplois/Emplois.html">
                        <i class="fa-solid fa-briefcase"></i>
                        <p>Emplois</p>
                    </a>
                </div>
                <div class="nav-menus">
                    <a href="../Messagerie/index.php">
                        <i class="fa-solid fa-message"></i>
                        <p>Messagerie</p>
                    </a>
                </div>
                <div class="nav-menus">
                    <a href="../Notifications/Notifications.html">
                        <i class="fa-solid fa-bell"></i>
                        <p>Notification</p>
                    </a>
                </div>
                <div class="nav-menus">
                    <div onclick="toggleMenu(event)">
                        <i class="fa-solid fa-user"></i>
                        <p>Vous</p>
                    </div>
                    <div class="sub-menu-wrap" id="subMenu">
                        <div class="sub-menu">
                            <div class="user-info">
                                <?php
                                    echo '<img src="' . $user['Photo'] . '" alt="Photo de profil">';
                                    echo '<h2>' . $username . '</h2>';
                                ?>
                            </div>
                            <hr>
                            <a href="profile_main.php" class="sub-menu-link">
                                <i class="fa-solid fa-user"></i>
                                <p>Mon Profil</p>
                                <span>></span>
                            </a>
                            <a href="#" class="sub-menu-link">
                                <i class="fa-solid fa-gear"></i>
                                <p>Parametres</p>
                                <span>></span>
                            </a>
                            <a href="#" class="sub-menu-link">
                                <i class="fa-solid fa-circle-info"></i>
                                <p>Support et Aide</p>
                                <span>></span>
                            </a>
                            <a href="#" class="sub-menu-link">
                                <i class="fa-solid fa-circle-xmark"></i>
                                <p>Deconnexion</p>
                                <span>></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="nav-menus">
                    <i class="fa-solid fa-border-none"></i>
                    <p>For Business <i class="fa-solid fa-caret-down"></i></p>
                </div>
                <a class="sponsor" href=""><b>Sponsorisez notre<br>futur EngineerIN+ !!<b></a>
            </div>
        </nav>
    </header>

    <script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu(event) {
            event.stopPropagation();
            subMenu.classList.toggle("open-menu");
        }

        document.addEventListener('click', function(event) {
            if (!subMenu.contains(event.target) && !event.target.closest('.nav-menus div')) {
                subMenu.classList.remove('open-menu');
            }
        });
    </script>
</body>

</html>
