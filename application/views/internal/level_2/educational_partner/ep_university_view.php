<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>

<style>
    label {
        color: black;
    }

    input[readonly] {
        background-color: rgba(192, 192, 192, 0.1) !important;
    }

    textarea[readonly] {
        background-color: rgba(192, 192, 192, 0.1) !important;
    }
</style>

<script>
    //Js to remove alert message after university information is edited
    setTimeout(function() {
        $('#alert_message').fadeOut();
    }, 5000); // <-- time in milliseconds
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
                        <h1 class="h3 mb-0 text-gray-800">Organizer</h1>
                    </div>

                    <!-- Breadcrumn -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-9">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('internal/level_2/educational_partner/ep_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Organizer</li>
                            </ol>
                        </div>
                        <div class="col-xl-3">
                            <?php if ($university_data->uni_approval) { ?>
                                <div class="d-flex justify-content-end">
                                    <a type="button" href="<?= base_url('internal/level_2/educational_partner/ep_university/edit_university'); ?>" class="btn btn-primary">Edit<i class="fas fa-edit pl-2"></i></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Card-->
                            <div class="card ">
                                <div class="card-body">
                                    <!-- Check for uni approval -->
                                    <?php if ($university_data->uni_approval) { ?>
                                        <?= $this->session->flashdata('edit_message') ?>
                                        <form action="">
                                            <div class="form-row">
                                                <div class="form-group col-md-6 px-4 pr-5">
                                                    <label for="uni_name">Organizer Name</label>
                                                    <input type="text" class="form-control" id="uni_name" name="uni_name" placeholder="Enter university name" value="<?= $university_data->uni_name ?>" readonly>
                                                </div>
                                                <div class="form-group col-md-6 px-4 pl-5">
                                                    <label for="uni_country">Organizer Country</label>
                                                    <input type="text" class="form-control" id="uni_country" name="uni_country" placeholder="Enter country" value="<?= $university_data->uni_country ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12 px-4 pt-4">
                                                    <label for="uni_shortprofile">Organizer Shortprofile</label>
                                                    <textarea type="text" class="form-control" rows="10" id="uni_shortprofile" name="uni_shortprofile" placeholder="Enter shortprofile" readonly><?= $university_data->uni_shortprofile ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12 px-4 pt-4">
                                                    <label for="uni_fun_fact">Organizer Fun Fact</label>
                                                    <textarea type="text" class="form-control" rows="5" id="uni_fun_fact" name="uni_fun_fact" placeholder="Enter fun fact" readonly><?= $university_data->uni_fun_fact ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-row pt-4">
                                                <div class="form-group col-md-6 px-4 pr-5">
                                                    <label for="uni_hotline">Organizer Hotline</label>
                                                    <input type="text" class="form-control" id="uni_hotline" name="uni_hotline" placeholder="Enter hotline" value="<?= $university_data->uni_hotline ?>" readonly>
                                                </div>
                                                <div class="form-group col-md-6 px-4 pl-5">
                                                    <label for="uni_email">Organizer Email</label>
                                                    <input type="email" class="form-control" id="uni_email" name="uni_email" placeholder="Enter email" value="<?= $university_data->uni_email ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row pt-4">
                                                <div class="form-group col-md-6 px-4 pr-5">
                                                    <label for="uni_address">Organizer Address</label>
                                                    <input type="text" class="form-control" id="uni_address" name="uni_address" placeholder="Enter address" value="<?= $university_data->uni_address ?>" readonly>
                                                </div>
                                                <div class="form-group col-md-6 px-4 pl-5">
                                                    <label for="uni_website">Organizer Website</label>
                                                    <input type="text" class="form-control" id="uni_website" name="uni_website" placeholder="Enter website" value="<?= $university_data->uni_website ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-row pt-5">
                                                <div class="form-group col-md-4 px-4 pr-5">
                                                    <label for="uni_qsrank">Organizer Campus Rank</label>
                                                    <input type="number" class="form-control" id="uni_qsrank" name="uni_qsrank" placeholder="Enter QS ranking" value="<?= $university_data->uni_qsrank ?>" readonly>
                                                </div>

                                                <div class="form-group col-md-4 px-4 ">
                                                    <label for="uni_totalstudents">Organizer Total Employee</label>
                                                    <input type="number" class="form-control" id="uni_totalstudents" name="uni_totalstudents" placeholder="Enter total student" value="<?= $university_data->uni_totalstudents ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="py-4">
                                                <hr style=" width :100%; height:1px; background-color: rgba(0, 0, 0, 0.3); ;">
                                            </div>
                                            <!-- Images Row -->
                                            <div class="row">

                                                <div class="col-xl-6 pl-5">
                                                    <div class="pb-3" style="color:black;">Current Organizer Logo</div>
                                                    <img style=" height:200px; width: 300px; object-fit: contain;" src="<?= base_url("assets/img/universities/") . $university_data->uni_logo ?>" alt="logo">
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="pb-3" style="color:black;">Current Organizer Background</div>
                                                    <img style=" height:200px; width: 300px; object-fit: contain;" src="<?= base_url("assets/img/universities/") . $university_data->uni_background ?>" alt="background">
                                                </div>

                                            </div>
                                            <!-- /. Images Row -->


                                        </form>
                                    <?php } else { ?>
                                        <div class="row justify-content-md-center">
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card h-100 shadow">
                                                    <div class="card-body">
                                                        <div style="text-align:center;">This organizer is still pending approval.</div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                            <!-- /. Card -->

                        </div>
                    </div>
                    <!-- /. Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->