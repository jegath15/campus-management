<?php 
include("../assets/noSessionRedirect.php"); 
include("./verifyRoleRedirect.php"); 

// Fetch user data once at the top
$id = $_SESSION['uid'];
$query_user = "SELECT * FROM students WHERE id=?";
$stmt = $conn->prepare($query_user);
$stmt->bind_param("s", $id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();

if (!$user_data) {
    header("Location: logout.php");
    exit();
}

// Dynamic Attendance Metrics
$id = $_SESSION['uid'];
$stmt_p = $conn->prepare("SELECT COUNT(*) FROM attendence WHERE student_id = ? AND attendence = '1'");
$stmt_p->bind_param("s", $id);
$stmt_p->execute();
$present = $stmt_p->get_result()->fetch_row()[0];

$stmt_a = $conn->prepare("SELECT COUNT(*) FROM attendence WHERE student_id = ? AND attendence = '0'");
$stmt_a->bind_param("s", $id);
$stmt_a->execute();
$absent = $stmt_a->get_result()->fetch_row()[0];

$stmt_l = $conn->prepare("SELECT COUNT(*) FROM attendence WHERE student_id = ? AND attendence = '2'");
$stmt_l->bind_param("s", $id);
$stmt_l->execute();
$late = $stmt_l->get_result()->fetch_row()[0];

$active_page = 'home';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | CMS</title>
    <link rel="shortcut icon" href="./images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../shared/style.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style type="text/css">
        .container main .subjects .eg #piechart {
            width: 100%;
            height: 350px;
            position: relative;
            border-radius: 20px;
        }

        #myInput {
            background-image: url('search.svg');
            background-position: 15px center;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 45px;
            border: 1px solid var(--glass-border);
            margin-bottom: 1.5rem;
            border-radius: 12px;
            background-color: var(--bg-card);
            color: var(--text-main);
        }

        #myTable {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        #myTable th {
            background-color: var(--primary);
            color: white;
            padding: 15px;
            text-align: left;
        }

        #myTable td {
            background-color: var(--bg-card);
            padding: 15px;
            border-top: 1px solid var(--glass-border);
            border-bottom: 1px solid var(--glass-border);
        }

        #myTable tr td:first-child { border-left: 1px solid var(--glass-border); border-radius: 12px 0 0 12px; }
        #myTable tr td:last-child { border-right: 1px solid var(--glass-border); border-radius: 0 12px 12px 0; }

        #myTable tr:hover td {
            background-color: var(--color-light);
        }
    </style>
</head>

<body>
    <?php include('partials/_header.php'); ?>

    <div class="container">
        <?php include('partials/_sidebar.php'); ?>

        <main>
            <h1>Student Dashboard</h1>
            <div class="subjects" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.6rem;">
                <!-- Result Chart Card -->
                <div class="eg premium-card" style="grid-column: 1 / -1;">
                    <div class="header" style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                         <span class="material-icons-sharp" style="color: var(--primary);">analytics</span>
                         <h3>Academic Performance Overview</h3>
                    </div>
                    <div id="piechart" style="min-height: 350px;"></div>
                </div>

                <!-- Enrollment Overview Table (Restored) -->
                <div class="enrollment-table premium-card" style="grid-column: 1 / -1;">
                    <div class="header" style="margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
                         <div style="display: flex; align-items: center; gap: 10px;">
                            <span class="material-icons-sharp" style="color: var(--success);">assignment</span>
                            <h3>Enrollment Overview</h3>
                         </div>
                         <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search courses..." style="max-width: 250px; margin-bottom: 0;">
                    </div>
                    <div class="table-responsive">
                        <table id="myTable">
                            <thead>
                                <tr>
                                    <th>COURSE NAME</th>
                                    <th>FACULTY</th>
                                    <th>CREDITS</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mathematics III</td>
                                    <td>Dr. Sarah Connor</td>
                                    <td>4</td>
                                    <td><span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">Active</span></td>
                                </tr>
                                <tr>
                                    <td>DBMS - Advanced</td>
                                    <td>Prof. Kyle Reese</td>
                                    <td>3</td>
                                    <td><span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">Active</span></td>
                                </tr>
                                <tr>
                                    <td>Networking Specialist</td>
                                    <td>James Cameron</td>
                                    <td>3</td>
                                    <td><span class="badge bg-warning-subtle text-warning px-2 py-1 rounded-pill">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="timetable" id="timetable">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span id="prevDay" style="cursor:pointer; font-size: 1.5rem; color: var(--primary);">&lt;</span>
                        <h2 style="margin:0;">Today's Timetable</h2>
                        <span id="nextDay" style="cursor:pointer; font-size: 1.5rem; color: var(--primary);">&gt;</span>
                    </div>
                    <button class="btn btn-sm" onclick="window.location.href='timetable.php'">View Full Schedule</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </main>

        <div class="right">
            <div class="announcements">
                <h2>Campus Bulletins</h2>
                <div class="updates premium-card">
                    <div class="message">
                        <?php
                        $stmt_not = $conn->prepare("SELECT * FROM notice WHERE role='student' OR role='all' OR role='' ORDER BY s_no DESC LIMIT 3");
                        $stmt_not->execute();
                        $notice_res = $stmt_not->get_result();
                        if ($notice_res->num_rows > 0) {
                            while ($row_n = $notice_res->fetch_assoc()) {
                                echo "<div class='notice-item' style='margin-bottom:1rem;'>
                                    <h4 style='color: var(--primary);'>" . $row_n['title'] . "</h4>
                                    <small>" . date('d M, Y', strtotime($row_n['timestamp'])) . "</small>
                                </div><hr style='border: 0.5px solid var(--glass-border);'>";
                            }
                        } else {
                            echo "<p class='text-muted'>No active bulletins found.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="leaves">
                <h2>Active Faculty</h2>
                <div class="premium-card">
                    <div style="display: grid; gap: 1rem;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                             <img src="../images/user.png" style="width:35px; height:35px; border-radius:50%;">
                             <div>
                                <b>Dr. Sarah Connor</b>
                                <p class="text-muted"><small>Mathematics HOD</small></p>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------------------- Google Charts Script------------------->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Present', <?php echo $present ?: 0; ?>],
                ['Absent', <?php echo $absent ?: 0; ?>],
                ['Late', <?php echo $late ?: 0; ?>]
            ]);

            var options = {
                title: 'Attendance Ratio',
                pieHole: 0.5,
                colors: ['#7380ec', '#ff7782', '#ffbb55'],
                backgroundColor: 'transparent',
                legend: { 
                    position: 'bottom', 
                    textStyle: { color: '#677483', fontSize: 13 },
                    alignment: 'center'
                },
                chartArea: { width: '100%', height: '80%', left: 0, right: 0 },
                pieSliceTextStyle: { fontSize: 12 },
                tooltip: { textStyle: { fontSize: 13 } }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
    <script src="app.js"></script>
    <script src="timeTable.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
    <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>

</html>
