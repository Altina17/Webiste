const registerForm = document.getElementById("registerForm");

registerForm.addEventListener("submit", function(e){
    e.preventDefault();

    const fullname = document.getElementById("fullname").value.trim();
    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    const nameRegex = /^[A-Za-z]{3,20}( [A-Za-z]{3,20})?$/;
    if(!nameRegex.test(fullname)){
        alert("Full Name duhet të ketë 3-20 shkronja për secilin emër dhe vetëm shkronja të mëdha ose të vogla.");
        return;
    }

    const usernameRegex = /^[A-Za-z0-9_]{3,20}$/;
    if(!usernameRegex.test(username)){
        alert("Username duhet të ketë 3-20 karaktere: shkronja, numra ose _");
        return;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
    if(!emailRegex.test(email)){
        alert("Email nuk është valid.");
        return;
    }

    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
    if(!passwordRegex.test(password)){
        alert("Password duhet të ketë 8-20 karaktere, me shkronja të mëdha, të vogla, numra dhe karaktere speciale.");
        return;
    }

    if(password !== confirmPassword){
        alert("Passwords nuk përputhen.");
        return;
    }

    alert("Regjistrimi u krye me sukses!");
    registerForm.reset();
});