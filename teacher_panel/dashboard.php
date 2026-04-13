<?php include('partials/_header.php') ?>

<!-- Reversion to Original Sidebar Architecture -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="1" id="checkFileName">

<!-- Main Layout Structure (Legacy Sidebar + Content) -->
<div class="content">
    <?php include("partials/_navbar.php"); ?>

    <main style="padding: 36px 24px; min-height: calc(100vh - 56px); background: var(--grey);">
        <div class="header">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb" style="list-style: none; display: flex; gap: 10px; color: var(--text-muted); padding: 0;">
                    <li>Analytics</li>
                    <li>></li>
                    <li class="active" style="color: var(--primary);">System Overview</li>
                </ul>
            </div>
        </div>

        <!-- Insights as Boxicon Cards -->
        <ul class="insights">
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-user-rectangle' style="font-size: 2.5rem; color: var(--primary); background: var(--light-primary); padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 id="teacherCount">1</h3>
                    <p>Teachers</p>
                </span>
            </li>
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-group' style="font-size: 2.5rem; color: var(--success); background: var(--light-success); padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 id="studentCount">1</h3>
                    <p>StudentsRegistered</p>
                </span>
            </li>
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-note' style="font-size: 2.5rem; color: var(--warning); background: var(--light-warning); padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 id="notesCount">1</h3>
                    <p>NotesUploaded</p>
                </span>
            </li>
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-bookmark-star' style="font-size: 2.5rem; color: var(--danger); background: var(--light-danger); padding: 15px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 id="noticeCount">3</h3>
                    <p>Total Notices</p>
                </span>
            </li>
        </ul>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-receipt'></i>
                    <h3>Latest Notices</h3>
                    <i class='bx bx-filter'></i>
                    <i class='bx bx-plus' onclick="location.href='noticeboard.php'"></i>
                </div>
                <div id="noticeListContainer">
                    <table>
                        <thead>
                            <tr>
                                <th>Notice Title</th>
                                <th>Release Date</th>
                                <th>Issued By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Notices will be injected here -->
                            <tr>
                                <td>System Update v3.1</td>
                                <td>14 Apr, 2026</td>
                                <td>System Admin</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <i class='bx bx-note'></i>
                    <h3>Reminders</h3>
                    <i class='bx bx-plus' data-bs-toggle="modal" data-bs-target="#reminder-modal"></i>
                </div>
                <ul class="task-list" id="reminder-list">
                    <!-- Reminders will be loaded here -->
                </ul>
            </div>
        </div>
    </main>
</div>

<!-- Modal -->
<div class="modal fade" id="reminder-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header">
                <h5 class="modal-title">Create New Reminder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" id="reminder-msg" rows="3" placeholder="Enter reminder text..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="addReminder()">SAVE</button>
            </div>
        </div>
    </div>
</div>

<script src="../teacher_panel/script.js"></script>
<?php include("partials/_footer.php"); ?>
