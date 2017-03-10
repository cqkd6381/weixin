<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DemoController extends Controller
{	
	//验证请求来自微信服务器
    public function signature()
    {
    	//1. 将token、timestamp、nonce三个参数进行字典序排序
    	$signature = $_GET['signature'];
    	$token = 'cqkd';
    	$timestamp = $_GET['timestamp'];
    	$nonce = $_GET['nonce'];

    	$tmpArr = array($token, $timestamp, $nonce);
    	sort($tmpArr, SORT_STRING);

    	//2. 将三个参数字符串拼接成一个字符串进行sha1加密
    	$tmpStr = implode( $tmpArr );
    	$tmpStr = sha1( $tmpStr );

    	//3. 开发者获得加密后的字符串可与signature对比，标识该请求来源于微信
    	if( $tmpStr == $signature ){
    		// return true;
    		echo $_GET['echostr'];
    		exit;
    	}else{
    		return false;
    	}
    }

    public function index()
    {
    	//接收xml数据
    	$postStr = $GLOBALS['HTTP_RAW_POST_DATA'];
    	//将xml数据转化成对象
    	$postObj = simplexml_load_string($postStr);
    	$a = $postObj->Content;
    	file_put_contents('./a.txt', $a);
    }
}
