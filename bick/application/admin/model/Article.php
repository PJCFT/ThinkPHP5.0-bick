<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/21
 * Time: 23:04
 */
namespace app\admin\model;
use think\Model;
class Article extends Model{
    /*
     * 模型的事件函数，在插入数据之前进行图片的上传操作
     * */
    protected static function init()
    {
       Article::event('before_insert',function ($article){
           if ($_FILES['thumb']['tmp_name']){
               $file = request()->file('thumb');
               $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
               if($info){
                   $thumb = '/bick/'.'public'.DS.'uploads'.'/'.$info->getSaveName();
                   $article['thumb'] =$thumb;
               }
           }
       });
        //在进行文章修改时，对图片处理
        Article::event('before_update',function ($article){
            if($_FILES['thumb']['tmp_name']){
                //先根据已有id查询是否原来有图片，然后进行删除操作
                $arts = Article::find($article->id);
                //图片的硬盘地址
                $thumbpath = $_SERVER['DOCUMENT_ROOT'].$arts['thumb'];
                if(file_exists($thumbpath)){
                    @unlink($thumbpath);
                }
                //原来的图片删除后，进行新的图片上传操作
                $file = request()->file('thumb');
                $info = $file->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $thumb = '/bick/'.'public'.DS.'uploads'.'/'.$info->getSaveName();
                    $article['thumb'] =$thumb;
                }
            }
        });
        //在进行文章删除之前将文章下有的图片给删除掉
        Article::event('before_delete',function ($article){
                //先根据已有id查询是否原来有图片，然后进行删除操作
                $arts = Article::find($article->id);
                //图片的硬盘地址
                $thumbpath = $_SERVER['DOCUMENT_ROOT'].$arts['thumb'];
                if(file_exists($thumbpath)){
                    @unlink($thumbpath);
                }
        });
    }
}