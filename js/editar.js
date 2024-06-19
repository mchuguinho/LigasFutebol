document.addEventListener('DOMContentLoaded', function () {
    var modalClube = document.getElementById('modalClube');
    modalClube.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var id = button.getAttribute('data-bs-whatever');
      var nome = button.getAttribute('data-nome');
      var logo = button.getAttribute('data-logo');
      var cidade = button.getAttribute('data-cidade');
      var fundacao = button.getAttribute('data-fundacao');

      var modalTitle = modalClube.querySelector('.modal-title');
      var clubeId = modalClube.querySelector('#id_clubeInp');
      var clubeNome = modalClube.querySelector('#clubeNome');
      var clubeLogo = modalClube.querySelector('#clubeLogo');
      var clubeCidade = modalClube.querySelector('#clubeCidade');
      var clubeFundacao = modalClube.querySelector('#clubeFund');

      if (id) {
        modalTitle.textContent = 'Editar Clube';
        clubeId.value = id;
        clubeNome.value = nome;
        clubeLogo.value = logo;
        clubeCidade.value = cidade;
        clubeFundacao.value = fundacao;
      } else {
        modalTitle.textContent = 'Adicionar Clube';
        clubeId.value = '';
        clubeNome.value = '';
        clubeLogo.value = '';
        clubeCidade.value = '';
        clubeAction.value = 'criarClube';
      }
    });
  });

  $(document).ready(function () {
    $('#updateClubForm').submit(function (e) {
      e.preventDefault(); // Evita a submissão normal do formulário

      // Obtém os dados do formulário
      var formData = $(this).serialize();
      console.log("Dados do formulário: ", formData);  // Adicione esta linha

      // Função para mostrar notificações
      function showToast(options) {
        Toastify({
          text: options.text,
          duration: options.duration || 3000,
          close: options.close === undefined ? true : options.close,
          position: options.position || 'top-right',
          className: options.className || ''
        }).showToast();
      }

      // Envia a requisição AJAX
      $.ajax({
        type: 'POST',
        url: 'updateclube.php', // Arquivo PHP onde o formulário será submetido
        data: formData,
        success: function (response) {
          // Processa a resposta do servidor
          if (response.trim() === 'success') {
            showToast({
              text: 'Clube atualizado com sucesso!',
              duration: 1500,
              position: 'top-right',
              close: true // Mostrar o botão de fechar
            });
            setTimeout(function () {
              window.location.href = 'admin.php';
            }, 1500);
          } else if (response.trim() === 'error') {
            showToast({
              text: 'Não deu para atualizar os dados!',
              duration: 1500,
              position: 'top-right',
              close: true // Mostrar o botão de fechar
            });
          }
        }
      });
    });
  });
