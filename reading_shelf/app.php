<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Reading List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<section class="container mt-5 text-center">
  <h3 class="gradient-heading">My Reading List</h3>
  <?php if (isLoggedIn()): ?>
    <button class="btn gradient-btn mt-3" data-bs-toggle="modal" data-bs-target="#addBookModal">
      <i class="bi bi-plus-circle"></i> Add Book
    </button>
  <?php else: ?>
    <p class="mt-3">Please <a href="auth/login.php">login</a> to manage your reading list.</p>
  <?php endif; ?>
</section>

<!-- FILTER SECTION -->
<section class="container mt-4">
  <div class="row g-2">
    <div class="col-md-4"><input type="text" id="searchInput" class="form-control" placeholder="Search books or authors"></div>
    <div class="col-md-2">
      <select id="categoryFilter" class="form-select">
        <option value="All" selected>Category</option>
        <option value="Fiction">Fiction</option>
        <option value="Non-fiction">Non-fiction</option>
        <option value="Mystery">Mystery</option>
        <option value="Sci-Fi">Sci-Fi</option>
      </select>
    </div>
    <div class="col-md-2">
      <select id="statusFilter" class="form-select">
        <option value="All" selected>Status</option>
        <option value="Unread">Unread</option>
        <option value="Reading">Reading</option>
        <option value="Completed">Completed</option>
      </select>
    </div>
    <div class="col-md-2">
      <select id="sortFilter" class="form-select">
        <option value="default" selected>Sort</option>
        <option value="title">Title</option>
        <option value="author">Author</option>
      </select>
    </div>
  </div>
</section>

<!-- BOOK LIST -->
<section class="container mt-4">
  <div class="row" id="bookList"></div>
</section>

<?php if (isLoggedIn()): ?>
<!-- ADD BOOK MODAL -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="addBookForm">
          <div class="mb-3"><input id="bookTitle" type="text" class="form-control" placeholder="Book Title" required></div>
          <div class="mb-3"><input id="bookAuthor" type="text" class="form-control" placeholder="Author" required></div>
          <div class="mb-3">
            <select id="bookCategory" class="form-select" required>
              <option value="" disabled selected>Select Category</option>
              <option value="Fiction">Fiction</option>
              <option value="Non-fiction">Non-fiction</option>
              <option value="Mystery">Mystery</option>
              <option value="Sci-Fi">Sci-Fi</option>
            </select>
          </div>
          <div class="mb-3">
            <select id="bookStatus" class="form-select" required>
              <option value="" disabled selected>Select Status</option>
              <option value="Unread">Unread</option>
              <option value="Reading">Reading</option>
              <option value="Completed">Completed</option>
            </select>
          </div>
          <div class="mb-3"><input id="bookImage" type="url" class="form-control" placeholder="Image URL (optional)"></div>
          <button type="submit" class="btn gradient-btn w-100">Add Book</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- EDIT BOOK MODAL -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editBookForm">
          <input type="hidden" id="editBookIndex">
          <div class="mb-3"><input id="editBookTitle" type="text" class="form-control" placeholder="Book Title" required></div>
          <div class="mb-3"><input id="editBookAuthor" type="text" class="form-control" placeholder="Author" required></div>
          <div class="mb-3">
            <select id="editBookCategory" class="form-select" required>
              <option value="" disabled>Select Category</option>
              <option value="Fiction">Fiction</option>
              <option value="Non-fiction">Non-fiction</option>
              <option value="Mystery">Mystery</option>
              <option value="Sci-Fi">Sci-Fi</option>
            </select>
          </div>
          <div class="mb-3">
            <select id="editBookStatus" class="form-select" required>
              <option value="" disabled>Select Status</option>
              <option value="Unread">Unread</option>
              <option value="Reading">Reading</option>
              <option value="Completed">Completed</option>
            </select>
          </div>
          <div class="mb-3"><input id="editBookImage" type="url" class="form-control" placeholder="Image URL (optional)"></div>
          <button type="submit" class="btn gradient-btn w-100">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
