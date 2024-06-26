<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../Photos/favicon.ico" type="image/x-icon">
    <!-- Lien Boostrap, JQuery -->
    <link rel="cano nical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="theme-color" content="#712cf9">
    <link href="style.css" rel="stylesheet">

    <title>Mon Réseau - EngineerIN</title>
    <link rel="stylesheet" type="text/css" href="../Main/Site.css">
    <script src="modal.js"></script>
</head>

<style>
    .card {
        margin: 5px;
    }
    
    .fixed-height {
        height: 63vh;
    }
    
    .my-card-text {
    font-size: 1rem;
    font-weight: normal;
    color: #6c757d;
    
    }   
    
    .container.background, header.background {
        filter: blur(8px);
    }
    
    .nomprenom {
        margin-top: 5vh;
        font-weight: bold;
    }
    
    .mood {
        font-size: 0.8em;
        background-color: #4158D0;
        background: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);

        color: transparent;
        -webkit-background-clip: text; 
        background-clip: text;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.close-custom').click(function(){
            $('#profileModalCustom').css('display', 'none');
        });
    });
</script>

<body>
    <!-- Ajout du header -->
    <?php include '../Main/Header.php'; ?>
    
    <div class="container">
        <!-- section personnelle -->
        <h1 class="display-4 fw-normal text-body-emphasis p-3 pb-md-4 mx-auto text-center">Vous</h1>
        <div class="row">
            <?php 
                $sql = "SELECT * FROM Utilisateur WHERE User_ID = '$user_id'";
                $result = mysqli_query($db_handle, $sql);
                $data = mysqli_fetch_assoc($result);
                $prenom = $data['Prenom'];
                $nom = $data['Nom'];
                $photo = $data['Photo'];
                if ($photo == NULL) {
                    $photo = "../Photos/photo_placeholder.png";
                }else{
                    $photo = '../Photos/' . $photo . '';
                }
                $entreprise_id = $data['Entreprise_ID'];
                $mood = $data['Mood'];
                $sql_entreprise = "SELECT Nom_Entreprise FROM enterprise WHERE Enterprise_ID = '$entreprise_id'";
                $result_entreprise = mysqli_query($db_handle, $sql_entreprise);
                $row = mysqli_fetch_assoc($result_entreprise);
                isset($row['Nom_Entreprise']) ? $nom_entreprise = $row['Nom_Entreprise'] : $nom_entreprise = '';
                $sql_poste = "SELECT Position, Fin, Enterprise_ID FROM Experience WHERE User_ID = '$user_id' ORDER BY Debut";
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
            ?>
            <div class="col-md-12">
                <div class="card mb-3 border" style="display: flex;">
                    <div class="row no-gutters">
                        <div class="col-md-3">
                            <img src="<?php echo $photo; ?>" class="card-img rounded-circle m-3" style="width: 200px; height: 200px; object-fit: cover;">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $prenom . ' ' . $nom; ?>
                                <?php
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
                                ?>
                                <span class="my-card-text"><i class='mood'><?php echo $mood; ?></i></span>
                                <br>
                                <span class="my-card-text"><?php echo $poste; ?></span>
                            </div>
                            <div class="card-footer bg-transparent border-top-0 mt-auto">
                                <button class="btn btn-primary btn-block btn-sm d-inline-block mx-auto" style="width: 150px;" onclick="openModal('SELECT * FROM Utilisateur WHERE User_ID = <?php echo $user_id; ?>', <?php echo $user_id; ?>, true, false, profileModalContent)">Voir profil</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Section Vos Relations -->
        <h1 class="display-4 fw-normal text-body-emphasis p-3 pb-md-4 mx-auto text-center">Vos Relations</h1>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <?php
                    $true_or_falsebutton1 = 'true';
                    $true_or_falsebutton2 = 'false';
                    //! Récupérer les User_ID des relations de l'utilisateur
                    $sql = "SELECT U.User_ID, U.Mail, U.Prenom, U.Nom, U.Photo, U.Entreprise_ID, U.Mood
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
                        if ($photo == NULL) {
                            $photo = "../Photos/photo_placeholder.png";
                        }else{
                            $photo = '../Photos/' . $photo . '';
                        }
                        $entreprise_id = $data_user['Entreprise_ID'];
                        $mood = $data_user['Mood'];
                        
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
                        echo "  </h5>";
                        }
                        echo "      
                                <span class='my-card-text'><i class='mood'>$mood</i></span><br>
                                <span class='my-card-text'>$poste</span>
                            </div>
                            <div class='card-footer bg-transparent border-top-0 mt-auto'>
                                    ";       
                        echo "  <button class='btn btn-primary btn-block' onclick=\"openModal('SELECT * FROM Utilisateur WHERE User_ID = ' + $user_id_user, $user_id_user,$true_or_falsebutton1, true, profileModalContent)\">Voir profil </button>";
                            echo " 
                            </div>
                        </div>
                    </div>
                        ";
                    }
                    ?>
                </div>
                
                <!-- Section des Amis d'Amis -->
                <h1 class="display-4 fw-normal text-body-emphasis p-3 pb-md-4 mx-auto text-center">Amis d'Amis</h1>
                <div class="row">
                    <?php
                    //! Récupérer les User_ID des relations des relations de l'utilisateur
                    $sql_get_relations = "SELECT UID1, UID2 FROM Relations WHERE UID1 = '$user_id' OR UID2 = '$user_id'";
                    $result_get_relations = mysqli_query($db_handle, $sql_get_relations);
                    $relations = array();
                    while($data_relations = mysqli_fetch_assoc($result_get_relations)) {
                        $relations[] = $data_relations['UID1'];
                        $relations[] = $data_relations['UID2'];
                    }
                    $relations = array_unique($relations);
                    $relations = array_diff($relations, array($user_id));
                    $relations = implode("', '", $relations);
                    //aller chercher les relations des relations
                    $sql = "SELECT U.User_ID, U.Mail, U.Prenom, U.Nom, U.Photo, U.Entreprise_ID, U.Mood
                            FROM Relations AS R
                            JOIN Utilisateur AS U ON (R.UID1 = U.User_ID OR R.UID2 = U.User_ID)
                            WHERE (R.UID1 IN ('$relations') OR R.UID2 IN ('$relations'))
                            AND U.User_ID NOT IN ('$relations', '$user_id')
                        ";
                    $result = mysqli_query($db_handle, $sql); 
                    while($data_user = mysqli_fetch_assoc($result)) {
                        //! Nom et prénom de l'utilisateur
                        $user_id_user = $data_user['User_ID'];
                        $mail = $data_user['Mail'];
                        $prenom = $data_user['Prenom'];
                        $nom = $data_user['Nom'];
                        $photo = $data_user['Photo'];
                        if ($photo == NULL) {
                            $photo = "../Photos/photo_placeholder.png";
                        }else{
                            $photo = '../Photos/' . $photo . '';
                        }
                        $entreprise_id = $data_user['Entreprise_ID'];
                        $mood = $data_user['Mood'];
                        $sql_friend = "SELECT Prenom, Nom FROM Utilisateur WHERE User_ID IN (SELECT UID1 FROM Relations WHERE UID2 = '$user_id_user' UNION SELECT UID2 FROM Relations WHERE UID1 = '$user_id_user')";
                        $result_friend = mysqli_query($db_handle, $sql_friend);
                        $friend_name = "";
                        if($data_friend = mysqli_fetch_assoc($result_friend)) {
                            $friend_name = $data_friend['Prenom'] . " " . $data_friend['Nom'];
                        }
                        
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
                            echo "  </h5>";
                        }
                        echo "  
                                    <span class='my-card-text'><i class='mood'>$mood</i></span><br>
                                    <span class='my-card-text'>$poste</span>
                                    <br><br>
                                    <span class='my-card-text'>Ami de $friend_name</span>
                                </div>
                                <div class='card-footer bg-transparent border-top-0 mt-auto'>
                                    ";       
                            echo "  <button class='btn btn-primary btn-block' onclick=\"openModal('SELECT * FROM Utilisateur WHERE User_ID = ' + $user_id_user, $user_id_user,$true_or_falsebutton2, true, profileModalContent)\">Voir profil</button>";
                            echo " 
                                </div>
                            </div>
                        </div>";
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
                            AND U.User_ID != '$user_id' AND U.User_ID != -1
                            LIMIT 20
                        ";
                        
                        
                        $result = mysqli_query($db_handle, $sql); 
                        while($data_user = mysqli_fetch_assoc($result)) {
                            //! Nom et prénom de l'utilisateur
                            $user_id_relation = $data_user['User_ID'];
                            $mail = $data_user['Mail'];
                            $prenom = $data_user['Prenom'];
                            $nom = $data_user['Nom'];
                            $photo = $data_user['Photo'];
                            if ($photo == NULL) {
                                $photo = "../Photos/photo_placeholder.png";
                            }else{
                                $photo = '../Photos/' . $photo . '';
                            }
                            $entreprise_id = $data_user['Entreprise_ID'];
                            
                            //! Récupérer l'expérience actuelle de l'utilisateur
                            if ($entreprise_id != 0 AND $entreprise_id != -1){
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
                                            <span class='my-card-text'>$poste</span>
                                            ";       
                            echo "<button class='btn btn-primary' onclick=\"openModal('SELECT * FROM Utilisateur WHERE User_ID = ' + $user_id_relation, $user_id_relation,$true_or_falsebutton2, true, profileModalContent)\">Voir profil</button>";
                            echo "          </div>
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

    
    <div id="profileModalCustom" class="modal">
    <div class="modal-content-custom">
        <span class="close-custom">&times;</span>
        <div id="modalContentCustom"></div>
    </div>
    </div>
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["user_id"]) && !empty($_POST["user_id"])) {
                $user_id_friend = $_POST["user_id"];
                if (isset($_POST["delete_relation"])) {
                    unset($_POST["delete_relation"]);
                    $sql = "DELETE FROM Relations WHERE (UID1 = '$user_id' AND UID2 = '$user_id_friend') OR (UID1 = '$user_id_friend' AND UID2 = '$user_id')";
                    $result = mysqli_query($db_handle, $sql);
                    if ($result) {
                        // Supprimer les messages et ensuite la messagerie
                        $sql_msg = "DELETE FROM Messages WHERE Convers_ID = (SELECT Convers_ID FROM Messagerie WHERE (ID1 = '$user_id' AND ID2 = '$user_id_friend') OR (ID1 = '$user_id_friend' AND ID2 = '$user_id'))";
                        $result_msg = mysqli_query($db_handle, $sql_msg);
                        
                        $sql_msg = "DELETE FROM Messagerie WHERE (ID1 = '$user_id' AND ID2 = '$user_id_friend') OR (ID1 = '$user_id_friend' AND ID2 = '$user_id')";
                        $result_msg = mysqli_query($db_handle, $sql_msg);
                        
                    } else {
                        $_SESSION['alert'] = 'Erreur lors de la suppression de la relation';
                    }
                } else if (isset($_POST["create_relation"])) {
                    unset($_POST["create_relation"]);
                    $sql = "SELECT * FROM Relations WHERE (UID1 = '$user_id' AND UID2 = '$user_id_friend') OR (UID1 = '$user_id_friend' AND UID2 = '$user_id')";
                    $result = mysqli_query($db_handle, $sql);
                    if (mysqli_num_rows($result) != 0) {
                        $_SESSION['alert'] = 'Relation déjà existante';
                    } else {
                        $sql = "INSERT INTO Relations (UID1, UID2) VALUES ('$user_id', '$user_id_friend')";
                        $result = mysqli_query($db_handle, $sql);
                        $sql_msg = "INSERT INTO Messagerie (ID1, ID2) VALUES ('$user_id', '$user_id_friend')";
                        $result_msg = mysqli_query($db_handle, $sql_msg);
                        if (!($result && $result_msg)) {
                            $_SESSION['alert'] = 'Erreur lors de l\'ajout de la relation';
                        }
                    }
                }
                
                header("Location: index.php");
                exit;
            }
        }
        
        if (isset($_SESSION['alert'])) {
            echo "<script>alert('{$_SESSION['alert']}');</script>";
            unset($_SESSION['alert']);
        }
    ?>

    
</body>
</html>
