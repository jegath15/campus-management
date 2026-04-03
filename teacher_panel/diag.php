<?php
include('partials/_header_revised.php');
echo "<h1>Diagnostic Page</h1>";
echo "<p>User ID: " . ($_SESSION['uid'] ?? 'Not Set') . "</p>";
if (isset($conn)) {
    echo "<p>Database connection: OK</p>";
} else {
    echo "<p>Database connection: FAILED (conn not set)</p>";
}
echo "<p>Current Dir: " . __DIR__ . "</p>";
?>
