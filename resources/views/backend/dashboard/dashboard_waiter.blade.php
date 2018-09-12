@push("css")
    <style type="text/css">
        .time {
            padding-top: 6px;
            padding-right: 37px;
            font-weight: bold;
            color: #999;
        }
.order-title{
    font-weight: bold;
}
        .order-avatar img {
            width: 150px;
        }
        .order-infor{
            padding-top: 17px;
        }
        .order-detail-list{
            padding-bottom: 0px;
            margin-bottom: 0px;
        }
        .order{
            margin-bottom: 10px;
        }
        .close-link{
            color:red !important;
        }
        .order-avatar{
            width: 200px;
            max-width: 200px;
            min-width: 200px;
        }
        .button-left{
            width: 70px;
        }
        .button-right{
            width: 70px;
        }
        .header-total-price{
            width: 400px;
            float: left;
            text-align: left;
        }
        .header-location{
            text-align: left;
            width: 100%;
        }
        .header-time{
            width: 380px;
            float: right;
            text-align: left;
        }
        .x_title{
            font-weight: bold;
        }
        .order-header{
            display: inline-flex;
            width: 100%;
        }
        .order-header-area .x_title{
            border: none !important;
            color: #0c0c0c;
        }
        .order-header-area .x_panel{
            border: none !important;
            background: none;
        }
        .x_title span {
            color: #34495e !important;
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
                        </span>
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
                    </span>
                </div>
                <div class="header-location">
                    <span class="order-location"></span>
                </div>
                <div class="header-time"><span class="order-time"></span></div>
                <div class="button-right">
                    <a class="close-link"><i class="fa fa-close"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content order_x_content display-none">
                <ul class="list-unstyled order-item-list">

                </ul>
            </div>
        </div>
    </div>
    <ul id="order-item-template" class="display-none">
        <li class="order-item">
            <div class="col-md-12 col-ms-12 col-xs-12">
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
                        <span>- Giá :</span> <span class="order-item-price">20,000</span> <span class="">VNĐ</span>
                    </div>
                    <div class="order-prop">
                        <span>- Số lượng :</span> <span class="order-item-quantity">5</span>
                    </div>
                </span>
                </div>

            </div>
        </li>
    </ul>
@endsection
@push("js")
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script>
        $(document).ready(function () {
            var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
                cluster: '{{env('PUSHER_APP_CLUSTER')}}',
                encrypted: true
            });
            var channel = pusher.subscribe('{{\App\Core\Common\OrderConst::OrderChannelToWaiter}}');
            var eventName = "{{\App\Core\Common\OrderConst::OrderEventName}}";
            channel.bind(eventName, addOrder);

            //Show - Hide order detail
            $(document).on('click','.collapse-link',function(){
                var parent = $(this).parents('.order-detail-list');
                if($(parent).find('.order_x_content').hasClass('display-none')){
                    $(parent).find('.order_x_content').removeClass('display-none');
                    $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
                }else{
                    $(parent).find('.order_x_content').addClass('display-none');
                    $(this).find('i').addClass('fa-chevron-down').removeClass('fa-chevron-up');
                }
            });
            $(document).on('click','.close-link',function(){
                $(this).parents('.order-detail-list').remove();
                deleteOrder();
            });
        });

        //function add message
        function addOrder(data) {
            var entity = JSON.stringify(data.entity);
            var orderArea = $('#order-template').clone();
            $(orderArea).removeClass('display-none');
            $(orderArea).removeAttr('id');
            $.each(data.entity, function (index, item) {
                var liTag = $('#order-item-template').children('li').clone();
                $(liTag).removeClass('display-none');
                $(liTag).removeAttr('id');
                $(liTag).find('.order-item-name').html(item.name);
                $(liTag).find('.order-item-price').text(item.price);
                $(liTag).find('.order-item-quantity').text(item.quantity);
                $(liTag).find('.order-avatar img').attr('src', item.avatar);
                $(orderArea).find('.order-item-list').append(liTag);
            });
            $(orderArea).find('.order-total-price').html(data.totalPrice);
            $(orderArea).find('.order-location').html(data.locationId);
            $(orderArea).find('.order-time').text(data.dateTimeOrder);
            $('#order-waiting-list').append(orderArea);
        }
        function deleteOrder(){

        }
    </script>
@endpush