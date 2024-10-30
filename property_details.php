<?php
session_start();
include './includes/config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Store the requested property URL in session
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php');
    exit();
}

// Continue with the rest of the property details page
// ...
