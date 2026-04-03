<?php
// parent_panel/partials/_sidebar.php
// Expected variables: $active_page (e.g., 'dashboard', 'fees', 'payment', 'notices')
?>
<aside>
    <div class="profile premium-card">
        <div class="top">
            <div class="profile-photo">
                <img src="<?php echo $img_path ?? '../images/1.jpeg'; ?>" alt="Student Avatar" onerror="this.src='../images/1.jpeg'">
            </div>
            <div class="info">
                <p><?php echo t('welcome_parent'); ?></p>
                <small class="text-muted"><?php echo t('guardian'); ?></small>
            </div>
        </div>
        
        <div class="sidebar-menu" style="margin-top: 2rem;">
            <a href="dashboard.php" class="<?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">home</span>
                <h3><?php echo t('home'); ?></h3>
            </a>
            <a href="fee-details.php" class="<?php echo ($active_page == 'fees') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">account_balance_wallet</span>
                <h3><?php echo t('fees'); ?></h3>
            </a>
            <a href="payment.php" class="<?php echo ($active_page == 'payment') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">payment</span>
                <h3><?php echo t('payments'); ?></h3>
            </a>
            <a href="notices.php" class="<?php echo ($active_page == 'notices') ? 'active' : ''; ?>" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; transition: all 300ms ease;">
                <span class="material-icons-sharp">campaign</span>
                <h3><?php echo t('notices'); ?></h3>
            </a>
            <a href="logout.php" style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; transition: all 300ms ease; color: var(--danger);">
                <span class="material-icons-sharp">logout</span>
                <h3><?php echo t('logout'); ?></h3>
            </a>
        </div>
    </div>
</aside>
