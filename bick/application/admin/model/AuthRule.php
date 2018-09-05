<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/21
 * Time: 23:04
 */
namespace app\admin\model;
use think\Model;
class AuthRule extends Model{
    //无限分类显示
    public function authtree(){
        $authruleres = $this->order('sort','desc')->select();
        return $this->sort($authruleres);
    }

    /*
     * 无限分类排序
     * 实现的效果：
     * 中国
     *  广州
     *  梅州
     * 美国
     *  纽约
     * 实现思路：
     * 首先查找pid = 0 即为顶级分类，level 赋予 0，将新的分类数据存进一个空的数组中
     * 然后递归调用自身，传递的参数有（所有栏目分类，该分类id，level+1）
     * 子分类的id 为顶级分类的pid，level加 1 通过循环level来做排版
     * */
    public function sort($data, $pid = 0){
        static $arr = array();
        foreach ($data as $k => $v){
            if($v['pid'] == $pid){
                //字段dataid用于处理js中多选框选中子选框后，它的所有上级选框也选中
                $v['dataid']=$this->getparentid($v['id']);
                $arr[] = $v;
                $this->sort($data, $v['id']);
            }
        }
        return $arr;
    }

    //无限删除操作
    public function getchilrenid($authruleid){
        $authruleres = $this->select();
        return $this->_getchilrenid($authruleres, $authruleid);
    }

    public function _getchilrenid($authruleres, $authruleid){
        static $arr = array();
        foreach ($authruleres as $k => $v){
            if($v['pid'] == $authruleid){
                $arr[] = $v['id'];
                $this->_getchilrenid($authruleres, $v['id']);
            }
        }
        return $arr;
    }

    /*
     * 权限选中实现：
     * 当选中子权限的时候，该子权限所在的所有上级权限都选中
     *
     * */
    public function getparentid($authRuleId){
        $AuthRuleRes=$this->select();
        return $this->_getparentid($AuthRuleRes,$authRuleId,True);
    }
    //加入$clear的目的是对于static 数组的处理，它不会清除掉里面的内容，所以要加一个判断对这个数组进行数据的刷新
    public function _getparentid($AuthRuleRes,$authRuleId,$clear=False){
        static $arr=array();
        if($clear){
            $arr=array();
        }
        foreach ($AuthRuleRes as $k => $v) {
            if($v['id'] == $authRuleId){
                $arr[]=$v['id'];
                $this->_getparentid($AuthRuleRes,$v['pid'],False);
            }
        }
        //直接对数据进行从小到大排序，不要用赋值的方式处理排序，因为静态数组的不清理原理
        asort($arr);
        //对数组进行以-为分隔的处理：1-2-3-4
        $arrStr=implode('-', $arr);
        return $arrStr;
    }
}