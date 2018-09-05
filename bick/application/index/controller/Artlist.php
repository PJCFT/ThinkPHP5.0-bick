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

class Artlist extends Common
{
    public function index(){
        $article = new ArticleModel();
        $cateid = input('cateid');
        $artRes=$article->getAllArticles($cateid);
        $hotRes=$article->getHotRes($cateid);
        $cate=new CateModel();
        $cateInfo=$cate->getCateInfo($cateid);
        $this->assign(array(
            'artRes'=>$artRes,
            'hotRes'=>$hotRes,
            'cateInfo'=>$cateInfo
        ));
        return view('artlist');
    }
}