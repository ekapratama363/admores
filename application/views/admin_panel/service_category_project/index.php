<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <!-- <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Dashboard</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Invitation</a></li>
                <li class="breadcrumb-item active">testimony</li>
            </ol>
        </div> -->
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        
        <?php if($this->session->flashdata('success') != NULL) { ?>
            <div class="alert alert-success alert-dismissible">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <p class="text-white"><?php echo $this->session->flashdata('success'); ?></p>
            </div>
        <?php } ?>

        
        <?php if($this->session->flashdata('failed') != NULL) { ?>
            <div class="alert alert-warning alert-dismissible">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <p class="text-dark"><?php echo $this->session->flashdata('failed'); ?></p>
            </div>
        <?php } ?>
        
        <div class="card">
            <div class="card-body">
                <div class="box-header with-border">
                    <a href="<?php echo base_url(); ?>service_category_project/create" class="btn btn-primary btn-sm" title="Add User"><i class="fa fa-plus"></i></a>
                </div>
                        
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Category</th>
                                <th style="width: 5%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <!-- End Container fluid  -->
</div>

<script src="<?php echo base_url(); ?>assets/js/lib/jquery/jquery.min.js"></script>

<!-- Data Table -->
<script>
    $(document).ready(function(){
        $('#myTable').dataTable({
            // "scrollY": "400px",
            // "scrollX": "700px",
            // "scrollX": true,
            //"scrollCollapse": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            // "responsive": true,
            // "scrollCollapse": true,
            // "columnDefs": [    
            //    {                                 
            //        "targets": '_all',
            //        "render": $.fn.dataTable.render.text()
            //    }    
            //  ], 
            //"scrollCollapse": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>service_category_project/ajax_list_service_category_project",
                "dataType": "json",
                "type": "POST",
                // "data": {
                //     _token: "{{csrf_token()}}",
                // }
            },
            "columns": [
                {"data": "no"},
                {"data": "category"},
                {"data": "action"},
            ],
            // columnDefs : [
            //     { 
            //         "className": "invoice", 
            //         "targets" : [0, 3],//first column / numbering column
            //     }
            // ],   

        });

    });
</script>

