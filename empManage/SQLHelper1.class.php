<?php

class SqlHelper
{
    public $conn;
    public $dbname = "test";
    public $username = "root";
    public $password = "";
    public $host = "localhost";

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);//连接和选择数据库在一行中解决
        if (!$this->conn) {
            die("连接失败" . mysqli_connect_error());
        }
    }

    public function execute_dql($sql)
    {
        $res = mysqli_query($this->conn, $sql);//mysqli_query执行并返回结果集
        return $res;
    }

    public function execute_dql2($sql)
    {
        $arr = array();
        $res = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        //把$res=>$arr 把结果集内容转移到一个数组中.
        while ($row = mysqli_fetch_assoc($res)) {
            $arr[] = $row;
        }
        //这里就可以马上把$res关闭.
        mysqli_free_result($res);
        return $arr;//返回一个二维数组，第一个下标是数字，第二个下标是字符串

    }

    public function execute_dml($sql)
    {
        $b = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        if (!$b) {
            return 0; //失败
        } else {
            if (mysqli_affected_rows($this->conn) > 0) {
                return 1;//表示执行ok
            } else {
                return 2;//表示没有行受到影响
            }
        }

    }

    public function execute_dql_fenye($sql1, $sql2, $fenyePage)
    {
        //$sql1获取要展示十条记录，
        $res = mysqli_query($this->conn, $sql1) or die(mysqli_error($this->conn));
        $arr = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $arr[] = $row;//在下面赋值给$fenyePage->res_array
        }
        mysqli_free_result($res);

        //$sql2获取总id数
        $res2 = mysqli_query($this->conn, $sql2) or die(mysqli_error($this->conn));// .产生的$res2是一个对象，这个对象里面只有一个数据，即id的总个数
        if ($row = mysqli_fetch_row($res2)) {
            $fenyePage->pageCount = ceil($row[0] / $fenyePage->pageSize);
            $fenyePage->rowCount = $row[0];
        }
        mysqli_free_result($res2);

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

        $page_whole = 10;
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
        $fenyePage->res_array = $arr;
        $fenyePage->navigate = $navigate;
    }

    /*


        //执行dql语句

        //执行dql语句，但是返回的是一个数组


        //考虑分页情况的查询,这是一个比较通用的并体现oop编程思想的代码
        //$sql1="select * from where 表名 limit 0,6";
        //$sql2="select count(id) from 表名"


        //执行dml语句

    */
    //关闭连接的方法
    public function close_connect()
    {

        if (!empty($this->conn)) {
            mysqli_close($this->conn);
        }
    }
}

?>