@extends('layouts.dev')
<style>
    .edit, .save,.delete{
        cursor: pointer;
    }
    .table th{
        text-align: center;
    }
    .table td{
        vertical-align: middle;
    }
    .save, #save-all{
        color: green;
    }
    .function{
        padding-bottom: 10px;
    }
    .btn{
        cursor: pointer;
    }
    .form-title{
        padding-top: 7px;
    }
    #edit-all.open{
        color: green;
    }
    .text-warning{
        color: orange;
    }legend{
         font-size: 16px !important;
     }
    .excute-one{
        cursor: pointer;
    }

</style>
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold">Entity Management</div>
                    <fieldset class="border">
                        <legend>Filter:</legend>
                        <div class="col-md-12 filter">
                            <div class="col-md-12 form-group">
                                <div class="col-md-2 form-title">Name</div>
                                <div class="col-md-4">
                                    <input type="text" id="sp-name" class="form-control"/>
                                </div>
                            </div>
                        </div>


                    </fieldset>

                    <div class="function col-md-12">
                        <button id="generation" class="btn btn-primary pull-right glyphicon glyphicon-save-file" title="Generate All Entity Class"></button>
                    </div>
                    <div class="card-body">
                        <table id="tbl-trans" class="table-bordered table table-hover w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Proceduce Name</th>
                                    <th>Modified</th>
                                    <th>Created</th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $index = 0; ?>
                            <?php if(!empty($listSp)){
                            foreach ($listSp as $item){
                            $index++;
                            ?>
                            <tr class="trans-record">
                                <td class="text-center"><?php echo $index; ?></td>
                                <td><?php echo $item->Name; ?></td>
                                <td><?php echo $item->Modified; ?></td>
                                <td><?php echo $item->Created; ?></td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <span class="excute-one glyphicon glyphicon-play" data-name="<?php echo $item->Name; ?>" title="Generate Entity Class"></span>
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
            var table = $('#tbl-trans').DataTable(
                {
                    scrollY:        '65vh',
                    scrollCollapse: true,
                    fixedHeader: true,
                    bJQueryUI: true,
                    info:     false,
                    paging: false,
                    dom: 't',
                    searching: true,
                    "columnDefs": [ {
                        "targets": 4,
                        "orderable": false
                    } ]
                }
            );

            $('#sp-name').on( 'change', function () {
                table.column(1).search( this.value ).draw();
            } );


            $(document).on('click', '#generation', function () {
                $.ajax({
                    method: 'Post',
                    url: "<?php echo @route('generateEntity')?>",
                    success: function (result) {
                        alert('Have done');
                    }
                });
            });
            $(document).on('click', '.excute-one', function () {
                var data = {
                    name: $(this).data('name')
                };

                $.ajax({
                    method: 'Post',
                    data: data,
                    url: "<?php echo @route('generateOneEntity')?>",
                    success: function (result) {
                        alert('Have done');
                    }
                });
            });


        });

    </script>

@endsection
