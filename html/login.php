<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="../css/header-footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
<?php include 'include/header.php'; ?>

<section class="center-form">
    <div class="form-box glass">
        <h2>Login</h2>

        <form id="loginForm" novalidate>
            <label>Email</label>
            <input type="email" id="email" required>
            <small id="emailError" style="color:red"></small>


            <label>Password</label>
            <input type="password" id="password" required>
            <small id="passwordError" style="color:red"></small>



            <div class="forgot-box"> 
            <a href="#" class="forgot">Forgot Password?</a>
            </div> 

            <button type="submit">Login</button> 
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </form>

        <div class="social-login">
            <p>Or login with</p>

            <div class="social-buttons">
                <button class="google"><i class="fab fa-google"></i></button>
                <button class="facebook"><i class="fab fa-facebook-f"></i></button>
                <button class="instagram"><i class="fab fa-instagram"></i></button>
            </div>
        </div>

    </div>
</section>

<script src="../js/login.js"></script>
</body>
</html>
