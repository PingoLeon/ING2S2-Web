<?php
//echo '$result = mysqli_query($db_handle, $sql);';
$sql1 = 'SELECT * FROM events WHERE Enterprise_ID = '.$entre_id.' ORDER BY Date_publication DESC';
$result = mysqli_query($db_handle, $sql1);
$event = mysqli_fetch_assoc($result);

if (($event['Intitulé']!=NULL) && ($event['Début']!= '0000-00-00' )&&($event['Fin']!= '0000-00-00')&&($event['Texte']!=NULL)&&($event['Photo']!=NULL)&&($event['Date_publication']!=NULL)){

    foreach ($result as $event) {
        echo'<div class="container" id="background" style="padding: 15px">';
        echo'<div class="container" id="main_bloc">';
        echo'<div class="row">';
        
        echo '<i><p style="color:grey "> Publié le '. $event['Date_publication'] . '</p></i><br>';
        echo '<h1 style="margin: 15px">' . $event['Intitulé'] . '</h1>';
        echo '<p style="margin: 15px">' . $event['Texte'] . '</p>';
        
        if (($event['Début']!= '0000-00-00' )&&($event['Fin']!= '0000-00-00')){
            echo '<p style="margin: 15px">📍📅 Retrouvez-nous du ' . $event['Début'] . ' jusqu\'au ' . $event['Fin'] . '.</p>';
        }
    
        echo '<img class="image" src="../Profil_entreprises/photo_events/' . $event['Photo'] . '" style="margin: auto; max-width: 100%; height: auto;">';
        
        echo'</div>';
        echo'</div>';
        echo'</div>';

    }
}
?>
<br><br><br>
