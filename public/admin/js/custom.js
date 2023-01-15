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
});