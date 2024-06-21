$(document).ready(function () {
  $('#updateUserForm').submit(function (e) {
    e.preventDefault(); // Evita a submissão normal do formulário

    // Obtém os dados do formulário
    var formData = $(this).serialize();
    function showToast(options) {
      Toastify({
        text: options.text,
        duration: options.duration || 1500,
        close: options.close === undefined ? true : options.close,
        position: options.position || 'top-right', // Combinação correta para a posição
        className: options.className || ''
      }).showToast();
    }
    // Envia a requisição AJAX
    $.ajax({
      type: 'POST',
      url: 'updateuser.php', // Arquivo PHP onde o formulário será submetido
      data: formData,
      success: function (response) {
        // Processa a resposta do servidor
        if (response.trim() === 'success') {
          showToast({
            text: 'Dados atualizados com sucesso!',
            duration: 1500,
            position: 'top-right', // Certifique-se de que está definido corretamente
            close: true // Mostrar o botão de fechar
          });
          setTimeout(function () {
            window.location.href = 'uadmin.php';
          }, 1500)
        } else if (response.trim() === 'error') {
          // Mostra mensagem de erro ou executa ação para login falhou
          showToast({
            text: 'Não deu para atualizar os dados!',
            duration: 1500,
            position: 'top-right', // Certifique-se de que está definido corretamente
            close: true // Mostrar o botão de fechar
          });
        } else if (response.trim() === 'missing') {
          showToast({
            text: 'Todos os campos são de preenchimento obrigatório!',
            duration: 1500,
            position: 'top-right', // Certifique-se de que está definido corretamente
            close: true // Mostrar o botão de fechar
          });
        }

      }
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {

    var modalUser = document.getElementById('modalUser');
    modalUser.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-bs-whatever');

    var nome = button.getAttribute('data-nome');
    var email = button.getAttribute('data-email');
    var password = button.getAttribute('data-password');
    var apelido;

    var modalTitle = modalUser.querySelector('.modal-title');
    var userNome = modalUser.querySelector('#nomeUp');
    var userApelido = modalUser.querySelector('#apelidoUp')
    var userEmail = modalUser.querySelector('#emailUp');
    var userPass = modalUser.querySelector('#passUp');

    const arrayNome = nome.split(" ");

    if(id){

      nome = arrayNome[0];
      apelido = arrayNome[1];


      modalTitle.textContent = 'Editar User';
      userNome.value = nome;
      userApelido.value = apelido;
      userEmail.value = email;
      userPass.value = password;

    }

  });
});




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
*/
