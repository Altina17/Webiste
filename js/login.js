const loginForm = document.getElementById("loginForm");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordError");
const successMessage = document.getElementById("successMessage");

loginForm.addEventListener("submit", function (e) {
    e.preventDefault();

    let valid = true;

    emailError.textContent = "";
    passwordError.textContent = "";

    const email = emailInput.value.trim();
    const password = passwordInput.value;


    if (email === "") {
        emailError.textContent = "Please enter your email.";
        valid = false;
        return;
    } else if (email.length < 10) {
        emailError.textContent = "Email must be at least 10 characters long.";
        valid = false;
    } else if (!email.includes("@")) {
        emailError.textContent = "Email must contain the @ symbol.";
        valid = false;
    } else if (!email.includes(".")) {
        emailError.textContent = "Email must contain a domain (example: .com).";
        valid = false;
    }


    if (password === "") {
        passwordError.textContent = "Please enter your password.";
        valid = false;
    } else if (password.length < 8) {
        passwordError.textContent = "Password must be at least 8 characters long.";
        valid = false;
    } else if (!/[A-Z]/.test(password)) {
        passwordError.textContent = "Password must contain at least one uppercase letter.";
        valid = false;
    } else if (!/[a-z]/.test(password)) {
        passwordError.textContent = "Password must contain at least one lowercase letter.";
        valid = false;
    } else if (!/\d/.test(password)) {
        passwordError.textContent = "Password must contain at least one number.";
        valid = false;
    } else if (!/[@$!%*?&]/.test(password)) {
        passwordError.textContent = "Password must contain at least one special character.";
        valid = false;
    }

    successMessage.textContent = "Login successful!";
    loginForm.reset();

});
