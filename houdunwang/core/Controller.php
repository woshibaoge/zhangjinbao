<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2017/8/2
 * Time: 8:41
 */

namespace houdunwang\core;

//  创建Ccontroller这个类
class Controller
{
    private $url = 'window.history.back()';
    private $template;
    private $msg;
    //  跳转
    protected function setRedirect($url){
        $this->url = "location.href='{$url}'";
        return $this;
    }

    //   成功的时候
    protected function success($msg){
        $this->msg = $msg;
        $this->template = './view/success.php';
        return $this;
    }

    //  失败的时候
    protected function error($msg){
        $this->msg = $msg;
        $this->template = './view/error.php';
        return $this;
    }
        //  当输出对象的时候触发次函数
    public function __toString() {
        include $this->template;
        return '';
    }
}