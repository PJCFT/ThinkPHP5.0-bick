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
use app\admin\validate\Cate as CateValidate;
use app\admin\controller\Common;
use think\Loader;

class Cate extends Common
{
    //钩子函数，即在执行del方法前，先执行delsoncate方法
    protected $beforeActionList = [
        'delsoncate' => ['only'=>'del'],
    ];
    //显示栏目列表
    public function lst(){
        $cate = new CateModel();
        //进行排序操作
        if(request()->isPost()){
            $sorts = input('post.');
            foreach ($sorts as $k => $v){
                $cate->update(['id'=>$k, 'sort'=>$v]);
            }
            $this->success('更新排序成功！',url('cate/lst'));
            return;
        }

        $cateres = $cate->catetree();
        $this->assign('cateres',$cateres);
        return view('list');
    }
    //增加栏目
    public function add(){
        $cate = new CateModel();
        if(request()->isPost()){
            $data = input('post.');
            $validate = Loader::validate('Cate');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $add = $cate->save($data);
            if($add){
                $this->success('添加栏目成功！',url('cate/lst'));
            }else{
                $this->error('添加栏目失败！');
            }
            return;
        }
        $cateres = $cate->catetree();
        $this->assign('cateres',$cateres);
        return view('add');
    }
    //编辑栏目
    public function edit(){
        $cate = new CateModel();
        if(request()->isPost()){
            $data = input('post.');

            $validate = Loader::validate('Cate');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $save = $cate->save($data,['id'=>$data['id']]);
            if($save !== false){
                $this->success('修改栏目成功！',url('cate/lst'));
            }else{
                $this->error('修改栏目失败！');
            }
            //进行提交操作后，不进行页面的加载
            return;
        }
        //根据id获取当前栏目信息
        $cates = $cate->find(input('id'));
        //获取全部栏目信息
        $cateres = $cate->catetree();
        $this->assign(array(
            'cates'=>$cates,
            'cateres'=>$cateres
        ));
        return view('edit');
    }

    //删除栏目
    public function del(){
        $del = db('cate')->delete(input('id'));
        if($del){
            $this->success('删除栏目成功！',url('cate/lst'));
        }else{
            $this->error('删除栏目失败！');
        }
    }
    //在执行del删除操作时，先执行删除以这个作为顶级栏目的所有子栏目然后在将该栏目删除
    public function delsoncate(){
        $cateid = input('id');
        $cate = new CateModel();
        $sonids = $cate->getchilrenid($cateid);
        //当删除栏目时，把有关联到该栏目的所有文章也删除
        $allcateid = $sonids;
        $allcateid[] = $cateid;
        foreach ($allcateid as $k=>$v){
            $article = new ArticleModel();
            $article->where(array('cateid'=>$v))->delete();
        }
        //判断该栏目下是否有子栏目，有的话，批量删除子栏目
        if($sonids){
            db('cate')->delete($sonids);
        }
    }


}