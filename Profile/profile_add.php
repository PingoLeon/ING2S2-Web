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

    elseif ($id == 'title') {
        echo '<html>';
        echo '<img src="' . $photo . '" class="rounded-circle" alt="Photo de profil" width="304" height="304">';
        echo '</html>';
        Title_modify($db_handle, $user_id, $photo);
    }
}

function Education_add($db_handle, $user_id) {
    //Recuperation des donnees du formulaire de methode POST
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $type = isset($_POST["type"]) ? $_POST["type"] : "";
    $entreprise = isset($_POST["entreprise"]) ? $_POST["entreprise"] : "";

    //Verification des donnees
    if ($nom == "" || $debut == "" || $fin == "" || $type == "" || $entreprise == "") {
        //Execute the function modification.php?id=edu_add
        header('Location: ../Main/modification.php?id=edu_add');
        return;
    } else {

        //Verification de l'existence de l'entreprise
        $sql = "SELECT * FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
        $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result) == 0) {
            $sql = "INSERT INTO Enterprise (Nom_Entreprise)
            VALUES ('$entreprise')";
            $result = mysqli_query($db_handle, $sql);
        }

        //Recuperation de l'ID de l'entreprise
        $sql = "SELECT Enterprise_ID FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $entreprise = $data['Enterprise_ID'];

        //Insertion des donnees dans la base de donnees
        $sql = "INSERT INTO Education (User_ID, Debut, Fin, Nom, Type_formation, Enterprise_ID)
        VALUES ('$user_id', '$debut', '$fin', '$nom', '$type', '$entreprise')";
        $result = mysqli_query($db_handle, $sql);
        
        //Redirection vers la page de profil
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Education_modify($db_handle, $user_id) {
    //Recuperation des donnees du formulaire de methode POST
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $type = isset($_POST["type"]) ? $_POST["type"] : "";
    $entreprise = isset($_POST["entreprise"]) ? $_POST["entreprise"] : "";

    if ($nom == "" || $debut == "" || $fin == "" || $type == "" || $entreprise == "") {
        //Execute the function modification.php?id=edu_modify
        header('Location: ../Main/modification.php?id=edu_modify');
        return;
    } else {

        //Verification de l'existence de l'entreprise
        $sql = "SELECT * FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
        $result = mysqli_query($db_handle, $sql);
        // Si l'entreprise n'existe pas, on affiche un message d'erreur
        if (mysqli_num_rows($result) == 0) {
            echo '<script type="text/javascript">window.alert("L\'entreprise n\'existe pas. Veuillez réessayer.");</script>';
            echo '<script type="text/javascript">window.location.href = "../Main/modification.php?id=edu_modify";</script>';
            return;
        // Sinon, on récupère l'ID de l'entreprise
        } else {
            $sql = "SELECT Enterprise_ID FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
            $result = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($result);
            $entreprise = $data['Enterprise_ID'];
        }

        // On met à jour les données dans la base de données
        $sql = "UPDATE Education SET Debut = '$debut', Fin = '$fin', Type_formation = '$type', Enterprise_ID = '$entreprise'
        WHERE Nom = '$nom' AND User_ID = '$user_id'";
        $result = mysqli_query($db_handle, $sql);
        if (!$result) {
            echo "Failed to update data. Please try again.";
        }
        
        //Redirection vers la page de profil
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Education_delete($db_handle, $user_id) {
    //Recuperation des donnees du formulaire de methode POST
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";

    //Verification des donnees
    if ($nom == "") {
        //Execute the function modification.php?id=edu_delete
        header('Location: ../Main/modification.php?id=edu_delete');
        return;
    } else {
        //Suppression de la premiere donnee dans la base de donnees
        $sql = "DELETE FROM Education WHERE Nom = '$nom' AND User_ID = '$user_id' LIMIT 1";
        $result = mysqli_query($db_handle, $sql);
        
        //Redirection vers la page de profil
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Project_add($db_handle, $user_id) {
    //Recuperation des donnees du formulaire de methode POST
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $education = isset($_POST["education"]) ? $_POST["education"] : "";

    //Verification des donnees
    if ($nom == "" || $debut == "" || $fin == "") {
        //Execute the function modification.php?id=proj_add
        header('Location: ../Main/modification.php?id=proj_add');
        return;
    } else {
        //Insertion des donnees dans la base de donnees
        //Pour EDU_ID, on se base sur $education et on récupère l'ID de l'éducation
        $sql = "SELECT Edu_ID FROM Education WHERE Nom = '$education' AND User_ID = '$user_id'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $education = $data['Edu_ID'];
        $sql = "INSERT INTO projets (User_ID, Debut, Fin, Nom, Edu_ID)
        VALUES ('$user_id', '$debut', '$fin', '$nom', '$education')";
        $result = mysqli_query($db_handle, $sql);
        
        //Redirection vers la page de profil
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Project_modify($db_handle, $user_id) {
    //Recuperation des donnees du formulaire de methode POST
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $education = isset($_POST["education"]) ? $_POST["education"] : "";

    //Verification des donnees
    if ($nom == "" || $debut == "" || $fin == "") {
        //Execute the function modification.php?id=proj_modify
        header('Location: ../Main/modification.php?id=proj_modify');
        return;
    } else {
        //Insertion des donnees dans la base de donnees
        //Pour EDU_ID, on se base sur $education et on récupère l'ID de l'éducation
        $sql = "SELECT Edu_ID FROM Education WHERE Nom = '$education' AND User_ID = '$user_id'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $education = $data['Edu_ID'];
        $sql = "UPDATE projets SET Debut = '$debut', Fin = '$fin', Edu_ID = '$education'
        WHERE Nom = '$nom' AND User_ID = '$user_id'";
        $result = mysqli_query($db_handle, $sql);
        
        //Redirection vers la page de profil
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Project_delete($db_handle, $user_id) {
    //Recuperation des donnees du formulaire de methode POST
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";

    //Verification des donnees
    if ($nom == "") {
        //Execute the function modification.php?id=proj_delete
        header('Location: ../Main/modification.php?id=proj_delete');
        return;
    } else {
        //Suppression de la premiere donnee dans la base de donnees
        $sql = "DELETE FROM projets WHERE Nom = '$nom' AND User_ID = '$user_id' LIMIT 1";
        $result = mysqli_query($db_handle, $sql);
        
        //Redirection vers la page de profil
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

    //Verification des donnees
    if ($position == "" || $debut == "" || $fin == "" || $type == "" || $entreprise == "") {
        //Execute the function modification.php?id=exp_add
        header('Location: ../Main/modification.php?id=exp_add');
        return;
    } else {
        //Verification de l'existence de l'entreprise
        $sql = "SELECT * FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
        $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result) == 0) {
            $sql = "INSERT INTO Enterprise (Nom_Entreprise)
            VALUES ('$entreprise')";
            $result = mysqli_query($db_handle, $sql);
        }

        //Recuperation de l'ID de l'entreprise
        $sql = "SELECT Enterprise_ID FROM Enterprise WHERE Nom_Entreprise = '$entreprise'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $entreprise = $data['Enterprise_ID'];

        //Insertion des donnees dans la base de donnees
        $sql = "INSERT INTO Experience (User_ID, Debut, Fin, Position, Type_Contrat, Enterprise_ID)
        VALUES ('$user_id', '$debut', '$fin', '$position', '$type', '$entreprise')";
        $result = mysqli_query($db_handle, $sql);
        
        //Redirection vers la page de profil
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
        
        //Redirection vers la page de profil
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

function Experience_delete($db_handle, $user_id) {
    //Recuperation des donnees du formulaire de methode POST
    $position = isset($_POST["position"]) ? $_POST["position"] : "";

    //Verification des donnees
    if ($position == "") {
        //Execute the function modification.php?id=exp_delete
        header('Location: ../Main/modification.php?id=exp_delete');
        return;
    } else {
        //Suppression de la premiere donnee dans la base de donnees
        $sql = "DELETE FROM Experience WHERE Position = '$position' AND User_ID = '$user_id' LIMIT 1";
        $result = mysqli_query($db_handle, $sql);
        
        //Redirection vers la page de profil
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

    $sql = "UPDATE utilisateur SET Prenom = '$prenom', Nom = '$nom', Mail = '$mail', Pays = '$pays', Photo = '$photo'
    WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    if (!$result) {
        echo "Failed to update data. Please try again.";
    } else {
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

?>