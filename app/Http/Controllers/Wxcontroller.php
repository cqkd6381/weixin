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
        if($message->Event == 'subscribe'){
            // 获取用户信息
            $userService = $this->app->user;
            //获取用户实例
            $userInfo = $userService->get($openId);
            //存储用户信息
            $user = new User();
            $user->name = $userInfo->nickname;;
            $user->openid = $openId;
            $user->subtime = time();
            $user->save();
            return '你好，欢迎关注！';
        }
    }

    public function text($message)
    {
        if($message->MsgType = 'text'){
            return '你好！';
        }
    }

    
}
