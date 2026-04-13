<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boxicons for Original Design -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Original Sidebar CSS -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Parent Panel | Campus Management System</title>
</head>
<body class="light">
<?php include('../assets/config.php'); ?>
<?php 
if(!isset($_SESSION)) {
    session_start();
}
include("../assets/noSessionRedirect.php");
?>
