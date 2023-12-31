<?php $this->load->view('external/templates/topnav'); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Carousel Slide -->
                    <div id="carouselExampleIndicators" class="carousel slide pt-2" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block h-20 w-100" style="margin-left:auto; margin-right:auto;" src="<?php echo base_url('assets/img/Carousel/event.png') ?>" alt="First slide">
                                <div class="carousel-caption d-none d-md-block" style="left:0; top:0; height:100%; width:100%; text-align:center;">
                                    <h1 class="ml-2 mt-5 pt-5 mr-2" style="font-weight:700; font-size:3.25rem;">Welcome to EventHub</h1>
                                    <h1 class="ml-5 mt-4" style="font-weight:400; font-size:1.75rem;">A campus event management system</h1>
                                    <h1 class="ml-5" style="font-weight:400; font-size:1.75rem;">for campus and students</h1>
                                    <?php if (!$this->session->has_userdata('has_login')) { ?>
                                        <a href="<?= base_url('user/login/Auth/login'); ?>" class="btn btn-danger btn-lg ml-3 mt-5" style="border-radius:10px;">SIGN UP AND JOIN US</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block h-20 w-100" style="margin-left:auto;  margin-right:auto; " src="<?php echo base_url('assets/img/Carousel/employment.png') ?>" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block" style="left:0%; top:0%; height:100%; width:100%;">
                                    <h1 class="ml-5 mt-5 pt-5" style="font-weight:600; font-size:3.5rem;">Partner with Organizers around the world</h1>
                                    <h1 class="ml-5 mt-5" style="font-weight:400; font-size:1.75rem;">Gain access to multiple organizers </h1>
                                    <h1 class="ml-5 " style="font-weight:400; font-size:1.75rem;">partners with years of experience right at your fingertips</h1>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block h-20 w-100" style="margin-left:auto;  margin-right:auto; " src="<?php echo base_url('assets/img/Carousel/grad.png') ?>" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block" style="left:0%; top:0%; height:100%; width:100%;">
                                    <h1 class="ml-5 mt-5 pt-5" style="font-weight:600; font-size:3.5rem;">Start your journey with us</h1>
                                    <h1 class="ml-5 mt-5" style="font-weight:400; font-size:1.75rem;"><i>Welcoming students, REGISTER and APPLY </i></h1>
                                    <h1 class="ml-5 " style="font-weight:400; font-size:1.75rem;"><i>any events you like!</i></h1>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <!-- Card View -->
                    <main>
                        <div class="card-group mt-5">
                            <div class="card card-primary text-center" style="cursor:pointer; transition:all .5s ease-in-out;">
                                <img class="card-img-top" src="https://static3.avast.com/10001215/web/i/index2/for-home.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <div class="badge badge-primary badge-sm">FOR STUDENTS</div>
                                    <div class="card-title">Your College Journey, Simplified</div>
                                    <p class="card-text">Thinking about joining an event? Our management system offer flexible system. From navigating registration to optimizing your event participation, we're here to ensure you have the best possible experience.</p>
                                </div>
                            </div>

                            <div class="card card-primary text-center" style="cursor:pointer; transition:all .5s ease-in-out;">
                                <img class="card-img-top" src="<?php echo base_url('assets/img/Card-primary/partner.png') ?>" alt="Card image cap">
                                <div class="card-body">
                                    <div class="badge badge-primary badge-sm">FOR ORGANIZERS</div>
                                    <div class="card-title">Elevate Your Events with Us</div>
                                    <p class="card-text">Event organizers, let's collaborate! Partner with us for seamless cooperation. We connect students with top colleges and organizers to create exceptional events at reasonable prices. Together, we can make events not just informative but also enriching and unforgettable.</p>
                                </div>
                            </div>

                            <div class="card card-primary text-center" style="cursor:pointer; transition:all .5s ease-in-out;">
                                <img class="card-img-top" src="https://static3.avast.com/10001215/web/i/index2/for-partners.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <div class="badge badge-primary badge-sm">FOR CAMPUS</div>
                                    <div class="card-title">Boost Your Event Success</div>
                                    <p class="card-text pb-3">Enhance your campus events with our services. Seamlessly integrated, our one-to-one consultations provide invaluable insights for successful event planning. Let's elevate the overall campus event experience and make your gatherings truly remarkable.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Details and Article -->
                        <!-- <h2 class="mt-5 pt-5" style="font-weight:800; color:black;">More details and articles</h2>
                        <div class="card-deck">
                            <div class="card card-secondary" style="cursor:pointer; transition:all .5s ease-in-out;">
                                <img class="card-img-top" src="<?php echo base_url('assets/img/Card-secondary/details1.jpg') ?>" alt="Card image cap">
                                <div class="card-body">
                                    <div class="card-title">How to choose the best organizers for yourself</div>
                                    <p class="card-text">Understand your goals and ambitions, and choose the organizers that suits you</p>
                                </div>
                                <div class="card-footer text-right mr-4">
                                    <a href="https://www.toporganizer.com/blog/how-choose-organizers-6-tips" target="_blank" class="btn btn-outline-secondary btn-icon-right">
                                        <span>LEARN MORE
                                            <img src="https://static3.avast.com/1/web/i/v2/components/arrow-m-right-orange.png" height="24">
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-secondary" style="cursor:pointer; transition:all .5s ease-in-out;">
                                <img class="card-img-top" src="<?php echo base_url('assets/img/Card-secondary/details2.jpg') ?>" alt="Card image cap">
                                <div class="card-body">
                                    <div class="card-title">Certificates that are globally accredited</div>
                                    <p class="card-text">Understand which certificate in the market has workplace priority and is certified around the world</p>
                                </div>
                                <div class="card-footer text-right mr-4">
                                    <a href="https://www.worldcertification.org" target="_blank" class="btn btn-outline-secondary btn-icon-right">
                                        <span>LEARN MORE
                                            <img src="https://static3.avast.com/1/web/i/v2/components/arrow-m-right-orange.png" height="24">
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-secondary" style="cursor:pointer; transition:all .5s ease-in-out;">
                                <img class="card-img-top" src="<?php echo base_url('assets/img/Card-secondary/details3.jpg') ?>" alt="Card image cap">
                                <div class="card-body">
                                    <div class="card-title">Top organizer in the world</div>
                                    <p class="card-text">Top organizer are the catalyst for attracting the brightest talents and international partner for academic collaboration</p>
                                </div>
                                <div class="card-footer text-right mr-4">
                                    <a href="https://www.toporganizer.com/organizers-rankings/world-organizers-rankings/2021" target="_blank" class="btn btn-outline-secondary btn-icon-right">
                                        <span>LEARN MORE
                                            <img src="https://static3.avast.com/1/web/i/v2/components/arrow-m-right-orange.png" height="24">
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-secondary" style="cursor:pointer; transition:all .5s ease-in-out;">
                                <img class="card-img-top" src="<?php echo base_url('assets/img/Card-secondary/details4.jpg') ?>" alt="Card image cap">
                                <div class="card-body">
                                    <div class="card-title">Top organizer graduate employability ranking</div>
                                    <p class="card-text">Gain an insight into your chances of getting employed upon graduation</p>
                                </div>
                                <div class="card-footer text-right mr-4">
                                    <a href="https://www.toporganizer.com/organizers-rankings/employability-rankings/2020" target="_blank" class="btn btn-outline-secondary btn-icon-right">
                                        <span>LEARN MORE
                                            <img src="https://static3.avast.com/1/web/i/v2/components/arrow-m-right-orange.png" height="24">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div> -->

                        <!-- Awards -->
                        <!-- <div class="awards-container mt-5">
                            <h2>EventHub with Awards</h2>
                            <div class="card-deck">
                                <div class="card card-awards text-center">
                                    <div class="card-img-top">
                                        <img src="https://static3.avast.com/10001215/web/i/awards-v12/white/awards-cnet.png" alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <div class="card-title">Top ranking in Web Marketing Association’s 2021 WebAward Competition</div>
                                    </div>
                                </div>
                                <div class="card card-awards text-center">
                                    <div class="card-img-top">
                                        <img src="https://static3.avast.com/10001215/web/i/awards-v12/logo-pcmag-2.png" alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <div class="card-title">Best Free Anti-malware</div>
                                    </div>
                                </div>
                                <div class="card card-awards text-center">
                                    <div class="card-img-top">
                                        <img src="https://static3.avast.com/10001215/web/i/awards-v12/white/awards-av-comparatives.png" alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <div class="card-title">Antivirus with the lowest impact on PC performance</div>
                                    </div>
                                </div>
                                <div class="card card-awards text-center">
                                    <div class="card-img-top">
                                        <img src="https://static3.avast.com/10001215/web/i/awards-v12/white/awards-softpedia.png" alt="Card image cap">
                                    </div>
                                    <div class="card-body">
                                        <div class="card-title">Official download partner</div>
                                    </div>
                                </div>
                            </div>
                        </div> -->


                    </main>



                    <!-- Overview -->
                    <section>
                        <div class="grid-flex mt-5 pt-5">
                            <div class="col col-image" style="background-image: url('<?php echo base_url('assets/img/Overview/Short1.png'); ?>');">
                            </div>
                            <div class="col col-text">
                                <div class="Aligner-item">
                                    <h1 class="overview">How EventHub can help you</h1>
                                    <p class="overview mt-4" style="animation: left_to_right 2s ease; width: 100%;">At EventHub, our academic counsellors connects ambitions with possibilities and expectations with experience.
                                        We guide and inspire students to choose the best college / organizers confidently and provide the most professional advice to students.</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid-flex">
                            <div class="col col-image" style="background-image: url('<?php echo base_url('assets/img/Overview/Short2.png'); ?>');">
                                &nbsp;
                            </div>
                            <div class="col col-text col-left">
                                <div class="Aligner-item">
                                    <h1 class="overview">Partners around the world</h1>
                                    <p class="overview mt-4" style="animation: left_to_right 2s ease; width: 100%;">We have organizers partners around the world, let us help you find the right one.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="grid-flex">
                            <div class="col col-image" style="background-image: url('<?php echo base_url('assets/img/Overview/Short3.png'); ?>');">
                                &nbsp;
                            </div>
                            <div class="col col-text">
                                <div class="Aligner-item">
                                    <h1 class="overview">Join Our Team</h1>
                                    <p class="overview mt-4" style="animation: left_to_right 2s ease; width: 100%;">Passionate about the field of education and interested in being part of EventHub? Hit the registeration button and be part of the team.</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->