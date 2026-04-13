<?php
include('../assets/config.php');
if(!isset($_SESSION['uid']) || $_SESSION['role'] !== 'parent'){
   header("Location: ../index.php");
   exit();
}

$user_id = $_SESSION['uid'];

$stmt = $conn->prepare("
    SELECT s.image
    FROM parents p
    JOIN students s ON p.student_id = s.id
    WHERE p.user_id=?
");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

$image = $data['image'] ?? '1.jpeg';
$img_path = $image ? "../studentUploads/$image" : "../images/1.jpeg";

// Fetch Notices
$stmt_not = $conn->prepare("SELECT * FROM notice WHERE role='parent' OR role='all' OR role='' ORDER BY s_no DESC");
$stmt_not->execute();
$notice_res = $stmt_not->get_result();

$active_page = 'notices';
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('campus_notices'); ?> | CMS</title>
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
            <h1><?php echo t('campus_notices'); ?></h1>
            <div class="subjects">
                <div class="notices-container" style="margin-top:1rem; display: grid; gap: 1.5rem;">
                    <?php
                    if ($notice_res->num_rows > 0) {
                        while ($row_n = $notice_res->fetch_assoc()) {
                            echo "<div class='premium-card glass' style='padding: 2rem; position: relative;'>
                                <div style='display: flex; justify-content: space-between; align-items: flex-start;'>
                                    <h2 style='color: var(--primary); margin-bottom: 0.5rem;'>" . $row_n['title'] . "</h2>
                                    <small class='text-muted'>" . date('d M, Y', strtotime($row_n['timestamp'])) . "</small>
                                </div>
                                <p style='font-size: 1rem; line-height: 1.6; margin: 1rem 0;'>" . $row_n['body'] . "</p>";
                            
                            if (!empty($row_n['file'])) {
                                echo "<div style='margin-top: 1.5rem; border-top: 1px solid var(--color-light); padding-top: 1rem;'>
                                    <a href='../noticeUploads/" . $row_n['file'] . "' class='btn danger' style='display: inline-flex; align-items: center; gap: 8px;'>
                                        <span class='material-icons-sharp'>file_download</span> " . t('download_attachment') . "
                                    </a>
                                </div>";
                            }
                            echo "</div>";
                        }
                    } else {
                        echo "<div class='premium-card' style='text-align: center; padding: 3rem;'>
                            <span class='material-icons-sharp' style='font-size: 4rem; color: var(--color-light);'>inbox</span>
                            <p class='text-muted' style='margin-top: 1rem; font-size: 1.2rem;'>" . t('no_notices') . "</p>
                        </div>";
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>
    
    <script src="../student_panel/app.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
    <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>
