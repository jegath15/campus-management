<?php 
// parent_panel/dashboard.php
include('partials/_header.php'); 
$active_page = 'dashboard';

$user_id = $_SESSION['uid'];

// Fetch student/fee data
$stmt = $conn->prepare("
    SELECT s.id as student_id, s.fname, s.lname, s.image, s.class, s.section, f.total_fee, f.paid_amount, f.status
    FROM parents p
    JOIN students s ON p.student_id = s.id
    LEFT JOIN fees f ON s.id = f.student_id
    WHERE p.user_id = ?
");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<!-- Legacy Administrative Sidebar Layout -->
<?php include('partials/_sidebar.php') ?>

<div class="content">
    <?php include("../admin_panel/partials/_navbar.php"); ?>

    <main style="padding: 36px 24px; min-height: calc(100vh - 56px); background: var(--grey);">
        <div class="header" style="margin-bottom: 30px;">
            <div class="left">
                <h1>Guardian Overview</h1>
                <ul class="breadcrumb" style="list-style: none; display: flex; gap: 10px; color: var(--text-muted); padding: 0;">
                    <li>Dashboard</li>
                    <li>></li>
                    <li class="active" style="color: var(--primary);">Real-time Stats</li>
                </ul>
            </div>
        </div>

        <!-- Insights as Pixel-Perfect Original Cards (Solid Icon Square) -->
        <ul class="insights">
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-graduation' style="font-size: 2rem; color: #0d6efd; background: #e7f0ff; padding: 20px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 style="font-size: 1.5rem; font-weight: 700;"><?php echo $data['fname'] . " " . $data['lname']; ?></h3>
                    <p style="color: #64748b;">Student Profile</p>
                </span>
            </li>
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-bank' style="font-size: 2rem; color: #198754; background: #f0fff4; padding: 20px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 style="font-size: 1.5rem; font-weight: 700;">₹<?php echo $data['paid_amount'] ?? '0'; ?></h3>
                    <p style="color: #64748b;">Fees Paid</p>
                </span>
            </li>
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-error-circle' style="font-size: 2.5rem; color: #dc3545; background: #fff5f5; padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #dc3545;"><?php echo strtoupper($data['status'] ?? 'N/A'); ?></h3>
                    <p style="color: #64748b;">Fee Status</p>
                </span>
            </li>
        </ul>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-news'></i>
                    <h3>Campus Messages</h3>
                    <i class='bx bx-filter'></i>
                </div>
                <div style="padding: 20px;">
                    <p class="text-muted">Viewing official correspondence for <strong><?php echo $data['fname']; ?></strong>...</p>
                    <hr>
                    <p>No new messages found.</p>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <i class='bx bx-calendar'></i>
                    <h3>Events</h3>
                    <i class='bx bx-plus'></i>
                </div>
                <ul class="task-list">
                    <li><i class='bx bx-chevron-right'></i> Parent-Teacher Meeting (TBA)</li>
                    <li><i class='bx bx-chevron-right'></i> Annual Sports Day</li>
                </ul>
            </div>
        </div>
    </main>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
