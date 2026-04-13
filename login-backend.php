<?php
include("assets/config.php");
$response = array();

    if ($conn) {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT id, role, password_hash FROM users WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {

                $row = mysqli_fetch_assoc($result);

                if (password_verify($password, $row['password_hash'])) {

                    $_SESSION['uid'] = $row['id'];
                    $_SESSION['role'] = $row['role'];   // 🔥 IMPORTANT

                    $response['status'] = 'success';
                    $response['role'] = $row['role'];

                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Invalid email or password!';
                }

            } else {
                $response['status'] = 'error';
                $response['message'] = 'Invalid email or password!';
            }

            mysqli_stmt_close($stmt);

        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error preparing statement';
        }

    } else {
        $response['status'] = 'error';
        $response['message'] = 'Database connection error';
    }

} else {
    $response['status'] = 'error';
    $response['message'] = 'Both fields are required';
}

echo json_encode($response);
?>
