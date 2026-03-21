<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) redirect('auth/login.php');

// Get book stats for this user (from localStorage via JS - counts shown from JS)
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - My Reading Shelf</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<section class="container mt-5">
  <h3 class="gradient-heading text-center">Welcome, <?= htmlspecialchars($username) ?>! 👋</h3>
  <p class="text-center">Here's your reading dashboard.</p>

  <!-- Stats Cards -->
  <div class="row text-center mt-4">
    <div class="col-md-3">
      <div class="card p-3">
        <h2 id="totalBooks" class="gradient-heading">0</h2>
        <p>Total Books</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3">
        <h2 id="unreadBooks" class="gradient-heading">0</h2>
        <p>Unread</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3">
        <h2 id="readingBooks" class="gradient-heading">0</h2>
        <p>Reading</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card p-3">
        <h2 id="completedBooks" class="gradient-heading">0</h2>
        <p>Completed</p>
      </div>
    </div>
  </div>

  <!-- Quick Links -->
  <div class="row text-center mt-5">
    <div class="col-md-4">
      <div class="card p-4">
        <i class="bi bi-plus-circle gradient-icon"></i>
        <h6 class="mt-2">Add a Book</h6>
        <a href="app.php" class="btn gradient-btn mt-2">Go to App</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <i class="bi bi-search gradient-icon"></i>
        <h6 class="mt-2">Discover Books</h6>
        <a href="discover.php" class="btn gradient-btn mt-2">Discover</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <i class="bi bi-box-arrow-right gradient-icon"></i>
        <h6 class="mt-2">Logout</h6>
        <a href="auth/logout.php" class="btn gradient-btn mt-2">Logout</a>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Load stats from localStorage
  const books = JSON.parse(localStorage.getItem('books')) || [];
  document.getElementById('totalBooks').textContent     = books.length;
  document.getElementById('unreadBooks').textContent    = books.filter(b => b.status === 'Unread').length;
  document.getElementById('readingBooks').textContent   = books.filter(b => b.status === 'Reading').length;
  document.getElementById('completedBooks').textContent = books.filter(b => b.status === 'Completed').length;
</script>
</body>
</html>
