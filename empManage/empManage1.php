<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<?php
require_once "common.php";
checkValidate();
getLastTime();

if(!empty($_GET['name']))
{
    echo "欢迎 ".$_GET['name']." </br>登录成功!";
}
echo "<br/><a href='login1.php'>返回重新登录</a>";
?>
<h1>主界面</h1>
<a href='empList1.php'>管理用户</a><br/>
<a href='addEmp1.php'>添加用户</a><br/>
<a href='srhEmp1.php'>查询用户</a><br/>
<a href='FCKeditor/writeIdea.php'>编写idea</a><br/>
<a href='login1.php'>退出系统</a><br/>
</html>