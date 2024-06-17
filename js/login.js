/**document.getElementById("login-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Recebe o email e password do formulário
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Carrega o ficheiro JSON com os dados de utilizadores
    fetch("../js/users.json")
    .then(response => response.json())
    .then(data => {
        // Verifica se os dados recebidos do formulário correspondem aos do ficheiro JSON
        var user = data.users.find(u => u.email === email && u.password === password);
        if (user) {
            //Criação de um Toast
            Toastify({
                text: "Utilizador logado com sucesso!",
                duration: 3000,
                close: true,
                gravity: "top",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                callback: function() {
                    window.location.href = "index.html";
                }
            }).showToast();
        } else {
            Toastify({
                text: "Dados incorretos ou inexistentes, tente outra vez!",
                duration: 3000,
                close: true,
                gravity: "top",
                backgroundColor: "linear-gradient(to right, #ff0000, #ff0000)"
            }).showToast();
        }
    })
    .catch(error => {
        console.error("Error loading user data:", error);
        alert("An error occurred. Please try again later.");
    });
});
$(document).ready(function() {
    function showToast(options) {
        Toastify({
            text: options.text,
            duration: options.duration || 3000,
            close: options.close === undefined ? true : options.close,
            position: options.position || 'top-right', // Combinação correta para a posição
            className: options.className || 'criada'
        }).showToast();
    }

    const urlParams = new URLSearchParams(window.location.search);
    const contaCriadaParam = urlParams.get('criada');
    const contaCriada = contaCriadaParam === 'true';

    if (contaCriada) {
        showToast({
            text: 'Conta criada com sucesso!',
            duration: 3000,
            position: 'top-right', // Certifique-se de que está definido corretamente
            close: true // Mostrar o botão de fechar
        });
        setTimeout(function(){
            window.location.href = 'index.php';
        }, 3000)
    }
});

**/