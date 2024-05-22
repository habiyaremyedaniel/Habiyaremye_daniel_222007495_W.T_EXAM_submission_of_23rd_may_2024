// Validation function
function validateForm() {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var phoneNumber = document.getElementById("phone_number").value;
    var role = document.getElementById("role").value;
    var bankId = document.getElementById("bank_id").value;
    var errors = [];

    if (username === "") {
        errors.push("Please enter your username!");
    }
    if (email === "") {
        errors.push("Please enter your email address!");
    }
    if (password === "") {
        errors.push("Please enter your password!");
    }
    if (phoneNumber === "") {
        errors.push("Please enter your phone number!");
    }
    if (role === "") {
        errors.push("Please enter the admin role!");
    }
    if (bankId === "") {
        errors.push("Please enter the bank ID!");
    }

    if (errors.length > 0) {
        // Display error messages
        var errorMessage = errors.join("<br>");
        document.getElementById("errorMessages").innerHTML = errorMessage;
        // Prevent form submission
        return false;
    }

    // Additional validation logic can be added here if needed

    return true;
}
