@push("css")
    <style type="text/css">
        .time {
            padding-top: 6px;
            padding-right: 37px;
            font-weight: bold;
            color: #999;
        }

        .order-title {
            font-weight: bold;
        }

        .order-avatar img {
            width: 150px;
        }

        .order-infor {
            padding-top: 17px;
        }

        .order-detail-list {
            padding-bottom: 0px;
            margin-bottom: 0px;
        }

        .order {
            margin-bottom: 10px;
        }

        .close-link {
            color: red !important;
        }

        .send-link {
            color: red;
        !important;
            font-weight: bold;
        }

        .ok-link {
            color: green !important;
            font-weight: bold;
        }

        .order-avatar {
            width: 200px;
            max-width: 200px;
            min-width: 200px;
        }

        .button-left {
            width: 70px;
        }

        .button-right {
            width: 183px;
        }

        .header-total-price {
            width: 400px;
            float: left;
            text-align: left;
        }

        .header-location {
            text-align: left;
            width: 100%;
        }

        .header-time {
            width: 380px;
            float: right;
            text-align: left;
        }

        .x_title {
            font-weight: bold;
        }

        .order-header {
            display: inline-flex;
            width: 100%;
        }

        .order-header-area .x_title {
            border: none !important;
            color: #0c0c0c;
        }

        .order-header-area .x_panel {
            border: none !important;
            background: none;
        }

        .x_title span {
            color: #34495e !important;
        }

        .order-closed {
            background: green;
        }
        .order-description{
            margin-bottom: 10px;
        }
        .order-item .div-order-item{
            padding-bottom: 5px;
        }
    </style>
@endpush
@extends("layouts.backend")
@section("content")
    <!--Table-->
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
        <div class="col-md-12 col-ms-12 col-xs-12 order order-header-area">
            <div class="x_panel order-detail-list">
                <div class="x_title order-header">
                    <div class="button-left"></div>
                    <div class="header-total-price">
                        <span class="order-total-price"></span>
                        <span>Tổng giá</span>
                    </div>
                    <div class="header-location">
                        <span class="order-location">Vị trí</span>
                    </div>
                    <div class="header-time"><span class="time">Thời gian</span></div>
                    <div class="button-right"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div id="order-waiting-list">

        </div>
    </div>
    <div class="col-md-12 col-ms-12 col-xs-12 display-none order" id="order-template">
        <div class="x_panel order-detail-list">
            <div class="x_title order-header">
                <div class="button-left">
                    <a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                </div>
                <div class="header-total-price">
                    <span class="order-total-price"></span>
                    <span>VNĐ</span>
                </div>
                <div class="header-location">
                    <span class="order-location"></span>
                </div>
                <div class="header-time"><span class="order-time"></span></div>
                <div class="button-right">
                    <button class="close-link"><i class="fa fa-close"></i></button>
                    <button class="send-link"><i class="glyphicon glyphicon-send"></i></button>
                    <label class="ok-link display-none"><i class="glyphicon glyphicon-ok"></i></label>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content order_x_content display-none">
                <ul class="list-unstyled order-item-list">
                </ul>
            </div>
            <div class="order-description"></div>
        </div>
    </div>
    <ul id="order-item-template" class="display-none">
        <li class="order-item">
            <div class="col-md-12 col-ms-12 col-xs-12 div-order-item">
                <div class="pull-left order-avatar">
                    <img
                        src=""
                        alt="img"/>
                </div>
                <div class="order-infor">
                    <span class="order-title">
                        <span class="order-item-name">Hoa quả</span>
                    </span>
                    <span class="message">
                    <div class="order-prop">
                        <span>- Giá :</span> <span class="order-item-price">0</span> <span class="">VNĐ</span>
                    </div>
                    <div class="order-prop">
                        <span>- Số lượng :</span> <span class="order-item-quantity">0</span>
                    </div>
                </span>
                </div>
            </div>
        </li>
    </ul>
