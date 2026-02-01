<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Discover Events | MusicEvents</title>

  
  <link rel="stylesheet" href="../css/discover.css">
  <link rel="stylesheet" href="../css/header-footer.css">

  <!-- Bootstrap CSS per slider -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

<!--SLIDER-->
<section class="events">
  <h2>Upcoming Events</h2>

  <div id="eventsCarousel" class="carousel slide" data-bs-ride="carousel" style="max-width: 800px; margin: auto;">
    <div class="carousel-inner">

      <div class="carousel-item active">
        <img src="../images/pic10.jpg" class="d-block w-100" alt="Berlin Event">
        <div class="carousel-caption d-none d-md-block">
          <h5>Summer Beats Festival</h5>
          <p>📍 Berlin, Germany · 📅 July 20, 2025 · Electronic</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="../images/pic11.jpg" class="d-block w-100" alt="London Event">
        <div class="carousel-caption d-none d-md-block">
          <h5>Live Rock Night</h5>
          <p>📍 London, UK · 📅 August 3, 2025 · Rock</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="../images/pic12.jpg" class="d-block w-100" alt="Amsterdam Event">
        <div class="carousel-caption d-none d-md-block">
          <h5>Midnight Club Session</h5>
          <p>📍 Amsterdam, NL · 📅 June 14, 2025 · Techno</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="../images/pic13.jpg" class="d-block w-100" alt="Paris Event">
        <div class="carousel-caption d-none d-md-block">
          <h5>Exclusive DJ Night</h5>
          <p>📍 Paris, France · 📅 September 1, 2025 · House</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="../images/pic14.jpg" class="d-block w-100" alt="Barcelona Event">
        <div class="carousel-caption d-none d-md-block">
          <h5>Open Air Sunset</h5>
          <p>📍 Barcelona, Spain · 📅 July 28, 2025 · Deep House</p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="../images/pic15.jpg" class="d-block w-100" alt="Rome Event">
        <div class="carousel-caption d-none d-md-block">
          <h5>Historic Venue Live</h5>
          <p>📍 Rome, Italy · 📅 August 16, 2025 · Indie</p>
        </div>
      </div>

    </div>

    <!-- Butonat -->
    <button class="carousel-control-prev" type="button" data-bs-target="#eventsCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#eventsCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>


<section class="contact-cta">
  <h2>Need More Details?</h2>
  <p>For tickets, partnerships or additional information, contact us.</p>
  <a href="Homepage.php#contact">Contact Us</a>
</section>

<?php include 'include/footer.php'; ?>

<!-- Bootstrap JS per slider -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
