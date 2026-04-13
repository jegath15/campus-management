<?php
include('../assets/config.php');
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['uid'])) {
    $id = $_SESSION['uid'];
    
    $stmt = $conn->prepare("SELECT `class`,`section` FROM `students` WHERE `id`=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $class = $row['class'];
        $section = $row['section'];
    } else {
        $class = 'N/A';
        $section = 'N/A';
    }

    $query = "SELECT * FROM `time_table` WHERE `class`='$class' AND `section`='$section'";
    $result2 = mysqli_query($conn, $query);

    $daysOfWeek = array('mon', 'tue', 'wed', 'thu', 'fri', 'sat');
    $response['status'] = "success";
    $timetable = array();

    while ($row2 = $result2->fetch_assoc()) {
        foreach ($daysOfWeek as $day) {
            $timetable[$day][] = array(
                "start_time" => $row2['start_time'],
                "subject" => $row2[$day],
                "end_time"=> $row2['end_time']
                
            );
        }
    }

    $response['data'] = $timetable;
} else {
    $response['status'] = "error";
}

echo json_encode($response);
?>
