<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center  ml-md-auto ">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                        <i class="ni ni-zoom-split-in"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
<!--                              <span class="avatar avatar-sm rounded-circle">-->
<!--                                <img alt="Image placeholder" src="assets/img/theme/team-4.jpg">-->
<!--                              </span>-->
                            <div class="media-body  ml-2  d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold"><?php echo $_SESSION["userName"]?></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Bonjour!</h6>
                        </div>
                        <a href="mon-profile.php" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>Mon profil</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="api/auth/logout.php" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Deconnecter</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>