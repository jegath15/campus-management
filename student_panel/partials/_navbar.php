<nav>
    <i class='bx bx-menu SidebarOpener'></i>
    <form id="unknowingForm">
        <div class="form-input">
            <input type="search" placeholder="Search my classes..." id="topMostSearchBar">
            <button class="search-btn" type="button" id="topMostSearchBarBtn"><i class='bx bx-search-alt'></i></button>
        </div>
    </form>
    
    <input type="checkbox" id="theme-toggle" hidden>
    <label for="theme-toggle" class="theme-toggle"></label>

    <a href="password.php" class="profile" id="navbar_profile_pic">
        <img src="../studentUploads/<?php echo $user_data['image'] ?? '1.jpeg'; ?>" onerror="this.src='../images/user.png'">
    </a>

    <div class="dropdown dropdown-center">
        <a class="menu" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <i class='bx bx-dots-vertical-rounded icon-hover-circle'></i>
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="password.php">Security Settings</a></li>
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout-modal">Sign Out</a></li>
        </ul>
    </div>
</nav>
