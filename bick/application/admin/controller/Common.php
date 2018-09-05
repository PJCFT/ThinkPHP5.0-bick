<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/6
 * Time: 18:58
 */

namespace app\admin\controller;
use think\Controller;
use think\Request;

class Common extends Controller
{
    function _initialize()
    {
        if(!session('id') || !session('name')){
            $this->error('您尚未登录系统！请登录！',url('login/index'));
        }

        $auth = new Auth();
        $request = Request::instance();
        //获取当前的控制器
        $con = $request->controller();
        //获取当前的方法
        $action = $request->action();
        $name = $con.'/'.$action;
        $notCheck=array('Index/index','Admin/logout');
          if(session('id')!=1){
          	if(!in_array($name, $notCheck)){
          	    //权限验证check第一参数是要验证的所有方法，第二个是sessionid
          		if(!$auth->check($name,session('id'))){
         $this->error('没有权限',url('index/index'));
         }
          	}

          }

    }
}