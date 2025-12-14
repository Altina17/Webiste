const loginForm = document.getElementById("loginForm");

loginForm.addEventListener("submit", function(e){
    e.preventDefault(); 

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    const emailRegex = /^[^\s@]+@[^\s@]+\.[A-Za-z]{3}$/;
    if(!emailRegex.test(email)){
        alert("Email nuk është valid. Duhet të ketë 1 @, 1 pikë dhe saktësisht 3 shkronja pas pikës (p.sh. .com).");
        return;
    }

    alert("Email valid! Vazhdon validimi i password.");
});
