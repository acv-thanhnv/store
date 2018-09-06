@extends('layouts.dev')

<!-- Latest compiled and minified CSS & JS -->


<link rel="stylesheet" type="text/css" href="{{ asset('css/lib/toastr.css') }}">
@section('content')
    <style>

        @supports not ((-webkit-hyphens: auto) or (-ms-hyphens: auto) or (hyphens: auto)) {
            .CUD{
                float :right !important;
                margin-right:-130px;
                margin-top:-27px !important;
            }
        }


        .treeview .list-group-item {
            cursor: pointer;
        }

        .treeview span.indent {
            margin-left: 10px;
            margin-right: 20px;
        }

        .treeview span.icon {
            width: 12px;
            margin-right: 5px;
        }

        .treeview .node-disabled {
            color: silver;
            cursor: not-allowed
        }

        .node-treeview6 {
            color: #428bca;
            width: 100%;
        }

        .node-treeview6:not(.node-disabled):hover {
            background-color: #F5F5F5;
        }
        .menu-item,.group-menu-item{
            list-style-type: none;
        }

        .width-200{
            width: 200px;
        }

        .CUD{
            float :right !important;
            margin-right:-130px;
            margin-top:15px;
        }

        .plus{
            cursor: pointer;

            margin-left:-20px;
            margin-top:15px ;
            float: left;
        }
        .minus{
            cursor: pointer;

            float: left;
            margin-top:20px ;
            margin-left:-20px;
        }
        .CssName{
            width:25%;
            background-color: rgba(231, 243, 164, 0.26) !important;
        }

        .CssURL{
            background-color: rgba(231, 243, 164, 0.26) !important;

        }
        .dInput{
            width: 100%;
            display: inline-flex;
            margin-top:13px;
            height: 30px !important;
        }

        .itemDelete{
            margin-left: 10px;

        }
        .itemEdit{
            margin-left: 10px;

        }
        .itemUpdate{
            margin-left: 10px;

        }
        .iteamCreate{
            margin-left: 10px;

        }
        .itemSave{
            margin-left: 10px;
        }
        .glyphicon-remove{
            width: 20px;
            line-height: 25px;
        }
        .glyphicon-edit{
            width: 20px;
            line-height: 25px;
        }
        .glyphicon-update{
           width: 20px;
           line-height: 25px;
        }
        .glyphicon-plus{
            width: 20px;
            line-height: 25px;
        }
        .glyphicon-save{
            width: 20px;
            line-height: 25px;
        }
        .tooltip >.tooltip-inner {background-color /**/: #df6662;border:none;box-shadow:none;outline:none;}

         .tooltip .tooltip-arrow {
            border-top-color: #df6662 !important;
         }
        .input-error{
            border-color: #ff151f;
        }

        .checked{
            float: right;
            left: -18px;
            color : #23c223;
            top: 8px;
            font-size: 13px;
            visibility: hidden;
        }
        .attach{
            top: 9px;
            right: 6px;
            font-size: 15px;
        }



    </style>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold">Menu</div>
                <h4>Basic</h4>
                <div class="card-body form-group basic-menu">
                    <ul class="basic">
                        <?php
                        $prevLevel = 0;
                        $count = count($dataCategory);
                        for($i = 0;$i < $count ; $i++){
                        if($dataCategory[$i]->level_value == $prevLevel){?>

                        <li class="menu-item" data-id="<?php echo $dataCategory[$i]->id; ?>" >
                            <?php if ($i+1 < $count && $dataCategory[$i+1]->level_value > $dataCategory[$i]->level_value){
                                $isHide = '';
                            }else{
                                $isHide = 'display-none';
                            }?>
                            <span class="glyphicon plus plusButton glyphicon-plus {{ $isHide }}"></span>
                            <span class="glyphicon minus minusButton glyphicon-minus {{ $isHide }}"></span>
                            <div class=" dInput">
                                <input type="text" class="CssName menuName form-control " disabled value="<?php echo $dataCategory[$i]->name; ?>" placeholder="New Name">
                                <span class="glyphicon checkName checked glyphicon-ok"></span>
                                <span class="glyphicon attach glyphicon-paperclip"></span>
                                <input type="text" class=" form-control menuURL CssURL" disabled value="<?php echo $dataCategory[$i]->url; ?>" placeholder="http://">
                                <span class="glyphicon checkURL checked glyphicon-ok"></span>
                            </div>

                            <div class="CUD ButtonCUD">
                                <a class="pull-right btn btn-danger itemDelete delete btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
                                <a class="pull-right btn btn-warning itemEdit edit btn-xs" ><span class="glyphicon glyphicon-edit"></span></a>
                                <a class="pull-right btn btn-info update itemUpdate btn-xs" hidden="true"><span class="glyphicon glyphicon-save"></span></a>
                                <a class="pull-right btn btn-primary iteamCreate create btn-xs" ><span class="glyphicon glyphicon-plus"></span></a>
                            </div>
                            <?php if ($i+1 < $count && $dataCategory[$i+1]->level_value > $dataCategory[$i]->level_value){?>
                            <?php }else{ ?>
                        </li>
                            <?php } ?>
                            <?php }else if($dataCategory[$i]->level_value > $prevLevel){?>

                        <ul class="group-menu-item display-none">
                            <li class="menu-item" data-id="<?php echo $dataCategory[$i]->id; ?>">
                                <?php if ($i+1 < $count && $dataCategory[$i+1]->level_value > $dataCategory[$i]->level_value){
                                   $isHide = '';
                                }else{
                                    $isHide = 'display-none';
                                }?>
                                <span class="glyphicon plus plusButton glyphicon-plus {{ $isHide }}"></span>
                                <span class="glyphicon minus minusButton glyphicon-minus {{ $isHide }}"></span>
                                <div class=" dInput">
                                    <input type="text" class="CssName menuName form-control" disabled value="<?php echo $dataCategory[$i]->name; ?>" placeholder="New Name">
                                    <span class="glyphicon checkName checked glyphicon-ok"></span>
                                    <span class="glyphicon attach glyphicon-paperclip"></span>
                                    <input type="text" class=" form-control menuURL CssURL" disabled value="<?php echo $dataCategory[$i]->url; ?>" placeholder="http://">
                                    <span class="glyphicon checkURL checked glyphicon-ok"></span>

                                </div>

                                <div class="CUD">
                                    <a class="pull-right btn btn-danger itemDelete delete btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
                                    <a class="pull-right btn btn-warning itemEdit edit btn-xs" ><span class="glyphicon glyphicon-edit"></span></a>
                                    <a class="pull-right btn btn-info update itemUpdate btn-xs" hidden="true"><span class="glyphicon glyphicon-save"></span></a>
                                    <a class="pull-right btn btn-primary iteamCreate create btn-xs" ><span class="glyphicon glyphicon-plus"></span></a>
                                </div>
                                <?php if ($i+1 < $count && $dataCategory[$i+1]->level_value > $dataCategory[$i]->level_value){?>

                            <?php }else{ ?>
                                </li>
                            <?php } ?>
                            <?php }else{?>
                            <?php for($j = $dataCategory[$i]->level_value;$j<$prevLevel;$j++){ ?>
                        </ul>
                            <?php } ?>
                        <li class="menu-item" data-id="<?php echo $dataCategory[$i]->id; ?>">
                            <?php if ($i+1 < $count && $dataCategory[$i+1]->level_value > $dataCategory[$i]->level_value){
                                $isHide = '';
                            }
                            else{
                                $isHide = 'display-none';
                            }?>
                            <span class="glyphicon plus plusButton glyphicon-plus {{ $isHide }}"></span>
                            <span class="glyphicon minus minusButton glyphicon-minus {{ $isHide }}"></span>
                            <div class=" dInput">
                                <input type="text" class="CssName menuName form-control" disabled value="<?php echo $dataCategory[$i]->name; ?>" placeholder="New Name">
                                <span class="glyphicon checked checkName glyphicon-ok"></span>
                                <span class="glyphicon attach glyphicon-paperclip"></span>
                                <input type="text" class=" form-control menuURL CssURL" disabled value="<?php echo $dataCategory[$i]->url; ?>" placeholder="http://">
                                <span class="glyphicon checked checkURL glyphicon-ok"></span>

                            </div>
                            <div class="CUD">
                                <a class="pull-right btn btn-danger itemDelete delete btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
                                <a class="pull-right btn btn-warning itemEdit edit btn-xs" ><span class="glyphicon glyphicon-edit"></span></a>
                                <a class="pull-right btn btn-info update itemUpdate btn-xs" hidden="true"><span class="glyphicon glyphicon-save"></span></a>
                                <a class="pull-right btn btn-primary iteamCreate create btn-xs" ><span class="glyphicon glyphicon-plus"></span></a>
                            </div>
                            <?php if ($i+1 < $count && $dataCategory[$i+1]->level_value > $dataCategory[$i]->level_value){?>
                            <?php }else{ ?>
                        </li>
                            <?php } ?>
                            <?php }?>
                            <?php
                            $prevLevel = $dataCategory[$i]->level_value;
                            }?>
                    </ul>
                </div>
                <div class="ref">
                    <b>Refer: </b><a href="http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql/" target="_blank">http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql/</a>
                </div>
            </div>
        </div>
    </div>


    <div id="new-node-temp" hidden="true">
        <li class="menu-item">
                <span class="glyphicon plus plusChid plusButton glyphicon-plus"></span>
                <span class="glyphicon minus minusButton glyphicon-minus"></span>
            <div class="dInput">
                <input type="text" class="newNodeName menuName CssName form-control " placeholder="New Name" />
                <span class="glyphicon checkName checked glyphicon-ok"></span>
                <span class="glyphicon attach glyphicon-paperclip"></span>
                <input type="text" class=" form-control newNodeURL menuURL CssURL" placeholder="http://">
                <span class="glyphicon checkURL checked glyphicon-ok"></span>

            </div>
            <div class="CUD" >
                <a class="pull-right btn btn-danger itemDelete delete btn-xs"><span class="glyphicon  glyphicon-remove"></span></a>
                <a class="pull-right btn btn-info save itemSave btn-xs" ><span class="glyphicon glyphicon-save"></span></a>
                <a class="pull-right btn btn-warning edit itemEdit editchid btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="pull-right btn btn-info itemUpdate update btn-xs"><span class="glyphicon glyphicon-save"></span></a>
                <a class="pull-right btn btn-primary iteamCreate create createChid btn-xs" ><span class="glyphicon glyphicon-plus"></span></a>
            </div>
        </li>
    </div>

    <div id="new-node-group-temp" hidden="true">
        <ul class="group-menu-item">
            <li class="menu-item">
                <span class="glyphicon plus plusChid plusButton glyphicon-plus"></span>
                <span class="glyphicon minus minusButton glyphicon-minus"></span>
                <div class="dInput">
                    <input type="text" class="newNodeName menuName CssName form-control " placeholder="New Name" />
                    <span class="glyphicon checkName checked glyphicon-ok"></span>
                    <span class="glyphicon attach glyphicon-paperclip"></span>
                    <input type="text" class=" form-control newNodeURL menuURL CssURL" placeholder="http://">
                    <span class="glyphicon  checked glyphicon-ok"></span>

                </div>
                <div class="CUD">
                    <a class="pull-right btn btn-danger itemDelete delete btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
                    <a class="pull-right btn btn-info itemSave save btn-xs"><span class="glyphicon glyphicon-save"></span></a>
                    <a class="pull-right btn btn-warning itemEdit edit editchid btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                    <a class="pull-right btn btn-info itemUpdate update btn-xs" ><span class="glyphicon glyphicon-save"></span></a>
                    <a class="pull-right btn btn-primary iteamCreate create createChid btn-xs" ><span class="glyphicon glyphicon-plus"></span></a>
                </div>
            </li>
        </ul>
    </div>


@endsection
@section('scripts')

<script type="text/javascript" src="{{ asset('js/lib/toastr.js') }}"></script>
    <script type="text/javascript">

        $('.update').addClass('display-none');
        $('.updatechid').addClass('display-none');
        $('.minus').addClass('display-none');
        $('.createChid').addClass('display-none');
        $('.editchid').addClass('display-none');
        $('.plusChid').addClass('display-none');




        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

// Show menu
            $(document).on('click', '.plusButton' ,function(event) {
                    $(this).parent('.menu-item').find('ul.group-menu-item').first().removeClass('display-none');
                    $(this).next('.minusButton').removeClass('display-none');
                    $(this).addClass('display-none');
                });


// Hide Menu
           $(document).on('click', '.minusButton' ,function(event) {
                $(this).parent('.menu-item').find('ul.group-menu-item').first().addClass('display-none');
                $(this).prev('.plusButton').removeClass('display-none');
                $(this).addClass('display-none');
           });

//Create New menu
            $(document).on('click', '.create' ,function(event) {
                var currentNode = $(this).parents('li.menu-item').first();
                var parentNodeId =  $(this).parents('li.menu-item').data('id');
                var addNode = $('#new-node-temp').clone().contents();
                var addNodeGroup = $('#new-node-group-temp').clone().contents();
                var childBag = $(this).parent('li.menu-item').nextAll('ul.group-menu-item').first();

                $(this).removeClass('display-none');
                    $(currentNode).find('.plusButton').first().trigger('click');

                if(childBag.length>0){
                    $(addNode).find('input.newNodeName').first().attr('parentNodeId',parentNodeId);
                    $(addNode).removeClass('display-none');
                    $(this).parents('li.menu-item').first().find('ul.group-menu-item').first().prepend(addNode);
                    $(this).parents('li.menu-item').first().find('input.newNodeName').first().focus();

                    if($(currentNode).find('li.menu-item').length>0){
                            $(currentNode).find('.minusButton').first().removeClass('display-none');
                        }
                }else{
                    $(addNodeGroup).find('input.newNodeName').first().attr('parentNodeId',parentNodeId);
                    $(addNodeGroup).removeClass('display-none');
                    $(this).parents('li.menu-item').first().append(addNodeGroup);
                    $(this).parents('li.menu-item').first().find('input.newNodeName').first().focus();
                    // $(this).parents('li.menu-item').first().find('input.newNodeURL').first().focus();
                    if($(currentNode).find('li.menu-item').length>0){
                        $(currentNode).find('.minusButton').first().removeClass('display-none');
                    }
                }
            });

//Save
            $(document).on('click','.save', function(event) {

                var parentAddId =  $(this).parents('li.menu-item').first().data('id');

                var liParent = $(this).parents('li.menu-item').first();
                var insert = $(this);
                var input = $(this).parents('li.menu-item').first().find('input.menuName').first();
                var inputURL = $(this).parents('li.menu-item').first().find('input.newNodeURL').first();
                var name = $(input).val();
                var url = $(inputURL).val();

                var parentId = $(input).attr('parentNodeId');

                var currentNode =$(this).parents('li.menu-item').first();
                var parentNode  =$(currentNode).parents('li.menu-item').first();
                var datas = {
                    url:url,
                    name:name,
                    parent_id:parentId
                };

                if(validateMenu($(input))==true) {

                    $(liParent).find('.edit').first().removeClass('display-none');
                    $(liParent).find('.save').first().addClass('display-none');
                    $(liParent).find('.create').first().removeClass('display-none');

                    $(input).prop('disabled', true);
                    $(inputURL).prop('disabled', true);
                    $.ajax({
                        url: '{{ route('createMenu') }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: datas,
                        success: function (res) {
                            var dataFromSP = JSON.parse(res.data[0].data);
                            var newId = dataFromSP.newid;
                            $(insert).parents('ul.group-menu-item').first().find('li.menu-item').first().attr('data-id', newId);
                            toastr.success('Create new success!', '',{timeOut: 2000});

                        }
                    });
                    clearError($(input));
                }
                else{

                    showMenuError($(input));

                }
            });

// Edit Enabled input
            $(document).on('click', '.edit' ,function(event) {
                var liParent =  $(this).parents('li.menu-item').first();
                $(liParent).find('input.menuName').first().prop('disabled', false).select();
                $(liParent).find('input.menuURL').first().prop('disabled', false).select();
                $(liParent).find('.edit').first().addClass('display-none');
                $(liParent).find('.create').first().addClass('display-none');
                $(liParent).find('.update').first().removeClass('display-none');

            });

// Update
            $(document).on('click','.update', function(event) {

                var curren = $(this);

                var id = $(this).parents('li.menu-item').data('id');
                var input = $(this).parents('li.menu-item').first().find('input.menuName').first();
                var inputURL = $(this).parents('li.menu-item').first().find('input.menuURL').first();
                var name = $(input).val();
                var url = $(inputURL).val();
                var liParent = $(this).parents('li.menu-item').first();

                var data = {
                    id:id,
                    name:name,
                    url:url
                 };

                if(validateMenu($(input))==true){

                    $(input).prop('disabled', true);
                    $(inputURL).prop('disabled', true);
                    $(liParent).find('.update').first().addClass('display-none');
                    $(liParent).find('.edit').first().removeClass('display-none');
                    $(liParent).find('.create').first().removeClass('display-none');
                    $.ajax({
                        url: '{{ route('updateMenu') }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: data,
                        success: function (res) {
                           toastr.success('Update success!', '',{timeOut: 2000});
                        }
                    });
                    clearError($(input));
                    validateMenu($(input));
                }
                else{
                    showMenuError($(input));
                }
            });




//Delete
            $(document).on('click','.delete', function(event) {
                var id = $(this).parents('li.menu-item').data('id');
                var currentNode = $(this).parents('li.menu-item').first();
                var parentNode  = $(currentNode).parents('li.menu-item').first();
                var buttonDelete =  $(this);
                if (id){
                    $.confirm({
                        title: '!!!!!!!',
                        content: 'YOU SURE WANT TO DELETE ?',
                        type: 'red',
                        typeAnimated: true,

                        buttons: {
                            deleteUser: {
                                btnClass: 'btn-red',
                                text: 'Yes,I agree',
                                action: function () {
                                    $.ajax({
                                        url: '{{ route('deleteMenu') }}',
                                        type: 'DELETE',
                                        data: {id: id},
                                        success : function(res) {
                                            if (res.status) {
                                                $(currentNode).remove();
                                                if ($(parentNode).find('li.menu-item').length <=0){
                                                    $(parentNode).find('.minusButton').first().addClass('display-none');

                                                }
                                                toastr.success('Deleted success!', '',{timeOut: 2000});

                                            }
                                        }
                                    });
                                }
                            },
                            Cancel: function () {
                            }
                        }
                    });
                }
               else{
                    $(currentNode).remove();
                    if ($(parentNode).find('li.menu-item').length <=0){
                        $(parentNode).find('.minusButton').first().addClass('display-none');
                    }
               }

            });

            // var selector = $(this).parents('li.menu-item').first().find('input.menuName').first();
            function showMenuError(selector){
                var messageError ="This field is not empty !";
                $(selector).attr('data-original-title',messageError);
                $(selector).tooltip('show');
                $(selector).addClass('input-error');
            }
            function clearError(selector){
                if(selector.length > 0){
                    $(selector).attr('data-original-title','');
                    $(selector).removeClass('input-error');
                }else{
                    $('.input-error').each(function(){
                        $(selector).attr('data-original-title','');
                        $(selector).removeClass('input-error');
                    });
                }
            }

            function validateMenu(selector) {
                var result =  false;
                //check required
                if($(selector).val()!=''){
                    result =  true;
                }
                return result;
            }
        });
    </script>


@endsection
