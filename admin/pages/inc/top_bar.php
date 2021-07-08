<div class="navbar-custom" style="background-color: #165767;">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="../../images/MSFDILOGO5INCH.png" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                    <?php echo $_SESSION['name']; ?>  <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <div class="dropdown-divider"></div>
                <!-- item-->
                <a href="../query_login.php?logout=1" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>

    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="#" class="logo text-center">
            <span class="logo-lg">
                <img src="../../images/MSFDILOGO5INCH.png" alt="" height="80" class="rounded-circle">
                <!-- <span class="logo-lg-text-light">UBold</span> -->
            </span>
            <span class="logo-sm">
                <!-- <span class="logo-sm-text-dark">U</span> -->
                <img src="../../images/MSFDILOGO5INCH.png" alt="" height="28" class="rounded-circle">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>
    </ul>
</div>
