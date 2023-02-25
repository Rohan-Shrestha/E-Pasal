$(document).ready(function(){
    // Check either Admin Password is correct or not
    $("#current_password").keyup(function(){
        var current_password = $("#current_password").val();
        // alert(current_password);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/check-admin-password',
            data:{current_password:current_password},
            success:function(response){
                // alert(response);
                if(response=="false"){
                    $("#check_password").html("<font color='red'>Current Password is Incorrect!</font>");
                }else if(response=="true"){
                    $("#check_password").html("<font color='green'>Current Password is Correct!</font>")
                }
            },error:function(){
                alert('Error');
            }
        });
    })

    // Update Admin Status
    $(document).on("click", ".updateAdminStatus", function(){
        // alert("test");
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        // alert(admin_id);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-admin-status',
            data:{status:status,admin_id:admin_id},
            success:function(resp){
                // alert(resp);
                if(resp['status']==0){
                    $('#admin-'+admin_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-remove' status='Inactive'></i>")
                }
                else if(resp['status']==1){
                    $('#admin-'+admin_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='Active'></i>")
                }
            },error:function(){
                alert("Error");
            }
        })
    });
});