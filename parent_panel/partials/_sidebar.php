
<div class="sidebar">
    <a href="dashboard.php" class="logo">
        <img src="../images/1.jpeg">
        <div class="logo-name"><h2>C<span class="danger">M</span>S</h2></div>
    </a>
    
    <ul class="side-menu main-side-board">
        <li class="<?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>"><a href="dashboard.php"><i class='bx bxs-dashboard'></i>Home</a></li>
        <li class="<?php echo ($active_page == 'fees') ? 'active' : ''; ?>"><a href="fee-details.php"><i class='bx bxs-wallet'></i>Fees</a></li>
        <li class="<?php echo ($active_page == 'payment') ? 'active' : ''; ?>"><a href="payment.php"><i class='bx bxs-credit-card'></i>Payments</a></li>
        <li class="<?php echo ($active_page == 'notices') ? 'active' : ''; ?>"><a href="notices.php"><i class='bx bxs-bell'></i>Notices</a></li>
    </ul>
    
    <ul class="side-menu">
        <li>
            <a class="logout" href="../logout.php">
                <i class='bx bx-log-out-circle'></i>
                Logout
            </a>
        </li>
    </ul>
</div>
