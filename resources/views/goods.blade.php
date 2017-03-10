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
	<h2>商品详情</h2>
		<div class="row">
			
			<div class="col-xs-12">
				<a href="#">
					<img src="/images/{{$goods->goods_img}}" width="100%" alt="">
				</a>
				<p>
					{{$goods->goods_name}} &yen;<span>{{$goods->goods_price}}</span>
				</p>
				<p>
					<a href="#" class="btn btn-primary">加入购物车</a>
				</p>
			</div>
			
		</div>
		<div class="col-xs-12">
			<ul>
				<li><a href="">首页</a></li>
				<li><a href="">个人中心</a></li>
				<li><a href="">查看购物车</a></li>
			</ul>
		</div>
	</div>
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>