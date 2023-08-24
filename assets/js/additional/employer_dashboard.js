$(document).ready(function(){

    function update_emp_count() {
        $('#emp_counter').animate({
            counter: counter1
        }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_emp_count
        });
    };
    update_emp_count();

    function update_approved_emp_count() {
        $('#approved_emp_counter').animate({
            counter: counter2
        }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_approved_emp_count
        });
    };
    update_approved_emp_count();

    function update_pending_emp_count() {
        $('#pending_emp_counter').animate({
            counter: counter3
        }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_pending_emp_count
        });
    };
    update_pending_emp_count();

    function update_emp_app_count() {
        $('#emp_app_counter').animate({
            counter: counter4
        }, {
            duration: 2000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            },
            complete: update_emp_app_count
        });
    };
    update_emp_app_count();

}); // end of ready function
