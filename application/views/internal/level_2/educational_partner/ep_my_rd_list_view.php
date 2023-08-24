<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<style>
th{
    color:black;
}
td{
    color: rgba(0,0,0,0.7);
}
</style>
<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url();?>";
</script>

<!-- Pop up after user added a new course-->
<?php if($this->session->flashdata('insert_message')){?>
<script>
    var rd_title = "<?php echo $this->session->flashdata('rd_title');?>";
    Swal.fire({
        icon: 'success',
        text: '"' + rd_title + '" has been added',
    })
</script>
<?php } ?>

<!-- Pop up after user edit course information-->
<?php if($this->session->flashdata('edit_message')){?>
<script>
    var rd_title = "<?php echo $this->session->flashdata('rd_title');?>";
    Swal.fire({
        icon: 'success',
        text: '"' + rd_title + '" has been edited',
    })
</script>
<?php } ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"><?=$university_data->uni_name?>'s R&D Projects</h1>
                </div>

                <!-- Breadcrumn -->
                <div class="row" >
                    <div class="breadcrumb-wrapper col-xl-9">
                        <ol class="breadcrumb" style = "background-color:rgba(0, 0, 0, 0);">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url('internal/level_2/educational_partner/ep_dashboard');?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">R&D Projects</li>
                        </ol>
                    </div>
                    <div class = "col-xl-3 " >
                        <div class = "d-flex justify-content-end">
                            <a type="button" href = "<?= base_url('internal/level_2/educational_partner/ep_my_rd_project/add_rd_project'); ?>" class="btn btn-primary">Add a R&D Project<i class="fas fa-plus pl-2"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Content Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Card-->
                        <div class="card ">
                            <div class="card-body">
                            
                            <div class="table-responsive">
                                <table id="table_my_rd_project" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>R&D Title</th>
                                            <th>Organisation</th>
                                            <th>Person in charge</th>
                                            <th>Submit Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            </div>
                        </div>
                        <!-- /. Card -->

                    </div>                   
                </div>
                <!-- /. Content Row -->

                <!-- Modal -->
                <div class="modal fade" id="view_my_rd_project" tabindex="-1" role="dialog" aria-labelledby="view_my_rd_projectLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                        <div class="modal-header" style = "background-color:#6B9080;">
                            <h5 class="modal-title" id="view_my_rd_projectLabel" style ="color:white;">R&D Project Information</h5>
                            <button style ="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div id = "my_rd_project_information">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->