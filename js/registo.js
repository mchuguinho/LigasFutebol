/**document.getElementById("registo-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission

    // vou buscar os valores
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var passwordC = document.getElementById("passwordC").value;
    var nome = document.getElementById("nome").value;
    var apelido = document.getElementById("apelido").value;

    //verifico se as passes estão iguais
    if (password != passwordC) {

        alert("As palavras passes são diferentes!!")

    } else {



        // Load the JSON file containing existing user data (if any)
        fetch("../js/users.json")
            .then(response => response.json())
            .then(data => {

                // verificar se já existe algum utilizador
                var existeAlgum = data.users.find(u => u.email === email);


                if (existeAlgum) {
                    alert("Já existe um utilizador com esse email! Tente dar login!");

                    window.location.href = "./login.html";
                } else {

                    // cria variavel com dados do json
                    var usersL = data.users;

                    //verifica a quantidade de users e adiciona mais 1 para criar o id superior
                    var counterId = usersL.length + 1;

                    //crio o user
                    var user = { email: email, password: password, nome: nome, apelido: apelido, id: counterId };
                    console.log(user);
                    // adiciono user
                    data.users.push(user);

                    // supostamente devia estar a funcionar
                    fetch("js/users.json", {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })

                        .then(() => {
                            alert("Registado com Sucesso!");
                            window.location.href = "login.html";
                        })

                        .catch(error => {
                            console.error("Erro ao registar:", error);
                            alert("Ocurreu um erro!! Tente de novo! :c");
                        });
                }
            })
    }

});

**/

$(document).ready(function() {
    function showToast(options) {
        Toastify({
            text: options.text,
            duration: options.duration || 3000,
            close: options.close === undefined ? true : options.close,
            position: options.position || 'top-right', // Combinação correta para a posição
            className: options.className || 'jaexisteemail'
        }).showToast();
    }

    const urlParams = new URLSearchParams(window.location.search);
    const emailJaExisteParam = urlParams.get('jaexiste');
    const emailJaExiste = emailJaExisteParam === 'true';

    if (emailJaExiste) {
        showToast({
            text: 'Este email já está registado!',
            duration: 3000,
            position: 'top-right', // Certifique-se de que está definido corretamente
            close: true // Mostrar o botão de fechar
        });
    }
});
