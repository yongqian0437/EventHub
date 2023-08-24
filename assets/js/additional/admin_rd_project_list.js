$(document).ready(function(){
    var t = $("#table_admin_all_rd").DataTable({
        //make table responsive
        "bAutoWidth":false,
        ajax: {
            url: base_url + "internal/admin_panel/content/Admin_rd_project/admin_all_rd_project_list",
            type: "GET",
        },
        "columnDefs": [{
            "width": "18%",
            "targets": [3]
        },
        {
            "width": "10%",
            "targets": [4]
        },
        {
            "width": "5%",
            "targets": [5]
        },
        {
            "width": "20%",
            "targets": [2]
        },
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

    var t2 = $("#table_admin_pending_rd").DataTable({
        //make table responsive
        "bAutoWidth":false,
        ajax: {
            url: base_url + "internal/admin_panel/content/Admin_rd_project/admin_pending_rd_project_list",
            type: "GET",
        },
        "columnDefs": [{
            "width": "18%",
            "targets": [4]
        },
        {
            "width": "10%",
            "targets": [5]
        },
        {
            "width": "5%",
            "targets": [6]
        },
        {
            "width": "20%",
            "targets": [3]
        },
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

    $('#select_all_rd').click(function() {
        var checked = this.checked;
        $('input[type="checkbox"]').each(function() {
            this.checked = checked;
        });
    })

}); // end of ready function

function view_admin_rd_project(rd_id){

    $.ajax({
        url: base_url + "internal/admin_panel/content/Admin_rd_project/view_admin_rd_project",
        method:"POST",
        data:{ rd_id:rd_id},
        success:function(data)
        {
            $('#admin_rd_project_information').html(data);

        }
    });
}

function edit_approval(rd_id){

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: base_url + "internal/admin_panel/content/Admin_rd_project/edit_one_approval",
                method:"POST",
                data:{ rd_id:rd_id},
                success:function(data)
                {

                    //reload datatable
                    var xin_table = $("#table_admin_all_rd").DataTable();
                    xin_table.ajax.reload(null, false);

                    var xin_table = $("#table_admin_pending_rd").DataTable();
                    xin_table.ajax.reload(null, false);
                }
            });
          
        }
      })
}

// Approve >1 RD
function approve_all_rd() {

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
                    $rd_id = $(this).val();
            
                    $.ajax({
                        url: base_url + "internal/admin_panel/content/Admin_rd_project/approve_rd",
                        method:"POST",
                        data:{ rd_id:$rd_id},
                    });
                });

                Swal.fire(
                    'Approved!',
                    'R&D Projects have been approved.',
                    'success'
                )
                    
                //reload both datatables
                var xin_table = $("#table_admin_pending_rd").DataTable();
                xin_table.ajax.reload(null, false);
            
                var xin_table2 = $("#table_admin_all_rd").DataTable();
                xin_table2.ajax.reload(null, false);
            }
        })
    }
}