<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/21
 * Time: 23:04
 */
namespace app\admin\model;
use think\Model;
class Admin extends Model{
    //增加管理员
    public function addadmin($data){
        if(empty($data) || !is_array($data)){
            return false;
        }

        if($data['password']){
            $data['password'] = md5($data['password']);
        }
        $adminData=array();
        $adminData['name']=$data['name'];
        $adminData['password']=$data['password'];
        if($this->save($adminData)){
            $groupAccess['uid']=$this->id;//$this->id可以获得当前的id
            $groupAccess['group_id']=$data['group_id'];
            db('auth_group_access')->insert($groupAccess);
            return true;
        }else{
            return false;
        }
    }
    //管理员列表
    public function getadmin(){
        return $this::paginate(5);//查询数据并且分页
    }
    //修改管理员
    public function saveadmin($data, $admins){
        if(!$data['name']){
            return 2;//管理员用户名为空
        }
        if(!$data['password']){
            $data['password'] = $admins['password'];
        }else{
            $data['password'] = md5($data['password']);
        }
        //对进行用户组的更新
        db('auth_group_access')->where(array('uid'=>$data['id']))->update(['group_id'=>$data['group_id']]);
        return $this::update(['name'=>$data['name'],'password'=>$data['password']],['id'=>$data['id']]);
    }
    //删除管理员
    public function deladmin($id){
        if($this::destroy($id)){
            return 1;//删除管理员成功返回值
        }else{
            return 2;//删除管理员失败返回值
        }
    }
    //管理员登录
    public function login($data){
        $admin = Admin::getByName($data['name']);
        if($admin){
            if($admin['password'] == md5($data['password'])){
                session('id',$admin['id']);
                session('name',$admin['name']);
                return 2;//登录密码正确
            }else{
                return 3;//登录密码错误
            }
        }else{
            return 1;//管理员不存在
        }
    }
}