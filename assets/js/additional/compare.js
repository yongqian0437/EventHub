var add_third_selection = 0;

$(document).ready(function () {
	$("#selection1").hide();
	$("#selection2").hide();

	$("#card0").hide();
	$("#card1").hide();
	$("#card2").hide();

	$("#event_class_1").hide();
	$("#event_class_2").hide();
	$("#event_class_3").hide();
	$("#third_selection").hide();

	$("#selection1").fadeIn(3000);
	$("#selection2").fadeIn(4500);
	$("#card0").fadeIn(1500);
	$("#card1").fadeIn(3000);
	$("#card2").fadeIn(4500);

	//third selection
	$("#selection3").hide();
	$("#third_selection").hide();

	//ajax for 1st events dropdown
	$("#university_1, #level_1").change(function () {
		var uni1 = document.getElementById("university_1").value;
		var level1 = document.getElementById("level_1").value;

		if (uni1 != "" && level1 != "") {
			$("#event_class_1").fadeIn(1000);

			$.ajax({
				url: base_url + "external/Compare/fetch_events",
				method: "POST",
				data: {
					organizer_id: $("#university_1").val(),
					event_level: $("#level_1").val(),
				},
				success: function (data) {
					$("#event_1").html(data);
				},
			});
		}
	});

	//ajax for 2nd events dropdown
	$("#university_2, #level_2").change(function () {
		var uni2 = document.getElementById("university_2").value;
		var level2 = document.getElementById("level_2").value;

		if (uni2 != "" && level2 != "") {
			$("#event_class_2").fadeIn(1000);

			$.ajax({
				url: base_url + "external/Compare/fetch_events",
				method: "POST",
				data: {
					organizer_id: $("#university_2").val(),
					event_level: $("#level_2").val(),
				},
				success: function (data) {
					$("#event_2").html(data);
				},
			});
		}
	});

	//ajax for 3nd events dropdown
	$("#university_3, #level_3").change(function () {
		var uni3 = document.getElementById("university_3").value;
		var level3 = document.getElementById("level_3").value;

		if (uni3 != "" && level3 != "") {
			$("#event_class_3").fadeIn(1000);

			$.ajax({
				url: base_url + "external/Compare/fetch_events",
				method: "POST",
				data: {
					organizer_id: $("#university_3").val(),
					event_level: $("#level_3").val(),
				},
				success: function (data) {
					$("#event_3").html(data);
				},
			});
		}
	});
}); // end of ready function

function generateTable() {
	var event1 = document.getElementById("event_1").value;
	var event2 = document.getElementById("event_2").value;
	var event3 = document.getElementById("event_3").value;

	if (add_third_selection == 1) {
		if (event1 != "" && event2 != "" && event3 != "") {
			$.ajax({
				url: base_url + "external/Compare/fetch_table",
				method: "POST",
				data: {
					organizer_id1: $("#university_1").val(),
					organizer_id2: $("#university_2").val(),
					organizer_id3: $("#university_3").val(),
					event_id1: $("#event_1").val(),
					event_id2: $("#event_2").val(),
					event_id3: $("#event_3").val(),
				},
				success: function (data) {
					$("#table_view").html(data);
					$("h3").empty().append("Compare Table");
				},
			});
			$("#table_view").hide();
			$("#table_view").fadeIn(2000);
		} else {
			swal.fire({
				title: "Try Again",
				text: "Please fill in all information.",
				icon: "error",
				button: "OK",
			});
		}
	} else {
		if (event1 != "" && event2 != "") {
			$.ajax({
				url: base_url + "external/Compare/fetch_table_for_2events",
				method: "POST",
				data: {
					organizer_id1: $("#university_1").val(),
					organizer_id2: $("#university_2").val(),
					event_id1: $("#event_1").val(),
					event_id2: $("#event_2").val(),
				},
				success: function (data) {
					$("#table_view").html(data);
					$("h3").empty().append("Compare Table");
				},
			});
			$("#table_view").hide();
			$("#table_view").fadeIn(2000);
		} else {
			swal.fire({
				title: "Try Again",
				text: "Please fill in all information.",
				icon: "error",
				button: "OK",
			});
		}
	}
}

function addThirdSelection() {
	$("#selectionbtn").hide();
	$("#forth_selection").hide();

	$("#selection3").fadeIn(3000);
	$("#third_selection").fadeIn(3000);

	add_third_selection = 1;
}

function removeThirdSelection() {
	$("#selection3").hide();
	$("#third_selection").hide();

	$("#selectionbtn").show();
	$("#forth_selection").show();

	add_third_selection = 0;
}
