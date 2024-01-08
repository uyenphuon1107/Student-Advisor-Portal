// validate.js

function isValidEmail(email) {
    // Simple email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isNotEmpty(value) {
    return value.trim() !== "";
}

function validateLogin() {
    var email = document.getElementById("login_email").value;
    var password = document.getElementById("login_password").value;

    var emailError = document.getElementById("login_email_error");
    var passwordError = document.getElementById("login_password_error");

    if (!isValidEmail(email)) {
        emailError.innerHTML = "Invalid email format";
        return false;
    } else {
        emailError.innerHTML = "";
    }

    if (!isNotEmpty(password)) {
        passwordError.innerHTML = "Password cannot be empty";
        return false;
    } else {
        passwordError.innerHTML = "";
    }

    return true;
}

function validateSignup() {
    var name = document.getElementById("signup_name").value;
    var id = document.getElementById("signup_id").value;
    var email = document.getElementById("signup_email").value;
    var password = document.getElementById("signup_password").value;

    var nameError = document.getElementById("signup_name_error");
    var idError = document.getElementById("signup_id_error");
    var emailError = document.getElementById("signup_email_error");
    var passwordError = document.getElementById("signup_password_error");

    if (!isNotEmpty(name)) {
        nameError.innerHTML = "Name cannot be empty";
        return false;
    } else {
        nameError.innerHTML = "";
    }

    if (!isNotEmpty(id)) {
        idError.innerHTML = "Student ID cannot be empty";
        return false;
    } else {
        idError.innerHTML = "";
    }

    if (!isValidEmail(email)) {
        emailError.innerHTML = "Invalid email format";
        return false;
    } else {
        emailError.innerHTML = "";
    }

    if (password.length < 8) {
        passwordError.innerHTML = "Password must be at least 8 characters long";
        return false;
    } else {
        passwordError.innerHTML = "";
    }

    return true;
}

