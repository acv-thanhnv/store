@extends("layouts.layout3")
<head>
    <title>Order</title>
</head>
@section('css')
    <link href="{{ asset('frontend/css/style_order.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="wraper row">
        {{--================================= Left ===========================--}}
        <div class="wraper-left col-sm-6 nopad">
            <div id="left-nav-tabs" class="header-left row">
                <div class="col-md-7 col-lg-6">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-tab='table' data-toggle="tab" href="#home">Table/Floor</a>
                        </li>
                        <li class="nav-item tab_menu tab-search" data-tab='menu'>
                            <a class="nav-link" data-tab='menu' data-toggle="tab" href="#menu">Menu</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 col-lg-6 search-form">
                        <input class="form-control" placeholder="&#xF002; Tìm kiếm bàn/món ăn..." style="font-family:Arial, FontAwesome" name="srch-term"
                        id="ed-srch-term" type="text">
                        <span id="searchbtn">
                            <i class="fa fa-mail-forward"></i>
                        </span>
                </div>
            </div>
            <div class="tab-content content-left">
                <div id="home" class="tab-pane active">
                    <div class="room">
                            <div class="container-fluid">
                                <ul  id="floors">
                                    <li class="item-floor li-floor active_floor"><a href="javascript:void(0);" class="getTable" item-floor-id="">Tất cả</a></li>
                                    {{--content floor--}}
                                </ul>
                                {{--content floor include--}}
                                @include('frontend.order-manager.floors')
                            </div>
                    </div>

                    <div id="table-list" class="row">
                        {{--content TABLE--}}
                    </div>
                    {{--content TABLE INCLUDE--}}
                    @include('frontend.order-manager.tables')
                </div>
                <div id="menu" class="tab-pane fade">
                    <div class="category">
                            <div class="container-fluid">
                                <ul  id="entity-menu">
                                    <li class="item-menu active_menu li-menu"><a href="javascript:void(0);" class="getMenu" item-menu-id="*">Tất cả</a></li>
                                    {{--content menu--}}

                                </ul>
                                {{--content menu include--}}
                                @include('frontend.order-manager.menu')
                            </div>
                    </div>

                    <div id="list-entities" class="row">
                        {{--content entities--}}
                    </div>
                    {{--content entities include--}}
                    @include('frontend.order-manager.entities')
                </div>
            </div>
        </div>
        
        {{--================================= Right ===========================--}}
        <div class="wraper-right col-sm-6">
            <div class="header-right row">
                <div class="col-md-10" style="padding: 0px">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link active" data-toggle="tab" href="#order">
                                <span id="table-id">Bàn</span> / <span id="floor-id">Tầng</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" data-toggle="tab" href="#request">Request</a>
                        </li>
                        <li class="nav-item new_order">
                            <a class="nav-link">
                                <i class="fa fa-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content content-right">
                <div id="order" class="tab-pane active">
                    <div class="row order-header">
                        <div class="col-md-1 col-xl-1 order-id"> 
                            <i class="fa fa-sort-numeric-asc"></i>
                        </div>
                        <div class="col-md-4 col-xl-4 order-date">
                            <i class="fa fa-clock-o"></i> Datetime
                        </div>
                        <div class="col-md-4 col-xl-3 order-status">
                            <i class="fa fa-newspaper-o"></i> Status
                        </div>
                        <div class="col-md-3 col-xl-4 order-action">
                            <i class="fa fa-slideshare"></i> Action
                        </div>
                    </div>
                    <div id="entities-order">
                    </div>
                </div>
                <div id="request" class="tab-pane fade">
                    Tab request
                </div>
            </div>
        </div>
    </div>
