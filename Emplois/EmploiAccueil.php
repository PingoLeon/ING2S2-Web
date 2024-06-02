<?php

include "../Auth/functions.php";
list($user_id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();

$sql = "SELECT Entreprise_ID FROM utilisateur WHERE User_ID = '$user_id'"; // on 
$result = mysqli_query($db_handle, $sql);
$id_entreprise = mysqli_fetch_assoc($result)['Entreprise_ID'];

if ($id_entreprise > 0 && $id_entreprise != -1) {
    header("Location: ../Emplois/FormulaireOffreEmploi.php");
    ob_end_flush();
    exit();
} elseif ($id_entreprise == 0) {
    header("Location: ../Emplois/PageOffreEmploi.php");
    ob_end_flush();
    exit();
} elseif ($id_entreprise == -1) {
    header("Location: ../Emplois/FormulaireOffreEmploi.php");
    ob_end_flush();
} else {
    echo "Erreur : id_entreprise a une valeur inattendue.";
}

?>
