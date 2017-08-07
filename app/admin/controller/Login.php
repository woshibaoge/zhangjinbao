<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/8/2
 * Time: 20:25
 */

namespace app\admin\controller;
use houdunwang\core\Controller;
use houdunwang\view\View;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use system\model\User;

class Login extends Controller
{
//  登录页面
public function index(){
    //  预先存入数据库和密码
//    $password=password_hash('admin888',PASSWORD_DEFAULT);
//    echo $password;exit;
    //  如果是POST 提交
    if(IS_POST){
        //  获得post提交的内容
        $post=$_POST;
//        p($post);exit;
        //  当验证码错误的时候
        if(strtolower($post['captcha'])!=$_SESSION['captcha']){
            return $this->error('验证码错误');
        }
        //   用户名不存在的时候
        //  判断数据库有没有当前提交的用户名
        $data = User::where( "username='{$post['username']}'")->get();
//        p($data);exit;
        if($post['username']!=$data[0]['username']){
            return $this->error('用户名不存在');
        }
        //   密码错误的时候
//        p($post);
        if(!password_verify($post['password'],$data[0]['password'])){
            return $this->error('密码错误');
        }
        //   是否勾选七天免登陆  如果勾选了七天免登陆
        if(isset($data['auto'])){
            //  那么就把它的session的日期延长7天
            setcookie(session_name(),session_id(),time()+7*24*3600,'/');
        }else{
            setcookie(session_name(),session_id(),0,'/');
        }
        //  此时符合登录的条件  但是一定要把session  存起来  要不然无法登录
        $_SESSION['user']=[
            'uid'=>$data[0]['uid'],
            'username'=>$data[0]['username'],
        ];
        //  登录成功后要跳转到后台的首页
        return $this->setRedirect( '?s=admin/entry/index' )->success( '登陆成功' );
    }


    return View::make();
}
    //  调用验证码的方法   让验证码显示出来
    public function captcha() {
        $str     = substr( md5( microtime( true ) ), 0, 3 );
        $captcha = new CaptchaBuilder( $str );
        $captcha->build();
        header( 'Content-type: image/jpeg' );
        $captcha->output();
        //把验证码存入到session
        //把值存入到session
        $_SESSION['captcha'] = strtolower( $captcha->getPhrase() );
    }
//   退出   退出的时候知识需要把session删除就行
        public function out(){
            //删除session名
            session_unset();
            // 删除session值
            session_destroy();
            //  删除之后跳转到的登录页面
            return $this->setRedirect('?s=admin/login/index')->success('退出成功');
        }


}