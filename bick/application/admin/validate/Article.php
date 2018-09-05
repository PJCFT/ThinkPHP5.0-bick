<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/21
 * Time: 23:04
 */
namespace app\admin\validate;
use think\Validate;
class Article extends Validate{

    protected $rule=[
        'title'=>'unique:article|require|max:25',
        'cateid'=>'require',
        'content'=>'require'
    ];

    protected $message=[
        'title.require'=>'文章标题不能为空！',
        'title.unique'=>'文章标题不能重复！',
        'title.max'=>'文章标题长度不能超过25位',
        'cateid.require'=>'文章所属栏目不能为空！',
        'content.require'=>'文章内容不能为空！'
    ];

    protected $scene =[
        'add'=>['title','cateid','content'],
        'edit'=>['title','cateid']
    ];
}