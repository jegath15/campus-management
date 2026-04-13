<div class="sidebar">
    <a href="index.php" class="logo">
        <img src="../images/1.png">
        <div class="logo-name"><span style="color: #ffc107;">E</span>RP</div>
    </a>
    <ul class="side-menu">
        <li class="<?php echo ($active_page == 'home') ? 'active' : ''; ?>">
            <a href="index.php"><i class='bx bxs-dashboard'></i>Dashboard</a>
        </li>
        <li class="<?php echo ($active_page == 'timetable') ? 'active' : ''; ?>">
            <a href="timetable.php"><i class='bx bxs-calendar'></i>Time Table</a>
        </li>
        <li class="<?php echo ($active_page == 'exam') ? 'active' : ''; ?>">
            <a href="exam.php"><i class='bx bxs-graduation'></i>Examination</a>
        </li>
        <li class="<?php echo ($active_page == 'workspace') ? 'active' : ''; ?>">
            <a href="workspace.php"><i class='bx bxs-briefcase-alt-2'></i>Workspace</a>
        </li>
        <li class="<?php echo ($active_page == 'password') ? 'active' : ''; ?>">
            <a href="password.php"><i class='bx bxs-cog'></i>Settings</a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="#" class="logout" data-bs-toggle="modal" data-bs-target="#logout-modal">
                <i class='bx bxs-log-out-circle'></i>
                Logout
            </a>
        </li>
    </ul>
</div>

<!-- Logout Confirmation Modal (Standardized for all Panels) -->
<div class="modal fade" id="logout-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border: none; padding: 20px 20px 10px;">
                <h5 class="modal-title">Confirm Session End</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 10px 20px 20px; text-align: center;">
                <p class="text-muted">Are you sure you want to log out of the Student Portal?</p>
            </div>
            <div class="modal-footer" style="border: none; padding: 0 20px 20px; display: flex; gap: 10px;">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="flex: 1; border-radius: 10px;">Cancel</button>
                <a href="logout.php" class="btn btn-danger" style="flex: 1; border-radius: 10px; background-color: #f72585; border: none;">LOGOUT</a>
            </div>
        </div>
    </div>
</div>
