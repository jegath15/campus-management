<nav>
    <i class='bx bx-menu SidebarOpener'></i>
    <form id="unknowingForm">
        <div class="form-input">
            <input type="search" placeholder="Search students, notices..." id="topMostSearchBar">
            <button class="search-btn" type="button" id="topMostSearchBarBtn"><i class='bx bx-search-alt'></i></button>
        </div>
    </form>
    
    <input type="checkbox" id="theme-toggle" hidden>
    <label for="theme-toggle" class="theme-toggle"></label>

    <a href="settings.php" class="profile" id="navbar_profile_pic">
        <img src="../images/user.png">
    </a>

    <div class="dropdown dropdown-center">
        <a class="menu" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <i class='bx bx-dots-vertical-rounded icon-hover-circle'></i>
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="settings.php">My Profile</a></li>
            <li><a class="dropdown-item" href="settings.php">Re-branding</a></li>
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout-modal">Sign Out</a></li>
        </ul>
    </div>
</nav>
