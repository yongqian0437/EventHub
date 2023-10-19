<!-- Jquery plugin -->
<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var ep_collab_id = "<?php echo $ep_id; ?>";
</script>

<script type="text/javascript">
    // $(function() {

    // });
</script>

<!-- Top Navigation -->


<?php if ($user_role != 'Education Partner') {

    $this->load->view('external/templates/topnav');
} ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="flex-fill">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php if ($user_role == 'Education Partner') { ?>
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4 px-4">
                            <h1 class="h3 mb-0 text-gray-800">Research & Development Projects</h1>
                        </div>

                        <!-- Breadcrumb -->
                        <div class="row">
                            <div class="breadcrumb-wrapper col-xl-9">
                                <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('internal/level_2/educational_partner/ep_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Research & Development Projects</li>
                                </ol>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($user_role != 'Education Partner') { ?>
                        <!-- Page Heading -->
                        <h1 class="h3 mb-1 text-gray-800 pt-4 px-4 pb-2 font-weight-bold">Research & Development Projects</h1>
                    <?php } ?>

                    <p class="mb-4 px-4" style="text-align: justify;">Research and development (R&D) includes activities that companies undertake to innovate and introduce new products and services.
                        It is often the first stage in the development process. The goal is typically to take new products and services to market and add to the company's bottom line.
                        R&D represents the activities companies undertake to innovate and introduce new products and services or to improve their existing offerings,
                        allows an organisation to stay ahead of its competition. This allows education partners or educational institutions to collaborate with one another
                        in there common aim. The term R&D is widely linked to innovation both in the corporate and government world or the public and private sectors.
                        Through R&D Project collaboration, institutions may now join forces in discovering a solution to a unified problem.</p> <!-- R&D Description -->

                    <div class="px-4 pb-4">
                        <hr style=" width :100%; height:2px; background-color:#EAF4F4">
                        <p class="pt-2 font-weight-bold"><i>*To apply for an R&DP or view further details of the project, you are required to be logged in to the system or register for an account if you don't have one yet.</i></p>
                    </div>

                    <!-- Content Row. 1 row = 3 cards -->
                    <div class="row px-4">

                        <!-- <php foreach ($eps as $ep): var_dump($ep); ?> hello <br><br> <php endforeach; die;?> -->

                        <?php foreach ($rds as $rd) : ?>
                            <div class="col-lg-4 mb-4">
                                <div class="card mb-4 h-100">
                                    <!-- h-100 to make cards same height despite some content being lesser than some-->
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold company_name"><?= $rd['rd_organisation'] ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item list_class">
                                                <img class="img-fluid img_class" style="height: 17vh; object-fit: contain;" src="<?= base_url("assets/img/universities/{$rd['organizer_logo']}"); ?>" width="300" ; />
                                                <h6><b>Project Title: <?= $rd['rd_title'] ?></b></h6>
                                            </li>
                                            <li class="list-group-item">
                                                <table>
                                                    <tr>
                                                        <th style="vertical-align:top">Owner: </th>
                                                        <td><?= $rd['rd_pic'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="vertical-align:top">Position: </th>
                                                        <td><?= $rd['rd_pic_post'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="vertical-align:top">Department: </th>
                                                        <td><?= $rd['rd_pic_dept'] ?></td>
                                                    </tr>
                                                </table>
                                            </li>
                                            <li class="list-group-item" style="height: 20vh;">
                                                <span style="text-align: justify; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical;"><?= $rd['rd_scope'] ?></span>
                                            </li>
                                        </ul>
                                        <br>
                                        <div class="mt-3">
                                            <!-- 2 Bottom Buttons -->
                                            <div class="bottom_buttons">
                                                <button type="button" onclick="view_rd(<?php echo $rd['rd_id']; ?>)" class="btn icon-btn btn-xs btn-info waves-effect waves-light" data-toggle="modal" data-target="#view_rd"><span class="fas fa-eye"></span></button>
                                                <!-- *Check if session is established and if the role is a EP. If yes, show the 'View' and 'Apply Now' button -->
                                                <?php if ($user_role == 'Education Partner') { ?>
                                                    <!-- 'View' button becomes visible once EP is logged in -->
                                                    <a class="btn view_doc" href="<?= base_url('assets/uploads/rd_projects/' . $rd['rd_document']) ?>" role="button" target="_blank" style="background-color: #8993a3; color:#FFFFFF">View</a>
                                                    <?php if ($rd['ep_id'] != $ep_id) { ?>
                                                        <!-- **Check if EP has already applied to this specific R&DP. If yes, disable the apply button -->
                                                        <?php $response = $this->rd_applicants_model->past_application($this->session->userdata('user_id'), $rd['rd_id']);
                                                        if ($response == true) { ?>
                                                            <button type="button" class="btn applied_rd" style="background-color: #0077B6; color:white;" disabled>Applied</button>
                                                        <?php } else { ?>
                                                            <button type="button" class="btn btn-success apply_rd" data-id="[<?= $rd['ep_id'] ?>, <?= $rd['rd_id'] ?> ]">Apply Now</button>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($rd['ep_id'] != $ep_id) { ?>
                                                        <!-- ***If EP is not logged in, 'Apply Now' button will redirect to Login page -->
                                                        <?php if ($user_role != 'Student') { ?>
                                                            <a class="btn apply_reg" href="<?= base_url('user/login/Auth/login'); ?>">Apply Now</a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <!-- /.row -->
                    <div class="modal fade" id="view_rd" tabindex="-1" role="dialog" aria-labelledby="view_rdlabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#6B9080;">
                                    <h5 class="modal-title" id="view_rdLabel" style="color:white;">R&D Project Information</h5>
                                    <button style="color:white;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="rd_information">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /.content -->