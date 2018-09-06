
@extends('layouts.dev')
@section('content')
        <style>
            .table-bordered{
                padding: 10px;
            }
            .text-warning{
                color: orange;
            }
        </style>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">initialization project function</div>
                    <div class="card-body">
                        <div class="col-md-12 table-bordered display-none">
                            <div class="col-md-10">
                                <span class="text-warning font-weight-bold">- Generate all of EntityClass for Dev ( * Required )</span>
                            </div>
                            <div class="col-md-2 text-right"><button id="generate-entity" class="btn-primary btn">Execute</button></div>
                        </div>
                        <div class="col-md-12 table-bordered display-none">
                            <div class="col-md-10">
                                - Import translate file (.\resources\lang\.*) to DB <br>
                                <span class="text-warning font-weight-bold">Warning: read all file in .\resources\lang\.* and insert to Database</span>
                            </div>
                            <div class="col-md-2 text-right"><button id="import-translate" class="btn-primary btn">Execute</button></div>
                        </div>
                        <div class="col-md-12 table-bordered display-none">
                            <div class="col-md-10">
                                - Insert all module, controller, action to screens table in Database
                            </div>
                            <div class="col-md-2 text-right"><button id="import-action" class="btn-primary btn">Execute</button></div>
                        </div>

                        <div class="col-md-12 table-bordered">
                            <div class="col-md-10">
                                <b>Excute all:</b><br>
                                - Generate all of EntityClass for Dev<br>
                                - Generation Role Data, insert to DB: get all screen -> insert screen to DB, update DB to set active all for administrator role initialization<br>
                                - Generation Acl config file : .\config\acl.php<br>
                                - Import translate file   .\resources\lang\.* to database <br>
                                <span class="text-warning font-weight-bold">Warning: rewrite file in .\resources\lang\.* to Database, old data in sys_translation will be remove</span>
                            </div>
                            <div class="col-md-2 text-right"><button id="init-role" class="btn-primary btn">Reset & Innitization</button></div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '#import-translate', function () {
                $.ajax({
                    type: 'Post',
                    url: "<?php echo @route('importTranslateToDB')?>",
                    success: function (result) {
                        alert('OK');
                    }
                });
            });
            $(document).on('click', '#import-action', function () {
                $.ajax({
                    type: 'Post',
                    url: "<?php echo @route('importScreensList')?>",
                    success: function (result) {
                        alert('OK');
                    }
                });
            });
            $(document).on('click', '#init-role', function () {
                $.ajax({
                    type: 'Post',
                    url: "<?php echo @route('initProject')?>",
                    success: function (result) {
                        alert('OK');
                    }
                });
            });
            $(document).on('click', '#generate-entity', function () {
                $.ajax({
                    type: 'Post',
                    url: "<?php echo @route('generateEntity')?>",
                    success: function (result) {
                        alert('OK');
                    }
                });
            });

        });
    </script>

@endsection
