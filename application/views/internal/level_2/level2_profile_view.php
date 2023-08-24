<style>
    img {
        height: 26vh;
        width: 26vh;
    }

    h6 {
        font-weight: 700;
        color: black;
    }

    label {
        color: black;
    }
</style>

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

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
                        <h1 class="h3 mb-0 text-gray-800 pt-4 font-weight-bold">My Profile</h1>
                    </div>

                    <div class="px-4 pb-4">
                        <hr style=" width :100%; height:2px; background-color:#EAF4F4">
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4" style="background-color: #dbe7e4; border:.5px solid #8367c7;">
                                <!-- 5abcb9 -->
                                <img class="d-flex mx-auto mt-3 mb-4" src="<?= base_url('assets/img/chat_user/profile_pic.png'); ?>" />
                                <div class="ml-5">
                                    <h6>Name:</h6>
                                    <label> <?= $user_data['user_fname'] ?> <?= $user_data['user_lname'] ?></label>
                                </div>
                                <div class="ml-5">
                                    <h6>Email Address:</h6>
                                    <label><?= $user_data['user_email'] ?></label>
                                </div>
                                <div class="ml-5 mb-4">
                                    <h6>Role:</h6>
                                    <label><?= $user_data['user_role'] ?></label>
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="card border-left-info shadow h-100 ">
                                            <ul class="nav justify-content-end">
                                                <li class="nav-item">
                                                    <div class="card-title">
                                                        <a title="Edit my information" style="color:black;" class="nav-link" id="edit_tab" onclick="edit_tab()" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">
                                                            <span class="icon">
                                                                <i style="font-size:20px;" class="fas fa-user-edit"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="card-body shadow">
                                                <div class="row">
                                                    <?php
                                                    if ($user_role == 'Employer') { ?>
                                                        <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                            <h6>Company:</h6>
                                                            <label>
                                                                <?php echo $e_data['c_name']; ?>
                                                            </label>
                                                        </div>

                                                    <?php
                                                    } else if ($user_role == 'Education Partner' or $user_role == 'Academic Counsellor') { ?>
                                                        <div class="col-8 col-md-6 col-lg-6 mb-2">

                                                            <h6>University</h6>
                                                            <label>
                                                                <?php
                                                                if ($user_role == 'Education Partner') {
                                                                    echo $ep_data['uni_name'];
                                                                } else if ($user_role == 'Academic Counsellor') {
                                                                    echo $ac_data['ac_university'];
                                                                }
                                                                ?>
                                                            </label>
                                                        </div>

                                                    <?php } ?>

                                                    <?php
                                                    if ($user_role == 'Employer' or $user_role == 'Education Partner') { ?>
                                                        <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                            <h6>Job Title:</h6>
                                                            <label>
                                                                <?php
                                                                if ($user_role == 'Employer') {
                                                                    echo $e_data['e_jobtitle'];
                                                                } else if ($user_role == 'Education Partner') {
                                                                    echo $ep_data['ep_jobtitle'];
                                                                }
                                                                ?>
                                                            </label>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6>Business Email:</h6>
                                                        <label>
                                                            <?php
                                                            if ($user_role == 'Academic Counsellor') {
                                                                echo $ac_data['ac_businessemail'];
                                                            } else if ($user_role == 'Employer') {
                                                                echo $e_data['e_businessemail'];
                                                            } else if ($user_role == 'Education Agent') {
                                                                echo $ea_data['ea_businessemail'];
                                                            } else if ($user_role == 'Education Partner') {
                                                                echo $ep_data['ep_businessemail'];
                                                            }
                                                            ?>
                                                        </label>
                                                    </div>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6>Contact No:</h6>
                                                        <label>
                                                            <?php
                                                            if ($user_role == 'Academic Counsellor') {
                                                                echo $ac_data['ac_phonenumber'];
                                                            } else if ($user_role == 'Employer') {
                                                                echo $e_data['e_phonenumber'];
                                                            } else if ($user_role == 'Education Agent') {
                                                                echo $ea_data['ea_phonenumber'];
                                                            } else if ($user_role == 'Education Partner') {
                                                                echo $ep_data['ep_phonenumber'];
                                                            }
                                                            ?>
                                                        </label>
                                                    </div>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6>Country:</h6>
                                                        <label>
                                                            <?php
                                                            if ($user_role == 'Academic Counsellor') {
                                                                echo $ac_data['ac_nationality'];
                                                            } else if ($user_role == 'Employer') {
                                                                echo $e_data['e_nationality'];
                                                            } else if ($user_role == 'Education Agent') {
                                                                echo $ea_data['ea_nationality'];
                                                            } else if ($user_role == 'Education Partner') {
                                                                echo $ep_data['ep_nationality'];
                                                            }
                                                            ?>
                                                        </label>
                                                    </div>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6>Gender:</h6>
                                                        <label>
                                                            <?php
                                                            if ($user_role == 'Academic Counsellor') {
                                                                echo $ac_data['ac_gender'];
                                                            } else if ($user_role == 'Employer') {
                                                                echo $e_data['e_gender'];
                                                            } else if ($user_role == 'Education Agent') {
                                                                echo $ea_data['ea_gender'];
                                                            } else if ($user_role == 'Education Partner') {
                                                                echo $ep_data['ep_gender'];
                                                            }
                                                            ?>
                                                        </label>
                                                    </div>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6>Date of Birth:</h6>
                                                        <label>
                                                            <?php
                                                            if ($user_role == 'Academic Counsellor') {
                                                                echo $ac_data['ac_dob'];
                                                            } else if ($user_role == 'Employer') {
                                                                echo $e_data['e_dob'];
                                                            } else if ($user_role == 'Education Agent') {
                                                                echo $ea_data['ea_dob'];
                                                            } else if ($user_role == 'Education Partner') {
                                                                echo $ep_data['ep_dob'];
                                                            }
                                                            ?>
                                                        </label>
                                                    </div>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6>Document:</h6>
                                                        <label>
                                                            <?php
                                                            if ($user_role == 'Academic Counsellor') { ?>
                                                                <a style="white-space: pre-wrap; word-break: break-word;" href="<?= base_url('assets/uploads/academic_counsellor/' . $ac_data['ac_document']) ?>" target="_blank"><?= $ac_data['ac_document'] ?></a>
                                                            <?php
                                                            } else if ($user_role == 'Employer') { ?>
                                                                <a style="white-space: pre-wrap; word-break: break-word;" href="<?= base_url('assets/uploads/employer/' . $e_data['e_document']) ?>" target="_blank"><?= $e_data['e_document'] ?></a>
                                                            <?php
                                                            } else if ($user_role == 'Education Agent') { ?>
                                                                <a style="white-space: pre-wrap; word-break: break-word;" href="<?= base_url('assets/uploads/education_agents/' . $ea_data['ea_document']) ?>" target="_blank"><?= $ea_data['ea_document'] ?></a>
                                                            <?php
                                                            } else if ($user_role == 'Education Partner') { ?>
                                                                <a style="white-space: pre-wrap; word-break: break-word;" href="<?= base_url('assets/uploads/education_partner/' . $ep_data['ep_document']) ?>" target="_blank"><?= $ep_data['ep_document'] ?></a>
                                                            <?php
                                                            }
                                                            ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="edit">
                                        <div class="card border-left-info shadow h-100 ">
                                            <div class="card-body shadow">
                                                <form method="post" name="edit_profile" action="<?php echo base_url() . 'internal/level_2/level_2_profile/edit_profile' ?>">
                                                    <div class="row">
                                                        <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Business Email address</label>
                                                                <input type="email" name="business_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value=" <?php
                                                                                                                                                                                            if ($user_role == 'Academic Counsellor') {
                                                                                                                                                                                                echo $ac_data['ac_businessemail'];
                                                                                                                                                                                            } else if ($user_role == 'Employer') {
                                                                                                                                                                                                echo $e_data['e_businessemail'];
                                                                                                                                                                                            } else if ($user_role == 'Education Agent') {
                                                                                                                                                                                                echo $ea_data['ea_businessemail'];
                                                                                                                                                                                            } else if ($user_role == 'Education Partner') {
                                                                                                                                                                                                echo $ep_data['ep_businessemail'];
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>" placeholder="Enter your business email address" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                            <div class="form-group">
                                                                <label>Phone Number</label>
                                                                <input type="number" name="phonenumber" class="form-control" id="contactNo" value="<?php
                                                                                                                                                    if ($user_role == 'Academic Counsellor') {
                                                                                                                                                        echo $ac_data['ac_phonenumber'];
                                                                                                                                                    } else if ($user_role == 'Employer') {
                                                                                                                                                        echo $e_data['e_phonenumber'];
                                                                                                                                                    } else if ($user_role == 'Education Agent') {
                                                                                                                                                        echo $ea_data['ea_phonenumber'];
                                                                                                                                                    } else if ($user_role == 'Education Partner') {
                                                                                                                                                        echo $ep_data['ep_phonenumber'];
                                                                                                                                                    }
                                                                                                                                                    ?>" placeholder="Enter your phone number" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <a href="<?= base_url('internal/level_2/level_2_profile'); ?>" class="btn btn-danger">Cancel</a>
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
              <!-- Pop up after user edit profile information-->
              <?php if ($this->session->flashdata('edit_message')) { ?>
                <script>
                    swal({
                            title: 'Profile successfully edited!',
                            icon:  'success',
                            button: "OK",
                        });
                </script>
            <?php } ?>