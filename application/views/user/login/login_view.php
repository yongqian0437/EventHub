<!-- Jquery plugin -->
<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script>
//Js to remove alert message after university information is edited
setTimeout(function() {
    $('#alert_message').fadeOut();
}, 5000); // <-- time in milliseconds
</script>

<!-- Top Navigation -->
<?php $this->load->view('external/templates/topnav');?>

<body id="page-top" style='background-color:#f9f6f1;'>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Cards for registration -->
                    <div class="row justify-content-md-center pt-5 pb-5" style='background-color:#f9f6f1;'>

                        <!-- Steps -->
                        <div class="col-xl-3">
                            <div class="card h-100 " id='card1'>
                                <div class="card-body" style="background-color:#DAE7E0">

                                    <div class="pl-3 pr-3 pt-4">
                                        <div class="pl-4" style="font-size:16px; font-weight:700; color:black;">Join Interactive Joint Education Employability System (iJEES) in </div>
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

                        <!-- Form -->
                        <div class="col-xl-6 ">
                            <div class="card h-100" id='card2'>
                                <div class="card-body">
                                    <center>
                                        <div class="pt-5 px-5" style="font-size:23px; letter-spacing: 8px; color:#787878; font-weight:700;">LOGIN PAGE</div>
                                    </center>
                                    <?=$this->session->flashdata('message')?> 
                                    <!-- Input fields (Form) -->
                                    <form class="user" method="post" action=" <?=base_url('user/login/Auth/login'); ?>">
                                        <!-- Email-->
                                        <div class="form-row pt-5 px-3">
                                            <div class="form-group col-md-12 px-2">
                                                <input type="email" name="user_email" class="form-control border-bottom" id="email" style="border: 0;" placeholder="Enter your email address" value="<?=set_value('user_email');?>" required>
                                                <?= form_error('user_email','<small class="text-danger pl-3">','</small>');?>
                                            </div>
                                        </div>
                                        <!-- Password and confirm password -->
                                        <div class="form-row pt-3 pb-3 px-3">
                                            <div class="form-group col-md-12 px-2">
                                                <input type="password" name="user_password" class="form-control border-bottom" id="password" style="border: 0;" placeholder="Enter your password" required>
                                                <?= form_error('user_password','<small class="text-danger pl-3">','</small>');?>
                                            </div>
                                        </div>
                                        <!-- Submit button -->
                                        <div class="pt-1 pr-4">
                                            <button type="submit" class="btn btn-success" style="float:right; width:23%;">Login <i class="fas fa-check"></i></button>
                                        </div>
                                        <br>
                                        <br>
                                    </form>
                                    <!-- End of Input fields (Form) -->
                                    <center>
                                    <div class="pt-5 pb-3">
                                        <a class="mt-5" style="text-align:center;" href="<?=base_url("user/login/Auth/forgotPassword"); ?>">Forget your password?</a>
                                    </div>
                                        <a class="" style="text-align:center;" href="<?= base_url('user/login/Auth/registration');?>">Register an account</a>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <!-- End for registration -->

                    </div>
                    <!-- END OF ROW -->
                    <!-- END OF FORM -->

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
