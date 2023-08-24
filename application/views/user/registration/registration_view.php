<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

<!-- Top Navigation -->
<?php $this->load->view('external/templates/topnav'); ?>

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
                    <div class="row justify-content-md-center pt-5 pb-5" style='background-color:#f9f6f1;'>

                        <!-- Steps -->
                        <div class="col-xl-3">
                            <div class="card h-100 " id='card1'>
                                <div class="card-body" style="background-color:#D9D9D9">

                                    <div class="pl-3 pr-3 pt-4">
                                        <div class="pl-4" style="font-size:16px; font-weight:700; color:black;">Join EventHub in</div>
                                        <div class="pt-2 pl-4 pb-3" style="font-size:38px; color:#61677A; font-weight:900;">3 STEPS</div>

                                        <div class="pl-4">
                                            <div class="number pt-4 pl-4 pb-1" style="font-size:18px; color:#61677A; font-weight:900;">01</div>
                                        </div>
                                        <div class="pl-4 pb-3" style="font-size:14px; color:black;">Select your role before you fill in your detail in the registration form.</div>

                                        <div class="pl-4">
                                            <div class="number pt-4 pl-4 pb-1" style="font-size:18px; color:#61677A; font-weight:900;">02</div>
                                        </div>
                                        <div class="pl-4 pb-3" style="font-size:14px; color:black;">If you already have an existing account, login now with your credentials. </div>

                                        <div class="pl-4">
                                            <div class="number pt-4 pl-4 pb-1" style="font-size:18px; color:#61677A; font-weight:900;">03</div>
                                        </div>
                                        <div class="pl-4 pb-5" style="font-size:14px; color:black;">After login, you are on the main page based on your role. </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Form -->
                        <div class="col-xl-6 ">
                            <div class="card h-100" id='card2' ">
                                <div class=" card-body">
                                <center>
                                    <div class="pt-5 px-5" style="font-size:23px; letter-spacing: 8px; color:#787878; font-weight:700;">ROLE REGISTRATION PAGE</div>
                                </center>
                                <!-- Input fields (Form) -->
                                <form class="user" method="post" action="<?= base_url('user/login/Auth/registration'); ?>">
                                    <!-- First and last name-->
                                    <div class="form-row pt-5 px-3">
                                        <div class="form-group col-md-6 px-2">
                                            <input type="type" name="user_fname" class="form-control border-bottom" id="user_fname" style="border: 0;" placeholder="Enter your first name" value="<?= set_value('user_fname') ?>" required>
                                            <?= form_error('user_fname', '<small class="text-danger pl-3">', '</small>'); ?>

                                        </div>
                                        <div class="form-group col-md-6 px-2">
                                            <input type="type" name="user_lname" class="form-control border-bottom" id="user_lname" style="border: 0;" placeholder="Enter your last name" value="<?= set_value('user_lname') ?>" required>
                                            <?= form_error('user_lname', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <!-- Email-->
                                    <div class="form-row pt-3 px-3">
                                        <div class="form-group col-md-12 px-2">
                                            <input type="email" name="user_email" class="form-control border-bottom" id="user_email" style="border: 0;" placeholder="Enter your email address" value="<?= set_value('user_email') ?>" required>
                                            <?= form_error('user_email', '<small class="text-danger pl-3">', '</small>'); ?>

                                        </div>
                                    </div>
                                    <!-- Password and confirm password -->
                                    <div class="form-row pt-3 px-3">
                                        <div class="form-group col-md-6 px-2">
                                            <input type="password" name="user_password" class="form-control border-bottom" id="password" style="border: 0;" placeholder="Enter your password" required>
                                            <?= form_error('user_password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group col-md-6 px-2">
                                            <input type="password" name="user_password2" class="form-control border-bottom" id="user_password2" style="border: 0;" placeholder="Confirm your password" required>
                                        </div>
                                    </div>
                                    <!-- Select your role -->
                                    <div class="form-row pt-3 px-3">
                                        <div class="form-group col-md-12 px-2">
                                            <select name="user_role" id="user_role" class="form-control form-select border-bottom" style="border: 0;" required>
                                                <option value="" selected disabled>Please select a role</option>
                                                <option value="Student">Student</option>
                                                <!-- <option value="Employer">Employer</option>
                                                <option value="Education Agent">Education Agent</option> -->
                                                <option value="Education Partner">Organizer</option>
                                                <!-- <option value="Academic Counsellor">Academic Counsellor</option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Submit button -->
                                    <div class="pt-4 pr-4">
                                        <button type="submit" class="btn btn-success" style="float:right; width:auto;">Continue <i class="fas fa-check"></i></button>
                                    </div>
                                </form>
                                <br><br>
                                <!-- End of Input fields (Form) -->
                                <center>
                                    <div class="pt-5 pb-4">
                                        <a style="text-align:center;" href="<?= base_url("user/login/Auth/forgotPassword"); ?>">Forget your password?</a>
                                    </div>
                                    <div class="pb-2">
                                        <a style="text-align:center;" href="<?= base_url("user/login/Auth/login"); ?>">Already have an account? Login!</a>
                                    </div>
                                </center>

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