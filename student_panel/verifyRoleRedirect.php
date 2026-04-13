<?php
    error_reporting(0);
    include_once('../assets/config.php');
    if(isset($_SESSION['uid'])){

        $userId = $_SESSION['uid'];
        $sql = 'SELECT `role` FROM `users` WHERE `users`.`id`=? ;';

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $row = mysqli_fetch_assoc($result);
        if($row['role'] == 'student'){
            // Globally fetch student data for the sidebar/header
            $stmt_data = $conn->prepare("SELECT * FROM students WHERE id=?");
            $stmt_data->bind_param("s", $userId);
            $stmt_data->execute();
            $user_data = $stmt_data->get_result()->fetch_assoc();
        }else{
            include_once('../assets/logout.php');
            header("Location: " . BASE_URL . "login.php");
            exit();
        }

    }
?>
