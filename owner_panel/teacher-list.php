
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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <title>SMS</title>
</head>
<body>
    <div class="header">
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
    </div>
    <div class="container py-5 mt-4">
            <div class="d-flex gap-3">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                        <i class='bx bx-search text-muted'></i>
                    </span>
                    <input type="text" class="form-control border-start-0 rounded-end-pill px-3" id="search-teacher" placeholder="Search faculty by name..." style="min-width: 250px;">
                </div>
            </div>
        </div>

        <div class="premium-card p-0 overflow-hidden border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="px-4 py-3">REF ID</th>
                            <th class="py-3">FULL NAME</th>
                            <th class="py-3">GENDER</th>
                            <th class="px-4 py-3 text-end">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="tb" class="border-0">
                        <!-- Data fetched via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        function load_table(){$.ajax({
          url: "fetch-data/fetch-teachers.php",
          method: "POST",
          success: function(data){
             $("#tb").html(data);
          }
        });
      }
      load_table();

        $("#search-teacher").on("keyup",function(){
          var search=$(this).val();
          $.ajax({
              url: "fetch-data/search-teacher.php",
              type: "POST",
              data: {search: search},
              success: function(data){
                  $("#tb").html(data);
              }
        });
        });
        
      
      });

     


    </script>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
<script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
  </html>
