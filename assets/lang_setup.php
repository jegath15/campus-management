<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set default language to English if not set
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// Handle language toggle
if (isset($_GET['lang'])) {
    $requested_lang = $_GET['lang'];
    if (in_array($requested_lang, ['en', 'ta'])) {
        $_SESSION['lang'] = $requested_lang;
    }
    // Redirect back to remove the GET parameter
    $current_page = basename($_SERVER['PHP_SELF']);
    header("Location: $current_page");
    exit();
}

$translations_file = dirname(__FILE__) . '/translations.php';
$translations = file_exists($translations_file) ? include($translations_file) : [];
$lang = $_SESSION['lang'] ?? 'en';

/**
 * Returns the translated string for a given key.
 * If the key doesn't exist, returns the key itself or the default.
 */
if (!function_exists('t')) {
    function t($key, $default = null) {
        global $translations, $lang;
        return $translations[$lang][$key] ?? $default ?? $key;
    }
}
?>
