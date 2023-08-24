<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/assets/vendor/chart.js/Chart.min.js"></script>

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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Card 1 - Total Course Applicant -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href = "<?php echo base_url('internal/level_2/academic_counsellor/ac_course_applicants');?>" style = "text-decoration:none">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body" href="">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Course Applicants</div>
                                            <div id="course_applicants_counter" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                        <!-- Card 2 - Course Applicants applied by Students -->
                        <div class="col-xl-4 col-md-6 mb-4">
                        <a href = "<?php echo base_url('internal/level_2/academic_counsellor/ac_course_applicants');?>" style = "text-decoration:none">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Applied by Students</div>
                                            <div id="students_counter" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>

                        <!--Card 3 - Course Applicants applied by Education Agents -->
                        <div class="col-xl-4 col-md-6 mb-4">
                        <a href = "<?php echo base_url('internal/level_2/academic_counsellor/ac_course_applicants');?>" style = "text-decoration:none">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Applied by Education Agents</div>
                                            <div id="ea_counter" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
                    </div>
                <!-- Bar Chart -->
                <div class ="row">
                    <div class="col-xl-12 col-lg-12">
                         <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Course Applicants by Top 5 Countries</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="course_applicant_barChart"></canvas>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                </div>
                <!-- /.container-fluid -->

            <!-- End of Main Content -->

            <script>
                var counter1 = <?= $total_course_applicants ?>;
                var counter2 = <?= $total_by_students ?>;
                var counter3 = <?= $total_by_ea ?>;

                 // Bar Chart
                 var ctx = document.getElementById("course_applicant_barChart");
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php $counter=0; foreach($total_course_app as $row): ?>"<?php if ($counter<5) { echo $row['c_applicant_nationality']; } $counter++;?>", <?php endforeach; ?>],
                        datasets: [{
                            label: "Applicants",
                            backgroundColor: ["#3bceac", "#ff99c8", "#ca7df9", "#758bfd", "#ffc09f"],
                            borderColor: "#4e73df",
                            data: [<?php  $counter=0; foreach($total_course_app as $row): ?>"<?php if ($counter<5) { echo $row['count(course_applicants.c_applicant_id)']; } $counter++;?>", <?php endforeach; ?>],
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'month'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 5
                                },
                                maxBarThickness: 25,
                            }],
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: 6,
                                    maxTicksLimit: 5,
                                    padding: 10,
                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                }
                            }
                        },
                    }
                });

            </script>