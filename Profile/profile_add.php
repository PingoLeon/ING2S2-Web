<?php
$database = "ecein";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id == 'edu_add') {
        Education_add($db_handle);
    } elseif ($id == 'edu_modify') {
        Education_modify($db_handle);
    } elseif ($id == 'proj_add') {
        Project_add($db_handle);
    } elseif ($id == 'proj_modify') {
        Project_modify($db_handle);
    }
}

function Education_add($db_handle) {
    //Recuperation des donnees du formulaire de methode POST
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $type = isset($_POST["type"]) ? $_POST["type"] : "";
    $entreprise = isset($_POST["entreprise"]) ? $_POST["entreprise"] : "";
    $user_id = 1;

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

function Education_modify($db_handle) {
    //Recuperation des donnees du formulaire de methode POST
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $type = isset($_POST["type"]) ? $_POST["type"] : "";
    $entreprise = isset($_POST["entreprise"]) ? $_POST["entreprise"] : "";
    $user_id = 1;

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

function Project_add($db_handle) {
    //Recuperation des donnees du formulaire de methode POST
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $debut = isset($_POST["debut"]) ? $_POST["debut"] : "";
    $fin = isset($_POST["fin"]) ? $_POST["fin"] : "";
    $description = isset($_POST["description"]) ? $_POST["description"] : "";
    $user_id = 1;

    //Verification des donnees
    if ($nom == "" || $debut == "" || $fin == "" || $description == "") {
        //Execute the function modification.php?id=proj_add
        header('Location: ../Main/modification.php?id=proj_add');
        return;
    } else {
        //Insertion des donnees dans la base de donnees
        $sql = "INSERT INTO Project (User_ID, Debut, Fin, Nom)
        VALUES ('$user_id', '$debut', '$fin', '$nom')";
        $result = mysqli_query($db_handle, $sql);
        
        //Redirection vers la page de profil
        header('Location: http://localhost:8080/ING2S2-WEB/Main/profile_main.php');
    }
}

?>