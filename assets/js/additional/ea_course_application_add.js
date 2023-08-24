$(document).ready(function () {
    $('#course_class_1').hide();
    //ajax for 1st courses dropdown
    $('#university_1').change(function () {
        var uni1 = document.getElementById("university_1").value;

        if (uni1 != "") {
            $('#course_class_1').fadeIn(1000);

            $.ajax({
                url: base_url + "internal/level_2/education_agent/ea_course_application/fetch_courses",
                method: "POST",
                data: { uni_id: $("#university_1").val() },
                success: function (data) {
                    $('#course_1').html(data);
                }
            });
        }
    });

}); // end of ready function
