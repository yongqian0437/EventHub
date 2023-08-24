<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url();?>";

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

th{
    color:#1a1918;
    font-size:19px;
    width:30px;
    font-weight: 700;
}

td{
    color:#1a1918;
    font-size:17px;
    font-weight: 500;
}

tr:nth-child(even) {
background-color: #EAF4F4;
}

#cancel{
    right:0px;
    top:0.8em;
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
    color:#16a88c !important;
}

</style>

<!-- Top Navigation -->
<?php $this->load->view('external/templates/topnav');?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div style = 'background-color:white;' class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-2 px-4">
                    <h1 class="h3 mb-0 text-gray-800 pt-4 font-weight-bold">Compare Courses</h1>
                </div>

                <div class="py-2 px-4" style="text-align: justify; font-weight:500;">Finding the right college and programme is a complicated process, but iJEES is here to help! A great way to research what's best for you and start to build your list is to compare your options side-by-side. Find the college that's the best fit for you by using our comparison tool. Students can quickly compare several programmes and universities they’re interested in – and then click through to a university profile page for more details. Application submission may also be done right after.
                </div>

                <div class="px-4 pb-4">
                    <hr style=" width :100%; height:2px; background-color:#EAF4F4">
                </div>

                <br>

                <!-- Content Row -->

                <!-- TOP TITLES -->
                <div class="row justify-content-md-center">   
                       
                    <div class="col-xl-2 col-md-6 mb-4 ">
                        <div style = 'visibility: hidden;' class="card  h-100 py-2">
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-4" id = 'selection1'>
                        <div style = 'background-color:#CCE3DE' class="card h-75">
                            <div class="card-body">
                            <h4 style = 'color:black' class="card-title"><b>SELECTION 1</b></h4>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4" id = 'selection2'>
                        <div style = 'background-color:#CCE3DE' class="card h-75">
                            <div class="card-body">
                            <h4 style = 'color:black' class="card-title"><b>SELECTION 2</b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4" id = 'selection3'>
                        <div style = 'background-color:#CCE3DE' class="card h-75">
                            <div class="card-body">
                                <a class="btn pb-5" id = "cancel" onclick="removeThirdSelection()"><i  class = "fas fa-times" style = "color:black; font-size:1.4em;"></i></a>
                                <h4 style = 'color:black' class="card-title"><b>SELECTION 3</b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-1 col-md-6 mb-4" id = 'selectionbtn'>
                        <div style = 'border:0;' class="card h-75">

                        </div>
                    </div>

                </div>
                    
                <!-- 3 FORM -->
                <form>
                    <div class="row justify-content-md-center">   

                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-5 h-100" id = 'card0' style = "border-color:#CCE3DE ; border-width: 5px;">
                                <div class="card-body">
                                <p style = 'font-size: 15px; color:black;'>STEP 1 : <br><br> SELECT A UNIVERISTY AND A LEVEL</p>
                                <i style = 'color:#474645;' class="fas fa-arrow-right fa-3x"></i><br><br><br>
                                <p style = 'font-size: 15px; color:black;'>STEP 2 : <br><br> SELECT A COURSE</p>
                                <i style = 'color:#474645;' class="fas fa-arrow-right fa-3x"></i>
                                </div>
                            </div>
                        </div>
                        <!-- FIRST COURSES INPUTS -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100 py-2" id = 'card1' style = "border-color:#CCE3DE ; border-width: 5px;">
                                <div class="card-body">
                                   <!-- UNIVERSITIY INPUT -->
                                    <div class="form-group"><br>
                                        <label for="university1">UNIVERSITY</label><br>
                                        <select name="university1_id" id="university_1" class="form-control form-select form-select-md">
                                            <option value="" selected disabled>Please select a university</option>
                                            <?php
                                                foreach($university_data as $u) {
                                                    echo '<option value="'.$u->uni_id.'">'.$u->	uni_name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>  
                                    <!-- LEVEL INPUT -->
                                    <div class="form-group"><br>
                                        <label for="level1">LEVEL</label><br>
                                        <select name="level1_id" id="level_1" class="form-control form-select form-select-lg">
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
                                    <!-- COURSE INPUT -->
                                    <div class="form-group" id="course_class_1"><br>
                                        <label for="course1">COURSE</label><br>
                                        <select name="course1_id" id="course_1" class="form-control form-select form-select-md">
                                            <option value="" selected disabled>Please select a course</option>
                                        </select>
                                    </div>  

                                </div>
                            </div>
                        </div>

                        <!-- SECOND COURSES INPUTS -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100 py-2" id = 'card2' style = "border-color:#CCE3DE ; border-width: 5px;">
                                <div class="card-body">
                                    <!-- UNIVERSITIY INPUT -->
                                    <div class="form-group"><br>
                                        <label for="university2">UNIVERSITY</label><br>
                                        <select name="university2_id" id="university_2" class="form-control form-select form-select-md">
                                            <option value="" selected disabled>Please select a university</option>
                                            <?php
                                                foreach($university_data as $u) {
                                                    echo '<option value="'.$u->uni_id.'">'.$u->	uni_name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>  
                                    <!-- LEVEL INPUT -->
                                    <div class="form-group"><br>
                                        <label for="level2">LEVEL</label><br>
                                        <select name="level2_id" id="level_2" class="form-control form-select form-select-lg">
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
                                    <!-- COURSE INPUT -->
                                    <div class="form-group" id="course_class_2"><br>
                                        <label for="course1">COURSE</label><br>
                                        <select name="course2_id" id="course_2" class="form-control form-select form-select-md">
                                            <option value="" selected disabled>Please select a course</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- THIRD COURSES INPUTS -->
                        <div class="col-xl-3 col-md-6 mb-4" id = "third_selection">
                            <div class="card h-100 py-2" id = 'card3' style = "border-color:#CCE3DE ; border-width: 5px;">
                                <div class="card-body">
                                    <!-- UNIVERSITIY INPUT -->
                                    <div class="form-group"><br>
                                        <label for="university3">UNIVERSITY</label><br>
                                        <select name="university3_id" id="university_3" class="form-control form-select form-select-md">
                                            <option value="" selected disabled>Please select a university</option>
                                            <?php
                                                foreach($university_data as $u) {
                                                    echo '<option value="'.$u->uni_id.'">'.$u->	uni_name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>  
                                    <!-- LEVEL INPUT -->
                                    <div class="form-group"><br>
                                        <label for="level3">LEVEL</label><br>
                                        <select name="level3_id" id="level_3" class="form-control form-select form-select-lg">
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
                                    <!-- COURSE INPUT -->
                                    <div class="form-group" id="course_class_3"><br>
                                        <label for="course3">COURSE</label><br>
                                        <select name="course3_id" id="course_3" class="form-control form-select form-select-md">
                                            <option value="" selected disabled>Please select a course</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END OF THIRD SELECTION--> 
                        
                        <!-- add third selection button -->
                        <div class="col-xl-1 col-md-6 mb-4" id = "forth_selection">
                            <div class="card h-100 py-2 pt-5" id = 'card3' style = "border:0; ">
                                <div class="card-body pt-5" >
                                    <a class="btn pt-5" onclick="addThirdSelection()" id = "add_selection_btn"><i  id = "add_icon" class = "fas fa-plus-circle" style = "color:#1dd3b0; font-size:4.4em; "></i></a>
                                </div>
                            </div>
                        </div>
      
                    </div>
                    <!-- END OF ROW --> 
                </form>
                <!-- END OF FORM --> 

                <!-- PROCEED BUTTON STYLING -->
                <div class="row justify-content-md-center pb-5" >   
                       
                    <div class="col-xl-1 col-md-6 mb-4 ">
                        <div style = 'visibility: hidden;'></div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div style = 'visibility: hidden;'></div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <a style = 'border-radius:20px;' onclick="generateTable()" id = 'proceed_btn' class = 'btn btn-success btn-lg btn-icon-split'>
                            <span class = 'icon text-white-600'>
                            <i class = 'fas fa-arrow-down fa-2x p-1'></i>
                            </span>
                            <span style = 'font-size:25px;' class = "text p-3">PROCEED</span>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div style = 'visibility: hidden;'></div>
                    </div>

                </div><br><br>
                 <!-- END OF PROCEED BUTTON  -->

                <!-- TABLE  -->
                <div class="row justify-content-md-center px-2 pb-5">   
                    <div class="col-xl-12 px-5" >
                        <h3 style = "font-weight:700;" ></h3>
                        <table class="table py-2" id = 'table_view'>
                            
                        </table>
                    </div>
                </div><br><br><br><br>
                <!-- End of table -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->