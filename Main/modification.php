<?php
/*
Fichier: modification.php
Projet: ECEin
Fonctionnement: Ce fichier permet de modifier les informations du profil de l'utilisateur, dont:
    - Le titre (le profile de base, le nom, prenom, etc.)
    - L'éducation
    - Les projets
    - Les expériences
    - Les posts
Il commence par analyser l'URL pour savoir quelle section de la page de modification l'utilisateur veut modifier. Pour cela, on se base sur l'ID de la section.
Ensuite, on appelle la fonction correspondante à la section demandée.
Exemple: Si l'utilisateur veut modifier l'éducation, on appelle la fonction Edit_Education() qui va afficher les boutons pour ajouter ou modifier une formation.

Les fonctions sont ranges en deux parties, les fonctions meres et les sous-fonctions.

Les fonctions meres sont les fonctions qui vont afficher les boutons pour ajouter ou modifier une section du profil.

Les sous-fonctions traitent les formulaires pour ajouter ou modifier une section du profil selon le choix de l'utilisateur.
*/

include '../Auth/functions.php';
//! Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
list($id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
$user_id = $id;

echo '<br>';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id == 'title') {
        Edit_Title($db_handle, $user_id);
    } 
    
    elseif ($id == 'education') {
        Edit_Education($db_handle);
    } elseif ($id == 'edu_add') {
        Ajout_Education($db_handle, $user_id);
    } elseif ($id == 'edu_modify') {
        Modification_Education($db_handle, $user_id);
    } elseif ($id == 'edu_delete') {
        Suppression_Education($db_handle, $user_id);
    }
    
    elseif ($id == 'projet') {
        Edit_Projects($db_handle, $user_id);
    } elseif ($id == 'proj_add') {
        Ajout_Projet($db_handle, $user_id);
    } elseif ($id == 'proj_modify') {
        Modification_Projet($db_handle, $user_id);
    } elseif ($id == 'proj_delete') {
        Suppression_Projet($db_handle, $user_id);
    }

    elseif ($id == 'experience') {
        Edit_Experiences($db_handle);
    } elseif ($id == 'exp_add') {
        Ajout_Experience($db_handle, $user_id);
    } elseif ($id == 'exp_modify') {
        Modification_Experience($db_handle, $user_id);
    } elseif ($id == 'exp_delete') {
        Suppression_Experience($db_handle, $user_id);
    }
    
    elseif ($id == 'post') {
        Edit_Posts($db_handle);
    } elseif ($id == 'post_add') {
        Ajout_Post($db_handle, $user_id);
    } elseif ($id == 'post_modify') {
        Modification_Post($db_handle, $user_id);
    } elseif ($id == 'post_delete') {
        Suppression_Post($db_handle, $user_id);
    }
}

/*******************
 * FONCTIONS MERES *
 *******************/

function Edit_Education($db_handle) {
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10"><h2 style="color: black; text-align: left;">Modifier l\'Education</h2></div>';
        echo '</div>';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=edu_add" class="btn btn-primary">Ajouter une formation</a>';
            echo '</div>';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=edu_modify" class="btn btn-primary">Modifier une formation</a>';
            echo '</div>';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=edu_delete" class="btn btn-primary">Supprimer une formation</a>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
    echo '</div>';

    echo '<br>';
}

function Edit_Title($db_handle, $user_id) {
    //the title is the basic profile, the name, surname, etc.
    //The user can change his name, email, country or profile picture by uploading a new one from his computer
    echo '<div class="container" id="main_bloc_profile">';
        //List of the user's information
        echo '<br>';
        $sql = "SELECT * FROM utilisateur WHERE User_ID = '$user_id'";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $photo = $data['Photo'];
        //Form to change the user's information. If the user doesn't want to change one of the information, he can leave the field empty
        echo '<form action="../Profile/Profile_add.php?id=title" method="post">';
            echo '<div class="form-group">';
                echo '<label for="prenom">Prénom:</label>';
                echo '<input type="text" class="form-control" id="prenom" name="prenom" value="' . $data['Prenom'] . '">';
                echo '<label for="nom">Nom:</label>';
                echo '<input type="text" class="form-control" id="nom" name="nom" value="' . $data['Nom'] . '">';
                echo '<label for="email">Email:</label>';
                echo '<input type="text" class="form-control" id="email" name="email" value="' . $data['Mail'] . '">';
                echo '<label for="pays">Pays:</label>';
                echo '<input type="text" class="form-control" id="pays" name="pays" value="' . $data['Pays'] . '">';
                echo '<label for="photo">Photo de profil:</label>';
                echo '<input type="file" class="form-control" id="photo" name="photo">';
                echo '<img src="' . $photo . '" class="rounded-circle" alt="Photo de profil" width="304" height="304">';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Modifier</button>';
        echo '</form>';
    echo '</div>';
    echo '<br>';

    return $photo;
}

