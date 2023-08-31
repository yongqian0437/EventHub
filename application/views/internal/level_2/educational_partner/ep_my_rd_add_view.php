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
                        <h1 class="h3 mb-0 text-gray-800">Add R&D Project</h1>
                    </div>

                    <!-- Breadcrumn -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-9">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('internal/level_2/educational_partner/ep_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('internal/level_2/educational_partner/ep_my_rd_project'); ?>"></i>R&D Projects</a>
                                </li>
                                <li class="breadcrumb-item active">Add R&D Project</li>
                            </ol>
                        </div>
                        <div class="col-xl-3">
                            <div class="d-flex justify-content-end">
                                <a type="button" href="<?= base_url('internal/level_2/educational_partner/ep_my_rd_project'); ?>" class="btn btn-primary">Back<i class="fas fa-undo pl-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Card-->
                            <div class="card ">
                                <div class="card-body">
                                    <form method="post" action=" <?= base_url('internal/level_2/educational_partner/ep_my_rd_project/submit_add_rd_project/'); ?>" enctype="multipart/form-data">
                                        <?= form_open_multipart('') ?>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="course_name">R&D Project Title</label>
                                                <textarea type="text" rows="2" class="form-control" id="rd_title" name="rd_title" placeholder="Enter title" required></textarea>
                                            </div>
                                            <div class="form-group col-md-6 px-4 pl-5">
                                                <label for="rd_organisation">R&D Project Organisation</label>
                                                <textarea type="text" rows="2" class="form-control" id="rd_organisation" name="rd_organisation" placeholder="Enter organisation" required></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="rd_pic">Person in Charge</label>
                                                <input type="text" class="form-control" id="rd_pic" name="rd_pic" placeholder="Enter person in charge" required>
                                            </div>
                                            <div class="form-group col-md-6 px-4 pl-5">
                                                <label for="rd_pic_post">Person in Charge Position</label>
                                                <input type="text" class="form-control" id="rd_pic_post" name="rd_pic_post" placeholder="Enter person in charge position" required>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="rd_pic_dept">Person in Charge Department</label>
                                                <input type="text" class="form-control" id="rd_pic_dept" name="rd_pic_dept" placeholder="Enter person in charge department" required>
                                            </div>
                                            <div class="form-group col-md-6 px-4 pl-5">
                                                <label for="rd_pic_email">Person in charge Email</label>
                                                <input type="text" class="form-control" id="rd_pic_email" name="rd_pic_email" placeholder="Enter person in charge email" required>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-12 px-4 ">
                                                <label for="rd_scope">R&D Project Scope</label>
                                                <textarea type="text" class="form-control" rows="4" id="rd_scope" name="rd_scope" placeholder="Enter R&D project scope" required></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-12 px-4">
                                                <label for="rd_objective">R&D Project Objective</label>
                                                <textarea type="text" class="form-control" rows="4" id="rd_objective" name="rd_objective" placeholder="Enter R&D project objective" required></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-12 px-4">
                                                <label>Document</label>
                                                <p>You are required to download the following template and fill in the required information regarding the Employer Project that you are about to request to be posted on EventHub. Once done, proceed to upload it.</p>
                                                <div><a href="<?= base_url('/assets/uploads/rd_projects/template-research.pdf') ?>" download>R&D Project Document Template 2021</a></div>
                                            </div>
                                        </div>
                                        <div class="form-row  px-4">
                                            <div class="form-group col-md-12">
                                                <input type="file" accept=".pdf" class="custom-file-input " id="rd_document" name="rd_document" required>
                                                <label class="custom-file-label" for="customFile">Select a document</label>
                                                <div style="color:red; font-size:0.9em;">*Required document: COMPLETED R&D project document in .PDF file format</div>
                                            </div>
                                        </div>

                                        <!-- Edit button -->
                                        <div class="pr-4 pt-4">
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

            <script>
                // File appear on select
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            </script>