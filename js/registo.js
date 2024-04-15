document.getElementById("registo-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the entered username and password
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var passwordC = document.getElementById("passwordC").value;
    var nome = document.getElementById("nome").value;
    var apelido = document.getElementById("apelido").value;


    if(email === "" || password === "" || passwordC === "" || nome === "" || apelido === ""){

        alert("Faltam campos serem preenchidos!! ")

    }else{

        if(password != passwordC){

            alert("As palavras passes são diferentes!!")
    
        }else{
    
            
    
            // Load the JSON file containing existing user data (if any)
            fetch("js/users.json")
            .then(response => response.json())
            .then(data => {
                // verificar se já existe algum utilizador
                var existeAlgum = data.users.find(u => u.email === email);
                if (existeAlgum) {
                    alert("Já existe um utilizador com esse email! Tente dar login!");
                    window.location.href="./login.html";
                } else {

                    var counterId= 1;
                    var achouID = false;

                    do{
                        
                        if(data.users.find(u=> u.id === counterId)){
                            counterId++;
                        }

                        achouID=true;


                    }while( achouID === false){}

                    var user = { email: email, password: password, nome: nome,apelido: apelido, id: counterId};

                    // adicionar user
                    data.users.push(user);

                    // Write the updated JSON data back to the file
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
    



    }
    
    });