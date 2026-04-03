<?php
    // Detect environment
    $is_local = ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1');

    if ($is_local) {
        // Local XAMPP settings
        $server = "localhost";
        $user = "root";
        $password = "";
        $db = "_sms";
        error_reporting(E_ALL); // Show errors locally
    } else {
        // Production settings - Prefers environment variables for security
        $server = getenv('DB_HOST') ?: "localhost";
        $user = getenv('DB_USER') ?: "your_db_username";
        $password = getenv('DB_PASS') ?: "your_db_password";
        $db = getenv('DB_NAME') ?: "your_db_name";
        error_reporting(0); // Hide errors on production
    }
    
    // SMTP Configuration
    define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
    define('SMTP_USER', getenv('SMTP_USER') ?: 'erp.schoolmanagementsystem@gmail.com');
    define('SMTP_PASS', getenv('SMTP_PASS') ?: 'whqbysomdhdjthvr'); // Pre-configured App Password
    define('SMTP_PORT', getenv('SMTP_PORT') ?: 587);
    define('SMTP_FROM', getenv('SMTP_FROM') ?: 'erp.schoolmanagementsystem@gmail.com');

    // Establish connection
    $conn = mysqli_connect($server, $user, $password, $db);

    // Determine the base URL relative to the domain root
    if ($is_local) {
        // Find if project is in a subdirectory (like /campus/)
        $script_path = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $base_url = (strlen($script_path) > 1) ? $script_path . '/' : '/';
        // If script path doesn't contain "campus" but it should
        if (!str_contains($base_url, '/campus/')) {
             $base_url = "/campus/";
        }
    } else {
        // For production, usually the site root is /
        $base_url = "/";
    }
    
    define('BASE_URL', $base_url);

    if (!$conn) {
        if (!$is_local) {
            die("Critical Error: Unable to connect to the database. Please ensure DB_HOST, DB_USER, DB_PASS, and DB_NAME environment variables are set.");
        }
        // Local fallback error
        error_log("Database connection failed: " . mysqli_connect_error());
        die("Local Database Error: Database connection failed. Please ensure MySQL is running in XAMPP.");
    }
?>
