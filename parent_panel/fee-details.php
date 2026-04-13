<?php
include('../assets/config.php');
if(!isset($_SESSION['uid']) || $_SESSION['role'] !== 'parent'){
   header("Location: ../index.php");
   exit();
}

$user_id = $_SESSION['uid'];

$stmt = $conn->prepare("
    SELECT f.total_fee, f.paid_amount, f.due_date, f.status, s.image
    FROM parents p
    JOIN fees f ON p.student_id COLLATE utf8mb4_general_ci = f.student_id COLLATE utf8mb4_general_ci
    JOIN students s ON p.student_id COLLATE utf8mb4_general_ci = s.id COLLATE utf8mb4_general_ci
    WHERE p.user_id COLLATE utf8mb4_general_ci = ?
");

$data = null;
if ($stmt) {
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
        $data = $result->fetch_assoc();
    }
}

$pending = ($data['total_fee'] ?? 0) - ($data['paid_amount'] ?? 0);
$image = $data['image'] ?? '1.jpeg';
$img_path = $image ? "../studentUploads/$image" : "../images/1.jpeg";
$active_page = 'fees';
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('fee_details'); ?> | CMS</title>
    <link rel="shortcut icon" href="../images/1.jpeg">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../shared/style.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include('partials/_header.php'); ?>

    <div class="container">
        <?php include('partials/_sidebar.php'); ?>

        <main>
            <h1><?php echo t('fee_details'); ?></h1>
            <div class="subjects">
                <div class="premium-card" style="margin-top:1rem;">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 20px;">
                        <span class="material-icons-sharp" style="color: var(--primary);">account_balance_wallet</span>
                        <h3><?php echo t('fee_status_overview'); ?></h3>
                    </div>
                    
                    <div class="detail-row" style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid var(--color-light);">
                        <span><?php echo t('total_fee'); ?>:</span>
                        <b style="font-size: 1.2rem;">₹<?php echo $data['total_fee'] ?? 0; ?></b>
                    </div>
                    <div class="detail-row" style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid var(--color-light);">
                        <span><?php echo t('paid_amount'); ?>:</span>
                        <b class="text-success" style="font-size: 1.2rem;">₹<?php echo $data['paid_amount'] ?? 0; ?></b>
                    </div>
                    <div class="detail-row" style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid var(--color-light);">
                        <span><?php echo t('pending_amount'); ?>:</span>
                        <b class="text-danger" style="font-size: 1.2rem;">₹<?php echo $pending; ?></b>
                    </div>
                    <div class="detail-row" style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid var(--color-light);">
                        <span><?php echo t('due_date'); ?>:</span>
                        <b><?php echo $data['due_date'] ?? 'N/A'; ?></b>
                    </div>
                    <div class="detail-row" style="display: flex; justify-content: space-between; padding: 1rem 0;">
                        <span><?php echo t('status'); ?>:</span>
                        <span class="btn <?php echo ($data['status'] == 'Paid') ? 'success' : 'danger'; ?>" style="padding: 5px 15px;"><?php echo $data['status'] ?? 'N/A'; ?></span>
                    </div>

                    <div style="margin-top: 2rem;">
                         <a href="payment.php" class="btn" style="width: 100%; text-align: center; padding: 1rem;"><?php echo t('proceed_to_payment'); ?></a>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script src="../student_panel/app.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
    <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>
