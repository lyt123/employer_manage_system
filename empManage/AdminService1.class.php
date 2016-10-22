<?php
require_once 'SqlHelper1.class.php';
class AdminService{
    /**
     * @param $id
     * @param $password
     * @return mixed
     */
    public function  chekcAdimn($id, $password){
        $sql="select password,name from admin where id=$id";
        //创建一个SqlHelper对象
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dql($sql);//到数据库中获取id=$id的信息，是一个结果集（对象），要用下面的if语句才能将其转化为数组
        define("PASS_CONSTANT",'lyt123');//常量值要加引号

        if($row=$res->fetch(PDO::FETCH_ASSOC)){
            if(md5($password.PASS_CONSTANT)==$row['password']){
                return $row['name'];
            }
        }/*
        mysqli_free_result($res);
        $sqlHelper->close_connect();
        return "";*/
    }
    public function userExist($user_input_value){
        $sql="select * from admin where id=$user_input_value";
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dql($sql);
        return $res->fetch(PDO::FETCH_NUM);

    }
}
?>