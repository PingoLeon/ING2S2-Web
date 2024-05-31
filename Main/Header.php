<!DOCTYPE html>
<html lang="en">
    
<?php
    include '../Auth/functions.php';
    // Renvoyer l'utilisateur à la page de connexion s'il n'est pas connecté, sinon récupérer l'id et l'email
    list($user_id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
    logout_button_POST();

    // Fetch user information
    $sql = "SELECT Nom, Prenom, Photo FROM utilisateur WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    $user = mysqli_fetch_assoc($result);
    $username = $user['Nom'] . ' ' . $user['Prenom'];

    // Fetch company information
    $sql = "SELECT * FROM enterprise
            JOIN utilisateur ON utilisateur.entreprise_ID = enterprise.enterprise_ID
            WHERE utilisateur.User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    $entreprise_info = mysqli_fetch_assoc($result);

    $Lien_Entreprise_Utilisateur = $entreprise_info !== NULL;
    if ($Lien_Entreprise_Utilisateur) {
        $entreprise_name = $entreprise_info['Nom_Entreprise'];
        $entreprise_logo = $entreprise_info['Logo'];
        $entreprise_logo = '../Profil_entreprises/logos/' . $entreprise_logo;
    }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Header</title>
    
    <link rel="stylesheet" type="text/css" href="../Main/Header.css">
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
                    <a href="../Main/accueil_main.php">
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
                    <div onclick="toggleMenu(event, 'userSubMenu')">
                        <i class="fa-solid fa-user"></i>
                        <p>Vous</p>
                    </div>
                    <div class="sub-menu-wrap" id="userSubMenu">
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
                                <form id="logoutForm" method="post" style="display: inline;">
                                    <button type="submit" name="logout" style="background: none; border: none; color: inherit; font: inherit; cursor: pointer; outline: inherit; display: flex; align-items: center; width: 100%;">
                                        <i class="fa-solid fa-circle-xmark" style="margin-right: 10px;"></i>
                                        <p style="margin-left: 40%; flex-grow: 1;">Deconnexion</p>
                                        <span style="margin-left: 40%;">></span>
                                    </button>
                                </form>
                            </a>
                        </div>
                    </div>
                </div>
                <?php if ($Lien_Entreprise_Utilisateur): ?>
                <div class="nav-menus">
                    <div onclick="toggleMenu(event, 'businessSubMenu')">
                        <i class="fa-solid fa-border-none"></i>
                        <p>For Business <i class="fa-solid fa-caret-down"></i></p>
                    </div>
                    <div class="sub-menu-wrap" id="businessSubMenu">
                        <div class="sub-menu">
                            <div class="user-info">
                                <?php
                                    echo '<img src="' . $entreprise_logo . '" alt="Logo de l\'entreprise">';
                                    echo '<h2>' . $entreprise_name . '</h2>';
                                ?>
                            </div>
                            <hr>
                            <a href="#" class="sub-menu-link">
                                <i class="fa-solid fa-link"></i>
                                <p>Business Link</p>
                                <span>></span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php elseif (!$Lien_Entreprise_Utilisateur): ?>
                <div class="nav-menus">
                    <a href="#">
                        <i class="fa-solid fa-border-none"></i>
                        <p>For Business</p>
                    </a>
                </div>
                <?php endif; ?>
                <a class="sponsor" href=""><b>Sponsorisez notre<br>futur EngineerIN+ !!<b></a>
            </div>
        </nav>
    </header>

    <script>
        function toggleMenu(event, menuId) {
            event.stopPropagation();
            document.querySelectorAll('.sub-menu-wrap').forEach(menu => {
                if (menu.id !== menuId) {
                    menu.classList.remove('open-menu');
                }
            });
            document.getElementById(menuId).classList.toggle('open-menu');
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.nav-menus div')) {
                document.querySelectorAll('.sub-menu-wrap').forEach(menu => {
                    menu.classList.remove('open-menu');
                });
            }
        });
    </script>
</body>

</html>
