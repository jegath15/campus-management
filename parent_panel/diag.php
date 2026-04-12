<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../assets/config.php');
session_start();

echo "<h1>Parent Panel Diagnostics</h1>";

// Check Session
echo "<h3>1. Session Check</h3>";
echo "User ID: " . ($_SESSION['uid'] ?? 'NULL') . "<br>";
echo "Role: " . ($_SESSION['role'] ?? 'NULL') . "<br>";

if (!isset($_SESSION['uid'])) {
    echo "<p style='color:red;'>Session UID not set. Please log in.</p>";
}

// Check Database Connection
echo "<h3>2. Database Connection Check</h3>";
if ($conn) {
    echo "<p style='color:green;'>Connected successfully to " . ($db ?? 'default db') . "</p>";
} else {
    echo "<p style='color:red;'>Connection failed: " . mysqli_connect_error() . "</p>";
}

// Check Tables
$tables = ['users', 'parents', 'students', 'fees', 'attendence', 'notice'];
echo "<h3>3. Table Existence Check</h3>";
foreach ($tables as $table) {
    if ($result = $conn->query("SHOW TABLES LIKE '$table'")) {
        if ($result->num_rows > 0) {
            echo "<p style='color:green;'>Table '$table' exists.</p>";
            // Check Columns for parents
            if ($table == 'parents') {
                 $cols = $conn->query("SHOW COLUMNS FROM parents");
                 while($c = $cols->fetch_assoc()) {
                     echo " - Column: " . $c['Field'] . "<br>";
                 }
            }
        } else {
            echo "<p style='color:red;'>Table '$table' MISSING.</p>";
        }
    }
}

// Check Specific Data
if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    echo "<h3>4. Data Link Check</h3>";
    $sql = "SELECT p.student_id, p.user_id FROM parents p WHERE p.user_id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $uid);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        if ($res) {
            echo "<p style='color:green;'>Parent record found. Student ID: " . $res['student_id'] . "</p>";
        } else {
            echo "<p style='color:orange;'>No record found in 'parents' table for UID: $uid</p>";
        }
    } else {
        echo "<p style='color:red;'>Query preparation failed: " . $conn->error . "</p>";
    }
}
?>
