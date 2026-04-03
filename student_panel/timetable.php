<?php 
include("../assets/noSessionRedirect.php"); 
include("./verifyRoleRedirect.php"); 

// Fetch user data
$id = $_SESSION['uid'];
$query_user = "SELECT * FROM students WHERE id=?";
$stmt = $conn->prepare($query_user);
$stmt->bind_param("s", $id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();

$active_page = 'timetable';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Schedule | CMS</title>
    <link rel="shortcut icon" href="./images/logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../shared/style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('partials/_header.php'); ?>

    <div class="container">
        <?php include('partials/_sidebar.php'); ?>

        <main>
            <h1>Academic Schedule</h1>
            <div class="timetable active premium-card" id="timetable" style="margin-top: 1rem; padding: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <span id="prevDay" style="cursor:pointer; font-size: 2rem; color: var(--primary); padding: 0.5rem;">&lt;</span>
                    <h2 id="dayTitle">Today's Timetable</h2>
                    <span id="nextDay" style="cursor:pointer; font-size: 2rem; color: var(--primary); padding: 0.5rem;">&gt;</span>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody id="timetableBody"></tbody>
                </table>

                <div id="noClasses" style="display: none; text-align: center; padding: 3rem;">
                    <span class="material-icons-sharp" style="font-size: 4rem; color: var(--color-light);">event_busy</span>
                    <p class="text-muted" style="margin-top: 1rem;">No classes scheduled for this day.</p>
                </div>
            </div>
        </main>
    </div>

    <script src="app.js"></script>
    <script>
        // Override setData to handle empty states better in the new UI
        const originalSetData = setData;
        setData = (dayIndex) => {
            originalSetData(dayIndex);
            const tbody = document.querySelector('#timetableBody');
            const noClasses = document.getElementById('noClasses');
            if(tbody.children.length === 0) {
                noClasses.style.display = 'block';
                tbody.closest('table').style.display = 'none';
            } else {
                noClasses.style.display = 'none';
                tbody.closest('table').style.display = 'table';
            }
        };
    </script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
    <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>
