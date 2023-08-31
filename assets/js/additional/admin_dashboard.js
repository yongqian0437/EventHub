$(document).ready(function () {
	function update_student_count() {
		$("#student_counter").animate(
			{
				counter: counter1,
			},
			{
				duration: 2000,
				easing: "swing",
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: update_student_count,
			}
		);
	}
	update_student_count();

	function update_e_count() {
		$("#e_counter").animate(
			{
				counter: counter2,
			},
			{
				duration: 2000,
				easing: "swing",
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: update_e_count,
			}
		);
	}
	update_e_count();

	function update_ea_count() {
		$("#ea_counter").animate(
			{
				counter: counter3,
			},
			{
				duration: 2000,
				easing: "swing",
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: update_ea_count,
			}
		);
	}
	update_ea_count();

	function update_ac_count() {
		$("#ac_counter").animate(
			{
				counter: counter4,
			},
			{
				duration: 2000,
				easing: "swing",
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: update_ac_count,
			}
		);
	}
	update_ac_count();

	function update_ep_count() {
		$("#ep_counter").animate(
			{
				counter: counter5,
			},
			{
				duration: 2000,
				easing: "swing",
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: update_ep_count,
			}
		);
	}
	update_ep_count();
}); // end of ready function

// Area Chart Example
var ctx = document.getElementById("userChartArea");
var myLineChart = new Chart(ctx, {
	type: "line",
	data: {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
		datasets: [
			{
				label: "Total Users",
				lineTension: 0.3,
				backgroundColor: "rgba(78, 115, 223, 0.05)",
				borderColor: "rgba(78, 115, 223, 1)",
				pointRadius: 3,
				pointBackgroundColor: "rgba(78, 115, 223, 1)",
				pointBorderColor: "rgba(78, 115, 223, 1)",
				pointHoverRadius: 3,
				pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
				pointHoverBorderColor: "rgba(78, 115, 223, 1)",
				pointHitRadius: 10,
				pointBorderWidth: 2,
				data: [Jan, Feb, Mar, Apr, May, Jun, Jul],
			},
		],
	},
	options: {
		maintainAspectRatio: false,
		layout: {
			padding: {
				left: 10,
				right: 25,
				top: 25,
				bottom: 0,
			},
		},
		scales: {
			xAxes: [
				{
					time: {
						unit: "date",
					},
					gridLines: {
						display: false,
						drawBorder: false,
					},
					ticks: {
						maxTicksLimit: 7,
					},
				},
			],
			yAxes: [
				{
					ticks: {
						min: 0,
						maxTicksLimit: 10,
						padding: 10,
					},
					gridLines: {
						color: "rgb(234, 236, 244)",
						zeroLineColor: "rgb(234, 236, 244)",
						drawBorder: false,
						borderDash: [2],
						zeroLineBorderDash: [2],
					},
				},
			],
		},
		legend: {
			display: false,
		},
		tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			titleMarginBottom: 10,
			titleFontColor: "#6e707e",
			titleFontSize: 14,
			borderColor: "#dddfeb",
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: false,
			intersect: false,
			mode: "index",
			caretPadding: 10,
			callbacks: {
				label: function (tooltipItem, chart) {
					var datasetLabel =
						chart.datasets[tooltipItem.datasetIndex].label || "";
					return datasetLabel + ": " + number_format(tooltipItem.yLabel);
				},
			},
		},
	},
});

var ctx = document.getElementById("enrollment_donut");
var myPieChart = new Chart(ctx, {
	type: "doughnut",
	data: {
		labels: ["Student", "Education Agent"],
		datasets: [
			{
				data: [s_applicant, ea_applicant],
				backgroundColor: ["#4e73df", "#1cc88a"],
				hoverBackgroundColor: ["#2e59d9", "#17a673"],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
			},
		],
	},
	options: {
		maintainAspectRatio: false,
		tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			borderColor: "#dddfeb",
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: false,
			caretPadding: 10,
		},
		legend: {
			display: true,
		},
		cutoutPercentage: 80,
	},
});

/* var ctx1 = document.getElementById("uni_pie");
var myChart = new Chart(ctx1, {
  type: 'pie',
  data: {
    labels: ["Active Universities", "Pending Universities"],
    datasets: [{
      backgroundColor: ["#3e95cd", "#8e5ea2"],
      data: [active_uni,pending_uni]
    }]
  },
  options: {
    title: {
      display: true,
      text: 'Universities in EventHub'
    }
  }
}); */
