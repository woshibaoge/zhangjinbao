<?php
/**
 * Created by PhpStorm.
 * User: mazhenyu
 * Date: 28/07/2017
 * Time: 14:51
 */

namespace app\home\controller;

use houdunwang\core\Controller;
use houdunwang\model\Model;
use houdunwang\view\View;


class Entry extends Controller {
    /// 首页
    public function index() {
        $data = Model::q("SELECT * FROM stu s JOIN grade g ON s.gid=g.gid");
        return View::make()->with(compact('data'));
    }

    public function show(){
        $data=Model::q("SELECT * FROM  stu s JOIN  grade g ON s.gid=g.gid WHERE sid={$_GET['sid']}");
        return View::make()->with(compact('data'));
    }


}