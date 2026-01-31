<?php
include "./db.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $full_name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $username  = mysqli_real_escape_string($conn, $_POST['username']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $password  = $_POST['password'];
    $confirm   = $_POST['confirmPassword'];

    if (empty($full_name) || empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $role = 'user';

        $check = mysqli_query($conn, "SELECT COUNT(*) as count FROM users");
        $row = mysqli_fetch_assoc($check);

        if ($row['count'] == 0) {
            $role = 'admin';
        }

        $sql = "INSERT INTO users (full_name, username, email, password, role)
                VALUES ('$full_name', '$username', '$email', '$hashedPassword', '$role')";

        if (mysqli_query($conn, $sql)) {
            $success = "Account created successfully!";
            header("Location: login.php");
            exit;  
        } else {
         
            if (mysqli_errno($conn) == 1062) {  
                $error = "Email or username already exists.";
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../css/register.css">
  <link rel="stylesheet" href="../css/header-footer.css">
</head>
<body>

<?php include 'include/header.php'; ?>

<section class="center-form">
  <div class="form-box glass">
    <h2>Create Account</h2>

    <form id="registerForm" method="POST" action="" novalidate>
      <label>Full Name</label>
      <input type="text" id="fullname" name="fullname">
      <small id="fullnameError"></small>

      <label>Username</label>
<input type="text" id="username" name="username">
      <small id="usernameError"></small>

      <label>Email</label>
     <input type="email" id="email" name="email">
      <small id="emailError"></small>

      <label>Password</label>
<input type="password" id="password" name="password">
      <small id="passwordError"></small>

      <label>Confirm Password</label>
      <input type="password" id="confirmPassword" name="confirmPassword">
      <small id="confirmPasswordError"></small>

      <button type="submit">Register</button>
      <small id="successMessage"></small>

      <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
  </div>
</section>

<!-- <script src="../js/register.js" defer></script> -->
</body>
</html>
