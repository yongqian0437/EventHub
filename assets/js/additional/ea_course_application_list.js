$(document).ready(function () {
    var t = $("#table_course_applicants").DataTable({
        //make table responsive
        "bAutoWidth": false,
        ajax: {
            url: base_url + "internal/level_2/education_agent/ea_course_application/course_application_list",
            type: "GET",
        },
        "columnDefs": [{
            "width": "20%",
            "targets": [6]
        }]

    });

    $(window).resize(function () {
        oTable.fnDraw(false)
    });

    t.on('order.dt search.dt', function () {
        t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

}); // end of ready function

function delete_course_applicant(c_applicant_id) {

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({

                url: base_url + "internal/level_2/education_agent/ea_course_application/delete_course_applicant",
                method: "POST",
                data: { c_applicant_id: c_applicant_id },
                success: function (data) {
                    Swal.fire(
                        'Deleted!',
                        'Course Applicant has been deleted.',
                        'success'
                    )

                    //reload datatable
                    var xin_table = $("#table_course_applicants").DataTable();
                    xin_table.ajax.reload(null, false);
                }
            });

        }
    })
}

function view_course_applicant(c_applicant_id) {

    $.ajax({
        url: base_url + "internal/level_2/education_agent/ea_course_application/view_course_applicant",
        method: "POST",
        data: { c_applicant_id: c_applicant_id },
        success: function (data) {
            $('#course_application_information').html(data);

        }
    });
}



