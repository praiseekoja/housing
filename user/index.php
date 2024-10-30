<?php
session_start();
include('../includes/config.php');

if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit;
}

$user = $_SESSION['user'];
//$user = $_SESSION['user_details'];
include('../includes/header.php');
include('../includes/nav.php');
include('../includes/sidebar_user.php');
//include('../includes/footer.php');
?>


<?php
include('../includes/footer.php');
?>
