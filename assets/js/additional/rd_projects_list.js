$(document).ready(function(){

            // To apply for a specific EP
            $('.apply_rd').click(function() {
                var ids = $(this).data('id');
                var ep_id = ids[0];
                var rd_id = ids[1];
                // Ask user for confirmation
                swal({
                        title: "Confirm application?",
                        text: "This application will be submitted to the owner.\nUpon reviewal, you will be contacted.",
                        icon: "info",
                        buttons: ['Cancel', 'Confirm']
                    })
                    // Send application into db once confirmed
                    .then((send_application) => {
                        if (send_application) {
                            $.ajax({
                                url: base_url + 'external/Rd_projects/send_rdp_application/',
                                type: 'post',
                                data: {
                                    ep_owner_id: ep_id, rd_id: rd_id, ep_collab_id: ep_collab_id                                 
                                },
                                success: function() {
                                    swal({
                                            title: "Thank you!",
                                            text: "Your application has been submitted.",
                                            icon: "success",
                                        })
                                        .then((send_application) => {
                                            location.reload();
                                        });
                                }
                            });
                        }
                    });
            });

}); // end of ready function

function view_rd(rd_id){

    $.ajax({
        url: base_url + "external/Rd_projects/fetch_rd_information",
        method:"POST",
        data:{ rd_id:rd_id},
        success:function(data)
        {
            $('#rd_information').html(data);
        }
    });
}