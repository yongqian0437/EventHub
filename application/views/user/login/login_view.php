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
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");



    .wrapper {
        background: #ececec;
        padding: 0 20px 0 20px;
    }

    .main {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .side-image {
        background-image: url(<?php echo base_url("assets/img/unievent.jpg"); ?>);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        border-radius: 10px 0 0 10px;
        position: relative;
    }

    .row {
        width: 900px;
        height: 550px;
        border-radius: 10px;
        background: #fff;
        padding: 0px;
        box-shadow: 5px 5px 10px 1px rgba(0, 0, 0, 0.2);
    }

    .text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-family: "Poppins", sans-serif;
        font-size: 24px;
        /* Adjust the value to set the desired font size */
        font-weight: bold;
    }

    .text p {
        color: #fff;
        font-size: 20px;
    }

    i {
        font-weight: 400;
        font-size: 15px;
    }

    .right {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .input-box {
        width: 330px;
        box-sizing: border-box;
    }

    /* img {
        width: 35px;
        position: absolute;
        top: 30px;
        left: 30px;
    } */

    .input-box header {
        font-weight: 700;
        text-align: center;
        margin-bottom: 45px;
    }

    .input-field {
        display: flex;
        flex-direction: column;
        position: relative;
        padding: 0 10px 0 10px;
    }

    .input {
        height: 45px;
        width: 100%;
        background: transparent;
        border: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        outline: none;
        margin-bottom: 20px;
        color: #40414a;
    }

    .input-box .input-field label {
        position: absolute;
        top: 10px;
        left: 10px;
        pointer-events: none;
        transition: 0.5s;
    }

    .input-field input:focus~label {
        top: -10px;
        font-size: 13px;
    }

    .input-field input:valid~label {
        top: -10px;
        font-size: 13px;
        color: #5d5076;
    }

    .input-field .input:focus,
    .input-field .input:valid {
        border-bottom: 1px solid #743ae1;
    }

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

    .signin {
        text-align: center;
        font-size: small;
        margin-top: 25px;
    }

    span a {
        text-decoration: none;
        font-weight: 700;
        color: #000;
        transition: 0.5s;
    }

    span a:hover {
        text-decoration: underline;
        color: #000;
    }

    @media only screen and (max-width: 768px) {
        .side-image {
            border-radius: 10px 10px 0 0;
        }

        .side-image {
            width: 35px;
            position: absolute;
            top: 20px;
            left: 47%;
        }

        .text {
            position: absolute;
            top: 70%;

        }

        .text p,
        i {
            font-size: 18px;
        }

        .row {
            max-width: 420px;
            width: 100%;
        }
    }
</style>

<!-- Top Navigation -->
<?php $this->load->view('external/templates/topnav'); ?>

<body id="page-top" style='background-color:#f9f6f1;'>

    <!-- Page Wrapper -->
    <div class="wrapper">

        <!-- Content Wrapper -->
        <div class="container main">

            <!-- Main Content -->
            <div class="row">

                <!-- image -->
                <div class="col-md-6 side-image">
                    <img src="assets/img/white.png" alt="" />
                    <div class="text">
                        <p>Campus Event Management System <i>- EventHub</i></p>
                    </div>
                </div>


                <!-- Form -->
                <div class="col-md-6 right">
                    <div class="input-box">
                        <center>
                            <div class="pt-5 px-5" style="font-size:23px; letter-spacing: 8px; color:#000000; font-weight:800;">LOGIN PAGE</div>
                        </center>
                        <?= $this->session->flashdata('message') ?>
                        <!-- Input fields (Form) -->
                        <form class="user" method="post" action=" <?= base_url('user/login/Auth/login'); ?>">
                            <!-- Email-->
                            <div class="form-row pt-5 px-3">
                                <div class="form-group col-md-12 px-2">
                                    <input type="email" name="user_email" class="form-control border-bottom" id="email" style="border: 0;" placeholder="Enter your email address" value="<?= set_value('user_email'); ?>" required>
                                    <?= form_error('user_email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <!-- Password and confirm password -->
                            <div class="form-row pt-3 pb-3 px-3">
                                <div class="form-group col-md-12 px-2">
                                    <input type="password" name="user_password" class="form-control border-bottom" id="password" style="border: 0;" placeholder="Enter your password" required>
                                    <?= form_error('user_password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <!-- Submit button -->
                            <div class="pt-1 pr-4">
                                <button type="submit" class="submit" style="float:right;">Login <i class="fas fa-check"></i></button>
                            </div>
                            <br>
                            <br>
                        </form>
                        <!-- End of Input fields (Form) -->
                        <center>
                            <div class="pt-5 pb-3">
                                <a class="mt-5" style="text-align:center;" href="<?= base_url("user/login/Auth/forgotPassword"); ?>">Forget your password?</a>
                            </div>
                            <a class="" style="text-align:center;" href="<?= base_url('user/login/Auth/registration'); ?>">Register an account</a>
                        </center>
                    </div>

                </div>
                <!-- End for registration -->


                <!-- END OF ROW -->
                <!-- END OF FORM -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <!-- <?php
                if ($this->session->flashdata('register_success')) {
                ?>
            <script>
                Swal.fire({
                    title: 'Your account has been registered.',
                    icon: 'success',
                })
            </script>
        <?php
                }
        ?> -->