<?php
class Login{

    function index(){
        include 'view/login/index.html';
    }

    /**
     * @desc 用户登录
     */
    function loginCheck(){
//      var_dump($_SERVER);
        $user=$_POST['pma_username'];
        //$pwd=$_POST['pma_password"'];
        $result=$GLOBALS['db']->query('select User from mysql.user where User="'.$user.'" limit 1')->fetchOne();
        //echo 'select User from mysql.user where User="'.$user.'" limit 1';die;
        if(empty($result)){
            die('此用户不存在!');
        }else{
           header('location:http://www.arithmetic.com/index.php/home/index');
        }
    }

}
