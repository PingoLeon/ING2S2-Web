<?php
$database = "ecein";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$user_id = 1;

$sql = "SELECT * FROM utilisateur WHERE User_ID = '$user_id'";
$result = mysqli_query($db_handle, $sql);
$data = mysqli_fetch_assoc($result);
$photo = $data['Photo'];


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id == 'edu_add') {
        Education_add($db_handle, $user_id);
    } elseif ($id == 'edu_modify') {
        Education_modify($db_handle, $user_id);
    } elseif ($id == 'edu_delete') {
        Education_delete($db_handle, $user_id);
    }
    
    
    elseif ($id == 'proj_add') {
        Project_add($db_handle, $user_id);
    } elseif ($id == 'proj_modify') {
        Project_modify($db_handle, $user_id);
    } elseif ($id == 'proj_delete') {
        Project_delete($db_handle, $user_id);
    }

    elseif ($id == 'exp_add') {
        Experience_add($db_handle, $user_id);
    } elseif ($id == 'exp_modify') {
        Experience_modify($db_handle, $user_id);
    } elseif ($id == 'exp_delete') {
        Experience_delete($db_handle, $user_id);
    }

    elseif ($id == 'post_add') {
        Post_add($db_handle, $user_id);
    } elseif ($id == 'post_modify') {
        Post_modify($db_handle, $user_id);
    } elseif ($id == 'post_delete') {
        Post_delete($db_handle, $user_id);
    }

    elseif ($id == 'title') {
        echo '<html>';
        echo '<img src="' . $photo . '" class="rounded-circle" alt="Photo de profil" width="304" height="304">';
        echo '</html>';
        Title_modify($db_handle, $user_id, $photo);
    }
}

