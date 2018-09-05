<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/6
 * Time: 18:58
 */
namespace app\admin\controller;
use app\admin\model\Link as LinkModel;
use app\admin\validate\Link as LinkValidate;
use app\admin\controller\Common;
use think\Loader;

class Link extends Common
{

    //显示友情链接列表
    public function lst(){
        $link = new LinkModel();
        //进行排序操作
        if(request()->isPost()){
            $sorts = input('post.');
            foreach ($sorts as $k => $v){
                $link->update(['id'=>$k, 'sort'=>$v]);
            }
            $this->success('更新排序成功！',url('link/lst'));
            return;
        }
        $linkres = $link->order('sort','desc')->paginate(5);
        $this->assign('linkres',$linkres);
        return view('list');
    }

    //增加友情链接
    public function add(){
        $link = new LinkModel();
        if (request()->isPost()){
            //进行数据的验证
            $data = input('post.');
            $validate = Loader::validate('Link');
            if (!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $addnum = $link->save($data);
            if ($addnum !== false){
                $this->success('添加友情链接成功！',url('link/lst'));
            }else{
                $this->error('添加友情链接失败！');
            }
            return;
        }
        return view('add');
    }
    //编辑友情链接
    public function edit(){
        if(request()->isPost()){
            $data = input('post.');
            $validate = Loader::validate('Link');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $link = new LinkModel();
            $save = $link->save($data, ['id'=>$data['id']]);
            if($save){
                $this->success('修改友情链接成功！',url('link/lst'));
            }else{
                $this->error('修改友情链接失败！');
            }
            return;
        }
        $links = LinkModel::find(input('id'));
        $this->assign('links',$links);
        return view('edit');
    }


    //删除友情链接
    public function del(){
        $del = LinkModel::destroy(input('id'));
        if($del){
            $this->success('删除链接成功！',url('link/lst'));
        }else{
            $this->error('删除链接失败！');
        }
    }

}