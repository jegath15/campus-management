<?php 
    include_once('config.php');

    $_SESSION = array(); 
    session_destroy();

    // Reset cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    $response = array('status' => 'success',
                     'message' => 'Logout successful');
    echo json_encode($response);
?>
