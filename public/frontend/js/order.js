//click order
$(document).on('click', '.product_image', function () {
    var id =$(this).parent('.entities_item').attr('entities-id');
    var image =$(this).find('img').attr('src');
    var name = $(this).parents('.entities_item').attr('entities-name');
    var price = $(this).parents('.entities_item').attr('entities-price');

    var row = $('#entities-order-template').contents().clone();
    $(row).find('.img-responsive').attr('src', image);
    $(row).find('.item-order-name').text(name);
    $(row).find('.item-order-price').text(price);

    var entities = $('#entities-order');
    $(entities).append(row);
})


//delete row order
$(document).on("click", ".delete-order", function () {
    $(this).parents(".entities-row").remove();
});
