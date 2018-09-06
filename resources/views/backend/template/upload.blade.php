@extends('layouts.backend')
@section('lib_style')

@endsection
@section('content')
    <style>
        .img-item {
            height: 100px;
        }

        .image-item {
            float: left;
            margin: 10px;
            border: 1px solid;
            position: relative;
        }

        .btn-upload {
            margin-top: 15px;
        }

        .delete-btn {
            position: absolute;
            right: 1px;
            bottom: 0px;
            color: red;
            font-size: 17px;
            display: none;
            cursor: pointer;
        }

        .image-item:hover .delete-btn {
            display: block !important;
        }

        .block-main {
            margin-top: 50px;
        }
    </style>
    <div class="block-main">
        <div class="page-title">
            <div class="title_left">
                <h3>Upload file Local </h3>
            </div>

        </div>
        <div class="row" style="margin-left: 5px;"><b>Note:</b> You should be run command to create public storage link: <i>php artisan storage:link</i></div>
        <div class="row">
            <div id="img-upload-area" class="img-uploaded">
                <?php if(!empty($fileLocalInforList)){?>
                <?php foreach ($fileLocalInforList as $url){ ?>
                <div class="image-item form-row">
                    <img class='img-item' src='{{$url['url']}}' path="{{$url['path']}}" image-name=""/>
                    <span class="fa fa-trash delete-btn"></span>
                </div>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <input type="file" id="fileupload" multiple="true">
        <button class="btn-upload" id="upload">UPLOAD</button>
    </div>
    <div class="block-main">
        <div class="page-title">
            <div class="title_left">
                <h3>Upload file S3-Amazon </h3>
            </div>

        </div>
        <div class="row">
            <div id="img-upload-area-s3" class="img-uploaded"></div>
        </div>
        <div class="clearfix"></div>
        <input type="file" id="fileuploads3" multiple="true">
        <button class="btn-upload" id="uploadS3">UPLOAD</button>
    </div>

    <div id="image-item-template" class="display-none">
        <div class="image-item form-row">
            <img class='img-item' src='{{asset("common_images/no-image.png")}}' path="" image-name=""/>
            <span class="fa fa-trash delete-btn"></span>
        </div>
    </div>
@endsection
@section('lib_scripts')

@endsection
@section('form_scripts')
    <script>
        $(document).ready(function () {
            loadImageFromS3();

            $(document).on('click', '#upload', function () {
                var formData = new FormData();
                var fileList = $('#fileupload').prop('files');
                var countFile = fileList.length;
                for (var i = 0; i < countFile; i++) {
                    formData.append('file_' + fileList[i].name + '_' + i, fileList[i]);
                }
                $.ajax({
                    type: 'Post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "<?php echo @route('doUpload_template')?>",
                    success: function (result) {
                        if (result.status == '{{\App\Core\Common\SDBStatusCode::OK}}') {
                            $.each(result.data, function (key, item) {
                                var itemImage = $('#image-item-template').find('.image-item').clone();
                                var img = $(itemImage).find('.img-item');
                                $(img).attr('src', item.url);
                                $(img).attr('path', item.uri);
                                $(img).attr('image-name', item.client_file_name);
                                $('#img-upload-area').append(itemImage);
                            });
                        }

                    }
                });
            });
            $(document).on('click', '#uploadS3', function () {
                var formData = new FormData();
                var fileList = $('#fileuploads3').prop('files');
                var countFile = fileList.length;
                for (var i = 0; i < countFile; i++) {
                    formData.append('file_' + fileList[i].name + '_' + i, fileList[i]);
                }
                $.ajax({
                    type: 'Post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'JSON',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "<?php echo @route('doUploadS3_template')?>",
                    success: function (result) {
                        if (result.status == '{{\App\Core\Common\SDBStatusCode::OK}}') {
                            $.each(result.data, function (key, item) {
                                var itemImage = $('#image-item-template').find('.image-item').clone();
                                var img = $(itemImage).find('.img-item');
                                $(img).attr('src', item.url);
                                $(img).attr('path', item.uri);
                                $(img).attr('image-name', item.client_file_name);
                                $('#img-upload-area-s3').append(itemImage);
                            });
                        }

                    }
                });
            });
            $(document).on('click', '#img-upload-area-s3 .delete-btn', function () {
                var currentBtn =  $(this);
                $.confirm({
                    title: 'Confirm!',
                    content: 'Are you sure to delete?',
                    buttons: {
                        ok: {
                            text: 'Ok',
                            action: function () {
                                callDeleteFileFromS3($(currentBtn));
                            }
                        },
                        Cancel: function () {

                        }

                    }
                });

            });
            $(document).on('click', '#img-upload-area .delete-btn', function () {
                var currentBtn =  $(this);
                $.confirm({
                    title: 'Confirm!',
                    content: 'Are you sure to delete?',
                    buttons: {
                        OK: {
                            text: 'Ok',
                            action: function () {
                                callDeleteFileLocal($(currentBtn));
                            }
                        }
                        ,
                        cancel: {
                            text: 'Cancel',
                            action: function () {
                                //close
                            }
                        }

                    }
                });

            });
        });

        function callDeleteFileLocal(btnDeleteSeletor) {
            var parentBlock = $(btnDeleteSeletor).parent('.image-item');
            var path = $(parentBlock).find('.img-item').attr('path');
            $.ajax({
                type: 'Post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                data: {path: path},
                url: "<?php echo @route('doDeleteFile_template')?>",
                success: function (result) {
                    if (result.status == '{{App\Core\Common\SDBStatusCode::OK}}') {
                        $(parentBlock).remove();
                    }

                }
            });
        }

        function callDeleteFileFromS3(btnDeleteSeletor) {
            var parentBlock = $(btnDeleteSeletor).parent('.image-item');
            var path = $(parentBlock).find('.img-item').attr('path');
            $.ajax({
                type: 'Post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                data: {path: path},
                url: "<?php echo @route('doDeleteFileS3_template')?>",
                success: function (result) {
                    if (result.status == '{{\App\Core\Common\SDBStatusCode::OK}}') {
                        $(parentBlock).remove();
                    }

                }
            });
        }

        /**
         * load image from s3
         */
        function loadImageFromS3() {
            var parentBlock = $(this).parent('.image-item');
            $.ajax({
                type: 'Get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                url: "<?php echo @route('getimage_s3_template')?>",
                success: function (result) {
                    if (result.status == '{{\App\Core\Common\SDBStatusCode::OK}}') {
                        $.each(result.data, function (key, item) {
                            var itemImage = $('#image-item-template').find('.image-item').clone();
                            var img = $(itemImage).find('.img-item');
                            $(img).attr('src', item.url);
                            $(img).attr('path', item.path);
                            $('#img-upload-area-s3').append(itemImage);
                        });
                    }
                }
            });
        }
    </script>
@endsection



