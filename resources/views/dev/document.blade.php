@extends('layouts.dev')

@section('content')
    <style>
        .form-control {
            height: 35px !important;
        }

        .form-row {
            margin-top: 5px;
        }
    </style>
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body form-group">

                    <p><strong>DEV Module.</strong></p>
                    <p><strong>Required:</strong>&nbsp;file .env has "DEV_MODE = true"</p>
                    <p><strong>1. Initialization project</strong><br />&nbsp;- Click button to generate common config (ACL file, Translation file...), import list of action to Database.</p>
                    <p><strong>2. Translation</strong></p>
                    <p><strong>&nbsp;- Translation page </strong>management&nbsp; based on languages.</p>
                    <p>&nbsp;- Add new, Update, Remove text.</p>
                    <p>&nbsp;- Generate translations file from Database. ( Database to Code)</p>
                    <p>&nbsp;- Import data from translation file to Database.( Code to Database)</p>
                    <p><strong>3. ACL - Roles</strong></p>
                    <p><strong>&nbsp;</strong>- Acl management, change access permission for each user roles.</p>
                    <p><strong>&nbsp;-&nbsp;</strong>Generate ACL file based on Database to Project code. ( Database to Code)</p>
                    <p>&nbsp;-&nbsp;Synchronously if has changed code ( if you add new action, module or controller. you should run <strong>synchrously&nbsp;</strong> to update data acl)</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>


                </div>
            </div>
        </div>
    </div>

@endsection
