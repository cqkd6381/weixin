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
			<ol class="breadcrumb">
			  	<li><a href="#">购物车</a></li>
			  	<li class="active">商品清单</li>
			</ol>
		</div>
		<div class="row">
			<table class="table">
				<tr>
					<td>名称</td>
					<td>单价（元）</td>
					<td>数量（个）</td>
					<td>操作</td>
				</tr>
				@foreach($goods as $good)
				<tr>
					<td>{{$good->name}}</td>
					<td>{{$good->price}}</td>
					<td>{{$good->quantity}}</td>
					<td>
						<a href="{{url('update',['gid'=>$good->id,'quantity'=>1])}}">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						</a>
						<a href="{{url('update',['gid'=>$good->id,'quantity'=>-1])}}">
							<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
						</a>
						<a href="{{url('remove',['gid'=>$good->id])}}">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						</a>
					</td>
				</tr>
				@endforeach
				<tr>
					<td>总数：{{$total_num}}个</td>
					<td>小计：&yen;{{$total_price}}</td>
					<td colspan="2">
						<a href="{{url('cart_clear')}}">清空购物车</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="row">
			<form action="{{url('done')}}" method="post">
				{!!csrf_field()!!}
				<div class="form-group">
					<input class="form-control" id="xm" type="text" name="xm" placeholder="收货人">
				</div>
				<div class="form-group">
					<input class="form-control" id="tel" type="text" name="tel" placeholder="手机号">
				</div>
				<div class="form-group">
					<input class="form-control" id="address" type="text" name="address" placeholder="收货地址">
				</div>
				<button type="submit" class="btn btn-default">提交订单</button>
			</form>
		</div>
	</div>
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>