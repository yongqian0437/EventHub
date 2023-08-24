<script src="<?php echo base_url()?>/assets/vendor/jquery/jquery.min.js"></script>

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

                    <!-- Total Employer Projects (EPs) -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href = "<?php echo base_url('internal/level_2/employer/employer_emps');?>" style = "text-decoration:none">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Employer Projects</div>
                                        <div id="emp_counter" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <!-- Total Approved EPs -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href = "<?php echo base_url('internal/level_2/employer/employer_emps');?>" style = "text-decoration:none">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Approved EPs</div>
                                        <div id="approved_emp_counter" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <!-- Total Pending EPs -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href = "<?php echo base_url('internal/level_2/employer/employer_emps');?>" style = "text-decoration:none">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pending EPs</div>
                                        <div id="pending_emp_counter" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-history fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <!-- Total EP Applicants -->
                    <div class="col-xl-3 col-md-6 mb-4">
                    <a href = "<?php echo base_url('internal/level_2/employer/employer_emp_applicants');?>" style = "text-decoration:none">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            EP Applicants</div>
                                        <div id="emp_app_counter" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                    </div>
                                    <div class="col-auto">
                                    <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    
                </div>
                <div class ="row">
                    <div class="col-xl-12 col-lg-12">
                         <!-- Bar Chart -->
                         <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">EP Applicants by Top 5 Countries</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="emp_app_barChart"></canvas>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <script>
                var counter1 = <?=$num_emps?>;
                var counter2 = <?=$num_approved_emps?>;
                var counter3 = <?=$num_pending_emps?>;
                var counter4 = <?=$num_emp_applicants?>;

                // Bar Chart
                var ctx = document.getElementById("emp_app_barChart");
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php $counter=0; foreach($total_applicants as $row): ?>"<?php if ($counter<5) { echo $row['student_nationality']; } $counter++;?>", <?php endforeach; ?>],
                        datasets: [{
                            label: "Applicants",
                            backgroundColor: ["#3bceac", "#ff99c8", "#ca7df9", "#758bfd", "#ffc09f"],
                            borderColor: "#4e73df",
                            data: [<?php  $counter=0; foreach($total_applicants as $row): ?>"<?php if ($counter<5) { echo $row['count(emp_applicants.emp_applicant_id)']; } $counter++;?>", <?php endforeach; ?>],
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