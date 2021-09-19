<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include('templates/top_template.php');
include('components/navbar.php');
include('components/sidebar.php');
include('components/welcome_message.php');
include('templates/bottom_template.php');
?>
