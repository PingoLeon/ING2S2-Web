<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile Posts</title>
<style>
/* Modal styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>
<script>
function openModal(postID) {
  console.log('Modal opened for post ID:', postID); // Debugging
  const modal = document.getElementById("postModal");
  const span = document.getElementsByClassName("close")[0];
  const title = document.getElementById("modalTitle");
  const image = document.getElementById("modalImage");
  const text = document.getElementById("modalText");

  // AJAX call to fetch post data
  fetch(`../Profile/profile_posts_modal.php?post_id=${postID}`)
    .then(response => response.json())
    .then(data => {
      console.log('Data received:', data); // Debugging
      title.innerHTML = data.Titre;
      image.src = `../${data.Photo}.png`;
      text.innerHTML = data.Texte;
      modal.style.display = "block";
    })
    .catch(error => console.error('Error fetching post data:', error));

  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
}
</script>
</head>
<body>
<div class="container" id="main_bloc_profile">
  <br>
  <div class="row">
    <div class="col-md-10">
      <h2 style="color: black; text-align: left;">Activités</h2>
    </div>
    <div class="col-md-2">
      <a href="Modification.php?id=post" id="post">
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

<!-- Modal -->
<div id="postModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3 id="modalTitle"></h3>
    <div class="row">
      <div class="col-md-6">
      <img id="modalImage" src="" alt="Post Image" width="100%">
      </div>
      <div class="col-md-6">
        <p id="modalText"></p>
      </div>
    </div>
    
    <p id="modalText"></p>
  </div>
</div>
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
        echo '<img src="../' . $data['Photo'] . '.png" alt="Photo de profil" width="100" height="100" onclick="openModal(' . $data['Post_ID'] . ')">';
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