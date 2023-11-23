<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var organizer_id = "<?php echo $org_detail->organizer_id; ?>";
</script>

<style>
    #logo {
        border-radius: 35% 35% 0% 0%;
        width: 150px;
        height: 150px;
        object-fit: scale-down;
        background-color: white;
    }

    #foreground {
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 0, 0.4);
    }

    .event-cover-img {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: auto;
        width: auto;
    }

    #overview_tab {
        background-color: #aed9e0;
    }

    #events_tab {
        background-color: #A9BCD0;
    }

    #contact_tab {
        background-color: #9FA0C3;
    }

    #fact_tab {
        background-color: #8abdcf;
    }

    #overview_tab:hover {
        color: #12294B !important;
    }

    #events_tab:hover {
        color: #12294B !important;
    }

    #contact_tab:hover {
        color: #12294B !important;
    }

    #fact_tab:hover {
        color: #12294B !important;
    }

    .borderless td,
    .borderless th {
        border: none !important;
    }

    th {
        width: 2% !important;
        color: black;
    }

    /* CSS animation for 4 icons shaking*/
    .shake {
        animation: shake-animation 4s ease infinite;
        transform-origin: 50% 50%;
        font-size: 2.0em;
        display: inline-block;
        color: black;
    }

    .shake2 {
        animation: shake-animation 4s ease infinite;
        transform-origin: 50% 50%;
        font-size: 2.0em;
        display: inline-block;
        color: black;
        animation-delay: 1s;
    }

    .shake3 {
        animation: shake-animation 4s ease infinite;
        transform-origin: 50% 50%;
        font-size: 2.0em;
        display: inline-block;
        color: black;
        animation-delay: 2s;
    }

    .shake4 {
        animation: shake-animation 4s ease infinite;
        transform-origin: 50% 50%;
        font-size: 2.0em;
        display: inline-block;
        color: black;
        animation-delay: 3s;
    }

    @keyframes shake-animation {
        0% {
            transform: translate(0, 0)
        }

        1.78571% {
            transform: translate(5px, 0)
        }

        3.57143% {
            transform: translate(0, 0)
        }

        5.35714% {
            transform: translate(5px, 0)
        }

        7.14286% {
            transform: translate(0, 0)
        }

        8.92857% {
            transform: translate(5px, 0)
        }

        10.71429% {
            transform: translate(0, 0)
        }

        100% {
            transform: translate(0, 0)
        }
    }

    /* Enf of CSS animation for 4 icons shaking*/

    /* CSS animation for light buld on and off */
    #bulb {
        color: yellow;
        -webkit-animation: fadein 2s ease-in alternate infinite;
        -moz-animation: fadein 2s ease-in alternate infinite;
        animation: fadein 2s ease-in alternate infinite;
    }

    @-webkit-keyframes fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @-moz-keyframes fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* End of CSS animation for light buld on and off */
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

                    <!-- Content Row -->

                    <!-- Banner with logo-->
                    <div class="row pt-1 px-0">
                        <div class="col-md-12">
                            <div class="event-cover-img" style="background-image: url('<?php echo base_url("assets/img/organizer/") . $org_detail->organizer_background; ?>');">
                                <div id="foreground">
                                    <div class="row pt-5">
                                        <div class="col-md-12">
                                            <center>
                                                <div style="width:200px; height:200px; border-radius:100%; background-color:white;">
                                                    <div class="pt-2">
                                                        <img src="<?php echo base_url("assets/img/organizer/") . $org_detail->organizer_logo; ?>" alt="organizer_logo" id="logo" class="pt-5">
                                                    </div>
                                                </div>
                                            </center>
                                            <center>
                                                <div class="pt-1" style="vertical-align:bottom; font-size:1.5em; font-weight:700; color:white;"><?php echo $org_detail->organizer_name ?></div>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="float-right pr-3" style=" vertical-align:bottom; font-size:1.6em; font-weight:700; color:white;"><?php echo $total_event ?> Events</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.banner with logo-->

                    <!-- Nav for overview, events and contact-->
                    <div class="row py-5 ">
                        <div class="col-md-12 px-3 pb-5">
                            <!-- Navbar-->
                            <ul class="nav nav-tabs " id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="overview_tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="events_tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Events</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact_tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="fact_tab" data-toggle="tab" href="#fact" role="tab" aria-controls="fact" aria-selected="false">Fun Fact</a>
                                </li>
                            </ul>

                            <!-- Nav content-->
                            <div class="tab-content" id="myTabContent" style=" ">

                                <!-- Overview content-->
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="card border-left-info shadow h-100 ">
                                        <div class="card-body" style="">

                                            <div class="row pl-3 pt-4">
                                                <div class="col-md-10">
                                                    <pre class="pl-3" style="white-space: pre-wrap; word-break: break-word; text-align: justify; font-family: 'Nunito';font-size: 1.0em;"><?php echo $org_detail->organizer_shortprofile ?></pre>
                                                </div>
                                                <div class="col-md-2  mx-auto" style="text-align:center;">
                                                    <div style="text-align:center; color:black; font-size:2.4em; font-weight:600;"><?php echo $org_detail->uni_qsrank ?></div>
                                                    <div style="text-align:center; color:black; font-size:1.1em;"><?php if ($org_detail->organizer_name == "INTI International University") {
                                                                                                                        echo "Malaysia Ranking";
                                                                                                                    } else {
                                                                                                                        echo "Events Ranking";
                                                                                                                    } ?></div>
                                                    <!-- Star condition for world ranking-->
                                                    <?php if ($org_detail->organizer_name == "INTI International University") { ?>
                                                        <i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i>
                                                    <?php } elseif ($org_detail->uni_qsrank <= 50) { ?>
                                                        <i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i>
                                                    <?php } elseif ($org_detail->uni_qsrank <= 150) { ?>
                                                        <i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i>
                                                    <?php } elseif ($org_detail->uni_qsrank <= 500) { ?>
                                                        <i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i>
                                                    <?php } elseif ($org_detail->uni_qsrank <= 1000) { ?>
                                                        <i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i>
                                                    <?php } elseif ($org_detail->uni_qsrank > 1000) { ?>
                                                        <i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i>
                                                    <?php } ?>

                                                    <!-- <div class="pt-5" style="text-align:center; color:black; font-size:2.4em; font-weight:600;"><?php echo $org_detail->uni_employabilityrank ?></div>
                                                    <div style="text-align:center; color:black; font-size:1.1em;">Employabilty <br> Ranking</div> -->
                                                    <!-- Star condition for employability rank-->
                                                    <!-- <?php if ($org_detail->uni_employabilityrank <= 50) { ?>
                                                        <i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i>
                                                    <?php } elseif ($org_detail->uni_employabilityrank <= 150) { ?>
                                                        <i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i>
                                                    <?php } elseif ($org_detail->uni_employabilityrank <= 500) { ?>
                                                        <i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i>
                                                    <?php } elseif ($org_detail->uni_employabilityrank <= 1000) { ?>
                                                        <i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i><i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i>
                                                    <?php } elseif ($org_detail->uni_employabilityrank > 1000) { ?>
                                                        <i class="fas fa-star" style="color:#f2de33; font-size:1.3em;"></i>
                                                    <?php } ?> -->

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Events content-->
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="card border-left-info shadow h-100 ">
                                        <div class="card-body" style="">
                                            <!-- UNIVERSITIY INPUT -->
                                            <div class="form-row pt-2">
                                                <label for="event_field" class="col-sm-2 text-right col-form-label" style="color:black;">Event Type: </label>
                                                <div class="col-sm-3">
                                                    <select name="event_field" id="event_field" class="form-control form-select form-select-sm">
                                                        <option value="all" selected>All</option>
                                                        <?php
                                                        foreach ($event_field as $c) {
                                                            echo '<option value="' . $c->event_type . '">' . $c->event_type . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--/ UNIVERSITIY INPUT -->

                                            <div class="pt-4 px-5" id="event_list">

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Contact content-->
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="card border-left-info shadow h-100 ">
                                        <div class="card-body" style="">

                                            <div class="row pt-5" style="">
                                                <div class="col-md-3 mx-auto" style="text-align:center;">
                                                    <div class="card border-info shadow h-100">
                                                        <div class="card-body" style="">
                                                            <i class="fas fa-envelope shake"></i>
                                                            <div class="pt-3" style="font-weight:800; color:black; font-size:1.1em;">Email</div>
                                                            <div class="pt-2" style="color:black;"> <?php echo $org_detail->organizer_email ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mx-auto" style="text-align:center;">
                                                    <div class="card border-info shadow h-100">
                                                        <div class="card-body" style="">
                                                            <i class="fas fa-phone shake2"></i>
                                                            <div class="pt-3" style="font-weight:800; color:black; font-size:1.1em;">Hotline</div>
                                                            <div class="pt-2" style="color:black;"> <?php echo $org_detail->organizer_hotline ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mx-auto" style="text-align:center;">
                                                    <div class="card border-info shadow h-100">
                                                        <div class="card-body" style="">
                                                            <i class="fas fa-map-marked-alt shake3"></i>
                                                            <div class="pt-3" style="font-weight:800; color:black; font-size:1.1em;">Address</div>
                                                            <div class="pt-2" style="color:black;"> <?php echo $org_detail->organizer_address ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mx-auto" style="text-align:center;">
                                                    <div class="card border-info shadow h-100">
                                                        <div class="card-body" style="">
                                                            <i class="fas fa-globe shake4"></i>
                                                            <div class="pt-3" style="font-weight:800; color:black; font-size:1.1em;">Website</div>
                                                            <div class="pt-2" style="color:black;"><a href="<?php echo $org_detail->organizer_website ?>" target="_blank">Link</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Overview content-->
                                <div class="tab-pane fade" id="fact" role="tabpanel" aria-labelledby="fact-tab">
                                    <div class="card border-left-info shadow h-100 ">
                                        <div class="card-body" style="">
                                            <div class="px-3 pt-4">

                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-8" style="">
                                                        <div class="card border-0" style="">
                                                            <div class="card-body " style="background-color:#8ac0d4; border-radius:25px;">

                                                                <div class="row justify-content-md-center">
                                                                    <div class="col-md-3 my-auto" style="text-align:center; ">

                                                                        <div><i id="bulb" class="fas fa-lightbulb buld " style="color:yellow; font-size:4.4em; "></i></div>
                                                                        <div class="pt-3" style="color:black; font-size:1.5em; font-weight:700; ">Did you know?</div>
                                                                    </div>

                                                                    <div class="col-md-9" style="border-left:1px solid black; ">
                                                                        <div class="px-2 pl-3 pb-2" style="color:black; font-size:1.2em; white-space: pre-wrap; word-break: break-word; text-align: justify;"><?php echo $org_detail->organizer_fun_fact ?></div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--End nav content-->
                        </div>
                        <!--End col-->
                    </div>
                    <!--End of Nav for overview, events and contact-->


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->