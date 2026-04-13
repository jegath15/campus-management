<?php include('partials/_header.php') ?>

<!-- Administrative Sidebar Layout -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="1" id="checkFileName">

<div class="content">
    <?php include("partials/_navbar.php"); ?>

    <main style="padding: 36px 24px; min-height: calc(100vh - 56px); background: var(--grey);">
        <div class="header" style="margin-bottom: 30px;">
            <div class="left">
                <h1>Dashboard</h1>
                <ul class="breadcrumb" style="list-style: none; display: flex; gap: 10px; color: var(--text-muted); padding: 0;">
                    <li>Analytics</li>
                    <li>></li>
                    <li class="active" style="color: var(--primary);">System Overview</li>
                </ul>
            </div>
        </div>

        <!-- Insights as Pixel-Perfect Original Cards -->
        <ul class="insights">
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-user-rectangle' style="font-size: 2rem; color: #0d6efd; background: #e7f0ff; padding: 20px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 id="teacherCount" style="font-size: 1.8rem; font-weight: 700;">1</h3>
                    <p style="color: #64748b;">Teachers</p>
                </span>
            </li>
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-group' style="font-size: 2rem; color: #ffc107; background: #fffcf0; padding: 20px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 id="studentCount" style="font-size: 1.8rem; font-weight: 700;">1</h3>
                    <p style="color: #64748b;">Registered Students</p>
                </span>
            </li>
            <li class="premium-card" style="display: flex; align-items: center; gap: 20px;">
                <i class='bx bxs-note' style="font-size: 2rem; color: #198754; background: #f0fff4; padding: 20px; border-radius: 15px;"></i>
                <span class="info">
                    <h3 id="notesCount" style="font-size: 1.8rem; font-weight: 700;">1</h3>
                    <p style="color: #64748b;">Uploaded Notes</p>
                </span>
            </li>
        </ul>

        <div class="bottom-data">
            <div class="orders">
                <div class="header">
                    <i class='bx bx-news'></i>
                    <h3>Latest Notices</h3>
                    <i class='bx bx-filter'></i>
                </div>
                <div id="noticeListContainer" style="padding: 20px;">
                    <!-- Content via AJAX -->
                    <p class='text-muted'>Synchronizing latest notices...</p>
                </div>
            </div>

            <div class="reminders">
                <div class="header">
                    <i class='bx bx-info-circle'></i>
                    <h3>Reminders</h3>
                    <i class='bx bx-plus' id="addReminderBtn" style="cursor:pointer;"></i>
                </div>
                <ul class="task-list" id="reminderList">
                    <!-- Reminders will load here -->
                </ul>
            </div>
        </div>
    </main>
</div>

<!-- Bootstrap 5 JS Bundle & Side Menu Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
