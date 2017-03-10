<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
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
    //购物车
    public function cart()
    {
        
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
