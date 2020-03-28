<div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" style="background-image: 
      url('<?php echo base_url() . "uploads/contact_title/" . $contact_title->image; ?>')">
      
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 text-center">
                    <h1 class="mb-4 text-white"><?php echo $contact_title->title; ?></h1>
                    <p class="mb-4"><?php echo $contact_title->description; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>


   <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mb-5" >
            
            <?php if(validation_errors()) { ?>
                <div class="alert alert-warning alert-dismissible">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <p class="text-white"><?php echo validation_errors(); ?></p>
                </div>
            <?php } ?>

            <?php if($this->session->flashdata('success') != NULL) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <p class="text-black"><?php echo $this->session->flashdata('success') ?></p>
                </div>
            <?php } ?>

            <?php echo form_open('contact/store'); ?>
          
              <div class="form-group row">
                <div class="col-md-6 mb-4 mb-lg-0">
                  <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>" placeholder="First name">
                </div>

                <div class="col-md-6">
                  <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Last name">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Email address">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <textarea name="message" class="form-control" placeholder="Write your message." cols="30" rows="10"><?php echo set_value('message'); ?></textarea>
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-md-6 mr-auto">
                  <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5" value="Send Message">
                </div>
              </div>
            <?php echo form_close(); ?>
          
          </div>

          <div class="col-lg-4 ml-auto">
            <div class="bg-white p-3 p-md-5">
              <h3 class="text-black mb-4">Contact Info</h3>
              <ul class="list-unstyled footer-link">
                <li class="d-block mb-3">
                  <span class="d-block text-black">Address:</span>
                  <span><?php echo $contact_info->address; ?></span></li>
                <li class="d-block mb-3"><span class="d-block text-black">Phone:</span><span><?php echo $contact_info->phone; ?></span></li>
                <li class="d-block mb-3"><span class="d-block text-black">Email:</span><span><?php echo $contact_info->email; ?></span></li>
              </ul>
            </div>
          </div>
        </div>
        
      </div>
    </div> <!-- END .site-section -->