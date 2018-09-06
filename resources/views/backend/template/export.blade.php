@extends('layouts.backend')
@section('content')

    <div>Import Template (excel):</div>
    <form action="{{ route('doImport_template') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div>
          {{csrf_field()}}
          <input type="file" name="imported_file"/>
        </div>
        <br></br>
        <button id="import" class="btn btn-primary">Import</button>
    </form>
    <br>
    <div>Export From Template (excel):</div>
        <button id="export" class="btn btn-primary">Export</button>
    <br>
    <div>Export From Template (csv):</div>
        <button id="exportCommon" class="btn btn-primary">Export CSV</button>
    <br>
    Reference : <a href="https://laravel-excel.maatwebsite.nl/docs/2.1/getting-started/installation">https://laravel-excel.maatwebsite.nl/docs/2.1/getting-started/installation</a>
@endsection
@section('form_scripts')
    <script>

        $(document).ready(function () {

            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $(document).on('click','#export',function () {
                location.href = "{{ route('doExports_template') }}";
            });
            $(document).on('click','#exportCommon',function () {
                location.href = "{{ route('doExportsCommon_template',['type'=>'csv']) }}";
            });

        });
    </script>
@endsection



