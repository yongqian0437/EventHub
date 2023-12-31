<!-- Jquery plugin -->
<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>


<!-- Page level custom scripts -->

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

<style>
    .submit {
        border: none;
        outline: none;
        height: 45px;
        background: #ececec;
        border-radius: 5px;
        transition: 0.4s;
    }

    .submit:hover {
        background: rgba(37, 95, 156, 0.937);
        color: #fff;
    }
</style>
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
                                        <div class="pl-4" style="font-size:16px; font-weight:700; color:black;">Join Campus Event Management System (EventHub) in</div>
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
                                    <div class="pt-5 px-5" style="font-size:23px; letter-spacing: 8px; color:#000000; font-weight:700;">Event INFORMATION FORM</div>
                                </center>

                                <!-- Form -->
                                <form method="post" action="<?= base_url('user/login/Auth/event'); ?>">
                                    <div class="form-row pt-4 px-3">
                                        <!-- event Name -->
                                        <div class="form-group col-md-12 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="event_name" placeholder="event Name" value="<?= set_value('event_name') ?>" required>
                                            <?= form_error('event_name', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>

                                        <!-- event Area-->
                                        <div class="form-group col-md-6 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="event_type" placeholder="event Area" required>
                                        </div>

                                        <!-- event Level -->
                                        <div class="form-group col-md-6 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="event_level" placeholder="event Level" required>
                                        </div>

                                        <!-- event Duration-->
                                        <div class="form-group col-md-6 px-2">
                                            <input type="number" class="form-control border-bottom" style="border: 0;" name="event_duration" placeholder="event Duration" required>
                                        </div>

                                        <!-- event Fee-->
                                        <div class="form-group col-md-6 px-2">
                                            <input type="number" class="form-control border-bottom" style="border: 0;" name="event_fee" placeholder="event Fee" required>
                                        </div>

                                        <!-- event Short Profile -->
                                        <div class="form-group col-md-12 px-2">
                                            <textarea class="form-control border-bottom" style="border: 0;" name="event_shortprofile" placeholder="event Short Profile" required></textarea>
                                        </div>

                                        <!-- event Structure -->
                                        <div class="form-group col-md-12 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="event_structure" placeholder="event Structure" required>
                                        </div>

                                        <!-- event Requirement -->
                                        <div class="form-group col-md-12 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="event_requirements" placeholder="event Requirements" required>
                                        </div>

                                        <!-- event Career Opportunities-->
                                        <div class="form-group col-md-12 px-2">
                                            <input type="text" class="form-control border-bottom" style="border: 0;" name="event_careeropportunities" placeholder="event Career Opportunities-" required>
                                        </div>

                                        <!-- event Intake-->
                                        <div class="form-group col-md-12 px-2">
                                            <select name="event_intake" id="event_intake" class="form-control form-select border-bottom" style="border: 0;" required>
                                                <option value="" selected disabled>Please select the event intake</option>
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
                                        <div class="pt-1 pr-4">
                                            <button type="submit" class="submit" style="float:right;">Continue<i class="fas fa-check"></i></button>
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