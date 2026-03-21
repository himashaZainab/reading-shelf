<?php
session_start();
require_once 'includes/db.php';
require_once 'includes/functions.php';

$success = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = sanitize($_POST['name']);
    $email   = sanitize($_POST['email']);
    $subject = sanitize($_POST['subject']);
    $message = sanitize($_POST['message']);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } else {
        $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        if ($stmt->execute()) {
            $success = "Your message has been sent successfully!";
        } else {
            $error = "Failed to send message. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact - My Reading Shelf</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<section class="container text-center mt-5 mb-5">
  <h3 class="gradient-heading">Contact Us</h3>
  <p>We would love to hear from you</p>
</section>

<section class="container mb-5">
  <div class="row justify-content-center g-4">
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <i class="bi bi-envelope-fill gradient-icon mb-2"></i>
        <h6>Email</h6>
        <p>support@readingshelf.com</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <i class="bi bi-telephone-fill gradient-icon mb-2"></i>
        <h6>Phone</h6>
        <p>+94 71 234 5678</p>
      </div>
    </div>
  </div>
</section>

<section class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4 text-center">
        <h6 class="mb-3"><strong>Send us a Message</strong></h6>

        <?php if ($success): ?>
          <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" placeholder="Enter subject" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" rows="4" placeholder="Enter your message" required></textarea>
          </div>
          <button type="submit" class="btn gradient-btn w-100">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