function Education_add($db_handle, $user_id) {
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $type = isset($_POST["type"]) ? $_POST["type"] : "";
    $entreprise = isset($_POST["entreprise"]) ? $_POST["entreprise"] : "";

    if ($nom == "" || $debut == "" || $fin == "" || $type == "" || $entreprise == "") {
        header('Location: ../Main/modification.php?id=edu_add');
        return;
    } else {

        $sql = "SELECT * FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
        $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result) == 0) {
            $sql = "INSERT INTO Enterprise (Nom_Entreprise)
            VALUES ('$entreprise')";
            $result = mysqli_query($db_handle, $sql);
        }

        $sql = "SELECT Enterprise_ID FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $entreprise = $data['Enterprise_ID'];

        $sql = "INSERT INTO Education (User_ID, Debut, Fin, Nom, Type_formation, Enterprise_ID)
        VALUES ('$user_id', '$debut', '$fin', '$nom', '$type', '$entreprise')";
        $result = mysqli_query($db_handle, $sql);
        
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Education_modify($db_handle, $user_id) {
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $type = isset($_POST["type"]) ? $_POST["type"] : "";
    $entreprise = isset($_POST["entreprise"]) ? $_POST["entreprise"] : "";

    if ($nom == "" || $debut == "" || $fin == "" || $type == "" || $entreprise == "") {
        header('Location: ../Main/modification.php?id=edu_modify');
        return;
    } else {

        $sql = "SELECT * FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
        $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result) == 0) {
            echo '<script type="text/javascript">window.alert("L\'entreprise n\'existe pas. Veuillez réessayer.");</script>';
            echo '<script type="text/javascript">window.location.href = "../Main/modification.php?id=edu_modify";</script>';
            return;
        } else {
            $sql = "SELECT Enterprise_ID FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
            $result = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($result);
            $entreprise = $data['Enterprise_ID'];
        }

        $sql = "UPDATE Education SET Debut = '$debut', Fin = '$fin', Type_formation = '$type', Enterprise_ID = '$entreprise'
        WHERE Nom = '$nom' AND User_ID = '$user_id'";
        $result = mysqli_query($db_handle, $sql);
        if (!$result) {
            echo "Failed to update data. Please try again.";
        }
        
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Education_delete($db_handle, $user_id) {
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";

    if ($nom == "") {
        header('Location: ../Main/modification.php?id=edu_delete');
        return;
    } else {
        $sql = "DELETE FROM Education WHERE Nom = '$nom' AND User_ID = '$user_id' LIMIT 1";
        $result = mysqli_query($db_handle, $sql);
        
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Project_add($db_handle, $user_id) {
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $education = isset($_POST["education"]) ? $_POST["education"] : "";

    if ($nom == "" || $debut == "" || $fin == "") {
        header('Location: ../Main/modification.php?id=proj_add');
        return;
    } else {
        //Pour EDU_ID, on se base sur $education et on récupère l'ID de l'éducation
        $sql = "SELECT Edu_ID FROM Education WHERE Nom = '$education' AND User_ID = '$user_id'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $education = $data['Edu_ID'];
        $sql = "INSERT INTO projets (User_ID, Debut, Fin, Nom, Edu_ID)
        VALUES ('$user_id', '$debut', '$fin', '$nom', '$education')";
        $result = mysqli_query($db_handle, $sql);
        
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Project_modify($db_handle, $user_id) {
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $education = isset($_POST["education"]) ? $_POST["education"] : "";

    if ($nom == "" || $debut == "" || $fin == "") {
        header('Location: ../Main/modification.php?id=proj_modify');
        return;
    } else {
        //Pour EDU_ID, on se base sur $education et on récupère l'ID de l'éducation
        $sql = "SELECT Edu_ID FROM Education WHERE Nom = '$education' AND User_ID = '$user_id'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $education = $data['Edu_ID'];
        $sql = "UPDATE projets SET Debut = '$debut', Fin = '$fin', Edu_ID = '$education'
        WHERE Nom = '$nom' AND User_ID = '$user_id'";
        $result = mysqli_query($db_handle, $sql);
        
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Project_delete($db_handle, $user_id) {
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";

    if ($nom == "") {
        header('Location: ../Main/modification.php?id=proj_delete');
        return;
    } else {
        //Suppression de la premiere donnee dans la base de donnees
        $sql = "DELETE FROM projets WHERE Nom = '$nom' AND User_ID = '$user_id' LIMIT 1";
        $result = mysqli_query($db_handle, $sql);
        
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Experience_add($db_handle, $user_id) {
    //Recuperation des donnees du formulaire de methode POST
    $position = isset($_POST["position"]) ? $_POST["position"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $type = isset($_POST["type"]) ? $_POST["type"] : "";
    $entreprise = isset($_POST["entreprise"]) ? $_POST["entreprise"] : "";

    if ($position == "" || $debut == "" || $fin == "" || $type == "" || $entreprise == "") {
        header('Location: ../Main/modification.php?id=exp_add');
        return;
    } else {
        $sql = "SELECT * FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
        $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result) == 0) {
            $sql = "INSERT INTO Enterprise (Nom_Entreprise)
            VALUES ('$entreprise')";
            $result = mysqli_query($db_handle, $sql);
        }

        $sql = "SELECT Enterprise_ID FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $entreprise = $data['Enterprise_ID'];

        $sql = "INSERT INTO Experience (User_ID, Debut, Fin, Position, Type_Contrat, Enterprise_ID)
        VALUES ('$user_id', '$debut', '$fin', '$position', '$type', '$entreprise')";
        $result = mysqli_query($db_handle, $sql);
        
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Experience_modify($db_handle, $user_id) {
    //Recuperation des donnees du formulaire de methode POST. Si les données ne sont pas renseignées, on récupère les données de la base de données
    $position = isset($_POST["position"]) ? $_POST["position"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $type = isset($_POST["type"]) ? $_POST["type"] : "";
    $entreprise = isset($_POST["entreprise"]) ? $_POST["entreprise"] : "";
    

    if ($position == "" || $debut == "" || $fin == "" || $type == "" || $entreprise == "") {
        //Execute the function modification.php?id=exp_modify
        header('Location: ../Main/modification.php?id=exp_modify');
        return;
    } else {
        $sql = "SELECT Enterprise_ID FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $entreprise = $data['Enterprise_ID'];

        // On met à jour les données dans la base de données
        $sql = "UPDATE Experience SET Debut = '$debut', Fin = '$fin', Type_Contrat = '$type', Enterprise_ID = '$entreprise'
        WHERE Position = '$position' AND User_ID = '$user_id'";
        $result = mysqli_query($db_handle, $sql);
        if (!$result) {
            echo "Failed to update data. Please try again.";
        }
        
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Experience_delete($db_handle, $user_id) {
    //Recuperation des donnees du formulaire de methode POST
    $position = isset($_POST["position"]) ? $_POST["position"] : "";

    if ($position == "") {
        header('Location: ../Main/modification.php?id=exp_delete');
        return;
    } else {
        //Suppression de la premiere donnee dans la base de donnees
        $sql = "DELETE FROM Experience WHERE Position = '$position' AND User_ID = '$user_id' LIMIT 1";
        $result = mysqli_query($db_handle, $sql);
        
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}


function Title_modify($db_handle, $user_id) {
    //Recuperation des donnees du formulaire
    $sql = "SELECT * FROM utilisateur WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($result);

    $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $mail = isset($_POST["email"]) ? $_POST["email"] : "";
    $pays = isset($_POST["pays"]) ? $_POST["pays"] : "";
    $photo = isset($_POST["photo"]) ? $_POST["photo"] : "";

    $photo = "../Photos/" . $photo;

    //Si l'utilisateur n'a pas choisi de photo, on garde la photo actuelle - on la récupère du fichier XML
    if ($photo == "../Photos/") {
        $xml = simplexml_load_file("../Profile/CV.xml") or die("Error: Cannot create object");
        $photo = $xml->User->Photo;
    }

    $sql = "UPDATE utilisateur SET Prenom = '$prenom', Nom = '$nom', Mail = '$mail', Pays = '$pays', Photo = '$photo'
    WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    if (!$result) {
        echo "Failed to update data. Please try again.";
    } else {
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}


function Post_add($db_handle, $user_id) {
    //Recuperation des donnees du formulaire
    $titre = isset($_POST["titre"]) ? $_POST["titre"] : "";
    $texte = isset($_POST["texte"]) ? $_POST["texte"] : "";
    $lieu = isset($_POST["lieu"]) ? $_POST["lieu"] : "";
    $photo = isset($_POST["photo"]) ? $_POST["photo"] : "";
    $photo = "Photos/" . $photo;
    $photo = substr($photo, 0, -4);
    $date = date("Y-m-d");

    if ($texte == "") {
        header('Location: ../Main/modification.php?id=post_add');
        return;
    } else {
        // Utilisation d'une injection automatique pour éviter des problemes vis a vis des apostrophes et autres symboles speciaux
        $stmt = $db_handle->prepare("INSERT INTO Posts (User_ID, DatePublication, Photo, Texte, Titre, Lieu) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $user_id, $date, $photo, $texte, $titre, $lieu);

        if ($stmt->execute()) {
            header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

function Post_modify($db_handle, $user_id) {
    //Recuperation des donnees du formulaire
    $titre_new = isset($_POST["titre"]) ? $_POST["titre"] : "";
    $texte_new = isset($_POST["texte"]) ? $_POST["texte"] : "";
    $lieu_new = isset($_POST["lieu"]) ? $_POST["lieu"] : "";
    $photo_new = isset($_POST["photo"]) ? $_POST["photo"] : "";
    $photo_new = "Photos/" . $photo_new;
    $photo_new = substr($photo_new, 0, -4);
    $date_new = date("Y-m-d");

    if ($texte_new == "") {
        header('Location: ../Main/modification.php?id=post_modify');
        return;
    } else {
        // Utilisation d'une injection automatique pour éviter des problemes vis a vis des apostrophes et autres symboles speciaux
        $stmt = $db_handle->prepare("UPDATE Posts SET DatePublication = ?, Photo = ?, Texte = ?, Lieu = ? WHERE Titre = ? AND User_ID = ?");
        $stmt->bind_param("sssssi", $date_new, $photo_new, $texte_new, $lieu_new, $titre_new, $user_id);

        if ($stmt->execute()) {
            header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}


?>