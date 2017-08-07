<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/8/2
 * Time: 20:24
 */

namespace app\admin\controller;

use houdunwang\core\Controller;
//   创建一个Common这个类   让他继承Controller类的方法
class Common extends Controller
{
//  设置自动执行函数
public function __construct()
{
    //  如果没有登录的话就判断session是否存在
    if(!isset($_SESSION['user'])){
        //  如果不存在 那么就跳转到登录页面  这个登录页面是在app下面的admin下面的view下面的login
        go('?s=admin/login/index');
    }
}
}