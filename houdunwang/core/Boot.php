<?php
namespace houdunwang\core;
//  框架启动类  创建boot类  并且调用静态的run方法
class Boot{
    //  定义一个静态的run方法
    public static function run(){
        // 注册错误处理
//        self::handleError();
        //  初始化框架
        self::init();
        //    执行应用
        self::appRun();
    }
//    //   定义执行错误的处理的方法
//    private static function handleError(){
//        $whoops = new \Whoops\Run;
//        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
//        $whoops->register();
//    }
   //   初始化框架的方法
    private static function init(){
        //   开启session
        session_id()||session_start();
        //  设置时区
        date_default_timezone_set("PRC");
        //  定义是否提交的变量
        define('IS_POST',$_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);
//        define('IS_POST',$_SERVER['REQUEST_METHOD']=='POST'?true:false);
    }
    //   执行应用的方法
    private static function appRun(){
        // 判断是否给地址栏传递了get参数  如果没有传递  那么就让他默认访问首页
        $s=  isset($_GET['s']) ? strtolower($_GET['s']): 'home/entry/index';
        // 把变量转化为数组  用/分隔开  因为变量s默认的值就是admin/entry/index
        $arr=explode('/',$s);
        //1.把应用比如："home"定义为常量APP
        //2.在houdunwang/view/View.php文件里的View类的make方法组合模板路径，需要用的应用比如:home的名字
        //home是默认应用，有可能为admin后台应用，所以不能写死home
        define('APP',$arr[0]);
        //定义一个CONTROLLER常量
        define('CONTROLLER',$arr[1]);
        //定义一个ACTION常量
        define('ACTION',$arr[2]);
        //组合类名 \app\home\controller\Entry
        $className = "\app\\{$arr[0]}\controller\\" . ucfirst($arr[1]);
        //调用控制器里面的方法  默认new的是Entry这个类  调用里面的index方法   所以需要去app应用中找
        echo call_user_func_array([new $className,$arr[2]],[]);
    }
}