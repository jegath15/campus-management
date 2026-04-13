<?php
session_start();
include('../assets/config.php');
if(!isset($_SESSION['uid']) || $_SESSION['role'] !== 'parent'){
   header("Location: " . BASE_URL);
   exit();
}

$user_id = $_SESSION['uid'];

// Optimized Prepared Statement
$stmt = $conn->prepare("
    SELECT s.id as student_id, s.fname, s.lname, s.image, s.class, s.section, f.total_fee, f.paid_amount, f.status
    FROM parents p
    JOIN students s ON p.student_id COLLATE utf8mb4_general_ci = s.id COLLATE utf8mb4_general_ci
    LEFT JOIN fees f ON s.id COLLATE utf8mb4_general_ci = f.student_id COLLATE utf8mb4_general_ci
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

$student_name = ($data['fname'] ?? '') . ' ' . ($data['lname'] ?? '');
$student_id = $data['student_id'] ?? '';
$class = $data['class'] ?? '';
$image = $data['image'] ?? '1.jpeg';
$img_path = $image ? "../studentUploads/$image" : "../images/1.jpeg";

// Calculate attendance
$attendance_percentage = 0;
$present_days = 0;
$total_days = 1;

$stmt_att = $conn->prepare("SELECT COUNT(*) as total, SUM(CASE WHEN attendence='1' THEN 1 ELSE 0 END) as present FROM attendence WHERE student_id=?");
if ($stmt_att) {
    $stmt_att->bind_param("s", $student_id);
    $stmt_att->execute();
    $res_att = $stmt_att->get_result();
    if ($res_att) {
        $att_data = $res_att->fetch_assoc();
        $total_days = (isset($att_data['total']) && $att_data['total'] > 0) ? $att_data['total'] : 1; 
        $present_days = $att_data['present'] ?? 0;
        $attendance_percentage = round(($present_days / $total_days) * 100);
    }
}

// Fetch Notices
$notice_res = null;
$stmt_not = $conn->prepare("SELECT * FROM notice WHERE (role COLLATE utf8mb4_general_ci ='parent') OR (role COLLATE utf8mb4_general_ci ='all') OR (role COLLATE utf8mb4_general_ci ='') ORDER BY s_no DESC LIMIT 3");
if ($stmt_not) {
    $stmt_not->execute();
    $notice_res = $stmt_not->get_result();
}

$active_page = 'dashboard';
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('dashboard'); ?> | CMS</title>
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
            <h1><?php echo t('parental_overview'); ?></h1>
            
            <div class="subjects" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                <!-- Fee Summary Widget -->
                <div class="premium-card">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                        <span class="material-icons-sharp" style="color: var(--primary);">account_balance_wallet</span>
                        <h3><?php echo t('fee_summary'); ?></h3>
                    </div>
                    <div class="fee-info" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span><?php echo t('total_payable'); ?>:</span>
                        <b>₹<?php echo $data['total_fee'] ?? '0'; ?></b>
                    </div>
                    <div class="fee-info" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span><?php echo t('paid_amount'); ?>:</span>
                        <b class="text-success">₹<?php echo $data['paid_amount'] ?? '0'; ?></b>
                    </div>
                    <hr style="border: 0.5px solid var(--glass-border); margin: 15px 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="text-muted"><?php echo t('status'); ?>: <?php echo $data['status'] ?? 'N/A'; ?></span>
                        <a href="payment.php" class="btn" style="padding: 10px 20px;"><?php echo t('pay_now'); ?></a>
                    </div>
                </div>

                <!-- Academic Progress Widget -->
                <div class="premium-card glass">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
                        <span class="material-icons-sharp" style="color: var(--success);">analytics</span>
                        <h3><?php echo t('academic_progress'); ?></h3>
                    </div>
                    <div style="text-align: center;">
                        <h2 style="font-size: 2.5rem; color: var(--primary);"><?php echo $attendance_percentage; ?>%</h2>
                        <p class="text-muted"><?php echo t('total_presence'); ?></p>
                        <br>
                        <div style="display: flex; justify-content: center; gap: 20px;">
                            <div>
                                <b><?php echo $present_days; ?></b>
                                <p><small><?php echo t('present'); ?></small></p>
                            </div>
                            <div>
                                <b><?php echo $total_days - $present_days; ?></b>
                                <p><small><?php echo t('absent'); ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about premium-card mt-4" style="margin-top: 2rem;">
                <h3 style="margin-bottom: 1rem; color: var(--primary);"><span class="material-icons-sharp">info</span> <?php echo t('student_profile'); ?></h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                    <div>
                        <h5><?php echo t('student_name'); ?></h5>
                        <p><?php echo $student_name ?: 'N/A'; ?></p>
                    </div>
                    <div>
                        <h5><?php echo t('class_section'); ?></h5>
                        <p><?php echo $class ? "$class - " . ($data['section'] ?? '') : 'N/A'; ?></p>
                    </div>
                </div>
            </div>
        </main>

        <div class="right">
            <div class="announcements">
                <h2><?php echo t('campus_notices'); ?></h2>
                <div class="updates premium-card">
                    <div class="message">
                        <?php
                        if ($notice_res && $notice_res->num_rows > 0) {
                            while ($row_n = $notice_res->fetch_assoc()) {
                                echo "<div class='notice-item' style='margin-bottom:1.5rem;'>
                                    <h4 style='color: var(--primary);'>" . $row_n['title'] . "</h4>
                                    <p style='font-size:0.9rem;'>" . $row_n['body'] . "</p>";
                                if (!empty($row_n['file'])) {
                                    echo "<a href='../noticeUploads/" . $row_n['file'] . "' class='text-danger d-flex align-items-center' style='gap:5px; margin-top:5px;'>
                                        <img src='../student_panel/file.svg' style='width:20px;'> ".t('view_attachment')."</a>";
                                }
                                echo "<small class='text-muted'>" . date('d M, Y', strtotime($row_n['timestamp'])) . "</small>
                                </div><hr style='border: 0.5px solid var(--glass-border);'>";
                            }
                        } else {
                            echo "<p class='text-muted'>".t('no_notices')."</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../student_panel/app.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
    <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>
