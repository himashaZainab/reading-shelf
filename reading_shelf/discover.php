<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Discover Books</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<section class="container category-section mt-5 text-center">
  <h5 class="gradient-heading">Select a Category</h5>
  <div class="category-buttons mt-3">
    <button class="btn gradient-btn active" data-category="All">All</button>
    <button class="btn gradient-btn" data-category="Fiction">Fiction</button>
    <button class="btn gradient-btn" data-category="Non-fiction">Non-fiction</button>
    <button class="btn gradient-btn" data-category="Mystery">Mystery</button>
    <button class="btn gradient-btn" data-category="Sci-Fi">Sci-Fi</button>
  </div>
</section>

<section class="container bestseller-section mt-4">
  <h5>Bestsellers</h5>
  <div class="row g-3" id="discoverBookList">

    <div class="col-md-3 book-card" data-category="Fiction">
      <div class="card">
        <img src="BookImages/silent patient.jpg" class="card-img-top" alt="Book Image">
        <div class="card-body text-center">
          <p>The Silent Patient</p>
          <small>Alex Michaelides</small>
        </div>
      </div>
    </div>

    <div class="col-md-3 book-card" data-category="Non-fiction">
      <div class="card">
        <img src="BookImages/atomic habits.jpg" class="card-img-top" alt="Book Image">
        <div class="card-body text-center">
          <p>Atomic Habits</p>
          <small>James Clear</small>
        </div>
      </div>
    </div>

    <div class="col-md-3 book-card" data-category="Mystery">
      <div class="card">
        <img src="BookImages/gone girl.jpg" class="card-img-top" alt="Book Image">
        <div class="card-body text-center">
          <p>Gone Girl</p>
          <small>Gillian Flynn</small>
        </div>
      </div>
    </div>

    <div class="col-md-3 book-card" data-category="Sci-Fi">
      <div class="card">
        <img src="BookImages/dune.jpg" class="card-img-top" alt="Book Image">
        <div class="card-body text-center">
          <p>Dune</p>
          <small>Frank Herbert</small>
        </div>
      </div>
    </div>

  </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
