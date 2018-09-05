<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/21
 * Time: 23:04
 */
namespace app\admin\validate;
use think\Validate;
class Conf extends Validate{

    protected $rule=[
        'cnname'=>'unique:conf|require|max:60',
        'enname'=>'unique:conf|require|max:60',
        'type'=>'require'
    ];

    protected $message=[
        'cnname.require'=>'中文名称不能为空！',
        'cnname.unique'=>'中文名称不能重复！',
        'cnname.max'=>'中文名称长度不能超过60位',
        'enname.unique'=>'英文名称不能重复！',
        'enname.require'=>'英文名称不能为空！',
        'enname.max'=>'英文名称长度不能超过60位！',
        'type.require'=>'配置类型不能为空！'
    ];

    protected $scene =[
        'add'=>['cnname','enname','type'],
        'edit'=>['cnname','enname']
    ];
}