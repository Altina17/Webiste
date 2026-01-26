<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<link rel="stylesheet" href="../css/register.css">
</head>

<body>
    
<header class="header">
    <div class="logo">Music<span class="accent">Events</span></div>
    
    <nav>
      <ul>
        <li><a href="Homepage.php">Home</a></li>
        <li><a href="aboutus.php">About</a></li>
        <li><a href="news.php">News</a></li>
        <li><a href="Homepage.php#contact">Contact</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
</header>

<section class="center-form">
    <div class="form-box glass">
        <h2>Create Account</h2>

        <form id="registerForm" novalidate>
            <label>Full Name</label>
            <input type="text" id="fullname" required>

            <label>Username</label>
            <input type="text" id="username" required>

            <label>Email</label>
            <input type="email" id="email" required>

            <label>Password</label>
            <input type="password" id="password" required>

            <label>Confirm Password</label>
            <input type="password" id="confirmPassword" required>

            <button type="submit">Register</button>

            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</section>

<script src="../js/register.js"></script>
</body>
</html>
