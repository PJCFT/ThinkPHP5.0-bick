<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/6
 * Time: 19:47
 */

namespace app\index\controller;
use app\index\controller\Common;
use app\index\model\Article as ArticleModel;
use app\index\model\Cate as CateModel;

class Imglist extends Common
{
    public function index(){
        $article = new ArticleModel();
        $cateid = input('cateid');
        $artRes=$article->getAllArticles($cateid);
        $cate = new CateModel();
        $cateInfo = $cate->getCateInfo(input('cateid'));
        $this->assign(array(
            'artRes'=>$artRes,
            'cateInfo'=>$cateInfo
        ));
        return view('imglist');
    }
}