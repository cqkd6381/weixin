<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>商品详情</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<ul class="nav nav-tabs">
			  	<li role="presentation"><a href="{{url('/')}}">首页</a></li>
			  	<li role="presentation"><a href="#">个人中心</a></li>
			  	<li role="presentation" class="active"><a href="{{url('cart')}}">购物车</a></li>
			</ul>
			
		</div>
		<br>
		<div class="row">
			<form action="{{url('pay')}}" method="post">
				{!!csrf_field()!!}
				<input type="hidden" name="oid" value="{{$oid}}">
				<button type="submit" class="btn btn-primary">立即支付</button>
			</form>
		</div>
		
	</div>
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>