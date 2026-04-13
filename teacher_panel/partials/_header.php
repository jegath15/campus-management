<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boxicons for Original Design -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap for Utility Support -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Original Sidebar CSS -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Teacher Panel | Campus Management System</title>
</head>
<body class="light">
<?php include('../assets/config.php'); ?>
<?php 
if(!isset($_SESSION)) {
    session_start();
}
// Inclusion of stabilized session check
include("../assets/noSessionRedirect.php");
?>
