<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
<div class="container">
  <a class="navbar-brand fw-bold gradient-title" href="index.php">
    <i class="bi bi-book-half me-2"></i> My Reading Shelf
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navMenu">
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link gradient-title" href="index.php">Home</a></li>
      <li class="nav-item"><a class="nav-link gradient-title" href="discover.php">Discover</a></li>
      <li class="nav-item"><a class="nav-link gradient-title" href="app.php">App</a></li>
      <li class="nav-item"><a class="nav-link gradient-title" href="contact.php">Contact</a></li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li class="nav-item"><a class="nav-link gradient-title" href="dashboard.php"><i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['username']) ?></a></li>
        <li class="nav-item ms-2"><a class="btn gradient-btn btn-sm" href="auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
      <?php else: ?>
        <li class="nav-item ms-2"><a class="btn gradient-btn btn-sm" href="auth/login.php"><i class="bi bi-person-circle"></i> Login</a></li>
      <?php endif; ?>
    </ul>
  </div>
</div>
</nav>
