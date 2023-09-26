<link href="<?php echo base_url() ?>/assets/scss/courses-styles.scss" rel="stylesheet">

<!-- Top Navigation -->
<?php $this->load->view('external/templates/topnav'); ?>

<style>
    #logo {
        border-radius: 50% 50% 15% 15%;
        width: 20vh;
        height: 20vh;
        object-fit: scale-down;
        background-color: white;
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="d-flex container py-4">
                        <?php if (!empty($course_data)) {
                            foreach ($course_data as $courses) { ?>
                                <div class="col-12">
                                    <div class="course-cover-img" style="background-image: url('<?php echo base_url("assets/img/universities/") . $uni_data->uni_background; ?>');">
                                        <div class="fallbak">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="pt-5 pl-2 pb-1">
                                                        <div style="width:25vh; height:25vh; border-radius:100%; margin:auto; background-color:white;">
                                                            <center><img src="<?php echo base_url("assets/img/universities/") . $uni_data->uni_logo; ?>" alt="uni_logo" id="logo" class="pt-5"></center>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5 align-self-end">
                                                    <div>
                                                        <h4 class="course-detail-title"><?php echo $courses->course_name ?></h4>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                    <hr>
                                    <section class="course-info-section">
                                        <div class="container py-2">
                                            <div class="col-12 d-flex justify-content-center mb-3">
                                                <div class="row">
                                                    <div>
                                                        <?php if ($user_role == 'Student') { ?>
                                                            <?php $response = $this->course_applicants_model->past_application($courses->course_id, $user_email);
                                                            if ($response == true) { ?>
                                                                <button type=" button" class="btn btn-secondary" style="background-color: #000000;" disabled>Applied</button>
                                                            <?php } else { ?>
                                                                <a href="<?php echo base_url() . 'external/Courses/course_applicant/' . $courses->course_id ?>" type=" button" class="btn btn-secondary course-ave-buttons">Apply</a>
                                                            <?php } ?>

                                                        <?php } else { ?>
                                                            <a type="button" class="btn btn-secondary course-ave-buttons" href="<?= base_url('user/login/Auth/login'); ?>">Apply</a>
                                                            <!-- ***If Student is not logged in, 'Apply' button will redirect to Login page -->
                                                        <?php } ?>
                                                        <a type="button" target="_blank" href="<?php echo base_url() . 'external/Universities/university_detail/' . $courses->uni_id ?>" class="btn btn-secondary course-ave-buttons">View Organizer</a>
                                                        <!-- <a type="button" href="<?= base_url('user/chat/Chat'); ?>" class="btn btn-secondary course-ave-buttons">Enquire</a> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Accordion -->
                                                <a href="#collapseCard1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                    <h6 class="m-0 font-weight-bold card-h-title">Description</h6>
                                                </a>
                                                <!-- Card Content - Collapse -->
                                                <div class="collapse show" id="collapseCard1">
                                                    <div class="card-body">
                                                        <h6><b>Event Type</b></h6>
                                                        <?php echo $courses->event_type ?>
                                                        <br>
                                                        <br>

                                                        <h6><b>About</b></h6>
                                                        <div style="white-space: pre-wrap; word-break: break-word; text-align: justify;"> <?php echo $courses->course_shortprofile ?></div>

                                                        <br>
                                                        <h6><b>Event Venue</b></h6>
                                                        <?php echo $courses->course_careeropportunities ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card shadow mb-4">
                                                <!-- Card Header - Accordion -->
                                                <a href="#collapseCard2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                    <h6 class="m-0 font-weight-bold card-h-title">Programme Structure</h6>
                                                </a>
                                                <!-- Card Content - Collapse -->
                                                <div class="collapse show" id="collapseCard2">
                                                    <div class="card-body">
                                                        <p style="white-space: pre-wrap; word-break: break-word;"><?php echo $courses->course_structure ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="d-flex card shadow mb-4">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#collapseCard3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                            <h6 class="m-0 font-weight-bold card-h-title">Fees</h6>
                                                        </a>
                                                        <!-- Card Content - Collapse -->
                                                        <div class="collapse show" id="collapseCard3">
                                                            <div class="card-body">
                                                                <div style="font-size:0.9em; color: red; font-weight: 700">Disclaimer</div>
                                                                <div style="font-size:0.9em;" class="mb-4">Please note that tuition fees may vary depending on the type and amount of courses that a student enrolls in. Tuition is subject to change without notice and annual increases.</div>
                                                                <p><b>Malaysian based Fee:</b> RM<?php echo number_format($courses->course_fee) ?> -
                                                                    <?php echo $courses->course_duration ?> hour(s) </p>
                                                                <p><b>International Fee:</b> $<?php echo number_format($courses->course_usd_fee) ?> -
                                                                    <?php echo $courses->course_duration ?> hour(s) </p>
                                                                <p><b>Contact Information:</b> <?php echo $courses->course_intake ?></p>
                                                                <!-- <p><b>Level:</b> <?php echo $courses->course_level ?></p>
                                                                <p><b>Location:</b> <?php echo $courses->course_country ?></p> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class=" d-flex card shadow mb-4">
                                                        <!-- Card Header - Accordion -->
                                                        <a href="#collapseCard3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                                            <h6 class="m-0 font-weight-bold card-h-title">Requirements</h6>
                                                        </a>
                                                        <!-- Card Content - Collapse -->
                                                        <div class="collapse show" id="collapseCard3">
                                                            <div class="card-body">
                                                                <p style="white-space: pre-wrap; word-break: break-word;"><?php echo $courses->course_requirements ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <br>

                                        <?php } ?>
                                    <?php } else { ?>
                                        <h3>Records not found</h3>
                                    <?php } ?>
                                        </div>
                                </div>

                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->