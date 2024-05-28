<?php
$adresse = "42 avenue marcel martinie, Vanves, France"; // Remplacez par l'adresse souhaitée
$url = "https://maps.app.goo.gl/A5uFh99udQR1jd389" . urlencode($adresse);
$json = file_get_contents($url);
$data = json_decode($json, true);

if ($data["status"] == "OK") {
    $latitude = $data["results"][0]["geometry"]["location"]["lat"];
    $longitude = $data["results"][0]["geometry"]["location"]["lng"];
    echo "Latitude : $latitude, Longitude : $longitude";
} else {
    echo "Erreur lors de la géolocalisation.";
}
?>
