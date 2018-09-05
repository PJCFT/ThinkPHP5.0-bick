<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/6
 * Time: 18:58
 */
namespace app\admin\controller;
use app\admin\model\AuthGroup as AuthGroupModel;
use app\admin\model\AuthRule as AuthRuleModel;
use app\admin\validate\AuthGroup as AuthGroupValidate;
use app\admin\controller\Common;
use think\Loader;

class AuthGroup extends Common
{

    //显示用户组列表
    public function lst(){

        $authgroupres =AuthGroupModel::paginate(5);
        $this->assign('authgroupres',$authgroupres);
        return view('list');
    }

    //增加用户组
    public function add(){
        if (request()->isPost()){
            $data = input('post.');
            //对有分配权限的rules进行转换成字符串
            if(!isset($data['rules'])){
                $data['rules']=implode(',',$data['rules']);
            }
            //当状态关闭时，赋予为0
            if(!isset($data['status'])){
                $data['status'] = '0';
            }
            $add = db('auth_group')->insert($data);
            if($add){
                $this->success('添加用户组成功！',url('auth_group/lst'));
            }else{
                $this->error('添加用户组失败！');
            }
        }
        $authrule = new AuthRuleModel();
        $authruleres = $authrule->authtree();
        $this->assign('authruleres',$authruleres);
        return view('add');
    }
    //编辑用户组
    public function edit(){
        if(request()->isPost()){
            $data = input('post.');
            //对有分配权限的rules进行转换成字符串
            if(isset($data['rules'])){
                $data['rules']=implode(',',$data['rules']);
            }
            //当状态关闭时，赋予为0
            if(!isset($data['status'])){
                $data['status'] = '0';
            }
            $save = db('auth_group')->update($data);
            if($save !== false){
                $this->success('修改用户组成功！',url('auth_group/lst'));
            }else{
                $this->error('修改用户组失败！');
            }
            retun;
        }

        $authgroups = db('auth_group')->find(input('id'));
        $this->assign('authgroups',$authgroups);
        //显示权限选择
        $authrule = new AuthRuleModel();
        $authruleres = $authrule->authtree();
        $this->assign('authruleres',$authruleres);
        return view('edit');
    }


    //删除用户组
    public function del(){
        $del = db('auth_group')->delete(input('id'));
        if($del){
            $this->success('删除用户组成功！',url('auth_group/lst'));
        }else{
            $this->error('删除用户组失败！');
        }
    }

}