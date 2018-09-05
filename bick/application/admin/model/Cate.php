<?php
/**
 * Created by PhpStorm.
 * User: pjc
 * Date: 2018/8/21
 * Time: 23:04
 */
namespace app\admin\model;
use think\Model;
class Cate extends Model{
    //无限分类显示
    public function catetree(){
        $cateres = $this->order('sort','desc')->select();
        return $this->sort($cateres);
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
    public function sort($data, $pid = 0, $level = 0){
        static $arr = array();
        foreach ($data as $k => $v){
            if($v['pid'] == $pid){
                $v['level'] = $level;
                $arr[] = $v;
                $this->sort($data, $v['id'], $level+1);
            }
        }
        return $arr;
    }

    /*
     * 无限删除：
     * 实现思路：
     * 把当前cateid作为顶级分类
     * 在所有的栏目分类中进行遍历操作，如果顶级分类的标识pid 等于当前的cateid
     * 那么该分类为当前分类的子分类，将该分类的id存进数组当中
     * 递归操作，下一次传的参数有（所有的栏目分类，该分类的id（又一次作为顶级分类重复上一个操作））
     * 最后将所有的子分类id存进一个数组返回
     * */

    public function getchilrenid($cateid){
        $cateres = $this->select();
        return $this->_getchilrenid($cateres, $cateid);
    }

    public function _getchilrenid($cateres, $cateid){
        static $arr = array();
        foreach ($cateres as $k => $v){
            if($v['pid'] == $cateid){
                $arr[] = $v['id'];
                $this->_getchilrenid($cateres, $v['id']);
            }
        }
        return $arr;
    }
}