<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

<style>
    table {
        width: 98% !important;
    }

    tr {

        border-collapse: collapse;
        vertical-align: center;
    }

    /* styling for datatables pagination */
    #table_university_paginate {
        padding-top: 20px;
    }

    /* styling for datatables search */
    #table_university_filter {
        font-size: 20px;
    }

    table.dataTable tbody td {
        vertical-align: middle;
        color: black !important;
        font-size: 1.0em !important;
        text-align: center !important;
        border-bottom: 1px solid black !important;
        font-weight: 500;
    }

    table.dataTable thead th {
        text-align: center !important;
        vertical-align: middle;
        border-top: 2px solid black !important;
        border-bottom: 2px solid black !important;
        color: black !important;
        font-size: 1.1em !important;
        font-weight: 700 !important;
    }
</style>


<!-- Top Navigation -->
<?php $this->load->view('external/templates/topnav'); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div style='background-color:white;' class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2 px-4">
                        <h1 class="h3 mb-0 text-gray-800 pt-4 font-weight-bold">Organizer</h1>
                    </div>

                    <div class="py-2 px-4" style="text-align: justify; font-weight:500;">Welcome to the Event Organizer Page! Here, you'll find a comprehensive list of talented and creative individuals who are behind the exciting events happening on our campus. Get to know our dedicated organizers and discover the incredible events they are planning. Each organizer profile showcases their expertise, interests, and past event successes. If you have any questions or want to collaborate on an event, feel free to reach out to them directly. Let's celebrate the hard work and passion of our event organizers who make campus life vibrant and unforgettable!
                    </div>

                    <div class="px-4 pb-4">
                        <hr style=" width :100%; height:2px; background-color:#EAF4F4">
                    </div>

                    <!-- Content Row -->

                    <div class="row pt-1 px-4">
                        <div class="col-12">
                            <div class="card border-dark">
                                <div class="card-body">
                                    <div class="pb-3" style="display: flex; flex-direction: row; justify-content: space-between; color:white;">
                                        <?php $uni_count = count($university_data) ?>
                                        <div style="background-color:#1dd3b0; border-radius:10px; width:auto; height:auto;">
                                            <div class="px-3 pt-2 ">
                                                <h4 style=" font-weight:700;"><span style="color:white"><?php echo $uni_count ?></span><span style="color:white; "> ORGANIZERS</span></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="table_university" class="table ">
                                            <thead>
                                                <tr>
                                                    <th>Organizer</th>
                                                    <th>Organizer Name</th>
                                                    <th>Country</th>
                                                    <th>Available Events</th>
                                                    <th>Campus Ranking</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br><br><br>




                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->