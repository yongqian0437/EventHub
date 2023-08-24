<style>
th{
    color:black;
}
td{
    color: rgba(0,0,0,0.7);
}
</style>

<!-- Content Wrapper -->
<div id="content-wrapper" >

<!-- Main Content -->
<div id="content">    
    
    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Education Agents</h1>
    </div>

    <!-- Breadcrumb -->
    <div class="row" >
        <div class="breadcrumb-wrapper col-xl-9">
            <ol class="breadcrumb" style = "background-color:rgba(0, 0, 0, 0);">
                <li class="breadcrumb-item">
                    <a href="<?=base_url('internal/admin_panel/Admin_dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a>
                </li>
                <li class="breadcrumb-item active">Education Agents</li>
            </ol>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Education Agents</h6>
        </div>
        <div class="card-body">
        <div class="table-responsive">
                <table id="dataTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Contact Number</th>
                            <th>Business Email</th>
                            <th>Nationality</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Document</th>
                            <th>Submitted Date</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php $count=1;?>
                    <?php foreach($ealist->result() as $ea):?>
                    
                    <?php
                        echo "<tr>"
                            ."<td>$count</td>"
                            ."<td>$ea->user_fname $ea->user_lname</td>"
                            ."<td>$ea->ea_phonenumber</td>"
                            ."<td>$ea->ea_businessemail</td>"
                            ."<td>$ea->ea_nationality</td>"
                            ."<td>$ea->ea_gender</td>"
                            ."<td>$ea->ea_dob</td>"
                            ."<td style='text-align:center'><a class='btn btn-info ' href='"
                            .base_url()
                            ."assets/uploads/education_agents/$ea->ea_document' role='button' target='_blank'><span class='fas fa-eye'></span></a></td>"  
                            ."<td>$ea->ea_submitdate</td>" 
                            ."</tr>" 
                    ?>
                    <?php $count++; ?>
                    <?php endforeach ;?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
</div>

