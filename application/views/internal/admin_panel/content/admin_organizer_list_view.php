<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<style>
    th {
        color: black;
    }

    td {
        color: rgba(0, 0, 0, 0.7);
    }

    .dataTable>thead>tr>th[id*="sort"]:before,
    .dataTable>thead>tr>th[id*="sort"]:after {
        content: "" !important;
    }
</style>
<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

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
                        <h1 class="h3 mb-0 text-gray-800">Organizers</h1>
                    </div>

                    <!-- Breadcrumn -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-9">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('internal/admin_panel/admin_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Organizers</li>
                            </ol>
                        </div>
                    </div>
                    <!-- Content Row -->

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pending</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="myTabContent">

                        <!-- All R&D Projects tab -->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="row">
                                <div class="col-xl-12">
                                    <!-- Card-->
                                    <div class="card ">
                                        <div class="card-body">

                                            <div class="table-responsive">
                                                <table id="table_admin_all_uni" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Organizer Name</th>
                                                            <th>Country</th>
                                                            <th>Email</th>
                                                            <th>Submitted Date</th>
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
                        </div>
                        <!-- /. All R&D Projects tab -->


                        <!-- Pending R&D Projects tab -->
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-xl-12">
                                    <!-- Card-->
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="ml-2 mt-2 mb-4">
                                                <span><button type="button" class="btn btn-success" onclick="approve_all_uni()">Approve All</button></span>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="table_admin_pending_uni" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th id="sort"><input type="checkbox" id="select_all_uni"></th>
                                                            <th>No.</th>
                                                            <th>Organizer Name</th>
                                                            <th>Country</th>
                                                            <th>Email</th>
                                                            <th>Submitted Date</th>
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
                        </div>
                        <!-- /. Pending R&D Projects tab -->

                    </div>
                    <!-- /.Tab Content -->


                    <!-- Modal -->
                    <div class="modal fade" id="view_admin_uni" tabindex="-1" role="dialog" aria-labelledby="view_admin_uniLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#61677A;">
                                    <h5 class="modal-title" id="view_admin_uniLabel" style="color:white;">organizers Information</h5>
                                    <button style="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="admin_organizers_information">

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