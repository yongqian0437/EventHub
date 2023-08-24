$(document).ready(function () {
    var t = $("#admin_course_applicant").DataTable({
        //make table responsive
        "bAutoWidth": false,
        ajax: {
            url: base_url + "internal/admin_panel/applicants/Admin_course_application/admin_course_application_list",
            type: "GET",
        },
    });

    t.on('order.dt search.dt', function () {
        t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    $(window).resize(function () {
        oTable.fnDraw(false)
    });

}); // end of ready function

function view_admin_course_applicant(c_applicant_id) {

    $.ajax({
        url: base_url + "internal/admin_panel/applicants/Admin_course_application/view_admin_course_applicant",
        method: "POST",
        data: { c_applicant_id: c_applicant_id },
        success: function (data) {
            $('#admin_course_application_information').html(data);

        }
    });
}