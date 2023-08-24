$(document).ready(function(){
    var t = $("#table_emp_applicants").DataTable({
        //make table responsive
        "bAutoWidth":false,
        ajax: {
            url: base_url + "internal/level_2/employer/employer_emp_applicants/emp_applicants_list",
            type: "GET",
        },
        "columnDefs": [{
            "searchable": false,
            "targets": 0
        },
        {
            "width": "18%",
            "targets": [5]
        },]
    });

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

}); // end of ready function

function view_emp_applicant(emp_applicant_id){

    $.ajax({
        url: base_url + "internal/level_2/employer/employer_emp_applicants/view_emp_applicant",
        method:"POST",
        data:{ emp_applicant_id:emp_applicant_id},
        success:function(data)
        {
            $('#emp_applicant_information').html(data);

        }
    });
}

// selecting user to chat with from the EP Applicants page
// when a user is selected from the EP Applicants page, the user's data will be stored in localStorage
function chat_with_emp_applicant(user_id, user_fname, user_lname) {

    localStorage.setItem("user_id",user_id);
    localStorage.setItem("user_fname",user_fname);
    localStorage.setItem("user_lname",user_lname);
    // redirect Employer to Chat page
    window.location.href = base_url + "user/chat/Chat";

}