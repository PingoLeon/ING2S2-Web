<!-- profile_main.php -->
<?php
    include '../Auth/functions.php';
    //! Renvoyer l'utilisateur à la page de connexion si il n'est pas connecté, sinon récupérer l'id et l'email
    list($user_id, $email, $db_handle,) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
    //! Checker si l'utilisateur a appuyé sur le bouton de déconnexion
    logout_button_POST();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Lien Boostrap, JQuery -->
    <link rel="cano nical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="theme-color" content="#712cf9">
    <link href="style.css" rel="stylesheet">

    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="../Main/Site.css">
    <script src="modal.js"></script>
</head>

<body>
    <!-- Ajout du header -->
    <?php include '../Main/Header.php'; ?>
    
    <!-- Using Bootstrap -->
    <h1 class="display-4 fw-normal text-body-emphasis p-3 pb-md-4 mx-auto text-center">Vos Relations</h1>
    <div class="container">
        <div class="row">
            <!-- Section for the vertical cards (Vos Relations) -->
            <div class="col-md-9">
                <div class="row">
                    <?php
                    //! Récupérer les User_ID des relations de l'utilisateur
                    $sql = "SELECT U.User_ID, U.Mail, U.Prenom, U.Nom, U.Photo, U.Entreprise_ID
                            FROM Relations AS R
                            JOIN Utilisateur AS U ON (R.UID1 = U.User_ID OR R.UID2 = U.User_ID)
                            WHERE (R.UID1 = '$user_id' OR R.UID2 = '$user_id')
                            AND U.User_ID != '$user_id'";
                    $result = mysqli_query($db_handle, $sql); 
                    while($data_user = mysqli_fetch_assoc($result)) {
                        //! Nom et prénom de l'utilisateur
                        $user_id_user = $data_user['User_ID'];
                        $mail = $data_user['Mail'];
                        $prenom = $data_user['Prenom'];
                        $nom = $data_user['Nom'];
                        $photo = $data_user['Photo'];
                        $entreprise_id = $data_user['Entreprise_ID'];
                        
                        //! Récupérer l'expérience actuelle de l'utilisateur
                        if ($entreprise_id != 0 AND $entreprise_id != -1){
                            $sql_entreprise = "SELECT Nom_Entreprise FROM enterprise WHERE Enterprise_ID = '$entreprise_id'";
                            $result_entreprise = mysqli_query($db_handle, $sql_entreprise);
                            $row = mysqli_fetch_assoc($result_entreprise);
                            $nom_entreprise = $row['Nom_Entreprise'];
                        }
                        $sql_poste = "SELECT Position, Fin, Enterprise_ID FROM Experience WHERE User_ID = '$user_id_user' ORDER BY Debut";
                        $result_poste = mysqli_query($db_handle, $sql_poste);
                        if (mysqli_num_rows($result_poste) != 0) {
                            $row_poste = mysqli_fetch_assoc($result_poste);
                            $date_poste = date("Y-m-d");
                            $Enterprise_ID = $row_poste['Enterprise_ID'];
                            if ($date_poste > $row_poste['Fin']) {
                                $poste = 'Pas en poste actuellement';
                            } else {
                                $poste = $row_poste['Position'];
                                $sql_poste_2 = "SELECT Nom_Entreprise FROM Enterprise WHERE Enterprise_ID = '$Enterprise_ID'";
                                $result_poste_2 = mysqli_query($db_handle, $sql_poste_2);
                                if (mysqli_num_rows($result_poste_2) != 0) {
                                    $row_poste_2 = mysqli_fetch_assoc($result_poste_2);
                                    $poste .= ' chez ' . $row_poste_2['Nom_Entreprise'];
                                }
                            } 
                        } else {
                            $poste = 'Pas en poste actuellement';
                        }
                        
                        
                        echo "
                            <div class='col-md-3'>
                                <div class='card mb-5 border fixed-height' style='width: 100%; display: flex; flex-direction: column;'>
                                    <img src='$photo' class='card-img-top' style='width: 100%; max-height: 200px; object-fit: cover;'>
                                    <div class='card-body' style='flex-grow: 1;'>
                                        <h5 class='card-title'>$prenom $nom";
                        
                        //Vérifier dans la BDD Enterprise si l'utilisateur est une entreprise, si oui lui afficher un badg
                        if ($entreprise_id != 0 AND $entreprise_id != -1){
                            echo "
                                <div title='Admin de " . $nom_entreprise . "' style='display: inline-block;'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-patch-check-fill' viewBox='0 0 16 16'>
                                        <path d='M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708'/>
                                    </svg>
                                </div>
                                </h5>
                                
                            ";                     
                        }else{
                            echo "</h5>";
                        }
                        echo "
                                    <p class='card-text'>$poste</p>
                                    </div>
                                    <div class='card-footer bg-transparent border-top-0 mt-auto'>
                                        <button class='btn btn-primary btn-block' onclick=\"openModal('SELECT * FROM Utilisateur WHERE User_ID = $user_id_user', $user_id_user, profileModalContent)\">Voir profil</button>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                    ?>
                </div>
            </div>
            <!-- Section for the horizontal cards -->
            <div class="col-md-3">
                <h3>Personnes recommandées</h3>
                    <div class="row">
                    <?php
                        //! Récupérer les User_ID de tous ceux qui ne sont pas dans les relations de l'utilisateur
                        $sql = "SELECT U.User_ID, U.Mail, U.Prenom, U.Nom, U.Photo, U.Entreprise_ID
                            FROM Utilisateur AS U
                            WHERE U.User_ID NOT IN (
                                SELECT R.UID2 FROM Relations AS R WHERE R.UID1 = '$user_id'
                                UNION
                                SELECT R.UID1 FROM Relations AS R WHERE R.UID2 = '$user_id'
                            )
                            AND U.User_ID != '$user_id'
                            LIMIT 10
                        ";
                        
                        
                        $result = mysqli_query($db_handle, $sql); 
                        while($data_user = mysqli_fetch_assoc($result)) {
                            //! Nom et prénom de l'utilisateur
                            $user_id_relation = $data_user['User_ID'];
                            $mail = $data_user['Mail'];
                            $prenom = $data_user['Prenom'];
                            $nom = $data_user['Nom'];
                            $photo = $data_user['Photo'];
                            $entreprise_id = $data_user['Entreprise_ID'];
                            
                            //! Récupérer l'expérience actuelle de l'utilisateur
                            if ($entreprise_id != 0 OR $entreprise_id != -1){
                                $sql_entreprise = "SELECT Nom_Entreprise FROM enterprise WHERE Enterprise_ID = '$entreprise_id'";
                                $result_entreprise = mysqli_query($db_handle, $sql_entreprise);
                                $row = mysqli_fetch_assoc($result_entreprise);
                                $nom_entreprise = $row['Nom_Entreprise'];
                            }
                            
                            $sql_poste = "SELECT Position, Fin, Enterprise_ID FROM Experience WHERE User_ID = '$user_id_relation' ORDER BY Debut";
                            $result_poste = mysqli_query($db_handle, $sql_poste);
                            if (mysqli_num_rows($result_poste) != 0) {
                                $row_poste = mysqli_fetch_assoc($result_poste);
                                $date_poste = date("Y-m-d");
                                $Enterprise_ID = $row_poste['Enterprise_ID'];
                                if ($date_poste > $row_poste['Fin']) {
                                    $poste = 'Pas en poste actuellement';
                                } else {
                                    $poste = $row_poste['Position'];
                                    $sql_poste_2 = "SELECT Nom_Entreprise FROM Enterprise WHERE Enterprise_ID = '$Enterprise_ID'";
                                    $result_poste_2 = mysqli_query($db_handle, $sql_poste_2);
                                    if (mysqli_num_rows($result_poste_2) != 0) {
                                        $row_poste_2 = mysqli_fetch_assoc($result_poste_2);
                                        $poste .= ' chez ' . $row_poste_2['Nom_Entreprise'];
                                    }
                                } 
                            } else {
                                $poste = 'Pas en poste actuellement';
                            }
                            echo "
                                <div class='card mb-3' style='max-width: 540px;'>
                                    <div class='row g-0'>
                                        <div class='col-md-4 d-flex align-items-center justify-content-center'>
                                            <img src='$photo' class='img-fluid rounded-start'>
                                        </div>
                                        <div class='col-md-8'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>$prenom $nom
                                                ";
                            //Vérifier dans la BDD Enterprise si l'utilisateur est une entreprise, si oui lui afficher un badge
                            if ($entreprise_id != 0 AND $entreprise_id != -1){
                                echo "
                                    <div title='Admin de " . $nom_entreprise . "' style='display: inline-block;'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-patch-check-fill' viewBox='0 0 16 16'>
                                            <path d='M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708'/>
                                        </svg>
                                    </div>
                                    </h5>
                                "; 
                                
                            }else{
                                echo "</h5>";
                            }
                            echo "
                                                <p class='card-text'>$poste</p>
                                                <button class='btn btn-primary' onclick=\"openModal('SELECT * FROM Utilisateur WHERE User_ID = $user_id_relation', $user_id_relation, profileModalContent)\">Voir profil</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    
    <div id="profileModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modalContent"></div>
    </div>
    </div>

    
</body>


<style>
    .card {
        margin: 5px;
    }
    
    .fixed-height {
        height: 63vh;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.close').click(function(){
            $('#profileModal').css('display', 'none');
        });
    });
</script>