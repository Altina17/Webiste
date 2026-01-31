<?php
require_once 'config.php'; 
$stmt = $conn->query("SELECT * FROM events ORDER BY event_date ASC");
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Discover Events | MusicEvents</title>
<link rel="stylesheet" href="../css/discover.css">
<link rel="stylesheet" href="../css/header-footer.css">
</head>
<body>
<?php include 'include/header.php'; ?>

<section class="hero">
  <div class="overlay"></div>
  <div class="hero-content">
    <h1>Discover Latest Music Events</h1>
    <p>Carefully selected events with accurate information</p>
  </div>
</section>

<section class="events">
  <h2>Upcoming Events</h2>
  <div class="events-grid">

    <?php if(!empty($events)): ?>
      <?php foreach($events as $event): ?>
        <div class="event-card">
          <img src="../images/<?php echo $event['image']; ?>" alt="<?php echo $event['title']; ?>">
          <div class="event-info">
            <h3><?php echo $event['title']; ?></h3>
            <p>📍 <?php echo $event['location']; ?></p>
            <span>📅 <?php echo date('F d, Y', strtotime($event['event_date'])); ?> · <?php echo $event['category']; ?></span>
            <form action="buy.php" method="POST">
              <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
              <button type="submit">Buy Ticket</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No events found!</p>
    <?php endif; ?>

  </div>
</section>

<?php include 'include/footer.php'; ?>
</body>
</html>
