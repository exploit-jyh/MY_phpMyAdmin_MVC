<?php

class A
{
    function B(){

        /*$bbb = $GLOBALS['db'] -> query('show tables') -> fetchAll();*/

        $aaa = "赵海滨";

        //赋值
        /*$GLOBALS['db'] -> insert('area',array('area_id'=>null,'area_name'=>'zhaohaibin'));*/

        //调用模板
        include 'view/index.html';
    }
}