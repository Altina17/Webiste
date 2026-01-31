<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "my_project";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>