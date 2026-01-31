<?php
require_once '../config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])){
    $event_id = $_POST['event_id'];

    $stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$event_id]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$event){
        die("Event not found");
    }

   
    if(isset($_POST['user_name'], $_POST['user_email'], $_POST['quantity'])){
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $quantity = (int)$_POST['quantity'];
        $price_per_ticket = 50; 
        $total_price = $quantity * $price_per_ticket;

        $insert = $conn->prepare("INSERT INTO tickets (event_id, user_name, user_email, quantity, total_price) VALUES (?, ?, ?, ?, ?)");
        $insert->execute([$event_id, $user_name, $user_email, $quantity, $total_price]);

        echo "<p>Thank you! Your tickets for {$event['title']} are booked. Total: $$total_price</p>";
        exit;
    }
}else{
    die("Invalid request");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buy Tickets | <?php echo $event['title']; ?></title>
<link rel="stylesheet" href="../css/buy.css">
<link rel="stylesheet" href="../css/header-footer.css">
</head>
<body>
<?php include 'include/header.php'; ?>

<section class="buy-section">
  <h2>Buy Tickets for <?php echo $event['title']; ?></h2>
  <p>Location: <?php echo $event['location']; ?> | Date: <?php echo date('F d, Y', strtotime($event['event_date'])); ?></p>

  <form action="buy.php" method="POST">
    <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
    <label>Name:</label>
    <input type="text" name="user_name" required>
    <label>Email:</label>
    <input type="email" name="user_email" required>
    <label>Quantity:</label>
    <input type="number" name="quantity" min="1" value="1" required>
    <button type="submit">Buy Now</button>
  </form>
</section>

<?php include 'include/footer.php'; ?>
</body>
</html>
