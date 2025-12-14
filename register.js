const registerForm = document.getElementById("registerForm");

registerForm.addEventListener("submit", function(e){
    e.preventDefault(); 

    const fullname = document.getElementById("fullname").value.trim();

    if(fullname.length < 3){
        alert("Full Name duhet të ketë minimum 3 karaktere.");
        return;
    }

    alert("Fullname valid!");
});
