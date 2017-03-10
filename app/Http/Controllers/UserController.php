<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
class UserController extends Controller
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
            'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                'callback' => 'login',
            ],
        ];
        $this->app = new Application($options);
    }

    public function center(Request $request)
    {
        if(!$request->session()->has('wechat_user')){
            $oauth = $this->app->oauth;
            return $oauth->redirect();
        }
        return redirect('/');
    }

    public function login()
    {
        $oauth = $this->app->oauth;
        $user = $oauth->user();
        session()->put('wechat_user',$user);
        return redirect('center');
    }


    public function logout()
    {
        session()->forget('wechat_user');
    }

}
