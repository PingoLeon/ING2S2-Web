<!DOCTYPE html>
<html>
<head>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CV.css">
  <link rel="stylesheet" href="../Main/Site.css">
</head>

<body>
    <?php $xml = Creation_XML(); ?>
    <!-- div size of A4 paper -->
    <div style="width: 21cm; height: 29.7cm; margin: 30px auto; border: 1px solid #D3D3D3; background: white; padding: 20px;">
        <div class="container">
            <div class="leftPanel">
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
                                echo '<span class="bolded white">';
                                echo $project->Nom;
                                echo '</span>';
                                echo '<br>';
                                echo $project->Edu_Name;
                                echo '<br>';
                                echo $project->Debut . ' - ' . $project->Fin;
                                echo '</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>



            <div class="rightPanel">
                <div>
                    <h1>
                        <?php echo $xml->User->Prenom . ' ' . $xml->User->Nom; ?>
                    </h1>
                    <div class="smallText">
                        <h3>
                            <?php
                                $last_education = $xml->Education->Edu[count($xml->Education->Edu) - 1];
                                echo $last_education->Type_formation;
                            ?>
                        </h3>
                    </div>
                </div>
                <div>
                    <h2>
                        About me
                    </h2>
                    <div class="smallText">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris venenatis, justo sed feugiat pulvinar., quam ipsum tincidunt enim, ac gravida est metus sit amet neque. Curabitur ut arcu ut nunc finibus accumsan id id elit.
                        </p>
                        <p>
                            Vivamus non magna quis neque viverra finibus quis a tortor.
                        </p>
                    </div>
                </div>
                <br>
                <div class="workExperience">
                    <h2>
                        Work experience
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
                <div class="workExperience">
                    <h2>
                        Education
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
</html>