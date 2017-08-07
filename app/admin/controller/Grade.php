<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/8/2
 * Time: 9:28
 */

namespace app\admin\controller;
use houdunwang\core\Controller;
use houdunwang\view\View;
use system\model\Grade as GradeModel;
//   创建班级类
class Grade extends Controller
{
//  班级列表 方法
public function lists(){
    //  获得班级表中的所有数据
    $data=GradeModel::get();

    return View::make()->with(compact('data'));
}
    //  添加

    public function store(){
        //  如果点击post提交   那么就添加
        if(IS_POST){
            //  吧post提交的内容添加到数据库中的学生表
            GradeModel::save($_POST);
            return $this->setRedirect('?s=admin/grade/lists')->success('添加成功');
        }
        return View::make();
    }
    //  编辑   定义update方法
    public function update(){
        //   获得数组中所有 的下标
        $gid = $_GET['gid'];
        //  点击编辑后
        if(IS_POST){
            //  确定要编辑的哪个id的内容
            GradeModel::where("gid={$gid}")->update($_POST);
            //  吧编辑提交后的内容返回  并且提示修改成功
            return $this->setRedirect('?s=admin/grade/lists')->success('修改成功');
        }
        $oldData = GradeModel::find($gid);
        return View::make()->with(compact('oldData'));
    }

    //   删除
    public function remove(){
        //  获得有where条件的数据    确定要删除那条数据
        GradeModel::where("gid={$_GET['gid']}")->destory();
        return $this->setRedirect('?s=admin/grade/lists')->success('删除成功');
    }


}