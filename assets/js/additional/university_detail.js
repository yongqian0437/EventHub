$(document).ready(function () {
	//default ajax to get all course for a university
	$.ajax({
		url: base_url + "external/Universities/fetch_course_list",
		method: "POST",
		data: { event_type: $("#course_field").val(), uni_id: uni_id },
		success: function (data) {
			$("#course_list").html(data);
		},
	});

	//ajax to filter the course base on course field input

	$("#course_field").change(function () {
		$.ajax({
			url: base_url + "external/Universities/fetch_course_list",
			method: "POST",
			data: { event_type: $("#course_field").val(), uni_id: uni_id },
			success: function (data) {
				$("#course_list").html(data);
			},
		});
	});
}); // end of ready function
