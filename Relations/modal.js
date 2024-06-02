function openModal(sql, user_id_relation, isExistingRelation, display_button, callback) {
    
    const modal = document.getElementById("profileModalCustom");
    const span = document.getElementsByClassName("close-custom")[0];
    const modalContentCustom = document.getElementById("modalContentCustom");
    const container = document.querySelector('.container'); // Déjà existant
    const header = document.querySelector('header'); // Ajouté

    // AJAX call to fetch data based on SQL and ID
    fetch(`fetch_data.php?sql=${encodeURIComponent(sql)}&id=${user_id_relation}`)
        .then(response => response.json())
        .then(data => {
        modalContentCustom.innerHTML = callback(data, user_id_relation, isExistingRelation, display_button);
        modal.style.display = "block";
        container.classList.add('background'); // Déjà existant
        header.classList.add('background'); // Ajouté
    });

    span.onclick = function() {
        modal.style.display = "none";
        container.classList.remove('background'); // Déjà existant
        header.classList.remove('background'); // Ajouté
    }

    window.onclick = function(event) {
        if (event.target == modal) {
        modal.style.display = "none";
        container.classList.remove('background'); // Déjà existant
        header.classList.remove('background'); // Ajouté
        }
    }   
}

function profileModalContent(data, user_id_relation, isExistingRelation, display_button) {
    const prenom = data.user.Prenom;
    const nom = data.user.Nom;
    const mail = data.user.Mail;
    let photo = data.user.Photo;
    const id = data.user.ID;
    const user_id = user_id_relation;

    const education = data.education.map(edu => ({
        ...edu,
        Nom_Entreprise: edu.Nom_Entreprise,
        Logo: edu.Logo,
        Debut: edu.Debut,
        Fin: edu.Fin
    }));

    const experience = data.experience.map(exp => ({
        ...exp,
        Nom_Entreprise: exp.Nom_Entreprise,
        Logo: exp.Logo,
        Debut: exp.Debut,
        Fin: exp.Fin
    }));

    const projects = data.projects.map(proj => ({
        ...proj,
        Edu_Name: proj.Edu_Name,
        Debut: proj.Debut,
        Fin: proj.Fin
    }));

    let educationDetails = '';
    for (let edu of education) {
        educationDetails += `<p>${edu.Nom_Entreprise}: ${edu.Debut} - ${edu.Fin}</p>`;
    }

    let experienceDetails = '';
    for (let exp of experience) {
        experienceDetails += `<p>${exp.Nom_Entreprise}: ${exp.Debut} - ${exp.Fin}</p>`;
    }

    let projectsDetails = '';
    for (let proj of projects) {
        projectsDetails += `<p>${proj.Edu_Name}: ${proj.Debut} - ${proj.Fin}</p>`;
    }
    
    if (photo === "" || photo === null || photo === undefined) {
        photo = "../Photos/photo_placeholder.png";
    }
    let addButton = '';
    if (display_button === false) {
        addButton = '';
    }else{
        if (isExistingRelation === false) {
            addButton = `
                        <div class="d-flex justify-content-center mt-3">
                            <form method="post">
                                <input type="hidden" name="user_id" value="${user_id}">
                                <input type="submit" name="create_relation" value=" Créer une relation" class="btn btn-info btn-lg">
                            </form>
                        </div>
            `;
        }else if (isExistingRelation === true){
            addButton = `
                        <div class="d-flex justify-content-center mt-3">
                            <form method="post">
                                <input type="hidden" name="user_id" value="${user_id}">
                                <input type="submit" name="delete_relation" value=" Supprimer la relation" class="btn btn-danger btn-lg">
                            </form>
                        </div>
            `;
        }
    }

    return `
        <div style="display: flex; background-color: white; margin-left: 200px; margin-right: 200px; min-height:70vh;">
            <div class="col-modal-left">
                <img src="${photo}" alt="Photo de profil" width="300px" height="300px">
                <br>
                <br>
                <h2 style="padding: 10px;">Contact</h2>
                <p style="padding: 10px;">${mail}</p>
            </div>
            <div style="flex: right;">
                <h1 class="nomprenom">${prenom} ${nom}</h1>
                <h2>Education</h2>
                ${educationDetails}
                <h2>Experience</h2>
                ${experienceDetails}
                <h2>Projects</h2>
                ${projectsDetails}
            
                <div class="button-container">
                    <div class="d-flex justify-content-center mt-3">
                        <a href='../Profile/CV_affichage.php?user_id=${user_id}' class='btn btn-primary btn-lg'>Générer un CV de l'utilisateur</a>
                    </div>
                    ${addButton}
                </div>

            </div>
        
        <style>
            .col-modal-left{
                margin-right: 20px;
            }
        
        </style>
    `;
}