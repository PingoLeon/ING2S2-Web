<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>A propos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 

    <link rel="stylesheet" type="text/css" href="details.css">
</head>
<body>


<div class="container" id="background" style="padding : 15px">
<div class="container" id="main_bloc">
    <div class="row">
        <br><br><br>
        <h1 style ="margin:15px">Présentation</h1>
        <p style ="margin:15px"><?php echo $xml->informations->Information; ?></p>
    </div>

    <br><br>
        <h5>Site Web</h5>
        <a href="<?php echo $xml->informations->Site_Web; ?>" >apple.com/careers</a><br><br>

        <h5>Taille de l'entreprise</h5>
        <p><?php echo $xml->informations->Taille; ?></p><br>
        <h5>Telephone</h5>
        <p><?php echo $xml->informations->Telephone; ?></p><br>
        <h5>Année de création</h5>
        <p><?php echo $xml->informations->Anne_Fondation; ?></p>

        <br><br>   

        
        </div></div></div>

        <div class="container" id="background" style="padding : 15px">
            <div class="container" id="main_bloc">
                <div class="row">
                    <h1 style="margin:15px">Lieux(1)</h1>
                    <br><br>
                    <div id="map" style="width: 100%; height: 100vh;">
                        <iframe src="<?php echo $xml->informations->Lieu: ?>" style="width: 100%; height: 100%;" frameborder="0" allowfullscreen></iframe>
                    </div>
                    </div></div></div>

</body>

</html>
