<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Conf as ConfModel;
use app\index\model\Cate as CateModel;
class Common extends Controller
{
    public function _initialize()
    {
        //当前位置
        if(input('cateid')){
            $this->getPos(input('cateid'));
        }
        if(input('artid')){
            $articles=db('article')->field('cateid')->find(input('artid'));
            $cateid=$articles['cateid'];
            $this->getPos($cateid);
        }
        $this->getConf();
        //网站导航栏
        $this->getNavCates();
        //获取推荐到底部的栏目
        $cate=new CateModel();
        $recBottom=$cate->getRecBottom();
        $this->assign('recBottom',$recBottom);
    }

    //获取栏目的顶级和子栏目
    public function getNavCates(){
        //取得所有的顶级栏目
        $cateres = db('cate')->where(array('pid'=>0))->select();
        //取得对应的顶级栏目的子栏目
        foreach ($cateres as $k => $v){
            $children = db('cate')->where(array('pid'=>$v['id']))->select();
            //对于有子栏目的顶级栏目，将子栏目存进顶级栏目中，没有的话，将其置为0，用于前端判断是否显示子栏目处理
            if($children){
                $cateres[$k]['children'] = $children;
            }else{
                $cateres[$k]['children'] = 0;
            }
        }
        $this->assign('cateres',$cateres);
    }

    //获取系统配置
    public function getConf(){
        $conf = new ConfModel();
        //取得所有的配置
        $_confres = $conf->getAllConf();
        //对取得所有的配置将二维转换为一维，直接通过访问enname 可以获得cnname的值
        $confres = array();
        foreach ($_confres as $k => $v){
            $confres[$v['enname']] = $v['value'];
        }
        $this->assign('confres',$confres);
    }

    //获取当前位置
    public function getPos($cateid){
        $cate= new CateModel();
        $posArr=$cate->getparents($cateid);
        // dump($posArr); die;
        $this->assign('posArr',$posArr);
    }
}
