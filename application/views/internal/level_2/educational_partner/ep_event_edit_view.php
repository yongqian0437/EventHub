<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>

<style>
    label {
        color: black;
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Event</h1>
                    </div>

                    <!-- Breadcrumn -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-9">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('internal/level_2/educational_partner/ep_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('internal/level_2/educational_partner/ep_events'); ?>"></i>Events</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Event</li>
                            </ol>
                        </div>
                        <div class="col-xl-3">
                            <div class="d-flex justify-content-end">
                                <a type="button" href="<?= base_url('internal/level_2/educational_partner/ep_events'); ?>" class="btn btn-primary">Back<i class="fas fa-undo pl-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Card-->
                            <div class="card ">
                                <div class="card-body">
                                    <form method="post" action=" <?= base_url('internal/level_2/educational_partner/ep_events/submit_edit_event/' . $event_data->event_id); ?>">

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="event_name">Event Name</label>
                                                <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Enter event name" value="<?= $event_data->event_name ?>" required>
                                            </div>
                                            <div class="form-group col-md-6 px-4 pl-5">
                                                <label for="event_type">Event Type</label>
                                                <select name="event_type" id="event_type" class="form-control form-select form-select" required>
                                                    <option value="<?= $event_data->event_type ?>" selected><?= $event_data->event_type ?></option>
                                                    <option value="Accounting &amp; Finance">Workshops and Seminars</option>
                                                    <option value="Actuarial Science">Actuarial Science</option>
                                                    <option value="Sports Tournaments and Competitions">Sports Tournaments and Competitions</option>
                                                    <option value="Orientation and Welcome Events">Orientation and Welcome Events</option>
                                                    <option value="Alumni Events">Alumni Events</option>
                                                    <option value="Career Fairs and Networking Events">Career Fairs and Networking Events</option>
                                                    <option value="Community Service and Volunteer Events">Community Service and Volunteer Events</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <!-- <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="event_level">Level</label>
                                                <select name="event_level" id="event_level" class="form-control form-select form-select" required>
                                                    <option value="<?= $event_data->event_level ?>" selected><?= $event_data->event_level ?></option>
                                                    <option value="Foundation">Foundation</option>
                                                    <option value="Certificate">Certificate</option>
                                                    <option value="Diploma">Diploma</option>
                                                    <option value="Bachelor Degree">Bachelor Degree</option>
                                                    <option value="Masters">Masters</option>
                                                    <option value="Doctorate">Doctorate</option>
                                                    <option value="Advanced Diploma">Advanced Diploma</option>
                                                    <option value="Graduate Certificate and Graduate Diploma">Graduate Certificate and Graduate Diploma</option>
                                                    <option value="Postgraduate Certificate and Postgraduate Diploma">Postgraduate Certificate and Postgraduate Diploma</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div> -->
                                            <div class="form-group col-md-6 px-4 pr-5 ">
                                                <label for="event_fee">Malaysian based Fee (RM)</label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">RM</span>
                                                    <input type="number" class="form-control" id="event_fee" name="event_fee" step="0.01" placeholder="Enter malaysian base fee" required>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6 px-4 pl-5">
                                                <label for="event_duration">Duration (Hours)</label>
                                                <div class="input-group-prepend">
                                                    <input type="number" class="form-control" step="0.01" id="event_duration" name="event_duration" placeholder="Enter duration (eg: 1, 2.5)" required>
                                                    <span class="input-group-text" id="basic-addon1">hours</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="event_intake">Contact Information</label>
                                                <textarea type="number" class="form-control" rows="3" id="event_intake" name="event_intake" placeholder="Enter intake (eg: February, June, July)" required><?= $event_data->event_intake ?></textarea>
                                                <div style="color:red; font-size:0.9em;">*Can enter more than 1 </div>
                                            </div>
                                            <div class="form-group col-md-6 px-4 pl-5">
                                                <label for="event_careeropportunities">Event Venue</label>
                                                <textarea type="text" class="form-control" rows="3" id="event_careeropportunities" name="event_careeropportunities" placeholder="Enter Event Venue (eg: Campus Hall 1)" required></textarea>
                                                <!-- <div style="color:red; font-size:0.9em;">*Example : Campus Hall 1</div> -->
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <!-- <div class="form-group col-md-4 px-4 ">
                                                <label for="event_fee">Fee (RM)</label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">RM</span>
                                                    <input type="number" class="form-control" id="event_fee" name="event_fee" placeholder="Enter fee" step="0.01" value="<?= $event_data->event_fee ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4 px-2 ">
                                                <label for="event_usd_fee">International Fee (USD)</label>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon2">$</span>
                                                    <input type="number" class="form-control" id="event_usd_fee" name="event_usd_fee" step="0.01" placeholder="Enter international fee" value="<?= $event_data->event_usd_fee ?>" required>
                                                </div>
                                            </div> -->

                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-12 px-4">
                                                <label for="event_shortprofile">Event Pictures</label>
                                                <textarea type="text" class="form-control" rows="8" id="event_shortprofile" name="event_shortprofile" placeholder="Enter shortprofile" required><?= $event_data->event_shortprofile ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-12 px-4">
                                                <label for="event_structure">Description</label>
                                                <textarea type="text" class="form-control" rows="8" id="event_structure" name="event_structure" placeholder="Example:&#10;Year 1: .........&#10;Year 2: .........&#10;Year 3: ........." required><?= $event_data->event_structure ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-12 px-4">
                                                <label for="event_requirements">Requirements</label>
                                                <textarea type="text" class="form-control" rows="8" id="event_requirements" name="event_requirements" placeholder="Example:&#10;SPM: At least 5 credits&#10;A-Level: " required><?= $event_data->event_requirements ?></textarea>
                                            </div>
                                        </div>

                                        <!-- Edit button -->
                                        <div class="pr-4">
                                            <button type="submit" class="btn btn-primary " style="float:right;">Submit<i class="fas fa-check pl-2"></i></button>
                                        </div>

                                    </form>

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