<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

<style>
    th {
        color: black;
    }

    td {
        color: rgba(0, 0, 0, 0.7);
    }
</style>

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
                        <h1 class="h3 mb-0 text-gray-800">Event Applications</h1>
                    </div>

                    <!-- Breadcrumb -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-8">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('internal/level_2/educational_partner/ep_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Event Applications</li>
                            </ol>
                        </div>

                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Card-->
                            <div class="card ">
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table id="admin_course_applicant" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Full Name</th>
                                                    <th>Nationality</th>
                                                    <th>Event Title</th>
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

                    <!--Modal-->
                    <div class="modal fade" id="view_admin_course_application" tabindex="-1" role="dialog" aria-labelledby="view_casLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#6B9080;">
                                    <h5 class="modal-title" id="view_casLabel" style="color:white;">Event Applicant Information</h5>
                                    <button style="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="admin_course_application_information">
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