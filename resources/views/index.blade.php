<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>商品列表</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<ul class="nav nav-tabs">
			  	<li role="presentation" class="active"><a href="#">首页</a></li>
			  	<li role="presentation"><a href="#">个人中心</a></li>
			  	<li role="presentation"><a href="{{url('cart')}}">购物车</a></li>
			</ul>
		</div>
		<br>
		<div class="row">
			<ol class="breadcrumb">
			  	<li><a href="#">首页</a></li>
			  	<li class="active">商品列表</li>
			</ol>
		</div>

		<div class="row">
			@foreach($goods as $good)
			<div class="col-xs-6">
				<a href="{{url('goods',['gid'=>$good->gid])}}">
					<img src="/images/{{$good->goods_img}}" width="100%" alt="">
				</a>
				<p>
					{{$good->goods_name}} &yen;<span>{{$good->goods_price}}</span>
				</p>
				<p>
					<a href="{{url('buy',['gid'=>$good->gid])}}" class="btn btn-primary btn-sm">加入购物车({{$good->buy_num}})</a>
				</p>
			</div>
			@endforeach
		</div>
	</div>
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>