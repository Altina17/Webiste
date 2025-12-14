const registerForm = document.getElementById("registerForm");
const email = document.getElementById("email").value.trim();
const password = document.getElementById("password").value;
const confirmPassword = document.getElementById("confirmPassword").value;

registerForm.addEventListener("submit", function(e){
    e.preventDefault(); 

    const fullname = document.getElementById("fullname").value.trim();
    const username = document.getElementById("username").value.trim();

    const nameRegex = /^[A-Za-z ]{3,20}$\;
    if(!nameRegex.test(fullname)){
        alert("Full Name duhet të ketë 3-20 shkronja dhe vetëm shkronja të mëdha ose të vogla.");
        return;
    }

    if(username.length === 0){
        alert("Username duhet të plotësohet.");
        return;
    }

    if(!validateEmail(email)){
        alert("Email nuk është valid.");
        return;
    }
    if(password.length < 6){
        alert("Password duhet të ketë minimum 6 karaktere.");
        return;
    }

    if(password !== confirmPassword){
        alert("Passwords nuk përputhen.");
        return;
    }
    function validateEmail(email){
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email.toLowerCase());
    }
        alert("Validimi i fullname u krye me sukses!");
        alert("Form valid! Ready to submit.");
   
});
