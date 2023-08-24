<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="flex-fill">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"><?=$university_data['uni_name'] ?>'s Course Applications</h1>
                </div>

                <!-- Breadcrumb -->
                <div class="row" >
                    <div class="breadcrumb-wrapper col-xl-9">
                        <ol class="breadcrumb" style = "background-color:rgba(0, 0, 0, 0);">
                            <li class="breadcrumb-item">
                                <a href="<?=base_url('internal/level_2/Academic_counsellor/Ac_dashboard');?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">Course Applications</li>
                        </ol>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Card-->
                        <div class="card">
                            <div class="card-body">
                            
                            <div class="table-responsive">
                                <table id="table_course_applicants" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Full Name</th>
                                            <th>Nationality</th>
                                            <th>Course Name</th>
                                            <th>Applied By</th>
                                            <th>Applied Date</th>
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
                <div class="modal fade" id="view_course_applicant" tabindex="-1" role="dialog" aria-labelledby="view_course_appLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header" style = "background-color:#6B9080;">
                            <h5 class="modal-title" id="view_course_appLabel" style ="color:white;">Applicant Information</h5>
                            <button style ="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div id = "course_applicant_information">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>

                </div>
                <!-- ./container-fluid -->
            
            </div>
            <!-- ./content -->