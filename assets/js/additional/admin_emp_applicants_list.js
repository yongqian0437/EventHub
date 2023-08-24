$(document).ready(function(){
    var t = $("#table_admin_emp_applicants").DataTable({
        //make table responsive
        "bAutoWidth":false,
        ajax: {
            url: base_url + "internal/admin_panel/applicants/admin_emp_applicants/all_emp_applicants_list",
            type: "GET",
        },
        "columnDefs": [
        {
            "searchable": false,
            "targets": 0
        }
        ]
    });

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}); // end of ready function

function view_emp_applicant(emp_applicant_id){

    $.ajax({
        url: base_url + "internal/admin_panel/applicants/admin_emp_applicants/view_emp_applicant",
        method:"POST",
        data:{ emp_applicant_id:emp_applicant_id},
        success:function(data)
        {
            $('#emp_applicant_information').html(data);

        }
    });
}