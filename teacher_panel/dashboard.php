<?php include('partials/_header_revised.php') ?>
<?php 
$check = '1'; 
$active_page = 'dashboard';
?>

<!-- Navbar and Header Standardized -->
<?php include('partials/_navbar.php'); ?>
<input type="hidden" value="1" id="checkFileName">

<div class="container">
    <!-- Standardized Sidebar Migration -->
    <?php include('partials/_sidebar.php'); ?>

    <main>
        <div class="header">
            <h1>Teacher Dashboard</h1>
        </div>
        <div class="insights">
            <!-- Analytics Cards with Premium Style -->
            <div class="card1 premium-card">
                <span class="material-icons-sharp">person</span>
                <div class="middle">
                    <div class="left">
                        <h3><?php echo t('teachers'); ?></h3>
                        <h2 id="teacherCount">...</h2>
                    </div>
                </div>
                <small class="text-muted"><?php echo t('total_faculty'); ?></small>
            </div>
            
            <div class="card2 premium-card" onclick="showStudentList()" style="cursor: pointer;">
                <span class="material-icons-sharp">group</span>
                <div class="middle">
                    <div class="left">
                        <h3><?php echo t('students'); ?></h3>
                        <h2 id="studentCount">...</h2>
                    </div>
                </div>
                <small class="text-muted"><?php echo t('registered_pupils'); ?></small>
            </div>

            <div class="card3 premium-card" onclick="showNotesList()" style="cursor: pointer;">
                <span class="material-icons-sharp">description</span>
                <div class="middle">
                    <div class="left">
                        <h3><?php echo t('notes'); ?></h3>
                        <h2 id="classCount">...</h2>
                    </div>
                </div>
                <small class="text-muted"><?php echo t('course_materials'); ?></small>
            </div>

            <div class="card4 premium-card" onclick="showNoticeList()" style="cursor: pointer;">
                <span class="material-icons-sharp">campaign</span>
                <div class="middle">
                    <div class="left">
                        <h3><?php echo t('notices'); ?></h3>
                        <h2 id="noticeCount">...</h2>
                    </div>
                </div>
                <small class="text-muted"><?php echo t('active_bulletins'); ?></small>
            </div>
        </div>

        <div class="bottom-data">
            <div class="orders premium-card">
                <div class="header">
                    <span class="material-icons-sharp" style="color: var(--primary);">campaign</span>
                    <h3>Notice Board</h3>
                    <a href="noticeboard.php" class="btn" style="padding: 0.5rem; border-radius: 50%; min-width: unset;">
                        <span class="material-icons-sharp">add</span>
                    </a>
                </div>
                <div id="noticeListContainer">
                    <p class="text-muted">Loading notices...</p>
                </div>
            </div>
        </div>
    </main>

    <div class="right">
        <div class="announcements">
            <h2>Upcoming Events</h2>
            <div class="updates premium-card">
                <div class="message">
                    <p><b>Annual Sports Day</b> - Next Friday</p>
                    <small class="text-muted">March 28, 2024</small>
                    <hr style="border: 0.5px solid var(--color-light); margin: 0.5rem 0;">
                    <p><b>Parent-Teacher Meet</b> - This Saturday</p>
                    <small class="text-muted">March 22, 2024</small>
                </div>
            </div>
        </div>

        <div class="leaves">
            <h2>My Tasks</h2>
            <div class="premium-card">
                <div class="task-list" style="display: grid; gap: 0.8rem;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span class="material-icons-sharp text-success">check_circle</span>
                        <span>Check Assignments</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span class="material-icons-sharp text-warning">pending_actions</span>
                        <span>Upload Quiz</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../student_panel/app.js"></script>
<script>
    // Fetch dashboard counts
    document.addEventListener('DOMContentLoaded', () => {
        // Mocking counts for demonstration
        document.getElementById('teacherCount').innerText = '12';
        document.getElementById('studentCount').innerText = '245';
        document.getElementById('classCount').innerText = '8';
        document.getElementById('noticeCount').innerText = '5';
        
        // Load notices snippet
        document.getElementById('noticeListContainer').innerHTML = "<p>All academic systems are operational. Rebranding to Elite CMS v3.1 complete.</p>";
    });
</script>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>ai-chat.css">
<script src="<?php echo BASE_URL; ?>ai-chat.js"></script>
</body>
</html>
