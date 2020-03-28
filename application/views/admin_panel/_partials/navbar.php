<nav class="navbar top-navbar navbar-expand-md navbar-light">
    <!-- Logo -->
    <div class="navbar-header" style="background: #c15f47">
        <a class="navbar-brand" href="<?php echo base_url(); ?>/routes/home">
            <!-- Logo icon -->
            <b style="color: #ffffff; font-size: 20px;">
                <!-- <img src="{{ $logo }}" alt="homepage" class="dark-logo" height="30" width="38" /> -->
            </b>
            <!--End Logo icon -->
        </a>
    </div>
    <!-- End Logo -->
    <div class="navbar-collapse">
        <!-- toggle and nav items -->
        <ul class="navbar-nav mr-auto mt-md-0">
            <!-- This is  -->
            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
            <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)"><i class="ti-menu" style="color: #fff"></i></a> </li>
        </ul>
        <!-- User profile and search -->
        <div style="vertical-align: middle; margin-right: 10px; color: #fff"><?php echo $this->session->userdata("username"); ?></div>
        <ul class="navbar-nav my-lg-0">
            <!-- Profile -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/images/avatar/4.jpg" alt="user" class="profile-pic" /></a>
                <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                    <ul class="dropdown-user">
                        <li><a href="#"><i class="ti-user"></i> Profile</a></li>
                        <li><a href="#"><i class="ti-settings"></i> Setting</a></li>
                        <li><a href="<?php echo base_url(); ?>/auth/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>