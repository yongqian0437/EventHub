<link href="<?php echo base_url() ?>/assets/scss/about_us.scss" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

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
                <div class="container-fluid px-0">

                    <header class=" col px-0 about-us-header">
                        <div class="about-background-img img-fluid" style="background-image:url('<?php echo base_url('assets/img/about_us/global.jpg'); ?>'); height:21rem; widht:100%;">
                            <div class="dark-background ">
                                <h1 class="pb-2">About Us</h1>
                                <p class="pb-4">
                                    Welcome to EventHub, your go-to platform for seamless campus event management! Created with the vision of enhancing campus life experiences, EventHub brings together students and organizers to create memorable events that enrich our university community.
                                </p>
                            </div>
                        </div>
                    </header>

                    <!-- Overview -->
                    <section>
                        <div class="grid-flex">
                            <div class="col px-0 about-card h-100" data-aos="fade">
                                <div class="col-image about-background-img img-fluid" style="background-image:url('<?php echo base_url('assets/img/about_us/mission&vision_background.png'); ?>');">
                                    <div class="dark-background">
                                        <div class="card-content1 card-text">
                                            <h3 data-aos="slide-left" style="margin-left:2rem; margin-right:auto;">Mission and Vision</h3>
                                            <div class="card-p-left">
                                                <p data-aos="slide-right">
                                                    EventHub's mission is to foster a vibrant campus life by connecting students and organizers through a user-friendly and efficient event management system. We aim to create a dynamic community where students can easily discover events that align with their interests, while organizers can showcase their talents and build connections to ensure the success of their events. Together, we believe that campus life can be an enriching journey filled with diverse experiences, collaboration, and personal growth.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="grid-flex">
                            <div class=" col px-0 about-card h-100" data-aos="slide-up" data-aos-duration="2000">
                                <div class="about-background-img img-fluid" style="background-image:url('<?php echo base_url('assets/img/about_us/who_are_we_background.jpg'); ?>');">
                                    <div class="dark-background ">
                                        <div class="card-content2 card-text">
                                            <h3 data-aos="flip-left" data-aos-duration="2000" style="margin-right:2rem; margin-left:auto;">EventHub</h3>
                                            <div class="card-p-right">
                                                <p data-aos="flip-left" data-aos-duration="2000">
                                                    We are committed to continuously improving EventHub based on user feedback and evolving campus needs. Join us in shaping the campus event landscape, fostering a sense of community, and making unforgettable memories at every event. Together, let's embrace the spirit of creativity, innovation, and camaraderie through EventHub, your ultimate campus event management system.
                                                    <br>
                                                    <br>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col col-image" style="background-image: url('');">
                                &nbsp;
                            </div>
                            <div class="col col-text col-left">
                                <div class="Aligner-item">
                                    <h1 class="overview">Partners around the world</h1>
                                    <p class="overview mt-4" style="animation: left_to_right 2s ease; width: 100%;">We have university partners around the world, let us help you find the right one.
                                    </p>
                                </div>
                            </div> -->
                        </div>

                        <!-- <div class="grid-flex">
                            <div class="col px-0 about-card-center" data-aos="zoom-out-up" data-aos-duration="3000">
                                <div class="about-background-img img-fluid" style="background-image:url('<?php echo base_url('assets/img/about_us/awards_background.jpeg'); ?>');">
                                    <div class="dark-background ">
                                        <h3 data-aos="slide-left" data-aos-duration="2000">EventHub Awards</h3>
                                        <div class="awards-container mt-5" data-aos="fade-right" data-aos-duration="3000">
                                            <div class="card-deck mx-2">
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
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        <!-- <div class="col col-image" style="background-image: url('');">
                                &nbsp;
                            </div>
                            <div class="col col-text">
                                <div class="Aligner-item">
                                    <h1 class="overview">Join Our Team</h1>
                                    <p class="overview mt-4" style="animation: left_to_right 2s ease; width: 100%;">Passionate about the field of education and interested in being part of EventHub? Hit the registeration button and be part of the team.</p>
                                </div>
                            </div> -->
                        <!-- </div> -->

                        <div class="grid-flex">
                            <div class="col px-0 about-card-center" data-aos="zoom-in" data-aos-duration="3000">
                                <div class="about-background-img img-fluid" style="background-image:url('<?php echo base_url('assets/img/about_us/contact_us_background.jpg'); ?>');">
                                    <div class="dark-background ">
                                        <h3 data-aos="flip-left" data-aos-duration="3000" style="margin-right:2rem; margin-left:auto; right:1rem;">Contact Us</h3>

                                        <div class="row contact-card justify-content-center" style="margin-left: 8rem; margin-right:8rem;">
                                            <div class="col-4" data-aos="slide-up" data-aos-duration="1000">
                                                <div class=" card card-secondary h-100" style="cursor:pointer; transition:all .5s ease-in-out; width:20rem;">
                                                    <img class="card-img-top" src="<?php echo base_url('assets/img/about_us/email_icon.png') ?>" alt="Card image cap">
                                                    <div class="card-body">
                                                        <div class="card-title">Email</div>
                                                        <p class="card-text">0125810@student.uow.edu.my
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4" data-aos="slide-up" data-aos-duration="2000">
                                                <div class="card card-secondary h-100" style="cursor:pointer; transition:all .5s ease-in-out; width:20rem;">
                                                    <img class="card-img-top" src="<?php echo base_url('assets/img/about_us/whatsapp_icon.png') ?>" alt="Card image cap">
                                                    <div class="card-body">
                                                        <div class="card-title">Whatsapp</div>
                                                        <p class="card-text">Malaysia: +60139836977</p>
                                                        <!-- <p class="card-text">International: +5151629</p> -->
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row">
                                                            <a href="https://wa.me/60139836977?text=Hello%20I%20am%20[name]%20from%20[country],%20I%20would%20like%20to%20know%20more%20about%20what%20EventHub%20offers.%20" target="_blank" class="btn btn-outline-secondary btn-icon-right">
                                                                <span style="color:black">Click here
                                                                    <img src="https://static3.avast.com/1/web/i/v2/components/arrow-m-right-orange.png" height="24">
                                                                </span>
                                                            </a>

                                                            <!-- <a href="https://wa.me/5151629?text=Hello%20I%20am%20[name]%20from%20[country],%20I%20would%20like%20to%20know%20more%20about%20what%20EventHub%20offers.%20" target="_blank" class="btn btn-outline-secondary btn-icon-right">
                                                                <span style="color:black">INTERNATIONAL
                                                                    <img src="https://static3.avast.com/1/web/i/v2/components/arrow-m-right-orange.png" height="24">
                                                                </span>
                                                            </a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4" data-aos="slide-up" data-aos-duration="3000">
                                                <div class="card card-secondary h-100" style="cursor:pointer; transition:all .5s ease-in-out; width:20rem;">
                                                    <img class="card-img-top" src="<?php echo base_url('assets/img/about_us/chat_icon.jpg') ?>" alt="Card image cap">
                                                    <div class="card-body">
                                                        <div class="card-title">Chat with Bot</div>
                                                        <p class="card-text">Have any inquiries? Chat with our ChatBot to know more information here.</p>
                                                    </div>
                                                    <div class="card-footer">
                                                        <a href="<?= base_url('user/chat/Chat'); ?>" target="_blank" class="btn btn-outline-secondary btn-icon-right" style="background-color:">
                                                            <span style=" color:black">CLICK ME
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col col-image" style="background-image: url('');">
                                &nbsp;
                            </div>
                            <div class="col col-text">
                                <div class="Aligner-item">
                                    <h1 class="overview">Join Our Team</h1>
                                    <p class="overview mt-4" style="animation: left_to_right 2s ease; width: 100%;">Passionate about the field of education and interested in being part of EventHub? Hit the registeration button and be part of the team.</p>
                                </div>
                            </div> -->
                        </div>
                    </section>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->





            <!-- 
                        <section class="card about-card mb-2" data-aos="fade">

                        </section>

                        <section class="card about-card" data-aos="slide-up" data-aos-duration="2000">

                        </section>

                        <section class="card about-card-center" data-aos="zoom-out-up" data-aos-duration="3000">
                            
                        </section>

                        <section class="card about-card-center" data-aos="zoom-in" data-aos-duration="3000">
                            
                        </section> -->

            <!-- <div class="social-media pt-5">
                <div class="row mx-2">
                    <h4 class="mx-2">Follow Us On:</h4>
                    <img class="mx-2 pb-1" src="<?php echo base_url('assets/img/about_us/facebook-logo.png') ?>" alt="Facebook" href="#" target="_blank">
                    <img class="mx-2 pb-1" src="<?php echo base_url('assets/img/about_us/instagram-logo.png') ?>" alt="Instagram" href="#" target="_blank">
                    <a href="https://newinti.edu.my/" target="_blank">
                        <img class="mx-2 pb-1" src="<?php echo base_url('assets/img/about_us/inti_logo.png') ?>" alt="Inti">
                    </a>
                </div>
            </div> -->


            <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
            <script>
                AOS.init();
            </script>