<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile Posts</title>
<link rel="stylesheet" href="modal.css"> <!-- Link to your modal styles -->
<link rel="stylesheet" href="../Main/Site.css">

<script src="modal.js"></script> <!-- Link to your modal script -->

<script>
function postModalContent(data) {
  return `
  <div class = "col-mid-6">
    <h3>${data.Titre}</h3>
    <img src="../${data.Photo}.png" alt="Post Image" width="50%">
    <p>${data.Texte}</p>
    </div>
  `;
}

function profilePhotoModalContent(data) {
  return `
    <div class = "col-mid-6">
    <h3>${data.Prenom} ${data.Nom}</h3>
    <img src="${data.Photo}" alt="Profile Photo" width="100%">
    </div>
  `;
}
</script>
</head>
<body>
<div class="container" id="main_bloc_profile">
  <br>
  <div class="row">
    <div class="col-md-10">
      <h2 style="color: black; text-align: left;">Posts</h2>
    </div>
    <div class="col-md-2">
      <a href="../Main/Modification.php?id=post" id="post">
        <img src="../Photos/edit.png" alt="Modifier" width="40" height="40">
      </a>
    </div>
  </div>
  <div class="row">
    <?php
    $result = Rechercher_Post($db_handle, $user_id);
    while ($data = mysqli_fetch_assoc($result)) {
        Affichage_Post($data);
    }
    ?>
  </div>
  <br>
</div>

<!-- Include the modal HTML structure -->
<?php include '../Main/modal.html'; ?>
</body>
</html>

<?php
function Rechercher_Post($db_handle, $user_id) {
    $sql = "SELECT Utilisateur.Nom, Utilisateur.Prenom, Posts.Texte, Posts.DatePublication, Posts.Photo, Posts.Titre, Posts.Post_ID, Posts.Lieu
            FROM Utilisateur
            JOIN Posts ON Utilisateur.User_ID = Posts.User_ID
            WHERE Utilisateur.User_ID = $user_id
            ORDER BY Posts.DatePublication DESC";
    $result = mysqli_query($db_handle, $sql);
    return $result;
}

function Affichage_Post($data) {
    echo '<div class="col-md-2">';
        echo '<img src="../' . $data['Photo'] . '.png" alt="Photo de profil" width="100" height="100" onclick="openModal(\'SELECT * FROM Posts WHERE Post_ID = :id\', ' . $data['Post_ID'] . ', postModalContent)">';
    echo '</div>';
    echo '<div class="col-md-10" style="word-wrap: break-word; overflow: hidden; text-overflow: ellipsis; white-space: pre-wrap;">';
        echo '<table>';
            echo '<tr><h3 style="color: black; text-align: left;">' . $data['Titre'] . '</h3></tr>';
            $date = date('d/m/Y', strtotime($data['DatePublication']));
            $texte = substr($data['Texte'], 0, 80) . '...';
            echo '<tr><h5 style="color: black;">' . $date . '</h5>
            <h5 style="color: black;">' . $data['Lieu'] . '</h5></tr>';
            echo '<tr><h5 style="color: black;">' . $texte . '</h5></tr>';
        echo '</table>';
    echo '</div>';
}
?>
