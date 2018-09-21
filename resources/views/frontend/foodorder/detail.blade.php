<!DOCTYPE html>
<html>
<head>
	<title>Table</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/lib/dataTables.bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/lib/jquery-confirm.css')}}">
	<style type="text/css">
	.wrap-container{
		height: auto;
		width: 100%;
		overflow: hidden;
	}
	.wrap-detail-image{
		clear: both;
		width: 100%;
		height: 400px;
		position: relative;
		overflow: hidden; 
	}
	.detail-image{
		display: block;
		margin-left: auto;
		margin-right: auto;
		width: 100%;
		height: auto;
		border-radius: 8px;
		overflow: hidden;
		border: 1px solid #bebebe; 
		position: absolute;
	}
	.infomation-detail{
		margin-top: 10px;
		height: 20px;
		border:2px solid #666666;
		border-radius: 4px;
		padding: 10px 20px;
		box-shadow: 5px 5px 5px #999999;
		position: relative;
	}
	.wrap-detail-name{
		float: left;
		
	}
	.detail-name{
		font-weight: bold;
		color: #0000ff;
    	font-size: 20px;
	}
	.wrap-detail-price{
		float: right;
		
	}
	.detail-price{
		font-size: 17px;
    	font-style: italic;
    	font-weight: bold;
	}
</style>
</head>
@foreach($detail as $item)
<div class="wrap-container col-sm-12">
	<div class="wrap-detail-image">
		<img class="detail-image" alt="Image detail" src="{{\App\Core\Helpers\CommonHelper::getImageUrl($item->image)}}">
	</div>
	<div class="infomation-detail">
		<span class="wrap-detail-name">Tên Món: <span class="detail-name">{{$item->name}}</span></span>
		<span class="wrap-detail-price">Đơn giá: <span class="detail-price">{{number_format($item->price)}}</span><span>(VNĐ)</span></span>
	</div>
	@endforeach
	<div class="properties-detail">
		
	</div>

</div>

<script src="{{ asset('js/lib/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/lib/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/lib/jquery-confirm.js')}}"></script>
<script type="text/javascript">
// $.ajax({
// url:'',
// dataType:
// });
</script>
</body>
</html>	
