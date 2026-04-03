<?php
include("../assets/noSessionRedirect.php"); 
include('./fetch-data/verfyRoleRedirect.php');

error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../images/1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <title>CMS</title>
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
                    <li class="nav-item"><a class="nav-link fw-semibold" href="index.php">Overview</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="notices.php">Bulletin</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold text-primary" href="#" role="button" data-bs-toggle="dropdown">Finances</a>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item" href="make-payment.php">Payroll Management</a></li>
                            <li><a class="dropdown-item active" href="see-payment.php">Transaction Audit</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="change-password.php">Security</a></li>
                    <li class="nav-item"><a class="nav-link text-danger fw-bold" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <h2 class="fw-bold mb-4">Transaction Audit Log</h2>
        <div class="row g-4">
            <?php
            $sql = "SELECT * FROM payroll ORDER BY s_no DESC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <div class="col-md-6 col-lg-4">
                        <div class="premium-card h-100 d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Paid Successfully</span>
                                <small class="text-muted">' . $row['date'] . '</small>
                            </div>
                            <h4 class="fw-bold mt-2">Payroll: ' . $row['name'] . '</h4>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Amount</span>
                                <h3 class="fw-bold text-primary mb-0">₹' . number_format($row['amount']) . '</h3>
                            </div>
                            <hr class="my-2 opacity-10">
                            <div class="small">
                                <p class="mb-1 text-muted">Account: <span class="text-dark fw-medium">' . $row['account_no'] . '</span></p>
                                <p class="mb-0 text-muted">IFSC: <span class="text-dark fw-medium">' . $row['ifsc_code'] . '</span></p>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<div class="col-12 text-center py-5">
                        <i class="bx bx-receipt display-1 text-muted opacity-25"></i>
                        <p class="text-muted mt-3">No recent transactions found.</p>
                      </div>';
            }
            ?>
        </div>
    </div>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
<script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
  </html>
