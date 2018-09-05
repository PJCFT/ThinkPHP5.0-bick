<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/21
 * Time: 23:04
 */
namespace app\admin\validate;
use think\Validate;
class AuthRule extends Validate{

    protected $rule=[
        'title'=>'unique:auth_rule|require|max:60',
        'name'=>'unique:auth_rule|max:60',
    ];

    protected $message=[
        'title.require'=>'权限名称不能为空！',
        'title.unique'=>'权限名称不能重复！',
        'title.max'=>'权限名称长度不能超过60位',
        'name.unique'=>'权限地址不能重复！',
        'name.max'=>'权限地址长度不能超过60位！',

    ];

    protected $scene =[
        'add'=>['title','name'],
        'edit'=>['title','name']
    ];
}