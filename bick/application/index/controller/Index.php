<?php
namespace app\index\controller;
use app\index\controller\Common;
use app\index\model\Article as ArticleModel;
use app\index\model\Cate as CateModel;
class Index extends Common
{
    public function index()
    {
        //首页调用最新文章
        $article = new ArticleModel();
        $newArticleRes = $article->getNewArticle();
        //获取最新的四篇推荐文章
        $recArt = $article->getRecArt();
        //热点文章
        $siteHotArt=$article->getSiteHot();

        //获取友情链接
        $linkRes = db('link')->order('sort desc')->select();

        //获取推荐到首页的栏目
        $cate = new CateModel();
        $recIndex=$cate->getRecIndex();


        $this->assign(array(
            'newArticleRes'=>$newArticleRes,
            'siteHotArt'=>$siteHotArt,
            'linkRes'=>$linkRes,
            'recArt'=>$recArt,
            'recIndex'=>$recIndex
        ));
        return view('index');
    }
}
