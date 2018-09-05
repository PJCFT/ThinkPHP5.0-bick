<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/6
 * Time: 18:58
 */
namespace app\admin\controller;
use app\admin\model\Conf as ConfModel;
use app\admin\validate\Conf as ConfValidate;
use app\admin\controller\Common;
use think\Loader;

class Conf extends Common
{

    //显示配置列表
    public function lst(){
        if (request()->isPost()){
            $sorts = input('post.');
            $conf = new ConfModel();
            foreach ($sorts as $k => $v){
                $conf->update(['id'=>$k,'sort'=>$v]);
            }
            $this->success('更新排序成功！',url('conf/lst'));
            return;
        }
        $confres = ConfModel::order('sort desc')->paginate(5);
        $this->assign('confres',$confres);
        return view('list');
    }

    //增加配置
    public function add(){
        if (request()->isPost()){
            $data = input('post.');
            //进行数据验证
            $validate = Loader::validate('Conf');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }

            //对提交过来的可选值得中文逗号转成英文逗号
            if($data['values']){
                $data['values'] = str_replace('，',',',$data['values']);
            }
            $conf = new ConfModel();
            if($conf->save($data)){
                $this->success('添加配置成功！',url('conf/lst'));
            }else{
                $this->error('添加配置失败！');
            }
            return;
        }
        return view('add');
    }
    //修改配置
    public function edit(){
        if (request()->isPost()){
            $data = input('post.');
            //进行数据验证
            $validate = Loader::validate('Conf');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            //对提交过来的可选值得中文逗号转成英文逗号
            if($data['values']){
                $data['values'] = str_replace('，',',',$data['values']);
            }
            $conf = new ConfModel();
            $save = $conf->save($data,['id'=>$data['id']]);
            if($save !== false){
                $this->success('修改配置成功！',url('conf/lst'));
            }else{
                $this->error('修改配置失败！');
            }
            return;
        }
        $confs = ConfModel::find(input('id'));
        $this->assign('confs',$confs);
        return view('edit');
    }

    //删除配置
    public function del(){
        $del = ConfModel::destroy(input('id'));
        if($del){
            $this->success('删除配置成功！',url('conf/lst'));
        }else{
            $this->error('删除配置失败！');
        }
    }

    //显示所有的配置项
    public function conf(){
        if(request()->isPost()){
         $data = input('post.');
         /*
          * 对于配置项是复选框的情况取消选中的处理：复选框没有选中的话
          * 其字段值是没有的就是提交的数据缺失该复选框的enname和对应的值
          * 处理的方法，是从数据库中读取所有的enname，转换为一维数组
          * 将提交过来的数据也转换为一维数组，比较从数据库里取出的数据是否存在提交过来的数据
          * 如果没有的话，将字段存进另外一个新的一维数组，然后将其数据库的字段对应的值设为空
          */
         $formarr = array();//提交过来转换后存一维数组
         foreach ($data as $k => $v){
             $formarr[] = $k;
         }
         //从数据库中读取所有的enname
         $_confarr = db('conf')->field('enname')->select();
         $confarr = array();//从数据库中取出的所有enname转换后存一维数组
         foreach ($_confarr as $k => $v){
             $confarr[] = $v['enname'];
         }
         //对confarr中不存在formarr里的字段重新存进另外一个数组
         $checkboxarr = array();//存数据库里没有提交过来的enname字段值
         foreach ($confarr as $k => $v){
             if(!in_array($v,$formarr)){
                 $checkboxarr[] = $v;
             }
         }
         //对存在的checkbox，循环将其value设置为空来替代复选框没有选中的状态
         if($checkboxarr){
             foreach($checkboxarr as $key => $v){
                 ConfModel::where('enname', $v)->update(['value'=>'']);
             }
         }
         if($data){
             foreach ($data as $k=>$v){
                 ConfModel::where('enname',$k)->update(['value'=>$v]);
             }
             $this->success('修改配置成功！');
         }
         return;
        }
        $confres = ConfModel::order('sort desc')->select();
        $this->assign('confres',$confres);
        return view('conf');
    }




}