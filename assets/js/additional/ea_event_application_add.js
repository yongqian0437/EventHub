$(document).ready(function () {
	$("#event_class_1").hide();
	//ajax for 1st events dropdown
	$("#organizers_1").change(function () {
		var uni1 = document.getElementById("organizers_1").value;

		if (uni1 != "") {
			$("#event_class_1").fadeIn(1000);

			$.ajax({
				url:
					base_url +
					"internal/level_2/education_agent/ea_event_application/fetch_events",
				method: "POST",
				data: { organizer_id: $("#organizers_1").val() },
				success: function (data) {
					$("#event_1").html(data);
				},
			});
		}
	});
}); // end of ready function
