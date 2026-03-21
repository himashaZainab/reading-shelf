<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Reading Shelf</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<section class="container hero-section">
  <div class="row align-items-center">
    <div class="col-md-12">
      <h1 class="gradient-heading">Welcome to My Reading Shelf</h1>
      <p>Track your reading habits and build a personal digital reading shelf.</p>
      <p>Organize your books, discover new titles, and manage your reading goals.</p>
      <a href="app.php" class="btn gradient-btn me-2">Start Now</a>
      <a href="discover.php" class="btn gradient-btn">Discover Books</a>
    </div>
  </div>
</section>

<section class="container feature-section">
  <div class="row text-center">
    <div class="col-md-3">
      <div class="card p-3">
        <h6 class="gradient-heading">Track Reading</h6>
        <p>Monitor your reading progress easily.</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3">
        <h6 class="gradient-heading">Organize Books</h6>
        <p>Keep all your books in one place.</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3">
        <h6 class="gradient-heading">Discover Books</h6>
        <p>Explore popular and trending titles.</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3">
        <h6 class="gradient-heading">Reading Goals</h6>
        <p>Stay motivated with reading goals.</p>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
