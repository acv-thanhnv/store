@extends('layouts.dev')
@section('content')
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        label.switch  {
            margin-bottom: -6px !important;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 13px;
            width: 13px;
            left: 2px;
            bottom: 6px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .table th {
            text-align: center;
        }

        .function {
            padding-bottom: 10px;
        }
        .padding-left-0{
            padding-left: 0 !important;
        }
    </style>
    @csrf

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bold">ACL</div>

                <div class="card-body form-group">
                    <fieldset class="border">
                        <legend>Filter:</legend>
                        <div class="col-md-12 filter">
                            <div class="col-md-12 form-group">
                                <div class="col-md-2 form-title">Role</div>
                                <div class="col-md-4">
                                    <select id="cb-role" class="form-control">
                                        <option value="">---</option>
                                        <?php if(!empty($roleList)){?>
                                        <?php foreach ($roleList as $roleItem){?>
                                        <option
                                            value="<?php echo $roleItem->name;?>"><?php echo $roleItem->name?></option>
                                        <?php   }
                                        }?>
                                    </select>
                                </div>
                                <div class="col-md-2 form-title">Module</div>
                                <div class="col-md-4">
                                    <select id="cb-module" class="lang form-control">
                                        <option value="">---</option>
                                        <?php if(!empty($moduleList)){?>
                                        <?php foreach ($moduleList as $moduleItem){?>
                                        <option
                                            value="<?php echo $moduleItem->module_code;?>"><?php echo $moduleItem->module_code?></option>
                                        <?php   }
                                        }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="col-md-2 form-title">Controller</div>
                                <div class="col-md-4">
                                    <input type="text" id="text-controller" class="form-control"/>
                                </div>
                                <div class="col-md-2 form-title">Action</div>
                                <div class="col-md-4">
                                    <input type="text" id="text-action" class="form-control"/>
                                </div>
                            </div>
                        </div>


                    </fieldset>
                    <div class="col-md-12 padding-left-0">
                        <div class="function pull-left padding-left-0 col-md-6">
                            <button id="refresh" class="btn btn-primary">Synchronously <span
                                        class="glyphicon glyphicon-refresh"></span></button>
                            <button id="generation" class="btn btn-primary">Generate to config file <span
                                        class="glyphicon glyphicon-file"></span></button>

                        </div>
                        <div class="function text-right col-md-6">
                            <label style="color: red">Active for all of screen ( both screen filtered and not filtered ): </label>
                            <label class="switch">
                                <input type="checkbox" class="change-active-all">
                            <span class="slider round">
                            </span>
                            </label>
                        </div>
                    </div>

                    <table id="acl-table" class="table-bordered table table-hover w-100">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Role name</th>
                            <th>Module</th>
                            <th>Controller</th>
                            <th>Action</th>
                            <th>Namespace</th>
                            <th>Active</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $index = 0; ?>
                        <?php if(!empty($dataAcl[1])){
                        foreach ($dataAcl[1] as $item){
                        $index++;
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $index; ?></td>
                            <td><?php echo $item->role_name; ?></td>
                            <td><?php echo $item->module; ?></td>
                            <td><?php echo $item->controller; ?></td>
                            <td><?php echo $item->action; ?></td>
                            <td><?php echo $item->screen_code; ?></td>
                            <td class="text-center">
                                <?php
                                $selected = '';
                                if ($item->is_active == 1) {
                                    $selected = "checked";
                                }
                                ?>
                                <label class="switch">
                                    <input type="checkbox" class="change-active" <?php echo $selected; ?>
                                    data-role_map_id="<?php echo $item->role_map_id;?>">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr>
                        <?php }
                        }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#acl-table').DataTable(
                {
                    scrollY:        '60vh',
                    scrollCollapse: true,
                    fixedHeader: true,
                    bJQueryUI: true,
                    info: false,
                    paging: false,
                    dom: 't',
                    searching: true,
                    "columnDefs": [{
                        "targets": 5,
                        "orderable": false
                    }]
                }
            );

            $('#cb-role').on('change', function () {
                table.column(1).search(this.value).draw();
            });
            $('#cb-module').on('change', function () {
                table.column(2).search(this.value).draw();
            });
            $('#text-controller').on('change', function () {
                table.column(3).search(this.value).draw();
            });
            $('#text-action').on('change', function () {
                table.column(4).search(this.value).draw();
            });

            $(document).on('change', '.change-active', function () {
                var data = {
                    active: $(this).prop('checked'),
                    role_map_id: $(this).data('role_map_id')
                };
                $.ajax({
                    data: data,
                    type: 'Post',
                    dataType: 'json',
                    url: "<?php echo @route('updateAclActive')?>",
                    success: function (result) {
                    }
                });
            });
            $(document).on('change', '.change-active-all', function () {
                var checked =  $(this).prop('checked');
                var data = {
                    active: checked
                };
                $.ajax({
                    data: data,
                    type: 'Post',
                    dataType: 'json',
                    url: "<?php echo @route('updateAclActiveAll')?>",
                    success: function (result) {
                        $('#cb-role').val('');
                        $('#cb-module').val('');
                        $('#text-controller').val('');
                        $('#text-action').val('');
                        table.column(1).search('').draw();
                        if(checked==true){
                            $('#acl-table .change-active').each(function(){
                                $(this).prop('checked',true);
                            });
                        }else{
                            $('#acl-table  .change-active').each(function(){
                                $(this).prop('checked',false);
                            });
                        }
                    }
                });
            });

            $(document).on('click', '#generation', function () {
                $.ajax({
                    type: 'Post',
                    url: "<?php echo @route('generationAclFile')?>",
                    success: function (result) {
                        $.alert(
                            {
                                title: 'Alert!',
                                content: 'Gennerated!',
                            }
                        );
                    }
                });
            });
            $(document).on('click', '#refresh', function () {
                $.ajax({
                    type: 'Post',
                    url: "<?php echo @route('refreshAclInDB')?>",
                    success: function (result) {
                        $.alert(
                                {
                                    title: 'Alert!',
                                    content: 'Synchronized!',
                                    buttons: {
                                        ok: function(){
                                            location.reload();
                                        }
                                    }
                                }
                        );
                    }
                });
            });
        });


    </script>

@endsection


