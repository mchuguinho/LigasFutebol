document.getElementById("registo-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the entered username and password
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var nome = document.getElementById("nome").value;
    var apelido = document.getElementById("apelido").value;

    // Prepare the new user object
    var user = { email: email, password: password, nome: nome,apelido: apelido };

    // Load the JSON file containing existing user data (if any)
    fetch("js/users.json")
    .then(response => response.json())
    .then(data => {
        // verificar se já existe algum utilizador
        var existeAlgum = data.users.find(u => u.email === email);
        if (existeAlgum) {
            alert("Já existe um utilizador com esse email! Tente dar login!");
        } else {
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
                alert("Registration successful!");
                // Optionally, redirect the user to the login page after registration
                // window.location.href = "login.html";
            })
            .catch(error => {
                console.error("Error registering new user:", error);
                alert("An error occurred. Please try again later.");
            });
        }
    })
    .catch(error => {
        console.error("Error loading user data:", error);
        alert("An error occurred. Please try again later.");
    });
});