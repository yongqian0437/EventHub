$(document).ready(function () {
	var t = $("#table_events").DataTable({
		//make table responsive
		bAutoWidth: false,
		ajax: {
			url:
				base_url + "internal/level_2/educational_partner/ep_events/course_list",
			type: "GET",
		},
		columnDefs: [
			{
				width: "18%",
				targets: [6],
			},
			{
				width: "17%",
				targets: [2],
			},
			{
				width: "25%",
				targets: [1],
			},
			{
				width: "8%",
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

function delete_course(course_id) {
	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url:
					base_url +
					"internal/level_2/educational_partner/ep_events/delete_course",
				method: "POST",
				data: { course_id: course_id },
				success: function (data) {
					Swal.fire("Deleted!", "Course has been deleted.", "success");

					//reload datatable
					var xin_table = $("#table_events").DataTable();
					xin_table.ajax.reload(null, false);
				},
			});
		}
	});
}

function view_course(course_id) {
	$.ajax({
		url:
			base_url + "internal/level_2/educational_partner/ep_events/view_course",
		method: "POST",
		data: { course_id: course_id },
		success: function (data) {
			$("#course_information").html(data);
		},
	});
}
