@extends("layouts.layout3")
@section('css')
    <link href="{{ asset('frontend/css/style_order.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="wraper">
        {{--================================= Quang begin ===========================--}}
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
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="#">Tầng 1</a></li>
                                    @for($i=2;$i<5;$i++)
                                        <li><a href="#">Tầng {{$i}}</a></li>
                                    @endfor
                                    <li><a href="#">More...</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>

                    <div id="table-list">
                        @for($i=1;$i<30;$i++)
                            <div class="wrap-table col-sm-2 img-thumbnail text-center">
                                <span class="table-name">Bàn</span><br>
                                <span class="table-name">{{$i}}</span>
                            </div>
                        @endfor
                    </div>
                </div>
                <div id="menu" class="tab-pane fade">
                    <div class="category">
                        <nav class="navbar navbar-inverse">
                            <div class="container-fluid">
                                <ul class="nav navbar-nav" id="entity-menu">
                                    <li class="active"><a href="#">Tất cả</a></li>
                                    @include('frontend.order-manager.menu')
                                    <li style="display: none"><a href="#">More...</a></li>
                                </ul>
                            </div>
                        </nav>

                    </div>


                    <div id="list-entities">
                        @include('frontend.order-manager.entities')
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>
    {{--================================= Son begin ===========================--}}
    <div class="wraper-right col-sm-6">
        <div class="header-right">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#">Bàn/Tầng</a>
                </li>
                <li style="float: right; margin-right: 10px;">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span
                                    class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" style="top:43px;right:-10px;">
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal"><span
                                            class="fa fa-retweet"></span> Chuyển Bàn</a></li>
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
            @include('frontend.order-manager.entities-order')
        </div>
        <div class="footer-right">
            <table style="width:100%;">
                <tbody>
                <tr style="height:30px;">
                    <td class="col-md-8" rowspan="2">
                        <textarea class="note-order col-md-8" placeholder="Ghi chú"></textarea>
                    </td>
                    <td class="col-md-4 col-sm-6">
                        <div class="total-order">
                            <strong>Tổng: 100.000.000.</strong>
                        </div>
                    </td>
                </tr>
                <tr class="action-order">
                    <td class="send-order col-md-4 col-sm-6">
                        <button type="button" class="btn btn-danger">Gửi Thực Đơn<br><i class="fa fa-bell"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        @include('frontend.order-manager.table_manager')

    </div>
    </div>
@endsection
@section('javascript')
    <script src="{{asset('frontend/js/order.js')}}"></script>
    <script type="text/javascript">

        var idStore = '{{$idStore}}';
        var idMenu = 1;
        //console.log(idStore);

        $(document).ready(function () {
            getMenuList(idStore);
            getEntities(idStore);
            getEntitiesByMenu(idMenu, idStore);

        });
        //==================================================
        function getMenuList(idStore) {

            $.ajax({
                url: '{{route("food/list-menu-by-store")}}'+'/'+ idStore,
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
        function genMenuList(data){
            var itemMenu = $('#entity-menu');
            data.data.forEach(function (obj) {
                var itemMenuTemp =$('#entity-menu-template').contents().clone();
                $(itemMenuTemp).find('a').text(obj.name);
                $(itemMenuTemp).find('a').attr('item-menu-id',obj.id);
                $(itemMenu).append($(itemMenuTemp));
            })
        }
        //==================================================
        function getEntities(idStore){

            $.ajax({
                url: '{{route('food/list-by-store')}}'+'/'+ idStore,
                dataType: 'JSON',
                type: 'GET',
                data: {idStore: idStore},
                success: function (data) {
                    genEntities(data);
                    console.log(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('Error ' + xhr.status + ' | ' + thrownError);
                },
            });
        }
        function genEntities(data){
            var listItem = $('#list-entities');
            data.data.forEach(function (obj) {
                var listItemTemp =$('#list-entities-template').contents().clone();
                console.log();
                $(listItemTemp).find('img').attr('src',obj.image);
                $(listItemTemp).find('h6').text(obj.name);
                $(listItemTemp).find('h5').text(obj.price);

                $(listItem).append($(listItemTemp));
            })
        }
        //==================================================
        function getEntitiesByMenu(idMenu, idStore){
            $.ajax({
                url: '{{route("food/list-by-menu")}}'+'/'+ idMenu,
                dataType: 'JSON',
                type: 'GET',
                data: {idMenu:idMenu, idStore: idStore},
                success: function (data) {
                    console.log(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('Error ' + xhr.status + ' | ' + thrownError);
                },
            });
        }
        //==================================================
    </script>
@endsection
