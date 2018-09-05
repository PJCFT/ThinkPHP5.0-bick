<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/9/1
 * Time: 10:19
 */
namespace app\index\model;
use think\Model;
class Conf extends Model
{
    public function getAllConf(){
        $confres = $this::field('value,enname')->select();
        return $confres;
    }
}