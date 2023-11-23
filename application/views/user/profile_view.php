<style>
    #overview_tab,
    #events_tab,
    #contact_tab {
        color: lightgray;
    }

    #overview_tab:hover,
    #events_tab:hover,
    #contact_tab:hover {
        color: black !important;
    }

    .active {
        color: black;
    }

    #overview_tab:focus,
    #events_tab:focus,
    #contact_tab:focus {
        color: black !important;
    }

    .user-pic-small {
        height: 150px;
        width: 150px;
    }

    /* .side-profile {
        padding-left: ($spacer * 0.5) !important;
        padding-right: ($spacer * 0.5) !important;
    } */
</style>

<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

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
                <div class="container-fluid" style="background-color:white;">
                    <div class="col-12">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between px-4">
                            <h1 class="h3 mb-0 text-gray-800 pt-4 font-weight-bold">My Profile</h1>
                        </div>

                        <div class="px-4 pb-4">
                            <hr style=" width :100%; height:2px; background-color:#EAF4F4">
                        </div>

                        <div class="row">
                            <div class="col-4 mt-5">
                                <div class="mx-auto mb-4" style="width: 200px;">
                                    <img class="user-pic-small mb-4 " src="<?= base_url('assets/img/chat_user/profile_pic.png'); ?>">
                                </div>

                                <div class="row ml-5 pl-3" style="font-weight:bolder; font-size:20px;">
                                    <?= $user_data['user_fname'] ?>
                                    <?= $user_data['user_lname'] ?>
                                </div>
                                <p class="ml-5 pl-3"> <?= $user_data['user_role'] ?></p>

                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link  mb-1 ml-5" id="overview_tab" onclick="overview_tab()" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-1 ml-5" id="events_tab" onclick="events_tab()" data-toggle="tab" href="#events" role="tab" aria-controls="events" aria-selected="false">My Events</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link mb-1 ml-5" id="contact_tab" onclick="contact_tab()" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">My Employer Projects</a>
                                    </li> -->
                                </ul>
                            </div>

                            <div class="col-8 mt-3">

                                <div class="tab-content" id="myTabContent">

                                    <!-- Overview content-->
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
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6><b>Email:</b></h6>
                                                        <label><?= $user_data['user_email'] ?></label>
                                                    </div>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6><b>Contact No:</b></h6>
                                                        <label><?= $student_data['student_phonenumber'] ?></label>
                                                    </div>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6><b>Country:</b></h6>
                                                        <label><?= $student_data['student_nationality'] ?></label>
                                                    </div>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6><b>Gender:</b></h6>
                                                        <label><?= $student_data['student_gender'] ?></label>
                                                    </div>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6><b>Date of Birth:</b></h6>
                                                        <label><?= $student_data['student_dob'] ?></label>
                                                    </div>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6><b>Interest:</b></h6>
                                                        <label><?= $student_data['student_interest'] ?></label>
                                                    </div>
                                                    <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                        <h6><b>Current level:</b></h6>
                                                        <label><?= $student_data['student_currentlevel'] ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Events content-->
                                    <div class="tab-pane fade" id="events">
                                        <div class="card border-left-info shadow h-100 ">
                                            <div class="card-body shadow">
                                                <div class="row pl-3 pt-4" style="vertical-align:middle;">
                                                    <div class="col-8 col-md-4 col-lg-4 mb-4">
                                                        <h6><b>Organizers</b></h6>
                                                    </div>
                                                    <div class="col-8 col-md-4 col-lg-4 mb-4">
                                                        <h6><b>Event Name</b></h6>
                                                    </div>
                                                    <div class="col-8 col-md-3 col-lg-3 mb-4">
                                                        <h6><b>Applied Date</b></h6>
                                                    </div>
                                                    <div class="col-8 col-md-1 col-lg-1 mb-4">
                                                    </div>

                                                    <?php if (!empty($student_event_data)) {           /* Display employer projects that the user applied for  */
                                                        foreach ($student_event_data as $event_data) { ?>
                                                            <div class="col-8 col-md-4 col-lg-4 mb-2">
                                                                <hr>
                                                                <img class="img-fluid img_class" style="height: 9vh; object-fit: contain;" src="<?= base_url("assets/img/organizer/") . $event_data['organizer_logo'];  ?>" width="200" ; />
                                                            </div>
                                                            <div class="col-8 col-md-4 col-lg-4 mb-2">
                                                                <hr>
                                                                <label><?= $event_data['event_name'] ?></label>
                                                            </div>
                                                            <div class="col-8 col-md-3 col-lg-3 mb-2">
                                                                <hr>
                                                                <label><?= $event_data['e_app_submitdate'] ?></label>
                                                            </div>
                                                            <div class="col-8 col-md-1 col-lg-1 mb-2">
                                                                <hr>
                                                                <a style="border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto%;" href="<?php echo base_url() . 'external/Events/view_event/' . $event_data['event_id'] ?>" target="_blank" class="btn">
                                                                    <span class="icon text-white-600">
                                                                        <i style="font-size:20px;" class="fas fa-info-circle"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        <?php }
                                                    } else { ?>
                                                        <p class="mx-auto">No record found</p> <!-- If no employer projects applied, display N/A -->
                                                    <?php } ?>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <!-- Contact content-->
                                    <div class="tab-pane fade" id="contact">
                                        <div class="card border-left-info shadow h-100 ">
                                            <div class="card-body shadow">

                                                <div class="row pl-3 pt-4" style="vertical-align:middle;">
                                                    <div class="col-8 col-md-4 col-lg-4 mb-4">
                                                        <h6><b>Company</b></h6>
                                                    </div>
                                                    <div class="col-8 col-md-4 col-lg-4 mb-4">
                                                        <h6><b>Project Title</b></h6>
                                                    </div>
                                                    <div class="col-8 col-md-3 col-lg-3 mb-4">
                                                        <h6><b>Applied Date</b></h6>
                                                    </div>
                                                    <div class="col-8 col-md-1 col-lg-1 mb-4">
                                                    </div>

                                                    <?php if (!empty($student_emp_data)) {           /* Display employer projects that the user applied for  */
                                                        foreach ($student_emp_data as $emp_data) { ?>
                                                            <div class="col-8 col-md-4 col-lg-4 mb-2">
                                                                <hr>
                                                                <img class="img-fluid img_class" style="height: 9vh; object-fit: contain;" src="<?= base_url("assets/img/company_logos/{$emp_data['c_logo']}"); ?>" width="200" ; />
                                                            </div>
                                                            <div class="col-8 col-md-4 col-lg-4 mb-2">
                                                                <hr>
                                                                <label><?= $emp_data['emp_title'] ?></label>
                                                            </div>
                                                            <div class="col-8 col-md-3 col-lg-3 mb-2">
                                                                <hr>
                                                                <label><?= $emp_data['emp_app_submitdate'] ?></label>
                                                            </div>
                                                            <div class="col-8 col-md-1 col-lg-1 mb-2">
                                                                <hr>
                                                                <a style="border-radius:10px; background-color:#6B9080; color:white; height:auto; width:auto%;" href="<?= base_url('assets/uploads/employer_projects/' . $emp_data['emp_document']) ?>" target="_blank" class="btn">
                                                                    <span class="icon text-white-600">
                                                                        <i style="font-size:20px;" class="fas fa-info-circle"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        <?php }
                                                    } else { ?>
                                                        <p class="mx-auto">No record found</p> <!-- If no employer projects applied, display N/A -->
                                                    <?php } ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="edit">
                                        <div class="card border-left-info shadow h-100 ">
                                            <div class="card-body shadow">
                                                <form method="post" name="edit_profile" action="<?php echo base_url() . 'user/profile/edit_profile' ?>">
                                                    <div class="row">

                                                        <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                            <div class="form-group">
                                                                <label>Contact Number</label>
                                                                <input type="number" name="student_contactNoid" class="form-control" id="contactNo" value="<?= $student_data['student_phonenumber'] ?>" placeholder="Enter your contact number" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <select name="student_countryid" id="nationality" class="form-control form-select btn-sm" required>
                                                                    <option value="<?= $student_data['student_nationality'] ?>" selected><?= $student_data['student_nationality'] ?></option>
                                                                    <option value="Afghanistan">Afghanistan</option>
                                                                    <option value="Åland Islands">Åland Islands</option>
                                                                    <option value="Albania">Albania</option>
                                                                    <option value="Algeria">Algeria</option>
                                                                    <option value="American Samoa">American Samoa</option>
                                                                    <option value="Andorra">Andorra</option>
                                                                    <option value="Angola">Angola</option>
                                                                    <option value="Anguilla">Anguilla</option>
                                                                    <option value="Antarctica">Antarctica</option>
                                                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                    <option value="Argentina">Argentina</option>
                                                                    <option value="Armenia">Armenia</option>
                                                                    <option value="Aruba">Aruba</option>
                                                                    <option value="Australia">Australia</option>
                                                                    <option value="Austria">Austria</option>
                                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                                    <option value="Bahamas">Bahamas</option>
                                                                    <option value="Bahrain">Bahrain</option>
                                                                    <option value="Bangladesh">Bangladesh</option>
                                                                    <option value="Barbados">Barbados</option>
                                                                    <option value="Belarus">Belarus</option>
                                                                    <option value="Belgium">Belgium</option>
                                                                    <option value="Belize">Belize</option>
                                                                    <option value="Benin">Benin</option>
                                                                    <option value="Bermuda">Bermuda</option>
                                                                    <option value="Bhutan">Bhutan</option>
                                                                    <option value="Bolivia">Bolivia</option>
                                                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                                    <option value="Botswana">Botswana</option>
                                                                    <option value="Bouvet Island">Bouvet Island</option>
                                                                    <option value="Brazil">Brazil</option>
                                                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                                    <option value="Bulgaria">Bulgaria</option>
                                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                                    <option value="Burundi">Burundi</option>
                                                                    <option value="Cambodia">Cambodia</option>
                                                                    <option value="Cameroon">Cameroon</option>
                                                                    <option value="Canada">Canada</option>
                                                                    <option value="Cape Verde">Cape Verde</option>
                                                                    <option value="Cayman Islands">Cayman Islands</option>
                                                                    <option value="Central African Republic">Central African Republic</option>
                                                                    <option value="Chad">Chad</option>
                                                                    <option value="Chile">Chile</option>
                                                                    <option value="China">China</option>
                                                                    <option value="Christmas Island">Christmas Island</option>
                                                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                                    <option value="Colombia">Colombia</option>
                                                                    <option value="Comoros">Comoros</option>
                                                                    <option value="Congo">Congo</option>
                                                                    <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                                                    <option value="Cook Islands">Cook Islands</option>
                                                                    <option value="Costa Rica">Costa Rica</option>
                                                                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                                    <option value="Croatia">Croatia</option>
                                                                    <option value="Cuba">Cuba</option>
                                                                    <option value="Cyprus">Cyprus</option>
                                                                    <option value="Czech Republic">Czech Republic</option>
                                                                    <option value="Denmark">Denmark</option>
                                                                    <option value="Djibouti">Djibouti</option>
                                                                    <option value="Dominica">Dominica</option>
                                                                    <option value="Dominican Republic">Dominican Republic</option>
                                                                    <option value="Ecuador">Ecuador</option>
                                                                    <option value="Egypt">Egypt</option>
                                                                    <option value="El Salvador">El Salvador</option>
                                                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                                    <option value="Eritrea">Eritrea</option>
                                                                    <option value="Estonia">Estonia</option>
                                                                    <option value="Ethiopia">Ethiopia</option>
                                                                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                                    <option value="Faroe Islands">Faroe Islands</option>
                                                                    <option value="Fiji">Fiji</option>
                                                                    <option value="Finland">Finland</option>
                                                                    <option value="France">France</option>
                                                                    <option value="French Guiana">French Guiana</option>
                                                                    <option value="French Polynesia">French Polynesia</option>
                                                                    <option value="French Southern Territories">French Southern Territories</option>
                                                                    <option value="Gabon">Gabon</option>
                                                                    <option value="Gambia">Gambia</option>
                                                                    <option value="Georgia">Georgia</option>
                                                                    <option value="Germany">Germany</option>
                                                                    <option value="Ghana">Ghana</option>
                                                                    <option value="Gibraltar">Gibraltar</option>
                                                                    <option value="Greece">Greece</option>
                                                                    <option value="Greenland">Greenland</option>
                                                                    <option value="Grenada">Grenada</option>
                                                                    <option value="Guadeloupe">Guadeloupe</option>
                                                                    <option value="Guam">Guam</option>
                                                                    <option value="Guatemala">Guatemala</option>
                                                                    <option value="Guernsey">Guernsey</option>
                                                                    <option value="Guinea">Guinea</option>
                                                                    <option value="Guinea-bissau">Guinea-bissau</option>
                                                                    <option value="Guyana">Guyana</option>
                                                                    <option value="Haiti">Haiti</option>
                                                                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                                                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                                    <option value="Honduras">Honduras</option>
                                                                    <option value="Hong Kong">Hong Kong</option>
                                                                    <option value="Hungary">Hungary</option>
                                                                    <option value="Iceland">Iceland</option>
                                                                    <option value="India">India</option>
                                                                    <option value="Indonesia">Indonesia</option>
                                                                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                                    <option value="Iraq">Iraq</option>
                                                                    <option value="Ireland">Ireland</option>
                                                                    <option value="Isle of Man">Isle of Man</option>
                                                                    <option value="Israel">Israel</option>
                                                                    <option value="Italy">Italy</option>
                                                                    <option value="Jamaica">Jamaica</option>
                                                                    <option value="Japan">Japan</option>
                                                                    <option value="Jersey">Jersey</option>
                                                                    <option value="Jordan">Jordan</option>
                                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                                    <option value="Kenya">Kenya</option>
                                                                    <option value="Kiribati">Kiribati</option>
                                                                    <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                                    <option value="Korea, Republic of">Korea, Republic of</option>
                                                                    <option value="Kuwait">Kuwait</option>
                                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                                    <option value="Latvia">Latvia</option>
                                                                    <option value="Lebanon">Lebanon</option>
                                                                    <option value="Lesotho">Lesotho</option>
                                                                    <option value="Liberia">Liberia</option>
                                                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                                    <option value="Lithuania">Lithuania</option>
                                                                    <option value="Luxembourg">Luxembourg</option>
                                                                    <option value="Macao">Macao</option>
                                                                    <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                                                    <option value="Madagascar">Madagascar</option>
                                                                    <option value="Malawi">Malawi</option>
                                                                    <option value="Malaysia">Malaysia</option>
                                                                    <option value="Maldives">Maldives</option>
                                                                    <option value="Mali">Mali</option>
                                                                    <option value="Malta">Malta</option>
                                                                    <option value="Marshall Islands">Marshall Islands</option>
                                                                    <option value="Martinique">Martinique</option>
                                                                    <option value="Mauritania">Mauritania</option>
                                                                    <option value="Mauritius">Mauritius</option>
                                                                    <option value="Mayotte">Mayotte</option>
                                                                    <option value="Mexico">Mexico</option>
                                                                    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                                    <option value="Monaco">Monaco</option>
                                                                    <option value="Mongolia">Mongolia</option>
                                                                    <option value="Montenegro">Montenegro</option>
                                                                    <option value="Montserrat">Montserrat</option>
                                                                    <option value="Morocco">Morocco</option>
                                                                    <option value="Mozambique">Mozambique</option>
                                                                    <option value="Myanmar">Myanmar</option>
                                                                    <option value="Namibia">Namibia</option>
                                                                    <option value="Nauru">Nauru</option>
                                                                    <option value="Nepal">Nepal</option>
                                                                    <option value="Netherlands">Netherlands</option>
                                                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                                    <option value="New Caledonia">New Caledonia</option>
                                                                    <option value="New Zealand">New Zealand</option>
                                                                    <option value="Nicaragua">Nicaragua</option>
                                                                    <option value="Niger">Niger</option>
                                                                    <option value="Nigeria">Nigeria</option>
                                                                    <option value="Niue">Niue</option>
                                                                    <option value="Norfolk Island">Norfolk Island</option>
                                                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                    <option value="Norway">Norway</option>
                                                                    <option value="Oman">Oman</option>
                                                                    <option value="Pakistan">Pakistan</option>
                                                                    <option value="Palau">Palau</option>
                                                                    <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                                    <option value="Panama">Panama</option>
                                                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                                                    <option value="Paraguay">Paraguay</option>
                                                                    <option value="Peru">Peru</option>
                                                                    <option value="Philippines">Philippines</option>
                                                                    <option value="Pitcairn">Pitcairn</option>
                                                                    <option value="Poland">Poland</option>
                                                                    <option value="Portugal">Portugal</option>
                                                                    <option value="Puerto Rico">Puerto Rico</option>
                                                                    <option value="Qatar">Qatar</option>
                                                                    <option value="Reunion">Reunion</option>
                                                                    <option value="Romania">Romania</option>
                                                                    <option value="Russian Federation">Russian Federation</option>
                                                                    <option value="Rwanda">Rwanda</option>
                                                                    <option value="Saint Helena">Saint Helena</option>
                                                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                    <option value="Saint Lucia">Saint Lucia</option>
                                                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                                                    <option value="Samoa">Samoa</option>
                                                                    <option value="San Marino">San Marino</option>
                                                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                                    <option value="Senegal">Senegal</option>
                                                                    <option value="Serbia">Serbia</option>
                                                                    <option value="Seychelles">Seychelles</option>
                                                                    <option value="Sierra Leone">Sierra Leone</option>
                                                                    <option value="Singapore">Singapore</option>
                                                                    <option value="Slovakia">Slovakia</option>
                                                                    <option value="Slovenia">Slovenia</option>
                                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                                    <option value="Somalia">Somalia</option>
                                                                    <option value="South Africa">South Africa</option>
                                                                    <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                                                    <option value="Spain">Spain</option>
                                                                    <option value="Sri Lanka">Sri Lanka</option>
                                                                    <option value="Sudan">Sudan</option>
                                                                    <option value="Suriname">Suriname</option>
                                                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                                    <option value="Swaziland">Swaziland</option>
                                                                    <option value="Sweden">Sweden</option>
                                                                    <option value="Switzerland">Switzerland</option>
                                                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                                    <option value="Taiwan">Taiwan</option>
                                                                    <option value="Tajikistan">Tajikistan</option>
                                                                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                                    <option value="Thailand">Thailand</option>
                                                                    <option value="Timor-leste">Timor-leste</option>
                                                                    <option value="Togo">Togo</option>
                                                                    <option value="Tokelau">Tokelau</option>
                                                                    <option value="Tonga">Tonga</option>
                                                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                    <option value="Tunisia">Tunisia</option>
                                                                    <option value="Turkey">Turkey</option>
                                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                                    <option value="Tuvalu">Tuvalu</option>
                                                                    <option value="Uganda">Uganda</option>
                                                                    <option value="Ukraine">Ukraine</option>
                                                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                                                    <option value="United Kingdom">United Kingdom</option>
                                                                    <option value="United States">United States</option>
                                                                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                                    <option value="Uruguay">Uruguay</option>
                                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                                    <option value="Vanuatu">Vanuatu</option>
                                                                    <option value="Venezuela">Venezuela</option>
                                                                    <option value="Viet Nam">Viet Nam</option>
                                                                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                                    <option value="Western Sahara">Western Sahara</option>
                                                                    <option value="Yemen">Yemen</option>
                                                                    <option value="Zambia">Zambia</option>
                                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                            <div class="form-group">
                                                                <label>Current Level</label>
                                                                <input type="text" name="student_levelid" class="form-control" id="contactNo" value="<?= $student_data['student_currentlevel'] ?>" placeholder="E.g., Diploma, Bachelor Degree, etc." required>
                                                            </div>
                                                        </div>
                                                        <div class="col-8 col-md-6 col-lg-6 mb-2">
                                                            <div class="form-group">
                                                                <label>Interest</label>
                                                                <input type="text" name="student_interestid" class="form-control" id="contactNo" value="<?= $student_data['student_interest'] ?>" placeholder="E.g., IT, Arts, Business, etc." required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <a href="<?= base_url('user/profile'); ?>" class="btn btn-danger">Cancel</a>
                                                </form>
                                            </div>

                                        </div>

                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                $(document).ready(function() {
                    document.getElementById("overview_tab").style.color = "black";
                }); // end of ready function
                function events_tab() {
                    document.getElementById("overview_tab").style.color = "lightgray";

                    $('#home').hide();
                    $('#contact').hide();
                    $('#edit').hide();
                    $('#events').show();
                }

                function contact_tab() {
                    document.getElementById("overview_tab").style.color = "lightgray";

                    $('#home').hide();
                    $('#events').hide();
                    $('#edit').hide();
                    $('#contact').show();
                }

                function edit_tab() {
                    document.getElementById("overview_tab").style.color = "lightgray";

                    $('#home').hide();
                    $('#events').hide();
                    $('#contact').hide();
                    $('#edit').show();
                }

                function overview_tab() {
                    $('#events').hide();
                    $('#contact').hide();
                    $('#edit').hide();
                    $('#home').show();
                }
            </script>

            <!-- Pop up after user edit profile information-->
            <?php if ($this->session->flashdata('edit_message')) { ?>
                <script>
                    swal({
                        title: 'Profile successfully edited!',
                        icon: 'success',
                        button: "OK",
                    });
                </script>
            <?php } ?>