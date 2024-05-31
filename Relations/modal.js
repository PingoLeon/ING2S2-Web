
function openModal(sql, id, modalContentCallback) {
    const modal = document.getElementById("profileModal");
    const span = document.getElementsByClassName("close")[0];
    const modalContent = document.getElementById("modalContent");

    // AJAX call to fetch data based on SQL and ID
    fetch(`fetch_data.php?sql=${encodeURIComponent(sql)}&id=${id}`)
        .then(response => response.json())
        .then(data => {
        modalContent.innerHTML = modalContentCallback(data);
        modal.style.display = "block";
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
        modal.style.display = "none";
        }
    }   
}

function profileModalContent(data) {
    const prenom = data.Prenom;
    const nom = data.Nom;
    const mail = data.Mail;
    const photo = data.Photo;

    return `
        <div style="display: flex;">
            <div class="col-modal-left">
                <img src="${photo}" alt="Photo de profil" width="300px" height="300px">
                <br>
                <br>
                <h2>Contact</h2>
                <p>${mail}</p>
            </div>
            <div style="flex: right;">
                <h1>${prenom} ${nom}</h1>
            </div>
        </div>
        
        <style>
            .col-modal-left{
                margin-right: 20px;
            }
        
        </style>
    `;
}
