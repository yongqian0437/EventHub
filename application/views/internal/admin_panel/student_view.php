<style>
    th {
        color: black;
    }

    td {
        color: rgba(0, 0, 0, 0.7);
    }
</style>

<!-- Content Wrapper -->
<div id="content-wrapper">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Students</h1>
            </div>

            <!-- Breadcrumb -->
            <div class="row">
                <div class="breadcrumb-wrapper col-xl-9">
                    <ol class="breadcrumb" style="background-color:rgba(0, 0, 0, 0);">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('internal/admin_panel/Admin_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </div>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Students</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Full Name</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>Nationality</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>Interest</th>
                                    <th>Current Level</th>
                                    <th>Register Date</th>
                                    <th>Report</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $count = 1; ?>
                                <?php foreach ($studentlist->result() as $student) : ?>
                                    <?php
                                    echo "<tr>"
                                        . "<td>$count</td>"
                                        . "<td>$student->user_fname $student->user_lname</td>"
                                        . "<td>$student->student_phonenumber</td>"
                                        . "<td>$student->user_email</td>"
                                        . "<td>$student->student_nationality</td>"
                                        . "<td>$student->student_gender</td>"
                                        . "<td>$student->student_dob</td>"
                                        . "<td>$student->student_interest</td>"
                                        . "<td>$student->student_currentlevel</td>"
                                        . "<td>$student->student_submitdate</td>"
                                        . "</tr>"
                                    ?>
                                    <?php $count++; ?>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>