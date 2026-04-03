<?php include('partials/_header.php') ?>

<!-- Sidebar Refined -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="1" id="checkFileName">

<!-- Added Reminder Modal with Glass Theme -->
<div class="modal fade" id="reminder-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass" style="border-radius: var(--card-border-radius); border:none; padding: 20px;">
            <div class="modal-header" style="border:none;">
                <h2 class="modal-title fs-5">System Reminder</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning reminder-error" style="display: none;">Content required!</div>
                <textarea class="form-control" id="reminder-msg" rows="4" 
                    placeholder="Type administrative reminder..."
                    style="border-radius: 12px; background: var(--bg-main); border: 1px solid var(--glass-border); padding: 15px; color: var(--text-main);"></textarea>
            </div>
            <div class="modal-footer" style="border:none; padding: 0 1rem 1.5rem;">
                <button type="button" class="btn premium-btn-primary" onclick="addReminder()" style="width: 100%;">
                   SAVE REMINDER
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Main Content -->
<div class="content">
    <?php include("partials/_navbar.php"); ?>

    <main>
        <div class="header" style="padding: 0 20px;">
            <div class="left">
                <h1>Administrator Overview</h1>
                <ul class="breadcrumb" style="list-style: none; display: flex; gap: 10px; color: var(--text-muted); padding: 0;">
                    <li>Analytics</li>
                    <li>></li>
                    <li class="active" style="color: var(--primary);">Real-time Stats</li>
                </ul>
            </div>
        </div>

        <!-- Insights as Premium Cards -->
        <ul class="insights">
            <li class="premium-card" onclick="showTeacherList()" style="cursor: pointer; display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-user-badge' style="font-size: 2.5rem; color: var(--primary); background: var(--light-primary); padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 id="teacherCount">...</h3>
                    <p style="color: var(--text-muted);">Teachers</p>
                </span>
            </li>
            <li class="premium-card" onclick="showStudentList()" style="cursor: pointer; display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-group' style="font-size: 2.5rem; color: var(--danger); background: var(--light-danger); padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 id="studentCount">...</h3>
                    <p style="color: var(--text-muted);">Students</p>
                </span>
            </li>
            <li class="premium-card" onclick="showNotesList()" style="cursor: pointer; display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-book-content' style="font-size: 2.5rem; color: var(--success); background: var(--light-success); padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 id="classCount">...</h3>
                    <p style="color: var(--text-muted);">Academic Content</p>
                </span>
            </li>
            <li class="premium-card" onclick="showNoticeList()" style="cursor: pointer; display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-megaphone' style="font-size: 2.5rem; color: var(--warning); background: var(--light-warning); padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 id="noticeCount">...</h3>
                    <p style="color: var(--text-muted);">Public Notices</p>
                </span>
            </li>
        </ul>

        <div class="bottom-data">
            <div class="orders premium-card">
                <div class="header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class='bx bx-news' style="color: var(--primary);"></i>
                        <h3>Global Bulletins</h3>
                    </div>
                    <a href="noticeboard.php" class="btn" style="padding: 8px; border-radius: 50%; min-width: unset;">
                        <i class='bx bx-plus' style="font-size: 20px;"></i>
                    </a>
                </div>

                <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
                    <thead>
                        <tr style="text-align: left; color: var(--text-muted); font-size: 0.8rem;">
                            <th style="padding: 10px;">TITLE</th>
                            <th style="padding: 10px;">TIMESTAMP</th>
                            <th style="padding: 10px;">AUTHOR</th>
                        </tr>
                    </thead>
                    <tbody id="noticeTableBody">
                        <!-- Content via AJAX -->
                    </tbody>
                </table>
            </div>

            <!-- Reminders -->
            <div class="reminders premium-card glass">
                <div class="header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class='bx bx-alarm-note' style="color: var(--warning);"></i>
                        <h3>Admin Agenda</h3>
                    </div>
                    <a data-bs-toggle="modal" data-bs-target="#reminder-modal" class="btn" style="padding: 5px 12px; font-size: 11px;">NEW</a>
                </div>
                <ul class="task-list" id="all-reminders" style="list-style: none; padding: 0;">
                    <!-- Content via AJAX -->
                </ul>
            </div>
        </div>
    </main>
</div>

<script src="../assets/js/dashboard.js"></script>
<?php include("partials/_footer.php"); ?>
