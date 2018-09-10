<?php

if(!isset($_SERVER['PATH_INFO'])){
    $_SERVER['PATH_INFO']='welcome/home';
}

$pathInfo = $_SERVER['PATH_INFO'];  //获取path_info

$pathInfo = ltrim($pathInfo,'/');   //移除左边/

$path = explode('/',$pathInfo);     //字符串转为数组

$path[0] = ucfirst($path[0]);

include 'vendor/db.class.php';
include 'comment/db.config.php';
$GLOBALS['db'] = new db($config['db']);

//定义__PUBLIC__变量
$host = $_SERVER['HTTP_HOST'];
define("__PUBLIC__",'http://'.$host.'/'.'public/');

include 'controller/'.$path[0].'.class.php';  //引入文件

@call_user_func_array(array($path[0],$path[1]),array('')); //调用函数