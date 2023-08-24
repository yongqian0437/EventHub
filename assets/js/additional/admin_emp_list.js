$(document).ready(function(){
    
document.getElementById("all_emps").style.color = "black";

// ALL Employer Projects
var t = $("#table_all_emps").DataTable({
    //make table responsive
    "bAutoWidth":false,
    ajax: {
        url: base_url + "internal/admin_panel/content/admin_emps/all_emp_list",
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

// PENDING Employer Projects
var t2 = $("#table_pending_emps").DataTable({
    //make table responsive
    "bAutoWidth":false,
    ajax: {
        url: base_url + "internal/admin_panel/content/admin_emps/pending_emp_list",
        type: "GET",
    },
    "columnDefs": [
        {
            "searchable": false,
            "targets": 1
        }
    ]
});

t2.on( 'order.dt search.dt', function () {
    t2.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();

$('#select_all_emp').click(function() {
    var checked = this.checked;
    $('input[type="checkbox"]').each(function() {
        this.checked = checked;
    });
})

}); // end of ready function

function pending_emps_tab() {
    $('#all_emps').hide();
    $('#pending_emps').show();
}

function all_emps_tab() {
    $('#pending_emps').hide();
    $('#all_emps').show();
}

function view_emp(emp_id) {
    $.ajax({
        url: base_url + "internal/admin_panel/content/admin_emps/view_emp",
        method:"POST",
        data:{ emp_id:emp_id},
        success:function(data)
        {
            $('#emp_information').html(data);

        }
    });
}

// Approve 1 EMP 
function approve_emp(emp_id){

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: base_url + "internal/admin_panel/content/admin_emps/approve_emp",
                method:"POST",
                data:{emp_id:emp_id},
                success:function(data)
                {
                    //reload both datatables
                    var xin_table = $("#table_pending_emps").DataTable();
                    xin_table.ajax.reload(null, false);
        
                    var xin_table2 = $("#table_all_emps").DataTable();
                    xin_table2.ajax.reload(null, false);
                }
            });
        }
    })
}

// Approve >1 EMP
function approve_all_emps() {

    if($('input[type=checkbox]').is(':checked')){

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $('input[type=checkbox]:checked').each(function() {
                    //alert("Id: " + $(this).attr("id") + " Value: " + $(this).val());
                    $emp_id = $(this).val();
            
                    $.ajax({
                        url: base_url + "internal/admin_panel/content/admin_emps/approve_emp",
                        method:"POST",
                        data:{ emp_id:$emp_id},
                    });
                });

                Swal.fire(
                    'Approved!',
                    'Employer Projects have been approved.',
                    'success'
                )
                    
                //reload both datatables
                var xin_table = $("#table_pending_emps").DataTable();
                xin_table.ajax.reload(null, false);
            
                var xin_table2 = $("#table_all_emps").DataTable();
                xin_table2.ajax.reload(null, false);
            }
        })
    }
}