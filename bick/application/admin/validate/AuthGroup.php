<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/21
 * Time: 23:04
 */
namespace app\admin\validate;
use think\Validate;
class AuthGroup extends Validate{

    protected $rule=[
        'title'=>'unique:link|require|max:25',
        'url'=>'url|require|max:60',
        'desc'=>'require'
    ];

    protected $message=[
        'title.require'=>'链接标题不能为空！',
        'title.unique'=>'链接标题不能重复！',
        'title.max'=>'链接标题长度不能超过25位',
        'url.url'=>'链接地址格式不正确！',
        'url.require'=>'链接地址不能为空！',
        'url.max'=>'链接地址长度不能超过60位！',
        'desc.require'=>'链接描述不能为空！'
    ];

    protected $scene =[
        'add'=>['title','url','desc'],
        'edit'=>['title','url']
    ];
}