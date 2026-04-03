<?php
// teacher_panel/partials/_sidebar.php
// Expected variables: $active_page (e.g., 'dashboard', 'students', 'attendance', 'notice', 'schedule', 'quiz', 'settings')
?>
<aside>
    <div class="profile premium-card">
        <div class="top">
            <div class="profile-photo">
                <?php
                if (!isset($teacher_data)) {
                    $id = $_SESSION['uid'];
                    $query_img = "SELECT image, fname, subject FROM teachers WHERE id=?";
                    $stmt_img = $conn->prepare($query_img);
                    $stmt_img->bind_param("s", $id);
                    $stmt_img->execute();
                    $teacher_data = $stmt_img->get_result()->fetch_assoc();
                    $img_src = (!empty($teacher_data['image'])) ? "../teacherUploads/".$teacher_data['image'] : "../images/user.png";
                }
                ?>
                <img src="<?php echo $img_src; ?>">
            </div>
            <div class="info">
                <p>Hey, <b><?php echo $teacher_data["fname"] ?? 'Teacher'; ?></b> </p>
                <small class='text-muted'><b>ID : </b><?php echo $_SESSION['uid']; ?></small>
            </div>
        </div>

        <div class="sidebar-menu" style="margin-top: 1.5rem;">
            <a href="dashboard.php" class="<?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">dashboard</span>
                <h3>Dashboard</h3>
            </a>
            <a href="student.php" class="<?php echo ($active_page == 'students') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">person</span>
                <h3>Students</h3>
            </a>
            <a href="attendence.php" class="<?php echo ($active_page == 'attendance') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">checklist</span>
                <h3>Attendance</h3>
            </a>
            <a href="noticeboard.php" class="<?php echo ($active_page == 'notice') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">campaign</span>
                <h3>Notice</h3>
            </a>
            <a href="timetable.php" class="<?php echo ($active_page == 'schedule') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">today</span>
                <h3>Schedule</h3>
            </a>
            <a href="smart-quiz.php" class="<?php echo ($active_page == 'quiz') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">quiz</span>
                <h3>Smart Quiz</h3>
            </a>
            <a href="settings.php" class="<?php echo ($active_page == 'settings') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">settings</span>
                <h3>Settings</h3>
            </a>
            <a href="../logout.php" style="display: flex; align-items: center; gap: 1rem; padding: 0.8rem 1rem; border-radius: 12px; transition: all 300ms ease; color: var(--danger); margin-top: 1rem;">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>

        <div class="about" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--color-light);">
            <h5>Subject</h5>
            <p><?php echo $teacher_data["subject"] ?? 'Not Set'; ?></p>
            <h5>Contact</h5>
            <p><?php echo $teacher_data["phone"] ?? 'Not Set'; ?></p>
        </div>
    </div>
</aside>