function Edit_Projects($db_handle, $user_id) {
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10"><h2 style="color: black; text-align: left;">Modifier les Projets</h2></div>';
        echo '</div>';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=proj_add" class="btn btn-primary">Ajouter un projet</a>';
            echo '</div>';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=proj_modify" class="btn btn-primary">Modifier un projet</a>';
            echo '</div>';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=proj_delete" class="btn btn-primary">Supprimer un projet</a>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
    echo '</div>';

    echo '<br>';
}

function Edit_Experiences($db_handle) {
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10"><h2 style="color: black; text-align: left;">Modifier les Experiences</h2></div>';
        echo '</div>';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=exp_add" class="btn btn-primary">Ajouter une experience</a>';
            echo '</div>';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=exp_modify" class="btn btn-primary">Modifier une experience</a>';
            echo '</div>';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=exp_delete" class="btn btn-primary">Supprimer une experience</a>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
}

function Edit_Posts($db_handle) {
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10"><h2 style="color: black; text-align: left;">Modifier les Posts</h2></div>';
        echo '</div>';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=post_add" class="btn btn-primary">Ajouter un post</a>';
            echo '</div>';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=post_modify" class="btn btn-primary">Modifier un post</a>';
            echo '</div>';
            echo '<div class="col-md-4">';
                echo '<a href="modification.php?id=post_delete" class="btn btn-primary">Supprimer un post</a>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
    echo '</div>';
}



/******************
 * SOUS-FONCTIONS *
 ******************/

function Ajout_Education($db_handle, $user_id) {
    Edit_Education($db_handle);
    //Creation du formulaire pour ajouter une formation
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10">';
                echo '<h2 style="color: black; text-align: left;">Ajouter une formation</h2>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<form action="../Profile/Profile_add.php?id=edu_add" method="post">';
            echo '<div class="form-group">';
                echo '<label for="nom">Nom de la formation:</label>';
                echo '<input type="text" class="form-control" id="nom" name="nom">';
            echo '</div>';
            Date_Debut_Fin($db_handle);
            echo '<div class="form-group">';
                echo '<label for="type">Type de formation:</label>';
                echo '<input type="text" class="form-control" id="type" name="type">';
            echo '</div>';
            echo '<div class="form-group">';
                Entreprise($db_handle);
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Ajouter</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

function Modification_Education($db_handle, $user_id) {
    Edit_Education($db_handle);
    //Creation du formulaire pour modifier une formation
    //Recuperation des donnees de tout les formations de l'utilisateur
    $sql = "SELECT * FROM Education WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10">';
                echo '<h2 style="color: black; text-align: left;">Modifier une formation</h2>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<form action="../Profile/Profile_add.php?id=edu_modify" method="post">';
            echo '<div class="form-group">';
                echo '<label for="nom">Nom de la formation:</label>';
                echo '<select class="form-control" id="nom" name="nom">';
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                    }
                echo '</select>';
            echo '</div>';
            Date_Debut_Fin($db_handle);
            echo '<div class="form-group">';
                echo '<label for="type">Type de formation:</label>';
                echo '<input type="text" class="form-control" id="type" name="type">';
            echo '</div>';
            echo '<div class="form-group">';
                Entreprise($db_handle);
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Modifier</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

function Suppression_Education($db_handle, $user_id) {
    Edit_Education($db_handle);
    //Creation du formulaire pour supprimer une formation
    //Recuperation des donnees de tout les formations de l'utilisateur
    $sql = "SELECT * FROM Education WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10">';
                echo '<h2 style="color: black; text-align: left;">Supprimer une formation</h2>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<form action="../Profile/Profile_add.php?id=edu_delete" method="post">';
            echo '<div class="form-group">';
                echo '<label for="nom">Nom de la formation:</label>';
                echo '<select class="form-control" id="nom" name="nom">';
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                    }
                echo '</select>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Supprimer</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}




function Ajout_Projet($db_handle, $user_id) {
    Edit_Projects($db_handle, $user_id);
    //Creation du formulaire pour ajouter un projet
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10">';
                echo '<h2 style="color: black; text-align: left;">Ajouter un projet</h2>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<form action="../Profile/Profile_add.php?id=proj_add" method="post">';
            echo '<div class="form-group">';
                echo '<label for="nom">Nom du projet:</label>';
                echo '<input type="text" class="form-control" id="nom" name="nom">';
            echo '</div>';
            Date_Debut_Fin($db_handle);
            //Option to select the education linked to the project. the education is a list of all the educations of the user
            $sql = "SELECT Nom FROM Education WHERE User_ID = '$user_id'";
            $result = mysqli_query($db_handle, $sql);
            echo '<div class="form-group">';
                echo '<label for="education">Formation:</label>';
                echo '<select class="form-control" id="education" name="education">';
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                    }
                echo '</select>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Ajouter</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

function Modification_Projet($db_handle, $user_id) {
    Edit_Projects($db_handle, $user_id);
    //Creation du formulaire pour modifier un projet
    //Recuperation des donnees de tout les projets de l'utilisateur
    $sql = "SELECT * FROM Projets WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10">';
                echo '<h2 style="color: black; text-align: left;">Modifier un projet</h2>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<form action="../Profile/Profile_add.php?id=proj_modify" method="post">';
            echo '<div class="form-group">';
                echo '<label for="nom">Nom du projet:</label>';
                echo '<select class="form-control" id="nom" name="nom">';
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                    }
                echo '</select>';
            echo '</div>';
            Date_Debut_Fin($db_handle);
            //Option to select the education linked to the project. the education is a list of all the educations of the user
            $sql = "SELECT Nom FROM Education WHERE User_ID = '$user_id'";
            $result = mysqli_query($db_handle, $sql);
            echo '<div class="form-group">';
                echo '<label for="education">Formation:</label>';
                echo '<select class="form-control" id="education" name="education">';
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                    }
                echo '</select>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Modifier</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

