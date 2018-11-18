@extends('layouts.order')
<div class="item-order-list"></div>
@section('content')
    <style>
        .display-none{
            display: none;
        }
        .order-selected {
            border: 1px green solid;
            margin: 2px;
            border-radius: 11px;
        }
    </style>
    <div id="order-tmp" class="display-none order-selected"></div>
    <div id="item-order-tmp" class="item-order display-none">
        <div _ngcontent-c7="" class="row-list" id="153622183440520">
            <div _ngcontent-c7="" class="cell-order"></div>
            <div _ngcontent-c7="" class="cell-action">
                <a _ngcontent-c7="" class="fas fa-times-circle" href="#" title="Xóa hàng hóa">
                    <i _ngcontent-c7=""></i>
                </a>
            </div>
            <div _ngcontent-c7="" class="row-product">
                <div _ngcontent-c7="" class="cell-name full">
                    <h4 _ngcontent-c7="" class="item-name">
                    </h4>
                </div>
                <div _ngcontent-c7="" class="item-quantity"></div>
                <div _ngcontent-c7="" class="item-price"></div>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
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
        });

        //function add message
        function addOrder(data) {
            var entity = JSON.stringify(data.entity);
            var orderArea =  $('#order-tmp').clone();
            $(orderArea).removeClass('display-none');
            $(orderArea).removeAttr('id');
            $.each(data.entity, function (index, item) {
                var liTag = $("#item-order-tmp").clone();
                $(liTag).removeClass('display-none');
                $(liTag).removeAttr('id');
                $(liTag).find('.item-name').html(item.name);
                $(liTag).find('.item-quantity').text(item.quantity);
                $(liTag).find('.item-price').text(item.price);
                $(orderArea).append(liTag);

            });
            $('.item-order-list').append(orderArea);
        }
    </script>

@endsection

