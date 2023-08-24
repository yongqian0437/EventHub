$(document).ready(function () {

    function update_student_count() {
        $('#student_counter').animate({
            counter: counter1
        }, {

            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));

            },
            complete: update_student_count
        });
    };
    update_student_count();

}); // end of ready function