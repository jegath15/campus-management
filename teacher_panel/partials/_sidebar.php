
<div class="sidebar">
    <a href="dashboard.php" class="logo">
        <img src="../images/1.jpeg">
        <div class="logo-name"><h2>C<span class="danger">M</span>S</h2></div>
    </a>
    
    <ul class="side-menu main-side-board">
        <li class="<?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>"><a href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
        <li class="<?php echo ($active_page == 'students') ? 'active' : ''; ?>"><a href="student.php"><i class='bx bxs-user-detail'></i>Student</a></li>
        <li class="<?php echo ($active_page == 'attendance') ? 'active' : ''; ?>"><a href="attendence.php"><i class='bx bx-list-check'></i>Attendence</a></li>
        <li class="<?php echo ($active_page == 'notice') ? 'active' : ''; ?>"><a href="noticeboard.php"><i class='bx bxs-bookmark'></i>Notice Board</a></li>
        <li class="<?php echo ($active_page == 'schedule') ? 'active' : ''; ?>"><a href="timetable.php"><i class='bx bx-table'></i>Time Table</a></li>
        <li class="<?php echo ($active_page == 'syllabus') ? 'active' : ''; ?>"><a href="syllabus.php"><i class='bx bxs-file-blank'></i>Syllabus</a></li>
        <li class="<?php echo ($active_page == 'notes') ? 'active' : ''; ?>"><a href="notes.php"><i class='bx bxs-note'></i>Notes</a></li>
        <li class="<?php echo ($active_page == 'marks') ? 'active' : ''; ?>"><a href="marks.php"><i class='bx bxs-paste'></i>Marks</a></li>
        <li class="<?php echo ($active_page == 'quiz') ? 'active' : ''; ?>"><a href="smart-quiz.php"><i class='bx bxs-brain'></i>AI Smart Quiz</a></li>
        <li class="<?php echo ($active_page == 'settings') ? 'active' : ''; ?>"><a href="settings.php"><i class='bx bxs-cog'></i>Settings</a></li>
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

<div class="modal fade" id="logout-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-body" style="padding: 2rem; text-align: center;">
                <i class='bx bx-power-off' style="font-size: 3rem; color: var(--danger);"></i>
                <h4 style="margin-top: 1rem;">Confirm Logout</h4>
                <p class="text-muted">Do you really want to end your session?</p>
                <div style="display: flex; gap: 10px; justify-content: center; margin-top: 2rem;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px; padding: 0.5rem 1.5rem;">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="location.href='../logout.php'" style="border-radius: 8px; padding: 0.5rem 1.5rem;">Log me out</button>
                </div>
            </div>
        </div>
    </div>
</div>
