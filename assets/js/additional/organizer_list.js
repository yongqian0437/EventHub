$(document).ready(function () {
	$("#table_organizers").DataTable({
		bInfo: false, //remove 'showing entires * out of *
		ordering: false, //remove order(up down icon) for each attributes
		ajax: {
			url: base_url + "external/organizer/organizer_list",
			type: "GET",
		},
		columnDefs: [
			{
				width: "15%",
				targets: [5],
			},
			{
				width: "20%",
				targets: [0],
			},
			{
				width: "13%",
				targets: [4],
			},
		],
	});

	//Styling for search bar in datatables
	$('.dataTables_filter input[type="search Event"]')
		.attr("placeholder", "Search")
		.css({
			width: "350px",
			height: "40px",
			"font-size": "17px",
			"margin-bottom": "30px",
			"margin-right": "40px",
			display: "inline-block",
		});

	//Styling for pagination in datatables
	$(".dataTables_length").css({
		"margin-top": "20px",
		display: "inline-block",
	});
}); // end of ready function
