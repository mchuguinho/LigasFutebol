//----------------------------------------------------------------------------- METER AS LIGAS NO CARD -------------------------------------------------------------------------------------
/*
fetch("js/leagues.json")
  .then((response) => response.json())
  .then((data) => {
    const leaguesContainer = document.getElementById("leagues");
    // Generate HTML for league cards
    data.leagues.forEach((league) => {
      // Create league card HTML

      const ligastabela = `
        <tr>
        <th class="align-middle">${league.id}</th>
        <td class="align-middle"><img id="imagemAdmin"class="img-fluid logocircular" src="${league.image}"></td>
        <td class="align-middle">${league.name}</td>
        <td class="align-middle"><button type="button" class="btn btn-primary btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalLiga" data-bs-whatever="${league.name}">Editar</button></td>
        <td class="align-middle"><button type="button" class="btn btn-primary btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalClub" data-bs-whatever="${league.name}">Editar Clubes</button></td>
        <td class="align-middle"><a class="btn btn-danger btn-outline-light" onclick="showAlertEliminado()" role="button">Eliminar</a></td>
        </tr>
        `;

      // Append league card HTML to container
      document.getElementById("leagues").innerHTML += ligastabela;
    });
  })
  .catch((error) => console.error("Error loading JSON:", error));

*/
//----------------------------------------------------------------------------- METER OS CLUBS NA MODAL -------------------------------------------------------------------------------------

var exampleModal = document.getElementById("modalClub");

exampleModal.addEventListener("show.bs.modal", function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget;
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute("data-bs-whatever");
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //

  fetch("js/leagues.json")
    .then((response) => response.json())
    .then((data) => {
      // Generate HTML for league cards
      data.leagues
        .find((league) => league.name === recipient)
        ?.teams?.forEach((team) => {
          // Create league card HTML
          const clubData = JSON.stringify(team);

          // Append league card HTML to container

          const clubestabela = `
        <tr>
        <td class="align-middle"><img class="img-fluid logocircular" src="${team.image}"></td>
        <td class="align-middle">${team.name}</td>
        <td class="align-middle">${team.city}</td>
        <td class="align-middle">${team.foundation}</td>
        <td class="align-middle"><button type="button" class="btn btn-primary btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalClubSolo" data-bs-whatever="${team.name}">Editar</button></td>
        <td class="align-middle"><a class="btn btn-danger btn-outline-light" onclick="showAlertEliminado()" role="button">Eliminar</a></td>
        </tr>
        `;
          document.getElementById("mClub").innerHTML += clubestabela;
        });
    })
    .catch((error) => console.error("Error loading JSON:", error));

  // Update the modal's content.
  var modalTitle = exampleModal.querySelector(".modal-title");

  modalTitle.textContent = "Gestor de clubes da " + recipient;
});

exampleModal.addEventListener("hidden.bs.modal", function (event) {
  //limpar o modal
  document.getElementById("mClub").innerHTML = "";
});

//--------------------------------------------- MODAL DE EDITAR A CHAMAR O NOME DO CLUBE PARA RECONHECIMENTO (FUTURAS EDIÇÔES AINDA PRECISA SER COMPLETADO) ----------------------------------------------------


var exampleModal3 = document.getElementById("modalClubSolo");

exampleModal3.addEventListener("show.bs.modal", function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget;
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute("data-bs-whatever");
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //

  // Update the modal's content.
  var modalTitle = exampleModal3.querySelector(".modal-title");

  modalTitle.textContent = "Editar Clube: " + recipient;
});


//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


var exampleModal = document.getElementById("modalLiga");

exampleModal.addEventListener("show.bs.modal", function (event) {
  var button = event.relatedTarget;
  var recipient = button.getAttribute("data-bs-whatever");
  var modalTitle = exampleModal.querySelector(".modal-title");

  modalTitle.textContent = "Editar Liga: " + recipient;

  var idInput = exampleModal.querySelector("#id_liga");
  idInput.value = recipient;
});

document.getElementById("saveChangesButton").addEventListener("click", function() {
  document.getElementById("updateLigaForm").submit();
});


//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

function showAlertEliminado() {
  Toastify({
    text: "Dados eliminados com sucesso!",
    duration: 3000,
    close: true,
    gravity: "top",
    backgroundColor: "linear-gradient(to right, #ff0000, #ff0000)",
  }).showToast();
  
}

function showAlertGuardado() {
  Toastify({
    text: "Dados alterados com sucesso!",
    duration: 3000,
    close: true,
    gravity: "top",
    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",

    callback: function() {
      window.location.href = "admin.html";
  }

  }).showToast();
  
}
