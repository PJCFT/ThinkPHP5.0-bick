<?php
namespace app\index\controller;
use app\index\model\Article;
class Search extends Common
{
    public function index()
    {
        $article=new Article();
        //获取搜索页面的热点文章
        $serHot=$article->getSerHot();
        $keywords=input('keywords');
        //搜索功能实现，通过模糊搜索来检索文章
        $serRes=db('article')->order('id desc')->where('title','like','%'.$keywords.'%')->paginate(2,false,$config = ['query'=>array('keywords'=>$keywords)]);
        $this->assign(array(
            'serRes'=>$serRes,
            'keywords'=>$keywords,
            'serHot'=>$serHot,
        ));

        return view('search');
    }
}