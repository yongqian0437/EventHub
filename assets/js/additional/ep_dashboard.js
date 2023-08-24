
$(document).ready(function(){

    function update_course_count() {
        $('#course_counter').animate({
            counter: counter1
        }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_course_count
        });
    };
    update_course_count();

    function update_my_rd_count() {
        $('#my_rd_counter').animate({
            counter: counter2
        }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_my_rd_count
        });
    };
    update_my_rd_count();

    function update_my_app_count() {
        $('#my_app_counter').animate({
            counter: counter3
        }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_my_app_count
        });
    };
    update_my_app_count();

    function update_partner_count() {
        $('#partner_counter').animate({
            counter: counter4
        }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_partner_count
        });
    };
    update_partner_count();

}); // end of ready function







