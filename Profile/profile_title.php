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
</head>
<body>

<?php
$sql = "SELECT * FROM utilisateur WHERE User_ID = '$user_id'";
$result = mysqli_query($db_handle, $sql);
$data = mysqli_fetch_assoc($result);

$prenom = $data['Prenom'];
$nom = $data['Nom'];
$email = $data['Mail'];
$pays = $data['Pays'];
$photo = $data['Photo'];
if ($photo == NULL) {
    $photo = "../Photos/photo_placeholder.png";
}

echo '<div class="container" id="main_bloc_profile">';
    echo '<br>';
    echo '<div class="row">';
        echo '<div class="col-md-6">';
        // Add onclick event to profile picture
        echo '<img src="'. $photo . '" class="rounded-circle" alt="Photo de profil" width="304" height="304" onclick="openModal(\'SELECT * FROM utilisateur WHERE User_ID = :id\', ' . $user_id . ', profilePhotoModalContent)">';
        echo '</div>';
        echo '<div class="col-md-5" style="margin-top:auto; margin-bottom:auto;">';
            echo '<table>';
            echo '<tr><h1 style="color: black;">' . $prenom . ' ' . $nom . '</h1></tr>';
            echo '<tr><h3 style="color: black;">' . $email . '</h3></tr>';
            echo '<tr><h3 style="color: black;">' . $pays . '</h3></tr>';
            echo '<br>';
            echo "<tr><a href='../Profile/CV_affichage.php?user_id=$user_id' class='btn btn-primary'>Générer un CV</a></tr>";
            echo '</table>';
        echo '</div>';
        echo '<div class="col-md-1">';
            //Modification du profil
            echo '<a href="Modification.php?id=title" id="title">';
            echo '<img src="../Photos/edit.png" alt="Modifier" width="40" height="40" >';
            echo '</a>';
        echo '</div>';
    echo '</div>';
    echo '<br>';

    echo '<br>';
echo '</div>';
?>

<!-- Include the modal HTML structure -->
<?php include 'modal.html'; ?>

</body>
</html>
