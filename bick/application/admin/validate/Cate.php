<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/21
 * Time: 23:04
 */
namespace app\admin\validate;
use think\Validate;
class Cate extends Validate{

    protected $rule=[
        'catename'=>'unique:cate|require|max:25',

    ];

    protected $message=[
        'catename.require'=>'栏目标题不能为空！',
        'catename.unique'=>'栏目标题不能重复！',
        'catename.max'=>'栏目标题长度不能超过25位',

    ];

    protected $scene =[
        'add'=>['catename'],
        'edit'=>['catename']
    ];
}