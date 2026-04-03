
<?php
include("../assets/noSessionRedirect.php"); 
include('./fetch-data/verfyRoleRedirect.php');

error_reporting(0);
?>
<?php
   include("../assets/config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <title>CMS</title>
    <style type="text/css">
      .payment{
        margin-bottom: 10%;
      }
      @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}
    </style>
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
                    <li class="nav-item"><a class="nav-link fw-semibold" href="index.php">Overview</a></li>
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

    <div class="container py-5 mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="premium-card text-center">
                    <h3 class="fw-bold mb-4">Payment QR Authorization</h3>
                    <div class="qr-container bg-white p-4 rounded-3 shadow-sm mb-4">
                        <?php
                            // Dynamic QR selection with specific case handling
                            $teacher_id = $_POST['teacher_id'] ?? '';
                            if($teacher_id == 'T1703597586'){
                                echo "<img src='img/arzoo.jpg' class='img-fluid' style='max-width:300px;'>";
                            }
                            else if($teacher_id == 'T1703574415'){
                                echo "<img src='img/qr2.jpg' class='img-fluid' style='max-width:300px;'>";
                            }
                            else{
                                echo " <img src='../images/FEEQR.jpg' class='img-fluid' style='max-width:300px;'> ";
                            }
                        ?>
                    </div>
                    <div class="info-box py-3 px-4 bg-light rounded-3 mb-4 text-start">
                        <div class="d-flex align-items-center gap-2 mb-2">
                             <i class='bx bx-info-circle text-primary'></i>
                             <label class="fw-bold mb-0">Authorized Transaction</label>
                        </div>
                        <p class="text-muted small mb-0">Please scan the code above using any UPI application to complete the payroll disbursement for ID: <b><?php echo htmlspecialchars($teacher_id); ?></b></p>
                    </div>
                    <div class="d-grid">
                        <a href="make-payment.php" class="btn btn-primary rounded-pill py-3 fw-bold">Return to Payroll</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
    <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>
