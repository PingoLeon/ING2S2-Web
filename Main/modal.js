// modal.js
function openModal(sql, id, modalContentCallback) {
    const modal = document.getElementById("genericModal");
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
  