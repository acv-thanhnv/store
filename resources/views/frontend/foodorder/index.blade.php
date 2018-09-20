@extends('layouts.foodorder')
@section('css')
<style type="text/css">
.nopadd {
    padding: 0 !important;
    margin: 0 !important;
}

.wraper-content {
    margin-top: 5px;
    height: 100%;
    width: 100%;
    padding: 0px 0px;
}
.title-label{
    font-weight: bold;
}
.wraper-content-left {
    border-right: 1px solid #c1c1c1;
    overflow: auto;

}
.color-red{
    color: red;
}
.wraper-content-right {
    border-left: 1px solid #ebebeb;
}

.content-col-left {
    position: relative;
    height: 100%;
    overflow: hidden;
}

.content-col-right {
    height: calc(100%);
    float: left;
    position: relative;
}

.wrap-list-item-type {
    margin: 10px;
}

#item-order {
    clear: both;
}

.wrap-order {
    bottom: 0px;
    margin: 0px;
    padding: 0px;
    height: 150px;
}

.wrap-order-info {
    border-top: 1px solid #0090da;
    padding-top: 15px;
    height: 60px;
}

.wrap-order-submit {

}

.order-submit {
    width: 250px;
    height: 50px;
    right: 20px;
    bottom: 30px;
}


.wrap-order {
    background-color: #fff;
}

.order-total {
    float: right;
    right: 23px;
}

.wrap-order {
    width: 100%;
    padding: 10px;
}

.order-location-label{
    margin-left: 15px;
}

.wrap-description {
    margin-top: 10px;
    margin-bottom: 10px;
}

.order-description {
    width: 100%;
    height: 30px;
}

.wrap-list {
    overflow: auto;
    height: 700px;
    border-bottom: 1px solid #d0d6d0;
}
@media only screen and (max-width: 1024px) {
    .wrap-list {
        overflow: auto;
        height: 473px !important;
        border-bottom: 1px solid #d0d6d0;
    }
}
@media only screen and (max-width: 768px) {
    .wrap-list {
        overflow: auto;
        height: 400px !important;
        border-bottom: 1px solid #d0d6d0;
    }
}
@media only screen and (max-width: 1600px) {
    .wrap-list {
        overflow: auto;
        height: 460px !important;
        border-bottom: 1px solid #d0d6d0;
    }
}
</style>
@endsection


@section('content')
{{--content--}}
<div class="wraper-content col-sm-12">
    {{--content left--}}
    <div class="wraper-content-top">
        <div class="wrap-list-item-type col-sm-6">
            <div id="list-item-type">
                <button class="btn btn-primary btn-item-type" type="button" item-type-id="">Tất cả</button>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="wraper-content-middle">
        <div class="wraper-content-left col-sm-6 nopadd">
            <div class="tab-content">
                <div id="menu-content" class="tab-pane fade in active">
                    <div class="wrap-list-item wrap-list col-sm-12">
                        <div id="list-item">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--content right--}}
        <div class="wraper-content-right col-sm-6 nopadd">
            <div class="tab-content">
                <div id="order-content" class="tab-pane fade in active">
                    <div class="wrap-item-order wrap-list">
                        <div id="list-item-order"></div>
                    </div>
                </div>
            </div>
        </div>
        {{--END CONTENT--}}
        <div class="clearfix"></div>
    </div>
    <div class="wraper-content-bottom col-ms-12">
        <div class="col-ms-6 col-md-6"></div>
        <div class="col-ms-6 col-md-6 nopadd">
            <div class="wrap-order">
                <div>
                    <span><button class="order-location"><i class="color-red glyphicon glyphicon-map-marker"></i> Chọn vị trí</button></span>
                    <span class="order-location-label" location-id="" location-name="">............... </span>
                    <div class="order-total pull-right">
                        <span class="title-label">Tổng Tiền: </span>
                        <span class="total-price-order">__.___</span>
                        <span>(VNĐ)</span>
                    </div>
                </div>
                <div class="wrap-description">
                    <span class="title-label">Ghi chú: </span>
                    <span>
                        <textarea class="order-description form-control"></textarea>
                    </span>
                </div>
                <div class="wrap-order-submit">
                    <button class="order-submit btn btn-success">Chuyển nhà bếp</button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
{{--INCLUDE TEMPLATE CONTENT--}}
@include('frontend.foodorder.item-type')
@include('frontend.foodorder.item')
@include('frontend.foodorder.item-order')

{{--INCLUDE TEMPLATE iframe location--}}
<div id="modal-iFrame" class="iziModal" display="none"></div>
<div id="modal-iFrame2" class="iziModal" display="none"></div>
@endsection