@include('frontend.order-manager.entities-order')
@include('frontend.order-manager.entities-detail')
@include('frontend.order-manager.table_manager')
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
        $('[data-toggle="tooltip"]').tooltip(); 
        getMenuList(idStore);
        getEntitiesByMenu('*',idStore);
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
            var row_order_detail = $(row_order).find('.row-order-detail[order-detail-id="'+data.idDetail+'"]');
            $(row_order_detail).find('.food_status').text(data.foodStatusName);
            $(row_order_detail).find('.cooked').text(data.cooked+' /');
            $(row_order_detail).find('.food_status').addClass('food_status_'+data.foodStatus);
        });
        //order event
        var OrderEventName = "{{\App\Core\Common\OrderConst::Other2Order}}";
        var order_channel_name = '{{\App\Core\Helpers\CommonHelper::getOrderEventName($idStore,\App\Core\Common\OrderConst::Other2Order)}}';
        var order_channel = pusher.subscribe(order_channel_name);
        order_channel.bind(OrderEventName, function(data){
            //nếu có order mới thì hiện thông báo
            if(data.order.status=='{{\App\Core\Common\OrderStatusValue::NoDone}}'){
                notify('Warning','warning',data.order.location_name+' có order mới','#F27022','#BA7237');
            }
            //nếu tình trạng là thanh toán thì ẩn order đó đi, ko phai thi append bth
            if(data.order.status=='{{\App\Core\Common\OrderStatusValue::Pay}}'){
                //an order detail di
                $('.entities-row-order[data-order-id="'+data.order.id+'"]').next().remove();
                //an order di
                $('.entities-row-order[data-order-id="'+data.order.id+'"]').remove();
            }else{
                //get order and append
                if(data.order.location_id==idTable && idStore == data.idStore){
                    genOrderRealtime(data.order,data.result);
                }
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
        var numberMenu = '{{\App\Core\Common\OrderConst::numberMenu}}';
        var length = data.data.length;
        if(length<numberMenu){
            numberMenu = length;
        }
        for(var i=0; i<numberMenu;i++){
            var li_menu = $('#entity-menu-template').contents().clone()[1];
            $(li_menu).find('a').text(data.data[i].name);
            $(li_menu).find('a').attr('item-menu-id', data.data[i].id);
            $(itemMenu).append($(li_menu));
        }
        if(length>numberMenu){
            var dropdown_menu = $('#entity-menu-template').contents().clone()[3];
            for(var i=numberMenu;i<length;i++){
                var li_menu = '<li class="li-menu"><a class="dropdown-item getMenu" item-menu-id="'+data.data[i].id+'"href="javascript:void(0);">'+data.data[i].name+'</a></li>';
                var dropdown_li = $(dropdown_menu).contents()[3];
                $(dropdown_li).append($(li_menu));
            }
            $(itemMenu).append($(dropdown_menu));
        }
    }

    //========================GET ENTITIES==========================
    function getEntities(idStore) {
        $.ajax({
            url: '{{route('food/list-by-store')}}' + '/' + idStore,
            dataType: 'JSON',
            type: 'GET',
            data: {idStore: idStore},
            success: function (data) {
                genEntities(data.data);
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
            var title = $(listItemTemp)[1];
            $(listItemTemp).find('.food-image').attr('alt', obj.name);
            $(listItemTemp).find('.food-image').attr('src', obj.src);
            $(title).attr('title', obj.name);
            $(listItemTemp).find('.entities_item').attr('entities-name', obj.name);
            $(listItemTemp).find('.entities_item').attr('entities-id', obj.id);
            $(listItemTemp).find('.entities_item').attr('entities-image', obj.src);
            $(listItemTemp).find('.entities_item').attr('entities-price', obj.price);
            $(listItemTemp).find('img').attr('src', obj.src);
            $(listItemTemp).find('.food-items-name').text(obj.name);
            $(listItemTemp).find('.food-items-price').text(obj.price);

            $(listItem).append($(listItemTemp));
        })
    }

    //=====================GET ENTITIES BY MENU==========================
    //Click menu
    $(document).on('click', '.li-menu', function () {
        var idMenu = $(this).find('.getMenu').attr('item-menu-id');
        $('.item-menu').removeClass('active_menu');
        $('.li-menu').removeClass('active_menu');
        $(this).addClass('active_menu');
        getEntitiesByMenu(idMenu, idStore);
    })


    function getEntitiesByMenu(idMenu, idStore) {
        $.ajax({
            url: '{{route("food/list-by-menu")}}',
            dataType: 'JSON',
            type: 'GET',
            data: {idMenu: idMenu, idStore: idStore},
            success: function (data) {
                genEntities(data.data);
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
        var numberFloor = '{{\App\Core\Common\OrderConst::numberFloor}}';
        var length = data.data.length;
        if(length<numberFloor){
            numberFloor = length;
        }
        for(var i=0; i<numberFloor;i++){
            var li_floor = $('#floors-template').contents().clone()[1];
            $(li_floor).find('a').text(data.data[i].name);
            $(li_floor).find('a').attr('item-floor-id', data.data[i].id);
            $(itemFloor).append($(li_floor));
        }
        if(length>=numberFloor){
            var dropdown_floor = $('#floors-template').contents().clone()[3];
            for(var i=numberFloor;i<length;i++){
                var li_floor = '<li class="li-floor"><a class="dropdown-item getTable" item-floor-id="'+data.data[i].id+'"href="javascript:void(0);">'+data.data[i].name+'</a></li>';
                var dropdown_li = $(dropdown_floor).contents()[3];
                $(dropdown_li).append($(li_floor));
            }
            $(itemFloor).append($(dropdown_floor));
        }
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
            var order_data = $(itemTableTemp).find('.wrap-table');
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
    $(document).on('click', '.li-floor', function (e) {
        $('.item-floor').removeClass('active_floor');
        $('.li-floor').removeClass('active_floor');
        $(this).addClass('active_floor');
        idFloor = $(this).find('.getTable').attr('item-floor-id');
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
                    $(row_id).attr("old-status",data.status);
                    $(itemOrderTemp).find('.entities_order_id').text(data.id);
                    $(itemOrderTemp).find('.entities_order_id').attr('entities_order_id', data.id);
                    $(itemOrderTemp).find('.entities_order_time').text(data.datetime_order);
                    $(itemOrderTemp).find('.entities_order_status_color').addClass("status_"+data.status);
                    $(itemOrderTemp).find('.entities_order_status_content').addClass("status_"+data.status);
                    $(itemOrderTemp).find('.entities_order_status_content').text(data.name);
                    $(itemOrderTemp).find('.entities_order_status_color').attr("order-status",data.status);
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
            $(row_id).attr("old-status",obj.status);
            $(itemOrderTemp).find('.entities_order_id').text(obj.id);
            $(itemOrderTemp).find('.entities_order_id').attr('entities_order_id', obj.id);
            $(itemOrderTemp).find('.entities_order_time').text(obj.datetime_order);
            $(itemOrderTemp).find('.entities_order_status_content').text(obj.name);
            $(itemOrderTemp).find('.entities_order_status_color').attr('order-status',obj.status);
            $(itemOrderTemp).find('.entities_order_status_content').attr('order-status',obj.status);
            $(itemOrderTemp).find('.entities_order_status_color').addClass("status_"+obj.status);
            $(itemOrderTemp).find('.entities_order_status_content').addClass("status_"+obj.status);
            $(itemOrder).append($(itemOrderTemp));
            if(obj.detail.length==0){
                $(row).find('.no-data').removeClass('dis-none');
            }else{
                var i = 1;
                obj.detail.forEach(function(itemDetail){
                    var rowDetail = $("#entities-detail-template").contents().clone();
                    //append data
                    var rowDetailId = $(rowDetail)[1];
                    $(rowDetailId).attr('order-detail-id',itemDetail.id);
                    $(rowDetailId).attr('entities-id',itemDetail.entities_id);
                    $(rowDetail).find(".order_detail_name").text(itemDetail.name);
                    $(rowDetail).find(".order_detail_price").text($.number(itemDetail.price,0, ','));
                    $(rowDetail).find(".order_detail_id").text(i);
                    $(rowDetail).find(".quantity-detail").val(itemDetail.quantity);
                    $(rowDetail).find(".quantity-detail").attr('data-num_product',itemDetail.quantity);
                    if(itemDetail.has_update===1){
                        $(rowDetail).find(".has_change").css('display','block');
                    }
                    if(itemDetail.cooked>0){
                        $(rowDetail).find(".cooked").text(itemDetail.cooked+' /');
                    }
                    $(rowDetail).find(".food_status").text(itemDetail.status_name);
                    $(rowDetail).find(".food_status").addClass('food_status_'+itemDetail.status);
                    $(rowDetail).find(".food_status").attr('food-status',itemDetail.status);
                    $(rowDetail).find(".delete-order-detail").attr('data-order-detail',itemDetail.id);
                    $(row).attr('order-id',obj.id); 
                    $(row).append($(rowDetail));
                    i++;
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
            var order_status = $(row_order).find('.entities_order_status_color').attr('order-status');
            //update status and status name of order
            $(row_order).find('.entities_order_status_color').attr('order-status',order.status);
            $(row_order).find('.entities_order_status_content').attr('order-status',order.status);
            $(row_order).find('.entities_order_status_content').text(order.name);
            $(row_order).find('.entities_order_status_color').removeClass('status_0 status_1 status_2').addClass('status_'+order.status);
            $(row_order).find('.entities_order_status_content').removeClass('status_0 status_1 status_2').addClass('status_'+order.status);
            //nếu ko có item nào trong order thì hiện nodata ngược lại thì append data
            if(obj.length==0){
                $(row_order_detail).html('<span class="no-data"><i class="fa fa-minus-circle"></i> No data found!</span>');
            }else{
                var i = 1;
                obj.forEach(function(itemDetail){
                    var rowDetail = $("#entities-detail-template").contents().clone();
                    //append data
                    var rowDetailId = $(rowDetail)[1];
                    //add iddetail for row
                    $(rowDetailId).attr('order-detail-id',itemDetail.id);
                    $(rowDetailId).attr('entities-id',itemDetail.entities_id);
                    $(rowDetail).find(".order_detail_name").text(itemDetail.name);
                    $(rowDetail).find(".order_detail_price").text($.number(itemDetail.price,0, ','));
                    $(rowDetail).find(".order_detail_id").text(i);
                    $(rowDetail).find(".quantity-detail").val(itemDetail.quantity);
                    $(rowDetail).find(".quantity-detail").attr('data-num_product',itemDetail.quantity);
                    if(itemDetail.has_update===1){
                        $(rowDetail).find(".has_change").css('display','block');
                    }
                    if(itemDetail.cooked>0){
                        $(rowDetail).find(".cooked").text(itemDetail.cooked+' /');
                    }
                    $(rowDetail).find(".food_status").text(itemDetail.status_name);
                    $(rowDetail).find(".food_status").addClass('food_status_'+itemDetail.status);
                    $(rowDetail).find(".food_status").attr('food-status',itemDetail.status);
                    $(rowDetail).find(".delete-order-detail").attr('data-order-detail',itemDetail.id);
                    $(row_order_detail).append($(rowDetail));
                    i++;
                });
            }
        }else {//ko thi append order moi
            var itemOrderTemp = $('#entities-order-template').contents().clone();
            var row_id = $(itemOrderTemp)[1];
            $(row_id).attr("data-order-id",order.id);
            $(row_id).attr("old-status",order.status);
            $(itemOrderTemp).find('.entities_order_id').text(order.id);
            $(itemOrderTemp).find('.entities_order_id').attr('entities_order_id', order.id);
            $(itemOrderTemp).find('.entities_order_time').text(order.datetime_order);
            $(itemOrderTemp).find('.entities_order_status_color').addClass("status_"+order.status);
            $(itemOrderTemp).find('.entities_order_status_content').addClass("status_"+order.status);
            $(itemOrderTemp).find('.entities_order_status_content').text(order.name);
            $(itemOrderTemp).find('.entities_order_status_color').attr("order-status",order.status);
            $(itemOrderTemp).find('.entities_order_status_content').attr("order-status",order.status);
            $(itemOrder).append($(itemOrderTemp));
            var i = 0;
            obj.forEach(function(itemDetail){
                var rowDetail = $("#entities-detail-template").contents().clone();
                //append data
                var rowDetailId = $(rowDetail)[1];
                //add iddetail for row
                $(rowDetailId).attr('order-detail-id',itemDetail.id);
                $(rowDetailId).attr('entities-id',itemDetail.entities_id);
                $(rowDetail).find(".order_detail_name").text(itemDetail.name);
                $(rowDetail).find(".order_detail_price").text($.number(itemDetail.price, 0, ',' ));
                $(rowDetail).find(".order_detail_id").text(i);
                $(rowDetail).find(".quantity-detail").val(itemDetail.quantity);
                $(rowDetail).find(".quantity-detail").attr('data-num_product',itemDetail.quantity);
                if(itemDetail.has_update===1){
                    $(rowDetail).find(".has_change").css('display','block');
                }
                if(itemDetail.cooked>0){
                    $(rowDetail).find(".cooked").text(itemDetail.cooked+' /');
                }
                $(rowDetail).find(".food_status").text(itemDetail.status_name);
                $(rowDetail).find(".food_status").addClass('food_status_'+itemDetail.status);
                $(rowDetail).find(".food_status").attr('food-status',itemDetail.status);
                $(rowDetail).find(".delete-order-detail").attr('data-order-detail',itemDetail.id);
                var row = $(itemOrderTemp)[3]; 
                $(row).attr('order-id',order.id);
                $(row).append($(rowDetail));
                i++;
            });
        }
    }

    function genOrderDetailByOrder(order,obj){
        var itemOrder        = $('#entities-order');
        var row_order        = $('.entities-row-order[data-order-id="'+order.id+'"]');
        var row_order_detail = $('.entities-row-order[data-order-id="'+order.id+'"]').next();
        $(row_order_detail).empty();
        var order_status = $(row_order).find('.entities_order_status_color').attr('order-status');
        //update status and status name of order
        $(row_order).find('.entities_order_status_color').attr('order-status',order.status);
        $(row_order).find('.entities_order_status_content').attr('order-status',order.status);
        $(row_order).find('.entities_order_status_content').text(order.name);
        $(row_order).find('.entities_order_status_color').removeClass(' status_0 status_2').addClass('status_1');
        $(row_order).find('.entities_order_status_content').removeClass(' status_0 status_2').addClass('status_1');
        var i =1;
        obj.forEach(function(itemDetail){
            var rowDetail = $("#entities-detail-template").contents().clone();
            //append data
            var rowDetailId = $(rowDetail)[1];
            //add iddetail for row
            $(rowDetailId).attr('order-detail-id',itemDetail.id);
            $(rowDetailId).attr('entities-id',itemDetail.entities_id);
            $(rowDetail).find(".order_detail_name").text(itemDetail.name);
            $(rowDetail).find(".order_detail_price").text($.number(itemDetail.price,0, ',' ));
            $(rowDetail).find(".order_detail_id").text(i);
            i++;
            $(rowDetail).find(".quantity-detail").attr('data-num_product',itemDetail.quantity);
            if(itemDetail.has_update===1){
                $(rowDetail).find(".has_change").css('display','block');
            }
            $(rowDetail).find(".food_status").text(itemDetail.status_name);
            $(rowDetail).find(".food_status").addClass('food_status_'+itemDetail.status);
            //nếu đã nấu lớn hơn 0 thì hiện cooked
            if(itemDetail.cooked>0){
                $(rowDetail).find(".cooked").text(itemDetail.cooked+' /');
            }
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
            $(this).parents('.entities-row-detail').prev('.entities-row-order').find('.entities_order_status_color').attr('order-status',status_order_noDone);
            //chuyển trạng thái của món ăn về chưa xác nhận
            $(this).parents('.row-order-detail').find('.food_status').removeClass('food_status_2 food_status_1').addClass('food_status_0').attr('food-status',status_food_noDone).text(name_food_noDone);
            if(typeof(order_detail_id) !== "undefined" && num_product!=old_num_product){//kiem tra neu co order detail thi hien ngoi sao thay doi
                $(this).parents('.row-order-detail').find('.save-order-detail').removeClass('disabled');
            }else{
                $(this).parents('.row-order-detail').find('.save-order-detail').addClass('disabled');
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
        $(this).parents('.entities-row-detail').prev('.entities-row-order').find('.entities_order_status_color').attr('order-status',status_order_noDone);
        //chuyển trạng thái của món ăn về chưa xác nhận
        $(this).parents('.row-order-detail').find('.food_status').removeClass('food_status_2 food_status_1').addClass('food_status_0').attr('food-status',status_food_noDone).text(name_food_noDone);
        if(typeof(order_detail_id) !== "undefined" && num_product!=old_num_product){//kiem tra neu co order detail thi hien ngoi sao thay doi
            $(this).parents('.row-order-detail').find('.save-order-detail').removeClass('disabled');
        }else{
            $(this).parents('.row-order-detail').find('.save-order-detail').addClass('disabled');
        }
    });

    $(document).on('change','.quantity-detail',function(){
        var old_num_product = $(this).data('num_product');
        var num_product     = $(this).val();
        var order_detail_id = $(this).parents('.row-order-detail').attr('order-detail-id');
        if(num_product>0){
            $(this).val(num_product);
            //khi thay đổi thì order chuyển về trạng thái chưa xác nhận để order biết cập nhập
            $(this).parents('.entities-row-detail').prev('.entities-row-order').find('.entities_order_status_color').attr('order-status',status_order_noDone);
            //chuyển trạng thái của món ăn về chưa xác nhận
            $(this).parents('.row-order-detail').find('.food_status').removeClass('food_status_2 food_status_1').addClass('food_status_0').attr('food-status',status_food_noDone).text(name_food_noDone);
            if(typeof(order_detail_id) !== "undefined" && num_product!=old_num_product){//kiem tra neu co order detail thi hien ngoi sao thay doi
                $(this).parents('.row-order-detail').find('.save-order-detail').removeClass('disabled');
            }else{
                $(this).parents('.row-order-detail').find('.save-order-detail').addClass('disabled');
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
        var tab = $(".nav-link.active").data('tab');
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
        var row_order = $(this).parents('.entities-row-order');
        //ẩn hết tất cả các detail đang mở
        $('.entities-row-detail.show_detail').removeClass('show_detail');
        //nếu dòng đó đang được chọn thì chọn lần nữa là ẩn detail đi
        if($(this).parents('.entities-row-order').hasClass('row_active')){
            $(row_order).removeClass('row_active');
            $(this).find('.fa-plus').removeClass('fa-minus');
        }else{
            $('.entities-row-order').removeClass('row_active');
            $('.add_food .fa-plus').removeClass('fa-minus');
            $(this).find('.fa-plus').addClass('fa-minus');
            //show order tail
            $(this).parents('.entities-row-order').next('.entities-row-detail').addClass('show_detail');
            //add class to show which row is active
            $(this).parents('.entities-row-order').addClass('row_active');
        }
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
            notify('Warning','warning','Vui lòng chọn order để thêm món !','#E99551','#F4AD32');
        }else{
            var orderId = $('.entities-row-order.row_active').attr('data-order-id');
            $('.entities-row-order.row_active').each(function(){
                //remove nodata row
                $(this).next('.entities-row-detail').find('.no-data').addClass('dis-none');
                //Chuyển trạng thái của order về chưa xác nhận
                $(this).find('.entities_order_status_color').attr('order-status',status_order_noDone);
                var row_detail = $(this).next('.entities-row-detail');
                var i = $(row_detail).find('.row-order-detail').length;
                var numRow = $(row_detail).find('.row-order-detail[entities-id="'+objFood.entities_id+'"]');
                if(numRow.length>0){// neu tim thay mon do thi tang so luong
                    //lay so luong cua mon an hien tai ve
                    var numProduct = $(numRow).find('.quantity-detail').val();
                    //Lay order detail id cua mon do
                    var order_detail_id = $(numRow).attr('order-detail-id');
                    if(typeof(order_detail_id) !== "undefined" && order_detail_id!=""){
                    //nếu món đó đã được order rồi thì hiện thay đổi  và cập nhập trạng thái của món đó
                        $(numRow).find(".save-order-detail").removeClass('disabled');

                        //chuyển trạng thái của món ăn về chưa xác nhận
                        $(numRow).find('.food_status').removeClass('food_status_2 food_status_1').addClass('food_status_0').attr('food-status',status_food_noDone).text(name_food_noDone);
                    }
                    //tang so luong cua mon len 1
                    numProduct++;
                    $(numRow).find('.quantity-detail').val(numProduct);
                }else{//nguoc lai thi them mon vao
                    i++;
                    var rowDetail = $("#entities-detail-template").contents().clone();
                    //append data
                    var rowDetailId = $(rowDetail)[1];
                    $(rowDetailId).attr('entities-id',objFood.entities_id);
                    //add id detail =null for row
                    $(rowDetailId).attr('order-detail-id',"");
                    $(rowDetail).find(".order_detail_name").text(objFood.entities_name);
                    $(rowDetail).find(".order_detail_id").text(i);
                    $(rowDetail).find(".order_detail_price").text($.number(objFood.entities_price,0, ',' ));
                    $(rowDetail).find(".quantity-detail").val(1);
                    $(rowDetail).find(".quantity-detail").attr('data-num_product',1);
                    $(rowDetail).find(".food_status").text(objFood.status_name);
                    $(rowDetail).find(".food_status").addClass('food_status_'+objFood.status);
                    $(rowDetail).find(".save-order-detail").removeClass('disabled');
                    $(rowDetail).find(".food_status").attr('food-status',objFood.status);
                    //nếu là món mới thì hiện sao để thông báo là có thay đổi
                    $(rowDetail).find(".has_change").css('display','block');
                    $(row_detail).append($(rowDetail));
                }
            });
        }
    });

    //======================send order=========================
    $(document).on('click','.send_order',function(){
        var orderId          = parseInt($(this).parents('.entities_order_action').siblings('.entities_order_id').text());
        var status_order     = parseInt($(this).parents('.entities-row-order').find('.entities_order_status_color').attr('order-status'));
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
                    notify('Success','success','Order đã được gửi thành công cho bếp !','#398717','#2F6227');
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
            notify('Warning','warning','Không có món nào để gửi cho bếp, cập nhập order để gửi !','#E99551','#F4AD32');
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
            content       : "Bạn có chắc là muốn xóa Order này?",
            buttons       : {
                Save: {
                    text    : 'OK',
                    btnClass: 'btn btn-primary',
                    action  : function (){
                        $.ajax({
                            url: '{{route("deleteOrder")}}',
                            type: 'GET',
                            data: {orderId: orderId},
                            success: function (data) {
                                if(data.status == '{{App\Core\Common\SDBStatusCode::OK}}'){
                                    $(row).next('.entities-row-detail').remove();
                                    $(row).remove();
                                    notify('Success','success','Order đã được xóa thành công!','#398717','#2F6227');
                                }else{
                                    notify('Error','error','Bạn không thể xóa order đã có món nấu xong!','#B42727','#A34242');
                                }
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
        var name          = $(this).parents('.row-order-detail').find('.order_detail_name').text();
        $.confirm({
            title         : '<p class="text-danger">Xác nhận xóa món</p>',
            icon          : 'fa fa-exclamation-circle',
            useBootstrap  : true,
            columnClass   : 'col-md-6 col-xl-6',
            type          : "red",
            closeIcon     : true,
            closeIconClass: 'fa fa-close',
            content       : 'Bạn có chắc chắn muốn hủy món <b>'+name+'</b> không?',
            buttons       : {
                Save: {
                    text    : 'OK',
                    btnClass: 'btn btn-primary',
                    action  : function (){
                        $.ajax({
                            url: '{{route("deleteFoodOrderDetail")}}',
                            type: 'GET',
                            data: {idOrderDetail: idOrderDetail,orderId:orderId},
                            success: function (data) {
                                if(data.status =='{{\App\Core\Common\SDBStatusCode::OK}}'){
                                    //xóa dòng hiện tại đi
                                    $(row).remove();
                                    //đếm số item còn lại của order sau khi xóa
                                    var number_row_detail = $(entities_row).find('.row-order-detail').length;
                                    //nếu số item còn lại của order bằng ko thì hiện no data
                                    if(number_row_detail==0){
                                        $(entities_row).find('.no-data').removeClass('dis-none');
                                    }
                                    notify('Success','success','Món ăn đã được xóa thành công !','#398717','#2F6227');
                                }else{
                                    notify('Error','error','Bạn không thể xóa món ăn đã nấu xong!','#B42727','#A34242');
                                }
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                console.log('Error ' + xhr.status + ' | ' + thrownError);
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

    //======================function notify=========================
    function notify(headingContent,icon,content,bgColor,loaderBg){
        $.toast({
            text: content,
            heading: headingContent,
            icon: icon,
            showHideTransition: 'plain',
            allowToastClose: true,
            hideAfter: 5000,
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
