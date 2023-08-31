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
                        <h1 class="h3 mb-0 text-gray-800">Add Employer Project</h1>
                    </div>

                    <!-- Breadcrumb -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-9">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('internal/level_2/employer/Employer_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url('internal/level_2/employer/employer_emps'); ?>"></i>Employer Projects (EPs)</a>
                                </li>
                                <li class="breadcrumb-item active">Add Employer Project</li>
                            </ol>
                        </div>
                        <div class="col-xl-3">
                            <div class="d-flex justify-content-end">
                                <a type="button" href="<?= base_url('internal/level_2/employer/employer_emps'); ?>" class="btn btn-primary">Back<i class="fas fa-undo pl-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Card-->
                            <div class="card ">
                                <div class="card-body">
                                    <form method="post" action=" <?= base_url('internal/level_2/employer/employer_emps/submit_added_emp/' . $e_details['e_id']); ?>" enctype="multipart/form-data">
                                        <?= form_open_multipart('') ?>
                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-12 px-4 pr-5">
                                                <label for="emp_title">Employer Project Title</label>
                                                <input type="text" class="form-control" id="emp_title" name="emp_title" placeholder="Enter employer project title" required>
                                            </div>
                                        </div>
                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="emp_area">Field</label>
                                                <textarea type="text" class="form-control" rows="3" id="emp_area" name="emp_area" placeholder="Enter employer project field (e.g: Information Technology (IT), Business, Mass Communication)" required></textarea>
                                                <div style="color:red; font-size:0.9em;">*Can enter more than 1 field</div>
                                            </div>
                                            <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="emp_level">Level</label>
                                                <select name="emp_level" id="emp_level" class="form-control form-select form-select" required>
                                                    <option value="" selected disabled>Please select a level</option>
                                                    <option value="Foundation">Foundation</option>
                                                    <option value="Certificate">Certificate</option>
                                                    <option value="Diploma">Diploma</option>
                                                    <option value="Bachelor Degree">Bachelor Degree</option>
                                                    <option value="Masters">Masters</option>
                                                    <option value="Doctorate">Doctorate</option>
                                                    <option value="Advanced Diploma">Advanced Diploma</option>
                                                    <option value="Graduate Certificate and Graduate Diploma">Graduate Certificate and Graduate Diploma</option>
                                                    <option value="Postgraduate Certificate and Postgraduate Diploma">Postgraduate Certificate and Postgraduate Diploma</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-12 px-4">
                                                <label for="emp_description">Description</label>
                                                <textarea type="text" class="form-control" rows="8" id="emp_description" name="emp_description" placeholder="Enter employer project description" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row pt-4">
                                            <div class="col-md-12 px-4">
                                                <label>Document</label>
                                            </div>
                                            <div class="col-md-12 px-4">
                                                <p>You are required to download the following template and fill in the required information regarding the Employer Project that you are about to request to be posted on EventHub. Once done, proceed to upload it.</p>
                                                <a href="<?= base_url('/assets/uploads/employer_projects/Employer_Project_Proposal_Template_2021.pdf') ?>" download>Employer Project Proposal Template 2021</a>
                                            </div>
                                        </div>
                                        <div class="form-row px-4 pt-4">
                                            <div class="form-group col-md-12">
                                                <input type="file" accept=".pdf" class="custom-file-input" id="emp_document" name="emp_document" required>
                                                <label class="custom-file-label" for="customFile">Document</label>
                                                <div style="color:red; font-size:0.9em;">*Required document: COMPLETED Employer Project Proposal in .PDF file format</div>
                                            </div>
                                        </div>

                                        <!-- Submit button -->
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

            <script>
                // File appear on select
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            </script>