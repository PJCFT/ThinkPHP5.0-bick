<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/6
 * Time: 19:47
 */

namespace app\index\controller;
use app\index\controller\Common;
use app\index\model\Cate as CateModel;
class Page extends Common
{
    public function index(){
        $cates = db('cate')->find(input('cateid'));
        $cate=new CateModel();
        $cateInfo=$cate->getCateInfo(input('cateid'));
        $this->assign(
            array(
                'cates'=>$cates,
                'cateInfo'=>$cateInfo
            ));
        return view('page');
    }
}