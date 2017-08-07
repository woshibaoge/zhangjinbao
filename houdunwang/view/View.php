<?php
namespace houdunwang\view;
//  触发View类  然后调用里面的make方法  但是没有make方法  所以又触发了newbase
class View
{
public static function __callStatic($name, $arguments)
{
    // 触发base类
    return call_user_func_array([new Base(),$name],$arguments);
}
}