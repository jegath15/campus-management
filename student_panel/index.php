<?php 
// student_panel/index.php
include('partials/_header.php'); 
$active_page = 'home';

// Fetch student specific data
$id = $_SESSION['uid'];
$query_student = "SELECT * FROM students WHERE id=?";
$stmt = $conn->prepare($query_student);
$stmt->bind_param("s", $id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();

if (!$user_data) {
    header('Location: logout.php');
    exit();
}
?>

<!-- Legacy Administrative Sidebar Layout -->
<?php include('partials/_sidebar.php'); ?>

<div class="content">
    <?php include("partials/_navbar.php"); ?>
    
    <main style="padding: 36px 24px; min-height: calc(100vh - 56px); background: var(--grey);">
        <div class="header" style="margin-bottom: 30px;">
            <div class="left" style="margin-left: 20px;">
                <h1>Dashboard</h1>
                <ul class="breadcrumb" style="list-style: none; display: flex; gap: 10px; color: var(--text-muted); padding: 0;">
                    <li>Analytics</li>
                    <li>></li>
                    <li class="active" style="color: var(--primary);">System Status</li>
                </ul>
            </div>
        </div>

        <ul class="insights">
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bx-book-open' style="font-size: 2rem; color: #0d6efd; background: #e7f0ff; padding: 20px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 style="font-size: 1.8rem; font-weight: 700;">1</h3>
                    <p style="color: #64748b;">Academic Progress</p>
                </span>
            </li>
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bx-calendar-check' style="font-size: 2rem; color: #ffc107; background: #fffcf0; padding: 20px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 style="font-size: 1.8rem; font-weight: 700;">1</h3>
                    <p style="color: #64748b;">Attendance</p>
                </span>
            </li>
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bx-news' style="font-size: 2rem; color: #198754; background: #f0fff4; padding: 20px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 style="font-size: 1.8rem; font-weight: 700;">3</h3>
                    <p style="color: #64748b;">Bulletins</p>
                </span>
            </li>
        </ul>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-news'></i>
                    <h3>Latest Notices</h3>
                    <i class='bx bx-filter'></i>
                </div>
                <div id="noticeListContainer" style="padding: 20px;">
                    <?php
                    // Fetch latest notices for students
                    $stmt_not = $conn->prepare("SELECT * FROM notice WHERE role='student' OR role='all' ORDER BY s_no DESC LIMIT 3");
                    $stmt_not->execute();
                    $notice_res = $stmt_not->get_result();
                    if ($notice_res->num_rows > 0) {
                        echo "<table><thead><tr><th>Title</th><th>Date</th><th>Sender</th></tr></thead><tbody>";
                        while ($row_n = $notice_res->fetch_assoc()) {
                            echo "<tr>
                                    <td>".$row_n['title']."</td>
                                    <td>".date('d M, Y', strtotime($row_n['timestamp']))."</td>
                                    <td>Administration</td>
                                  </tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p class='text-muted'>No bulletins found.</p>";
                    }
                    ?>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <i class='bx bx-info-circle'></i>
                    <h3>Quick Links</h3>
                    <div class="dropdown">
                        <i class='bx bx-dots-vertical-rounded' data-bs-toggle="dropdown" style="cursor:pointer;"></i>
                        <ul class="dropdown-menu border-0 shadow">
                           <li><a class="dropdown-item" href="timetable.php">Full Schedule</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="task-list">
                    <li onclick="location.href='timetable.php'"><i class='bx bx-chevron-right'></i> Time Table</li>
                    <li onclick="location.href='workspace.php'"><i class='bx bx-chevron-right'></i> My Workspace</li>
                </ul>
            </div>
        </div>
    </main>
</div>

<!-- Bootstrap 5 JS Bundle & Side Menu Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../teacher_panel/script.js"></script>
</body>
</html>
