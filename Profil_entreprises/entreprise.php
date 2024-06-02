<?php ob_start(); include '../Main/Header.php'; ?>

<?php
// Check if Entreprise_ID is set in GET parameters
if (isset($_GET['enterprise_id'])) {
    $entre_id = $_GET['enterprise_id'];
} else {
    die('Entreprise_ID not provided');
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

    <title>❤❤</title>
    <title>Entreprise</title>
    <link rel="icon" href="../Photos/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="entreprises/details.css">
    <link rel="stylesheet" type="text/css" href="../Main/Header.css">

    <style>
        body {
            margin: 0;
            padding: 0;
        }
        #main_bloc {
            position: relative;
            width: 100%;
            height: auto;
            background-size: cover;
            background-position: center;
            text-align: center;
            color: black; /* Ensure text is visible */
        }

        .nav-bar {
            width: 85%;
            display: flex;
            list-style: none;
            padding: 0;
            margin: -20px auto 0 auto;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            justify-content: center;
        }
        .nav-bar li {
            margin: 0;
            padding: 0;
        }

        .nav-bar form {
            display: inline-block;
        }

        .nav-bar button {
            background: none;
            border: none;
            padding: 14px 20px;
            color: #495057;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }

        .nav-bar button:hover {
            background-color: #e9ecef;
        }

        .nav-bar button.active {
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }

        #background {
            padding-bottom: 0;
        }
    </style>
</head>
<body>


<?php
    $sql = 'SELECT * FROM enterprise, informations, events WHERE enterprise.Information_ID = '.$entre_id.' AND informations.Information_ID = '.$entre_id.' AND events.Enterprise_ID = '.$entre_id.';';
    $result = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($result);
?>

<div class="container" id="background">
    <div class="container" id="main_bloc" style="background-image: url('bannieres/<?php echo $data['Banniere']; ?>');">
        <div class="row">
            <?php echo '<img id="ban" class="image" src="logos/' . $data['Logo'] . '" alt="Logo">'; ?>
        </div>

        <br><br><br><br><br><br><br><br><br><br>

        <?php echo '<p style="background-color: white; padding: 10px; color: black;">' . $data['Intro'] . '</p>'; ?>
    
    </div>
    <ul class="nav-bar">
        <li>
            <form method="post" action="">
                <input type="hidden" name="OngletNavBar" value="Accueil">
                <button type="submit" class="<?php echo isset($_POST['OngletNavBar']) && $_POST['OngletNavBar'] === 'Accueil' ? 'active' : ''; ?>">Accueil</button>
            </form>
        </li>
        <li>
            <form method="post" action="">
                <input type="hidden" name="OngletNavBar" value="A propos">
                <button type="submit" class="<?php echo isset($_POST['OngletNavBar']) && $_POST['OngletNavBar'] === 'A propos' ? 'active' : ''; ?>">A propos</button>
            </form>
        </li>
        <li>
            <form method="post" action="">
                <input type="hidden" name="OngletNavBar" value="Posts">
                <button type="submit" class="<?php echo isset($_POST['OngletNavBar']) && $_POST['OngletNavBar'] === 'Posts' ? 'active' : ''; ?>">Posts</button>
            </form>
        </li>
        <li>
            <form method="post" action="">
                <input type="hidden" name="OngletNavBar" value="Offres">
                <button type="submit" class="<?php echo isset($_POST['OngletNavBar']) && $_POST['OngletNavBar'] === 'Offres' ? 'active' : ''; ?>">Offres</button>
            </form>
        </li>
        <li>
            <button onclick="window.location.href='<?php echo $data['Site_Web']; ?>'">🔗 Consulter le site web</button>
        </li>
    </ul>
</div>

<?php
    if (isset($_POST['OngletNavBar'])) {
        $current_page = $_POST['OngletNavBar'];

        if ($current_page === "Accueil") {
            include 'details/accueil1.php';
        } elseif ($current_page === "A propos") {
            include 'details/apropos1.php';
        } elseif ($current_page === "Posts") {
            include 'details/posts1.php';
        } elseif ($current_page === "Offres") {
            include '../Emplois/EmploiAccueil.php';
        }
        elseif ($current_page === "Events_Semaine") {
            include '../Profil_entreprises/details/events_semaine1.php';
        }
        elseif ($current_page === "Tous") {
            include '../Profil_entreprises/details/posts1.php';
            echo 'test';
        }
    } else {
        $current_page = "Accueil";
    }
?>

</body>
</html>
