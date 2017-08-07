<?php
namespace app\admin\controller;
use houdunwang\core\Controller;
use houdunwang\view\View;
//  创建一个Entry类
class Entry extends Controller{
    public function index(){
        //  调用view类里面的make方法   并且把这个结果返回  但是此时没有这个类 和方法  所以需要去核心文件里面去创建
        return View::make();
    }
}
