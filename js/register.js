const registerForm = document.getElementById("registerForm");

const fullnameInput = document.getElementById("fullname");
const usernameInput = document.getElementById("username");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const confirmPasswordInput = document.getElementById("confirmPassword");

const fullnameError = document.getElementById("fullnameError");
const usernameError = document.getElementById("usernameError");
const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordError");
const confirmPasswordError = document.getElementById("confirmPasswordError");
const successMessage = document.getElementById("successMessage");

registerForm.addEventListener("submit", function (e) {
  e.preventDefault();

  fullnameError.textContent = "";
  usernameError.textContent = "";
  emailError.textContent = "";
  passwordError.textContent = "";
  confirmPasswordError.textContent = "";
  successMessage.textContent = "";

  const fullname = fullnameInput.value.trim();
  const username = usernameInput.value.trim();
  const email = emailInput.value.trim();
  const password = passwordInput.value;
  const confirmPassword = confirmPasswordInput.value;

  if (fullname === "") {
    fullnameError.textContent = "Enter full name";
    return;
  }

  if (username.length < 3) {
    usernameError.textContent = "Username too short";
    return;
  }

  if (!email.includes("@") || !email.includes(".")) {
    emailError.textContent = "Invalid email";
    return;
  }

  if (password.length < 8) {
    passwordError.textContent = "Password min 8 chars";
    return;
  }

  if (password !== confirmPassword) {
    confirmPasswordError.textContent = "Passwords do not match";
    return;
  }

  successMessage.textContent = "Registration successful!";
  // registerForm.reset();
});
