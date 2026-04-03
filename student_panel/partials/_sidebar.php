<?php
// student_panel/partials/_sidebar.php
// Expected variables: $active_page (e.g., 'home', 'timetable', 'exam', 'workspace', 'password')
?>
<aside>
    <div class="profile premium-card">
        <div class="top">
            <div class="profile-photo">
                <img src="../studentUploads/<?php echo $user_data['image'] ?? '1.jpeg'; ?>" onerror="this.src='../images/1.jpeg'">
            </div>
            <div class="info">
                <p>Hey, <b><?php echo $user_data["fname"] ?? 'Student'; ?></b> </p>
                <small class='text-muted'><b>ID : </b><?php echo $user_data["id"] ?? '0'; ?></small>
            </div>
        </div>
        
        <div class="sidebar-menu" style="margin-top: 2rem;">
            <a href="index.php" class="<?php echo ($active_page == 'home') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">home</span>
                <h3>Home</h3>
            </a>
            <a href="timetable.php" class="<?php echo ($active_page == 'timetable') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">today</span>
                <h3>Time Table</h3>
            </a>
            <a href="exam.php" class="<?php echo ($active_page == 'exam') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Examination</h3>
            </a>
            <a href="workspace.php" class="<?php echo ($active_page == 'workspace') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">description</span>
                <h3>Workspace</h3>
            </a>
            <a href="password.php" class="<?php echo ($active_page == 'password') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">password</span>
                <h3>Settings</h3>
            </a>
            <a href="logout.php" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; transition: all 300ms ease; color: var(--danger); margin-top: 1rem;">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>

        <div class="about" style="margin-top: 2rem; border-top: 1px solid var(--color-light); padding-top: 1rem;">
            <h5>Class / Section</h5>
            <p><?php echo ($user_data["class"] ?? 'N/A') . " - " . ($user_data["section"] ?? 'N/A'); ?></p>
            <h5>Contact</h5>
            <p><?php echo $user_data["phone"] ?? 'N/A'; ?></p>
            <br>
            <div class="quick-links" style="display: flex; flex-direction: column; gap: 0.5rem;">
                <a href="buspanel.php" class="btn btn-sm">Bus Panel</a>
                <a href="fee-payment.php" class="btn btn-sm" style="background: var(--secondary);">Pay Fee</a>
            </div>
        </div>
    </div>
</aside>
