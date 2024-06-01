<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>A propos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 

    <link rel="stylesheet" type="text/css" href="details.css">
    <link rel="stylesheet" type="text/css" href="../Main/Header.css">
</head>
<body>


<div class="container" id="background" style="padding : 15px">
<div class="container" id="main_bloc">
    <div class="row">
        <br><br><br>
        <h1 style ="margin:15px">Présentation</h1>
        <?php echo'<p style ="margin:15px"> '.$data['Informations'].' ';?></p>
    </div>

    <br><br>
        <h5>Site Web</h5>
        <?php echo'<a href="'.$data['Site_Web'].'">'.$data['Site_Web'].'</a>';?><br><br>

        <h5>Taille de l'entreprise</h5>
        <?php echo'<p>'.$data['Taille'].'';?></p><br>
        <h5>Téléphone</h5>
        <?php echo'<p>'.$data['Telephone'].'';?></p><br>
        <h5>Année de création</h5>
        <?php echo'<p> '.$data['Annee_Fondation'].''; ?></p>

        <br><br>   

        
        </div></div></div>

        <div class="container" id="background" style="padding : 15px">
            <div class="container" id="main_bloc">
                <div class="row">
                    <h1 style="margin:15px">Lieux(1)</h1>
                    <br><br>
                    <div id="map" style="width: 100%; height: 100vh;">
                       
                        <?php
                        echo '<iframe src="'.$data['Lieu'].'" style="width: 100%; height: 100%;" frameborder="0" allowfullscreen></iframe>';
                        ?>
                    </div>
                    </div></div></div>

</body>

</html>
