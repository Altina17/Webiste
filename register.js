const registerForm = document.getElementById("registerForm");
const email = document.getElementById("email").value.trim();

registerForm.addEventListener("submit", function(e){
    e.preventDefault(); 

    const fullname = document.getElementById("fullname").value.trim();
    const username = document.getElementById("username").value.trim();
    if(fullname.length < 3){
        alert("Full Name duhet të ketë minimum 3 karaktere.");
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
    alert("Fullname dhe username valid!");

    function validateEmail(email){
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email.toLowerCase());
}
});
