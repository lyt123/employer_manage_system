<?php
require_once '../EmpService1.class.php';

$empService=new EmpService();
$ed=$empService->writeIdea();
?>
<form action="../empProcess1.php?flag=addIdea" method="post">
    标题：<input type="text" name="title" value="" >
    <?php
    $ed->Value='请输入内容。。。';//在文本框中的初始值
    $ed->Create() ?>
    <input type="submit" value="添加idea" >
</form>
<a href="../ideaList.php">查看idea</a>
