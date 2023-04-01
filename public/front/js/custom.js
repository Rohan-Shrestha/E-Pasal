$(document).ready(function () {
    $("#getPrice").change(function () {
        var size = $(this).val();
        var product_id = $(this).attr("product-id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/get-product-price',
            data: { size: size, product_id: product_id },
            type: 'post',
            success: function (resp) {
                // alert(resp['final_price']);
                if (resp['discount'] > 0) {
                    $(".getAttributePrice").html("<div class='price'><h4>Rs. " + resp['final_price'] + "</h4></div><div class='original-price'><span>Original Price: </span><span>Rs. " + resp['product_price'] + "</span></div>");
                } else {
                    $(".getAttributePrice").html("<div class='price'><h4>Rs. " + resp['final_price'] + "</h4></div>");
                }
            }, error: function () {
                alert("Error");
            }
        });
    });

    // Update Cart Items Quantity
    $(document).on('click','.updateCartItem',function(){
        if($(this).hasClass('plus-a')){
            // Get the quantity
            var quantity = $(this).data('qty');
            // increase the quantity by 1 if user clicks plus button in quantity column
            new_qty = parseInt(quantity) + 1;
        }
        if($(this).hasClass('minus-a')){
            // Get the quantity
            var quantity = $(this).data('qty');
            // Check quantity is at least 1
            if(quantity<=1){
                alert("Item must be 1 or greater !");
                return false;
            }
            // increase the quantity by 1 if user clicks plus button in quantity column
            new_qty = parseInt(quantity) - 1;
            alert(new_qty);
        }
    });
});

function get_filter(class_name) {
    var filter = [];
    $('.' + class_name + ':checked').each(function () {
        filter.push($(this).val());
    });
    return filter;
}