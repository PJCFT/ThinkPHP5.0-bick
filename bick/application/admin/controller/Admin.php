<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/6
 * Time: 18:58
 */
namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;
use app\admin\validate\Admin as AdminValidate;
use app\admin\controller\Common;
use think\Loader;

class Admin extends Common
{
    public function lst(){
        $admin = new AdminModel();
        $auth = new Auth();
        $adminres = $admin->getadmin();
        foreach ($adminres as $k => $v){
            //获取当前用户的用户组名称
            $_groupTitle = $auth->getGroups($v['id']);
            $groupTitle = $_groupTitle[0]['title'];
            $v['groupTitle'] = $groupTitle;
        }
        $this->assign('adminres',$adminres);
        return view('list');
    }

    public function add(){
        if(request()->isPost()){
            $admin = new AdminModel();
            $data = input('post.');
            $validate = Loader::validate('Admin');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            if($admin->addadmin($data)){
                $this->success('添加管理员成功！',url('lst'));
            }else{
                $this->error('添加管理员失败！');
            }
        }
        $authGroupRes = db('auth_group')->select();
        $this->assign('authGroupRes',$authGroupRes);
        return view();
    }

    public function edit($id){
        $admins = db('admin')->find($id);
        if(request()->isPost()){
            $data = input('post.');
            $validate = Loader::validate('Admin');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $admin = new AdminModel();
            $savenum = $admin->saveadmin($data,$admins);
            if($savenum == '2'){
                $this->error('管理员名称不得为空');
            }
            if($savenum !== false){
                $this->success('修改成功！',url('admin/lst'));
            }else{
                $this->error('修改失败！');
            }
            return;
        }
        //显示管理员信息
        if(!$admins){
            $this->error('该管理员不存在');
        }
        $authGroupAccess=db('auth_group_access')->where(array('uid'=>$id))->find();
        $authGroupRes=db('auth_group')->select();
        $this->assign('authGroupRes',$authGroupRes);
        $this->assign('admin',$admins);
        $this->assign('groupId',$authGroupAccess['group_id']);
        return view('edit');
    }

    //删除管理员
    public function del($id){
        $admin = new AdminModel();
        $delnum = $admin->deladmin($id);
        if($delnum == '1'){
            $this->success('删除管理员成功！',url('admin/lst'));
        }else if($delnum == '2'){
            $this->error('删除管理员失败！',url('admin/lst'));
        }
    }
    //退出登录
    public function logout(){
        session(null);
        $this->success('退出登录成功！',url('login/index'));
    }
}