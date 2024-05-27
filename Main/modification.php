<?php
include 'Header.html';

$database = "ecein";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

echo '<h1>Modification</h1>';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id == 'title') {
        Edit_Title();
    } elseif ($id == 'education') {
        Edit_Education();
    } elseif ($id == 'projects') {
        Edit_Projects();
    } elseif ($id == 'experiences') {
        Edit_Experiences();
    } elseif ($id == 'posts') {
        Edit_Posts();
    } elseif ($id == 'edu_add') {
        Ajout_Education();
    } elseif ($id == 'edu_modify') {
        Modification_Education($db_handle);
    } elseif ($id == 'proj_add') {
        Ajout_Projet();
    } elseif ($id == 'proj_modify') {
        Modification_Projet();
    }
}

/*******************
 * FONCTIONS MERES *
 *******************/

function Edit_Education() {
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10"><h2 style="color: black; text-align: left;">Modifier l\'Education</h2></div>';
        echo '</div>';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-6">';
                echo '<a href="modification.php?id=edu_add" class="btn btn-primary">Ajouter une formation</a>';
            echo '</div>';
            echo '<div class="col-md-6">';
                echo '<a href="modification.php?id=edu_modify" class="btn btn-primary">Modifier une formation</a>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
    echo '</div>';

    echo '<br>';
}

function Edit_Title() {
    echo '<h2>Edit Title</h2>';
    // Add your code to edit title here

}

function Edit_Projects() {
    echo '<div class="container" id="main_bloc_profile">';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-10"><h2 style="color: black; text-align: left;">Modifier les Projets</h2></div>';
        echo '</div>';
        echo '<br>';
        echo '<div class="row">';
            echo '<div class="col-md-6">';
                echo '<a href="modification.php?id=proj_add" class="btn btn-primary">Ajouter un projet</a>';
            echo '</div>';
            echo '<div class="col-md-6">';
                echo '<a href="modification.php?id=proj_modify" class="btn btn-primary">Modifier un projet</a>';
            echo '</div>';
        echo '</div>';
        echo '<br>';
    echo '</div>';

    echo '<br>';
}

function Edit_Experiences() {
    echo '<h2>Edit Experiences</h2>';
    // Add your code to edit experiences here
}

function Edit_Posts() {
    echo '<h2>Edit Posts</h2>';
    // Add your code to edit posts here
}



/******************
 * SOUS-FONCTIONS *
 ******************/

function Ajout_Education() {
    Edit_Education();
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
            echo '<div class="form-group">';
                echo '<label for="debut">Date de début:</label>';
                echo '<input type="date" class="form-control" id="debut" name="debut">';
            echo '</div>';
            echo '<div class="form-group">';
                echo '<label for="fin">Date de fin:</label>';
                echo '<input type="date" class="form-control" id="fin" name="fin">';
            echo '</div>';
            echo '<div class="form-group">';
                echo '<label for="type">Type de formation:</label>';
                echo '<input type="text" class="form-control" id="type" name="type">';
            echo '</div>';
            echo '<div class="form-group">';
                echo '<label for="entreprise">Nom de l\'entreprise:</label>';
                echo '<input type="text" class="form-control" id="entreprise" name="entreprise">';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Ajouter</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

function Modification_Education($db_handle) {
    Edit_Education();
    //Creation du formulaire pour modifier une formation
    //Recuperation des donnees de tout les formations de l'utilisateur
    $sql = "SELECT * FROM Education WHERE User_ID = 1";
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
            echo '<div class="form-group">';
                echo '<label for="debut">Date de début:</label>';
                echo '<input type="date" class="form-control" id="debut" name="debut">';
            echo '</div>';
            echo '<div class="form-group">';
                echo '<label for="fin">Date de fin:</label>';
                echo '<input type="date" class="form-control" id="fin" name="fin">';
            echo '</div>';
            echo '<div class="form-group">';
                echo '<label for="type">Type de formation:</label>';
                echo '<input type="text" class="form-control" id="type" name="type">';
            echo '</div>';
            echo '<div class="form-group">';
                echo '<label for="entreprise">Nom de l\'entreprise:</label>';
                echo '<input type="text" class="form-control" id="entreprise" name="entreprise">';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Modifier</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

function Ajout_Projet() {
    Edit_Projects();
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
            echo '<div class="form-group">';
                echo '<label for="debut">Date de début:</label>';
                echo '<input type="date" class="form-control" id="debut" name="debut">';
            echo '</div>';
            echo '<div class="form-group">';
                echo '<label for="fin">Date de fin:</label>';
                echo '<input type="date" class="form-control" id="fin" name="fin">';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Ajouter</button>';
        echo '</form>';
        echo '<br>';
    echo '</div>';
}

?>
