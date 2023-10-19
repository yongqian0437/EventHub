$(document).ready(function () {
	//default ajax to get all event for a university
	$.ajax({
		url: base_url + "external/Universities/fetch_event_list",
		method: "POST",
		data: { event_type: $("#event_field").val(), organizer_id: organizer_id },
		success: function (data) {
			$("#event_list").html(data);
		},
	});

	//ajax to filter the event base on event field input

	$("#event_field").change(function () {
		$.ajax({
			url: base_url + "external/Universities/fetch_event_list",
			method: "POST",
			data: { event_type: $("#event_field").val(), organizer_id: organizer_id },
			success: function (data) {
				$("#event_list").html(data);
			},
		});
	});
}); // end of ready function
