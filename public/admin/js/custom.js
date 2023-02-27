$(document).ready(function () {
    // call datatable class
    $('#sections').DataTable();


    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");
    // Check either Admin Password is correct or not
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        // alert(current_password);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/check-admin-password',
            data: { current_password: current_password },
            success: function (response) {
                // alert(response);
                if (response == "false") {
                    $("#check_password").html("<font color='red'>Current Password is Incorrect!</font>");
                } else if (response == "true") {
                    $("#check_password").html("<font color='green'>Current Password is Correct!</font>")
                }
            }, error: function () {
                alert('Error');
            }
        });
    })

    // Update Admin Status
    $(document).on("click", ".updateAdminStatus", function () {
        // alert("test");
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        // alert(admin_id);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-admin-status',
            data: { status: status, admin_id: admin_id },
            success: function (resp) {
                // alert(resp);
                if (resp['status'] == 0) {
                    $('#admin-' + admin_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-remove' status='Inactive'></i>")
                }
                else if (resp['status'] == 1) {
                    $('#admin-' + admin_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='Active'></i>")
                }
            }, error: function () {
                alert("Error");
            }
        })
    });

    // Update Section Status
    $(document).on("click", ".updateSectionStatus", function () {
        // alert("test");
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
        // alert(section_id);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-section-status',
            data: { status: status, section_id: section_id },
            success: function (resp) {
                // alert(resp);
                if (resp['status'] == 0) {
                    $('#section-' + section_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-remove' status='Inactive'></i>")
                }
                else if (resp['status'] == 1) {
                    $('#section-' + section_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='Active'></i>")
                }
            }, error: function () {
                alert("Error");
            }
        })
    });

    //// Confirm section Deletion (simple javascript)
    // $(".confirmDelete").click(function(){
    //     var title = $(this).attr("title");
    //     if(confirm("Are you sure you want to delete this "+title+"?")){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // })

    // Confirm section Deletion (sweet alert library)
    $(".confirmDelete").click(function () {
        var module = $(this).attr('module');
        var module_id = $(this).attr('module_id');
        // alert(module_id);
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
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location = "/admin/delete-"+module+"/"+module_id;
            }
        })
    })
});