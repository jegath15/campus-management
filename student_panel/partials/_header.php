<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- External Dependencies for Full Restoration -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Legacy CMS Design Tokens & Shared Styles -->
    <link rel="stylesheet" href="../shared/style.css">
    
    <!-- Panel-Specific Original Sidebar CSS -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    
    <title>Student Portal | Campus Management System</title>
</head>
<body class="light">
<?php include_once('../assets/config.php'); ?>
<?php 
if(!isset($_SESSION)) {
    session_start();
}
include_once("../assets/noSessionRedirect.php");
?>
