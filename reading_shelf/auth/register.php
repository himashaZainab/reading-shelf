<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Redirect if already logged in
if (isLoggedIn()) redirect('../index.php');

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username']);
    $email    = sanitize($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username or email already exists.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt2 = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt2->bind_param("sss", $username, $email, $hashed);
            if ($stmt2->execute()) {
                $success = "Registration successful! You can now login.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - My Reading Shelf</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php include '../includes/navbar.php'; ?>

<section class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card p-4">
        <h4 class="text-center gradient-heading mb-4">Create Account</h4>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
          <div class="alert alert-success"><?= $success ?> <a href="login.php">Login here</a></div>
        <?php endif; ?>

        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Min 6 characters" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" placeholder="Repeat password" required>
          </div>
          <button type="submit" class="btn gradient-btn w-100">Register</button>
          <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
