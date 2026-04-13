<?php
    // Detect environment
    $is_local = (isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1'));

    // 1. Session Configuration - MUST happen before session_start()
    $session_dir = dirname(__FILE__, 2) . '/sessions';
    if (!is_dir($session_dir)) {
        @mkdir($session_dir, 0777, true);
    }
    if (is_writable($session_dir)) {
        session_save_path($session_dir);
    }

    // 2. Start Session Globally
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 3. Global Translation Helper
    require_once(dirname(__FILE__) . '/lang_setup.php');

    if ($is_local) {
        // Local XAMPP settings
        $server = "localhost";
        $user = "root";
        $password = "";
        $db = "_sms";
        error_reporting(E_ALL); 
    } else {
        // Production settings - Railway
        $server   = getenv('MYSQLHOST') ?: getenv('DB_HOST') ?: getenv('HOSTNAME') ?: "localhost";
        $user     = getenv('MYSQLUSER') ?: getenv('DB_USER') ?: "root";
        $password = getenv('MYSQLPASSWORD') ?: getenv('DB_PASS') ?: ""; 
        $db       = getenv('MYSQLDATABASE') ?: getenv('DB_NAME') ?: "railway";
        
        ini_set('display_errors', 0); // Hide in prod
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); 
    }
    
    // SMTP Configuration
    define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
    define('SMTP_USER', getenv('SMTP_USER') ?: 'erp.schoolmanagementsystem@gmail.com');
    define('SMTP_PASS', getenv('SMTP_PASS') ?: 'whqbysomdhdjthvr');
    define('SMTP_PORT', getenv('SMTP_PORT') ?: 587);
    define('SMTP_FROM', getenv('SMTP_FROM') ?: 'erp.schoolmanagementsystem@gmail.com');

    // Establish connection
    $conn = null;
    try {
        $conn = mysqli_connect($server, $user, $password, $db);
        if ($conn) {
            mysqli_set_charset($conn, "utf8mb4");
        }
    } catch (Throwable $e) {
        if (!$is_local) {
            die("<h1>Database Connectivity Error</h1><p>The application encountered a fatal error while connecting to the database.</p>");
        } else {
            die("Local Database Error: " . $e->getMessage());
        }
    }

    // Base URL
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
