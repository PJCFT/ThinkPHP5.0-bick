<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/6
 * Time: 18:58
 */
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use app\admin\model\Article as ArticleModel;
use app\admin\validate\Article as ArticleValidate;
use app\admin\controller\Common;
use think\Loader;

class Article extends Common
{

    //显示文章列表
    public function lst(){
        //联表查询
        $artres = db('article')->field('a.*,b.catename')->alias('a')->join('bk_cate b','a.cateid = b.id')->paginate(5);
        $this->assign('artres',$artres);
        return view('list');
    }
    //增加文章
    public function add(){
        $cate = new CateModel();
        //进行增加文章请求
        if(request()->isPost()){
            $data = input('post.');
            $validate = Loader::validate('Article');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $data['time'] = $_SERVER['REQUEST_TIME'];
            $article = new ArticleModel();
            //进行文章的增加
            if ($article->save($data)){
                $this->success('添加文章成功！',url('article/lst'));
            }else{
                $this->error('添加文章失败！');
            }

            return;
        }
        $cateres = $cate->catetree();
        $this->assign('cateres',$cateres);
        return view('add');
    }
    //编辑文章
    public function edit(){
        if(request()->isPost()){
            $article = new ArticleModel();
            $data = input('post.');
            $validate = Loader::validate('Article');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $save = $article->update($data);
            if($save){
                $this->success('修改文章成功！',url('article/lst'));
            }else{
                $this->error('修改文章失败');
            }
        }

        //显示文章信息
        $cate = new CateModel();
        $cateres = $cate->catetree();
        $arts = db('article')->where(array('id'=>input('id')))->find();
        $this->assign(array(
            'cateres'=>$cateres,
            'arts'=>$arts
        ));
        return view('edit');
    }

    //删除文章
    public function del(){
        if(ArticleModel::destroy(input('id'))){
            $this->success('删除文章成功！',url('article/lst'));
        }else{
            $this->error('删除文章失败！');
        }
    }

}