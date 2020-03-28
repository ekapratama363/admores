
<!DOCTYPE html>
<html lang="eng">
<head>
    <?php $this->load->view("admin_panel/_partials/head.php") ?>
</head>
<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">
    
        <!-- header header  -->
        <div class="header" style="background: #e17055">
            <!-- Navbar  -->
            <?php $this->load->view("admin_panel/_partials/navbar.php") ?>
            <!-- End Navbar  -->      
        </div>
        <!-- End header header -->

        <!-- Left Sidebar  -->
            <?php $this->load->view("admin_panel/_partials/sidebar.php") ?>
        <!-- End Left Sidebar  -->        
    
        <!-- Content -->
        <?php $this->load->view("admin_panel/{$page}") ?>
        <!-- End Content -->
    
        <!-- footer -->
        <?php $this->load->view("admin_panel/_partials/footer.php") ?>
        <!-- End footer -->
    </div>

    <?php $this->load->view("admin_panel/_partials/js.php") ?>
</body>
</html>
