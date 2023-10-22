<style>
    .image-preview {
        width: 300px;
        height: 150px;
        border: 2px solid #dddddd;
        margin-top: 15px;

        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }

    .image-preview__image {
        display: none;
        width: 295px;
        object-fit: contain;
        height: 145px;
    }

    .image-preview2 {
        width: 300px;
        height: 150px;
        border: 2px solid #dddddd;
        margin-top: 15px;

        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }

    .image-preview__image2 {
        display: none;
        width: 295px;
        object-fit: contain;
        height: 145px;
    }

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
                        <h1 class="h3 mb-0 text-gray-800">Edit Organizer</h1>
                    </div>

                    <!-- Breadcrumn -->
                    <div class="row">
                        <div class="breadcrumb-wrapper col-xl-9">
                            <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('internal/level_2/educational_partner/ep_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo base_url('internal/level_2/educational_partner/ep_organizer'); ?>"> Organizer</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Organizer</li>
                            </ol>
                        </div>
                        <div class="col-xl-3">
                            <div class="d-flex justify-content-end">
                                <a type="button" href="<?= base_url('internal/level_2/educational_partner/ep_organizer'); ?>" class="btn btn-primary">Back<i class="fas fa-undo pl-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Card-->
                            <div class="card ">
                                <div class="card-body">
                                    <form method="post" action=" <?= base_url('internal/level_2/educational_partner/ep_organizer/after_edit_organizers/' . $event_data->organizer_id); ?>" enctype="multipart/form-data">
                                        <?= form_open_multipart('') ?>
                                        <div class="form-row">
                                            <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="organizer_name">Organizer Name</label>
                                                <input type="text" class="form-control" id="organizer_name" name="organizer_name" placeholder="Enter organizers name" value="<?= $event_data->organizer_name ?>" required>
                                            </div>
                                            <div class="form-group col-md-6 px-4 pl-5">
                                                <label for="organizer_country"> Country</label>
                                                <select name="organizer_country" id="organizer_country" class="form-control form-select" required>
                                                    <option value="<?= $organizers_data->organizer_country ?>" selected><?= $organizers_data->organizer_country ?></option>
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

                                        <div class="form-row">
                                            <div class="form-group col-md-12 px-4 pt-4">
                                                <label for="organizer_shortprofile">Organizer Shortprofile</label>
                                                <textarea type="text" class="form-control" rows="10" id="organizer_shortprofile" name="organizer_shortprofile" placeholder="Enter shortprofile" required><?= $event_data->organizer_shortprofile ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12 px-4 pt-4">
                                                <label for="organizer_fun_fact">Organizer Fun Fact</label>
                                                <textarea type="text" class="form-control" rows="5" id="organizer_fun_fact" name="organizer_fun_fact" placeholder="Enter fun fact" required><?= $event_data->organizer_fun_fact ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="organizer_hotline">Organizer Hotline</label>
                                                <input type="text" class="form-control" id="organizer_hotline" name="organizer_hotline" placeholder="Enter hotline" value="<?= $event_data->organizer_hotline ?>" required>
                                            </div>
                                            <div class="form-group col-md-6 px-4 pl-5">
                                                <label for="organizer_email">Organizer Email</label>
                                                <input type="email" class="form-control" id="organizer_email" name="organizer_email" placeholder="Enter email" value="<?= $event_data->organizer_email ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-row pt-4">
                                            <div class="form-group col-md-6 px-4 pr-5">
                                                <label for="organizer_address">Organizer Address</label>
                                                <input type="text" class="form-control" id="organizer_address" name="organizer_address" placeholder="Enter address" value="<?= $event_data->organizer_address ?>" required>
                                            </div>
                                            <div class="form-group col-md-6 px-4 pl-5">
                                                <label for="organizer_website">Organizer Website</label>
                                                <input type="text" class="form-control" id="organizer_website" name="organizer_website" placeholder="Enter website" value="<?= $event_data->organizer_website ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-row pt-5">
                                            <div class="form-group col-md-4 px-4 pr-5">
                                                <label for="uni_qsrank"> Organizer Rank</label>
                                                <input type="number" class="form-control" id="uni_qsrank" name="uni_qsrank" placeholder="Enter QS ranking" value="<?= $event_data->uni_qsrank ?>" required>
                                            </div>
                                            <!-- <div class="form-group col-md-4 px-4 pr-5">
                                                <label for="uni_employabilityrank">organizers Employability Rank</label>
                                                <input type="number" class="form-control" id="uni_employabilityrank" name="uni_employabilityrank" placeholder="Enter employability rank" value="<?= $event_data->uni_employabilityrank ?>" required>
                                            </div> -->
                                            <div class="form-group col-md-4 px-4 ">
                                                <label for="uni_totalstudents">Organizer Employee</label>
                                                <input type="number" class="form-control" id="uni_totalstudents" name="uni_totalstudents" placeholder="Enter total student" value="<?= $event_data->uni_totalstudents ?>" required>
                                            </div>
                                        </div>

                                        <div class="py-4">
                                            <hr style=" width :100%; height:1px; background-color: rgba(0, 0, 0, 0.3); ;">
                                        </div>
                                        <!-- Logo Image Row -->
                                        <div class="row">

                                            <div class="col-xl-6 pl-5">
                                                <div class="pb-3" style="color:black;">Current Organizer Logo</div>
                                                <img style=" height:200px; width: 300px; object-fit: contain;" src="<?= base_url("assets/img/organizer/") . $event_data->organizer_logo ?>" alt="logo">
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="pb-3" style="color:black;">New Organizer Logo</div>
                                                <input type="file" name="organizer_logo" id="inpFile" accept="image/*">
                                                <div class="image-preview" id="imagePreview">
                                                    <img src="" alt="Image Preview" class="image-preview__image">
                                                    <span class="image-preview__default-text">Image Preview</span>
                                                </div>
                                                <!-- Js for logo image preview -->
                                                <script>
                                                    const inpFile = document.getElementById("inpFile");
                                                    const previewContainer = document.getElementById("imagePreview");
                                                    const previewImage = previewContainer.querySelector(".image-preview__image");
                                                    const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

                                                    inpFile.addEventListener("change", function() {
                                                        const file = this.files[0];

                                                        if (file) {
                                                            const reader = new FileReader();

                                                            previewDefaultText.style.display = "none";
                                                            previewImage.style.display = "block";

                                                            reader.addEventListener("load", function() {
                                                                previewImage.setAttribute("src", this.result);
                                                            });

                                                            reader.readAsDataURL(file);
                                                        } else {
                                                            previewDefaultText.style.display = "null";
                                                            previewImage.style.display = "null";
                                                            previewImage.setAttribute("src", "");
                                                        }
                                                    });
                                                </script>
                                            </div>

                                        </div>
                                        <!-- /. Logo Image Row -->

                                        <div class="py-4">
                                            <hr style=" width :100%; height:1px; background-color: rgba(0, 0, 0, 0.3); ;">
                                        </div>

                                        <!-- Background Image Row -->
                                        <div class="row">

                                            <div class="col-xl-6 pl-5">
                                                <div class="pb-3" style="color:black;">Current Organizer Background</div>
                                                <img style=" height:200px; width: 300px; object-fit: contain;" src="<?= base_url("assets/img/organizer/{$event_data->organizer_background}"); ?>" alt="background">
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="pb-3" style="color:black;">New Organizer Background</div>
                                                <input type="file" name="organizer_background" id="inpFile2" accept="image/*">
                                                <div class="image-preview2" id="imagePreview2">
                                                    <img src="" alt="Image Preview2" class="image-preview__image2">
                                                    <span class="image-preview__default-text2">Image Preview</span>
                                                </div>
                                                <!-- Js for background image preview -->
                                                <script>
                                                    const inpFile2 = document.getElementById("inpFile2");
                                                    const previewContainer2 = document.getElementById("imagePreview2");
                                                    const previewImage2 = previewContainer2.querySelector(".image-preview__image2");
                                                    const previewDefaultText2 = previewContainer2.querySelector(".image-preview__default-text2");

                                                    inpFile2.addEventListener("change", function() {
                                                        const file2 = this.files[0];

                                                        if (file2) {
                                                            const reader2 = new FileReader();

                                                            previewDefaultText2.style.display = "none";
                                                            previewImage2.style.display = "block";

                                                            reader2.addEventListener("load", function() {
                                                                previewImage2.setAttribute("src", this.result);
                                                            });

                                                            reader2.readAsDataURL(file2);
                                                        } else {
                                                            previewDefaultText2.style.display = "null";
                                                            previewImage2.style.display = "null";
                                                            previewImage2.setAttribute("src", "");
                                                        }
                                                    });
                                                </script>
                                            </div>

                                        </div>
                                        <!-- /. Background Image Row -->

                                        <div class="py-4">
                                            <hr style=" width :100%; height:1px; background-color: rgba(0, 0, 0, 0.3); ;">
                                        </div>

                                        <!-- Edit button -->
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