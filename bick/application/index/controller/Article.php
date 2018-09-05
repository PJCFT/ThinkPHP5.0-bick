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

class Article extends Common
{
    public function index(){
        $artid=input('artid');
        //设置每次刷新该文章页面进行加1
        db('article')->where(array('id'=>$artid))->setInc('click');
        $articles = db('article')->find($artid);
        $hotRes = $article = new ArticleModel();
        //获取热点文章
        $hotRes = $article->getHotRes($articles['cateid']);
        $this->assign(array(
           'articles'=>$articles,
           'hotRes'=>$hotRes
        ));
        return view('article');
    }
}