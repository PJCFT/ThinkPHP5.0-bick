<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/6
 * Time: 18:58
 */
namespace app\admin\controller;
use app\admin\model\AuthRule as AuthRuleModel;
use app\admin\validate\AuthRule as AuthRuleValidate;
use app\admin\controller\Common;
use think\Loader;

class AuthRule extends Common
{

    //显示权限列表
    public function lst(){
        $authrule = new AuthRuleModel();
        //进行排序操作
        if(request()->isPost()){
            $sorts = input('post.');
            foreach ($sorts as $k => $v){
                $authrule->update(['id'=>$k, 'sort'=>$v]);
            }
            $this->success('更新排序成功！',url('auth_rule/lst'));
            return;
        }

        $authruleres = $authrule->authtree();
        $this->assign('authruleres',$authruleres);
        return view('list');
    }

    //增加权限
    public function add(){
        if (request()->isPost()){
            $data = input('post.');
            //进行数据的验证
            $validate = Loader::validate('AuthRule');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            //在添加权限时获取权限等级
            $plevel = db('auth_rule')->where('id',$data['pid'])->field('level')->find();
            //如果level 为null，赋值为0，有值的话，标识不是顶级权限，level+1
            if($plevel){
                $data['level'] = $plevel['level'] + 1;
            }else{
                $data['level'] = 0;
            }
            $add = db('auth_rule')->insert($data);
            if($add){
                $this->success('添加权限成功！',url('auth_rule/lst'));
            }else{
                $this->error('添加权限失败！');
            }
            return;
        }
        $authrule = new AuthRuleModel();
        $authruleres = $authrule->authtree();
        $this->assign('authruleres',$authruleres);
        return view('add');
    }
    //编辑权限
    public function edit(){
        if (request()->isPost()){
            $data = input('post.');
            //进行数据的验证
            $validate = Loader::validate('AuthRule');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            //在添加权限时获取权限等级
            $plevel = db('auth_rule')->where('id',$data['pid'])->field('level')->find();
            //如果level 为null，赋值为0，有值的话，标识不是顶级权限，level+1
            if($plevel){
                $data['level'] = $plevel['level'] + 1;
            }else{
                $data['level'] = 0;
            }
            $save = db('auth_rule')->update($data);
            if($save!== false){
                $this->success('修改权限成功！',url('auth_rule/lst'));
            }else{
                $this->error('修改权限失败！');
            }
            return;
        }
        $authrule = new AuthRuleModel();
        $authruleres = $authrule->authtree();
        $authrules = $authrule->find(input('id'));
        $this->assign(array(
            'authruleres'=>$authruleres,
            'authrules'=>$authrules
        ));
        return view('edit');
    }

    //删除权限
    public function del(){
        $authrule = new AuthRuleModel();
        $authruleids = $authrule->getchilrenid(input('id'));
        $authruleids[] = input('id');
        $del = AuthRuleModel::destroy($authruleids);
        if($del){
            $this->success('删除权限成功！',url('auth_rule/lst'));
        }else{
            $this->error('删除权限失败！');
        }
    }

}