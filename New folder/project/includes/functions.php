<?php
// Sanitize input to prevent XSS
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Redirect to a URL
function redirect($url) {
    header("Location: $url");
    exit();
}

// Display alert message and redirect
function alertRedirect($message, $url) {
    echo "<script>alert('$message'); window.location.href='$url';</script>";
    exit();
}
?>
