<?php
    require_once(dirname(__FILE__) . '/lang_setup.php');
    // Robust Session Configuration - Prevents 500 errors on Railway
    $session_dir = dirname(__FILE__, 2) . '/sessions';
    if (!is_dir($session_dir)) {
        @mkdir($session_dir, 0777, true);
    }
    if (is_writable($session_dir)) {
        session_save_path($session_dir);
    }

    // Detect environment
    $is_local = (isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1'));

    if ($is_local) {
        // Local XAMPP settings
        $server = "localhost";
        $user = "root";
        $password = "";
        $db = "_sms";
        error_reporting(E_ALL); 
    } else {
        // Production settings - Robust detection for Railway and other hosts
        $server   = getenv('MYSQLHOST') ?: getenv('DB_HOST') ?: getenv('HOSTNAME') ?: "localhost";
        $user     = getenv('MYSQLUSER') ?: getenv('DB_USER') ?: "root";
        $password = getenv('MYSQLPASSWORD') ?: getenv('DB_PASS') ?: ""; 
        $db       = getenv('MYSQLDATABASE') ?: getenv('DB_NAME') ?: "railway";
        
        // TEMPORARY: Enable error reporting to diagnose live issues
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL); 
    }
    
    // SMTP Configuration
    define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
    define('SMTP_USER', getenv('SMTP_USER') ?: 'erp.schoolmanagementsystem@gmail.com');
    define('SMTP_PASS', getenv('SMTP_PASS') ?: 'whqbysomdhdjthvr');
    define('SMTP_PORT', getenv('SMTP_PORT') ?: 587);
    define('SMTP_FROM', getenv('SMTP_FROM') ?: 'erp.schoolmanagementsystem@gmail.com');

    // Establish connection with massive safety
    $conn = null;
    try {
        $conn = mysqli_connect($server, $user, $password, $db);
    } catch (Throwable $e) {
        $error_msg = $e->getMessage();
        if (!$is_local) {
            die("<h1>Database Connectivity Error</h1><p>The application encountered a fatal error while connecting to the database.</p><p>Error: <b>$error_msg</b></p><p>Attempted Host: <code>$server</code> | Attempted User: <code>$user</code></p><p>Please verify your environment variables in the Railway dashboard.</p>");
        } else {
            die("Local Database Error: $error_msg");
        }
    }

    mysqli_set_charset($conn, "utf8mb4");

    // Determine the base URL relative to the domain root
    if ($is_local) {
        $script_path = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $base_url = (strlen($script_path) > 1) ? $script_path . '/' : '/';
        if (!str_contains($base_url, '/campus/')) {
             $base_url = "/campus/";
        }
    } else {
        $base_url = "/";
    }
    define('BASE_URL', $base_url);
?>
