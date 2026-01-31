<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../css/register.css">
</head>
<body>

<header class="header">
  <div class="logo">Music<span class="accent">Events</span></div>
  <nav>
    <ul>
      <li><a href="Homepage.php">Home</a></li>
      <li><a href="login.php">Login</a></li>
    </ul>
  </nav>
</header>

<section class="center-form">
  <div class="form-box">
    <h2>Create Account</h2>

    <form id="registerForm" novalidate>
      <label>Full Name</label>
      <input type="text" id="fullname">
      <small id="fullnameError"></small>

      <label>Username</label>
      <input type="text" id="username">
      <small id="usernameError"></small>

      <label>Email</label>
      <input type="email" id="email">
      <small id="emailError"></small>

      <label>Password</label>
      <input type="password" id="password">
      <small id="passwordError"></small>

      <label>Confirm Password</label>
      <input type="password" id="confirmPassword">
      <small id="confirmPasswordError"></small>

      <button type="submit">Register</button>
      <small id="successMessage"></small>

      <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
  </div>
</section>

<script src="../js/register.js" defer></script>
</body>
</html>
