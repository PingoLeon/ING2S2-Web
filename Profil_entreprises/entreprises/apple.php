<?php
        $menu_items = [
        "Accueil" => "#",
        "À propos" => "#",
        "Produits" => "#",
        "Posts" => "#",
        "Emplois" => "#",
        ];
$current_page = "Accueil"; // Change this variable based on the current page
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>bannière</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="details.css">
</head>

<body>
    
<div class="container" id="background"> 
    <div class="container" id="main_bloc">
        <div class="row">
            <img src="../../Profil_entreprises/bannieres/apple.png" alt="APPLE banniere" style="width: 100%; height: 10%">             
            <img id ="ban" class="image" src="../../Profil_entreprises/logos/logo1.png" alt="APPLE LOGO" style="width: 15%; background-color :white">
        </div><br><br><br>

        Fabrication de produits informatiques et électroniques Cupertino, California <br>

        <button onclick="window.location.href='https://www.apple.com/careers/us/'">Consulter le site web</button><br><br>


    <div class="nav-bar">
        <?php foreach ($menu_items as $name => $link): ?>
            <a href="<?php echo $link; ?>" class="nav-item <?php echo $name == $current_page ? 'active' : ''; ?>">
                <?php echo $name; ?>
            </a>
        <?php endforeach; ?>
      
    </div>
    </div>
   
</div>
</body>
</html>