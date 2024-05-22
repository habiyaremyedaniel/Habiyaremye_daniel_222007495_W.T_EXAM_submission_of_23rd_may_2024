// Function to validate the login form inputs
function validateForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var usernameError = document.getElementById("usernameError");
    var passwordError = document.getElementById("passwordError");
    var isValid = true;

    // Reset previous error messages
    usernameError.textContent = "";
    passwordError.textContent = "";

    // Check if username is empty
    if (username === "") {
        usernameError.textContent = "Username is required";
        isValid = false;
    }

    // Check if password is empty
    if (password === "") {
        passwordError.textContent = "Password is required";
        isValid = false;
    }

    return isValid;
}

// Function to display error message for invalid login attempt
function displayLoginError() {
    alert("Invalid username or password. Please try again.");
}

// Add event listener to display login error message on form submission
document.addEventListener("DOMContentLoaded", function () {
    var loginForm = document.getElementById("loginForm");
    loginForm.addEventListener("submit", function (event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
            displayLoginError();
        }
    });
});
