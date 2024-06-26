<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="../Photos/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Lien Boostrap, JQuery -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="Site.css">
    <link rel = "stylesheet" type = "text/css" href = "Header.css">
</head>

<body>
    <!-- Ajout du header -->
    <?php include 'Header.php'; ?>
    <br>

    <!-- Creation du fichier XML -->
    <?php include '../Profile/CV.php'; ?>
    <?php //Creation_XML(); ?>

    <br>

    <!-- Ajout du titre du profil -->
    <?php include '../Profile/Profile_title.php'; ?>
    <br>

    <!-- Ajout des informations AJOUTE du profil -->


    <!-- Ajout des informations du profil -->
    <?php include '../Profile/Profile_posts.php'; ?>
    <br>

    <!-- Ajout des experiences du profil -->
    <?php include '../Profile/Profile_experience.php'; ?>
    <br>

    <!-- Ajout des formations du profil -->
    <?php include '../Profile/Profile_education.php'; ?>
    <br>

    <!-- Ajout des projets du profil -->
    <?php include '../Profile/Profile_projects.php'; ?>
</body>
</html>