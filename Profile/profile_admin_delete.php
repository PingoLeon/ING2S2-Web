<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="../Photos/favicon.ico" type="image/x-icon">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
<link rel="stylesheet" href="modal.css"> <!-- Link to your modal styles -->
<link rel="stylesheet" href="../Main/Site.css"> <!-- Link to your profile styles -->
<link rel="stylesheet" href="../Main/Header.css"> <!-- Link to your header styles -->
<script src="modal.js"></script> <!-- Link to your modal script -->
<style>
    .text{
        color: black;
        font-size: 1rem;
        font-weight: normal;
        color: #6c757d;
    }
</style>
</head>
<body>
    <?php ob_start(); ?>
    <?php include '../Main/header.php'; ?>
    
    <?php
    $sql = "SELECT * FROM utilisateur WHERE Entreprise_ID != -1";
    $result = mysqli_query($db_handle, $sql);
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger" role="alert">';
        echo $_SESSION['error'];
        echo '</div>';
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success" role="alert">';
        echo $_SESSION['success'];
        echo '</div>';
        unset($_SESSION['success']);
    }
    echo '<br>';
    echo '<h1 class="display-4 fw-normal text-body-emphasis p-3 pb-md-4 mx-auto text-center">Gestion des Utilisateurs</h1>';
    echo '<div class="container text" id="main_bloc_profile">';
    echo '<br>';
    echo '<div class="row">';
    echo '<div class="col-md-12">';
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Nom</th>';
    echo '<th scope="col">Prenom</th>';
    echo '<th scope="col">Email</th>';
    echo '<th scope="col">Pays</th>';
    echo '<th scope="col">Supprimer</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($data = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $data['Nom'] . '</td>';
        echo '<td>' . $data['Prenom'] . '</td>';
        echo '<td>' . $data['Mail'] . '</td>';
        echo '<td>' . $data['Pays'] . '</td>';
        echo '<form method="post">';
        echo '<input type="hidden" name="user_id" value="' . $data['User_ID'] . '">';
        echo '<td><button class="btn btn-danger type="submit" name="delete-user">Supprimer</button></td>';
        echo '</form>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
    echo '<br>';
    echo '<div class="container text" id="main_bloc_profile">';
    echo '<br>';
    echo '<form method="post">';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Nom</th>';
    echo '<th scope="col">Prenom</th>';
    echo '<th scope="col">Email</th>';
    echo '<th scope="col">Pays</th>';
    echo '<th scope="col">Mot de passe</th>';
    echo '<th scope="col">Entreprise_ID</th>';
    echo '<th scope="col"></th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    echo '<tr>';
    echo '<td><input type="text" class="form-control" name="nom" placeholder="Nom"></td>';
    echo '<td><input type="text" class="form-control" name="prenom" placeholder="Prenom" required></td>';
    echo '<td><input type="email" class="form-control" name="email" placeholder="Email" required></td>';
    echo '<td><input type="text" class="form-control" name="pays" placeholder="Pays"></td>';
    echo '<td><input type="password" class="form-control" name="password" placeholder="Mot de passe" required></td>';
    echo '<td><input type="number" class="form-control" name="entreprise_id" placeholder="Entreprise_ID" required></td>';
    echo '<td><button class="btn btn-primary" type="submit" name="add-user">Ajouter</button></td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
    echo '</form>';
    echo '</div>';
    echo '<br>';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['add-user'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $pays = $_POST['pays'];
            $password = hash('sha512', $_POST['password']);
            $sql = "INSERT INTO utilisateur (Nom, Prenom, Mail, Pays, MDP, Entreprise_ID) VALUES ('$nom', '$prenom', '$email', '$pays', '$password', 0)";
            mysqli_query($db_handle, $sql);
            if (mysqli_error($db_handle)) {
                $_SESSION['error'] = "Erreur lors de l'ajout de l'utilisateur";
            }else{
                $_SESSION['success'] = "Utilisateur ajouté avec succès";
            }
            header('Location: profile_admin_delete.php');
            ob_end_flush();
            exit();
        }
        
        if (isset($_POST['delete-user'])) {
            $user_id = $_POST['user_id'];
            $sql = "DELETE FROM utilisateur WHERE User_ID = '$user_id'";
            mysqli_query($db_handle, $sql);
            if (mysqli_error($db_handle)) {
                $_SESSION['error'] = "Erreur lors de la suppression de l'utilisateur";
            }else{
                $_SESSION['success'] = "Utilisateur supprimé avec succès";
            }
            header('Location: profile_admin_delete.php');
            ob_end_flush();
            exit();
        }
    }
?>
    
    
    
    
    