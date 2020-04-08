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
                        <?php echo form_open_multipart('home_expertise/store'); ?>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Skill</label>
                                                    <input type="text" class="form-control" name="skill" value="<?php echo set_value('skill'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Level</label>
                                                    <input type="number" class="form-control" name="level" value="<?php echo set_value('level'); ?>">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <a href="<?php echo base_url(); ?>home_expertise/index"><button type="button" class="btn btn-inverse">Cancel</button></a>
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