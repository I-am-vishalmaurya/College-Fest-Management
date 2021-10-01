<!-- header -->
<header class="header shadow bg-white mb-4 shadow">
    <div class="header__container ">
        <a href="EH_index.php" class="header__logo">Eventers</a>
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php //echo "Hello&nbsp;" . $_SESSION['first_name']; //echo str_repeat('&nbsp;', 2);  echo $_SESSION['last_name'];
                                                                            ?></span>
                <img class="img-profile rounded-circle" src="templates/assets/images/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDetailDropdown">
                <a class="dropdown-item" href="view-profile.php">
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
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
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
        <a href="index.php" class="nav__links nav__logo">
            <i class='bx bx-disc nav__box_icons'></i>
            <span class="nav__logo__name">Eventers</span>
        </a>

        <div class="nav__list">
            <div class="nav__items">
                <h3 class="nav__subtitle">Details</h3>

            </div>

            <a href="dashboard.php" class="nav__links">
                <i class='bx bx-home-alt nav__box_icons'></i>
                <span class="nav__name">Home</span>
            </a>

            <div class="nav__dropdown active">
                <a href="view-profile.php" class="nav__links">
                    <i class='bx bx-user nav__box_icons'></i>
                    <span class="nav__name">Profile</span>
                    <i class='bx bx-chevron-down nav__icon nav__dropdown_icon'></i>
                </a>
                <div class="nav__dropdown__collapse bg-white">
                    <div class="nav__dropdown__content">
                        <a href="profile" class="nav__dropdown__item">Account</a>
                        
                        <a href="organization" class="nav__dropdown__item">Organization</a>

                    </div>
                </div>
            </div>


            <a href="report.php" class="nav__links margin__bottom__2rem">
                <i class='bx bx-message nav__box_icons'></i>
                <span class="nav__name">Report</span>
            </a>

        </div>
        <div class="nav__list">
            <div class="nav__items">
                <h3 class="nav__subtitle">Events</h3>

            </div>
            <!-- <a href="index.php" class="nav__links">
                <i class='bx bx-compass nav__box_icons'></i>
                <span class="nav__name">Explore</span>
            </a> -->
            <a href="events" class="nav__links">
                <i class='bx bx-purchase-tag-alt nav__box_icons'></i>
                <span class="nav__name">All events</span>
            </a>
            <a href="add-event" class="nav__links">
                <i class='bx bx-plus-medical nav__box_icons'></i>
                <span class="nav__name">Host an event</span>
            </a>
            <a href="add-subevent" class="nav__links">
                <i class='bx bx-edit-alt nav__box_icons'></i>
                <span class="nav__name">Manage events
                </span>
            </a>
        </div>
        <a href="logout.php" class="nav__links nav__logout">
            <i class='bx bx-log-out nav__box_icons'></i>
            <span class="nav__name">Log out</span>
        </a>
    </div>

    </div>

</nav>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form method="post" action="templates/Auth/logout.php">
                    <button class="btn btn-primary" name="logout" type="submit">Logout</button>
                </form>
                
            </div>
        </div>
    </div>
</div>