$(document).ready(function(){
    var t = $("#table_my_rd_project").DataTable({
        //make table responsive
        "bAutoWidth":false,
        ajax: {
            url: base_url + "internal/level_2/educational_partner/ep_my_rd_project/my_rd_project_list",
            type: "GET",
        },
        "columnDefs": [{
            "width": "18%",
            "targets": [6]
        },
        {
            "width": "15%",
            "targets": [4]
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

}); // end of ready function

function delete_my_rd_project(rd_id){

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
                url: base_url + "internal/level_2/educational_partner/ep_my_rd_project/delete_my_rd_project",
                method:"POST",
                data:{ rd_id:rd_id},
                success:function(data)
                {
                    Swal.fire(
                        'Deleted!',
                        'R&D Project has been deleted.',
                        'success'
                    )

                    //reload datatable
                    var xin_table = $("#table_my_rd_project").DataTable();
                    xin_table.ajax.reload(null, false);
                }
            });
          
        }
      })
}

function view_my_rd_project(rd_id){

    $.ajax({
        url: base_url + "internal/level_2/educational_partner/ep_my_rd_project/view_my_rd_project",
        method:"POST",
        data:{ rd_id:rd_id},
        success:function(data)
        {
            $('#my_rd_project_information').html(data);

        }
    });
}