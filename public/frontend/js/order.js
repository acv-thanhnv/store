
//======================click order=========================
$(document).on('click', '.product_image', function () {
    var id = $(this).parent('.entities_item').attr('entities-id');
    var image = $(this).find('img').attr('src');
    var name = $(this).parents('.entities_item').attr('entities-name');
    var price = $(this).parents('.entities_item').attr('entities-price');
    //set
    var row = $('#entities-detail-template').contents().clone();
    $(row).find('.img-detail-responsive').attr('src', image);
    $(row).find('.item-detail-name').text(name);
    $(row).find('.item-detail-price').text(price);
    //set attr
    $(row).find('.entities-row').attr('item-detail-id',id);
    $(row).find('.entities-row').attr('item-detail-name',name);
    //append
    var entities = $('#entities-detail');
    $(entities).append(row);
})
//========================delete row order==========================
$(document).on("click", ".delete-order", function () {
    $(this).parents(".entities-row").remove();
});

//======================up quantity=========================
$(document).on("click", ".up-quantity", function () {
    var quantity = parseInt($(this).parents('.entities-row').find('#quantity').val());
    $(this).parents('.entities-row').find('#quantity').val(quantity+1);
});

//======================down quantity=========================
$(document).on("click", ".down-quantity", function () {
    var quantity = parseInt($(this).parents('.entities-row').find('#quantity').val());
    if (quantity > 1) {
        $(this).parents('.entities-row').find('#quantity').val(quantity-1);
    }
});
