$(document).ready(function () {
	//ajax for 1st events dropdown
	$("#university_1").change(function () {
		var uni1 = document.getElementById("university_1").value;

		if (uni1 != "") {
			$("#event_class_1").fadeIn(1000);

			$.ajax({
				url:
					base_url +
					"internal/level_2/education_agent/ea_event_application/fetch_events",
				method: "POST",
				data: { uni_id: $("#university_1").val() },
				success: function (data) {
					$("#event_1").html(data);
				},
			});
		}
	});
}); // end of ready function
