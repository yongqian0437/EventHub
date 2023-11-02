<link href="<?php echo base_url() ?>/assets/scss/events-styles.scss" rel="stylesheet">

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
                <div class="container-fluid" style="background-color:white;">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2 px-4">
                        <h1 class="h3 mb-0 text-gray-800 pt-4 font-weight-bold">Events</h1>
                    </div>
                    <div class="py-2 px-4" style="text-align: justify; font-weight:500;">Welcome to the Event Page! Here, you'll find all upcoming events on campus, from workshops to festivals and more. Easily register for events, connect with organizers, and leave feedback. Share events with friends, stay informed with event notifications, and even get involved in organizing future happenings. Let's make campus life unforgettable together!
                    </div>
                    <div class="px-4 pb-4">
                        <hr style=" width :100%; height:2px; background-color:#EAF4F4">
                    </div>
                    <div class="col-12 px-4">
                        <form method="post" name="filter" action="<?php echo base_url() . 'external/Events/event_filter' ?>">
                            <div class="row px-3">
                                <div class="form-group mr-2"><br>
                                    <label for="event_type">Event Type</label><br>
                                    <select name="event_typeid" id="filter_1" class="form-control form-select form-select-lg btn-sm">
                                        <option value="" selected disabled>Filter area</option>
                                        <?php
                                        foreach ($dropdown_area as $dropdown_data) {
                                            echo '<option value="' . $dropdown_data->event_type . '">' . $dropdown_data->event_type . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>



                                <div class="form-group mr-3"><br>
                                    <label for="event_fee">Event Fee</label><br>
                                    <select name="event_feeid" id="filter_5" class="form-control form-select form-select-lg btn-sm">
                                        <option value="" selected disabled>Sort fee</option>
                                        <option value="a">Low - High</option>
                                        <option value="d">High - Low</option>
                                    </select>
                                </div>
                                <div class="form-group align-self-end pull-right">
                                    <button class="button-custom-color">Search</button>
                                </div>
                            </div>
                        </form>

                        <?php if (!empty($event_data)) {
                            foreach ($event_data as $events) { ?>
                                <div class="card-body shadow mb-4" style="border-radius: 30px;">
                                    <div class="row">
                                        <div class="col-9 ">

                                            <div class="row justify-content-between">
                                                <h5 class="font-weight-bold ml-2 pl-1"><?php echo $events->event_name ?></h5>
                                            </div>
                                            <div>
                                                <p><i><?php echo $events->event_type ?></i></p>
                                                <p class="eventlist-short-desc"><?php echo $events->event_shortprofile ?></p>
                                            </div>
                                            <div>
                                                <!-- <h5>RM<?php echo $events->event_fee ?></h5> -->
                                                <h5><?php echo $events->event_country ?></h5>
                                            </div>
                                        </div>
                                        <div class=" col-3 mt-5 ">
                                            <?php if ($user_role == 'Student') { ?>
                                                <?php $response = $this->event_applicants_model->past_application($events->event_id, $user_email);
                                                if ($response == true) { ?>
                                                    <button type=" button" class="button-disabled float-right" disabled>Applied</button>
                                                <?php } else { ?>
                                                    <a href="<?php echo base_url() . 'external/Events/event_applicant/' . $events->event_id ?>" type=" button" class="button-custom-color float-right">Apply</a>
                                                <?php } ?>
                                                <a href="<?php echo base_url() . 'external/Events/view_event/' . $events->event_id ?>" class="button-custom-color float-right mr-1">View</a>

                                            <?php } else { ?>

                                                <!-- ***If Student is not logged in, 'Apply Now' button will redirect to Login page -->
                                                <a class="button-custom-color float-right" href="<?= base_url('user/login/Auth/login'); ?>">Apply</a>
                                                <a href="<?php echo base_url() . 'external/Events/view_event/' . $events->event_id ?>" class="button-custom-color float-right mr-1">View</a>

                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>

                            <?php } ?>

                        <?php } else { ?>

                            <h3 class="text-center mt-5">Records not found</h3>

                        <?php } ?>
                        <div class="pb-5"></div>
                        <div class="pb-5"></div>
                        <div class="pb-5"></div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
    </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->