@endsection
@push("js")
    <script src="{{ asset('js/lib/pusher.min.js')}}"></script>
    <script>
        _orderWaiting = [];
        $(document).ready(function () {
            getInitOrderChef();

            var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
                cluster: '{{env('PUSHER_APP_CLUSTER')}}',
                encrypted: true
            });
            var channel = pusher.subscribe('{{\App\Core\Helpers\CommonHelper::getOrderEventName($storeId,\App\Core\Common\OrderConst::OrderChannelToChef)}}');
            var eventName = "{{\App\Core\Common\OrderConst::OrderChefEventName}}";
            channel.bind(eventName, addOrder);

            //Show - Hide order detail
            $(document).on('click', '.collapse-link', function () {
                var parent = $(this).parents('.order');
                if ($(parent).find('.order_x_content').hasClass('display-none')) {
                    $(parent).find('.order_x_content').removeClass('display-none');
                    $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
                } else {
                    $(parent).find('.order_x_content').addClass('display-none');
                    $(this).find('i').addClass('fa-chevron-down').removeClass('fa-chevron-up');
                }
            });
            $(document).on('click', '.close-link', function () {
                $(this).parents('.order-detail-list').remove();
                deleteOrder();
            });
            $(document).on('click', '.send-link', function () {
                var orderId = $(this).attr('orderId');
                var parrent = $(this).parents('.order');
                var current = $(this);
                $.ajax({
                    url: '{{route("food/closeOrder")}}',
                    dataType: 'JSON',
                    type: 'GET',
                    data: _orderWaiting[orderId],
                    success: function (data) {
                        //OK
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log('Error ' + xhr.status + ' | ' + thrownError);
                    },
                });
            });
        });

        //function add message
        function addOrder(data) {
            var orderId = data.orderId;
            var record = $(".order[orderid='"+orderId+"']");
            if (data.requestType == '{{\App\Core\Common\OrderConst::TypeAdd}}' && record.length == 0) {
                var entity = JSON.stringify(data.entity);
                var orderArea = $('#order-template').clone();
                $(orderArea).removeClass('display-none');
                $(orderArea).removeAttr('id');
                $.each(data.entity, function (index, item) {
                    var liTag = $('#order-item-template').children('li').clone();
                    $(liTag).removeClass('display-none');
                    $(liTag).removeAttr('id');
                    $(liTag).find('.order-item-name').html(item.name);
                    $(liTag).find('.order-item-price').text(formatNumber(item.price));
                    $(liTag).find('.order-item-quantity').text(item.quantity);
                    $(liTag).find('.order-avatar img').attr('src', item.avatar);
                    $(orderArea).find('.order-item-list').append(liTag);
                });
                $(orderArea).find('.order-total-price').html(formatNumber(data.totalPrice));
                $(orderArea).find('.order-location').html(data.locationName);
                $(orderArea).find('.order-time').text(data.dateTimeOrder);
                $(orderArea).attr('orderId',data.orderId);
                $(orderArea).find('.send-link').attr('orderId', data.orderId);
                $(orderArea).find('.close-link').attr('orderId', data.orderId);
                $(orderArea).find('.order-description').text(data.description);
                $('#order-waiting-list').append(orderArea);
                data.entity = JSON.stringify(data.entity);
                _orderWaiting[data.orderId] = data;
            }
            else if (data.requestType == '{{\App\Core\Common\OrderConst::TypeClearTrash}}') {
                var orderId = data.orderId;
                var record = $(".order[orderid='"+orderId+"']");
                $(record).find('.ok-link').removeClass('display-none');
                $(record).find('.close-link').remove();
                $(record).find('.send-link').remove();
                delete _orderWaiting[orderId];
                $(record).addClass('order-closed');
                $(record).fadeOut("slow",function(){
                    //nothing todo
                });
            }
        }

        function deleteOrder() {
            //delete Order in Database
        }
        function getInitOrderChef(){
            $.ajax({
                url         : '{{route("food/orderChefList")}}',
                dataType    : 'JSON',
                type        : 'GET',
                success: function(data){
                    if(data.status=="{{\App\Core\Common\SDBStatusCode::OK}}"){
                        $.each(data.data, function (index, order) {
                            var entity = JSON.stringify(data.entity);
                            var orderArea = $('#order-template').clone();
                            $(orderArea).removeClass('display-none');
                            $(orderArea).removeAttr('id');
                            $.each(order.entity, function (index2, item) {
                                var liTag = $('#order-item-template').children('li').clone();
                                $(liTag).removeClass('display-none');
                                $(liTag).removeAttr('id');
                                $(liTag).find('.order-item-name').html(item.name);
                                $(liTag).find('.order-item-price').text(formatNumber(item.price));
                                $(liTag).find('.order-item-quantity').text(item.quantity);
                                $(liTag).find('.order-avatar img').attr('src', item.avatar);
                                $(orderArea).find('.order-item-list').append(liTag);
                            });
                            $(orderArea).find('.order-total-price').html(formatNumber(order.totalPrice));
                            $(orderArea).find('.order-location').html(order.locationName);
                            $(orderArea).find('.order-time').text(order.dateTimeOrder);
                            $(orderArea).attr('orderId',order.orderId);
                            $(orderArea).find('.send-link').attr('orderId', order.orderId);
                            $(orderArea).find('.close-link').attr('orderId', order.orderId);
                            $(orderArea).find('.order-description').text(order.description);
                            $('#order-waiting-list').append(orderArea);
                            order.entity = JSON.stringify(order.entity);
                            _orderWaiting[order.orderId] = order;
                        });
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('Error '+xhr.status+' | '+thrownError);
                },
            });
        }
    </script>
@endpush
