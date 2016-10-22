<?php
/**
 * User: lyt123
 * Date: 2016/5/10
 * Time: 22:31
 */
//这样查找的弊端是没能判断$key的length
require_once 'EmpService1.class.php';
$srhKey=$_POST['srhKey'];
$key=explode(" ",$srhKey);
//print_r($key);->Array ( [0] => 是 [1] => 的 )
//exit;
$empService=new EmpService();
$res=$empService->srhKey($key);
for($i=0; $i<count($res); $i++){
    $res[$i]['idea_content']=preg_replace("/($key[0])/i","<b>\\1</b>",urldecode($res[$i]['idea_content']));
    $res[$i]['idea_content']=preg_replace("/($key[1])/i","<b>\\1</b>",urldecode($res[$i]['idea_content']));
    echo $res[$i]['idea_content'];
}