{{-- include javascript --}}
@section('javascript')
<script type="text/javascript">
        //load data page
        var _storeId = '{{$storeId}}';
        $(document).ready(function (event) {

            //load item type by store
            $.ajax({
                url: '{{route("food/list-menu-by-store")}}' + '/' + _storeId,
                dataType: 'JSON',
                type: 'GET',
                success: function (data) {

                    genListItemType(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('Error ' + xhr.status + ' | ' + thrownError);
                },
            });
            //load item by store
            $.ajax({
                url: '{{route("food/list-by-menu")}}',
                dataType: 'JSON',
                type: 'GET',
                data: {storeId: _storeId},
                success: function (data) {
                    genFoodByStoreId(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('Error ' + xhr.status + ' | ' + thrownError);
                },
            });
        });

        //gen list item type to template
        function genListItemType(data) {
            var itemtype = $("#list-item-type");
            data.data.forEach(function (obj) {
                var item = $("#item-type-template").contents().clone();
                $(item).attr('item-type-id', obj.id);
                $(item).html(obj.name);
                $(itemtype).append($(item));
            });
        }

        //get item by item type
        $(document).on('click', '.btn-item-type', function () {
            var id = $(this).attr('item-type-id');
            $.ajax({
                url: '{{route("food/list-by-menu")}}' + '/' + id,
                dataType: 'JSON',
                type: 'GET',
                data: {storeId: _storeId},
                success: function (data) {
                    genFoodByStoreId(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('Error ' + xhr.status + ' | ' + thrownError);
                },
            });
        });

        //gen item to template
        function genFoodByStoreId(data) {
            var listitem = $("#list-item");
            $(listitem).empty();
            data.data.forEach(function (obj) {
                var item = $("#items-template").contents().clone();

                $(item).find('.item-title').attr('title', obj.name);
                $(item).find('.item-image').attr('src', obj.image);
                $(item).find('.item-name').html(obj.name);
                $(item).find('.item-price').html(formatNumber(parseInt(obj.price)));
                //set attr
                $(item).attr('item-id', obj.id);
                $(item).attr('item-name', obj.name);
                $(item).attr('item-price', obj.price);

                $(listitem).append($(item));
            });
        }

        //show detail item
        $(document).on('click', '.item-detail', function (event) {
            $('#modal-iFrame2').iziModal('open', this); // Do not forget the "this"
        });
        $("#modal-iFrame2").iziModal({
            title: 'Thông tin chi tiết', //Modal title
            headerColor: 'rgb(51, 76, 123)', //Color of modal header. Hexa colors allowed.
            overlayColor: 'rgba(0, 0, 0, 0.4)', //Color of overlay behind the modal
            iconColor: '',
            iconClass: 'icon-chat',
            iframe: true, //In this example, this flag is mandatory. Izimodal needs to understand you will call an iFrame from here
            iframeURL: "{{route('itemdetail')}}" //Link will be opened inside modal
        });

        //choose item to order
        var item = $("#list-item-order");
        $(item).empty();

        $(document).on("click", ".item-image", function (event) {
            var id = $(this).parents('.item').attr('item-id');
            var image = $(this).attr('src');
            console.log(image);
            var name = $(this).parents('.item').attr('item-name');
            var price = $(this).parents('.item').attr('item-price');

            var row = $("#item-order-template").contents().clone();
            //$(row).find('.item-order-arrange').html(i);
            $(row).attr('item-order-id', id);
            $(row).find('.item-order-image').attr('src', image);
            $(row).find('.item-order-name').html(name);
            $(row).find('.item-order-quantity').val('1');
            $(row).find('.item-order-price').text(formatNumber(parseInt(price)));
            //set attr
            $(row).attr('item-order-name', name);
            $(row).attr('item-order-price', price);

            $(item).append(row);
            updatePrice();
            updateArange();
        });

        //update arrange row
        function updateArange() {
            var row = $("#list-item-order").find('.row-item-order');
            for (var i = 0; i <= row.length; i++) {
                $(row[i]).find('.item-order-arrange').html([i + 1]);
            }
        }

        //update price amount and total pay
        function updatePrice() {
            var total = 0;
            $('.row-item-order').each(function () {
                //get amount
                var quantity = $(this).find('.item-order-quantity').val();
                var price = $(this).attr('item-order-price');
                var amount = (quantity * price);
                // $(this).find('.item-order-amount').html(amount);
                total += amount;
            });
            //set total
            $('.total-price-order').text(formatNumber(parseInt(total)));
        }

        //change quantity
        $(document).on("change", ".item-order-quantity", function () {
            updatePrice();
        });

        $(document).on("click", ".quantity-down", function () {
            var quantity = parseInt($(this).parents('.row-item-order').find('.item-order-quantity').val());
            var quantity2 = quantity - 1;
            $(this).parents('.row-item-order').find('.item-order-quantity').val(quantity2);
            updatePrice();
        });

        $(document).on("click", ".quantity-up", function () {
            var quantity = parseInt($(this).parents('.row-item-order').find('.item-order-quantity').val());
            var quantity2 = quantity + 1;
            $(this).parents('.row-item-order').find('.item-order-quantity').val(quantity2);
            updatePrice();
        });

        //delete row item order
        $(document).on("click", ".delete-item-order", function (event) {
            $(this).parents(".row-item-order").remove();
            updateArange();
            updatePrice();
        });

        //set location
        $(document).on('click', '.order-location', function (event) {
            $('#modal-iFrame').iziModal('open', this); // Do not forget the "this"
        });
        $("#modal-iFrame").iziModal({
            title: 'Chọn vị trí', //Modal title
            headerColor: 'rgb(51, 76, 123)', //Color of modal header. Hexa colors allowed.
            overlayColor: 'rgba(0, 0, 0, 0.4)', //Color of overlay behind the modal
            iconColor: '',
            iconClass: 'icon-chat',
            iframe: true, //In this example, this flag is mandatory. Izimodal needs to understand you will call an iFrame from here
            iframeURL: "{{route('location')}}" //Link will be opened inside modal
        });

        //submit to chef
        $(document).on("click", ".order-submit", function () {
            var item = $('#list-item-order').find('.row-item-order');
            //var clearorder= item.remove();
            var storeId = _storeId;
            var orderId = 0;
            var locationId = $('.order-location-label').attr('location-id');
            var locationName = $('.order-location-label').attr('location-name');
            var description = $('.order-description').val();
            var totalPrice = $('.total-price-order').text();

            var rows = $('.row-item-order');
            var entity = [];
            for (var i = 0; i < rows.length - 1; i++) {
                var id = $(rows[i]).attr('item-order-id');
                var name = $(rows[i]).attr('item-order-name');
                var avatar = $(rows[i]).find('.item-order-image').attr('src');
                var price = $(rows[i]).attr('item-order-price');
                var quantity = $(rows[i]).find('.item-order-quantity').val();

                var a = {id: id, name: name, avatar: avatar, price: price, quantity: quantity};
                entity.push(a);
            }
            entity = JSON.stringify(entity);

            if (item.length == 0) {
                $.alert({
                    title: 'Bạn chưa chọn món!',
                    content: 'Quay lại chọn món.',
                });
            } else if (locationId == 0) {
                $.alert({
                    title: 'Bạn chưa chọn vị trí!',
                    content: 'Quay lại chọn vị trí.',
                });
            } else {
                $.confirm({
                    title: 'Chuyển tới nhà bếp !',
                    content: 'Nhấn xác nhận để tiếp tục...',
                    type: 'yellow',
                    boxWidth: "30%",
                    useBootstrap: true,
                    typeAnimated: true,
                    buttons: {
                        ok: {
                            text: 'Xác Nhận',
                            btnClass: 'btn-orange',
                            keys: ['enter'],
                            action: function () {
                                $.ajax({

                                    url: '{{route("food/order")}}',
                                    dataType: 'JSON',
                                    type: 'GET',
                                    data: {
                                        storeId: storeId,
                                        orderId: orderId,
                                        locationId: locationId,
                                        locationName: locationName,
                                        description: description,
                                        entity: entity,
                                        totalPrice: totalPrice
                                    },
                                    success: function (data) {
                                        $.toast({
                                            heading: 'Success',
                                            text: 'Đơn đã gửi đến bếp chờ xử lý..',
                                            showHideTransition: 'slide',
                                            position: 'top-right',
                                            icon: 'success',
                                            hideAfter:1000,
                                            afterHidden: function () {
                                                item.remove();
                                                $('.order-location-label').attr('location-id','');
                                                $('.order-location-label').attr('location-name', '');
                                                $('.order-location-label').text('...............');
                                                $('.order-description').val('');
                                                $('.total-price-order').text('__.___');
                                            }
                                        })
                                        
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        console.log('Error ' + xhr.status + ' | ' + thrownError);
                                    },
                                });
                                
                                //...
                            }
                        },
                        Cancel: {
                            text: 'Hủy',
                        }
                    }

                });
            }

        });

    </script>
    @endsection
