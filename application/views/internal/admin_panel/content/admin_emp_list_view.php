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
                    <h1 class="h3 mb-0 text-gray-800">Employer Projects (EPs)</h1>
                </div>

                <!-- Breadcrumb -->
                <div class="row" >
                    <div class="breadcrumb-wrapper col-xl-9">
                        <ol class="breadcrumb" style = "background-color:rgba(0, 0, 0, 0);">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url('internal/admin_panel/admin_dashboard');?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">Employer Projects (EPs)</li>
                        </ol>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="all_emps_tab" onclick="all_emps_tab()" data-toggle="tab" href="#all_emps" role="tab" aria-controls="all_emps" aria-selected="true">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pending_emps_tab" onclick="pending_emps_tab()" data-toggle="tab" href="#pending_emps" role="tab" aria-controls="pending_emps" aria-selected="false">Pending</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
        
                            <!-- All Employer Projects Content -->
                            <div class="tab-pane fade show active" id="all_emps" role="tabpanel" aria-labelledby="all-emps-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="table_all_emps" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Employer</th>
                                                        <th>EP Title</th>
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

                            <!-- Pending Employer Projects Content -->
                            <div class="tab-pane fade show" id="pending_emps" role="tabpanel" aria-labelledby="pending-emps-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="ml-2 mt-2 mb-4">
                                            <span><button type="button" class="btn btn-success" onclick="approve_all_emps()">Approve All</button></span>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="table_pending_emps" class="table table-striped">
                                                <thead>
                                                <tr>
                                                        <th><input type="checkbox" id="select_all_emp"></th>
                                                        <th>No.</th>
                                                        <th>Employer</th>
                                                        <th>EP Title</th>
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
                <div class="modal fade" id="view_emp" tabindex="-1" role="dialog" aria-labelledby="view_empLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header" style = "background-color:#6B9080;">
                            <h5 class="modal-title" id="view_empLabel" style ="color:white;">Employer Project (EP) Information</h5>
                            <button style ="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div id = "emp_information">

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