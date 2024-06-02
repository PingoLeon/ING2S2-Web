<div class="container" id="background" style="padding: 15px">
    <div class="container" id="main_bloc">
        <div class="row">
            <br><br><br>
            <?php
            echo'<h4 style="margin: 15px">'.$data['Intitulé'].'</h4>';
            
            //prendre le début de la semaine et la fin pour les comparer aux dates des évènements
            $currentWeekStart = strtotime('monday this week'); 
            $currentWeekEnd = strtotime('sunday this week');

            //affichage que si l'évènement a un intitulé + semaie actuelle
            if ((strtotime($data['Début']) >= date('Y-m-d', $currentWeekStart) || strtotime($data['Fin']) <= date('Y-m-d', $currentWeekEnd))&&($data['Intitulé']!=NULL)) {

                echo '<div id="carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">';
                for ($i = 1; $i <= 3; $i++) {
                    echo '<div class="carousel-item';
                    if ($i === 1) {
                        echo ' active';
                    }
                    echo '">
                        <img src="../Profil_entreprises/photo_events/'.$data['Photo'].'.'.$i.'.png" width="940" height="630"/></li> 
                        </div>';
                }
                echo '</div>
                </div>';

                  
            } 
            else {
                echo '<p style="margin: 15px">Il n\'y a pas d\'évènements cette semaine.</p>';
            }
            ?>
            
        </div>
    </div>
</div>
<br><br><br>
</div>