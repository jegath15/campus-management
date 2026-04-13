
<div class="sidebar">
    <a href="index.php" class="logo">
        <img src="../images/1.jpeg">
        <div class="logo-name"><h2>C<span class="danger">M</span>S</h2></div>
    </a>
    
    <ul class="side-menu main-side-board">
        <li class="<?php echo ($active_page == 'home') ? 'active' : ''; ?>"><a href="index.php"><i class='bx bx-home-alt'></i>Home</a></li>
        <li class="<?php echo ($active_page == 'timetable') ? 'active' : ''; ?>"><a href="timetable.php"><i class='bx bx-table'></i>Time Table</a></li>
        <li class="<?php echo ($active_page == 'exam') ? 'active' : ''; ?>"><a href="exam.php"><i class='bx bx-grid-alt'></i>Examination</a></li>
        <li class="<?php echo ($active_page == 'workspace') ? 'active' : ''; ?>"><a href="workspace.php"><i class='bx bx-folder-open'></i>Workspace</a></li>
        <li class="<?php echo ($active_page == 'password') ? 'active' : ''; ?>"><a href="password.php"><i class='bx bx-lock-alt'></i>Settings</a></li>
    </ul>
    
    <ul class="side-menu">
        <li>
            <a class="logout" data-bs-toggle="modal" data-bs-target="#logout-modal">
                <i class='bx bx-log-out-circle'></i>
                Logout
            </a>
        </li>
    </ul>
</div>

<!-- Logout Modal (Standardized) -->
<div class="modal fade" id="logout-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-body" style="padding: 2rem; text-align: center;">
                <i class='bx bx-door-open' style="font-size: 3rem; color: var(--danger);"></i>
                <h4 style="margin-top: 1rem;">Confirm Session End</h4>
                <p class="text-muted">Are you sure you want to log out of the Student Portal?</p>
                <div style="display: flex; gap: 10px; justify-content: center; margin-top: 2rem;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="location.href='logout.php'">LOGOUT</button>
                </div>
            </div>
        </div>
    </div>
</div>
