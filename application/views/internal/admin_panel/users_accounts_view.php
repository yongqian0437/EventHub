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
            <div id="content" class="flex-fill">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!---------------------------------------------------CODE BEGINS------------------------------------------------------------->

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">All Users</h1>
                    </div>

                    <!-- Breadcrumb -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-9">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('internal/admin_panel/Admin_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">All Users</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Tabs -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="all_users_tab" onclick="all_users_tab()" data-toggle="tab" href="#all_users" role="tab" aria-controls="all_users" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="active_users_tab" onclick="active_users_tab()" data-toggle="tab" href="#active_users" role="tab" aria-controls="active_users" aria-selected="false">Active</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="inactive_users_tab" onclick="inactive_users_tab()" data-toggle="tab" href="#inactive_users" role="tab" aria-controls="inactive_users" aria-selected="false">Inactive</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <!-- Active Users Content -->
                                <div class="tab-pane fade show" id="active_users" role="tabpanel" aria-labelledby="active-users-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ml-2 mt-2 mb-4">
                                                <span><button type="button" class="btn btn-warning" onclick="deactivate_all_users()">Deactivate All</button></span>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="table_active_users" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th><input type="checkbox" id="select_all_active_users"></th>
                                                            <th>No.</th>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Role</th>
                                                            <th>Submitted Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /. Card Body -->
                                    </div>
                                </div>

                                <!-- All Users Content -->
                                <div class="tab-pane fade show active" id="all_users" role="tabpanel" aria-labelledby="all-users-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="table_all_users" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Role</th>
                                                            <th>Submitted Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /. Card Body -->
                                    </div>
                                </div>

                                <!-- Inactive Users Content -->
                                <div class="tab-pane fade show" id="inactive_users" role="tabpanel" aria-labelledby="inactive-users-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ml-2 mt-2 mb-4">
                                                <span><button type="button" class="btn btn-success" onclick="activate_all_users()">Activate All</button></span>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="table_inactive_users" class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th><input type="checkbox" id="select_all_inactive_users"></th>
                                                            <th>No.</th>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Role</th>
                                                            <th>Submitted Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /. Card Body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /. Content Row -->

                    <!-- Modal -->
                    <div class="modal fade" id="view_user" tabindex="-1" role="dialog" aria-labelledby="view_userLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#6B9080;">
                                    <h5 class="modal-title" id="view_userLabel" style="color:white;">User Information</h5>
                                    <button style="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div id="user_information">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="view_next" tabindex="-1" role="dialog" aria-labelledby="view_nextLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#6B9080;">
                                    <h5 class="modal-title" id="view_nextLabel" style="color:white;">Org Information</h5>
                                    <button style="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="next">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!---------------------------------------------------CODE ENDS------------------------------------------------------------->

                </div>
                <!-- ./container-fluid -->

            </div>
            <!-- ./content -->