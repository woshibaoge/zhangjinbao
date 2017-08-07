<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/8/2
 * Time: 20:25
 */

namespace app\admin\controller;
use houdunwang\view\view;
use system\model\User as UserModel;
class User extends Common
{
//   修改密码
public function changePassword(){
    //  如果点击修改
    if(IS_POST){
        $post=$_POST;
        //  先对比旧密码是否正确
        $user=UserModel::where("uid".$_SESSION['user']['uid'])->get();
        if(!password_verify($post['oldPassword'],$user[0]['password'])){
           return $this->error('旧密码错误');
        }
        //  2次密码不一样
        if($post['newPassword']!=$post['confirmPassword']){
            return $this->error('两次密码不一致');
        }
        //   修改密码
        $data = ['password'=>password_hash($post['newPassword'],PASSWORD_DEFAULT)];
        UserModel::where('uid=' . $_SESSION['user']['uid'])->update($data);

        //  删除session  重新登录
        session_unset();
        session_destroy();
        return $this->setRedirect('?s=admin/login/index')->success('修改成功');
    }
    return View::make();
}

}