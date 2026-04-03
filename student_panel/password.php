<?php 
include("../assets/noSessionRedirect.php"); 
include("./verifyRoleRedirect.php"); 
include('../assets/config.php');

$id = $_SESSION['uid'];

// Fetch user data
$query_user = "SELECT * FROM students WHERE id=?";
$stmt_user = $conn->prepare($query_user);
$stmt_user->bind_param("s", $id);
$stmt_user->execute();
$user_data = $stmt_user->get_result()->fetch_assoc();

$active_page = 'password';

// Handle Password Update Logic
if(isset($_POST['submit'])){
    $password = $_POST['current'];
    $newpassword = $_POST['new'];
    $confirmnewpassword = $_POST['repeat'];
    
    $result = mysqli_query($conn, "SELECT password_hash FROM users WHERE id='$id'");
    if($result && $result->num_rows > 0){
        $row = $result->fetch_assoc();
        $pass = $row['password_hash'];
        if(password_verify($password, $pass)){
            if($newpassword == $confirmnewpassword && !empty($newpassword)){
                $newpasswordhash = password_hash($newpassword, PASSWORD_DEFAULT);
                if(mysqli_query($conn, "UPDATE users SET password_hash='$newpasswordhash' where id='$id'")){
                    echo "<script>alert('Password Updated Successfully')</script>";
                } else {
                    echo "<script>alert('Unable to update database')</script>";
                }
            } else {
                echo "<script>alert('New passwords do not match or are empty')</script>";
            }
        } else {
            echo "<script>alert('Incorrect current password')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Settings | CMS</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" href="../shared/style.css">
    <link rel="stylesheet" href="style.css">

    <style>
        .change-password-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 2rem;
            width: 100%;
        }
        
        .password-card {
            width: 100%;
            max-width: 500px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            background-color: var(--bg-card);
            color: var(--text-main);
            outline: none;
        }

        .btn-save {
            width: 100%;
            padding: 12px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-save:hover {
            opacity: 0.9;
        }
    </style>

</head>
<body>
    <?php include('partials/_header.php'); ?>

    <div class="container">
        <?php include('partials/_sidebar.php'); ?>

        <main>
            <h1>Security Settings</h1>
            
            <div class="change-password-container">
                <div class="password-card premium-card">
                    <h2 style="margin-bottom: 0.5rem;"><span class="material-icons-sharp" style="vertical-align: middle;">lock</span> Reset Password</h2>
                    <p class="text-muted" style="margin-bottom: 2rem;">Ensure your account stays secure by using a strong, unique password.</p>
                    
                    <form action="#" method="post">
                        <div class="form-group">
                            <label><?php echo t('current_password') ?? 'Current Password'; ?></label>
                            <input type="password" name="current" required>
                        </div>
                        <div class="form-group">
                            <label><?php echo t('new_password') ?? 'New Password'; ?></label>
                            <input type="password" name="new" required>
                        </div>
                        <div class="form-group">
                            <label><?php echo t('confirm_new_password') ?? 'Confirm New Password'; ?></label>
                            <input type="password" name="repeat" required>
                        </div>
                        
                        <div style="margin-top: 2rem;">
                            <button type="submit" name="submit" class="btn-save">Update Password</button>
                            <a href="index.php" style="display: block; text-align: center; margin-top: 1rem; color: var(--text-muted); text-decoration: none;">Cancel</a>
                        </div>
                    </form> 
                </div>
            </div>
        </main>
    </div>

    <script src="app.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
    <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>
