<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CV.css">
  <link rel="stylesheet" href="../Main/Site.css">
</head>

<body>
    <?php 
    include '../Profile/CV.php';
    $xml = Creation_XML(); ?>
    <!-- div size of A4 paper -->
    <div style="width: 21cm; height: 29.7cm; margin: 30px auto; border: 1px solid #D3D3D3; background: white; padding: 20px;">
        <div class="container">
            <div class="Colonne_Gauche">
                <img src="<?php echo $xml->User->Photo; ?>" />
                <div class="details">
                    <div >
                        <br>
                        <h2>CONTACT</h2>
                        <div style="font-size: 0.45cm;">
                            <p>
                                <i class="fa fa-envelope contactIcon" aria-hidden="true"></i>
                                <!-- Source: https://fontawesome.com/v4/icon/envelope -->
                                <a href="mailto:<?php echo $xml->User->Mail; ?>">
                                    <?php echo $xml->User->Mail; ?>
                                </a>
                            </p>
                            <p>
                                <i class="fa fa-map-marker contactIcon" aria-hidden="true"></i>
                                <!-- Source: https://fontawesome.com/v4/icon/map-marker -->
                                <?php echo $xml->User->Pays; ?>
                            </p>
                        </div>
                        <br>
                        <hr style="border-top: 1px solid white;">
                        <br>
                        <h2>PROJETS</h2>
                        <br>
                        <div style="font-size: 0.45cm;">
                            <?php
                            foreach ($xml->Projects->children() as $project) {
                                echo '<p>';
                                echo '<span style="color: white;">';
                                echo $project->Nom;
                                echo '</span>';
                                echo '<br>';
                                echo $project->Edu_Name;
                                echo '<br>';
                                echo $project->Debut . ' - ' . $project->Fin;
                                echo '</p>';
                                echo '<br>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>



            <div class="Colonne_Droite">
                <div>
                    <h1 style="font-size: 1.2cm; text-transform: uppercase; ">
                        <?php echo $xml->User->Prenom . ' ' . $xml->User->Nom; ?>
                    </h1>
                    <div>
                        <h3>
                            <?php
                                $last_education = $xml->Education->Edu[count($xml->Education->Edu) - 1];
                                echo $last_education->Type_formation;
                            ?>
                        </h3>
                    </div>
                </div>
                <div>
                    <div>
                        <?php $paragraph = Description_CV();
                        echo '<p style="font-size: 0.45cm;">' . $paragraph . '</p>';
                        ?>
                    </div>
                </div>
                <br>
                <hr style="border-top: 3px solid darkslateblue; margin-left:-27px;">
                <div class="Exp_Pro">
                    
                    <h2>
                        Expérience professionnelle
                    </h2>
                    <ul>
                        <?php
                        foreach ($xml->Experience->children() as $experience) {
                            echo '<li>';
                            echo '<div style="font-size: 0.45cm; flex-direction: row; justify-content: space-between; display: flex;">';
                            echo '<span style="font-weight: bold;">';
                            echo $experience->Position;
                            echo '</span>';
                            echo '<span>';
                            if ($experience->Fin > date('Y-m-d H:i:s')) {
                                echo $experience->Debut . ' - Present';
                            } else {
                                echo $experience->Debut . ' - ' . $experience->Fin;
                            }
                            echo '</span>';
                            echo '</div>';
                            echo '<div style="font-weight: bold;">';
                            echo '<span>';
                            echo $experience->Enterprise;
                            echo '</span>';
                            echo '</div>';
                            echo '<div style="font-size: 0.40cm;">';
                            echo '<p>';
                            echo $experience->Type_Contrat;
                            echo '</p>';
                            echo '</div>';
                            //Display the years of experience
                            $start_date = new DateTime($experience->Debut);
                            $end_date = new DateTime($experience->Fin);
                            $interval = $start_date->diff($end_date);
                            echo '<div style="font-size: 0.40cm;">';
                            echo '<p>';
                            echo $interval->m . ' mois';
                            echo '</p>';
                            echo '</div>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
                <br>
                <hr style="border-top: 3px solid darkslateblue; margin-left:-27px;">
                <div class="Exp_Pro">
                    <h2>
                        Formation
                    </h2>
                    <ul>
                        <?php
                        foreach ($xml->Education->children() as $education) {
                            echo '<li>';
                            echo '<div style="font-size: 0.45cm; flex-direction: row; justify-content: space-between; display: flex;">';
                            echo '<span style="font-weight: bold;">';
                            echo $education->Nom;
                            echo '</span>';
                            echo '<span>';
                            echo $education->Debut . ' - ' . $education->Fin;
                            echo '</span>';
                            echo '</div>';
                            echo '<div style="font-weight: bold;">';
                            echo '<span>';
                            echo $education->Enterprise;
                            echo '</span>';
                            echo '</div>';
                            echo '<div style="font-size: 0.40cm;">';
                            echo '<p>';
                            echo $education->Type_formation;
                            echo '</p>';
                            echo '</div>';
                            $start_date = new DateTime($education->Debut);
                            $end_date = new DateTime($education->Fin);
                            $interval = $start_date->diff($end_date);
                            echo '<div style="font-size: 0.40cm;">';
                            echo '<p>';
                            echo $interval->y . ' ans ';
                            echo $interval->m . ' mois';
                            echo '</p>';
                            echo '</div>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
            </div>
        </div>
    </div>

</body>

<?php
function Description_CV() {
    $database = "ecein";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    $user_id = 1;

    $xml = simplexml_load_file("../Profile/CV.xml") or die("Error: Cannot create object");

    $Prenom = $xml->User->Prenom;
    $Nom = $xml->User->Nom;
    $email = $xml->User->Mail;
    $country = $xml->User->Pays;
    $education = $xml->Education->Edu;
    $projects = $xml->Projects->Project;
    $experience = $xml->Experience->Exp;

    $EducationEntreprise = $education->Enterprise;
    $EducationTypeFormation = $education->Type_formation;
    $EducationDebut = date("F Y", strtotime($education->Debut));
    $EducationFin = date("F Y", strtotime($education->Fin));
    if ($education->Fin > date('Y-m-d')) {
        $EducationPosition = 'etudiant';
    } else {
        $EducationPosition = 'diplômé';
    }

    $ProjetNom = $projects->Nom;
    $ProjetDebut = date("F Y", strtotime($projects->Debut));
    if ($projects->Fin > date('Y-m-d')) {
        $ProjetFin = '';
        $ProjetDebut = 'depuis ' . $ProjetDebut;
    } else {
        $ProjetFin = 'à ' . date("F Y", strtotime($projects->Fin));
        $ProjetDebut = 'de ' . $ProjetDebut;
    }

    $Experience = $experience[0];
    $Exp_Position = $Experience->Position;
    $Exp_Entrprise = $Experience->Enterprise;
    $Exp_Debut = date("F Y", strtotime($Experience->Debut));
    if ($Experience->Fin > date('Y-m-d')) {
        $Exp_Fin = '';
        $Exp_Debut = 'depuis ' . $Exp_Debut;
    } else {
        $Exp_Fin = 'à ' . date("F Y", strtotime($Experience->Fin));
        $Exp_Debut = 'de ' . $Exp_Debut;
    }

    $paragraph = "Etant $EducationPosition en $EducationTypeFormation à $EducationEntreprise, je suis actuellement à la recherche d'une opportunité professionnelle. 
    J'ai récemment acquis une expérience professionnelle significative en tant que $Exp_Position chez $Exp_Entrprise de $Exp_Debut$Exp_Fin.";

    if ($EducationPosition == 'diplômé') {
        $paragraph .= " J'ai récemment terminé mon projet de fin d'études intitulé $ProjetNom, réalisé de $ProjetDebut$ProjetFin.";
    } 
    if ($ProjetFin > date('Y-m-d')) {
        $paragraph .= " Je suis actuellement en train de travailler sur un projet intitulé $ProjetNom, réalisé de $ProjetDebut$ProjetFin.
        Ce projet se fait dans le cadre de mon cursus en $EducationTypeFormation à $EducationEntreprise.";
    } else {
        $paragraph .= " J'ai récemment travaillé sur un projet intitulé $ProjetNom, réalisé de $ProjetDebut$ProjetFin.
        Ce projet s'est fait dans le cadre de mon cursus en $EducationTypeFormation à $EducationEntreprise.";
    }

    return $paragraph;

}
?>

</html>

