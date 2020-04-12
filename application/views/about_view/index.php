<div class="ftco-blocks-cover-1">
   <div class="site-section-cover overlay" 
         style="background-image:    
            url('<?php echo base_url() . "uploads/about_title/" . $about_title->image; ?>')">
      <div class="container">
         <div class="row align-items-center justify-content-center">
            <div class="col-md-7 text-center">
               <h1 class="mb-4 text-white"><?php echo $about_title->title; ?></h1>
               <p class="mb-4"><?php echo $about_title->description; ?></p>
            </div>
         </div>
      </div>
   </div>
</div>

 <!--================ Start Clients Logo Area =================-->
 <!--<section class="clients_logo_area site-section">
   <div class="container">
      <div class="row">
     <div class="clients_slider owl-carousel">
       <div class="item">
         <img src="images/clients-logo/c-logo-1.png" alt="">
       </div>
       <div class="item">
         <img src="images/clients-logo/c-logo-2.png" alt="">
       </div>
       <div class="item">
         <img src="images/clients-logo/c-logo-3.png" alt="">
       </div>
       <div class="item">
         <img src="images/clients-logo/c-logo-4.png" alt="">
       </div>
       <div class="item">
         <img src="images/clients-logo/c-logo-5.png" alt="">
       </div>
     </div>
   </div>
</div>
 </section>-->

 <!--================ End Clients Logo Area =================-->

<!-- ABOUT US -->
<section class="site-section about-us-section bg-light" >
   
   <div class="container">
      <div class="row mb-0 pt-0 site-section">
         <div class="col-md-12 align-self-center" style="text-align: center;">
            <h3 class="section-title-sub text-primary"><?php echo $about_description->title; ?></h3>
            <h2 class="section-title mb-4"><?php echo $about_description->title_description; ?></h2>
            <p>
               <?php echo $about_description->description; ?>
            </p>
         </div>
      </div>
   </div>

   <div class="container">
      <div class="row">
         <?php foreach($about_content as $content) { ?>
            <div class="col-md-6 col-lg-4">
               <div class="our-service2 text-center">
                  <span class="d-block wrap-icon">
                     <img src="<?php echo base_url() . "uploads/about_content/" . $content->image; ?>" style="max-width: 180px;" alt="Image" class="img-fluid">
                  </span>
                  <p style="font-size: 18px; font-weight: bold;"><?php echo $content->title; ?></p>
                  <p><?php echo $content->description; ?></p>
               </div>
            </div>
         <?php } ?>
      </div>
   </div>
</section>


<div class="site-section">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 mb-5 mb-lg-0">
            <img src="<?php echo base_url() . 'uploads/about_detail/' . $about_detail->image;  ?>" alt="Image" class="img-shadow">
         </div>
         <div class="col-lg-6 ml-auto pl-lg-12">
            <span class="sub-title"><?php echo $about_detail->title; ?></span>
            <h2 class="section-title mb-4"><?php echo $about_detail->description; ?></h2>
            <div class="accordion" id="accordionAdmores">
               <?php foreach($about_detail_description as $key => $about_detail_description_value) { ?>
                  <div class="accordion-item">
                     <h2 class="mb-0 rounded mb-2">
                        <a href="#" data-toggle="collapse" 
                           data-target="#collapseOne" 
                           aria-expanded="true" aria-controls="collapseOne">
                           <?php echo $about_detail_description_value->title; ?> 
                        </a>
                     </h2>
                     <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionAdmores">
                        <div class="accordion-body">
                           <p><?php echo $about_detail_description_value->description; ?> </p>
                        </div>
                     </div>
                  </div>
               <?php } ?>
               <!-- <div class="accordion-item">
                  <h2 class="mb-0 rounded mb-2">
                     <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                     Understanding business context to align with project management & operations process
                     </a>
                  </h2>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionAdmores">
                     <div class="accordion-body">
                        <p>Our senior team members has already worked in client side function. This experience enable us to translate overall end client business objectives into research objectives and project management & operation objectives</p>
                     </div>
                  </div>
               </div>
               <div class="accordion-item">
                  <h2 class="mb-0 rounded mb-2">
                     <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                     Integrating technology to drive process efficiency 
                     </a>
                  </h2>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionAdmores">
                     <div class="accordion-body">
                        <p>We implement technologies to enhance research processes. It enables our client to monitor projects on real time and efficient basis. </p>
                     </div>
                  </div>
               </div>
               <div class="accordion-item">
                  <h2 class="mb-0 rounded mb-2">
                     <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                     Customized project management & operation solutions 
                     </a>
                  </h2>
                  <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionAdmores">
                     <div class="accordion-body">
                        <p>We offer both full (up to data analysis results) and partial services (one or few parts of field services process), depend on client requirement. </p>
                     </div>
                  </div>
               </div>
               <div class="accordion-item">
                  <h2 class="mb-0 rounded mb-2">
                     <a href="#" class="collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                     On client’s budget
                     </a>
                  </h2>
                  <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionAdmores">
                     <div class="accordion-body">
                        <p>Since our objectives is to be a reliable thinking partners in project management & operation, we set our project management & operation spending to be on client’s budget scope. It enables our client to manage top and bottom line offering for their end clients.</p>
                     </div>
                  </div>
               </div> -->
            </div>
         </div>
      </div>
   </div>
</div>

<section class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center" data-aos="fade">
            <h3 class="section-title-sub text-primary">Our Team</h3>
            <h2 class="section-title mb-3">Team</h2>
          </div>
        </div>

        <div class="row align-items-center block__69944">
         <?php foreach($about_team as $team) { ?>
          <div class="col-lg-6 mb-5">
            <img src="<?php echo base_url() . "uploads/about_team/" . $team['image']; ?>" alt="Image" class="img-fluid mb-4 rounded">

            <h3><?php echo $team['name']; ?></h3>
            <p class="text-muted"><?php echo $team['position']; ?></p>
            <p class="lead"><?php echo $team['title']; ?></p>
            <p><?php echo $team['description']; ?></p>
            <div class="social_29128 mt-4">
               <?php foreach($team['social_media'] as $social_media) { ?>
                  <a href="<?php echo strtolower($social_media['link']); ?>"><span class="icon-<?php echo strtolower($social_media['type']); ?>"></span></a>
               <?php } ?>
            </div>

          </div>

         <?php } ?>

        </div>


      </div>
    </section>