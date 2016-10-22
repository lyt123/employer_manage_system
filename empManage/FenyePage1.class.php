<?php

class FenyePage{
    //在empList1.php中制定
    //需在empList1.php中传递过去的数据：pageSize/pageNow/gotoUrl/
    public $pageSize=10;//程序员制定
    public $pageNow=1;  //页面产生
    public $gotoUrl;    //分页显示的页面

    //在SQLHelper.class.php中制定
    public $rowCount;   //（select count(id) from emp）从数据库中获取
    public $pageCount;  //rowCount/pageSize
    public $res_array;  //获取将要展示的十行记录$sql1 = "select * from emp  limit ". ($fenyePage->pageNow - 1) * $fenyePage->pageSize . "," . $fenyePage->pageSize;
    public $navigate;   //分页导航(上一页、下一页、翻十页、跳转到某一页)
}
?>

