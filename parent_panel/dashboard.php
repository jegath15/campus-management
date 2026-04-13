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

<!-- Reversion to Administrative Sidebar Layout -->
<?php include('partials/_sidebar.php') ?>

<div class="content">
    <?php include("../admin_panel/partials/_navbar.php"); ?>

    <main>
        <div class="header" style="padding: 0 20px;">
            <div class="left">
                <h1>Guardian Overview</h1>
                <ul class="breadcrumb" style="list-style: none; display: flex; gap: 10px; color: var(--text-muted); padding: 0;">
                    <li>Dashboard</li>
                    <li>></li>
                    <li class="active" style="color: var(--primary);">Real-time Stats</li>
                </ul>
            </div>
        </div>

        <ul class="insights">
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-graduation' style="font-size: 2.5rem; color: var(--primary); background: var(--light-primary); padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3><?php echo $data['fname'] . " " . $data['lname']; ?></h3>
                    <p>Student Profile</p>
                </span>
            </li>
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-bank' style="font-size: 2.5rem; color: var(--success); background: var(--light-success); padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3>₹<?php echo $data['paid_amount'] ?? '0'; ?></h3>
                    <p>Fees Paid</p>
                </span>
            </li>
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-error-circle' style="font-size: 2.5rem; color: var(--danger); background: var(--light-danger); padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3><?php echo strtoupper($data['status'] ?? 'N/A'); ?></h3>
                    <p>Fee Status</p>
                </span>
            </li>
        </ul>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-bell'></i>
                    <h3>Latest Notices</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt_not = $conn->prepare("SELECT * FROM notice WHERE role='parent' OR role='all' ORDER BY s_no DESC LIMIT 3");
                        $stmt_not->execute();
                        $notice_res = $stmt_not->get_result();
                        while($row_n = $notice_res->fetch_assoc()){
                            echo "<tr><td>".$row_n['title']."</td><td>".date('d M, Y', strtotime($row_n['timestamp']))."</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="reminders">
                <div class="header">
                    <i class='bx bx-link-external'></i>
                    <h3>Quick Actions</h3>
                </div>
                <ul class="task-list">
                    <li onclick="location.href='fee-details.php'"><i class='bx bx-check-double'></i> View Fee Details</li>
                    <li onclick="location.href='payment.php'"><i class='bx bx-upload'></i> Upload Payment Proof</li>
                </ul>
            </div>
        </div>
    </main>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
