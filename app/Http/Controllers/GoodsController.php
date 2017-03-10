<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Cart;
use App\Order;
use App\Item;

class GoodsController extends Controller
{
    //商品列表页面
    public function index()
    {
        $goods = DB::table('goods')->get();
        foreach ($goods as $good) {
            $good->buy_num = mt_rand(0,20);//计算给定gid商品的已购买数量（此处使用随机函数）
        }
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
        
        return redirect('/');
    }

    //购物车
    public function cart()
    {
        $goods_info = Cart::getContent();
        $total_num = Cart::getTotalQuantity();
        $total_price = Cart::getTotal();
        return view('cart',['goods'=>$goods_info,'total_num'=>$total_num,'total_price'=>$total_price]);
    }

    //减少一定数量的同一个商品
    public function update($gid,$quantity)
    {
        Cart::update($gid, array(
            'quantity' => $quantity,
        ));
        return redirect('cart');
    }

    //删除一个商品
    public function remove($gid)
    {
        Cart::remove($gid);
        return redirect('cart');
    }

    //清空购物车
    public function cart_clear()
    {
        Cart::clear();
        return redirect('cart');
    }

    //订单入库
    public function done(Request $request)
    {
        //获取用户登录信息
        $u = session()->get('wechat_user');
        $openid = $u->getId();

        //获取数据库的用户信息
        $userinfo = DB::table('users')->where('openid',$openid)->first();
        $order = new Order();

        //共计多少钱
        $total = Cart::getTotal();

        //写入数据库
        $order->ordsn = date('YmdHis').mt_rand(10000,99999);
        $order->uid = $userinfo->uid;
        $order->openid = $userinfo->openid;
        $order->xm = $request->xm;
        $order->address = $request->address;
        $order->tel = $request->tel;
        $order->money = $total;
        $order->ispay = 0;
        $order->ordtime = time();
        $order->save();

        //写入商品表信息
        $goods = Cart::getContent();
        foreach($goods as $good){
            $item = new Item();
            $item->oid = $order->oid;
            $item->gid = $good->id;
            $item->goods_name = $good->name;
            $item->price = $good->price;
            $item->amount = $good->quantity;
            $item->save();
        }

        //清空所有购物车商品（暂不支持购物车局部商品付款）
        $this->cart_clear();
        return view('zhifu',['oid'=>$order->oid]);
    }

    //支付
    public function pay(Request $request)
    {
        $oid = $request->oid;
        DB::table('orders')->where('oid',$oid)->update(['ispay'=>1]);
        return "购买成功";
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
