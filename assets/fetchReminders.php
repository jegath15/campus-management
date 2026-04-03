<?php
session_start();
include('config.php');
$data = array();

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];

    $sql = "SELECT * FROM reminders WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $count = 0;
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $msg = $row['message'];
            $status = $row['status'];
            $line = $row['s_no'];
            $class =  $status == 'pending' ? 'not-completed' : 'completed';
            $icon =  $status == 'pending' ? '<span class="material-icons-sharp text-warning">info</span>' : '<span class="material-icons-sharp text-success">check_circle</span>';

            $data[$count] = '<li class="' . $class  . '">
                                <div class="task-title" style="display:flex; align-items:center; gap: 10px;">
                                    <a class="status-btn" onclick="changeReminderStatus(' . $line . ')" style="cursor:pointer;">
                                       ' . $icon . '
                                    </a>
                                    <p>' . $msg . '</p>
                                </div>
                                 <a onclick="deleteReminder(' . $line . ', ' . $count . ')" style="cursor:pointer;"><span class="material-icons-sharp text-danger">delete</span></a>
                             </li>';

            $count++;
        }
    }

    mysqli_stmt_close($stmt);
}

echo json_encode($data);
?>
