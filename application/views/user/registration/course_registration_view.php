<!-- Jquery plugin -->
<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>


<!-- Page level custom scripts -->

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<link href="<?php echo base_url() ?>assets/css/forms.css" rel="stylesheet">


<body id="page-top" style='background-color:#f9f6f1;'>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid ">

                    <!-- Cards for registration -->
                    <div class="row justify-content-md-center pt-5" style='background-color:#f9f6f1;'>

                        <!-- Steps -->
                        <div class="col-xl-3">
                            <div class="card h-100 " id='card1'>
                                <div class="card-body" style="background-color:#DAE7E0">

                                    <div class="pl-3 pr-3 pt-4">
                                        <div class="pl-4" style="font-size:16px; font-weight:700; color:black;">Join Interactive Joint Education Employability System (EventHub) in</div>
                                        <div class="pt-2 pl-4 pb-3" style="font-size:38px; color:green; font-weight:900;">3 STEPS</div>

                                        <div class="pl-4">
                                            <div class="number pt-4 pl-4 pb-1" style="font-size:18px; color:green; font-weight:900;">01</div>
                                        </div>
                                        <div class="pl-4 pb-3" style="font-size:14px; color:black;">Select your role before you fill in your detail in the registration form.</div>

                                        <div class="pl-4">
                                            <div class="number pt-4 pl-4 pb-1" style="font-size:18px; color:green; font-weight:900;">02</div>
                                        </div>
                                        <div class="pl-4 pb-3" style="font-size:14px; color:black;">If you already have an existing account, login now with your credentials. </div>

                                        <div class="pl-4">
                                            <div class="number pt-4 pl-4 pb-1" style="font-size:18px; color:green; font-weight:900;">03</div>
                                        </div>
                                        <div class="pl-4 pb-5" style="font-size:14px; color:black;">After login, you are on the main page based on your role. </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 ">
                            <div class="card h-100" id='card2' ">
                                <div class=" card-body">
                                <center>
                                    <div class="pt-5 px-5" style="font-size:23px; letter-spacing: 8px; color:#787878; font-weight:700;">COURSE INFORMATIONFORM</div>
                                </center>

                                <!-- Form -->
                                <form method="post" action="<?= base_url('user/login/Auth/course'); ?>">
                                    <div class="form-row pt-4 px-3">
                                        <!-- Course Name -->
                                        <div class="form-group col-md-12 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="course_name" placeholder="Course Name" value="<?= set_value('course_name') ?>" required>
                                            <?= form_error('course_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>

                                        <!-- Course Area-->
                                        <div class="form-group col-md-6 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="course_area" placeholder="Course Area" required>
                                        </div>

                                        <!-- Course Level -->
                                        <div class="form-group col-md-6 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="course_level" placeholder="Course Level" required>
                                        </div>

                                        <!-- Course Duration-->
                                        <div class="form-group col-md-6 px-2">
                                            <input type="number" class="form-control border-bottom" style="border: 0;" name="course_duration" placeholder="Course Duration" required>
                                        </div>

                                        <!-- Course Fee-->
                                        <div class="form-group col-md-6 px-2">
                                            <input type="number" class="form-control border-bottom" style="border: 0;" name="course_fee" placeholder="Course Fee" required>
                                        </div>

                                        <!-- Course Short Profile -->
                                        <div class="form-group col-md-12 px-2">
                                            <textarea class="form-control border-bottom" style="border: 0;" name="course_shortprofile" placeholder="Course Short Profile" required></textarea>
                                        </div>

                                        <!-- Course Structure -->
                                        <div class="form-group col-md-12 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="course_structure" placeholder="Course Structure" required>
                                        </div>

                                        <!-- Course Requirement -->
                                        <div class="form-group col-md-12 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="course_requirements" placeholder="Course Requirements" required>
                                        </div>

                                        <!-- Course Career Opportunities-->
                                        <div class="form-group col-md-12 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="course_careeropportunities" placeholder="Course Career Opportunities-" required>
                                        </div>

                                        <!-- Course Intake-->
                                        <div class="form-group col-md-12 px-2">
                                            <select name="course_intake" id="course_intake" class="form-control form-select border-bottom" style="border: 0;" required>
                                                <option value="" selected disabled>Please select the course intake</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December </option>
                                            </select>
                                        </div>

                                        <!-- Term and Conditions & Register Button -->
                                        <div class="col">
                                            <button type="submit" class="btn btn-success mt-4" style="float:right; width:auto;">Continue <i class="fas fa-check"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <!-- End of Input fields (Form) -->

                            </div>
                        </div>
                    </div>

                </div>
                <!-- END OF ROW -->
                <!-- END OF FORM -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->