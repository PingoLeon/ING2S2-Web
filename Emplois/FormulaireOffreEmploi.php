<?php
    include '../Auth/functions.php';
    list($user_id, $email, $db_handle) = check_if_cookie_or_session_and_redirect_else_retrieve_id_mail_handle();
    logout_button_POST();

    // Récupérer les offres d'emploi de l'entreprise de l'utilisateur
    $job_offers = get_job_offers_by_company($db_handle, $user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="SiteEmplois.css">
    <title>Notifications des Emplois Disponibles</title>
</head>

<body>
    <?php include '../Main/Header.php'; ?>

    <div class="container mt-5">
        <h2>Créer une Nouvelle Offre d'Emploi</h2>
        <form action="CreationOffre.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nomEntreprise">Nom de l'Entreprise</label>
                <input type="text" class="form-control" id="nomEntreprise" name="nomEntreprise" required>
            </div>
            <div class="form-group">
                <label for="intitule">Intitulé</label>
                <input type="text" class="form-control" id="intitule" name="intitule" required>
            </div>
            <div class="form-group">
                <label for="debut">Date de Début</label>
                <input type="date" class="form-control" id="debut" name="debut" required>
            </div>
            <div class="form-group">
                <label for="fin">Date de Fin</label>
                <input type="date" class="form-control" id="fin" name="fin" required>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <div class="form-group">
                <label for="typeContrat">Type de Contrat</label>
                <input type="text" class="form-control" id="typeContrat" name="typeContrat" required>
            </div>
            <div class="form-group">
                <label for="logo">Logo de l'Entreprise</label>
                <input type="file" class="form-control-file" id="logo" name="logo" required>
            </div>
            <div class="form-group">
                <label for="texte">Texte de Motivation</label>
                <textarea class="form-control" id="texte" name="texte" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Créer l'Offre</button>
        </form>

        <h2 class="mt-5">Offres d'Emploi Existantes</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom de l'Entreprise</th>
                    <th>Intitulé</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Position</th>
                    <th>Type de Contrat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($job_offers as $offer): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($offer['nomEntreprise']); ?></td>
                        <td><?php echo htmlspecialchars($offer['intitule']); ?></td>
                        <td><?php echo htmlspecialchars($offer['debut']); ?></td>
                        <td><?php echo htmlspecialchars($offer['fin']); ?></td>
                        <td><?php echo htmlspecialchars($offer['position']); ?></td>
                        <td><?php echo htmlspecialchars($offer['typeContrat']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
