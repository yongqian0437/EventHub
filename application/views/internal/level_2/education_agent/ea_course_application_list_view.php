<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
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

<script>
    $(document).ready(function() {
        $("#event_application_form #select-all").click(function() {
            $("#event_application_form input[type='checkbox']").prop('checked', this.checked);
        });
    });
</script>

<!-- Pop up after user added a new event-->
<?php if ($this->session->flashdata('insert_message')) { ?>
    <script>
        var e_applicant_fname = "<?php echo $this->session->flashdata('e_applicant_fname'); ?>";
        Swal.fire({
            icon: 'success',
            //  text: eventName + '" has been added',
            text: 'Information of "' + e_applicant_fname + '" has been added',
        })
    </script>
<?php } ?>

<!-- Pop up after user edit event information-->
<?php if ($this->session->flashdata('edit_message')) { ?>
    <script>
        var e_applicant_fname = "<?php echo $this->session->flashdata('e_applicant_fname'); ?>";
        Swal.fire({
            icon: 'success',
            text: 'Information of "' + e_applicant_fname + '" has been edited',
        })
    </script>
<?php } ?>


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
                        <h1 class="h3 mb-0 text-gray-800">event Applications</h1>
                    </div>

                    <!-- Breadcrumb -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-8">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('internal/level_2/education_agent/ea_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                </li>

                                <li class="breadcrumb-item active">event Applications</li>
                            </ol>
                        </div>
                        <div class="col-xl-4">
                            <div class="d-flex justify-content-end">
                                <a type="button" href="<?= base_url('internal/level_2/education_agent/ea_event_application/add_event_application'); ?>" class="btn btn-primary">Add New Applicant<i class="fas fa-plus pl-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Card-->
                            <div class="card ">
                                <?= $this->session->flashdata('message') ?>
                                <div class="card-body">

                                    <div class="table-responsive">

                                        <form id="event_application_form" method="post" action="<?= base_url('internal/level_2/education_agent/ea_event_application/delete_all_event_application'); ?>">
                                            <table id="table_event_applicants" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Full Name</th>
                                                        <th>Nationality</th>
                                                        <th>Current Level</th>
                                                        <th>organizers</th>
                                                        <th>Submit Date</th>
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
                    <div class="modal fade" id="view_event_application" tabindex="-1" role="dialog" aria-labelledby="view_casLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#6B9080;">
                                    <h5 class="modal-title" id="view_casLabel" style="color:white;">event Applicant Information</h5>
                                    <button style="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div id="event_application_information">

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