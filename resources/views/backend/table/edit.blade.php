@extends("layouts.dialog")
@push("css")
    <style type="text/css">
        .form {
            margin-left: auto;
            margin-right: auto;
            margin-top: 5%;
            float: none;
        }

        .thumb {
            width: 100px;
            height: 100px;
            margin: 0.2em -0.7em 0 0;
            border-radius: 50%;
        }

        input[type="file"] {
            display: none;
        }

        input[type="checkbox"] {
            padding-top: 5px;
            height: 20px;
            width: 20px;
        }

        .remove_img_preview {
            position: relative;
            left: 100px;
            top: -100px;
            width: 15px;
            background: black;
            color: white;
            border-radius: 90px;
            text-align: center;
            cursor: pointer;
        }

        .remove_img_preview:before {
            content: "\f057";
        }

        .password {
            display: none;
        }
    </style>
@endpush
@section("content")
    <div class="col-md-7 col-xs-12 form">
        <div class="x_panel">
            <div class="x_content">
                <br>
                <form id="form_add" class="form-horizontal input_mask" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token('')}}">
                    <!--Should use session here to get idStore-->
                    <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
                            <label>Table Name</label>
                            <input type="text" value="{{$obj->name}}" autofocus="" name="name"
                                   class="form-control has-feedback-left" id="name"
                                   placeholder="Add Location Name...">
                            <span class="fa fa-linux form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 15px">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <label>Floor</label>
                            <select class="form-control" id="floor" name="floor">
                                <option value="">Choose Floor</option>
                                @foreach($floor as $floor)
                                    <option value="{{$floor->id}}"
                                    @if($floor->id==$obj->floor_id){{"selected"}}
                                            @endif
                                    >
                                        {{$floor->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 15px">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <label>Table Type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="">Choose Type of Table</option>
                                @foreach($type as $type)
                                    <option value="{{$type->id}}"
                                    @if($type->id==$obj->type_location_id){{"selected"}}
                                            @endif
                                    >
                                        {{$type->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback">
                            <label>Sub Price</label>
                            <input type="text" autofocus="" value="{{$obj->subprice}}" name="price" class="form-control has-feedback-left" id="price" placeholder="Choose Type..." readonly="">
                            <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="button" class="btn btn-success edit">Edit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@push("js")
    <script type="text/javascript">
        //change price
        $(document).on('change','#type',function(){
            var idType = $(this).val();
            if(idType!=''){
                $.ajax({
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('tablePrice')}}",
                    data:{idType:idType},
                    success: function (result) {
                        $("#price").val(result);
                    }
                });
            }
        });
        //submit edit
        $(".edit").click(function () {
            var name = $("#name").val();
            var type = $("#type").val();
            var floor = $("#floor").val();
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "",
                data: {name: name, type: type, floor: floor},
                success: function (result) {
                    if (result.status == '{{App\Core\Common\SDBStatusCode::OK}}') {
                        //call parent and close modal
                        parent.$('#modal-edit').iziModal('close');
                        localStorage.setItem("Message", "Menu have been edit successful!");
                        parent.location.reload();
                    } else {
                        _commonShowError(result.data);
                    }
                }
            });
        })
    </script>
@endpush