<nav>
    <i class='bx bx-menu SidebarOpener'></i>
    <form action="#">
        <div class="form-input">
            <input type="search" placeholder="Search...">
            <button class="search-btn" type="submit" style="background: #0d6efd; color: #fff; border-radius: 0 36px 36px 0; width: 48px; display: flex; align-items: center; justify-content: center; border: none;">
                <i class='bx bx-search'></i>
            </button>
        </div>
    </form>
    
    <input type="checkbox" id="theme-toggle" hidden>
    <label for="theme-toggle" class="theme-toggle"></label>

    <a href="settings.php" class="profile">
        <img src="../images/user.png">
    </a>

    <div class="dropdown">
        <a class="menu" href="#" data-bs-toggle="dropdown">
            <i class='bx bx-dots-vertical-rounded'></i>
        </a>
        <ul class="dropdown-menu shadow border-0" style="border-radius: 12px;">
            <li><a class="dropdown-item" href="settings.php"><i class='bx bx-user me-2'></i> Profile</a></li>
            <li><a class="dropdown-item" href="settings.php"><i class='bx bx-cog me-2'></i> Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#logout-modal"><i class='bx bx-log-out me-2'></i> Logout</a></li>
        </ul>
    </div>
</nav>
