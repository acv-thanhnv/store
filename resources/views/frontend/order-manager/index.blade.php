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
                    <li class="active tab_table tab-search" data-tab='table'>
                        <a href="#home" data-toggle="tab">Table/Floor</a>
                    </li>
                    <li class="tab_menu tab-search" data-tab='menu'>
                        <a href="#menu" data-toggle="tab">Menu</a>
                    </li>

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
                                    <li class="item-menu"><a href="javascript:void(0);" item-menu-id="*">All</a></li>
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
                <li>
                    <a href="#" class="fa fa-plus new_order"> New Order</a>
                </li>
                <li style="float: right; margin-right: 10px;">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span
                                    class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" style="top:43px;right:-10px;">
                            <li><a id="move_table" class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal"><span
                                            class="glyphicon glyphicon-retweet"></span> Chuyển Bàn</a></li>
                            <li class="line"></li>
                            <li><a id="merge_table" class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal2"><span
                                            class="glyphicon glyphicon-link" aria-hidden="true"></span> Ghép Bàn</a>
                            </li>
                            <li class="line"></li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Liên Hệ Thu Ngân
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

        </div>
        <div class="content-right">
                <div class="row order-header">
                    <div class="col-md-1 order-id">Id</div>
                    <div class="col-md-4 order-date">Datetime</div>
                    <div class="col-md-4 order-status">Status</div>
                    <div class="col-md-3 order-action">Action</div>
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
    var idStore        = '{{$idStore}}';
    var idTable,idFloor;
    var arrOrderChange = [];
    var now            = '{{\App\Core\Helpers\CommonHelper::dateNow()}}';
    //get order status and name
    var status_order_noDone = parseInt('{{\App\Core\Common\OrderStatusValue::NoDone}}');
    var status_order_Done = parseInt('{{\App\Core\Common\OrderStatusValue::Done}}');
    var status_order_Proccess = parseInt('{{\App\Core\Common\OrderStatusValue::Process}}');

    var name_order_noDone = '{{\App\Core\Helpers\CommonHelper::getOrderStatusName(0)}}';
    var name_order_Done = '{{\App\Core\Helpers\CommonHelper::getOrderStatusName(2)}}';
    var name_order_Proccess = '{{\App\Core\Helpers\CommonHelper::getOrderStatusName(1)}}';

    //get food status and name
    var status_food_noDone = parseInt('{{\App\Core\Common\FoodStatusValue::NoDone}}');
    var status_food_Done = parseInt('{{\App\Core\Common\FoodStatusValue::Done}}');
    var status_food_Proccess = parseInt('{{\App\Core\Common\FoodStatusValue::Process}}');

    var name_food_noDone = '{{\App\Core\Helpers\CommonHelper::getFoodStatusName(0)}}';
    var name_food_Done = '{{\App\Core\Helpers\CommonHelper::getFoodStatusName(2)}}';
    var name_food_Proccess = '{{\App\Core\Helpers\CommonHelper::getFoodStatusName(1)}}';

    $(document).ready(function () {
        getMenuList(idStore);
        getEntities(idStore);
        getFloors(idStore);
        getTable(null);
        PusherEvent();//create pusher event
        //getTableByFloor(null, idStore);
    });
    $(document).on('click', '#move_table', function (data) {
        $.ajax({
            url: '{{route("floor-location")}}',
            dataType: 'JSON',
            type: 'GET',
            data: {idStore: idStore},
            success: function (data) {
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log('Error ' + xhr.status + ' | ' + thrownError);
            },
        });
    })
    //pusher event
    function PusherEvent(){
        var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
                cluster: '{{env('PUSHER_APP_CLUSTER')}}',
                encrypted: true
            });
        //table event
        var TableEventName = '{{\App\Core\Common\TableConst::TableColorEvent}}';
        var table_channel_name = '{{\App\Core\Helpers\CommonHelper::getOrderEventName($idStore,\App\Core\Common\TableConst::TableColorEvent)}}';
        var table_channel = pusher.subscribe(table_channel_name);
        table_channel.bind(TableEventName, function(data){
            $('*[location-id="'+data.idTable+'"]').removeClass('have-order have-update').css({'background-color':data.color,'color':'white'});
        });
        //food event
        var FoodEventName = '{{\App\Core\Common\FoodStatusValue::FoodStatusEvent}}';
        var food_channel_name = '{{\App\Core\Helpers\CommonHelper::getOrderEventName($idStore,\App\Core\Common\FoodStatusValue::FoodStatusEvent)}}';
        var food_channel = pusher.subscribe(food_channel_name);
        food_channel.bind(FoodEventName, function(data){
            var row_order = $('.entities-row-order[data-order-id="'+data.orderId+'"]').next();
            console.log(row_order);
            var row_order_detail = $(row_order).find('.row-order-detail[order-detail-id="'+data.idDetail+'"]');
            $(row_order_detail).find('.food_status').text(data.foodStatusName);
            $(row_order_detail).find('.food_status').addClass('food_status_'+data.foodStatus);
        });
        //order event
        var OrderEventName = "{{\App\Core\Common\OrderConst::Customer2Order}}";
        var order_channel_name = '{{\App\Core\Helpers\CommonHelper::getOrderEventName($idStore,\App\Core\Common\OrderConst::Customer2Order)}}';
        var order_channel = pusher.subscribe(order_channel_name);
        order_channel.bind(OrderEventName, function(data){
            //get order and append
            if(data.order.location_id==idTable && idStore == data.idStore){
                genOrderRealtime(data.order,data.result);
            }
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
                console.log(data);
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
            $(listItemTemp).find('.entities_item').attr('entities-image', obj.src);
            $(listItemTemp).find('.entities_item').attr('entities-price', obj.price);
            $(listItemTemp).find('img').attr('src', obj.src);
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
                //nếu trong bàn đó có các order chưa xác nhận hoặc cập nhập món thì hiện cập nhập
                if(orderItem.status< '{{\App\Core\Common\OrderStatusValue::Process}}'){
                    have_update = 1;
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
        idFloor = $(this).find('a').attr('item-floor-id');
        getTable(idFloor);
    })

    //======================click table=========================
    $(document).on("click", ".wrap-table", function () {
        idTable = $(this).find(".table-name").attr('item-table-id');
        idFloor = $(this).find('.table-name').attr('item-floor-id');
        var nameTable = $(this).find(".table-name").attr('item-table-name');
        var nameFloor = $(this).find(".table-name").attr('item-floor-name');
        //set location to order
        $('#table-id').text(nameTable);
        $('#floor-id').text(nameFloor);
        getOrderByLocation(idTable,idStore);
    });

    //======================add new order=========================
    $(document).on('click','.new_order',function(e){
        e.preventDefault(); 
        //neu ko co ban duoc chon thi thong bao loi
        if(typeof(idTable) ==='undefined'){
            notify('Error','error','Sorry, your must choose table for add new order','#AA3131','#792A2A');
        }else{
            $.ajax({
                url: '{{route("newOrder")}}',
                dataType: 'JSON',
                type: 'GET',
                data: {idStore: idStore,idTable:idTable},
                success: function (data) {
                    var itemOrder     = $('#entities-order');
                    var itemOrderTemp = $('#entities-order-template').contents().clone();
                    var row_id        = $(itemOrderTemp)[1];
                    $(row_id).attr("data-order-id",data.id);
                    $(itemOrderTemp).find('.entities_order_id').text(data.id);
                    $(itemOrderTemp).find('.entities_order_id').attr('entities_order_id', data.id);
                    $(itemOrderTemp).find('.entities_order_time').text(data.datetime_order);
                    $(itemOrderTemp).find('.entities_order_status_content').text(data.status_name);
                    $(itemOrderTemp).find('.entities_order_status_content').addClass("status_"+data.status);
                    $(itemOrderTemp).find('.entities_order_status_content').attr("order-status",data.status);
                    $(itemOrderTemp).find('.no-data').removeClass('dis-none');
                    $(itemOrder).append($(itemOrderTemp));
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('Error ' + xhr.status + ' | ' + thrownError);
                },
            })
        }
    })

    function getOrderByLocation(idTable,idStore){
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
    }

    function genOrderbyLocation(data) {
        var itemOrder = $('#entities-order');
        $(itemOrder).empty();

        data.data.forEach(function (obj) {
            //set entities-order
            var itemOrderTemp = $('#entities-order-template').contents().clone();
            var row_id = $(itemOrderTemp)[1];
            var row = $(itemOrderTemp)[3];//order detail
            $(row_id).attr("data-order-id",obj.id);
            $(itemOrderTemp).find('.entities_order_id').text(obj.id);
            $(itemOrderTemp).find('.entities_order_id').attr('entities_order_id', obj.id);
            $(itemOrderTemp).find('.entities_order_time').text(obj.datetime_order);
            $(itemOrderTemp).find('.entities_order_status_content').text(obj.status_name);
            $(itemOrderTemp).find('.entities_order_status_content').attr('order-status',obj.status);
            $(itemOrderTemp).find('.entities_order_status_content').addClass("status_"+obj.status);
            $(itemOrder).append($(itemOrderTemp));
            if(obj.detail.length==0){
                $(row).find('.no-data').removeClass('dis-none');
            }else{
                obj.detail.forEach(function(itemDetail){
                    var rowDetail = $("#entities-detail-template").contents().clone();
                    //append data
                    var rowDetailId = $(rowDetail)[1];
                    $(rowDetailId).attr('order-detail-id',itemDetail.id);
                    $(rowDetailId).attr('entities-id',itemDetail.entities_id);
                    $(rowDetail).find(".order_detail_name").text(itemDetail.name);
                    $(rowDetail).find(".order_detail_price").text(itemDetail.price);
                    $(rowDetail).find(".img-detail").attr("src",itemDetail.src);
                    $(rowDetail).find(".quantity-detail").val(itemDetail.quantity);
                    $(rowDetail).find(".quantity-detail").attr('data-num_product',itemDetail.quantity);
                    if(itemDetail.has_update===1){
                        $(rowDetail).find(".has_change").css('display','block');
                    }
                    $(rowDetail).find(".food_status").text(itemDetail.status_name);
                    $(rowDetail).find(".food_status").addClass('food_status_'+itemDetail.status);
                    $(rowDetail).find(".food_status").attr('food-status',itemDetail.status);
                    $(rowDetail).find(".delete-order-detail").attr('data-order-detail',itemDetail.id);
                    $(row).attr('order-id',obj.id); 
                    $(row).append($(rowDetail));
                });
            }
        })
    }

    function genOrderRealtime(order,obj){
        var itemOrder        = $('#entities-order');
        var row_order        = $('.entities-row-order[data-order-id="'+order.id+'"]');
        var row_order_detail = $('.entities-row-order[data-order-id="'+order.id+'"]').next();
        $(row_order_detail).empty();
        if(row_order_detail.length!=0){//neu co thi cap nhap order
            var order_status = $(row_order).find('.entities_order_status_content').attr('order-status');
            //update status and status name of order
            $(row_order).find('.entities_order_status_content').text(order.status_name);
            $(row_order).find('.entities_order_status_content').attr('order-status',order.status);
            $(row_order).find('.entities_order_status_content').removeClass('status_0 status_1 status_2').addClass('status_'+order.status);
            //nếu ko có item nào trong order thì hiện nodata ngược lại thì append data
            if(obj.length==0){
                $(row_order_detail).html('<span class="no-data"><i class="fa fa-minus-circle"></i> No data found!</span>');
            }else{
                obj.forEach(function(itemDetail){
                    var rowDetail = $("#entities-detail-template").contents().clone();
                    //append data
                    var rowDetailId = $(rowDetail)[1];
                    //add iddetail for row
                    $(rowDetailId).attr('order-detail-id',itemDetail.id);
                    $(rowDetailId).attr('entities-id',itemDetail.entities_id);
                    $(rowDetail).find(".order_detail_name").text(itemDetail.name);
                    $(rowDetail).find(".order_detail_price").text(itemDetail.price);
                    $(rowDetail).find(".img-detail").attr("src",itemDetail.src);
                    $(rowDetail).find(".quantity-detail").val(itemDetail.quantity);
                    $(rowDetail).find(".quantity-detail").attr('data-num_product',itemDetail.quantity);
                    if(itemDetail.has_update===1){
                        $(rowDetail).find(".has_change").css('display','block');
                    }
                    $(rowDetail).find(".food_status").text(itemDetail.status_name);
                    $(rowDetail).find(".food_status").addClass('food_status_'+itemDetail.status);
                    $(rowDetail).find(".food_status").attr('food-status',itemDetail.status);
                    $(rowDetail).find(".delete-order-detail").attr('data-order-detail',itemDetail.id);
                    $(row_order_detail).append($(rowDetail));
                });
            }
        }else {//ko thi append order moi
            var itemOrderTemp = $('#entities-order-template').contents().clone();
            var row_id = $(itemOrderTemp)[1];
            $(row_id).attr("data-order-id",order.id);
            $(itemOrderTemp).find('.entities_order_id').text(order.id);
            $(itemOrderTemp).find('.entities_order_id').attr('entities_order_id', order.id);
            $(itemOrderTemp).find('.entities_order_time').text(order.datetime_order);
            $(itemOrderTemp).find('.entities_order_status_content').text(order.status_name);
            $(itemOrderTemp).find('.entities_order_status_content').addClass("status_"+order.status);
            $(itemOrderTemp).find('.entities_order_status_content').attr("order-status",order.status);
            $(itemOrder).append($(itemOrderTemp));

            obj.forEach(function(itemDetail){
                var rowDetail = $("#entities-detail-template").contents().clone();
                //append data
                var rowDetailId = $(rowDetail)[1];
                //add iddetail for row
                $(rowDetailId).attr('order-detail-id',itemDetail.id);
                $(rowDetailId).attr('entities-id',itemDetail.entities_id);
                $(rowDetail).find(".order_detail_name").text(itemDetail.name);
                $(rowDetail).find(".order_detail_price").text(itemDetail.price);
                $(rowDetail).find(".img-detail").attr("src",itemDetail.src);
                $(rowDetail).find(".quantity-detail").val(itemDetail.quantity);
                $(rowDetail).find(".quantity-detail").attr('data-num_product',itemDetail.quantity);
                if(itemDetail.has_update===1){
                    $(rowDetail).find(".has_change").css('display','block');
                }
                $(rowDetail).find(".food_status").text(itemDetail.status_name);
                $(rowDetail).find(".food_status").addClass('food_status_'+itemDetail.status);
                $(rowDetail).find(".food_status").attr('food-status',itemDetail.status);
                $(rowDetail).find(".delete-order-detail").attr('data-order-detail',itemDetail.id);
                var row = $(itemOrderTemp)[3]; 
                $(row).attr('order-id',order.id);
                $(row).append($(rowDetail));
            });
        }
    }

    function genOrderDetailByOrder(order,obj){
        var itemOrder        = $('#entities-order');
        var row_order        = $('.entities-row-order[data-order-id="'+order.id+'"]');
        var row_order_detail = $('.entities-row-order[data-order-id="'+order.id+'"]').next();
        $(row_order_detail).empty();
        var order_status = $(row_order).find('.entities_order_status_content').attr('order-status');
        //update status and status name of order
        $(row_order).find('.entities_order_status_content').text(order.status_name);
        $(row_order).find('.entities_order_status_content').attr('order-status',order.status);
        $(row_order).find('.entities_order_status_content').removeClass(' status_0 status_2').addClass('status_1');
        obj.forEach(function(itemDetail){
            var rowDetail = $("#entities-detail-template").contents().clone();
            //append data
            var rowDetailId = $(rowDetail)[1];
            //add iddetail for row
            $(rowDetailId).attr('order-detail-id',itemDetail.id);
            $(rowDetailId).attr('entities-id',itemDetail.entities_id);
            $(rowDetail).find(".order_detail_name").text(itemDetail.name);
            $(rowDetail).find(".order_detail_price").text(itemDetail.price);
            $(rowDetail).find(".img-detail").attr("src",itemDetail.src);
            $(rowDetail).find(".quantity-detail").val(itemDetail.quantity);
            $(rowDetail).find(".quantity-detail").attr('data-num_product',itemDetail.quantity);
            if(itemDetail.has_update===1){
                $(rowDetail).find(".has_change").css('display','block');
            }
            $(rowDetail).find(".food_status").text(itemDetail.status_name);
            $(rowDetail).find(".food_status").addClass('food_status_'+itemDetail.status);
            $(rowDetail).find(".food_status").attr('food-status',itemDetail.status);
            $(rowDetail).find(".delete-order-detail").attr('data-order-detail',itemDetail.id);
            $(row_order_detail).append($(rowDetail));
        });
    }
    //======================click show detail=========================
    $(document).on('click', '.show_detail', function () {
        var show= $(this).parents('.entities-row-order').next('.entities-row-detail');
        $(show).toggleClass('show');
    })

    //======================change quantity of food=========================
    $(document).on('click','.num-product-down',function(){
        var num_product     = $(this).next('.quantity-detail').val();
        var old_num_product = $(this).next('.quantity-detail').data('num_product');
        var order_detail_id = $(this).parents('.row-order-detail').attr('order-detail-id'); 
        if(num_product>1){
            num_product--;
            $(this).next('.quantity-detail').val(num_product);
            //khi thay đổi thì order chuyển về trạng thái chưa xác nhận để order biết cập nhập
            $(this).parents('.entities-row-detail').prev('.entities-row-order').find('.entities_order_status_content').removeClass('status_1 status_2').addClass('status_0').attr('order-status',status_order_noDone).text(name_order_noDone);
            //chuyển trạng thái của món ăn về chưa xác nhận
            $(this).parents('.row-order-detail').find('.food_status').removeClass('food_status_2 food_status_1').addClass('food_status_0').attr('food-status',status_food_noDone).text(name_food_noDone);
            if(typeof(order_detail_id) !== "undefined" && num_product!=old_num_product){//kiem tra neu co order detail thi hien ngoi sao thay doi
                $(this).siblings(".has_change").css('display','block');
            }else{
                $(this).siblings(".has_change").css('display','none');
            }
        }
    });

    $(document).on('click','.num-product-up',function(){
        var num_product     = $(this).prev('.quantity-detail').val();
        var old_num_product = $(this).prev('.quantity-detail').data('num_product');
        num_product++;
        var order_detail_id = $(this).parents('.row-order-detail').attr('order-detail-id');
        $(this).prev('.quantity-detail').val(num_product);
        //khi thay đổi thì order chuyển về trạng thái chưa xác nhận để order biết cập nhập
        $(this).parents('.entities-row-detail').prev('.entities-row-order').find('.entities_order_status_content').removeClass('status_1 status_2').addClass('status_0').attr('order-status',status_order_noDone).text(name_order_noDone);
        //chuyển trạng thái của món ăn về chưa xác nhận
        $(this).parents('.row-order-detail').find('.food_status').removeClass('food_status_2 food_status_1').addClass('food_status_0').attr('food-status',status_food_noDone).text(name_food_noDone);
        if(typeof(order_detail_id) !== "undefined" && num_product!=old_num_product){//kiem tra neu co order detail thi hien ngoi sao thay doi
            $(this).next(".has_change").css('display','block');
        }else{
            $(this).next(".has_change").css('display','none');
        }
    });

    $(document).on('change','.quantity-detail',function(){
        var old_num_product = $(this).data('num_product');
        var num_product     = $(this).val();
        var order_detail_id = $(this).parents('.row-order-detail').attr('order-detail-id');
        if(num_product>0){
            $(this).val(num_product);
            //khi thay đổi thì order chuyển về trạng thái chưa xác nhận để order biết cập nhập
            $(this).parents('.entities-row-detail').prev('.entities-row-order').find('.entities_order_status_content').removeClass('status_1 status_2').addClass('status_0').attr('order-status',status_order_noDone).text(name_order_noDone);
            //chuyển trạng thái của món ăn về chưa xác nhận
            $(this).parents('.row-order-detail').find('.food_status').removeClass('food_status_2 food_status_1').addClass('food_status_0').attr('food-status',status_food_noDone).text(name_food_noDone);
            if(typeof(order_detail_id) !== "undefined" && num_product!=old_num_product){//kiem tra neu co order detail thi hien ngoi sao thay doi
                $(this).siblings(".has_change").css('display','block');
            }else{
                $(this).siblings(".has_change").css('display','none');
            }
        }else {
            notify('Error','error','Sorry, your number product must larger than 1!','#AA3131','#792A2A');
            $(this).siblings(".has_change").css('display','none');
            $(this).val(old_num_product);
        }
    });

    //======================search table or food=========================
    $(document).on('click','#searchbtn',function(e){
        e.preventDefault();
        var key = $("#ed-srch-term").val();
        var tab = $(".tab-search.active").data('tab');
        $.ajax({
            url: '{{route("OrderSearch")}}',
            type: 'GET',
            data: {key: key, tab: tab,idStore:idStore},
            success: function (data) {
                //nếu tìm kiếm món ăn thì gen món ăn, ngược lại gen table
                if(data.tab=='menu'){
                    genEntities(data.data);
                }else{
                    genTable(data.data);
                }
            },
            err: function (xhr, ajaxOptions, thrownError) {
                console.log('Error ' + xhr.status + ' | ' + thrownError);
            }
        })

    })
    //======================add food=========================
    $(document).on('click','.add_food',function(){
        $(this).find('.fa-plus').toggleClass('fa-minus');
        //show order tail
        $(this).parents('.entities-row-order').next('.entities-row-detail').toggleClass('show');
        //add class to show which row is active
        $(this).parents('.entities-row-order').toggleClass('row_active');
    });

    $(document).on('click','.entities_item',function(){
        var entities_id = $(this).attr('entities-id');
        var entities_name = $(this).attr('entities-name');
        var entities_image = $(this).attr('entities-image');
        var entities_price = $(this).attr('entities-price');
        var objFood = {
            entities_id:entities_id,entities_name:entities_name,
            entities_image:entities_image,entities_price:entities_price,
            status_name:'Chưa xác nhận',status:0
        };
        var num_row_active = $('.entities-row-order.row_active').length;//lấy số dòng đang được chọn để thêm
        //nếu bàn chưa được chọn hoặc bạn được chọn nhưng chưa chọn order
        if(typeof(idTable)==='undefined' ||num_row_active==0){
            notify('Warning','warning','Please choose order to add !','#E99551','#F4AD32');
        }else{
            $('.entities-row-order.row_active').each(function(){
                //remove nodata row
                $(this).next('.entities-row-detail').find('.no-data').addClass('dis-none');
                //Chuyển trạng thái của order về chưa xác nhận
                $(this).find('.entities_order_status_content').removeClass('status_1 status_2').addClass('status_0').attr('order-status',status_order_noDone).text(name_order_noDone);
                var row_detail = $(this).next('.entities-row-detail');
                //duyet vao mang cac mon an chi tiet, neu co mon do roi thi tang so luong
                $(row_detail).each(function(){
                    var numRow = $(this).find('.row-order-detail[entities-id="'+objFood.entities_id+'"]');
                    if(numRow.length>0){// neu tim thay mon do thi tang so luong
                        //lay so luong cua mon an hien tai ve
                        var numProduct = $(numRow).find('.quantity-detail').val();
                        //Lay order detail id cua mon do
                        var order_detail_id = $(numRow).attr('order-detail-id');
                        if(typeof(order_detail_id) !== "undefined" && order_detail_id!=""){
                        //nếu món đó đã được order rồi thì hiện thay đổi  và cập nhập trạng thái của món đó
                            $(numRow).find(".has_change").css('display','block');

                            //chuyển trạng thái của món ăn về chưa xác nhận
                            $(numRow).find('.food_status').removeClass('food_status_2 food_status_1').addClass('food_status_0').attr('food-status',status_food_noDone).text(name_food_noDone);
                        }
                        //tang so luong cua mon len 1
                        numProduct++;
                        $(numRow).find('.quantity-detail').val(numProduct);
                    }else{//nguoc lai thi them mon vao
                        var rowDetail = $("#entities-detail-template").contents().clone();
                        //append data
                        var rowDetailId = $(rowDetail)[1];
                        $(rowDetailId).attr('entities-id',objFood.entities_id);
                        //add id detail =null for row
                        $(rowDetailId).attr('order-detail-id',"");
                        $(rowDetail).find(".order_detail_name").text(objFood.entities_name);
                        $(rowDetail).find(".order_detail_price").text(objFood.entities_price);
                        $(rowDetail).find(".img-detail").attr("src",objFood.entities_image);
                        $(rowDetail).find(".quantity-detail").val(1);
                        $(rowDetail).find(".quantity-detail").attr('data-num_product',1);
                        $(rowDetail).find(".food_status").text(objFood.status_name);
                        $(rowDetail).find(".food_status").addClass('food_status_'+objFood.status);
                        $(rowDetail).find(".food_status").attr('food-status',objFood.status);
                        //nếu là món mới thì hiện sao để thông báo là có thay đổi
                        $(rowDetail).find(".has_change").css('display','block');
                        $(this).append($(rowDetail));
                    }
                });
            });
        }
    });

    //======================send order=========================
    $(document).on('click','.send_order',function(){
        var orderId          = parseInt($(this).parents('.entities_order_action').siblings('.entities_order_id').text());
        var status_order     = parseInt($(this).parents('.entities-row-order').find('.entities_order_status_content').attr('order-status'));
        var rowDetail        = $(this).parents('.entities-row-order').next('.entities-row-detail');
        var objOrder         = {};
        objOrder.orderId     = orderId;
        objOrder.status      = status_order;
        objOrder.orderDetail = [];
        $(rowDetail).find('.row-order-detail').each(function(){
            var order_detail_id         = $(this).attr('order-detail-id');
            var entities_id             = $(this).attr('entities-id');
            var order_detail_status     = parseInt($(this).find('.food_status').attr('food-status'));
            var order_detail_numProduct = $(this).find('.quantity-detail').val();
            var objOrderDetail          = {
                order_detail_id:order_detail_id,
                entities_id:entities_id,
                order_detail_status:order_detail_status,
                order_detail_numProduct:order_detail_numProduct
            };
            //nếu món ăn trong order có trạng thái là chưa xác nhận thì mới gửi đi và thêm vào array orderDetail
            if(order_detail_status===status_food_noDone){
                objOrder.orderDetail.push(objOrderDetail);
            }
        });
        //nếu tình trạng của order là chưa xác nhận và có món ăn trong đó thì mới được gửi đi
        if(objOrder.status === status_order_noDone && objOrder.orderDetail!=0){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route("Order2Chef")}}',
                type: 'POST',
                data: {objOrder: objOrder,idTable:idTable},
                success: function (data) {
                    notify('Success','success','Order was successfully send to chef !','#398717','#2F6227');
                    if(parseInt(data.numberTable)===0){
                        $('*[location-id="'+idTable+'"]').removeClass('have-update').addClass('have-order');
                    }
                    genOrderDetailByOrder(data.order,data.data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('Error ' + xhr.status + ' | ' + thrownError);
                }
            })
        }else{
            notify('Warning','warning','Nothing to send to chef !','#E99551','#F4AD32');
        }
    });

    //======================delete order=========================
    $(document).on('click','.delete_order',function(){
        var orderId = parseInt($(this).parents('.entities_order_action').siblings('.entities_order_id').text());
        var row = $(this).parents('.entities-row-order');
        $.confirm({
            title         : '<p class="text-danger">Warning</p>',
            icon          : 'fa fa-exclamation-circle',
            boxWidth      : '30%',
            useBootstrap  : false,
            type          : "red",
            closeIcon     : true,
            closeIconClass: 'fa fa-close',
            content       : "Are You Sure? This Order Will Be Deleted!",
            buttons       : {
                Save: {
                    text    : 'OK',
                    btnClass: 'btn btn-primary',
                    action  : function (){
                        $(row).next('.entities-row-detail').remove();
                        $(row).remove();
                        $.ajax({
                            url: '{{route("deleteOrder")}}',
                            type: 'GET',
                            data: {orderId: orderId},
                            success: function (data) {
                                notify('Success','success','This order was successfully deleted !','#398717','#2F6227');
                            }
                        })
                    }
                },
                cancel: {
                    text    : ' Cancel',
                    btnClass: 'btn btn-default'
                }
            }
        });
    });
    //======================delete food item of each order=========================
    $(document).on('click','.delete-order-detail',function(){
        var idOrderDetail = $(this).data('order-detail');
        var orderId       = $(this).parents('.entities-row-detail').attr('order-id');
        var entities_row  = $(this).parents('.entities-row-detail');
        var row           = $(this).parents('.row-order-detail');
        $.confirm({
            title         : '<p class="text-danger">Warning</p>',
            icon          : 'fa fa-exclamation-circle',
            boxWidth      : '30%',
            useBootstrap  : false,
            type          : "red",
            closeIcon     : true,
            closeIconClass: 'fa fa-close',
            content       : "Are You Sure? This Food Item Will Be Deleted!",
            buttons       : {
                Save: {
                    text    : 'OK',
                    btnClass: 'btn btn-primary',
                    action  : function (){
                        //xóa dòng hiện tại đi
                        $(row).remove();
                        //đếm số item còn lại của order sau khi xóa
                        var number_row_detail = $(entities_row).find('.row-order-detail').length;
                        //nếu số item còn lại của order bằng ko thì hiện no data
                        if(number_row_detail==0){
                            $(entities_row).find('.no-data').removeClass('dis-none');
                        }
                        //kiểm tra xem món đó đã được thêm vào DB chưa, nếu chưa thì chỉ cần remove dòng
                        if(typeof(idOrderDetail)==='undefined'){
                            notify('Success','success','This food item was successfully deleted !','#398717','#2F6227');
                        }else{
                            $.ajax({
                                url: '{{route("deleteFoodOrderDetail")}}',
                                type: 'GET',
                                data: {idOrderDetail: idOrderDetail,orderId:orderId},
                                success: function (data) {
                                    notify('Success','success','This food item was successfully deleted !','#398717','#2F6227');
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    console.log('Error ' + xhr.status + ' | ' + thrownError);
                                }
                            })
                        }
                    }
                },
                cancel: {
                    text    : ' Cancel',
                    btnClass: 'btn btn-default'
                }
            }
        });
    });

    //======================function notify=========================
    function notify(headingContent,icon,content,bgColor,loaderBg){
        $.toast({
            text: content,
            heading: headingContent,
            icon: icon,
            showHideTransition: 'plain',
            allowToastClose: true,
            hideAfter: 2000,
            bgColor:bgColor,
            stack: 5,
            position: 'top-right',
            textAlign: 'left',
            loader : true,
            loaderBg: loaderBg
        });
    }
</script>
@endsection
