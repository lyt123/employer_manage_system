<?php

class SqlHelper
{
    public $conn;
    public $host = "localhost";
    public $dbms = 'mysql';
    public $dbname = "test";
    public $username = "root";
    public $password = "";

    public function __construct()
    {
        $this->conn = new PDO('mysql:host=localhost;dbname=test;charset=utf8mb4',$this->username,$this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function  execute_dql($sql)
    {
        return $this->conn->query($sql);
    }

    public function execute_dql2($sql)
    {
        $res = $this->conn->query($sql);

        $arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $arr[] = $row;
        }

        return$arr;
    }

    public function execute_dml($sql)
    {
        return $this->conn->exec($sql);
    }

    public function execute_dql_fenye($sql1, $sql2, $fenyePage)
    {
        $res = $this->conn->query($sql1);

        $arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $arr[] = $row;
        }

        $fenyePage->res_array = $arr;

        $res2 = $this->conn->query($sql2);
        if($row = $res2->fetch(PDO::FETCH_NUM)) {
            $fenyePage->pageCount = ceil($row[0] / $fenyePage->pageSize);
            $fenyePage->rowCount = $row[0];
        }

        //把导航信息也封装到fenyePage对象中
        $navigate = "";
        if ($fenyePage->pageNow > 1) {
            $prePage = $fenyePage->pageNow - 1;
            $navigate = "<a href='{$fenyePage->gotoUrl}?pageNow=$prePage'>上一页</a>&nbsp;";
        }
        if ($fenyePage->pageNow < $fenyePage->pageCount) {
            $nextPage = $fenyePage->pageNow + 1;
            $navigate .= "<a href='{$fenyePage->gotoUrl}?pageNow=$nextPage'>下一页</a>&nbsp;";
        }

        $page_whole = 10;//翻页的数量大小
        $start = floor(($fenyePage->pageNow - 1) / $page_whole) * $page_whole + 1;
        $index = $start;
        //整体每10页向前翻
        //如果当前pageNow在1-10页数，就没有向前翻动的超连接
        if ($fenyePage->pageNow > $page_whole) {
            $navigate .= "&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=" . ($start - 1) . "'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
        }
        //定$start 1---》10  floor((pageNow-1)/10)=0*10+1   11->20   floor((pageNow-1)/10)=1*10+1 21-30 floor((pageNow-1)/10)=2*10+1
        for (; $start < $index + $page_whole; $start++) {
            $navigate .= "<a href='{$fenyePage->gotoUrl}?pageNow=$start'>[$start]</a>";
        }

        //整体每10页翻动
        $navigate .= "&nbsp;&nbsp;<a href='{$fenyePage->gotoUrl}?pageNow=$start'>&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";
        //显示当前页和共有多少页
        $navigate .= " 当前页{$fenyePage->pageNow}/共{$fenyePage->pageCount}页";

        //把$arr赋给$fenyePage

        $fenyePage->navigate = $navigate;
    }

   /* public function close_connect()
    {

        if (!empty($this->conn)) {
            mysqli_close($this->conn);
        }
    }*/
}

?>