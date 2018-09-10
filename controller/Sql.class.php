<?php

class Sql{

    //SQL语句查询语句
    public function Index(){
        $show_database = $GLOBALS['db']->query('show databases')->fetchAll();
        include 'view/sql/index.html';

    }

    /**
     * @desc 显示每个库对应的表
     */
    public function getTable(){

        $database=$_GET['database'];
        $GLOBALS['db']->query("use $database");
        $result = $GLOBALS['db']->query("show tables;")->fetchAll(); //查询所有库里的表
        $string=json_encode($result);
        $str=  str_replace($database,'name',$string);
        $res = json_decode($str,true); //如果没有true 默认转成对象
        //var_dump($res);die;
        include 'view/home/tableList.html';

    }

    /**
     * 显示左侧表
     */
    function getFieldIndex(){

        $database = $_GET['database'];
        $table = $_GET['table'];
        include 'view/home/fieldIndex.html';
        die;

    }

    /**
     * @desc 获取每个字段的索引
     */
    function getIndexList(){

        $database = $_GET['database'];
        $table = $_GET['table'];
        $sql = $GLOBALS['db']->query("show index from $database.$table;")->fetchAll();
        /* var_dump($sql);exit;*/
        include "view/home/suoyin.html";

    }

    /**
     * @desc 获取每个表所对应的字段名
     */
    function getFieldIndexList(){

        $database = $_GET['database'];
        $table = $_GET['table'];
        $sql = $GLOBALS['db']->query("desc $database.$table;")->fetchAll();
        //var_dump($sql);die;
        include "view/home/field.html";

    }

}