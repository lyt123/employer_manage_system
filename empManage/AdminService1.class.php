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
        if($row=mysqli_fetch_assoc($res)){
            if(md5($password)==$row['password']){
                echo $row['name'];
                return $row['name'];
            }
        }/*
        mysqli_free_result($res);
        $sqlHelper->close_connect();
        return "";*/
    }
}
?>