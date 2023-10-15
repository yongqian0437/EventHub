$(document).ready(function () {
	function update_event_applicants_count() {
		$("#event_applicants_counter").animate(
			{
				counter: counter1,
			},
			{
				duration: 2000,
				easing: "swing",
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: update_event_applicants_count,
			}
		);
	}
	update_event_applicants_count();

	function update_students_count() {
		$("#students_counter").animate(
			{
				counter: counter2,
			},
			{
				duration: 2000,
				easing: "swing",
				step: function (now) {
					$(this).text(Math.ceil(now));
				},
				complete: update_students_count,
			}
		);
	}
	update_students_count();

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
}); // end of ready function
