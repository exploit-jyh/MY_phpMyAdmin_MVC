<?php

class db{

    /**
     * @desc 把两个方法设置成静态变量
     * @var mysqli
     */
     private static $link,$result;

    /**
     * @desc 实例化数据库
     * @param $config
     */
     public function __construct($config){

         self::$link = mysqli_connect($config['dns'],
                                         $config['username'],
                                         $config['password'],
                                         $config['database']
         );
     }

    /**
     * @desc 查询数据
     * @param $sql
     * @return $this
     */
    public function query($sql){
        self::$result = mysqli_query(self::$link,$sql);

        return $this;
    }

    /**
     * @desc 查询数据
     * @return array|null
     */
    public function fetchAll(){
        return mysqli_fetch_all(self::$result,MYSQLI_ASSOC);
    }

    /**
     * @desc 查询一条数据
     * @return array|null
     */
    public function fetchOne(){
        return mysqli_fetch_array(self::$result,MYSQLI_ASSOC);
    }

    /**
     * @desc 添加
     * @param $tableName
     * @param array $array
     * @return int|string
     */
    public function insert($tableName,$array=array()){
        $v ='(';

        foreach($array as $key=>$value){

            is_string($value) ? $value = "'".$value."'":'';

            if(empty($value)){
                $v.='null';
            }

            $v.=$value.',';
        }

        $v =rtrim($v,',');

        $v .=')';

        $sql = 'insert into '.$tableName. ' values' .$v;

        echo $sql;

        $this->query($sql);

        return mysqli_insert_id(self::$link);
    }

    /**
     * @desc 修改
     * @param $tableName
     * @param array $array
     * @param $condition
     */
    public function update($tableName,$array=[],$condition){

        foreach ($array as $key =>$value){
            is_string($value)?$value = "'".$value."'" : '';
            $v=$key.'='.$value.',';
        }
        $v = rtrim($v,',');
        $sql = ' update '.$tableName.' set '.$v.' where '.$condition;
        $this->select($sql);
    }

    /**
     * @desc 删除
     * @param $tableName
     * @param $condition
     */
    public function delete($tableName,$condition){
        if($condition == ''){
            $sql = ' delete from '.$tableName;
        }else{
            $sql = ' delete from '.$tableName.' where '.$condition;
        }

        $this->select($sql);
    }
}