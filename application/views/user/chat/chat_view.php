<!-- Top Navigation -->
<?php if ($user_role == 'Student') {
    $this->load->view('external/templates/topnav');
} ?>

<body id="page-top">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="main_content" style="background-color: #fafafa">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <?php if ($user_role != 'Student') { ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 px-4">
                        <h1 class="h3 mb-0 text-gray-800">Chat Room</h1>
                    </div>

                    <!-- Breadcrumb -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-9">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <?php if ($user_role == 'Academic Counsellor') { ?>
                                        <a href="<?= base_url('internal/level_2/Academic_counsellor/Ac_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                    <?php } else { ?>
                                        <a href="<?= base_url('internal/level_2/employer/Employer_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                    <?php   } ?>
                                </li>
                                <li class="breadcrumb-item active">Chat Room</li>
                            </ol>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($user_role == 'Student') { ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2 pt-4 px-4">
                        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Chat Room</h1>
                    </div>

                    <p class="mb-4 px-4">
                        iJEES' Chat Room makes it easy for you to connect with Academic Counsellors and Employers that are registered in iJEES anywhere, anytime. This section is a one-stop service for communication to take place.
                        The Academic Counsellors and Employers listed here are always ready to answer your enquiries towards a university, course or employer project (EP) that you may have. <br><br>

                        To begin chatting, follow these simple steps:<br><br>
                        1. Scroll down and View 'All Contacts'<br>
                        2. A list of Academic Counsellors and Employers, along with their details will be displayed<br>
                        3. You may search for a user according to the University or Company name<br>
                        4. Once you have found who you are looking for, click 'Chat'</p>

                    <p class="mt-4 px-4 font-weight-bold"><i>*As stated in iJEES' Terms and Conditions, communication that takes place here will be monitored, and any exhange of documents are of consent.</i></p>

                    <div class="px-4 pb-3">
                        <hr style=" width :100%; height:2px; background-color:#EAF4F4">
                    </div>

                <?php } ?>

                <!-- Content Row -->
                <div class="row px-4">

                    <!-- FIRST CARD -->
                    <div class="col-xl-12 col-lg-12" id="chat_section">
                        <div class="card mb-4">

                            <!-- Card Header -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #dbe7e4">
                                <h6 class="m-0 font-weight-bold" id="receiver_name" style="color: #595959">Select someone to chat</h6>
                                <!--<php echo $chat_title; ?>-->
                                <!-- <span title="Clear Chat" class="clear_chat"><i class="fas fa-trash"></i></span> -->
                            </div>

                            <!-- Card Body -->
                            <div class="card-body" style="height: 400px">
                                <!-- Direct Chat-->
                                <div class="direct-chat direct-chat-primary">

                                    <!--Conversations are loaded here-->
                                    <div class="direct-chat-messages" id="content" style="height: 290px">
                                        <div id="dump_content"></div>
                                    </div>

                                    <hr>

                                    <!--<form action="#" method="post">-->
                                    <div class="input-group">
                                        <?php
                                        $obj = &get_instance();
                                        $obj->load->model('user_model');
                                        $user = $obj->user_model->get_user_data(); // check in model
                                        // var_dump($user);
                                        // die;
                                        ?>

                                        <input type="hidden" id="sender_name" value="<?= $user['user_fname'] ?>">
                                        <input type="hidden" id="sender_pic" value="<?= $profile_pic; ?>">

                                        <input type="hidden" id="receiver_id">

                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Type Message..." aria-label="Search" aria-describedby="basic-addon2" name="message" id="message">

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-success btn-flat btn_send" id="nav_down">Send</button>
                                            <div class="fileDiv btn btn-info btn-flat"><i class="fa fa-upload"></i>
                                                <input type="file" name="file" class="upload_attachment" />
                                            </div>
                                        </span>
                                    </div>
                                    <!--</form>-->

                                </div>
                                <!-- /.direct-chat-->
                                <!--direct chat ends-->

                            </div>
                            <!--card-body end is above me-->

                        </div>
                    </div>
                    <!--chat section ends-->
                </div>

                <div class="row px-4">
                    <!-- SECOND CARD -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card mb-4">

                            <!-- Card Header - Accordion -->
                            <a href="#collapse_card" class="d-block card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse_card" style="background-color: #dbe7e4">
                                <h6 class="m-0 font-weight-bold" style="color: #595959">All Contacts</h6>
                                <span>&nbsp</span>
                                <div class="justify-content-end">
                                    <!-- Display number of users on top. Ex: ~2 Students~ ~3 Employers~ -->
                                    <span class="label label-danger font-weight-bold" style="background-color: #57cc99; color: #FFFFFF; padding: 5px"><?php if ($this->session->userdata['user_role'] == 'Student') {
                                                                                                                                                            echo count($userslist) . ' ';
                                                                                                                                                            echo $sub_title; ?> </span>
                                    <span>&nbsp</span>
                                    <span class="label label-danger font-weight-bold" style="background-color: #00afb9; color: #FFFFFF; padding: 5px"><?php echo count($userslist2) . ' ';
                                                                                                                                                            echo $sub_title2;
                                                                                                                                                        } else {
                                                                                                                                                            echo count($userslist) . ' ';
                                                                                                                                                            echo $sub_title;
                                                                                                                                                        } ?>
                                    </span>
                                </div>
                            </a>

                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapse_card">
                                <div class="card-body">

                                    <!-- Display different table with different columns if user logged in is a Student -->
                                    <?php if ($this->session->userdata['user_role'] == 'Student') { ?>

                                        <!-- ACADEMIC COUNSELLORS CARD -->
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="card mb-4">

                                                    <a href="#collapse_ac_card" class="d-block card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapse_card" style="background-color: #57cc99">
                                                        <h6 class="m-0 font-weight-bold" style="color: #FFF">Academic Counsellors</h6>
                                                    </a>

                                                    <div class="collapse show" id="collapse_ac_card">
                                                        <div class="card-body">
                                                            <!-- ACADEMIC COUNSELLORS TABLE -->
                                                            <div class="table-reponsive col-12">
                                                                <table class="table table-bordered dt-bootstrap4 chat_table">

                                                                    <?php
                                                                    echo "<thead style='background-color: #57cc99'>";
                                                                    echo    "<tr>";
                                                                    echo        "<th style='color: #FFFFFF;'>Chat</th>";
                                                                    echo        "<th style='color: #FFFFFF;'>Logo</th>";
                                                                    echo        "<th style='color: #FFFFFF;'>University</th>";
                                                                    echo        "<th style='color: #FFFFFF;'>Country</th>";
                                                                    echo        "<th style='color: #FFFFFF;'>First Name</th>";
                                                                    echo        "<th style='color: #FFFFFF;'>Last Name</th>";
                                                                    echo    "</tr>";
                                                                    echo "</thead>";
                                                                    ?>

                                                                    <tbody>
                                                                        <?php if (!empty($userslist)) {
                                                                            foreach ($userslist as $user) : ?>
                                                                                <tr style='background-color: #f0faf6' class="font-weight-bold">
                                                                                    <td class="select_user" id="<?php echo $user['user_id']; ?>" title="<?php echo $user['ac_university'] . ', ' . $user['user_fname'] . ' ' . $user['user_lname'];  ?>">
                                                                                        <a href="#chat_section" style="display:block; background-color: #5e6472; color:white; text-align: center; font-weight: 700;">Chat</a>
                                                                                    </td>
                                                                                    <td>
                                                                                        <img class="img-fluid img_class" src="<?= base_url("assets/img/universities/{$user['uni_logo']}"); ?>" id="uni_logo" ; />
                                                                                    </td>
                                                                                    <td class="font-weight-bold"><?php echo $user['ac_university']; ?></td>
                                                                                    <td><?php echo $user['uni_country']; ?></td>
                                                                                    <td><?php echo $user['user_fname']; ?></td>
                                                                                    <td><?php echo $user['user_lname']; ?></td>

                                                                                </tr>
                                                                        <?php endforeach;
                                                                        } ?>
                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                            <!-- ./table-responsive -->
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- card mb-4 -->
                                            </div>
                                        </div>

                                        <!-- EMPLOYERS CARD -->
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12">
                                                <div class="card mb-4">

                                                    <a href="#collapse_e_card" class="d-block card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapse_card" style="background-color: #00afb9">
                                                        <h6 class="m-0 font-weight-bold" style="color: #FFF">Employers</h6>
                                                    </a>

                                                    <div class="collapse show" id="collapse_e_card">
                                                        <div class="card-body">
                                                            <!-- EMPLOYERS TABLE -->
                                                            <div class="table-reponsive col-12">
                                                                <table class="table table-bordered dt-bootstrap4 chat_table">

                                                                    <?php
                                                                    echo "<thead style='background-color: #00afb9'>";
                                                                    echo    "<tr>";
                                                                    echo        "<th style='color: #FFFFFF;'>Chat</th>";
                                                                    echo        "<th style='color: #FFFFFF;'>Logo</th>";
                                                                    echo        "<th style='color: #FFFFFF;'>Company</th>";
                                                                    echo        "<th style='color: #FFFFFF;'>Country</th>";
                                                                    echo        "<th style='color: #FFFFFF;'>First Name</th>";
                                                                    echo        "<th style='color: #FFFFFF;'>Last Name</th>";
                                                                    echo        "<th style='color: #FFFFFF;'>Job Title</th>";
                                                                    echo    "</tr>";
                                                                    echo "</thead>";
                                                                    ?>

                                                                    <tbody>
                                                                        <?php if (!empty($userslist2)) {
                                                                            foreach ($userslist2 as $user2) : ?>
                                                                                <tr style='background-color: #ebf9fa' class="font-weight-bold">
                                                                                    <td class="select_user" id="<?php echo $user2['user_id']; ?>" title="<?php echo $user2['c_name'] . ', ' . $user2['user_fname'] . ' ' . $user2['user_lname'];  ?>">
                                                                                        <a href="#chat_section" style="display:block; background-color: #5e6472; color:white; text-align: center; font-weight: 700;">Chat</a>
                                                                                    </td>
                                                                                    <td>
                                                                                        <img class="img-fluid img_class" src="<?= base_url("assets/img/company_logos/{$user2['c_logo']}"); ?>" id="c_logo" ; />
                                                                                    </td>
                                                                                    <td><?php echo $user2['c_name']; ?></td>
                                                                                    <td><?php echo $user2['c_country']; ?></td>
                                                                                    <td><?php echo $user2['user_fname']; ?></td>
                                                                                    <td><?php echo $user2['user_lname']; ?></td>
                                                                                    <td><?php echo $user2['e_jobtitle']; ?></td>
                                                                                </tr>
                                                                        <?php endforeach;
                                                                        } ?>
                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                            <!-- ./table-responsive -->
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- card mb-4 -->
                                            </div>
                                        </div>
                                        <!-- ./ Employers Card & Table -->

                                        <!-- Display Student table if user logged in is an Employer or AC -->
                                    <?php } else { ?>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12">
                                                <!-- STUDENTS table -->
                                                <div class="table-reponsive col-12">
                                                    <table class="table table-bordered dt-bootstrap4 chat_table">

                                                        <?php
                                                        echo "<thead style='background-color: #57cc99'>";
                                                        echo    "<tr>";
                                                        echo        "<th style='color: #FFFFFF;'>Chat</th>";
                                                        echo        "<th style='color: #FFFFFF;'>First Name</th>";
                                                        echo        "<th style='color: #FFFFFF;'>Last Name</th>";
                                                        echo        "<th style='color: #FFFFFF;'>Country</th>";
                                                        echo        "<th style='color: #FFFFFF;'>Field of Interest</th>";
                                                        echo        "<th style='color: #FFFFFF;'>Current Level</th>";
                                                        echo    "</tr>";
                                                        echo "</thead>";
                                                        ?>

                                                        <tbody>
                                                            <?php if (!empty($userslist)) {
                                                                foreach ($userslist as $user) : ?>
                                                                    <tr style='background-color: #f0faf6' class="font-weight-bold">
                                                                        <td class="select_user" id="<?php echo $user['user_id']; ?>" title="<?php echo $user['user_fname'] . ' ' . $user['user_lname'];  ?>">
                                                                            <a href="#chat_section" style="display:block; background-color: #5e6472; color:white; text-align: center; font-weight: 700;">Chat</a>
                                                                        </td>
                                                                        <td><?php echo $user['user_fname']; ?></td>
                                                                        <td><?php echo $user['user_lname']; ?></td>
                                                                        <td><?php echo $user['student_nationality']; ?></td>
                                                                        <td><?php echo $user['student_interest']; ?></td>
                                                                        <td><?php echo $user['student_currentlevel']; ?></td>
                                                                    </tr>
                                                            <?php endforeach;
                                                            }  ?>
                                                        </tbody>

                                                    </table>
                                                </div>
                                                <!-- ./table-responsive -->
                                            </div>
                                        </div>

                                    <?php } ?>

                                </div>
                                <!-- ./card-body -->

                            </div>
                            <!-- ./collapse_card -->

                        </div>
                        <!-- End of card -->

                    </div>
                    <!-- End of second card -->

                </div>
                <!-- End of Row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->