




<div class="container" id="background" style="padding: 15px">
    <div class="container" id="main_bloc">
        <div class="row">
            <br><br><br>
            <?php
            echo'<h4 style="margin: 15px">'.$data['Intitulé'].'</h4>';
            $currentWeekStart = strtotime('monday this week');
            $currentWeekEnd = strtotime('sunday this week');


            if ((strtotime($data['Début']) >= date('Y-m-d', $currentWeekStart) || strtotime($data['Fin']) <= date('Y-m-d', $currentWeekEnd))) {
                // Display carousel of images
                // Replace the code below with your carousel implementation
                echo '<div id="carousel" class="carousel slide" data-ride="carousel">
                          <div class="carousel-inner">
                              <div class="carousel-item active">
                                  <img src="../Profil_entreprises/photo_events/'.$data['Photo'].'"style="margin: auto; max-width: 100%; height: auto";>
                              </div>
                          </div>
                      </div>';
            } else {
                // Display message for no events this week
                echo '<p style="margin: 15px">Il n\'y a pas d\'évènements cette semaine.</p>';
            }
            ?>
        </div>
    </div>
</div>
<br><br><br>
</div>