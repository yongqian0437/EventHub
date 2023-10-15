$(document).ready(function () {
	var t = $("#admin_event_applicant").DataTable({
		//make table responsive
		bAutoWidth: false,
		ajax: {
			url:
				base_url +
				"internal/admin_panel/applicants/Admin_event_application/admin_event_application_list",
			type: "GET",
		},
	});

	t.on("order.dt search.dt", function () {
		t.column(0, { search: "applied", order: "applied" })
			.nodes()
			.each(function (cell, i) {
				cell.innerHTML = i + 1;
			});
	}).draw();

	$(window).resize(function () {
		oTable.fnDraw(false);
	});
}); // end of ready function

function view_admin_event_applicant(e_applicant_id) {
	$.ajax({
		url:
			base_url +
			"internal/admin_panel/applicants/Admin_event_application/view_admin_event_applicant",
		method: "POST",
		data: { e_applicant_id: e_applicant_id },
		success: function (data) {
			$("#admin_event_application_information").html(data);
		},
	});
}
