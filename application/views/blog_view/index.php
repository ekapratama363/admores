<div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" style="background-image: 
        url('<?php echo base_url() . "uploads/blog_title/" . $blog_title->image; ?>')">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 text-center">
                    <h1 class="mb-4 text-white"><?php echo $blog_title->title; ?></h1>
                    <p class="mb-4"><?php echo $blog_title->description; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section">
    <div class="container">

        <div class="row mb-5 ">
            <div class="col-md-7 text-center mx-auto">
                <h3 class="section-title-sub text-primary">Articles</h3>
                <h2 class="section-title mb-4">Our Blog</h2>
            </div>
        </div>

        <div class="row">
            
            <?php foreach($blog_post as $blog_post_value) { ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="post-entry-1 h-100">
                        <a href="#">
                            <img src="<?php echo base_url() ?>uploads/home_blog/<?php echo $blog_post_value->image; ?>" alt="Image" class="img-fluid">
                        </a>
                        <div class="post-entry-1-contents">

                            <h2><a href="#"><?php echo $blog_post_value->title; ?></a></h2>
                            <span class="meta d-inline-block mb-3"><?php echo $blog_post_value->created_at; ?>
                                <span class="mx-2">by</span> 
                                    <a class="text-primary" href="#"><?php echo $blog_post_value->name; ?></a>
                                </span>
                            <p><?php echo $blog_post_value->description; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>

        <div class="col-12 mt-5 text-center">
            <p class="p-3 text-primary">
                <?php echo $pagination; ?>
            </p>

        </div>
    </div>
</div>
<!-- END .site-section -->