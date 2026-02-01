<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="header">
  <div class="logo">Music<span class="accent">Events</span></div>

  <nav>
    <ul>
      <li><a href="Homepage.php">Home</a></li>
      <li><a href="aboutus.php">About</a></li>
      <li><a href="news.php">News</a></li>
      <li><a href="#contact">Contact</a></li>

      <?php if (isset($_SESSION['user_id'])): ?>
        <li class="dropdown">
          <a href="#" class="dropbtn">
            <?php echo htmlspecialchars($_SESSION['username']); ?>
          </a>
          <div class="dropdown-content">
            <a class="logout-link" href="logout.php">Logout</a>
          </div>
        </li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
