<header class="glass">
    <div class="logo">
        <img src="../images/1.jpeg" alt="">
        <h2>C<span class="danger">M</span>S</h2>
    </div>
    <div class="navbar">
        <a href="dashboard.php" class="<?php echo ($check == '1') ? 'active' : ''; ?>">
            <span class="material-icons-sharp">dashboard</span>
            <h3>Dashboard</h3>
        </a>
        <a href="student.php">
            <span class="material-icons-sharp">person</span>
            <h3>Students</h3>
        </a>
        <a href="attendence.php">
            <span class="material-icons-sharp">checklist</span>
            <h3>Attendance</h3>
        </a>
        <a href="noticeboard.php">
            <span class="material-icons-sharp">campaign</span>
            <h3>Notice</h3>
        </a>
        <a href="timetable.php">
            <span class="material-icons-sharp">today</span>
            <h3>Schedule</h3>
        </a>
        <a href="smart-quiz.php">
            <span class="material-icons-sharp">quiz</span>
            <h3>Smart Quiz</h3>
        </a>
        <a href="settings.php">
            <span class="material-icons-sharp">settings</span>
            <h3>Settings</h3>
        </a>
        <a href="../logout.php">
            <span class="material-icons-sharp">logout</span>
            <h3>Logout</h3>
        </a>
    </div>

    <!-- Mobile Menu Trigger -->
    <div id="profile-btn">
        <span class="material-icons-sharp">menu</span>
    </div>

    <div class="theme-toggler">
        <span class="material-icons-sharp <?php echo ($theme == 'light') ? 'active' : ''; ?>">light_mode</span>
        <span class="material-icons-sharp <?php echo ($theme == 'dark') ? 'active' : ''; ?>">dark_mode</span>
    </div>
</header>
