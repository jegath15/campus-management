
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
                        <a class="nav-link dropdown-toggle fw-semibold text-primary" href="#" role="button" data-bs-toggle="dropdown">Finances</a>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item active" href="make-payment.php">Payroll Management</a></li>
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
            <div class="col-lg-8 col-xl-6">
                <div class="premium-card">
                    <h2 class="fw-bold mb-4 text-center">Payroll Disbursement</h2>
                    <p class="text-muted text-center mb-5">Initialize secure salary payments for institutional faculty members.</p>
                    
                    <form action="qr.php" method="POST" class="d-flex flex-column gap-4 px-md-3">
                        <div class="form-group">
                            <label class="form-label small fw-bold text-muted px-2">FACULTY MEMBER</label>
                            <?php
                            $sql = "SELECT * FROM teachers";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0) {
                                echo "<select class='form-select rounded-pill py-3 px-4 shadow-sm' name='teacher_id' required>";
                                echo "<option value='' selected disabled>Select Faculty Member</option>";
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['id']}'>{$row['fname']} {$row['lname']} ({$row['id']})</option>";
                                }
                                echo "</select>";
                            } else {
                                echo "<div class='alert alert-info'>No registered faculty found in the database.</div>";
                            }
                            ?>
                        </div>

                        <div class="form-group">
                            <label class="form-label small fw-bold text-muted px-2">PAYMENT DESCRIPTION</label>
                            <input type="text" name="payment_title" class="form-control rounded-pill py-3 px-4 shadow-sm" placeholder="e.g. Monthly Salary - April 2026" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label small fw-bold text-muted px-2">DISBURSEMENT AMOUNT (INR)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-4">₹</span>
                                <input type="number" name="amount" class="form-control border-start-0 rounded-end-pill py-3 pe-4 shadow-sm" placeholder="0.00" required>
                            </div>
                        </div>

                        <div class="d-grid mt-2">
                            <button type="submit" class="btn btn-primary rounded-pill py-3 fw-bold">Proceed to Verification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-5 py-4 bg-white border-top">
        <div class="container text-center">
            <span class="text-muted">© <?php echo date('Y'); ?> <b class="text-dark">Elite Campus Management System</b>. Developed by Deepmind Agents.</span>
        </div>
    </footer>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
    <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>

              <div class="row">
                <!-- <div class="col-md-6 mb-4">

                  <div class="form-outline datepicker">
                    <input type="text" class="form-control" id="exampleDatepicker1" />
                    <label for="exampleDatepicker1" class="form-label">Select a date</label>
                  </div>

                </div> -->
                <div class="col-md-6 mb-4">
                 <?php
    $sql = "SELECT * FROM teachers";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        echo "<select class='select' style='width: auto; padding: 10px;' name='teacher_id'>
               <option value='0' disabled>SELECT TEACHER</option>
        ";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['id']}'>{$row['fname']} {$row['lname']}
            </option>";
        }
        echo "</select>
        ";
        echo "<input type='submit' class='btn btn-success btn-lg mb-1' value='Click to Pay' style='margin-top: 5%'>
        ";
    }
?>


<!--                   
                  <label for="exampleDatepicker1" class="form-label">Select Teacher's Name</label>

                </div>
              </div>

              <div class="mb-4">

                <select class="select">
                  <option value="1" disabled>Class</option>
                  <option value="2">Class 1</option>
                  <option value="3">Class 2</option>
                  <option value="4">Class 3</option>
                </select>

              </div>
              <div class="col-md-6 mb-4">

                  <div class="form-outline datepicker">
                    <input type="text" class="form-control" id="exampleDatepicker1" value="3555985449" disabled/>
                    <label for="exampleDatepicker1" class="form-label">Account No: </label>

                    <input type="text" class="form-control" id="exampleDatepicker1" value="CBHI98562" disabled/>
                    <label for="exampleDatepicker1" class="form-label">IFSC CODE:  </label>

                    <input type="text" class="form-control" id="exampleDatepicker1" value="Teacher Name" disabled/>
                    <label for="exampleDatepicker1" class="form-label">Account Holder Name: </label>
                  </div>

                </div>

              <div class="row mb-4 pb-2 pb-md-0 mb-md-5">
                <div class="col-md-6">

                  <div class="form-outline">
                    <input type="text" id="form3Example1w" class="form-control" />
                    <label class="form-label" for="form3Example1w">Amount</label>
                  </div>

                </div>
              </div> -->

              
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    </div>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
<script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
  </html>
