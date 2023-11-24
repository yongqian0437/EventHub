<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>


<!-- Styles-->
<style>
    html {
        scroll-behavior: smooth;
    }

    table {
        table-layout: fixed;
        word-wrap: break-word;
        border-top: 2px solid black !important;

    }

    th {
        color: #1a1918;
        font-size: 19px;
        width: 30px;
        font-weight: 700;
    }

    td {
        color: #1a1918;
        font-size: 17px;
        font-weight: 500;
    }

    tr:nth-child(even) {
        background-color: #EAF4F4;
    }

    #cancel {
        right: 0px;
        top: 0.8em;
        position: absolute;
    }

    #cancel:hover {
        opacity: 0.6;
    }

    #add_selection_btn:hover {
        transform: scale(0.95);
    }

    #add_icon:hover {
        transform: scale(0.95);
        color: #16a88c !important;
    }
</style>

<!-- Top Navigation -->
<?php $this->load->view('external/templates/topnav'); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div style='background-color:white;' class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2 px-4">
                        <h1 class="h3 mb-0 text-gray-800 pt-4 font-weight-bold">Report</h1>
                    </div>

                    <div class="py-2 px-4" style="text-align: justify; font-weight:500;">The Campus Event Management System's Report Page allows students to seamlessly submit PDF reports for their campus events. This user-friendly interface simplifies the reporting process, enabling students to upload and share comprehensive event summaries effortlessly. The system streamlines communication between students and event organizers, facilitating efficient documentation and analysis of campus activities. Through this feature, the platform promotes transparency, accountability, and effective management of diverse events within the campus community.
                    </div>

                    <div class="px-4 pb-4">
                        <hr style=" width :100%; height:2px; background-color:#EAF4F4">
                    </div>

                    <br>

                    <!-- Content Row -->



                    <!-- 3 FORM -->
                    <form>
                        <div class="row justify-content-md-center">

                            <div class="col-xl-2 col-md-6 mb-4">
                                <div class="card border-5 h-100" id='card0' style="border-color:#61677A ; border-width: 5px;">
                                    <div class="card-body">
                                        <p style='font-size: 20px; color:grey;'><br><br> Submit Report </p>
                                        <i style='color:#474645;' class="fas fa-arrow-right fa-3x"></i><br><br><br>

                                    </div>
                                </div>
                            </div>

                            <!-- FIRST events INPUTS -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card h-100 py-2" id='card1' style="border-color:#61677A ; border-width: 5px;"> <br><br>
                                    <div class="card-body">
                                        <!-- UNIVERSITIY INPUT -->
                                        <div class="form-group col-md-12 px-4 pt-2">
                                            <input type="file" class="custom-file-input" id="customFile" name="e_applicant_document" accept="reprot/pdf" required>
                                            <label class="custom-file-label" for="customFile">Upload Report</label>
                                            <p style="font-size: 14px; color:red;">*Required in .PDF file format</p>
                                        </div>





                                    </div>
                                </div>
                            </div>



                            <!-- THIRD events INPUTS -->

                            <!-- END OF THIRD SELECTION-->

                            <!-- add third selection button -->
                            <!-- <div class="col-xl-1 col-md-6 mb-4" id="forth_selection">
                                <div class="card h-100 py-2 pt-5" id='card3' style="border:0; ">
                                    <div class="card-body pt-5">
                                        <a class="btn pt-5" onclick="addThirdSelection()" id="add_selection_btn"><i id="add_icon" class="fas fa-plus-circle" style="color:#1dd3b0; font-size:4.4em; "></i></a>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                        <!-- END OF ROW -->
                    </form>
                    <!-- END OF FORM -->

                    <!-- PROCEED BUTTON STYLING -->
                    <div class="row justify-content-md-center pb-5">

                        <div class="col-xl-1 col-md-6 mb-4 ">
                            <div style='visibility: hidden;'></div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div style='visibility: hidden;'></div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="pt-4 pr-3">
                                <button type="submit" class="btn btn-success" style="float:right; width:auto">Submit <i class="fas fa-check"></i></button>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div style='visibility: hidden;'></div>
                        </div>

                    </div><br><br>
                    <!-- END OF PROCEED BUTTON  -->

                    <!-- TABLE  -->
                    <div class="row justify-content-md-center px-2 pb-5">
                        <div class="col-xl-12 px-5">
                            <h3 style="font-weight:700;"></h3>
                            <table class="table py-2" id='table_view'>

                            </table>
                        </div>
                    </div><br><br><br><br>
                    <!-- End of table -->

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