//----------------------------------------------------------------------------- METER OS USERS NO CARD -------------------------------------------------------------------------------------
/*fetch("js/users.json")
  .then((response) => response.json())
  .then((data) => {
    // Generate HTML for league cards
    data.users.forEach((users) => {
      // Create league card HTML

      const usertabela = `
        <tr>
        <th class="align-middle">${users.id}</th>
        <td class="align-middle">${users.nome}</td>
        <td class="align-middle">${users.nome}</td>
        <td class="align-middle">${users.email}</td>
        <td class="align-middle">${users.password}</td>
        <td class="align-middle"><button type="button" class="btn btn-primary btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalUser" data-bs-whatever="${users.nome}">Editar User</button></td>
        <td class="align-middle"><a class="btn btn-danger btn-outline-light" onclick="showAlertEliminado()" role="button">Eliminar</a></td>
        </tr>
        `;

      // Append league card HTML to container
      document.getElementById("userAdmin").innerHTML += usertabela;
    });
  })
  .catch((error) => console.error("Error loading JSON:", error));
*/
//--------------------------------------------- MODAL DE EDITAR A CHAMAR O NOME DO ADMIN PARA RECONHECIMENTO (FUTURAS EDIÇÔES AINDA PRECISA SER COMPLETADO) ----------------------------------------------------

var exampleModal = document.getElementById("modalUser");

exampleModal.addEventListener("show.bs.modal", function (event) {
  var button = event.relatedTarget;
  var recipient = button.getAttribute("data-bs-whatever");
  var modalTitle = exampleModal.querySelector(".modal-title");

  document.getElementById("id_userInp").value= recipient;

  modalTitle.textContent = "Editar user: " + recipient;

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
    duration: 1500,
    close: true,
    gravity: "top",
    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",

    callback: function() {
      window.location.href = "uadmin.php";
  }

  }).showToast();
  


}
