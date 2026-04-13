<?php 
include("../assets/config.php");
include("../assets/noSessionRedirect.php"); 
include("./verifyRoleRedirect.php");

$id = $_SESSION['uid'];

// Fetch user data
$query_user = "SELECT * FROM students WHERE id=?";
$stmt_user = $conn->prepare($query_user);
$stmt_user->bind_param("s", $id);
$stmt_user->execute();
$user_data = $stmt_user->get_result()->fetch_assoc();

$active_page = 'exam';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination Results | CMS</title>


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="../images/1.png">
    <link rel="stylesheet" href="../shared/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <style>
        .cursor-pointer{
            cursor: pointer;
        }

        .exam {
            width: 100%;
            margin-top: 1rem;
        }

        #gfg {
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
            position: relative;
        }

        .subjective-result-btn{
            padding: 5px 15px;
            background-color: var(--primary);
            color: white !important;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .vertical-elements {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        table th {
            background-color: var(--primary);
            color: white;
            padding: 15px;
            text-align: left;
        }

        table td {
            background-color: var(--bg-card);
            padding: 15px;
            border-top: 1px solid var(--glass-border);
            border-bottom: 1px solid var(--glass-border);
        }

        table tr td:first-child { border-left: 1px solid var(--glass-border); border-radius: 12px 0 0 12px; }
        table tr td:last-child { border-right: 1px solid var(--glass-border); border-radius: 0 12px 12px 0; }

        .hide {
            display: none !important;
        }
    </style>
</head>

<body>
    <?php include('partials/_header.php'); ?>

    <div class="container">
        <?php include('partials/_sidebar.php'); ?>

        <main>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h1>Examination Results</h1>
                <a href='progress.php' class="btn"><?php echo t('progress_report') ?? 'Progress Report'; ?></a>
            </div>

            <div class="exam">
                <input id="gfg" class="marks-table-search-box" type="text" placeholder="Search by Subject, Date, or Grade...">

                <div class="table-responsive">
                    <table class="allResultTable" id="allResultList">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Subject</th>
                                <th>Exam Title</th>
                                <th>Marks</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="geeks">
                            <?php
                            $query2 = "SELECT DISTINCT(`exam_id`) FROM `marks` WHERE `student_id` = ? ORDER BY `s_no` DESC LIMIT 50";
                            $stmt2 = $conn->prepare($query2);
                            $stmt2->bind_param("s", $id);
                            $stmt2->execute();
                            $result2 = $stmt2->get_result();

                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    $examId = $row2['exam_id'];

                                    $query3 = "SELECT * FROM `exams` WHERE `exam_id` = ?";
                                    $stmt3 = $conn->prepare($query3);
                                    $stmt3->bind_param("s", $examId);
                                    $stmt3->execute();
                                    $result3 = $stmt3->get_result();
                                    $row3 = $result3->fetch_assoc();

                                    $dateDB = $row3['timestamp'];
                                    $formattedDate = date("d M, Y", strtotime($dateDB));

                                    if ($row3['subject'] == "ALL") {
                                        $sql = "SELECT * FROM `marks` WHERE `exam_id` = ? AND `student_id` = ?";
                                        $stmt4 = $conn->prepare($sql);
                                        $stmt4->bind_param("ss", $row3['exam_id'], $id);
                                        $stmt4->execute();
                                        $marksResult = $stmt4->get_result();

                                        $totalGainMarks = 0;
                                        $subjectCount = 0;
                                        $isFail = false;
                                        while ($tempRow = $marksResult->fetch_assoc()) {
                                            $totalGainMarks += (int)$tempRow['marks'];
                                            $subjectCount++;
                                            if ((int)$tempRow['marks'] < (int)$row3['passing_marks']) {
                                                $isFail = true;
                                            }
                                        }

                                        $statusText = $isFail ? "Fail" : "Pass";
                                        $statusColor = $isFail ? "var(--danger)" : "var(--success)";

                                        echo "<tr>
                                                <td>$formattedDate</td>
                                                <td><span class='subjective-result-btn cursor-pointer' onClick='handleShowAllSubjectMarks(\"" . $row3['exam_id'] . "\")'>Mixed</span></td>
                                                <td>" . $row3['exam_title'] . "</td>
                                                <td>$totalGainMarks</td>
                                                <td>". ($subjectCount * $row3['total_marks']) ."</td>
                                                <td style='color:$statusColor; font-weight:bold;'>$statusText</td>
                                            </tr>";
                                    } else {
                                        $sql = "SELECT * FROM `marks` WHERE `exam_id` = ? AND `student_id` = ? AND `subject`=? LIMIT 1";
                                        $stmt4 = $conn->prepare($sql);
                                        $stmt4->bind_param("sss", $row3['exam_id'], $id, $row3['subject']);
                                        $stmt4->execute();
                                        $marksResult = $stmt4->get_result();
                                        $marksResultRow = $marksResult->fetch_assoc();
                                        $mark = $marksResultRow['marks'];

                                        $isFail = (int)$mark < (int)$row3['passing_marks'];
                                        $statusText = $isFail ? "Fail" : "Pass";
                                        $statusColor = $isFail ? "var(--danger)" : "var(--success)";

                                        echo "<tr>
                                            <td>$formattedDate</td> 
                                            <td>" . $row3['subject'] . "</td>
                                            <td>" . $row3['exam_title'] . "</td>
                                            <td>$mark</td>
                                            <td>" . $row3['total_marks'] . "</td>
                                            <td style='color:$statusColor; font-weight:bold;'>$statusText</td>
                                        </tr>";
                                    }
                                }
                            } else {
                                echo '<tr><td colspan="6" style="text-align:center; padding: 3rem;">No exam data available.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="vertical-elements" id="subjectiveResultTable"></div>
            </div>
        </main>
    </div>

    <script src="app.js"></script>
    <script>
        $(document).ready(function() {
            $("#gfg").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#geeks tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        // Add back to list button functionality to app.js handleShowAllSubjectMarks if needed
        // but here we can just handle the UI toggle.
    </script>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
    <script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>

</html>
