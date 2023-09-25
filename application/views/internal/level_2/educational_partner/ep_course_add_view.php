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
                        <h1 class="h3 mb-0 text-gray-800">Add Event</h1>
                    </div>

                    <!-- Breadcrumn -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-9">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('internal/level_2/educational_partner/ep_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('internal/level_2/educational_partner/ep_courses'); ?>"></i>Events</a>
                                </li>
                                <li class="breadcrumb-item active">Add Event</li>
                            </ol>
                        </div>
                        <div class="col-xl-3">
                            <div class="d-flex justify-content-end">
                                <a type="button" href="<?= base_url('internal/level_2/educational_partner/ep_courses'); ?>" class="btn btn-primary">Back<i class="fas fa-undo pl-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Card-->
                            <div class="card ">
                                <div class="card-body">
                                    <form method="post" action=" <?= base_url('internal/level_2/educational_partner/ep_courses/submit_added_course/' . $university_data->uni_id); ?>">

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="course_name">Event Name</label>
                                                <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Enter course name" required>
                                            </div>
                                            <div class="form-group col-md-6 px-4 pl-5">
                                                <label for="event_type">Event Type</label>
                                                <select name="event_type" id="event_type" class="form-control form-select form-select" required>
                                                    <option value="Accounting &amp; Finance">Workshops and Seminars</option>
                                                    <option value="Actuarial Science">Actuarial Science</option>
                                                    <option value="Agriculture Science">Agriculture Science</option>
                                                    <option value="Architecture &amp; Building">Architecture &amp; Building</option>
                                                    <option value="Art &amp; Design">Art &amp; Design</option>
                                                    <option value="Audiology">Audiology</option>
                                                    <option value="Aviation, Aerospace &amp; Pilot">Aviation, Aerospace &amp; Pilot</option>
                                                    <option value="Biomedical science">Biomedical science</option>
                                                    <option value="Business">Business</option>
                                                    <option value="Culinary &amp; Patisserie">Culinary &amp; Patisserie</option>
                                                    <option value="Dentistry">Dentistry</option>
                                                    <option value="Design &amp; Visual Art">Design &amp; Visual Art</option>
                                                    <option value="Education &amp; Teaching">Education &amp; Teaching</option>
                                                    <option value="Engineering - Chemical">Engineering - Chemical</option>
                                                    <option value="Engineering - Civil">Engineering - Civil</option>
                                                    <option value="Engineering - Electrical">Engineering - Electrical</option>
                                                    <option value="Engineering - Mechanical">Engineering - Mechanical</option>
                                                    <option value="Engineering">Engineering</option>
                                                    <option value="English &amp; Modern Languages">English &amp; Modern Languages</option>
                                                    <option value="Environmental Science">Environmental Science</option>
                                                    <option value="Food Science">Food Sciences</option>
                                                    <option value="Health Sciences">Health Sciences</option>
                                                    <option value="Health Management">Health Management</option>
                                                    <option value="Health, Nursing and Midwifery">Health, Nursing and Midwifery</option>
                                                    <option value="Hospitality">Hospitality</option>
                                                    <option value="Computer &amp; Information Technology">Computer &amp; Information Technology</option>
                                                    <option value="Law">Law</option>
                                                    <option value="Mathematics">Mathematics</option>
                                                    <option value="Marketing">Marketing</option>
                                                    <option value="Mass Communication">Mass Communication</option>
                                                    <option value="Medical Imaging">Medical Imaging</option>
                                                    <option value="Medicine">Medicine</option>
                                                    <option value="Music">Music</option>
                                                    <option value="Nursing">Nursing</option>
                                                    <option value="Nutrition">Nutrition</option>
                                                    <option value="Occupational Therapy">Occupational Therapy</option>
                                                    <option value="Performing Arts">Performing Arts</option>
                                                    <option value="Pharmacy &amp; Pharmacology">Pharmacy &amp; Pharmacology</option>
                                                    <option value="Physiotherapy">Physiotherapy</option>
                                                    <option value="Psychology">Psychology</option>
                                                    <option value="Quantity &amp; Land Surveying">Quantity &amp; Land Surveying</option>
                                                    <option value="Science">Science</option>
                                                    <option value="Sociology &amp; Social Work">Sociology &amp; Social Work</option>
                                                    <option value="Speech Pathology">Speech Pathology</option>
                                                    <option value="Sport Science">Sport Science</option>
                                                    <option value="Veterinary Science">Veterinary Science</option>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="form-group col-md-6 px-4 pl-5">
                                            <label for="course_duration">Duration (Hours)</label>
                                            <div class="input-group-prepend">
                                                <input type="number" class="form-control" step="0.01" id="course_duration" name="course_duration" placeholder="Enter duration (eg: 1, 2.5)" required>
                                                <span class="input-group-text" id="basic-addon1">hours</span>
                                            </div>
                                        </div>
                                </div>


                                <div class="form-row pt-4">
                                    <div class="form-group col-md-6 px-4 pr-5">
                                        <label for="course_intake">Contact Information</label>
                                        <textarea type="text" class="form-control" rows="3" id="course_intake" name="course_intake" placeholder="Enter contact information (eg: 012-*******)" required></textarea>
                                        <div style="color:red; font-size:0.9em;">*Can enter more than 1 </div>
                                    </div>
                                    <div class="form-group col-md-6 px-4 pl-5">
                                        <label for="course_careeropportunities">Event Venue</label>
                                        <textarea type="text" class="form-control" rows="3" id="course_careeropportunities" name="course_careeropportunities" placeholder="Enter Event Venue (eg: Campus Hall 1)" required></textarea>
                                        <!-- <div style="color:red; font-size:0.9em;">*Example : Campus Hall 1</div> -->
                                    </div>
                                </div>

                                <div class="form-row pt-4">
                                    <div class="form-group col-md-6 px-4 pr-5 ">
                                        <label for="course_fee">Malaysian based Fee (RM)</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">RM</span>
                                            <input type="number" class="form-control" id="course_fee" name="course_fee" step="0.01" placeholder="Enter malaysian base fee" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4 px-2 ">
                                        <label for="course_usd_fee">International Fee (USD)</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                            <input type="number" class="form-control" id="course_usd_fee" name="course_usd_fee" step="0.01" placeholder="Enter international fee" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row pt-4">
                                    <div class="form-group col-md-12 px-4">
                                        <label for="course_shortprofile">Event Pictures</label>
                                        <textarea type="text" class="form-control" rows="8" id="course_shortprofile" name="course_shortprofile" placeholder="Insert Picture" required></textarea>
                                    </div>
                                </div>

                                <div class="form-row pt-4">
                                    <div class="form-group col-md-12 px-4">
                                        <label for="course_structure">Description</label>
                                        <textarea type="text" class="form-control" rows="8" id="course_structure" name="course_structure" placeholder="Description" required></textarea>
                                    </div>
                                </div>

                                <div class="form-row pt-4">
                                    <div class="form-group col-md-12 px-4">
                                        <label for="course_requirements">Requirements</label>
                                        <textarea type="text" class="form-control" rows="8" id="course_requirements" name="course_requirements" placeholder="Example:&#10;SPM: At least 5 credits&#10;A-Level: " required></textarea>
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