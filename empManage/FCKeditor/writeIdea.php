<script type="text/javascript">
    window.onload=function(){//这里加上了onload后才可把js代码放在前面
        var oUBB = document.getElementById('UBB');
        var otoBold = document.getElementById('toBold');
        var otoLink = document.getElementById('toLink');
        otoLink.onclick = function () {
            oUBB = document.getElementById('UBB');
            oUBB.innerHTML+='[url]请在这里输入你想转换为超链接的文本[/url]';
        };
        otoBold.onclick = function () {
            oUBB = document.getElementById('UBB');
            oUBB.innerHTML+='[b]请在这里输入你想加粗的文本[/b]';
        };
    }
</script>
<?php

require_once '../EmpService1.class.php';

$empService = new EmpService();
$ed = $empService->writeIdea();
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<form action="../empProcess1.php?flag=addIdea" method="post">
    标题：<input type="text" name="title" value="">
    <?php
    $ed->Value = '请输入内容。。。';//在文本框中的初始值
    $ed->Create();
    ?>

    <br/>
    <br/>
    编写UBB代码：
    <br/>
    <input id="toBold" type="button" value="加粗"/>
    <input id="toLink" type="button" value="超链接"/>

    <br/><br/>
    <textarea id="UBB" cols="50" rows="10" name="UBB"></textarea><br/><br/>
    <input type="submit" value="添加idea">
</form>
<a href="../ideaList.php">查看idea</a>
