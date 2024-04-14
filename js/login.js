document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the entered username and password
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Load the JSON file containing user credentials
    fetch("js/users.json")
    .then(response => response.json())
    .then(data => {
        // Check if the entered email and password match any user in the JSON file
        var user = data.users.find(u => u.email === email && u.password === password);
        if (user) {
            alert("Login successful!");
            window.location.href = "admin.html";
            // You can redirect the user to another page after successful login if needed
            // window.location.href = "dashboard.html";
        } else {
            alert("Invalid username or password. Please try again.");
        }
    })
    .catch(error => {
        console.error("Error loading user data:", error);
        alert("An error occurred. Please try again later.");
    });
});
