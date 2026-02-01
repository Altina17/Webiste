<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "my_project";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }
  public function getNews() {
        $sql = "SELECT id, title, description, category, created_at FROM news ORDER BY id ASC";
        $result = $this->conn->query($sql);
        $news = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $news[] = $row;
            }
        }
        return $news;
    }}
    $db = new Database();
    $newsList = $db->getNews();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link rel="stylesheet" href="../css/homepage.css">
  <link rel="stylesheet" href="../css/header-footer.css">
</head>
<body>

<?php include 'include/header.php'; ?>

<section class="hero">
  <video autoplay muted loop>
    <source src="../images/VIDIO1.mp4" type="video/mp4" />
  </video>

  <div id="intro-popup" class="popup">
    <div class="popup-content">
      <h2>Welcome to Music & Events</h2>
      <p>Choose where you want to start exploring:</p>
      <div class="popup-buttons">
        <a href="#events" class="popup-btn">🎆 Events</a>
        <a href="news.php" class="popup-btn">📰 News</a>
        <a href="#interviews" class="popup-btn">🎤 Interviews</a>
      </div>
      <span class="close-btn">&times;</span>
    </div>
  </div>

  <div class="hero-text">
    <h2>DISCOVER THE LATEST MUSIC EVENTS</h2>
    <a href="discover.php" class="btn">GET STARTED</a>
  </div>
</section>

<section class="events" id="events">
  <h2>Upcoming Events</h2>
  <div class="event-cards">
    <div class="card">
      <h3>Concerts</h3>
      <p>Live performances from top artists.</p>
      <img src="../images/Foto1.png" alt="Concert Image">
    </div>
    <div class="card">
      <h3>Festivals</h3>
      <p>Outdoor music festivals and cultural events.</p>
      <img src="../images/Foto2.png" alt="Festival Image">
    </div>
    <div class="card">
      <h3>Club Nights</h3>
      <p>DJ sets and nightlife experiences.</p>
      <img src="../images/Foto3.png" alt="Club Night Image">
    </div>
    <div class="card">
      <h3>Special Events</h3>
      <p>Exclusive shows and private parties.</p>
      <img src="../images/Foto4.png" alt="Special Events Image">
    </div>
  </div>
</section>

<section class="news ">
  <h2>Latest News</h2>

  
  <?php if (empty($newsList)): ?>
    <p style="text-align: center; color: #888; padding: 2rem;">
      No news articles available at the moment.
    </p>
  <?php else: ?>
    <div class="news-cards news-grid ">
      <?php foreach ($newsList as $item): ?>
        <div class="card news-section">
          <h3><?= htmlspecialchars($item['title']) ?></h3>
          
          
            
            <span class="date"><?= date('M d, Y', strtotime($item['created_at'])) ?></span>
        
          
          <p><?= htmlspecialchars(substr($item['description'], 0, 120)) ?>
            <?= strlen($item['description']) > 120 ? '...' : '' ?></p>
          
          <span class="category"><?= htmlspecialchars($item['category']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

<section id="contact" class="contact">
  <h2>Contact Us</h2>
  <form id="contact-form">
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <textarea name="message" placeholder="Message" required></textarea>
    <button type="submit">SEND</button>
  </form>
</section>

<?php include 'include/footer.php'; ?>

</body>
</html>
