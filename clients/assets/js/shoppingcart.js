$(document).ready(function(e){
    function load_cart_item_number(){
        $.ajax({
            url: '../cart/cart_action.php',
            method: 'get',
            data: {cartItem: "cart_item"},
            success:function(response){
                $("#checkout_items").html(response);
            }
        });
    }
    $('body').on('click', '#cart_link', function(e){
        e.preventDefault();
        var quantity = 1;
        var tQuantity = $('#quantity_value').text();
        if(tQuantity != ''){
            quantity =parseInt(tQuantity);
        }
        var $form = $(this).closest(".form-submit");
        var productId = $form.find(".ProdId").val();

        $.ajax({
            url: '../cart/cart_action.php',
            method: 'get',
            data: {cartadd: "themgiohang", productId: productId, quantity: quantity},
            success:function(){
                alert("Thêm vào giỏ hàng thành công.");
                load_cart_item_number();
            }
        });
    });
});