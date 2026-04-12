<?php
session_start();
$_SESSION['test'] = "Hello World";
echo "Session started. Test value set.";
?>
