@extends("layouts.layout3")
@section('css')
    <link href="{{ asset('frontend/css/style_order.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="wraper">
        {{--================================= Left ===========================--}}
        <div class="wraper-left col-sm-6 nopad">

            <div id="left-nav-tabs" class="header-left">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#home" data-toggle="tab">Table/Floor</a>
                    </li>
                    <li><a href="#menu" data-toggle="tab">Menu</a></li>

                    <li class="col-md-7 col-sm-6">
                        <form action="#" method="#" role="search">
                            <div class="input-group">
                                <input class="form-control" placeholder="Search . . ." name="srch-term"
                                       id="ed-srch-term" type="text">
                                <div class="input-group-btn">
                                    <button type="submit" id="searchbtn">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>


                </ul>
            </div>
            <div class="tab-content content-left">
                <div id="home" class="tab-pane fade in active">
                    <div class="room">
                        <nav class="navbar navbar-inverse">
                            <div class="container-fluid">
                                <ul class="nav navbar-nav" id="floors">
                                    <li class="item-floor"><a href="javascript:void(0);" item-floor-id="">All</a></li>
                                    {{--content floor--}}
                                </ul>
                                {{--content floor include--}}
                                @include('frontend.order-manager.floors')
                            </div>
                        </nav>
                    </div>

                    <div id="table-list">
                        {{--content TABLE--}}
                    </div>
                    {{--content TABLE INCLUDE--}}
                    @include('frontend.order-manager.tables')
                </div>
                <div id="menu" class="tab-pane fade">
                    <div class="category">
                        <nav class="navbar navbar-inverse">
                            <div class="container-fluid">
                                <ul class="nav navbar-nav" id="entity-menu">
                                    {{--content menu--}}

                                </ul>
                                {{--content menu include--}}
                                @include('frontend.order-manager.menu')
                            </div>
                        </nav>

                    </div>


                    <div id="list-entities">
                        {{--content entities--}}
                    </div>
                    {{--content entities include--}}
                    @include('frontend.order-manager.entities')
                </div>
            </div>

        </div>

    </div>

    </div>
    {{--================================= Right ===========================--}}
    <div class="wraper-right col-sm-6">
        <div class="header-right">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#"><span id="table-id">Bàn</span>/<span id="floor-id">Tầng</span></a>
                </li>
                <li style="float: right; margin-right: 10px;">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span
                                    class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" style="top:43px;right:-10px;">
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal"><span
                                            class="glyphicon glyphicon-retweet"></span> Chuyển Bàn</a></li>
                            <li class="line"></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal2"><span
                                            class="glyphicon glyphicon-link" aria-hidden="true"></span> Ghép Bàn</a>
                            </li>
                            <li class="line"></li>
                            <li><a class="dropdown-item" href="#"><span class="glyphicon glyphicon-phone-alt"
                                                                        aria-hidden="true"></span> Liên Hệ Thu Ngân</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

        </div>
        <div class="content-right">
                <div class="row">
                    <div class="col-md-1">Id</div>
                    <div class="col-md-5">Datetime</div>
                    <div class="col-md-3">Status</div>
                    <div class="col-md-3">Action</div>
                </div>
                <div id="entities-order">
                </div>

            {{--content entities-order include--}}
            @include('frontend.order-manager.entities-order')
            @include('frontend.order-manager.entities-detail')

            {{--<div class="table table-hover" id="tbl_list_order_detail" style="display: block">--}}
                {{--<div class="wrap_order_detail_header">--}}
                {{--<div class="order_detail_header">--}}
                    {{--<div class="order_detail_image text-center">Image</div>--}}
                    {{--<div class="order_detail_name text-center">Name</div>--}}
                    {{--<div class="order_detail_price text-center">Price</div>--}}
                    {{--<div class="order_detail_quantity text-center">Quantity</div>--}}
                    {{--<div class="order_detail_subtotal text-center">Subtotal</div>--}}
                    {{--<div class="order_detail_action text-center">Action</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div id="entities-detail">--}}
                {{--//content entities-detail--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--//content entities-detail include--}}
            {{--@include('frontend.order-manager.entities-detail')--}}

        </div>
        @include('frontend.order-manager.table_manager')

    </div>
    </div>
@endsection
@section('javascript')
<script src="{{asset('frontend/js/order.js')}}"></script>
<script type="text/javascript">
    var idStore = '{{$idStore}}';
    $(document).ready(function () {
        getMenuList(idStore);
        getEntities(idStore);
        getFloors(idStore);
        getTable(null);
        PusherEvent();//create pusher event
        //getTableByFloor(null, idStore);
    });
    //pusher event
    function PusherEvent(){
        var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
                cluster: '{{env('PUSHER_APP_CLUSTER')}}',
                encrypted: true
            });
        var eventName = "{{\App\Core\Common\OrderConst::Customer2Order}}";
        var channel_name = '{{\App\Core\Helpers\CommonHelper::getOrderEventName($idStore,\App\Core\Common\OrderConst::Customer2Order)}}';
        var channel = pusher.subscribe(channel_name);
        channel.bind(eventName, function(data){
            $('*[location-id="'+data.location_id+'"]').removeClass('have-order');//remove class order, add class update
            $('*[location-id="'+data.location_id+'"]').addClass("have-update");
        });
    }
    //====================GET MENU==============================
    function getMenuList(idStore) {

        $.ajax({
            url: '{{route("food/list-menu-by-store")}}' + '/' + idStore,
            dataType: 'JSON',
            type: 'GET',
            data: {idStore: idStore},
            success: function (data) {
                genMenuList(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error ' + xhr.status + ' | ' + thrownError);
            },
        });
    }

    function genMenuList(data) {
        var itemMenu = $('#entity-menu');
        data.data.forEach(function (obj) {
            var itemMenuTemp = $('#entity-menu-template').contents().clone();
            $(itemMenuTemp).find('a').text(obj.name);
            $(itemMenuTemp).find('a').attr('item-menu-id', obj.id);
            $(itemMenu).append($(itemMenuTemp));
        })
    }

    //========================GET ENTITIES==========================
    function getEntities(idStore) {
        $.ajax({
            url: '{{route('food/list-by-store')}}' + '/' + idStore,
            dataType: 'JSON',
            type: 'GET',
            data: {idStore: idStore},
            success: function (data) {
                genEntities(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error ' + xhr.status + ' | ' + thrownError);
            },
        });
    }

    function genEntities(data) {
        var listItem = $('#list-entities');
        $(listItem).empty();
        data.data.forEach(function (obj) {
            var listItemTemp = $('#list-entities-template').contents().clone();
            $(listItemTemp).find('.entities_item').attr('entities-id', obj.id);
            $(listItemTemp).find('.entities_item').attr('entities-name', obj.name);
            $(listItemTemp).find('.entities_item').attr('entities-image', obj.image);
            $(listItemTemp).find('.entities_item').attr('entities-price', obj.price);
            $(listItemTemp).find('img').attr('src', obj.image);
            $(listItemTemp).find('h6').text(obj.name);
            $(listItemTemp).find('h5').text(parseInt(obj.price));

            $(listItem).append($(listItemTemp));
        })
    }

    //=====================GET ENTITIES BY MENU==========================
    //Click menu
    $(document).on('click', '.item-menu', function () {
        var idMenu = $(this).find('a').attr('item-menu-id');
        getEntitiesByMenu(idMenu, idStore);
    })


    function getEntitiesByMenu(idMenu, idStore) {
        $.ajax({
            url: '{{route("food/list-by-menu")}}' + '/' + idMenu,
            dataType: 'JSON',
            type: 'GET',
            data: {idMenu: idMenu, idStore: idStore},
            success: function (data) {
                genEntities(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error ' + xhr.status + ' | ' + thrownError);
            },
        });
    }

    //======================GET FLOOR============================
    function getFloors(idStore) {
        $.ajax({
            url: '{{route("food/list-floor-by-store")}}',
            dataType: 'JSON',
            type: 'GET',
            data: {idStore: idStore},
            success: function (data) {
                genFloors(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error ' + xhr.status + ' | ' + thrownError);
            },
        })
    }

    function genFloors(data) {
        var itemFloor = $('#floors');
        data.data.forEach(function (obj) {
            var itemFloorTemp = $('#floors-template').contents().clone();
            $(itemFloorTemp).find('a').text(obj.name);
            $(itemFloorTemp).find('a').attr('item-floor-id', obj.id);
            $(itemFloor).append($(itemFloorTemp));
        })
    }

    //======================GET TABLE============================
    function getTable(idFloor) {
        $.ajax({
            url: '{{route("food/get-location")}}',
            dataType: 'JSON',
            type: 'GET',
            data: {idStore: idStore,idFloor:idFloor},
            success: function (data) {
                genTable(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error ' + xhr.status + ' | ' + thrownError);
            },
        })
    }

    function genTable(data){
        var itemTable = $('#table-list');
        $(itemTable).empty();
        data.data.forEach(function (obj) {
            var itemTableTemp = $('#table-list-template').contents().clone();
            var order_data = $(itemTableTemp)[1];
            var have_update =0;
            obj.arrOrder.forEach(function(orderItem){
                //nếu order đó cập nhập thì time order sẽ khác time update, lúc đó cập nhập color bàn
                if(orderItem.datetime_order!=orderItem.datetime_update){
                    have_update =1;
                }
            });
            if(obj.arrOrder.length>0){
                if(have_update!=0){
                    $(order_data).addClass("have-update");
                }else{
                    $(order_data).attr("data-order",1);
                    $(order_data).addClass("have-order");
                }
            }
            //add id location 
            $(order_data).attr('location-id', obj.id);
            $(itemTableTemp).find('.table-name').text(obj.name);
            $(itemTableTemp).find('.table-name').attr('item-table-id', obj.id);
            $(itemTableTemp).find('.table-name').attr('item-table-name', obj.name);
            $(itemTableTemp).find('.table-name').attr('item-floor-id', obj.floor_id);
            $(itemTableTemp).find('.table-name').attr('item-floor-name', obj.floor_name);
            $(itemTable).append($(itemTableTemp));
        })
    }

    //======================GET TABLE BY FLOOR============================
    $(document).on('click', '.item-floor', function () {
        var idFloor = $(this).find('a').attr('item-floor-id');
        getTable(idFloor);
    })

    //======================click table=========================
    $(document).on("click", ".wrap-table", function () {
        var idTable = $(this).find(".table-name").attr('item-table-id');
        var nameTable = $(this).find(".table-name").attr('item-table-name');
        var nameFloor = $(this).find(".table-name").attr('item-floor-name');
        //set location to order
        $('#table-id').text(nameTable);
        $('#floor-id').text(nameFloor);

        $.ajax({
            url: '{{route("food/list-order-by-location")}}',
            dataType: 'JSON',
            type: 'GET',
            data: {idLocation: idTable, idStore: idStore},
            success: function (data) {
                genOrderbyLocation(data);
            },
            err: function (xhr, ajaxOptions, thrownError) {
                console.log('Error ' + xhr.status + ' | ' + thrownError);
            }
        })

    });
    function genOrderbyLocation(data) {
        var itemOrder = $('#entities-order');
        $(itemOrder).empty();

        data.data.forEach(function (obj) {
            //set entities-order
            var itemOrderTemp = $('#entities-order-template').contents().clone();
            $(itemOrderTemp).find('.entities_order_id').text(obj.id);
            $(itemOrderTemp).find('.entities_order_id').attr('entities_order_id', obj.id);
            $(itemOrderTemp).find('.entities_order_time').text(obj.datetime_order);
            $(itemOrderTemp).find('.entities_order_status').text(obj.status_name);
            $(itemOrder).append($(itemOrderTemp));

            obj.detail.forEach(function(itemDetail){
                console.log(itemDetail);
                var rowDetail = $("#entities-detail-template").contents().clone();
                //append data
                $(rowDetail).find(".order_detail_name").text(itemDetail.name);
                $(rowDetail).find(".order_detail_price").text(itemDetail.price);
                $(rowDetail).find(".img-detail").attr("src",itemDetail.image);
                $(rowDetail).find(".quantity-detail").val(itemDetail.quantity);
                var row = $(itemOrderTemp)[3]; 
                $(row).append($(rowDetail));
            });
        })
    }
    //======================click show detail=========================
    $(document).on('click', '.show_detail', function () {
        var show= $(this).parents('.entities-row-order').next('.entities-row-detail');
        $(show).toggleClass('show');
    })

</script>
@endsection
