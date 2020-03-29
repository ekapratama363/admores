<div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" style="background-image: 
        url('<?php echo base_url() . "uploads/home_title/" . $home_title->image; ?>')">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 text-center">
                    <h1 class="mb-4 text-white"><?php echo $home_title->title; ?></h1>
                    <p class="mb-4"><?php echo $home_title->description; ?></p>
                    <p><a href="#" class="btn btn-primary btn-outline-white py-3 px-5">Contact Us</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start brand Area -->
<section class="site-section bg-light">
	<div class="container">
		<div class="row mb-5">
            <div class="col-md-8 mx-auto text-center">
                <h2 class="heading-content">Our Clients </h2>
                <p class="heading-content-p">Since 2018, we collaborate in more than dozens Projects and still counting </p>
            </div>
        </div>

		<div class="row align-items-center" style="text-align: center;">
			
            <?php foreach($home_client as $home_client_value) { ?>
                <div class="col single-brand">
                    <img src="<?php echo base_url(); ?>uploads/home_client/<?php echo $home_client_value->image; ?>" alt="Image" class="img-fluid" style="max-width: 180px">
                </div>
            <?php } ?>

		</div>
	</div>	
</section>
<!-- End brand Area -->

<div class="site-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <h2 class="h4 mb-4"><?php echo $home_description->title; ?></h2>
                <p><?php echo $home_description->description; ?></p>
                <a href="#" class="btn btn-primary text-white px-5">Read More</a>
                </p>
            </div>

            <div class="col-md-4">
                <img src="<?php echo base_url(); ?>uploads/home_description/<?php echo $home_description->image; ?>"
                    alt="Image" class="img-fluid">
            </div>

            <div class="col-md-4">
                <h2 class="h4 mb-4">Our expertise and skills</h2>

                <?php foreach($home_expertise as $home_expertise_value) { ?>
                    <div class="progress-wrap mb-4">
                        <div class="d-flex">
                            <span><?php echo $home_expertise_value->skill; ?></span>
                            <span class="ml-auto"><?php echo $home_expertise_value->level; ?>%</span>
                        </div>
                        <div class="progress rounded-0" style="height: 10px;">
                            <div class="progress-bar" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                <?php } ?>

            </div> 
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-7 mx-auto text-center">
                <h2 class="heading-content">Our Services</h2>
                <p class="heading-content-p">Lorem ipsum dolor sit amet. Consectetur adipisicing elit Eaque commodi.</p>
            </div>
        </div>

        <div class="row">
            <?php foreach($home_service as $home_service_value) { ?>
                <div class="col-md-6 col-lg-4">
                    <div class="our-service text-center">
                        <span class="d-block wrap-icon">
                            <img src="<?php echo base_url(); ?>uploads/home_service/<?php echo $home_service_value->image; ?>" style="max-width: 150px;" alt="Image" class="img-fluid">
                        </span>
                        <h3><?php echo $home_service_value->title; ?></h3>
                        <p><?php echo $home_service_value->description; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!--================Projects Area =================-->
<section class="projects_area p_120">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center" style="padding-top: 20px;">
                <h2 class="heading-content">Projects we have completed</h2>
                <p class="heading-content-p">Lorem ipsum dolor sit amet. Consectetur adipisicing elit Eaque commodi.</p>
            </div>
        </div>
        
        <div class="projects_fillter">
            <ul class="filter list">
                <?php foreach($home_category_project as $home_category_project_value) { ?>
                    <li data-filter="<?php echo '.' . strtolower($home_category_project_value->category); ?>"><a href="#"><?php echo $home_category_project_value->category; ?></a></li>
                <?php } ?>
            </ul>
        </div>

        <div class="projects_inner row">
        
            <?php foreach($home_project as $home_project_value) { ?>
                <div class="col-lg-4 col-sm-6 <?php echo strtolower($home_project_value->category); ?>">
                    <div class="projects_item">
                        <div class="item web">
                            <a href="<?php echo base_url() . "uploads/home_project/" . $home_project_value->image; ?>" class="item-wrap" data-fancybox="gal">
                                <span class="icon-add"></span>
                                <img class="img-fluid" src="<?php echo base_url() . "uploads/home_project/" . $home_project_value->image; ?>">
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>
<!--================End Projects Area =================-->


<div class="site-section bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-7 mx-auto text-center">
                <h2 class="heading-29190">See Our Video</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">

                <a href="<?php echo base_url(); ?>uploads/home_video/<?php echo $home_video->video; ?>" data-fancybox class="btn-video_38929">
                    <span><span class="icon-play"></span></span>
                    <img src="<?php echo base_url(); ?>images/video_1.jpg" alt="Video" class="img-fluid">
                </a>

            </div>
        </div>
    </div>
</div>

<!--================Testimonials Area =================-->
<section class="testimonials_area p_120">
	<div class="container">
		<div class="row mb-5">
            <div class="col-md-8 mx-auto text-center">
                <h2 class="heading-content">Hear from our happy clients</h2>
                <p class="heading-content-p">Lorem ipsum dolor sit amet. Consectetur adipisicing elit Eaque commodi.</p>
            </div>
        </div>
		<div class="testi_inner">
			<div class="testi_slider owl-carousel">
				
                <?php foreach($home_testimony as $home_testimony_value) { ?>
                    <div class="item">
                        <div class="col-lg-12 col-md-6">
                            <div>
                                <div class="person-pic mb-4">
                                    <img src="<?php echo base_url(); ?>uploads/home_testimony/<?php echo $home_testimony_value->image; ?>" alt="Image" class="img-fluid" style="width: 100px; height: 100px;">
                                </div>

                                <blockquote class="quote_testimony">
                                    <p><?php echo $home_testimony_value->testimony; ?></p>
                                </blockquote>
                                <p>&mdash; <?php echo $home_testimony_value->name; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
			
            </div>
		</div>
	</div>
</section>
<!--================End Testimonials Area =================-->

<div class="site-section bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-7 mx-auto text-center">
                <h2 class="heading-content">Blog</h2>
                <p class="heading-content-p">Lorem ipsum dolor sit amet. Consectetur adipisicing elit Eaque commodi.</p>
            </div>
        </div>

        <div class="row">
            
            <?php foreach($home_blog as $home_blog_value) { ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="post-entry-1 h-100">
                        <a href="single.html">
                            <img src="<?php echo base_url(); ?>uploads/home_blog/<?php echo $home_blog_value->image; ?>" alt="Image" class="img-fluid">
                        </a>
                        <div class="post-entry-1-contents">
                            <h2><a href="single.html"><?php echo $home_blog_value->title; ?></a></h2>
                            <span class="meta d-inline-block mb-3"><?php echo $home_blog_value->created_at; ?> 
                                <span class="mx-2">by</span> 
                                <a href="#" style="color:#3378bd;"><?php echo $home_blog_value->name; ?></a>
                            </span>
                            <p><?php echo $home_blog_value->description; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>