function Suppression_Projet($db_handle, $user_id) {
    Edit_Projects($db_handle, $user_id);
    //Creation du formulaire pour supprimer un projet
    //Recuperation des donnees de tout les projets de l'utilisateur
    $sql = "SELECT * FROM Projets WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10">';
                echo '<h2 style="color: black; text-align: left;">Supprimer un projet</h2>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<form action="../Profile/Profile_add.php?id=proj_delete" method="post">';
            echo '<div class="form-group">';
                echo '<label for="nom">Nom du projet:</label>';
                echo '<select class="form-control" id="nom" name="nom">';
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $data['Nom'] . '">' . $data['Nom'] . '</option>';
                    }
                echo '</select>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Supprimer</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

function Ajout_Experience($db_handle) {
    Edit_Experiences($db_handle);
    //Creation du formulaire pour ajouter une experience
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10">';
                echo '<h2 style="color: black; text-align: left;">Ajouter une experience</h2>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        //INSERT INTO Experience (User_ID, Debut, Fin, Position, Type_Contrat, Enterprise_ID)
        echo '<form action="../Profile/Profile_add.php?id=exp_add" method="post">';
            Date_Debut_Fin($db_handle);
            echo '<div class="form-group">';
                echo '<label for="position">Position:</label>';
                echo '<input type="text" class="form-control" id="position" name="position">';
            echo '</div>';
            echo '<div class="form-group">';
                //Option to select the type of contract from a list: CDI, CDD, Stage, Alternance
                echo '<label for="type">Type de contrat:</label>';
                echo '<select class="form-control" id="type" name="type">';
                    echo '<option value="CDI">CDI</option>';
                    echo '<option value="CDD">CDD</option>';
                    echo '<option value="Stage">Stage</option>';
                    echo '<option value="Alternance">Alternance</option>';
                echo '</select>';
            echo '</div>';
            echo '<div class="form-group">';
                Entreprise($db_handle);
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Ajouter</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

function Modification_Experience($db_handle, $user_id) {
    Edit_Experiences($db_handle);
    //Creation du formulaire pour modifier une experience
    //Recuperation des donnees de tout les experiences de l'utilisateur
    $sql = "SELECT * FROM Experience WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    //Asks the user to select the experience he wants to modify
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10">';
                echo '<h2 style="color: black; text-align: left;">Modifier une experience</h2>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<form action="../Profile/Profile_add.php?id=exp_modify" method="post">';
            echo '<div class="form-group">';
                echo '<label for="position">Position:</label>';
                echo '<select class="form-control" id="position" name="position">';
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $data['Position'] . '">' . $data['Position'] . '</option>';
                    }
                echo '</select>';
            echo '</div>';
            Date_Debut_Fin($db_handle);
            echo '<div class="form-group">';
                //Option to select the type of contract from a list: CDI, CDD, Stage, Alternance
                echo '<label for="type">Type de contrat:</label>';
                echo '<select class="form-control" id="type" name="type">';
                    echo '<option value="CDI">CDI</option>';
                    echo '<option value="CDD">CDD</option>';
                    echo '<option value="Stage">Stage</option>';
                    echo '<option value="Alternance">Alternance</option>';
                echo '</select>';
            echo '</div>';
            echo '<div class="form-group">';
                Entreprise($db_handle);
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Modifier</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

function Suppression_Experience($db_handle, $user_id) {
    Edit_Experiences($db_handle);
    //Creation du formulaire pour supprimer une experience
    //Recuperation des donnees de tout les experiences de l'utilisateur
    $sql = "SELECT * FROM Experience WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    //Asks the user to select the experience he wants to delete
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10">';
                echo '<h2 style="color: black; text-align: left;">Supprimer une experience</h2>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<form action="../Profile/Profile_add.php?id=exp_delete" method="post">';
            echo '<div class="form-group">';
                echo '<label for="position">Position:</label>';
                echo '<select class="form-control" id="position" name="position">';
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $data['Position'] . '">' . $data['Position'] . '</option>';
                    }
                echo '</select>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Supprimer</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

function Ajout_Post($db_handle, $user_id) {
    Edit_Posts($db_handle);
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10">';
                echo '<h2 style="color: black; text-align: left;">Ajouter un post</h2>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<form action="../Profile/Profile_add.php?id=post_add" method="post">';
            //Ajout du titre du post
            echo '<div class="form-group">';
                echo '<label for="titre">Titre:</label>';
                echo '<input type="text" class="form-control" id="titre" name="titre">';
            echo '</div>';

            echo '<div class="form-group">';
                echo '<label for="lieu">Lieu:</label>';
                echo '<input type="text" class="form-control" id="lieu" name="lieu">';
            echo '</div>';

            echo '<div class="form-group">';
                echo '<label for="texte">Texte:</label>';
                echo '<textarea class="form-control" id="texte" name="texte" rows="3"></textarea>';
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label for="photo">Photo:</label>';
            echo '<input type="file" class="form-control" id="photo" name="photo">';
            echo '</div>';

            echo '<button type="submit" class="btn btn-primary">Ajouter</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

function Modification_Post($db_handle, $user_id) {
    Edit_Posts($db_handle);
    //Creation du formulaire pour modifier un post
    //Recuperation des donnees de tout les posts de l'utilisateur
    $sql = "SELECT * FROM Posts WHERE User_ID = '$user_id'";
    $result = mysqli_query($db_handle, $sql);
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10">';
                echo '<h2 style="color: black; text-align: left;">Modifier un post</h2>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<form action="../Profile/Profile_add.php?id=post_modify" method="post">';
            echo '<div class="form-group">';
                echo '<label for="titre">Titre:</label>';
                echo '<select class="form-control" id="titre" name="titre">';
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $data['Titre'] . '">' . $data['Titre'] . '</option>';
                    }
                echo '</select>';
            echo '</div>';
            echo '<div class="form-group">';
                echo '<label for="lieu">Lieu:</label>';
                echo '<input type="text" class="form-control" id="lieu" name="lieu">';
            echo '</div>';
            echo '<div class="form-group">';
                echo '<label for="texte">Texte:</label>';
                //Display the text of the post the user wants to modify
                echo '<textarea class="form-control" id="texte" name="texte" rows="3"></textarea>';
            echo '</div>';
            echo '<div class="form-group">';
                echo '<label for="photo">Photo:</label>';
                echo '<input type="file" class="form-control" id="photo" name="photo">';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Modifier</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}




function Entreprise($db_handle) {
    $sql = "SELECT Nom_Entreprise FROM Entreprise";
    $result = mysqli_query($db_handle, $sql);
    echo '<label for="entreprise">Nom de l\'entreprise:</label>';
    echo '<select class="form-control" id="entreprise" name="entreprise">';
        while ($data = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $data['Nom_Entreprise'] . '">' . $data['Nom_Entreprise'] . '</option>';
        }
    echo '</select>';
}

function Date_Debut_Fin($db_handle) {
    echo '<div class="form-group">';
        echo '<label for="debut">Date de début:</label>';
        echo '<input type="date" class="form-control" id="debut" name="debut">';
    echo '</div>';
    echo '<div class="form-group">';
        echo '<label for="fin">Date de fin:</label>';
        echo '<input type="date" class="form-control" id="fin" name="fin">';
    echo '</div>';
}

?>
