<!-- header -->
<header class="header shadow bg-white mb-4 shadow">
    <div class="header__container ">
        <a href="../joiner_index.php" class="header__logo">Eventers</a>
        <div class="header_search">
            <!-- <input type="search" placeholder="Search event..." class="header__input">
                <i class='bx bx-search search__icon'></i> -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" style="border-radius: 0 !important;">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="header__toggle">
            <i class='bx bx-menu' id='header_toggle'></i>
        </div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow" style="list-style-type: none;">
            <a class="nav-link dropdown-toggle" id="userDetailDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $userData['name'];?></span>
                <img class="img-profile rounded-circle" src="templates/assets/images/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDetailDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </div>
</header>

<!-- Navbar -->
<nav id="navbar" class="nav">
    <div class="nav__container">
        <a href="../joiner_index.php" class="nav__links nav__logo">
            <i class='bx bx-disc nav__box_icons'></i>
            <span class="nav__logo__name">Eventers</span>
        </a>

        <div class="nav__list">
            <div class="nav__items">
                <h3 class="nav__subtitle">Details</h3>

            </div>

            <a href="../pages/dashboard.php" class="nav__links">
                <i class='bx bx-home-alt nav__box_icons'></i>
                <span class="nav__name">Home</span>
            </a>

            <div class="nav__dropdown active">
                <a href="#" class="nav__links">
                    <i class='bx bx-user nav__box_icons'></i>
                    <span class="nav__name">Profile</span>
                    <i class='bx bx-chevron-down nav__icon nav__dropdown_icon'></i>
                </a>
                <div class="nav__dropdown__collapse">
                    <div class="nav__dropdown__content bg-whiite">
                        <a href="view-profile" class="nav__dropdown__item">Account</a>
                        <a href="../pages/forgot-password.php" class="nav__dropdown__item">Password</a>

                    </div>
                </div>
            </div>


            <a href="#" class="nav__links margin__bottom__2rem">
                <i class='bx bx-message nav__box_icons'></i>
                <span class="nav__name">Messages</span>
            </a>

        </div>
        <div class="nav__list">
            <div class="nav__items">
                <h3 class="nav__subtitle">Events</h3>

            </div>
            <a href="all-event" class="nav__links">
                <i class='bx bx-compass nav__box_icons'></i>
                <span class="nav__name">Explore</span>
            </a>
            
            <a href="saved" class="nav__links">
                <i class='bx bx-bookmark-alt nav__box_icons'></i>
                <span class="nav__name">Saved</span>
            </a>
            <a href="schedule" class="nav__links">
                <i class='bx bx-time nav__box_icons'></i>
                <span class="nav__name">Your event schedule</span>
            </a>
            <a href="#" class="nav__links nav__logout">
                <i class='bx bx-log-out nav__box_icons'></i>
                <span class="nav__name">Log out</span>
            </a>
        </div>

    </div>

</nav>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../pages/joiners_login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>