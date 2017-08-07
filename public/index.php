<?php
//  composer 自动载入
include "../vendor/autoload.php";
//  调用框架启动类的run方法    此时去后盾网核心文件下面的core文件寻找r静态un方法
\houdunwang\core\Boot::run();
