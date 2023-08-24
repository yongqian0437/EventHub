$(document).ready(function(){
    var t =  $("#table_admin_rd_project_app").DataTable({
        //make table responsive
        "bAutoWidth":false,
        ajax: {
            url: base_url + "internal/admin_panel/applicants/Admin_rd_app/admin_rd_project_app_list",
            type: "GET",
        },
        "columnDefs": [{
            "searchable": false,
            "targets": 0
        },]
    });

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}); // end of ready function

function view_rd_project(rd_applicant_id){

    $.ajax({
        url: base_url + "internal/admin_panel/applicants/Admin_rd_app/view_admin_rd_project_app",
        method:"POST",
        data:{ rd_applicant_id:rd_applicant_id},
        success:function(data)
        {
            $('#admin_rd_project_app_information').html(data);

        }
    });
}