<div class="ftco-blocks-cover-1">
   <div class="site-section-cover overlay" style="background-image: 
        url('<?php echo base_url() . "uploads/service_title/" . $service_title->image; ?>')">
      <div class="container">
         <div class="row align-items-center justify-content-center">
            <div class="col-md-7 text-center">
               <h1 class="mb-4 text-white"><?php echo $service_title->title; ?></h1>
               <p class="mb-4"><?php echo $service_title->description; ?></p>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-7 mx-auto text-center">
                <h2 class="section-title"><?php echo $service_description->title; ?></h2>
                <p class="heading-content-p"><?php echo $service_description->description; ?></p>
            </div>
        </div>

        <div class="row">
            <?php foreach($service_content as $service_content_value) { ?>
                <div class="col-md-6 col-lg-4">
                    <div class="our-service text-center">
                        <span class="d-block wrap-icon">
                            <img src="<?php echo base_url() . "uploads/service_content/" . $service_content_value->image;  ?>" style="max-width: 150px;" alt="Image" class="img-fluid">
                        </span>
                        <h3><?php echo $service_content_value->title; ?></h3>
                        <p><?php echo $service_content_value->description; ?></p>
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
                <h2 class="section-title"><?php echo $content_description_projects_we_have_completed->title; ?></h2>
                <p class="heading-content-p"><?php echo $content_description_projects_we_have_completed->description; ?></p>
            </div>
        </div>
        <div class="projects_fillter">
            <ul class="filter list">
                <?php foreach($service_category_project as $service_category_project_value) { ?>
                    <li data-filter="<?php echo '.' . strtolower($service_category_project_value->category); ?>"><a href="#"><?php echo $service_category_project_value->category; ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="projects_inner row">
            
            <?php foreach($service_project as $service_project_value) { ?>
                <div class="col-lg-4 col-sm-6 <?php echo strtolower($service_project_value->category); ?>">
                    <div class="projects_item">
                        <div class="item web">
                            <a href="<?php echo base_url() . "uploads/service_project/" . $service_project_value->image; ?>" class="item-wrap" data-fancybox="gal">
                                <span class="icon-add"></span>
                                <img class="img-fluid" src="<?php echo base_url() . "uploads/service_project/" . $service_project_value->image; ?>">
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>
<!--================End Projects Area =================-->