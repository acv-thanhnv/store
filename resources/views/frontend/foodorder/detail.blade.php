<!DOCTYPE html>
<html>
<head>
	<title>Table</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/lib/dataTables.bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/lib/jquery-confirm.css')}}">
	<style type="text/css">
	.wrap-container{
		height: 300px;
		width: 100%;
		overflow: hidden;
	}
	.wrap-detail-image{
		clear: both;
		width: 100%;
		height: 230px;
		position: relative;
	}
	.detail-image{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
    height: 100%;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #bebebe; 
    position: absolute;
	}
	.infomation-detail{
		margin-top: 10px;
		height: 20px;
		border:1px solid;
		padding: 0px 20px;
	}
	.wrap-detail-name{
		float: left;
	}
	.wrap-detail-price{
	float: right;
	}
</style>
</head>
<div class="wrap-container col-sm-12">
	<div class="wrap-detail-image">
			<img class="detail-image" alt="Image detail" src="https://www.gettyimages.ca/gi-resources/images/Homepage/Hero/UK/CMS_Creative_164657191_Kingfisher.jpg">
	</div>
	<div class="infomation-detail">
		<span class="wrap-detail-name">Name:<span class="detail-name">______</span></span>
		<span class="wrap-detail-price">Price:<span class="detail-price">______</span></span>
	</div>
	<div class="properties-detail">
		properties
	</div>

</div>

<script src="{{ asset('js/lib/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/lib/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/lib/jquery-confirm.js')}}"></script>
<script type="text/javascript">

</script>
</body>
</html>	
