<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as AdminModel;
use app\admin\validate\Login as LoginValidate;
use think\Loader;

class Login extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            $data = input('post.');
            $validate = Loader::validate('Login');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $this->check(input('code'));
            $admin = new AdminModel();
            $num = $admin->login(input('post.'));
            if($num == 1){
                $this->error('管理员不存在');
            }
            if($num == 2){
                $this->success('登录成功！',url('index/index'));
            }
            if ($num == 3){
                $this->error('密码错误！');
            }

            return;
        }
        return view('login');
    }

    //验证码验证
    public function check($code){
        if(!captcha_check($code)){
            $this->error('验证码错误！');
        }
        return true;
    }
}
