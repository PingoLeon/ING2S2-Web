<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="SiteEmplois.css">
    <title>Notifications des Emplois Disponibles</title>
</head>
<body>
    <?php include '../Main/Header.php'; ?>

    <div class="container mt-5">
        <h2>Créer une Nouvelle Offre d'Emploi</h2>
        <form id="offreForm" enctype="multipart/form-data">
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
        
        <div id="newCompanyForm" style="display: none;">
            <h2>Ajouter une Nouvelle Entreprise</h2>
            <form id="newCompany" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="paysEntreprise">Pays de l'Entreprise</label>
                    <input type="text" class="form-control" id="paysEntreprise" name="paysEntreprise" required>
                </div>
                <div class="form-group">
                    <label for="industrieEntreprise">Industrie</label>
                    <input type="text" class="form-control" id="industrieEntreprise" name="industrieEntreprise" required>
                </div>
                <div class="form-group">
                    <label for="nomTuteur">Nom du Tuteur</label>
                    <input type="text" class="form-control" id="nomTuteur" name="nomTuteur" required>
                </div>
                <div class="form-group">
                    <label for="photoEntreprise">Photo de l'Entreprise</label>
                    <input type="file" class="form-control-file" id="photoEntreprise" name="photoEntreprise" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter l'Entreprise</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#offreForm').on('submit', function(event){
                event.preventDefault();
                var nomEntreprise = $('#nomEntreprise').val();
                $.ajax({
                    url: 'Test_VerificationListeEntreprise.php',
                    method: 'POST',
                    data: {nomEntreprise: nomEntreprise},
                    success: function(response){
                        if(response.exists){
                            $('#offreForm').off('submit').submit();
                        } else {
                            $('#newCompanyForm').show();
                        }
                    }
                });
            });

            $('#newCompany').on('submit', function(event){
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'Test_AjoutCompagnie.php',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.success){
                            $('#newCompanyForm').hide();
                            $('#offreForm').off('submit').submit();
                        } else {
                            alert('Erreur lors de l\'ajout de la nouvelle entreprise.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
