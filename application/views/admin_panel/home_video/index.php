<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <!-- <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Dashboard</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Invitation</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('user') }}">Degree</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div> -->
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">
            <div class="col-lg-12">

                <?php if(validation_errors()) { ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <p class="text-white"><?php echo validation_errors(); ?></p>
                    </div>
                <?php } ?>

                <?php if($this->session->flashdata('success') != NULL) { ?>
                    <div class="alert alert-success alert-dismissible">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <p class="text-white"><?php echo $this->session->flashdata('success') ?></p>
                    </div>
                <?php } ?>

                <?php if($this->session->flashdata('failed') != NULL) { ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <p class="text-white"><?php echo $this->session->flashdata('failed') ?></p>
                    </div>
                <?php } ?>

                <div class="card card-outline-primary">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Create</h4>
                    </div>
                    <div class="card-body">
                        <?php echo form_open_multipart('home_video/store'); ?>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="title" value="<?php echo isset($value->title) ? $value->title : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="description">Description</label><br />
                                                    <textarea style="padding: 10px;" class="col-md-12" rows="5" name="description"><?php echo isset($value->description) ? $value->description : ''; ?></textarea>
                                                </div>
                                            </div>
                                        </div> -->
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="video">Video</label><br />
                                                    <input type="file" name="video" id="video">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                                                                      
                                                    <button type="button" onclick="playPause()">Play/Pause</button> 
                                                    
                                                    <!-- <button type="button" onclick="makeBig()">Big</button>
                                                    <button type="button" onclick="makeSmall()">Small</button>
                                                    <button type="button" onclick="makeNormal()">Normal</button> -->
                                                    
                                                    <video id="video1" width="420" autoplay>
                                                        <source src="<?php echo base_url(); ?>uploads/home_video/<?php echo $value->video ?>" type="video/mp4">
                                                        <!-- <source src="movie.ogg" type="video/ogg"> -->
                                                        <!-- Your browser does not support the video tag. -->
                                                    </video>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <a href="<?php echo base_url(); ?>home_video/index"><button type="button" class="btn btn-inverse">Cancel</button></a>
                            </div>

                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->
</div>
<!-- End Page wrapper  -->

<script> 
    var myVideo = document.getElementById("video1"); 

    function playPause() { 
        if (myVideo.paused) {
            myVideo.play(); 
        } else {
            myVideo.pause(); 
        } 

        function makeBig() { 
            myVideo.width = 560; 
        } 

        function makeSmall() { 
            myVideo.width = 320; 
        } 

        function makeNormal() { 
            myVideo.width = 420; 
        } 
    } 
</script> 
