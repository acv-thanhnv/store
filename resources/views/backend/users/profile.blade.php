@extends("layouts.dialog")
@section("content")
@push('css')
<style type="text/css">

body{
    padding-top:30px;
}
.content{
    margin-right: auto;
    margin-left : auto;
    float       : none;
    box-shadow  : 0 5px 20px 0 #266BC0;
}
.title{
    font-weight: bold;
}
img{
    height: 200px; 
    width : 300px;
}
</style>
@endpush
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-10 content">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="{{$user->src}}" alt="Avatar" class="img-rounded" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>{{$user->name}}</h4>
                        <p>
                            <i class="fa fa-male"></i>
                            <span class="title"> Gender:</span> @if($user->gender===1) {{"Male"}} @else {{"Female"}} @endif
                        </p>
                        <p>
                            <i class="glyphicon glyphicon-gift"></i> 
                            <span class="title"> Birthday:</span> {{$user->birth_date}}
                        </p>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i> 
                            <span class="title"> Email:</span> 
                            {{$user->email}}
                        </p>
                        <p>
                            <i class="fa fa-users"></i> 
                            <span class="title"> Role:</span> 
                            {{$user->RoleName}}
                        </p>
                        <p>
                            <i class="glyphicon glyphicon-question-sign"></i> 
                            <span class="title"> Active:</span> @if($user->is_active===1) {{"Yes"}} @else {{"No"}} @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection