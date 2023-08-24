<!-- Jquery plugin -->
<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>

<?php $this->load->view('external/templates/topnav'); ?>

<body id="page-top" style='background-color:#f9f6f1;'>

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Begin Page Content -->
				<div class="container-fluid ">

					<!-- Cards for registration -->
					<div class="row justify-content-md-center pt-5 pb-5" style='background-color:#f9f6f1;'>

						<!-- Steps -->
						<div class="col-xl-4">
							<div class="card h-100" id='card1' style="border-radius:20px;">
								<div class="card-body" style="background-color:#61677A;border-radius:20px">

									<div class="pl-3 pr-3 pt-1">
										<div class="pl-4" style="font-size:16px; font-weight:700; color:black;"></div>
										<div class="" style="font-size:30px; color:white; font-weight:900; text-align:center;">Personal Data</div>

										<fieldset disabled>
											<div class="form-group pt-2">
												<input type="text" style="background-color: white; font-weight:700;" id="disabledTextInput" class="form-control" placeholder="Last Name: <?php echo $this->session->userdata('user_lname') ?>">
											</div>
											<div class="form-group">
												<input type="text" style="background-color: white; font-weight:700;" id="disabledTextInput" class="form-control" placeholder="First Name: <?php echo $this->session->userdata('user_fname') ?>">
											</div>
											<div class="form-group">
												<input type="text" style="background-color: white; font-weight:700;" id="disabledTextInput" class="form-control" placeholder="Gender: <?php echo $student_data->student_gender; ?>">
											</div>
											<div class="form-group">
												<input type="text" style="background-color: white; font-weight:700;" id="disabledTextInput" class="form-control" placeholder="Email: <?php echo $this->session->userdata('user_email'); ?>">
											</div>
											<div class="form-group">
												<input type="text" style="background-color: white; font-weight:700;" id="disabledTextInput" class="form-control" placeholder="Phone Number: <?php echo $student_data->student_phonenumber; ?>">
											</div>
											<div class="form-group">
												<input type="text" style="background-color: white; font-weight:700;" id="disabledTextInput" class="form-control" placeholder="Nationality: <?php echo $student_data->student_nationality; ?>">
											</div>
											<div class="form-group">
												<input type="text" style="background-color: white; font-weight:700;" id="disabledTextInput" class="form-control" placeholder="Date of Birth: <?php echo $student_data->student_dob; ?>">
											</div>
										</fieldset>

									</div>
								</div>
							</div>
						</div>

						<!-- Form -->
						<div class="col-xl-6 ">
							<div class="card h-100" id='card2'>
								<div class=" card-body">
									<center>
										<div class="pt-5 px-5" style="font-size:23px; letter-spacing: 8px; color:#787878; font-weight:700;">EVENT APPLICANT REGISTRATION PAGE</div>
									</center>
									<!-- Input fields (Form) -->
									<!-- <?php // $link="" 
												?> -->
									<form method="post" action=" <?= base_url('external/Courses/submit_courses_applicant_form/' . $course_id); ?> " enctype="multipart/form-data">
										<?= form_open_multipart('') ?>
										<!-- Application Identification -->
										<div class="form-row pt-3 px-3">
											<div class="form-group col-md-12 px-2">
												<input type="text" name="c_applicant_identification" class="form-control border-bottom" id="c_applicant_identification" style="border: 0;" placeholder="Enter Student ID" required>
											</div>
										</div>
										<!-- Applicant Address -->
										<div class="form-row pt-3 px-3">
											<div class="form-group col-md-12 px-2">
												<input type="text" name="c_applicant_address" class="form-control border-bottom" id="c_applicant_address" style="border: 0;" placeholder="Enter Current Address" required>
											</div>
										</div>
										<!-- Upload Document -->
										<div class="form-row pt-4 px-4">
											<div class="form-group col-md-12 px-2">
												<input type="file" class="custom-file-input" id="customFile" name="c_applicant_document" accept="application/pdf" required>
												<label class="custom-file-label" for="customFile">Upload Student ID</label>
												<p style="font-size: 14px; color:red;">*Required picture: student id .PDF file format</p>
											</div>
										</div>

										<!-- Terms & Condition -->
										<div class="row justify-content-start mt-4 ml-2">
											<div class="col">
												<div class="form-check">
													<label class="form-check-label">
														<input type="checkbox" class="form-check-input" required>
														Please accept our <a href="https://newinti.edu.my/legal/privacy/">terms and conditions</a>
													</label>
												</div>
												<!-- Submit button -->
												<div class="pt-2 pr-3">
													<button type="submit" class="btn btn-success" style="float:right; width:23%;">Submit <i class="fas fa-check"></i></button>
												</div>

									</form>
									<!-- End of Input fields (Form) -->
								</div>
							</div>
						</div>

					</div>
					<!-- END OF ROW -->
					<!-- END OF FORM -->
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- End of Main Content -->

			<script>
				// File appear on select
				$(".custom-file-input").on("change", function() {
					var fileName = $(this).val().split("\\").pop();
					$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
				});
			</script>