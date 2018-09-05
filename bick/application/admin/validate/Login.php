<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/21
 * Time: 23:04
 */
namespace app\admin\validate;
use think\Validate;
class Login extends Validate{

    protected $rule=[
        'name'=>'require|max:25',
        'password'=>'require|min:6',
        'code'=>'require'

    ];

    protected $message=[
        'name.require'=>'管理员名称不能为空！',
        'name.max'=>'管理员名称长度不能超过25位！',
        'password.require'=>'管理员密码不能为空！',
        'password.min'=>'管理员密码长度不能少于6位！',
        'code.require'=>'验证码为空！'
    ];
}