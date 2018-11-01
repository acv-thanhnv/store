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
            getTableByFloor(null, idStore);
        });

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
        function getTable() {
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

        //======================GET TABLE BY FLOOR============================
        $(document).on('click', '.item-floor', function () {
            var idFloor = $(this).find('a').attr('item-floor-id');
            getTableByFloor(idFloor, idStore);
        })

        function getTableByFloor(idFloor, idStore) {
            $.ajax({
                url: '{{route("food/list-location-by-floor")}}',
                dataType: 'JSON',
                type: 'GET',
                data: {idFloor: idFloor, idStore: idStore},
                success: function (data) {
                    genTableByFloor(data)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('Error ' + xhr.status + ' | ' + thrownError);
                },
            })
        }

        function genTableByFloor(data) {
            var itemTable = $('#table-list');
            $(itemTable).empty();
            data.data.forEach(function (obj) {
                var itemTableTemp = $('#table-list-template').contents().clone();
                $(itemTableTemp).find('.table-name').text(obj.name);
                $(itemTableTemp).find('.table-name').attr('item-table-id', obj.id);
                $(itemTable).append($(itemTableTemp));
            })
        }

        //======================click table=========================
        $(document).on("click", ".wrap-table", function () {
            var idTable = $(this).find(".table-name").attr('item-table-id');
            $.ajax({
                url: '{{route("food/get-location")}}',
                dataType: 'JSON',
                type: 'GET',
                data: {idLocation: idTable, idStore: idStore},
                success: function (data) {
                    data.data.forEach(function (obj) {
                        $('#table-id').text(obj.location_name);
                        $('#floor-id').text(obj.floor_name);
                    })
                },
                err: function (xhr, ajaxOptions, thrownError) {
                    console.log('Error ' + xhr.status + ' | ' + thrownError);
                }
            })
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
            var itemOrderDetail = $('#entities-row-detail');
            //$(itemOrderDetail).empty();
            data.data.forEach(function (obj) {
                //set entities-order
                var itemOrderTemp = $('#entities-order-template').contents().clone();
                obj.detail.forEach(function(itemDetail){
                    var rowDetail = $("#entities-detail-template").contents().clone();
                    $(rowDetail).find(".order_detail_name").text(itemDetail.name);
                    $(itemOrderTemp).find(".entities-row-detail").append($(rowDetail));
                });
                $(itemOrderTemp).find('.entities_order_id').text(obj.id);
                $(itemOrderTemp).find('.entities_order_id').attr('entities_order_id', obj.id);
                $(itemOrderTemp).find('.entities_order_time').text(obj.datetime_order);
                if (obj.status == 1) {
                    $(itemOrderTemp).find('.entities_order_status').text('Chưa xác nhận');
                }
                else if (obj.status == 2) {
                    $(itemOrderTemp).find('.entities_order_status').text('Đã xác nhận');
                    $(itemOrderTemp).find('.delete_order').addClass('disabled');
                }
                $(itemOrder).append($(itemOrderTemp));

            })
        }
        // function genOrderbyLocation(data) {
        //     var itemOrder = $('#entities-order');
        //     $(itemOrder).empty();
        //     data.data.forEach(function (obj) {
        //         //set entities-order
        //         var itemOrderTemp = $('#entities-order-template').contents().clone();
        //         $(itemOrderTemp).find('.entities_order_id').text(obj.id);
        //         $(itemOrderTemp).find('.entities_order_id').attr('entities_order_id', obj.id);
        //         $(itemOrderTemp).find('.entities_order_time').text(obj.datetime_order);
        //         if (obj.status == 1) {
        //             $(itemOrderTemp).find('.entities_order_status').text('Chưa xác nhận');
        //         }
        //         else if (obj.status == 2) {
        //             $(itemOrderTemp).find('.entities_order_status').text('Đã xác nhận');
        //             $(itemOrderTemp).find('.delete_order').addClass('disabled');
        //         }
        //
        //         obj.detail.forEach(function (detail) {
        //             console.log(detail);
        //             var itemOrderDetail = $('.entities-row-detail');
        //             $(itemOrderDetail).empty();
        //             var itemOrderDetailTemp = $('.entities-row-detail-template').contents().clone();
        //             // $(itemOrderDetailTemp).find('.order_detail_image>img').attr('src', detail.image);
        //             //console.log($(itemOrderDetailTemp).find('.name-detail'));
        //             $(itemOrderDetailTemp).find('.name-detail').text(detail.name);
        //             // $(itemOrderDetailTemp).find('.order_detail_price').text(parseInt(detail.price));
        //             // $(itemOrderDetailTemp).find('.quantity-detail').val(detail.quantity);
        //
        //             $(itemOrderDetail).append(itemOrderDetailTemp);
        //         })
        //             console.log('-------------');
        //         $(itemOrder).append($(itemOrderTemp));
        //     })
        // }


        //======================click show detail=========================
        $(document).on('click', '.show_detail', function () {
            var table = $('#tbl_list_order_detail');
            //$("<tr><td>acv</td></tr>").appendTo($(this).parents('.entities-row-order'));
            //$(this).parents('.entities-row-order').appendTo('</tr><tr><td>acv</td>');
            $('#tbl_list_order_detail').css({'display': 'block'})

            var idOrder = $(this).parents('.entities-row-order').find('.entities_order_id').attr('entities_order_id');
            {{--$.ajax({--}}
                {{--url: '{{route("food/get-order-detail")}}',--}}
                {{--dataType: 'JSON',--}}
                {{--type: 'GET',--}}
                {{--data: {idOrder: idOrder},--}}
                {{--success: function (data) {--}}
                    {{--//console.log(data);--}}
                    {{--genTableOrderDetail(data);--}}
                {{--},--}}
                {{--err: function (xhr, ajaxOptions, thrownError) {--}}
                    {{--console.log('Error ' + xhr.status + ' | ' + thrownError);--}}
                {{--}--}}
            {{--})--}}

        })



    </script>
@endsection
