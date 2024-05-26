<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="Site.css">


</head>

<body>
    <?php include 'Header.html';?>

    <br>

    <div class="container" id="background">
        <div class="container" id="main_bloc">
            <h1 style="color: black;">Profile</h1>
        </div>
    </div>

    <?php
    $database = "ecein";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    
    $sql = "SELECT * FROM utilisateur WHERE User_ID = 1";
    $result = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($result);

    $prenom = $data['Prenom'];
    $nom = $data['Nom'];
    $email = $data['Mail'];
    $pays = $data['Pays'];
    $photo = $data['Photo'];
    $admin = $data['Statut_Admin'];

    

    echo '<div class="container" id="main_bloc">';
        echo '<div class = "row">';
            echo '<div class = "col-md-4">';
                echo '<img src="'.$photo.'.png" class="img-circle" alt="Photo de profil" width="304" height="304"">';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    ?>


</body>

</html>
