<?php
include('../assets/config.php');
if(!isset($_SESSION['uid']) || $_SESSION['role'] !== 'parent'){
   header("Location: " . BASE_URL);
   exit();
}

$user_id = $_SESSION['uid'];

$stmt = $conn->prepare("
    SELECT f.total_fee, f.paid_amount, s.image
    FROM parents p
    JOIN fees f ON p.student_id COLLATE utf8mb4_general_ci = f.student_id COLLATE utf8mb4_general_ci
    JOIN students s ON p.student_id COLLATE utf8mb4_general_ci = s.id COLLATE utf8mb4_general_ci
    WHERE p.user_id COLLATE utf8mb4_general_ci = ?
");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

$pending = ($data['total_fee'] ?? 0) - ($data['paid_amount'] ?? 0);
$image = $data['image'] ?? '1.jpeg';
$img_path = $image ? "../studentUploads/$image" : "../images/1.jpeg";
$active_page = 'payment';
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('payment'); ?> | CMS</title>
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
            <h1><?php echo t('online_payment'); ?></h1>
            <div class="subjects">
                <div class="premium-card" style="margin-top:1rem; max-width: 600px;">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 20px;">
                        <span class="material-icons-sharp" style="color: var(--primary);">payment</span>
                        <h3><?php echo t('payment_portal'); ?></h3>
                    </div>
                    
                    <div style="background: var(--color-light); padding: 1.5rem; border-radius: 12px; margin-bottom: 20px;">
                        <p style="margin-bottom: 0.5rem;"><?php echo t('amount_due'); ?>:</p>
                        <h2 style="color: var(--danger); font-size: 2rem;">₹<?php echo $pending; ?></h2>
                    </div>

                    <form action="<?php echo BASE_URL; ?>parent_panel/upload-payment.php" method="POST">
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem;"><?php echo t('card_holder_name'); ?></label>
                            <input type="text" placeholder="John Doe" style="width: 100%; padding: 1rem; border: 1px solid var(--color-light); border-radius: 8px; background: var(--color-white); color: var(--color-dark);">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem;"><?php echo t('card_number'); ?></label>
                            <input type="text" placeholder="XXXX XXXX XXXX XXXX" style="width: 100%; padding: 1rem; border: 1px solid var(--color-light); border-radius: 8px; background: var(--color-white); color: var(--color-dark);">
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                            <div>
                                <label style="display: block; margin-bottom: 0.5rem;"><?php echo t('expiry_date'); ?></label>
                                <input type="text" placeholder="MM/YY" style="width: 100%; padding: 1rem; border: 1px solid var(--color-light); border-radius: 8px; background: var(--color-white); color: var(--color-dark);">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 0.5rem;">CVV</label>
                                <input type="text" placeholder="XXX" style="width: 100%; padding: 1rem; border: 1px solid var(--color-light); border-radius: 8px; background: var(--color-white); color: var(--color-dark);">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn" style="width: 100%; padding: 1.2rem; font-weight: 700;">
                            <?php echo t('pay_securely'); ?> ₹<?php echo $pending; ?>
                        </button>
                    </form>
                    
                    <div style="margin-top: 1.5rem; text-align: center;">
                        <p class="text-muted" style="font-size: 0.8rem;"><span class="material-icons-sharp" style="font-size: 1rem; vertical-align: middle;">lock</span> <?php echo t('secure_ssl_payment'); ?></p>
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
