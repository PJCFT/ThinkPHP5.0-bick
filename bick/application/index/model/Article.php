<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/9/1
 * Time: 10:19
 */
namespace app\index\model;
use app\index\model\Cate as CateModel;
use think\Model;
class Article extends Model
{
    //通过栏目id来获取该栏目下的所有文章
    public function getAllArticles($cateid){
        $cate=new CateModel();
        $allCateID=$cate->getchilrenid($cateid);
        $artRes=db('article')->where("cateid IN($allCateID)")->order('id desc')->paginate(9);
        return $artRes;
    }

    //热点文章
    public function getHotRes($cateid){
        $cate=new Cate();
        $allCateID=$cate->getchilrenid($cateid);
        $artRes=db('article')->where("cateid IN($allCateID)")->order('click desc')->limit(5)->select();
        return $artRes;
    }

    //获取最新文章
    public function getNewArticle(){
        $newArtiecleRes=db('article')->field('a.id,a.title,a.desc,a.thumb,a.click,a.zan,a.time,c.catename')->alias('a')->join('bk_cate c','a.cateid=c.id')->order('a.id desc')->limit(10)->select();
        return $newArtiecleRes;
    }
    //获取热点文章
    public function getSiteHot(){
        $siteHotArt=$this->field('id,title,thumb')->order('click desc')->limit(5)->select();
        return $siteHotArt;
    }
    // 获取最新推荐的文章四篇
    public function getRecArt(){
        $recArt=$this->where('rec','=',1)->field('id,title,thumb')->order('id desc')->limit(4)->select();
        return $recArt;
    }

    //获取搜索页面的热点文章
    public function getSerHot(){
        $artRes=db('article')->order('click desc')->limit(5)->select();
        return $artRes;
    }
}