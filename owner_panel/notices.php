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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <title>CMS</title>
    <style type="text/css">
        .premium-card {
            border-left: 5px solid var(--primary);
        }
        .badge {
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
        .leading-relaxed {
            line-height: 1.6;
            color: #4b5563;
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
                    <li class="nav-item"><a class="nav-link active fw-semibold text-primary" href="notices.php">Bulletin</a></li>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold m-0">Campus Bulletins</h2>
                <p class="text-muted small mb-0">Broadcast important announcements to specific departments.</p>
            </div>
            <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#noticeModal">
                <i class='bx bx-plus-circle me-1'></i> Create Announcement
            </button>
        </div>

        <div class="row g-4">
            <?php 
            $sql_query = "SELECT * FROM notice ORDER BY s_no DESC";
            $result = mysqli_query($conn, $sql_query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $title = htmlspecialchars($row['title']);
                    $body = htmlspecialchars($row['body']);
                    $role = htmlspecialchars($row['role']) ?: 'All';
                    $class = htmlspecialchars($row['class']);
                    
                    echo '
                    <div class="col-12">
                        <div class="premium-card position-relative overflow-hidden">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-2">To: ' . ucfirst($role) . ($role == 'student' ? ' (Class ' . $class . ')' : '') . '</span>
                                    <h3 class="fw-bold mb-1">' . $title . '</h3>
                                    <small class="text-muted"><i class="bx bx-time-five me-1"></i>' . date("d M, Y | H:i", strtotime($row['timestamp'])) . '</small>
                                </div>
                                <button type="button" class="btn btn-light btn-sm rounded-circle delete" data-id="' . $row['s_no'] . '" style="width:35px; height:35px;">
                                    <i class="bx bx-trash text-danger"></i>
                                </button>
                            </div>
                            <p class="text-secondary mb-3 leading-relaxed">' . $body . '</p>';
                            
                    if (!empty($row['file'])) {
                        $file_path = '../noticeUploads/' . $row['file'];
                        if (file_exists($file_path)) {
                            echo '<a href="' . $file_path . '" download class="btn btn-outline-primary btn-sm rounded-pill px-4">
                                    <i class="bx bx-download me-1"></i> Attachment
                                  </a>';
                        }
                    }
                    echo '</div>
                    </div>';
                }
            } else {
                echo '<div class="col-12 text-center py-5">
                        <i class="bx bx-news display-1 text-muted opacity-25"></i>
                        <p class="text-muted mt-3">No announcements found in the database.</p>
                      </div>';
            }
            ?>
        </div>
    </div>

    <!-- Re-implemented Modal with modern styling -->
    <div class="modal fade" id="noticeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 pb-0 px-4 pt-4">
                    <h5 class="fw-bold">New Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">TARGET AUDIENCE</label>
                        <select class="form-select rounded-3" id="select" required>
                            <option value="none" selected disabled>Select Role</option>
                            <option value="student">Students</option>
                            <option value="teacher">Teachers</option>
                            <option value="admin">Administrators</option>
                            <option value="all">Universal (All Roles)</option>
                        </select>
                    </div>
                    <div class="mb-3" id="class-container" style="display:none;">
                        <label class="form-label small fw-bold text-muted">ACADEMIC YEAR</label>
                        <select class="form-select rounded-3" id="class">
                            <option value="12c">YEAR I</option>
                            <option value="11m">YEAR II</option>
                            <option value="11b">YEAR III</option>
                            <option value="11c">YEAR IV</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">TITLE</label>
                        <input type="text" class="form-control rounded-3" id="title" placeholder="e.g. Annual Maintenance Schedule" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">DETAILED MESSAGE</label>
                        <textarea class="form-control rounded-3" id="message" rows="4" placeholder="Enter the bulletin content..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#noticeModal">Cancel</button>
                    <button type="button" class="btn btn-primary rounded-pill px-4" id="send">Broadcast Notice</button>
                </div>
            </div>
        </div>
    </div>


    
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
<script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
  <script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete').forEach(function(button) {
        button.addEventListener('click', function() {
            var result = window.confirm("Are you sure you want to delete this notice?");
            if (result) {
                var noticeId = button.getAttribute('data-id');
                fetch('fetch-data/notice-delete.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'noticeId=' + encodeURIComponent(noticeId)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    console.log(data);
                    location.reload();
                    // Handle success response here if needed
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
            } else {
                console.log("Not deleted");
            }
        });
    });
});

  </script>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var classContainer = document.getElementById('class-container');
        var classElement = document.getElementById('class');

        function handlePanelChange() {
            var panel = document.getElementById('select').value;
            if (panel === 'student') {
                classContainer.style.display = 'block';
            } else {
                classContainer.style.display = 'none';
            }
        }

        document.getElementById('select').addEventListener('change', handlePanelChange);

        document.getElementById('send').addEventListener('click', function() {
            var panel = document.getElementById('select').value;
            var cla = document.getElementById('class').value;
            var title = document.getElementById('title').value;
            var message = document.getElementById('message').value;

            fetch('fetch-data/send-notice.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'panel=' + encodeURIComponent(panel) +
                    '&cla=' + encodeURIComponent(cla) +
                    '&title=' + encodeURIComponent(title) +
                    '&message=' + encodeURIComponent(message),
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(function(data) {
                alert('notice send successfully');
                location.reload();
                // You can add more handling here, such as displaying a success message
            })
            .catch(function(error) {
                console.error('There was a problem with the fetch operation:', error);
                // You can add more error handling here
            });
        });
    });
</script>


  </html>
