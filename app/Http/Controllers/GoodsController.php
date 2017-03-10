<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Cart;
class GoodsController extends Controller
{
    //商品列表页面
    public function index()
    {
        $goods = DB::table('goods')->get();
        return view('index',['goods'=>$goods]);
    }
    //商品详情页
    public function goods($gid)
    {
        $goods = DB::table('goods')->where('gid',$gid)->first();
        return view('goods',['goods'=>$goods]);
    }
    //购买
    public function buy($gid)
    {
        $goods = DB::table('goods')->where('gid',$gid)->first();
        Cart::add($gid, $goods->goods_name, $goods->goods_price, 1, array());
        
        return redirect('cart');
    }
    //购物车
    public function cart()
    {
        $goods_info = Cart::getContent();
        $total = Cart::getTotal();
        return view('cart',['goods'=>$goods_info,'total'=>$total]);
    }
    //减少一定数量的同一个商品
    public function update($gid,$quantity)
    {
        Cart::update($gid, array(
            'quantity' => $quantity,
        ));
        return redirect('cart');
    }
    //清空购物车
    public function cart_clear()
    {
        Cart::clear();
        return redirect('cart');
    }
    //手动添加商品
    public function insert()
    {
        $data = [
            ['goods_name'=>'月季','goods_price'=>'23.8','goods_img'=>'goods_1.jpg'],
            ['goods_name'=>'玫瑰','goods_price'=>'45.6','goods_img'=>'goods_2.jpg'],
            ['goods_name'=>'桃花','goods_price'=>'30.8','goods_img'=>'goods_3.jpg'],
            ['goods_name'=>'妖姬','goods_price'=>'55.6','goods_img'=>'goods_4.jpg'],
        ];
        DB::table('goods')->insert($data);
    }

}
