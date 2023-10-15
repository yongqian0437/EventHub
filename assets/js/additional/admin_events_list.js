$(document).ready(function () {
	var t = $("#table_admin_events").DataTable({
		//make table responsive
		bAutoWidth: false,
		ajax: {
			url:
				base_url +
				"internal/admin_panel/content/Admin_events/admin_events_list",
			type: "GET",
		},
		columnDefs: [
			{
				width: "17%",
				targets: [3],
			},
			{
				width: "15%",
				targets: [4],
			},
			{
				searchable: false,
				targets: 0,
			},
		],
	});
	t.on("order.dt search.dt", function () {
		t.column(0, { search: "applied", order: "applied" })
			.nodes()
			.each(function (cell, i) {
				cell.innerHTML = i + 1;
			});
	}).draw();
}); // end of ready function

function view_admin_event(event_id) {
	$.ajax({
		url:
			base_url + "internal/admin_panel/content/Admin_events/view_admin_event",
		method: "POST",
		data: { event_id: event_id },
		success: function (data) {
			$("#admin_event_information").html(data);
		},
	});
}
