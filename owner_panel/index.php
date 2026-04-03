<?php
include("../assets/config.php");
include("../assets/noSessionRedirect.php"); 
include('./fetch-data/verfyRoleRedirect.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION['uid']) || $_SESSION['role'] !== 'owner') {
    header("Location: ../index.php");
    exit();
}
$uid = $_SESSION['uid'];

// Prepared Statements for counts
$stmt_t = $conn->prepare("SELECT COUNT(*) as total FROM users WHERE role='teacher'");
$stmt_t->execute();
$teacher_count = $stmt_t->get_result()->fetch_assoc()['total'];

$stmt_s = $conn->prepare("SELECT COUNT(*) as total FROM users WHERE role='student'");
$stmt_s->execute();
$student_count = $stmt_s->get_result()->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../images/1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../shared/style.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Owner Dashboard | Elite CMS</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg glass-nav sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <img src="../images/1.jpeg" style="width:2.5rem;height:2.5rem;border-radius:12px;">
                <h2 class="m-0 fw-bold">Elite <span class="text-primary">CMS</span></h2>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#ownerNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="ownerNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-3">
                    <li class="nav-item"><a class="nav-link active fw-semibold" href="index.php">Overview</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="notices.php">Bulletin</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">Finances</a>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item" href="make-payment.php">Payroll Management</a></li>
                            <li><a class="dropdown-item" href="see-payment.php">Transaction Audit</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="change-password.php">Security</a></li>
                    <li class="nav-item"><a class="nav-link text-danger fw-bold" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-5 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold">Executive Dashboard</h1>
                <p class="text-muted">Real-time institutional oversight and analytics.</p>
            </div>
            <div class="date-chip px-3 py-2 bg-white rounded-pill shadow-sm">
                <i class='bx bx-calendar text-primary me-2'></i>
                <span class="fw-medium"><?php echo date('D, d M Y'); ?></span>
            </div>
        </div>

        <div class="main">
            <!-- Faculty Metrics -->
            <div class="premium-card d-flex flex-column gap-3">
                <div class="d-flex justify-content-between">
                    <i class='bx bxs-briefcase-alt-2 fs-1 text-primary'></i>
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">Active Faculty</span>
                </div>
                <div>
                    <h2 class="display-5 fw-bold mb-0"><?php echo $teacher_count; ?></h2>
                    <p class="text-muted">Total Registered Educators</p>
                </div>
                <a href="teacher-list.php" class="btn btn-primary rounded-pill mt-auto fw-bold py-2 shadow-sm" style="background-color: #4361ee !important; border: none; color: white !important;">Manage Faculty</a>
            </div>

            <!-- Student Metrics -->
            <div class="premium-card d-flex flex-column gap-3">
                <div class="d-flex justify-content-between">
                    <i class='bx bxs-group fs-1 text-success'></i>
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Enrollment</span>
                </div>
                <div>
                    <h2 class="display-5 fw-bold mb-0"><?php echo $student_count; ?></h2>
                    <p class="text-muted">Currently Enrolled Students</p>
                </div>
                <a href="student-list.php" class="btn btn-success rounded-pill mt-auto fw-bold py-2 shadow-sm text-white" style="background-color: #2ec4b6 !important; border: none; color: white !important;">View Statistics</a>
            </div>

            <!-- System Status -->
            <div class="premium-card d-flex flex-column gap-3 status-card shadow-lg border-0" style="background: linear-gradient(135deg, #4361ee, #3a0ca3); color: white;">
                <div class="d-flex justify-content-between">
                    <i class='bx bxs-zap fs-1'></i>
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm" style="font-weight: 700;">v3.1 Elite</span>
                </div>
                <div>
                    <h2 class="h3 fw-bold mb-1 mt-2">System Healthy</h2>
                    <p class="opacity-90 small">All institutional modules are operational and synchronized.</p>
                </div>
                <div class="mt-auto d-flex gap-2">
                    <div class="px-3 py-3 rounded-4 bg-white bg-opacity-25 flex-grow-1 text-center border border-white border-opacity-25 shadow-sm">
                        <small class="d-block opacity-100 fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">LATENCY</small>
                        <b class="fs-5">24ms</b>
                    </div>
                    <div class="px-3 py-3 rounded-4 bg-white bg-opacity-25 flex-grow-1 text-center border border-white border-opacity-25 shadow-sm">
                        <small class="d-block opacity-100 fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">UPTIME</small>
                        <b class="fs-5">99.9%</b>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-5 py-4 bg-white border-top">
        <div class="container text-center">
            <span class="text-muted">© <?php echo date('Y'); ?> <b class="text-dark">Elite Campus Management System</b>. Developed by Deepmind Agents.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
    <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>

