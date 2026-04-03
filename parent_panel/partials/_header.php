<?php
// parent_panel/partials/_header.php
?>
<header class="glass">
    <div class="logo">
        <img src="../images/1.jpeg" alt="">
        <h2>C<span class="danger">M</span>S</h2>
    </div>
    
    <div class="header-tools" style="display: flex; align-items: center; gap: 1rem;">
        <!-- Language Switcher -->
        <div class="language-switcher">
            <?php if ($_SESSION['lang'] == 'en'): ?>
                <a href="?lang=ta" class="lang-btn">தமிழ்</a>
            <?php else: ?>
                <a href="?lang=en" class="lang-btn">English</a>
            <?php endif; ?>
        </div>

        <div id="profile-btn">
            <span class="material-icons-sharp">menu</span>
        </div>
        <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
        </div>
    </div>
</header>
