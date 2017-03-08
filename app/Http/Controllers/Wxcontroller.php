<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use App\User;
class Wxcontroller extends Controller
{
    public $app = '';
    //接入微信
    public function __construct()
    {
        $options = [
            'debug'  => true,
            'app_id' => 'wx060be7f2863f2be7',
            'secret' => '84cb1795ff6c20a91ac7df3bf8846d0c',
            'token'  => 'cqkd',
            // 'aes_key' => null, // 可选
            'log' => [
                'level' => 'debug',
                'file'  => 'C:\wamp\www\weixin\easywechat.log', // XXX: 绝对路径！！！！
            ],
        ];
        $this->app = new Application($options);
    }

    public function index()
    {
        $server = $this->app->server;
        $server->setMessageHandler(function($message){
            if($message->MsgType == 'event'){
                return $this->shijian($message);
            }else{
                return $this->text($message);
            }
        });
        $server->serve()->send();
        //服务端验证
        // $response = $this->app->server->serve();
        // 将响应输出
        // return $response;
    }

    public function shijian($message)
    {
        $openId = $message->FromUserName;
        $user = new User();
        if($message->Event == 'subscribe'){
            if($user->where('openid',$openId)->first()){
                //修改状态
                $Quser = $user->where('openid',$openId)->first();
                $Quser->status = 1;
                $Quser->save();
                return '你好，欢迎回来！';
            }else{
                // 获取用户信息
                $userService = $this->app->user;
                //获取用户实例
                $userInfo = $userService->get($openId);
                //存储用户信息
                $user->name = $userInfo->nickname;;
                $user->openid = $openId;
                $user->status = 1;
                $user->subtime = time();
                $user->save();
                //生成带参数的永久二维码
                $this->qrcode($openId);
                return '你好，欢迎关注！';
            }
        }elseif($message->Event == 'unsubscribe'){
            $Quser = $user->where('openid',$openId)->first();
            $Quser->status = 0;
            $Quser->save();
        }
    }

    public function text($message)
    {
        if($message->MsgType = 'text'){
            return '你好！';
        }
    }

    public function qrcode($openId)
    {
        $qrcode = $this->app->qrcode;
        $result = $qrcode->forever($openId);
        $ticket = $result->ticket;
        // $url = $result->url;
        $url = $qrcode->url($ticket);
        $content = file_get_contents($url); // 得到二进制图片内容
        file_put_contents(public_path() .'/qrcode/'. $openId .'.png', $content); // 写入文件

    }
}
